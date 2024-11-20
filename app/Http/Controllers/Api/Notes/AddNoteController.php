<?php

namespace App\Http\Controllers\Api\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notes\AddNoteRequest;
use App\Models\Note\Note;

class AddNoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddNoteRequest $request)
    {
        $note = Note::create($request->all());
        return $this->createdResponse($note, 'the note added successfully');
    }
}
