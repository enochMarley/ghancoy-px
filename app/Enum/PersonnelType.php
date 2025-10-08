<?php

namespace App\Enum;

enum PersonnelType: string
{
    case OFFICER = "Officer";
    case OTHER_RANK = "Other Rank";
    case CIVILIAN_EMPLOYEE = "Civ Employee";

    public function code(): string
    {
        return match ($this) {
            self::OFFICER => 'OFFR',
            self::OTHER_RANK => 'OR',
            self::CIVILIAN_EMPLOYEE => 'CE',
        };
    }
}
