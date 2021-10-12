<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriviledgeRequest extends FormRequest
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
            'creator_id' => 'required',
            'collaborator_id' => 'required|max:255',
            'admin_status' => 'required|integer|min:0|max:1'
        ];
    }
}
