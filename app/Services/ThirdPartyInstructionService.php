<?php

namespace App\Services;

use App\Repositories\ThirdPartyInstructionRepository;

class ThirdPartyInstructionService
{
    protected $thirdPartyInstructionRepository;

    public function __construct(ThirdPartyInstructionRepository $thirdPartyInstructionRepository)
    {
        $this->thirdPartyInstructionRepository = $thirdPartyInstructionRepository;
    }

    public function getOpenByUserId($user_id)
    {
        return $this->thirdPartyInstructionRepository->getOpenDatasByUserId($user_id);
    }

    public function getCompletedByUserId($user_id)
    {
        return $this->thirdPartyInstructionRepository->getCompletedDatasByUserId($user_id);
    }

    public function findOpen($user_id, $keyword)
    {
        return $this->thirdPartyInstructionRepository->findOpenTab($user_id, $keyword);
    }

    public function findCompleted($user_id, $keyword)
    {
        return $this->thirdPartyInstructionRepository->findCompletedTab($user_id, $keyword);
    }

    public function store($data)
    {
        return $this->todoRepository->store($data);
    }

    public function update($todo, $update)
    {
        $updated = $todo->fill($update);
        return $this->todoRepository->updated($updated);
    }
}