<?php

namespace App\Enums;

enum MovementTypeEnum: int
{
    case ENTRADA = 1;
    case SALIDA  = 2;
    case AJUSTE  = 3;
}