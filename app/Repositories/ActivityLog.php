<?php

namespace App\Repositories;

use App\Models\ActivityLog;

class ActivityLogRepository
{
    protected $thirdpartyinstruction;

    public function __construct(

        ActivityLog $activityLog,
    ) {

        $this->activityLog = $activityLog;
    }

    public function createActivityLog($id, $activityName)
    {
        try {
            $currentTime = time();
            $date = date("d/m/y", $currentTime);

            $newLog = $this->activityLog->create([
                'activityName' => $activityName,
                'date' => $date,
                'user' => 'User 1',
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

    public function deleteActivityLog($id, $activityName)
    {
        try {
            $findLog = $this->activityLog->find($id);
            if (!$findLog) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            $findLog->delete();

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

}
