<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class UploadFilesController extends Controller
{
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function upLoadFiles(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,png,jpeg,pdf,docx|max:5048'
        ]);

        $destinationPath = 'public/files/items';
        $fileName = time().'_'.$request->file('file')->getClientOriginalName();

        $file = $request->file('file')->storeAs($destinationPath, $fileName);

        $uploadFile = $this->taskService->create([$file]);
        if (!$uploadFile) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Cannot upload file. Check that file type is jpg, png, jpeg, pdf or docx
                 and file size does not exceed 5mb'
            ]);
        }
        return response()->json([
            'status_code' => 200,
                'message' => 'File uploaded succesfully',
                'file' => $file
        ]);
    }

    public function viewFile()
    {
        $file = 'file';
        return $this->taskService->find($file);
    }

}
