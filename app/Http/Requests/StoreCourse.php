<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Support\Facades\Config;


class StoreCourse extends FormRequest
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
       $mimes = implode(",",config('imageable.mimes'));
       $max = Config::get('imageable.max_file_size');
       return [ 'image' => 'mimes :'.$mimes.'|max:'.$max,
                'name' => 'required',
                'description' => 'required'
   ];
    }
}
