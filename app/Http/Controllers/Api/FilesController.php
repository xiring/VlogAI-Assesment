<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class FilesController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request)
    {
        $fileName = date('YmdHis') . "_" . $request->file->getClientOriginalName();

        if ($uploadPath = $request->uploadModule) {
            $request->file->move(public_path("files/" . $uploadPath), $fileName);
            $finalPath = "files/{$uploadPath}/{$fileName}";
        } else {
            $request->file->move(public_path('files'), $fileName);
            $finalPath = "files/{$fileName}";
        }
        return response()->json(['file' => $finalPath]);
    }
}
