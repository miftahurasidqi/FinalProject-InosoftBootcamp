<?php

namespace App\Services;

class FileService
{
    public function handleSinggelFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = 'uploads';
        $file->move(public_path($path), $fileName);

        return [
            'name' => $fileName,
            'path' => $path,
        ];
    }
    public function handleMultipleFile($files)
    {
        $dataFile = [];
        foreach ($files as $index => $file) {
            $path = 'uploads';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($path), $fileName);
            $dataFile[] = [
                'name' => $fileName,
                'path' => $path,
            ];
        }

        return $dataFile;
    }

}
