<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
            "title"       => ["required", "string", "max:255"],
            "desc"        => ["required", "string", "min:10"],
            "images"      => ["nullable", "array"], // يتأكد إنها مصفوفة
            "images.*"    => ["image", "mimes:jpeg,png,jpg,gif,svg,webp", "max:2048"], // لكل صورة
            "comment_able"      => ['in:on,off'], 
            "category_id" => ["required", "integer", "exists:categories,id"],
        ];
    }
}
