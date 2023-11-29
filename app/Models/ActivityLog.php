<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ActivityLog extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'activity_log';

    protected $fillable = [
        'activityName',
        'user',
        'date',
    ];

    public function thirdPartyInstruction()
    {
        return $this->belongsTo(ThirdPartyInstruction::class, 'third_party_instruction_id');
    }
}
