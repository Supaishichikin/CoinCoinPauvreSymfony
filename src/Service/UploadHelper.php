<?php
namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadHelper
{
    private string $projectDir;
    const ANNONCE_IMAGE = 'image/uploads/annonce_image';

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    public function uploadAnnonceImage(UploadedFile $file): string
    {
        $destination = $this->projectDir . self::ANNONCE_IMAGE;
        $originalFilename = $file->getClientOriginalName();
        $baseFileName = pathinfo($originalFilename, PATHINFO_FILENAME);
        $fileName = Urlizer::urlize($baseFileName) . '_' . uniqid() . '.' . $file->guessExtension();
        $file->move($destination, $fileName);

        return $fileName;
    }
}