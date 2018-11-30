<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

/**
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    /**
     * @var FileService
     */
    private $fileService;

    /**
     * FileController constructor.
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $src = $request->only('src','id');
        $this->fileService->deleteFile($src['src']);
        $this->fileService->deleteModel($src['id']);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function download(Request $request)
    {
        $src = $request->only('src');
        return $this->fileService->read($src['src']);
    }
}