<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Category;
use Illuminate\Database\Seeder;

class S109_CategorySeeder extends Seeder
{
    public static function run(): void
    {
        Category::create([
            'vname' => '-',
            'active_id' => '1'
        ]);
    }
}

