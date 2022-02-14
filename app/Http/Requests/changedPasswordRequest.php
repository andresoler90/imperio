<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changedPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'current_password.required' => 'Contraseña actual es requerido',
            'password.required' => 'Nueva contraseña es requerido',
            'password_confirmation.required' => 'Confirmar contraseña es requerido',
            'password.min' => 'Nueva contraseña minimo 6 caracteres',
            'password_confirmation.min' => 'Confirmar contraseña minimo 6 caracteres',
        ];
    }
}
