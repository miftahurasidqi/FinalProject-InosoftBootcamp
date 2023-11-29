<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class InternalOnlyNotes extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'internal_only_notes';

    protected $fillable = [
        'uploadBy',
        'time',
        'note',
    ];
    public function thirdPartyInstruction()
    {
        return $this->belongsTo(ThirdPartyInstruction::class, 'third_party_instruction_id');
    }

}
