<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CostDetail extends Eloquent
 {
    protected $connection = 'mongodb';
    protected $collection = 'cost_details';

    protected $fillable = [
        'costItems',
        'grandTotal',
        'attachment',
        'notes'
    ];

    // protected $casts = [
    //     'costItems' => 'array',
    //     'grandTotal' => 'array',
    //     'attachment' => 'array'
    // ];
}

// class CostItem extends Eloquent
// {
//     protected $connection = 'mongodb';
//     protected $collection = 'cost_items';

//     protected $fillable = [
//         'description',
//         'QTY',
//         'UOM',
//         'unitPrice',
//         'GST',
//         'currency',
//         'vatAmount',
//         'subTotal',
//         'total',
//         'chargeTo'
// ];

//     protected $casts = [
//         'QTY' => 'integer',
//         'unitPrice' => 'float',
//         'GST' => 'float',
//         'vatAmount' => 'float',
//         'subTotal' => 'float',
//         'total' => 'float'
// ];
// }

// class GrandTotal extends Eloquent
// {
//     protected $connection = 'mongodb';
//     protected $collection = 'grand_totals';

//     protected $casts = [
//         'currency' => 'string',
//         'vatAmount' => 'float',
//         'subTotal' => 'float',
//         'total' => 'float'
// ];
// }