<?php

namespace App\Http\Controllers\Api\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class DeleteNoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Note $note)
    {
        $note->delete();
        return $this->noContentResponse();
    }
}
