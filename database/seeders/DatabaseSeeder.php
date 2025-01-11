<?php

namespace Database\Seeders;

use Aaran\AccountMaster\Database\Seeders\S301_AccountHeadsSeeder;
use Aaran\Common\Database\Seeders\S103_CitySeeder;
use Aaran\Common\Database\Seeders\S102_LabelSeeder;
use Aaran\Common\Database\Seeders\S101_CommonSeeder;
use Aaran\Common\Database\Seeders\S104_StateSeeder;
use Aaran\Common\Database\Seeders\S105_CountrySeeder;
use Aaran\Common\Database\Seeders\S106_PincodeSeeder;
use Aaran\Common\Database\Seeders\S107_HsncodeSeeder;
use Aaran\Common\Database\Seeders\S108_UnitSeeder;
use Aaran\Common\Database\Seeders\S109_CategorySeeder;
use Aaran\Common\Database\Seeders\S110_ColourSeeder;
use Aaran\Common\Database\Seeders\S111_SizeSeeder;
use Aaran\Common\Database\Seeders\S112_DepartmentSeeder;
use Aaran\Common\Database\Seeders\S113_TransportSeeder;
use Aaran\Common\Database\Seeders\S114_BankSeeder;
use Aaran\Common\Database\Seeders\S115_ReceipttypeSeeder;
use Aaran\Common\Database\Seeders\S116_DespatcheSeeder;
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

        S102_LabelSeeder::run();
        S101_CommonSeeder::run();

        S103_CitySeeder::run();
        S104_StateSeeder::run();
        S105_CountrySeeder::run();
        S106_PincodeSeeder::run();
        S107_HsncodeSeeder::run();
        S108_UnitSeeder::run();
        S109_CategorySeeder::run();
        S110_ColourSeeder::run();
        S111_SizeSeeder::run();
        S112_DepartmentSeeder::run();
        S113_TransportSeeder::run();
        S114_BankSeeder::run();
        S115_ReceipttypeSeeder::run();
        S116_DespatcheSeeder::run();

        S301_AccountHeadsSeeder::run();

//        S401_CompanySeeder::run();
//        S403_ContactSeeder::run();
//        S404_ProductSeeder::run();
//        S405_OrderSeeder::run();
//        S406_StyleSeeder::run();
    }
}
