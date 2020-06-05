<?php

namespace Dev\Application\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImportingXlsxFormRequest responsible for validating xlsx form requests inputs
 * @package Dev\Application\FormRequests
 */
class ImportingXlsxFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            "xlsx" => "required|file",
            "email" => "nullable"
        ];
    }

    public function attributes()
    {
        return [
            "xlsx" => "file"
        ];
    }
}