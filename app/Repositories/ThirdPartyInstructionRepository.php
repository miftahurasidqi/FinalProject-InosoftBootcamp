<?php

namespace App\Repositories;

use App\Models\CostDetail;
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
        $costDetail = $data['costDetail'];

        unset($data['costDetail']);
        if ($data['instructionType'] == 'Service Instruction') {
            $data['instructionID'] = 'SI-' . time();
        } else {
            $data['instructionID'] = 'LI-' . time();
        }

        try {
            $newData = new $this->thirdpartyinstruction($data);
            $newData->save();

            $newData->costDetail()->create([
                'costItems' => $costDetail['costItems'],
                'grandTotal' => $costDetail['grandTotal'],
                'attachment' => $costDetail['attachment'],
                'notes' => $costDetail['notes'],
            ]);
            $newInstruction = $newData->fresh();

            return [
                'success' => true,
                'id' => $newInstruction['_id'], // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
                // 'costDetail' => $costItems, // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database

            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

    public function getByStatus($page, $status)
    {

        $perPage = 10;
        $skip = ($page - 1) * $perPage;

        $instructions = ThirdPartyInstruction::whereIn('status', $status)
            ->skip($skip)
            ->limit($perPage)
            ->get([
                'instructionID',
                'linkTo',
                'instructionType',
                'assignedVendor',
                'attentionOf',
                'vendorAddress',
                'invoiceTo',
                'vendorQuotationNo',
                'customerContract',
                'NoCustomerPO',
                'status']);

        $size = count($instructions);
        $totalData = ThirdPartyInstruction::whereIn('status', $status)->count();
        $totalPages = ceil($totalData / $perPage);

        $response = [
            'instructions' => $instructions,
            'page' => [
                'size' => $size,
                'totalData' => $totalData,
                'totalPages' => $totalPages,
                'currrentPage' => $page,
            ],
        ];

        return response()->json($response);
    }
// ====
    public function searchInstruction($user_id, $keyword)
    {
        return $this->thirdpartyinstruction->where('user_id', $user_id)->where('status', 'Draft' && 'In Progress')->where('keyword', $keyword)->first();
    }

    public function findCompletedTab($user_id, $keyword)
    {
        return $this->thirdpartyinstruction->where('user_id', $user_id)->where('status', 'Canceled' && 'Completed')->where('keyword', $keyword)->first();
    }

    public function updated($updated)
    {
        return $updated->save();
    }
}
