<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\mark;
use Illuminate\Http\Request;

class UpdateStatusMarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $marks = mark::whereIn('id', $request->ids)->update(['is_accepted' => 1]);
        return $this->okResponse($marks, 'the status of marks updated successfully');
    }
}
