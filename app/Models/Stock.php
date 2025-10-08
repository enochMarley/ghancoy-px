<?php

namespace App\Models;

use App\Enum\StockCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'unit_cost_price', 'unit_selling_price', 'quantity', 'category'];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'category' => StockCategory::class,
    ];


    // get stock sales
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    // get stock total cost price
    public function getTotalCostPriceAttribute()
    {
        return $this->unit_cost_price * $this->quantity;
    }

    // get stock total selling price
    public function getTotalSellingPriceAttribute()
    {
        return $this->unit_selling_price * $this->quantity;
    }

    // get estimated profit
    public function getEstimatedProfitAttribute()
    {
        return $this->total_selling_price - $this->total_cost_price;
    }

    // get stock histories
    public function histories()
    {
        return $this->hasMany(StockHistory::class);
    }

    // get quantity with label
    public function getQuantityWithLabelAttribute()
    {
        return $this->quantity . " " . ($this->quantity == 1 ? Str::singular($this->quantity_type) : Str::plural($this->quantity_type));
    }

    public static function groupedByDayAdded()
    {
        return self::orderByDesc('created_at')
            ->get()
            ->groupBy(fn($s) => $s->created_at->toDateString());
    }
}
