<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_proveedor' => 'required',
            'cdescripcion' => 'required|max:20',
            'total_pagar' => 'required',
            'id_usuario' => 'required',
            'cantidad' => 'required',
            'preciocompra' => 'required',
        ];
    }
}
