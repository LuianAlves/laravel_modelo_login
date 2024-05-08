<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponse;
use Carbon\Carbon;
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
        $user = $this->user->paginate(8);

        $user->each(function ($user) {
            $user->humansDate = humansDate($user->created_at);
        });

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
