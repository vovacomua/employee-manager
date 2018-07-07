<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
        $rules = [];

        $rules['search_field'] = 'required|in:id,parent_id,full_name,position,start_date,salary';

        switch ($this->query('search_field')) {
            case 'id':
                $rules['search_value'] = 'required|numeric|digits_between:1,5';
                break;
            case 'parent_id':
                $rules['search_value'] = 'required|numeric|digits_between:1,5';
                break;
            case 'full_name':
                $rules['search_value'] = 'required|alpha|max:255';
                break;
            case 'position':
                $rules['search_value'] = 'required|alpha_num|max:255';
                break;
            case 'start_date':
                $rules['search_value'] = 'required|date';
                break;  
            case 'salary':
                $rules['search_value'] = 'required|numeric|digits_between:1,7';
                break;  
        }

        return $rules;    
    }
}
