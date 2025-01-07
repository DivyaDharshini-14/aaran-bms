<?php

use Aaran\Aadmin\Src\Customise;
use Aaran\Aadmin\Src\SaleEntry;

return [

    'customise' => [
        Customise::common(),
        Customise::master(),
        Customise::entries(),
        Customise::core(),
        Customise::blog(),
        Customise::gstapi(),
        Customise::transaction(),
//        Customise::demodata(),
//        Customise::taskManager(),
//        Customise::exportsales(),
        Customise::report(),
        Customise::accounts(),
//        Customise::logbooks(),
    ],

    'SalesEntry' => [
        SaleEntry::order(),
        SaleEntry::Po_no(),
        SaleEntry::Dc_no(),
//        SaleEntry::billingAddress(),
//        SaleEntry::shippingAddress(),
//        SaleEntry::style(),
//        SaleEntry::despatch(),
        SaleEntry::transport(),
        SaleEntry::destination(),
        SaleEntry::bundle(),
//        SaleEntry::einvoice(),
        SaleEntry::eway(),

        SaleEntry::productDescription(),
//        SaleEntry::colour(),
//        SaleEntry::size(),

    ],


];
