<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class InvoiceTo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'invoice_tos';

    protected $fillable = [

        'invoiceTo'
    ];
}
