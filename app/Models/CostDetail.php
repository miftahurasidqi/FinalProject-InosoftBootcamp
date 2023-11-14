<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class CostDetail extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'CostDetail';

    protected $fillable = [

        'description',
        'QTY',
        'UOM',
        'unitPrice',
        'GST',
        'currency',
        'vatAmount',
        'subTotal',
        'total'
    ];

    protected $casts = [
        'grandTotal' => 'array'
    ];
}
