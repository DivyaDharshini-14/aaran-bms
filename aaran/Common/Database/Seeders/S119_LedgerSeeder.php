<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Ledger;
use Illuminate\Database\Seeder;

class S119_LedgerSeeder extends Seeder
{
    public static function run(): void
    {
        Ledger::create([
            'vname' => '-',
            'active_id' => '1'
        ]);

        Ledger::create([
            'vname' => 'Auto Charges',
            'active_id' => '1'
        ]);
    }
}
