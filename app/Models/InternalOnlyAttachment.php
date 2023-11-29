<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class InternalOnlyAttachment extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'internal_only_attachment';

    protected $fillable = [
        'uploadBy',
        'time',
        'file',
    ];
    public function thirdPartyInstruction()
    {
        return $this->belongsTo(ThirdPartyInstruction::class, 'third_party_instruction_id');
    }

}
