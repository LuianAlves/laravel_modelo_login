<?php

use App\Models\User;
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

function generateEmail($name, $id = null) {
    $name = strtok(strtolower($name), " ");

    $comAcentos = ['à', 'á', 'â', 'ã', 'ç', 'è', 'é', 'ê', 'ì', 'í', 'î', 'ò', 'ó', 'ô', 'õ', 'ù', 'ú', 'À', 'Á', 'Â', 'Ã', 'Ç', 'È', 'É', 'Ê', 'Ì', 'Í', 'Î', 'Ò', 'Ó', 'Ô', 'Õ', 'Ù', 'Ú'];
    $semAcentos = ['a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'U', 'U'];
    $limparNome = $name;

    $cleanName = str_replace($comAcentos, $semAcentos, $limparNome);

    $email = "{$cleanName}@sistapp.com.br";

    $emailUser = User::where('email', $email)->first();

    if ($emailUser == null) {
        $email = $email;
    } else {
        $num = mt_rand(0, 999);
        $email = "{$cleanName}_{$num}@sistapp.com.br";
    }

    return $email;
}
