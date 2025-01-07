<?php

namespace Database\Seeders;

use Aaran\Common\Database\Seeders\S101_LabelSeeder;
use Aaran\Common\Database\Seeders\S102_CommonSeeder;
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

        S401_CompanySeeder::run();
        S403_ContactSeeder::run();
        S404_ProductSeeder::run();
        S405_OrderSeeder::run();
        S406_StyleSeeder::run();
    }
}
