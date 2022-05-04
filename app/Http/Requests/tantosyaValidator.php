<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class tantosyaValidator extends FormRequest
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
    public function rules(Request $request)
    {

        if (is_null(request('passwd'))) {
            return [
            'name' => 'nullable|max:50',
            'datatxt0003' => 'nullable|max:50',
            'datatxt0004' => 'nullable|max:50',
            'mail' => 'nullable|email|max:100',
            'innerlevel' => 'required|max:30',
            'accesscode' => 'nullable|max:100',
        ];
        }

        else {
        return [
            'passwd' => 'required|max:100',
            'name' => 'nullable|max:50',
            'datatxt0003' => 'nullable|max:50',
            'datatxt0004' => 'nullable|max:50',
            'mail' => 'nullable|email|max:100',
            'innerlevel' => 'required|max:30',
            'accesscode' => 'nullable|max:100',
        ];
        }
    
   }
}


