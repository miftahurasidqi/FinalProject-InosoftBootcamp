<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class InvoiceTo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'invoice_tos';
    // protected $primaryKey = '_id';


    protected $fillable = [

        'invoiceTo'
    ];

    public function third_party_instruction()
    {
        return $this->belongsTo(ThirdPartyInstruction::class, 'third_party_instruction_id', '_id');
    }
}
