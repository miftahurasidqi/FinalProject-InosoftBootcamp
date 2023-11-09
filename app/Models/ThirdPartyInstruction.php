<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class ThirdPartyInstruction extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'third_party_instructions';

    protected $fillable = [
        'instructionType',
        'linkTo',
        'attentionOf',
        'invoiceTo',
        'assignedVendor',
        'vendorAddress',
        'vendorQuotationNo',
        'customer',
        'NoCustomerPO',
        'status',
        'costDetail'
    ];

    protected $casts = [
        'linkTo' => 'array',
        'costDetail' => 'array'
    ];
}
