<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class LinkTo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'link_tos';

    protected $fillable = [

        'linkTo'
    ];
}
