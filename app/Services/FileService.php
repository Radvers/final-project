<?php

namespace App\Services;

use App\Models\File;

/**
 * Class FileService
 * @package App\Services
 */
class FileService
{
    /**
     * @var File
     */
    private $file;

    /**
     * FileService constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file =$file;
    }

    /**
     * Store file and return src to file
     * @param array $data
     * @return string
     */
    public function store(array $data):string
    {
        if (array_key_exists('file', $data)) {
            $file = $data['file'];
            $path = storage_path('files') . '\\';
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $name);
            return $path . $name;
        }
        return 'empty';
    }

    /**
     * @param string $src
     */
    public function deleteFile(string $src)
    {
        unlink($src);
    }

    /**
     * @param int $id
     */
    public function deleteModel(int $id)
    {
        $this->file->where('id',$id)->delete();
    }

    /**
     * @param string $src
     * @return mixed
     */
    public function read(string $src)
    {
        return response()->download($src);
    }
}