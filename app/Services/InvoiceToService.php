<?php

namespace App\Services;

use App\Repositories\InvoiceToRepository;
use Illuminate\Support\Facades\Validator;

class InvoiceToService
{
    protected $invoicetoRepository;

    public function __construct(InvoiceToRepository $invoicetoRepository)
    {
        $this->invoicetoRepository = $invoicetoRepository;
    }

    public function createInvoiceTo($data): String
    {
        $validator = Validator::make($data, [
            'invoiceTo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->invoicetoRepository->store($data);

            return response()->json(['Create New Invoice To Success' => true, 'data' => $result], 200);
        }

        return $this->invoicetoRepository->store($data);
    }

    public function getAll()
    {
        return $this->invoicetoRepository->all();
    }

    public function getOne($id)
    {
        $result =  $this->invoicetoRepository->getById($id);
        // var_dump($result);
        // die();
        if (!$result) {
            return response()->json(['Data Tidak Ditemukan' => true, 'data' => $result], 404);
        } else {
            return response()->json(['Data Ditemukan' => true, 'data' => $result], 200);
        }
    }

    public function update($id, $data)
    {
        $validator = Validator::make($data, [
            'invoiceTo' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->invoicetoRepository->update($id, $data);

            if ($result) {
                return response()->json(['Update Invoice To Success' => true, 'data' => $result], 200);
            } else {
                return response()->json(['error' => 'Invoice To not found.'], 404);
            }
        }
    }

    public function delete($id)
    {
        $result =  $this->invoicetoRepository->destroy($id);

        if ($result) {
            return response()->json(['Deleted Invoice To Success' => true, 'id' => $result], 200);
        } else {
            return response()->json(['error' => 'Invoice To not found.'], 404);
        }
    }
}
