<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** Validación de producto (crear y editar). La autorización la hace la Policy. */
class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category'      => ['required', 'in:agricola,artesanal'],
            'name'          => ['required', 'string', 'min:2', 'max:120'],
            'producer_name' => ['required', 'string', 'min:2', 'max:120'],
            'price'         => ['required', 'numeric', 'min:0.1', 'max:99999'],
            'unit'          => ['required', 'in:kilo,unidad,arroba'],
            'location'      => ['required', 'string', 'min:2', 'max:180'],
            'description'   => ['nullable', 'string', 'max:300'],
        ];
    }
}
