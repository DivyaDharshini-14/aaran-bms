<?php

namespace Aaran\AccountMaster\Database\Seeders;

use Aaran\AccountMaster\Models\Ledger;
use Illuminate\Database\Seeder;

class S303_LedgerSeeder extends Seeder
{
    public function run(): void
    {
        Ledger::create([
            'vname'=>'',
            'description'=>'-',
            'opening'=>'0',
            'opening_date'=>'2025-01-01',
            'current'=>'0',
            'active_id'=>'1',
            'user_id'=>'1',
        ]);
    }
}
