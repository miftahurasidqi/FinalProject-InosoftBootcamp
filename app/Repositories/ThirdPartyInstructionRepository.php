<?php

namespace App\Repositories;

use App\Models\CostDetail;
use App\Models\ThirdPartyInstruction;
use App\Models\VendorInvoice;
use App\Repositories\VendorInvoiceRepository;
use App\Services\FileService;

class ThirdPartyInstructionRepository
{
    protected $thirdpartyinstruction;

    public function __construct(
        ThirdPartyInstruction $thirdpartyinstruction,
        FileService $fileService,
        VendorInvoiceRepository $vendorInvoiceRepository
    ) {
        $this->vendorInvoiceRepository = $vendorInvoiceRepository;
        $this->thirdpartyinstruction = $thirdpartyinstruction;
        $this->fileService = $fileService;

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
                    'status',
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
    // belum
    public function searchInstructions($page, $status, $keyword)
    {
        try {
            $perPage = 10;
            $skip = ($page - 1) * $perPage;

            $instructions = ThirdPartyInstruction::whereIn('status', $status)
                ->where(function ($k) use ($keyword) {
                    $k->where('linkTo', 'like', '%' . $keyword . '%')
                        ->orWhere('instructionType', 'like', '%' . $keyword . '%')
                        ->orWhere('vendorQuotationNo', 'like', '%' . $keyword . '%')
                        ->orWhere('assignedVendor', 'like', '%' . $keyword . '%')
                        ->orWhere('attentionOf', 'like', '%' . $keyword . '%')
                        ->orWhere('instructionID', 'like', '%' . $keyword . '%')
                        ->orWhere('customerContract', 'like', '%' . $keyword . '%');
                })
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
                    'status',
                ]);

            $totalData = ThirdPartyInstruction::whereIn('status', $status)
                ->where(function ($k) use ($keyword) {
                    $k->where('linkTo', 'like', '%' . $keyword . '%')
                        ->orWhere('instructionType', 'like', '%' . $keyword . '%')
                        ->orWhere('vendorQuotationNo', 'like', '%' . $keyword . '%')
                        ->orWhere('assignedVendor', 'like', '%' . $keyword . '%')
                        ->orWhere('attentionOf', 'like', '%' . $keyword . '%')
                        ->orWhere('instructionID', 'like', '%' . $keyword . '%')
                        ->orWhere('customerContract', 'like', '%' . $keyword . '%');
                })->count();

            $size = count($instructions);
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

    public function getInstructionById($id)
    {
        $instruction = ThirdPartyInstruction::with(['vendorInvoice', 'internalOnlyAttachment', 'internalOnlyNotes'])->find($id);
        // $instruction = ThirdPartyInstruction::find($id);
        // $invoice = $this->vendorInvoiceRepository->where('third_party_instruction_id', $id)->get()
        // $internalAttachment = $this->vendorInvoiceRepository->where('third_party_instruction_id', $id)->get()
        // $internalNotes = $this->vendorInvoiceRepository->where('third_party_instruction_id', $id)->get()

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
            $files = $instruction->costDetail->attachment;
            $this->fileService->removeMultipleFile($files);

            $instruction->delete();

            // delete relasi invoice
            $invoiceId = $instruction->vendorInvoice()->where('third_party_instruction_id', $id)->get(['_id']);
            if (count($invoiceId) != 0) {
                for ($i = 0; $i < count($invoiceId); $i++) {
                    $this->vendorInvoiceRepository->deleteVendorInvoice($invoiceId[$i]['_id']);
                }
            }

            // delete relasi internal attachment
            // delete relasi internal note

            // return response()->json(['files' => $invoiceId]);
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
    public function setToCanceled($id, $statusInfo)
    {

        try {
            $instruction = ThirdPartyInstruction::find($id);
            if (!$instruction) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            $instruction->statusInfo()->create($statusInfo);
            $instruction->status = 'cancelled';
            $instruction->save();
            return response()->json([
                // $instruction->fresh()
                'success' => false,
                'message' => 'Canceled successfully',
            ]);
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function setToCompleted($id)
    {
        try {
            $instruction = ThirdPartyInstruction::find($id);
            if (!$instruction) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            $invoice = VendorInvoice::where('third_party_instruction_id', $id)->count();
            if ($invoice == 0) {
                return response()->json(['message' => 'Minimal Terdapat 1 Invoice'], 400);
            }

            $instruction->status = 'completed';
            $instruction->save();

            return response()->json([
                'instruction' => $instruction->fresh(),
                'success' => false,
                'message' => 'Completed successfully',
            ]);

        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function updateInstruction($id, $editData, $attachment)
    {
        // return [
        //     $id, $editData, $attachment,
        // ];

        try {
            $deleteFile = $editData['deleteAttachment'];
            unset($editData['deleteAttachment']);

            $instruction = ThirdPartyInstruction::find($id);
            if (!$instruction) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            $lastStatus = $instruction['status'];
            $newStatus = $editData['status'];

            $lastAttachment = $instruction->costDetail->attachment;
            $newAttachment = [];

            $result = $lastAttachment;
            if (count($deleteFile) != 0) {
                for ($i = 0; $i < count($lastAttachment); $i++) {
                    foreach ($deleteFile as $file) {
                        if ($file['name'] == $lastAttachment[$i]['name']) {
                            unset($result[$i]);
                        }
                    }
                }
            }

            $newAttachment = $result + $attachment;
            $costDetail = $editData['costDetail'];
            unset($editData['costDetail']);
            $costDetail['attachment'] = $newAttachment;

            $instruction->update($editData);
            $instruction->costDetail()->create(
                [
                    'costItems' => $costDetail['costItems'],
                    'grandTotal' => $costDetail['grandTotal'],
                    'attachment' => $costDetail['attachment'],
                    'notes' => $costDetail['notes'],
                ]
            );

            return [
                'success' => true,
                'id' => $id,
                'deleteFile' => $deleteFile,
                '$lastAttachment' => $lastAttachment,
                '$lastStatus' => $lastStatus,
                '$newStatus' => $newStatus,
                '$editData' => $editData,
                '$costDetail' => $costDetail,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

}
