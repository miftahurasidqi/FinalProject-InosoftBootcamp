<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VendorInvoice extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'vendor_infoice';

    protected $fillable = [
        'invoiceNumber',
        'invoiceAttachment',
        'suportingDocument'
        
    ];

    protected $casts = [
        'suportingDocument' => 'array'
    ];
}
