<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VendorInvoice extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'vendor_infoice';

    protected $fillable = [
        'third_party_instruction_id',
        'invoiceNumber',
        'invoiceAttachment',
        'suportingDocument',
    ];

    protected $casts = [
        'suportingDocument' => 'array',
    ];
    public function thirdPartyInstruction()
    {
        return $this->belongsTo(ThirdPartyInstruction::class, 'third_party_instruction_id');
    }
}
