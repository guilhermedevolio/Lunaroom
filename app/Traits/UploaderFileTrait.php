<?php


namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Nonstandard\Uuid;

trait UploaderFileTrait
{
    public function upload(string $path, $file): string
    {
        $fileName = Uuid::uuid4()->toString() . '.' . $file->extension();

        Storage::disk('public')->putFileAs($path, $file, $fileName);

        return $fileName;
    }

    public function delete(string $path, $fileName)
    {
        Storage::disk('public')->delete($path . $fileName);
    }
}
