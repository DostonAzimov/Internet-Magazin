<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingInfoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'phoneNumber' => 'required|numeric',
            'phoneNumber2' => 'required|numeric',
            'address' => 'required',
            'map' => 'required',
            'facebook' => 'required|string|url|max:255',
            'instagram' =>'required|string|url|max:255',
            'youtube' => 'required|string|url|max:255',
            'telegram' => 'required|string|url|max:255',
        ];
    }
}
