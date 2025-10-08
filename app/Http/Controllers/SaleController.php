<?php

namespace App\Http\Controllers;

use App\Enum\SaleType;
use App\Helpers\HelperFunctions;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class SaleController extends Controller
{
    // Print sales history
    public function printSaleHistory($from, $to)
    {
        $salesHistory = Sale::query()
            ->select([
                DB::raw("DATE(created_at) as sale_date"),
                'stock_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw("SUM(CASE WHEN sale_type = '" . SaleType::CASH->value . "' THEN quantity ELSE 0 END) as cash_quantity"),
                DB::raw("SUM(CASE WHEN sale_type = '" . SaleType::CREDIT->value . "' THEN quantity ELSE 0 END) as credit_quantity"),
            ])
            ->whereBetween('created_at', [$from, $to])
            ->with('stock')
            ->groupBy('sale_date', 'stock_id')
            ->orderBy('sale_date', 'asc')
            ->get()
            ->map(function ($row) {
                $stock = $row->stock;
                $sellingPrice = $stock->unit_selling_price;
                $costPrice = $stock->unit_cost_price;
                $priceDifference = $sellingPrice - $costPrice;
                $expectedProfit = $priceDifference * $row->total_quantity;
                $actualProfit = $priceDifference * $row->cash_quantity;
                $debt = $priceDifference * $row->credit_quantity;

                return [
                    'date' => $row->sale_date,
                    'item' => $stock->name,
                    'cost_price' => $costPrice,
                    'selling_price' => $sellingPrice,
                    'total_quantity' => (int) $row->total_quantity,
                    'cash_quantity' => (int) $row->cash_quantity,
                    'credit_quantity' => (int) $row->credit_quantity,
                    'cash_total' => $row->cash_quantity * $sellingPrice,
                    'credit_total' => $row->credit_quantity * $sellingPrice,
                    'expected_profit' => $expectedProfit,
                    'actual_profit' => $actualProfit,
                    'debt' => $debt,
                ];
            })
            ->groupBy('date', 'desc');

        $result = $salesHistory->map(function ($items, $date) {
            $totals = [
                'total_cash_total' => $items->sum('cash_total'),
                'total_credit_total' => $items->sum('credit_total'),
                'total_expected_profit' => $items->sum('expected_profit'),
                'total_actual_profit' => $items->sum('actual_profit'),
                'total_debt' => $items->sum('debt'),
            ];

            return [
                'salesHistory' => $items->values()->toArray(),
                'totals' => $totals,
            ];
        });

        $startPeriod = Carbon::parse($from)->format('d M y');
        $endPeriod = Carbon::parse($to)->format('d M y');
        $period = ($startPeriod == $endPeriod) ? $startPeriod : "$startPeriod to $endPeriod";
        $title = ($startPeriod == $endPeriod) ? "Sales Report for $startPeriod" : "Sales Report from $startPeriod to $endPeriod";

        $data = array(
            'title' => $title,
            'result' => $result
        );

        $html = view('print.sales-records', $data)->render();
        $fileName = "sales-records-$period";

        return HelperFunctions::generatePDF($html, $fileName);
    }

    // Print credit history
    public function printCreditHistory($from, $to)
    {
        $creditHistory = Sale::query()
            ->select([
                DB::raw("DATE(created_at) as sale_date"),
                'stock_id',
                DB::raw('SUM(quantity) as credit_quantity'),
            ])
            ->credits()
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('sale_date', 'stock_id')
            ->with('stock')
            ->orderBy('sale_date', 'asc')
            ->get()
            ->map(function ($row) {
                $stock = $row->stock;
                $sellingPrice = $stock->unit_selling_price;
                $costPrice = $stock->unit_cost_price;

                return [
                    'date' => $row->sale_date,
                    'item' => $stock->name,
                    'cost_price' => $costPrice,
                    'selling_price' => $sellingPrice,
                    'credit_quantity' => (int) $row->credit_quantity,
                    'credit_total' => $row->credit_quantity * $sellingPrice,
                    'estimated_profit' => ($sellingPrice - $costPrice) * $row->credit_quantity,
                ];
            })
            ->groupBy('date', 'desc');

        $result = $creditHistory->map(function ($items, $date) {
            $totals = [
                // 'total_cash_total' => $items->sum('cash_total'),
                'total_credit_total' => $items->sum('credit_total'),
                'total_estimated_profit' => $items->sum('estimated_profit'),
            ];

            return [
                'creditHistory' => $items->values()->toArray(),
                'totals' => $totals,
            ];
        });

        $grandTotal = [
            'grand_total_credit_total' => $result->pluck('totals.total_credit_total')->sum(),
            'grand_total_estimated_profit' => $result->pluck('totals.total_estimated_profit')->sum(),
        ];

        $startPeriod = Carbon::parse($from)->format('d M y');
        $endPeriod = Carbon::parse($to)->format('d M y');
        $period = ($startPeriod == $endPeriod) ? $startPeriod : "$startPeriod to $endPeriod";
        $title = ($startPeriod == $endPeriod) ? "Credit Report for $startPeriod" : "Credit Report from $startPeriod to $endPeriod";

        $data = array(
            'title' => $title,
            'result' => $result,
            'grandTotal' => $grandTotal
        );

        $html = view('print.credit-records', $data)->render();
        $fileName = "credit-records-$period";

        return HelperFunctions::generatePDF($html, $fileName, false);
    }


    // Print personnel credit
    public function printPersonnelCredit()
    {
        $grouped = Sale::query()
            ->select([
                'personnel_id',
                'stock_id',
                DB::raw('SUM(quantity) as total_quantity'),
            ])
            ->where('sale_type', SaleType::CREDIT->value)
            ->groupBy('personnel_id', 'stock_id')
            ->with(['personnel', 'stock'])
            ->get()
            ->map(function ($row) {
                $stock = $row->stock;
                $personnel = $row->personnel;

                $amountOwed = $row->total_quantity * $stock->unit_selling_price;

                return [
                    'personnel' => $personnel?->name_with_rank ?? 'Unknown',
                    'item' => $stock->name,
                    'selling_price' => $stock->unit_selling_price,
                    'total_quantity' => (int) $row->total_quantity,
                    'amount_owed' => $amountOwed,
                    'date' => Carbon::parse($row->created_at)->format('d M y'),
                ];
            })
            ->groupBy('personnel'); // 👈 group all rows under personnel

        // Add totals per personnel
        $result = $grouped->map(function ($items, $personnel) {
            $totals = [
                // 'personnel' => $personnel,
                // 'item' => 'TOTAL',
                // 'cost_price' => null,
                // 'total_quantity' => $items->sum('total_quantity'),
                'total_amount_owed' => $items->sum('amount_owed'),
            ];

            return [
                'creditHistory' => $items->values()->toArray(),
                'totals' => $totals,
            ];
        });

        $grandTotal = [
            'grand_total_amount_owed' => $result->pluck('totals.total_amount_owed')->sum(),
        ];

        $data = array(
            'title' => "Personnel Credit Report",
            'result' => $result,
            'grandTotal' => $grandTotal
        );

        $html = view('print.personnel-credit', $data)->render();
        $fileName = "personnel-credit-data";

        return HelperFunctions::generatePDF($html, $fileName, false);
    }
}
