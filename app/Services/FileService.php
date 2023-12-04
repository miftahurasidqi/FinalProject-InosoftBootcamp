<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveSingleFile($file)
    {
        // $file->validate(    'required|mimes:pdf,doc,docx|max:2048',
        // );
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/uploads', $fileName);
        // $fileName = time() . '_' . $file->getClientOriginalName();
        // $path = 'uploads';
        // $file->move(public_path($path), $fileName);

        return [
            'name' => $fileName,
            'path' => $path,
        ];
    }

    public function saveMultipleFile($files)
    {
        $dataFile = [];
        foreach ($files as $index => $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $fileName);

            // $path = 'uploads';
            // $fileName = time() . '_' . $file->getClientOriginalName();
            // $file->move(public_path($path), $fileName);

            $dataFile[] = [
                'name' => $fileName,
                'path' => $path,
            ];
        }

        return $dataFile;
    }

    public function removeSingleFile($file)
    {
        Storage::delete($file['path']);
    }

    public function removeMultipleFile($files)
    {
        foreach ($files as $index => $file) {
            Storage::delete($file['path']);

        }
    }

    public function downloadFile($filename)
    {
        // Ambil path lengkap file dari penyimpanan Laravel
        $path = storage_path('app/public/' . $filename);

        // Validasi bahwa file ada sebelum diunduh
        if (!Storage::exists('public/' . $filename)) {
            abort(404);
        }

        // Mengatur header untuk respons HTTP
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Mengembalikan file sebagai respons HTTP
        return response()->download($path, $filename, $headers);
    }

}

// https: //pemburukode.com/cara-export-ke-excel-di-laravel-dari-query-builder/#cara-instal-library-laravel-excel-maatwebsite
