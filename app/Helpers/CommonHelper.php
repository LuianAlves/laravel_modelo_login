<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

function currentUrl()
{
    $prefix = Request::route()->getName();

    $title = explode('-web.', $prefix);

    $t = str_replace('-', ' ', $title[0]);

    $titulo = ucwords($t);

    return $titulo;
}

function currentRoute()
{
    $route = Route::current()->getName();

    return $route;
}

function humansDate($data) {
    $humansDate = Carbon::parse($data)->diffForHumans();

    return $humansDate;
}
