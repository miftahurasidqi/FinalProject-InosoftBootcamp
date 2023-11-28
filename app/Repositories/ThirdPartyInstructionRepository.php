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
                'id' => $newInstruction['_id'],
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
        try {
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
                    'status'
                ]);

            $size = count($instructions);
            $totalData = ThirdPartyInstruction::whereIn('status', $status)->count();
            $totalPages = ceil($totalData / $perPage);

            return [
                'success' => true,
                'instructions' => $instructions,
                'page' => [
                    'size' => $size,
                    'totalData' => $totalData,
                    'totalPages' => $totalPages,
                    'currrentPage' => $page,
                ],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

    public function getInstructionByIdRepo($id)
    {
        $instruction = ThirdPartyInstruction::with('vendorInvoice')->find($id);

        if ($instruction) {
            return response()->json($instruction);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function deleteById($id)
    {
        $instruction = ThirdPartyInstruction::find($id);
        if ($instruction) {
            $instruction->delete();
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function searchInstructions($page, $status, $keyword)
    {

        // Melakukan pencarian menggunakan filter regex
        $instruction = ThirdPartyInstruction::where('status', $status)
            ->where(function ($query) use ($keyword) {
                $query->where('field1', 'like', '%' . $keyword . '%')
                    ->orWhere('field2', 'like', '%' . $keyword . '%')
                    ->orWhere('field3', 'like', '%' . $keyword . '%');
            })
            ->get();

        return response()->json($instruction);
    }

    public function setToCanceled($id, $statusInfo)
    {
        $instruction = ThirdPartyInstruction::find($id);
        if ($instruction) {
            $instruction->status = 'cancelled';
            $instruction->save();
            $instruction->statusInfo()->create($statusInfo);

            return response()->json(['message' => 'Canceled successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function setToCompleted($id)
    {
        $instruction = ThirdPartyInstruction::where('_id', $id);
        return response()->json($instruction);
    }
}
