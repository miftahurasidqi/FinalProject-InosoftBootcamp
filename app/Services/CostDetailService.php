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

    public function store($data): Object
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        return $this->costdetailRepository->store($data);
    }
}
