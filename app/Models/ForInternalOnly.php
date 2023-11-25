<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ForInternalOnly extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'for_internal_only';

    protected $fillable = [
        'intrnalAttachment',
        'internalNotes'
        
    ];

    protected $casts = [
        'intrnalAttachment' => 'array'
    ];
}
