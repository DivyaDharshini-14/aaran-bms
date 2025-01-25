<?php

namespace Aaran\Master\Database\Seeders;

use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Illuminate\Database\Seeder;

class S403_ContactSeeder extends Seeder
{
    public static function run(): void
    {
        Contact::create([
            'ledger_id'=>'1',
            'vname'=>'XYZ company-list pvt ltd',
            'mobile'=>'-',
            'whatsapp'=>'-',
            'contact_person'=>'-',
            'contact_type_id'=>'1',
            'email'=>'some@some.com',
            'gstin'=>'29AWGPV7107B1Z1',
            'msme_no'=>'123456789',
            'msme_type_id'=>'1',
            'opening_balance'=>'0',
            'outstanding'=>'0',
            'effective_from'=>'0',
            'active_id'=>'1',
            'user_id'=>'1',
            'company_id'=>'1',
        ]);
        ContactDetail::create([
            'contact_id'=>'1',
            'address_type'=>'1',
            'address_1'=>'7th block',
            'address_2'=>'abc layout',
            'city_id'=>'2',
            'state_id'=>'2',
            'country_id'=>'1',
            'pincode_id'=>'1',
        ]);
    }
}
