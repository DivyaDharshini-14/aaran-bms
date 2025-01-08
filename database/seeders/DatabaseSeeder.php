<?php

namespace Database\Seeders;

use Aaran\AccountMaster\Database\Seeders\S301_AccountHeadsSeeder;
use Aaran\Common\Database\Seeders\S101_CitySeeder;
use Aaran\Common\Database\Seeders\S101_LabelSeeder;
use Aaran\Common\Database\Seeders\S102_CommonSeeder;
use Aaran\Common\Database\Seeders\S102_StateSeeder;
use Aaran\Common\Database\Seeders\S103_CountrySeeder;
use Aaran\Common\Database\Seeders\S104_PincodeSeeder;
use Aaran\Common\Database\Seeders\S105_HsncodeSeeder;
use Aaran\Common\Database\Seeders\S107_CategorySeeder;
use Aaran\Common\Database\Seeders\S108_ColourSeeder;
use Aaran\Common\Database\Seeders\S109_SizeSeeder;
use Aaran\Common\Database\Seeders\S110_DepartmentSeeder;
use Aaran\Common\Database\Seeders\S111_TransportSeeder;
use Aaran\Common\Database\Seeders\S112_BankSeeder;
use Aaran\Common\Database\Seeders\S113_ReceipttypeSeeder;
use Aaran\Common\Database\Seeders\S114_DespatcheSeeder;
use Aaran\Master\Database\Seeders\S401_CompanySeeder;
use Aaran\Master\Database\Seeders\S403_ContactSeeder;
use Aaran\Master\Database\Seeders\S404_ProductSeeder;
use Aaran\Master\Database\Seeders\S405_OrderSeeder;
use Aaran\Master\Database\Seeders\S406_StyleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        S01_TenantSeeder::run();
        S02_RoleSeeder::run();
        S03_UserSeeder::run();
        S04_DefaultCompanySeeder::run();

        S101_LabelSeeder::run();
        S102_CommonSeeder::run();

        S101_CitySeeder::run();
        S102_StateSeeder::run();
        S103_CountrySeeder::run();
        S104_PincodeSeeder::run();
        S105_HsncodeSeeder::run();
        S107_CategorySeeder::run();
        S108_ColourSeeder::run();
        S109_SizeSeeder::run();
        S110_DepartmentSeeder::run();
        S111_TransportSeeder::run();
        S112_BankSeeder::run();
        S113_ReceipttypeSeeder::run();
        S114_DespatcheSeeder::run();

        S301_AccountHeadsSeeder::run();

        S401_CompanySeeder::run();
        S403_ContactSeeder::run();
        S404_ProductSeeder::run();
        S405_OrderSeeder::run();
        S406_StyleSeeder::run();
    }
}
