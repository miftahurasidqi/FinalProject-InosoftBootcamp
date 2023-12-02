<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\InternalOnlyService;
use Illuminate\Http\Request;

class ForInternalController extends Controller
{
    protected $internalOnly;

    public function __construct(
        InternalOnlyService $internalOnly,
        FileService $fileService
    ) {
        $this->internalOnly = $internalOnly;
        $this->fileService = $fileService;

    }

    public function addAttachment(Request $request, $id)
    {
        $file = $request->file('internalAttachment');
        if (!$file) {
            return response()->json(['error' => 'harus ada file'], 400);
        }

        $internalAttachment = $this->fileService->saveSingleFile($file);

        return $this->internalOnly->addAttachment($id, $internalAttachment);
    }

    public function deleteAttachment($id)
    {
        return response()->json([$id]);
        // return $this->internalOnly->deleteAttachment($id);
    }

    public function addNote(Request $request, $id)
    {
        return response()->json([$id]);
        // return $this->internalOnly->addNote($id, $note);
    }

    public function editNote(Request $request, $id)
    {
        return response()->json([$id]);
        // return $this->internalOnly->editNote($id, $note);
    }

    public function deleteNote(Request $request, $id)
    {
        return response()->json([$id]);
        // return $this->internalOnly->deleteNote($id);
    }
}
