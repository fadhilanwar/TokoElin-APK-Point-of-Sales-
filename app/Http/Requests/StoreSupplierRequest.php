<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'nama_supplier' => 'required|max:20',
            'alamat'        => 'required',
            'no_tlp'        => 'min:11|max:13',
        ];
    }

    public function messages(): array
{
    return [
        'nama_supplier.required' => 'Kolom ini wajib diisi !',
        'alamat.required' => 'Tidak Boleh Kosong',
        
    ];
}
}
