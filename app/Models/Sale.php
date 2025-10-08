<?php

namespace App\Models;

use App\Enum\SaleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $fillable = ['stock_id', 'personnel_id', 'quantity', 'sale_type'];

    protected $casts = [
        'sale_type' => SaleType::class,
        'quantity' => 'integer',
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function personnel(): BelongsTo
    {
        return $this->belongsTo(Personnel::class);
    }

    public function getTotalAmountAttribute(): float
    {
        return $this->stock->unit_selling_price * $this->quantity;
    }

    public function getProfitAttribute(): float
    {
        if (! $this->stock) {
            return 0.0;
        }

        return ($this->stock->selling_price - $this->stock->cost_price) * $this->quantity;
    }

    // Scopes
    public function scopeForDay(Builder $query, $date = null): Builder
    {
        $date = $date ?? now();
        return $query->whereDate('created_at', $date->toDateString());
    }

    public function scopeForWeek(Builder $query, $date = null): Builder
    {
        $date = $date ?? now();
        return $query->whereBetween('created_at', [$date->startOfWeek(), $date->endOfWeek()]);
    }

    public function scopeForMonth(Builder $query, $date = null): Builder
    {
        $date = $date ?? now();
        return $query->whereBetween('created_at', [$date->startOfMonth(), $date->endOfMonth()]);
    }

    public function scopeCredits(Builder $query): Builder
    {
        return $query->where('sale_type', SaleType::CREDIT);
    }

    public function scopeCash(Builder $query): Builder
    {
        return $query->where('sale_type', SaleType::CASH);
    }
}
