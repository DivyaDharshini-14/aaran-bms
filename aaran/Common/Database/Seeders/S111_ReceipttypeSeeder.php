<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Receipttype;
use Illuminate\Database\Seeder;

class S111_ReceipttypeSeeder extends Seeder
{
    public static function run(): void
    {
        Receipttype::create([
            'vname' => '-',
            'active_id' => '1'
        ]);


        Receipttype::create([
            'vname' => 'Cash',
            'active_id' => '1'
        ]);

        Receipttype::create([
            'vname' => 'Cheque',
            'active_id' => '1'
        ]);

        Receipttype::create([
            'vname' => 'PhonePe',
            'active_id' => '1'
        ]);

        Receipttype::create([
            'vname' => 'GPay',
            'active_id' => '1'
        ]);

        Receipttype::create([
            'vname' => 'RTGS',
            'active_id' => '1'
        ]);

        Receipttype::create([
            'vname' => 'NEFT',
            'active_id' => '1'
        ]);
    }
}
