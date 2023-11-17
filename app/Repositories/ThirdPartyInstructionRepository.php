<?php

namespace App\Repositories;

use App\Models\ThirdPartyInstruction;

class ThirdPartyInstructionRepository
{
    protected $thirdpartyinstruction;

    public function __construct(ThirdPartyInstruction $thirdpartyinstruction)
    {
        $this->thirdpartyinstruction = $thirdpartyinstruction;
    }

    public function createInstructionRepository(array $data): array
    {
        try {
            $newData = new $this->thirdpartyinstruction($data);
            $newData->save();

            return [
                'success' => true,
                'data' => $newData->fresh(), // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function getOpenDatasByUserId($user_id): Object
    {
        return $this->thirdpartyinstruction->where('user_id', $user_id)->where('status', 'Draft' && 'In Progress')->get(['instructionID', 'linkTo', 'instructionType', 'assignedVendor', 'attentionOf', 'quotationNo', 'customerPO', 'status']);
    }

    public function getCompletedDatasByUserId($user_id): Object
    {
        return $this->thirdpartyinstruction->where('user_id', $user_id)->where('status', 'Canceled' && 'Completed')->get(['instructionID', 'linkTo', 'instructionType', 'assignedVendor', 'attentionOf', 'quotationNo', 'customerPO', 'status']);
    }

    public function findOpenTab($user_id, $keyword)
    {
        return $this->thirdpartyinstruction->where('user_id', $user_id)->where('status', 'Draft' && 'In Progress')->where('keyword', $keyword)->first();
    }

    public function findCompletedTab($user_id, $keyword)
    {
        return $this->thirdpartyinstruction->where('user_id', $user_id)->where('status', 'Canceled' && 'Completed')->where('keyword', $keyword)->first();
    }

    // public function store($data)
    // {
    //     $newData = new $this->todo;
    //     $newData->title = $data['title'];
    //     $newData->description = $data['description'];
    //     $newData->user_id = $data['user_id'];
    //     $newData->save();
    //     return $newData->fresh();
    // }

    public function updated($updated)
    {
        return $updated->save();
    }
}
