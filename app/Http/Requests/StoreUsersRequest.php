<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
            'name' => 'required|max:10',
            'email' => 'required|max:40|unique:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Kolom ini wajib diisi !',
            'email.required' => 'Tidak Boleh Kosong',
            'email.unique' => 'Email ini sudah Dipakai',
            
        ];
    }
}
