<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required',
            'web' => 'url'
        ];
    }
}
