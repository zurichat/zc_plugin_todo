<?php

namespace App\Http\Requests\PluginInstallation;

use Illuminate\Foundation\Http\FormRequest;

class UninstallRequest extends FormRequest
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
            'user_id' => 'required',
            'organisation_id' => 'required'
        ];
    }
}
