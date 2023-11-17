<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class AssignedVendor extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'assigned_vendors';

    protected $fillable = [

        'assignedVendor'
    ];
}
