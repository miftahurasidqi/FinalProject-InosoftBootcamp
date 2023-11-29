<?php

namespace App\Services;

use App\Repositories\InternalAttachmentRepository;
use App\Repositories\InternalNotesRepository;

class InternalOnlyService
{
    protected $internalAttachmentRepository;
    protected $internalNoteRepository;

    public function __construct(
        InternalAttachmentRepository $internalAttachmentRepository,
        InternalNotesRepository $internalNoteRepository,
    ) {
        $this->internalAttachmentRepository = $internalAttachmentRepository;
        $this->internalNoteRepository = $internalNoteRepository;
    }

    public function addAttachment($id)
    {
        return response()->json($id);
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
