<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    protected $rules = [
        'email' => 'required|email',
        'name' => 'required|string|max:100',
        'password' => 'max:50|required',
        'phone' => 'required',
        'alamat' => 'required',
    ];

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
            'email' => 'required|email',
            'name' => 'required|string|max:100',
            'password' => 'max:50|required',
            'phone' => 'required',
            'alamat' => 'required',
        ];
    }
     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email dibutuhkan!',
            'name.required' => 'Nama Lengkap dibutuhkan!',
            'password.required' => 'Password dibutuhkan',
            'name.max' => 'Tidak boleh melebihi batas'
        ];
    }
}
