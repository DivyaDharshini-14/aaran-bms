<?php

namespace Aaran\AccountMaster\Database\Seeders;

use Aaran\AccountMaster\Models\AccountHeads;
use Illuminate\Database\Seeder;

class S301_AccountHeadsSeeder extends Seeder
{
    public static function run(): void
    {
        foreach (self::vData() as $head) {

            AccountHeads::create([
                'vname' => $head,
                'description' => ucfirst($head),
                'opening' => '0',
                'opening_date' => '2024-04-01',
                'current' => '0',
                'active_id' => '1',
                'user_id' => '1',
            ]);
        }
    }

    private function vData()
    {
        return [
            'CAPITAL ACCOUNT',
            'CURRENT ASSETS',
            'CURRENT LIABILITIES',
            'DIRECT EXPENSE',
            'INDIRECT EXPENSE',
            'INDIRECT INCOMES',
            'INVESTMENTS',
            'LOANS AND LIABILITIES',
            'PURCHASES ACCOUNT',
            'SALES ACCOUNT',
            'SUSPENSE ACCOUNT',
        ];
    }

}
