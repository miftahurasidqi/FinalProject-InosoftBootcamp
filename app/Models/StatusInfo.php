<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class StatusInfo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'status_info';

    protected $fillable = [
        'canceledBy',
        'description',
        'canceledAttachment',
        
    ];

    protected $casts = [
        'canceledAttachment' => 'array'
    ];
}
