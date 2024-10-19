<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function Search(Builder $query, Request $request, $searchFields = [])
    {
        $search = $request->get('search');
        $query->where(function ($q) use ($search, $searchFields) {
            foreach ($searchFields as $field) {
                $q->orWhere($field, 'like', '%' . $search . '%');
            }
        });
        return $query;
    }
}
