<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class CustomerContract extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'customer_contracts';

    protected $fillable = [

        'customerContract'
    ];
}
