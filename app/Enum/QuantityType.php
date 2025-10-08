<?php

namespace App\Enum;

enum QuantityType: string
{
    case BOTTLE = "Bottle";

    case CAN = "Can";

    case TUBE = "Tube";

    case PIECE = "Piece";

    case PACK = "Pack";

    case OTHER = "Other";
}
