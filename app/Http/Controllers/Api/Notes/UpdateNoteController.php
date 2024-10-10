<?php

namespace App\Http\Controllers\Api\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notes\updateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class UpdateNoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(updateNoteRequest $request, Note $note)
    {
        $note->update($request->all());

        return $this->okResponse($note, 'the note updated successfully');
    }
}
