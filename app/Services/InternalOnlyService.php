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

    public function addAttachment($id, $file)
    {
        $result = $this->internalAttachmentRepository->create($id, $file);
        return response()->json($result);
    }

    public function deleteAttachment($id)
    {
        $result = $this->internalAttachmentRepository->delete($id);
        return response()->json($result);
    }

    public function addNote($id, $note)
    {
        $result = $this->internalNoteRepository->create($id, $note);
        return response()->json($result);
    }

    public function editNote($id, $note)
    {
        $result = $this->internalNoteRepository->update($id, $note);
        return response()->json($result);
    }

    public function deleteNote($id)
    {
        $result = $this->internalNoteRepository->delete($id);
        return response()->json($result);
    }

}
