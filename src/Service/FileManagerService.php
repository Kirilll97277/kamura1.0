<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerService extends FileManagerServiceInterface
{

    private $postImageDirectory;

    public function __construct($postImageDirectory)
    {
        $this->postImageDirectory= $postImageDirectory;
    }

    public function getPostImageDirectory()
    {
        return $this->postImageDirectory;
    }

    public function imagePostRemove(string $filename)
    {
        // TODO: Implement imagePostRemove() method.
    }

    public function imagePostUpload(UploadedFile $file): string
    {
        // TODO: Implement imagePostUpload() method.
    }
}