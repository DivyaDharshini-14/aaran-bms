<?php

namespace Aaran\AccountMaster\Database\Seeders;

use Aaran\AccountMaster\Models\LedgerGroup;
use Illuminate\Database\Seeder;

class S302_LedgerGroupSeeder extends Seeder
{
    public function run(): void
    {
        LedgerGroup::create([
            'vname'=>'',
            'description'=>'-',
            'account_head_id'=>'1',
            'opening'=>'0',
            'opening_date'=>'2025-01-01',
            'current'=>'0',
            'active_id'=>'1',
            'user_id'=>'1',
        ]);
    }
}
