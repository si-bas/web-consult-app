<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            "student_id_number" => 'required|unique:students|max:255',
            "first_name" => 'required|max:255',
            "last_name" => 'required|max:255',
            "major_id" => 'required|numeric',
            "email" => 'email|unique:users|max:255',

            "date_of_birth" => 'nullable|date',
            "phone_number" => 'nullable|numeric',

            'password' => 'required|max:255'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'student_id_number' => 'nomor induk mahasiswa',
            'email' => 'alamat email',
            'first_name' => 'nama depan',
            'last_name' => 'nama belakang',
            'major_id' => 'jurusan',

            'date_of_birth' => 'tanggal lahir',
            'phone_number' => 'nomor telepon',

            'password' => 'kata sandi'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'unique' => 'Data :attribute sudah digunakan, silahkan gunakan :attribute lain.',
            'max' => 'Teks :attribute tidak boleh lebih dari :max karakter.',
            'numeric' => 'Data :attribute harus angka.',
            'date' => 'Data :attribute harus berformat tanggal.'
        ];
    }
}
