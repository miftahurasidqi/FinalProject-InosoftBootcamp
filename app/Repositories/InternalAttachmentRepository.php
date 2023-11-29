<?php

namespace App\Repositories;

use App\Models\InternalOnlyAttachment;
use App\Models\ThirdPartyInstruction;

class InternalAttachmentRepository
{
    protected $thirdpartyinstruction;

    public function __construct(
        ThirdPartyInstruction $thirdpartyinstruction,
        InternalOnlyAttachment $internalOnlyAttachment
    ) {
        $this->thirdpartyinstruction = $thirdpartyinstruction;
    }

    public function create($id)
    {
        return response()->json($id);
    }

    public function delete($id)
    {
        return response()->json($id);
    }

}
