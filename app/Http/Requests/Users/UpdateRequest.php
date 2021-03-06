<?php

namespace App\Http\Requests\Users;

use App\Entity\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Users
 * @property User $user
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules()
    {
        return [
            'name'   => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users,id,' . $this->user->id,
            'role'   => ['required', 'string', Rule::in(array_keys(User::rolesList()))]
        ];
    }
}
