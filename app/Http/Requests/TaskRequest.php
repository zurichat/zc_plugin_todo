<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'end_date' => 'required|max:255',
            'labels' => 'required|max:255',
            'tasks' => 'required|array|min:1',
            'owner' => 'required|max:255',
            'status' => 'required',
            'user' => 'required',
        ];
    }
}
