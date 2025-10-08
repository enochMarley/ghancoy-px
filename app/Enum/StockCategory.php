<?php

namespace App\Enum;

enum StockCategory: string
{
    case DRINKS = 'drink';

    case TOILETRY = 'toiletry';

    case SNACKS = 'snacks';

    case AIRTIME = 'airtime';

    case MISC = 'misc';

    public function label(): string
    {
        return match ($this) {
            self::DRINKS => 'Drinks',
            self::TOILETRY => 'Toiletry',
            self::SNACKS => 'Snacks',
            self::AIRTIME => 'Airtime',
            self::MISC => 'Misc',
        };
    }
}
