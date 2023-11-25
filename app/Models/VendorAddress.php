<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class VendorAddress extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'vendor_addresses';

    protected $fillable = [

        'vendorAddress'
    ];
}
