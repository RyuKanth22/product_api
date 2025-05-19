<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol'      => 'in:admin,user'
        ];
    }
  public function messages()
{
    return [
        'name.required'     => 'El nombre es obligatorio.',
        'name.max'          => 'El nombre no debe exceder los 100 caracteres.',

        'email.required'    => 'El correo electrónico es obligatorio.',
        'email.email'       => 'Debe proporcionar un correo electrónico válido.',
        'email.unique'      => 'El correo electrónico ya está registrado.',

        'password.required' => 'La contraseña es obligatoria.',
        'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',

        'rol.in'            => 'El rol debe ser "admin" o "user".',
    ];
}

}
