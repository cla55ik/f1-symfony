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

}