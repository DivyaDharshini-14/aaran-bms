<?php

namespace App\Enums;

enum ContactType: int
{
    case DEBTORS = 0;
    case CREDITORS = 1;
    case BOTH = 2;
    case  NON_CUSTOMER = 3;


    public function getName(): string
    {
        return match ($this) {
            self::DEBTORS => 'Debtors',
            self::CREDITORS => 'Creditors',
            self::BOTH => 'Both',
            self::NON_CUSTOMER => 'Non_customer',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::DEBTORS => 'bg-red-500',
            self::CREDITORS => 'bg-green-500',
            self::BOTH => 'bg-blue-500',
            self::NON_CUSTOMER => 'bg-yellow-500',
        };
    }

}
