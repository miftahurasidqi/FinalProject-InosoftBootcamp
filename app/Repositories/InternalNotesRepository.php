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
        $this->internalOnlyNotes = $internalOnlyNotes;
    }

    public function create($id, $note)
    {

        try {
            $instruction = $this->thirdpartyinstruction->find($id);
            if (!$instruction) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            // return [$instruction];
            $currentTime = time();
            $time = date("d/m/y, h:i A", $currentTime);

            $ins = $instruction->internalOnlyNotes()->create([
                'uploadBy' => 'User 1',
                'time' => $time,
                'note' => $note,
            ]);

            return [
                'success' => true,
                'message' => 'Add Note successfully',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }

    }
    public function update($id, $note)
    {
        try {
            $findNote = $this->internalOnlyNotes->find($id);
            if (!$findNote) {
                return ['message' => 'Data not found'];
            }
            $currentTime = time();
            $time = date("d/m/y, h:i A", $currentTime);

            $findNote->update([
                'uploadBy' => 'User 1',
                'time' => $time,
                'note' => $note,
            ]);

            return [
                'success' => true,
                'message' => 'Update Note successfully',
                'note' => $note,
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }

    }
    public function delete($id)
    {
        try {
            $findNote = $this->internalOnlyNotes->find($id);
            if (!$findNote) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            $findNote->delete();

            return [
                'success' => true,
                'message' => 'Delete successfully',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

}
