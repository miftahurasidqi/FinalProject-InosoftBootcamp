<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class CostDetail extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'cost_details';

    protected $fillable = [
        'costItem',
        'grandTotal',
        'notes'
    ];

    protected $casts = [
        'costItem' => 'array',
        'grandTotal' => 'array'
    ];


    public function costItem()
    {
        return $this->hasMany(CostItem::class, '_id', 'costItem');
    }

    public function grandTotal()
    {
        return $this->hasMany(GrandTotal::class, '_id', 'grandTotal');
    }
}

class CostItem extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'cost_items';

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
        'QTY' => 'integer',
        'unitPrice' => 'float',
        'GST' => 'float',
        'vatAmount' => 'float',
        'subTotal' => 'float',
        'total' => 'float'
    ];
}

class GrandTotal extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'grand_totals';

    protected $casts = [
        'currency' => 'string',
        'vatAmount' => 'float',
        'subTotal' => 'float',
        'total' => 'float'
    ];
}
