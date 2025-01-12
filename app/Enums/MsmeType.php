<?php

namespace App\Enums;

enum MsmeType :int
{
    case SMALL = 0;
    case MICRO = 1;


    public function getName(): string
    {
        return match ($this) {
            self::SMALL => 'Small',
            self::MICRO => 'Micro',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::SMALL => 'bg-red-500',
            self::MICRO => 'bg-green-500',
        };
    }

}
