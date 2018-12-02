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
        $data = $request->validate([
            'src' => 'required',
            'id' => 'required'
        ]);
        $this->fileService->deleteFile($data['src']);
        $this->fileService->deleteModel($data['id']);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function download(Request $request)
    {
        $data = $request->validate([
            'src' => 'required'
        ]);

        return $this->fileService->read($data['src']);
    }
}