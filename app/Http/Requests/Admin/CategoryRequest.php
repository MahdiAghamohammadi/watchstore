<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'parent_id' => 'nullable|min:1|regex:/^[0-9]+$/u|exists:categories,id',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'نام دسته بندی',
            'parent_id' => 'دسته پدر'
        ];
    }
}
