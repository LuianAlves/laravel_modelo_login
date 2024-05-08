<?php

namespace App\Http\Controllers\API;

use App\Enums\PanelTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Traits\HttpResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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

    public function store(UserStoreRequest $request)
    {
        $request->validated();

        $status = $request->status == "on" ? UserStatusEnum::ATIVO : UserStatusEnum::INATIVO;
        $panel = $request->panel == "on" ? PanelTypeEnum::ADMIN : PanelTypeEnum::APP;

        $user = $this->user->create([
            'name' => ucwords($request->name),
            'email' => generateEmail($request->name),
            'password' => Hash::make($request->password),
            'status' => $status,
            'panel' => $panel,
            'created_at' => Carbon::now()
        ]);

        return $this->trait("store", $user);
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

    public function update(UserUpdateRequest $request, $id)
    {
        $request->validated();

        $user = $this->user->find($id);

        $password = $request->password == null ? $user->password : Hash::make($request->password);
        $status = $request->status == "on" ? UserStatusEnum::ATIVO : UserStatusEnum::INATIVO;
        $panel = $request->panel == "on" ? PanelTypeEnum::ADMIN : PanelTypeEnum::APP;

        $user->update([
            'name' => ucwords($request->name),
            'email' => generateEmail($request->name, $user->id),
            'password' => $password,
            'status' => $status,
            'panel' => $panel,
            'updated_at' => Carbon::now()
        ]);

        return $this->trait("store", $user);
    }

    public function destroy($id)
    {
        $user = $this->user->find($id);

        if ($user === null) {
            return $this->trait("error");
        } else {

            $user->delete();

            return $this->trait("get", $user);
        }
    }
}
