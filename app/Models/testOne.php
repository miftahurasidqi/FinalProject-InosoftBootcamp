<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class testOne extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'testOne';

    protected $fillable = ['bio', 'avatar'];
}
