<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait DocumentTrait
{
    /**
     * Store a base64 encoded PDF file.
     *
     * @param string $base64String The base64 encoded PDF string.
     * @param string $storagePath The storage path where the file should be stored.
     * @return string The URL path to the stored file.
     */
    public function storeBase64File(string $base64String, string $storagePath): string
    {
    // Decode the base64 string
   // Decode the base64 string
   $decodedFile = base64_decode($base64String);

   // Detect the file type and generate a proper file extension
   $finfo = new \finfo(FILEINFO_MIME_TYPE);
   $mimeType = $finfo->buffer($decodedFile);
   $extension = $this->getFileExtension($mimeType);

   // Generate a unique file name with the correct extension
   $fileName = Str::random(10) . '.' . $extension;

   // Create the full path within the storage directory
   $filePath = $storagePath . '/' . $fileName;

   // Store the file in Laravel's public storage disk
   Storage::disk('public')->put($filePath, $decodedFile);

   // Return the URL to the stored file with the correct storage prefix
   return '/storage/' . $filePath;
}

/**
* Get the file extension based on the MIME type.
*
* @param string $mimeType The MIME type of the file.
* @return string The file extension.
*/
private function getFileExtension(string $mimeType): string
{
   // Define a mapping of MIME types to file extensions
   $mimeTypes = [
       'application/pdf' => 'pdf',
       'application/msword' => 'doc',
       'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
       'image/jpeg' => 'jpg',
       'image/png' => 'png',
       'image/webp' => 'webp',
       // Add more MIME types and corresponding extensions as needed
   ];

   // Return the file extension if found, otherwise return 'bin'
   return $mimeTypes[$mimeType] ?? 'bin';
}
}
