<?php

namespace App\Models;

use App\Enum\PersonnelGender;
use App\Enum\PersonnelType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personnel extends Model
{
    /** @use HasFactory<\Database\Factories\PersonnelFactory> */
    use HasFactory;

    protected $fillable = [
        'service_number',
        'rank_id',
        'last_name',
        'other_names',
        'gender',
        'phone',
        'email',
        'type'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => PersonnelType::class,
            'gender' => PersonnelGender::class
        ];
    }

    /**
     * Get the rank of Personnel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    /**
     * Get the sales of Personnel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get personnel name
     */
    public function getNameAttribute()
    {
        $initials = "";
        $fullName = "";

        $otherNames = explode(" ", $this->other_names);
        for ($i = 0; $i < count($otherNames); $i++) {
            $initials .= substr($otherNames[$i], 0, 1);
        }

        ($this->type == PersonnelType::OFFICER->value)
            ? $fullName = $initials . " $this->last_name"
            : $fullName = "$this->last_name " . $initials;

        return $fullName;
    }

    /**
     * Get personnel name with rank
     */
    public function getNameWithRankAttribute()
    {
        $initials = "";
        $fullName = "";

        $otherNames = explode(" ", $this->other_names);
        for ($i = 0; $i < count($otherNames); $i++) {
            $initials .= substr($otherNames[$i], 0, 1);
        }

        ($this->type == PersonnelType::OFFICER->value)
            ? $fullName = $initials . " $this->last_name"
            : $fullName = "$this->last_name " . $initials;

        return $this->rank->code . " " . $fullName;
    }
}
