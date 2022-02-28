<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            "date" => "required|max:255",
            "task_name" => "required|max:255",
            "company_name" => "required|max:255",
        ];
    }

    public function messages()
    {
        return [
            "date.required" => "Çalışma tarihinin girilmesi zorunludur.",
            "date.max" => "Çalışma tarihinin en fazla 255 karakter olmalıdır.",
            "task_name.required" => "Çalıştığınız pozisyon bilgisi girilmesi zorunludur.",
            "task_name.max" => "Çalıştığınız pozisyon bilgisi en fazla 255 karakter olmalıdır.",
            "company_name.required" => "Çalıştığınız firma bilgisi girilmesi zorunludur.",
            "company_name.max" => "Çalıştığınız firma bilgisi en fazla 255 karakter olmalıdır.",
        ];
    }
}
