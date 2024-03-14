<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;


    public function validate($rules, $mergeParams = [])
    {
        if (count($mergeParams) > 0)
            request()->merge(array_filter($mergeParams, fn($i) => !!$i));

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails())
            abort(400, $validator->errors());

        return $validator->validated();
    }

    public function response($data, $status = null, $headers = [])
    {
        $_status = request()->method() == 'POST' ? 201 : 200;
        return response()->json($data, $status ?: $_status, $headers);
    }

    public function success(string $message = null, int $status = 200)
    {
        $response = ["success" => true];
        if ($message)
            $response["message"] = $message;
        return response()->json($response, $status);
    }

    public function download($file, $fileName = 'download', $contentType = 'application/pdf')
    {
        return response($file, 200, [
            'Content-Type' => $contentType,
            'Access-Control-Expose-Headers' => 'Content-Disposition',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Length' => strlen($file),
        ]);
    }

    public function stream($output, $fileName = 'download', $contentType = 'application/pdf')
    {
        return response($output, 200, [
            'Content-Type' => $contentType,
            'Access-Control-Expose-Headers' => 'Content-Disposition',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }
}
