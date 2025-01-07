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
        Customise::exportSales(),
        Customise::report(),
        Customise::logbooks(),
        Customise::accounts(),
    ],

    'SalesEntry' => [
        SaleEntry::order(),
        SaleEntry::billingAddress(),
        SaleEntry::shippingAddress(),
        SaleEntry::style(),
//        SaleEntry::despatch(),
        SaleEntry::transport(),
        SaleEntry::destination(),
        SaleEntry::bundle(),
        SaleEntry::einvoice(),
//        SaleEntry::eway(),

        SaleEntry::productDescription(),
        SaleEntry::colour(),
        SaleEntry::size(),

    ],
];
