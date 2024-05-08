<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class UserController extends Controller
{
    use HttpResponse;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->latest()->get();

        $user->each(function ($user) {
            $user->humansDate = humansDate($user->created_at);
        });

        return $this->trait("get", $user);
    }

    public function store(Request         $request,
                          CreatesNewUsers $creator): RegisterResponse
    {
        if (config('fortify.lowercase_usernames')) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        event(new Registered($user = $creator->create($request->all())));

        return app(RegisterResponse::class);
    }

    public function show($id)
    {
        $user = $this->user->find($id);

        if ($user === null) {
            return $this->trait("error");
        } else {
            return $this->trait("get", $user);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
