<?php

namespace App\Enums;

enum Active :int
{
    case NOTACTIVE = 0;
    case ACTIVE = 1;


    public function getName(): string
    {
        return match ($this) {
            self::NOTACTIVE => 'Not Active',
            self::ACTIVE => 'Active',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::NOTACTIVE => 'bg-red-500',
            self::ACTIVE => 'bg-green-500',
        };
    }

}
