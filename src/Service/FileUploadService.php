<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploadService
{
    public function __construct(
        private SluggerInterface $slugger,

    ){

    }

    public function upload(File $file, string $uploadDir): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalName);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        if (!is_dir($uploadDir)){
            mkdir($uploadDir, 0755, true);
        }
        //TODO: add Crop images
        $file->move($uploadDir, $newFilename);

        return $newFilename;
    }

    public function get(string $fileName, string $uploadDir): bool|string
    {
        $filePath = $uploadDir . '/' . $fileName;
        return file_get_contents($filePath);
    }

    public function get64(string $fileName, string $uploadDir): string
    {
        $filePath = $uploadDir . '/' . $fileName;
        $file = file_get_contents($filePath);
        return base64_encode($file);
    }

}