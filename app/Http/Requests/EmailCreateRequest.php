<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailCreateRequest extends FormRequest
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
            'title'=>"required|max:150",
            'subject'=>"required|max:150",
            'content'=>"required|min:10",
            'to'=>"required|email",
            'send_time'=>'required',
            'status'=>"required|integer"
        ];
    }
}
