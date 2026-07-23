<?php

namespace App\Http\Requests\Merk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMerkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
