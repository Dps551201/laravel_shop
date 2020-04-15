<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:3|max:150',
            'code' => 'required|string|min:3|max:150|unique:categories,code',
            'description' => 'required|min:3|max:500',
        ];

        if ($this->route()->named('categories.update')) {
            $rules['code'] .= ',' . $this->route()->parameter('category')->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
          'required' => 'Поле :attribute обязательно для ввода',
          'min' => 'Поле :attribute должно иметь :min символов',
          'code.min' => 'Поле код должно содержать не менее :min символов'
        ];
    }
}
