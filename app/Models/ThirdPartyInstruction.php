<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ThirdPartyInstruction extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'third_party_instructions';

    protected $guarded = [];

    protected $fillable = [
        'instructionID',
        'linkTo',
        'instructionType',
        'assignedVendor',
        'attentionOf',
        'quotationNo',
        'invoiceTo',
        'customerContract',
        'vendorAddress',
        'customerPO'
    ];
}