<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            'title' => 'required|min:2:max:255',
            'tags' => 'required|min:2:max:255',
//            resimler tek bir tane değil çoklu geldiği için 'images.*' yapıyoruz.
            'images.*' => 'mimes:png,jpg,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Başlık alanı girilmesi zorunludur.",
            "title.min" => "Başlık alanı en az 2 karakter olmalıdır.",
            "title.max" => "Başlık alanı en fazla 255 karakter olmalıdır.",
            "tags.required" => "Etiket alanı bilgisi girilmesi zorunludur.",
            "tags.min" => "Etiket alanı en az 2 karakter olmalıdır.",
            "tags.max" => "Etiket alanı en fazla 255 karakter olmalıdır.",
            "images.*.mimes" => "Resimler .png, .jpg, .jpeg olabilir.",
            "images.*.max" => "Resimler en fazla 2MB olabilir.",
        ];
    }
}
