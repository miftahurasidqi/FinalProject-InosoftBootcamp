<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class ThirdPartyInstruction extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'third_party_instructions';
    // protected $primaryKey = '_id';


    protected $fillable = [
        'instractionType',
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

        'instractionType' => 'array',
        'costDetail' => 'array'
    ];

    // public function invoice_tos()
    // {
    //     return $this->hasMany(InvoiceTo::class, 'third_party_instruction_id', '_id');
    // }

    // public function costDetail()
    // {
    //     return $this->belongsTo(CostDetail::class, 'costDetail');
    // }
    public function costDetail()
    {
        return $this->hasMany(CostDetail::class);
    }
}
