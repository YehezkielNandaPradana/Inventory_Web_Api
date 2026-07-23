<?php

namespace App\Http\Requests\Notifikasi;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotifikasiRequest extends FormRequest
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
