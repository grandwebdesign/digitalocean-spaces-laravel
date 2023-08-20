<?php

namespace Grandwebdesign\DigitaloceanSpacesLaravel;

use Illuminate\Support\Facades\Storage;
use Error;

class DigitaloceanSpaces
{
    private $storage;

    /**
     * DigitalOceanSpaces Class
     * 
     * @param string|\Illuminate\Http\UploadedFile $file File Object
     * @param ?string $folder Folder to upload the file to
     * @param ?string $fileName Name to save file as
     * @param ?bool $compress Compress the file when uploading
     */
    public function __construct(
        public $file,
        public $folder = null,
        public $fileName = null,
        public $compress = false
    )
    {
        $this->storage = Storage::disk('digitalocean');
        $this->folder = (config('digitaloceanspaces.folder')? config('digitaloceanspaces.folder') . '/' : '') . $this->folder;
        if (!$this->fileName && !is_string($this->file)) {
            $this->fileName = uniqid('file-') . '.' . $this->file->getClientOriginalExtension();
        }
    }

    /**
     * Upload file to Digitalocean Spaces
     * 
     * @throws Error If cannot upload file
     * @return string
     */
    public function upload(): string
    {
        $file = $this->file;

        if ($this->compress) {
            try {
                $file = $this->compress();
            } catch (Error $e) {
                throw new Error($e->getMessage(), $e->getCode());
            }
        }

        try {
            $this->storage->putFileAs(
                $this->folder,
                $file,
                $this->fileName
            );
        } catch (Error $e) {
            throw new Error($e->getMessage(), $e->getCode());
        }

        return $this->folder . '/' . $this->fileName;
    }

    /**
     * Removes file from Digitalocean Spaces
     * 
     * @throws Error If cannot delete file
     * @return bool
     */
    public function delete()
    {
        if (!$this->storage->exists($this->file))
        {
            return true;
        }

        try {
            $this->storage->delete($this->file);
        } catch (Error $e) {
            throw new Error($e->getMessage(), $e->getCode());
        }

        return true;
    }

    private function compress()
    {
        if (!in_array($this->file->getMimeType(), $this->allowedFileTypesToCompress())) {
            throw new Error('Cannot compress '. $this->file->getMimeType(), 422);
        }

        \Tinify\setKey(config('digitaloceanspaces.tinify_key'));
        return \Tinify\fromFile($this->file)->toBuffer();
    }

    private function allowedFileTypesToCompress()
    {
        return [
            'image/jpeg',
            'image/gif',
            'image/png',
            'image/bmp',
            'image/svg+xml'
        ];
    }
}