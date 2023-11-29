<?php

namespace App\Repositories;

use App\Models\InternalOnlyNotes;
use App\Models\ThirdPartyInstruction;

class InternalNotesRepository
{
    protected $thirdpartyinstruction;

    public function __construct(
        ThirdPartyInstruction $thirdpartyinstruction,
        InternalOnlyNotes $internalOnlyNotes,
    ) {
        $this->thirdpartyinstruction = $thirdpartyinstruction;
    }

    public function create($id)
    {
        return response()->json($id);
    }
    public function update($id)
    {
        return response()->json($id);
    }
    public function delete($id)
    {
        return response()->json($id);
    }

}
