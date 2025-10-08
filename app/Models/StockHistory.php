<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    /** @use HasFactory<\Database\Factories\StockHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'previous_quantity',
        'added_quantity',
        'new_quantity',
        'unit_cost_price',
        'unit_selling_price'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    // get stock total cost price
    public function getTotalCostPriceAttribute()
    {
        return $this->unit_cost_price * $this->new_quantity;
    }

    // get stock total selling price
    public function getTotalSellingPriceAttribute()
    {
        return $this->unit_selling_price * $this->new_quantity;
    }

    // get estimated profit
    public function getEstimatedProfitAttribute()
    {
        return $this->total_selling_price - $this->total_cost_price;
    }
}
