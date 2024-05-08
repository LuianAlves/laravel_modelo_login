<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponse;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->paginate(5);

        return $this->trait("get", $user);
    }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {
        $user = $this->user->find($id);

        if ($user === null) {
            return $this->trait("error");
        } else {
            return $this->trait("get", $user);
        }
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
