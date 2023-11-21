<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class test extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'test';
    // protected $primaryKey = '_id';


    protected $fillable = [
        'instractionType',
        'assignedVendor',
    ];

    public function testOne()
    {
        return $this->embedsOne(testOne::class);
    }
    public function testTwo()
    {
        return $this->hasMany(testTwo::class);
    }
}
