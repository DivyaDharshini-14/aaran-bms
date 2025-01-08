<?php

namespace App\Enums;

enum AcYear: int
{
    case AY_2017_18 = 1;
    case AY_2018_19 = 2;
    case AY_2019_20 = 3;
    case AY_2020_21 = 4;
    case AY_2021_22 = 5;
    case AY_2022_23 = 6;
    case AY_2023_24 = 7;
    case AY_2024_25 = 8;
    case AY_2025_26 = 9;
    case AY_2026_27 = 10;
    case AY_2027_28 = 11;
    case AY_2028_29 = 12;
    case AY_2029_30 = 13;
    case AY_2030_31 = 14;
    case AY_2031_32 = 15;

    public function getName(): string
    {
        return match ($this) {
            self::AY_2017_18 => '2017_18',
            self::AY_2018_19 => '2018_19',
            self::AY_2019_20 => '2019_20',
            self::AY_2020_21 => '2020_21',
            self::AY_2021_22 => '2021_22',
            self::AY_2022_23 => '2022_23',
            self::AY_2023_24 => '2023_24',
            self::AY_2024_25 => '2024_25',
            self::AY_2025_26 => '2025_26',
            self::AY_2026_27 => '2026_27',
            self::AY_2027_28 => '2027_28',
            self::AY_2028_29 => '2028_29',
            self::AY_2029_30 => '2029_30',
            self::AY_2030_31 => '2030_31',
            self::AY_2031_32 => '2031_32',
        };
    }

    public function getFrom(): string
    {
        return match ($this) {
            self::AY_2017_18 => '1-4-2017',
            self::AY_2018_19 => '1-4-2018',
            self::AY_2019_20 => '1-4-2019',
            self::AY_2020_21 => '1-4-2020',
            self::AY_2021_22 => '1-4-2021',
            self::AY_2022_23 => '1-4-2022',
            self::AY_2023_24 => '1-4-2023',
            self::AY_2024_25 => '1-4-2024',
        };
    }

    public function getTo(): string
    {
        return match ($this) {
            self::AY_2017_18 => '31-3-2018',
            self::AY_2018_19 => '31-3-2019',
            self::AY_2019_20 => '31-3-2020',
            self::AY_2020_21 => '31-3-2021',
            self::AY_2021_22 => '31-3-2022',
            self::AY_2022_23 => '31-3-2023',
            self::AY_2023_24 => '31-3-2024',
            self::AY_2024_25 => '31-3-2025',
        };
    }

}
