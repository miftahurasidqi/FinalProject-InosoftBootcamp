<?php

namespace App\Repositories;

use App\Models\InternalOnlyAttachment;
use App\Models\ThirdPartyInstruction;

class InternalAttachmentRepository
{
    protected $thirdpartyinstruction;

    public function __construct(
        InternalOnlyAttachment $internalOnlyAttachment,
        ThirdPartyInstruction $thirdpartyinstruction,
    ) {
        $this->internalOnlyAttachment = $internalOnlyAttachment;
        $this->thirdpartyinstruction = $thirdpartyinstruction;
    }

    public function create($id, $attachment)
    {
        try {
            $instruction = $this->thirdpartyinstruction->find($id);
            if (!$instruction) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            // return [$instruction];
            $currentTime = time();
            $time = date("d/m/y, h:i A", $currentTime);

            $instruction->internalOnlyAttachment()->create([
                'uploadBy' => 'User 1',
                'time' => $time,
                'file' => $attachment,
            ]);

            return [
                'success' => true,
                'message' => 'Upload successfully',
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
            $internalAttachment = $this->internalOnlyAttachment->find($id);
            if (!$internalAttachment) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            // delete file
            $file = $internalAttachment->file;
            $this->fileService->removeSingleFile($file);

            $internalAttachment->delete();
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

        // return response()->json($id);
    }

}
