<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login(array $attributes)
    {
        $credentials = Auth::guard()->attempt($attributes);
        abort_unless($credentials, 401, __('Email atau Password Salah'));
        return $this->model->where('email', $attributes['email'])->firstOrFail();
    }
}
