<?php

namespace App\Http\Controllers;

use App\Enum\SaleType;
use App\Helpers\HelperFunctions;
use App\Models\Expense;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            ->groupBy('date',);

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

        $saleGrandTotal = [
            'grand_total_cash_total' => $result->pluck('totals.total_cash_total')->sum(),
            'grand_total_credit_total' => $result->pluck('totals.total_credit_total')->sum(),
            'grand_total_expected_profit' => $result->pluck('totals.total_expected_profit')->sum(),
            'grand_total_debt' => $result->pluck('totals.total_debt')->sum(),
            'grand_total_actual_profit' => $result->pluck('totals.total_actual_profit')->sum(),
        ];


        // calculate the expense for the same give range
        $expenses = Expense::query()
            ->select([
                DB::raw("DATE(created_at) as expense_date"),
                'id',
                'quantity',
                'description',
                'unit_cost_price',
            ])
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('expense_date', 'id')
            ->orderBy('expense_date', 'asc')
            ->get()
            ->map(function ($row) {
                return [
                    'date' => $row->expense_date,
                    'description' => $row->description,
                    'unit_cost_price' => (float) $row->unit_cost_price,
                    'quantity' => (int) $row->quantity,
                    'cost_price_total' => (float) $row->quantity * $row->unit_cost_price,
                ];
            })
            ->groupBy('date',);

        $expenseResults = $expenses->map(function ($items, $date) {
            $totals = [
                'total_cost_price' => $items->sum('cost_price_total'),
            ];

            return [
                'expenses' => $items->values()->toArray(),
                'totals' => $totals,
            ];
        });

        $expenseGrandTotal = [
            'grand_total_cost_price' => $expenseResults->pluck('totals.total_cost_price')->sum(),
        ];


        $startPeriod = Carbon::parse($from)->format('d M y');
        $endPeriod = Carbon::parse($to)->format('d M y');
        $period = ($startPeriod == $endPeriod) ? $startPeriod : "$startPeriod to $endPeriod";
        $title = ($startPeriod == $endPeriod) ? "Sales Report for $startPeriod" : "Sales Report from $startPeriod to $endPeriod";

        $data = array(
            'title' => $title,
            'result' => $result,
            'expenseResults' => $expenseResults,
            'saleGrandTotal' => $saleGrandTotal,
            'expenseGrandTotal' => $expenseGrandTotal,
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
            ->groupBy('date',);

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