<?php

namespace App\Services;

use App\Repositories\LinkToRepository;
use Illuminate\Support\Facades\Validator;

class LinkToService
{
    protected $linktoRepository;

    public function __construct(LinkToRepository $linktoRepository)
    {
        $this->linktoRepository = $linktoRepository;
    }

    public function createLinkTo($data): String
    {
        $validator = Validator::make($data, [
            'linkTo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->linktoRepository->store($data);

            return response()->json(['Create New Link To Success' => true, 'data' => $result], 200);
        }

        return $this->linktoRepository->store($data);
    }

    public function getAll()
    {
        return $this->linktoRepository->all();
    }

    public function getOne($id)
    {
        $result =  $this->linktoRepository->getById($id);
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
            'linkTo' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->linktoRepository->update($id, $data);

            if ($result) {
                return response()->json(['Update Link To Success' => true, 'data' => $result], 200);
            } else {
                return response()->json(['error' => 'Link To not found.'], 404);
            }
        }
    }

    public function delete($id)
    {
        $result =  $this->linktoRepository->destroy($id);

        if ($result) {
            return response()->json(['Deleted Link To Success' => true, 'id' => $result], 200);
        } else {
            return response()->json(['error' => 'Link To not found.'], 404);
        }
    }
}
