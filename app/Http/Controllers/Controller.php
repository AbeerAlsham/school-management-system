<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
abstract class Controller
{
    use ApiResponder,AuthorizesRequests,ValidatesRequests;
}
