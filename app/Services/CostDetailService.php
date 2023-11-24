<?php

namespace App\Services;

use App\Repositories\CostDetailRepository;
use Illuminate\Support\Facades\Validator;

class CostDetailService
{
    protected $costdetailRepository;

    public function __construct(CostDetailRepository $costdetailRepository)
    {
        $this->costdetailRepository = $costdetailRepository;
    }

    public function createCostDetail(array $data)
    {
        $validator = Validator::make($data, [
            'description' => 'required|string',
            'QTY' => 'required|numeric',
            'UOM' => 'required|string',
            'unitPrice' => 'required|numeric',
            'GST' => 'required|numeric',
            'currency' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->costdetailRepository->store($data);

            return response()->json(['Create New Cost Detail Success' => true, 'data' => $result], 200);
        }

        $data['vatAmount'] = $data['unitPrice'] * ($data['gst'] / 100);
        $data['subTotal'] = $data['quantity'] * $data['unitPrice'];
        $data['total'] = $data['subTotal'] + $data['vatAmount'];



        return $this->costdetailRepository->store($data);
    }


    // public function getGrandTotal()
    // {
    //     return $this->costdetailRepository->getGrandTotal();
    // }
    public function getAll()
    {
        return $this->costdetailRepository->all();
    }

    public function getOne($id)
    {
        $result =  $this->costdetailRepository->getById($id);
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
            'customerContract' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->costdetailRepository->update($id, $data);

            if ($result) {
                return response()->json(['Update Cost Detail Success' => true, 'data' => $result], 200);
            } else {
                return response()->json(['error' => 'Cost Detail not found.'], 404);
            }
        }

        // return $validator->fails()
        //     ? response()->json(['error' => $validator->errors()], 400)
        //     : (($result = $this->costdetailRepository->update($id, $data))
        //         ? response()->json(['Update Cost Detail Success' => true, 'data' => $result], 200)
        //         : response()->json(['error' => 'Cost Detail not found.'], 404));
    }

    public function delete($id)
    {
        $result =  $this->costdetailRepository->destroy($id);

        if ($result) {
            return response()->json(['Deleted Cost Detail Success' => true, 'id' => $result], 200);
        } else {
            return response()->json(['error' => 'Cost Detail not found.'], 404);
        }
    }
}
