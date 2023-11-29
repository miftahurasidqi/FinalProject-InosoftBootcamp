<?php

namespace App\Http\Controllers;

use App\Services\InternalOnlyService;
use Illuminate\Http\Request;

class InternalOnlyController extends Controller
{
    protected $internalOnly;

    public function __construct(InternalOnlyService $internalOnly)
    {
        $this->internalOnly = $internalOnly;
    }

    public function addAttachment(Request $request, $id)
    {
        $file = $request->file('internalAttachment');
        return response()->json([$id, $file]);

        // return $this->internalOnly->addAttachment($id);
    }

    public function deleteAttachment($id)
    {
        return response()->json([$id]);
    }

    public function addNote(Request $request, $id)
    {
        return response()->json([$id]);
    }

    public function editNote(Request $request, $id)
    {
        return response()->json([$id]);
    }

    public function deleteNote(Request $request, $id)
    {
        return response()->json([$id]);
    }
}
