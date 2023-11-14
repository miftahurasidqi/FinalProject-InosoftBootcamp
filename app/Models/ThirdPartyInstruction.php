<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class ThirdPartyInstruction extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'third_party_instructions';

    protected $fillable = [
        'linkTo',
        'assignedVendor',
        'attentionOf',
        'vendorAddress',
        'invoiceTo',
        'vendorQuotationNo',
        'customerContract',
        'NoCustomerPO',
        'status',
    ];

    protected $casts = [
        'costDetail' => 'array'
    ];

    public function invoiceTo()
    {
        return $this->belongsTo(InvoiceTo::class, 'invoiceTo');
    }
}
