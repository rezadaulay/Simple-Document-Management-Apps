<?php

namespace App\Http\Controllers;

class LogicalTestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $data = ['11','12','cii','001','2','1998','7','89','iia','fii'];
        return response()->json(array_filter($data, function($value) {
            return !is_numeric($value);
        }));
    }
}
