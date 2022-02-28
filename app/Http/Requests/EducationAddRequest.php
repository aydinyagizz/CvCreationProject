<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //kullanmak için true yapıyoruz.
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
            "education_date" => "required|max:255",
            "university_name" => "required|max:255",
            "university_branch" => "required|max:255",
        ];
    }

    public function messages()
    {
        return [
            "education_date.required" => "Eğitim tarihinin girilmesi zorunludur.",
            "education_date.max" => "Eğitim tarihinin en fazla 255 karakter olmalıdır.",
            "university_name.required" => "Üniversite adı girilmesi zorunludur.",
            "university_name.max" => "Üniversite adı en fazla 255 karakter olmalıdır.",
            "university_branch.required" => "Üniversite bölümü girilmesi zorunludur.",
            "university_branch.max" => "Üniversite bölümü en fazla 255 karakter olmalıdır.",
        ];
    }

}
