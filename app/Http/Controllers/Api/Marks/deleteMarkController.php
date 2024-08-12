<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\Request;

class deleteMarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Mark $mark)
    {
        $mark->delete();
        return $this->noContentResponse();
    }

}
