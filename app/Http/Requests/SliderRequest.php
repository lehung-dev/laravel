<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            // 'name'          => 'bail|required|min:5',
            // 'description'   => 'bail|required',
            // 'link'          => 'bail|required|min:5|url',
            // 'status'        => 'bail|in:active,inactive',
            'thumb'         => 'bail|required|image|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name không được rỗng',
            'name.min'      => 'Name :input không được. Chiều dài phải :min ký tự',
            'description.required'  => 'Description không được rỗng',
            'link.required'  => 'Link không được rỗng',
        ];
    }
}
