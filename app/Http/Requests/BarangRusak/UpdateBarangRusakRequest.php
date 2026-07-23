<?php

namespace App\Http\Requests\BarangRusak;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRusakRequest extends FormRequest
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
