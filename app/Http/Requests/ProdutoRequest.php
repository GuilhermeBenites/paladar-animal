<?php

namespace App\Http\Requests;

class ProdutoRequest extends Request
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

    public function messages()
    {
        return [
            'codigo.required'   => 'O campo código é obrigatório',
            'preco.required'    => 'O campo preço é obrigatório.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->sanitize();

        return [
            'nome' => 'required|string|unique:produtos,nome',
            'codigo' => 'required|numeric|unique:produtos,codigo',
            'preco' => 'required',
            'categoria_id' => 'required|exists:categorias,id'
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['preco'] = str_replace(",",".", $input['preco']);

        $this->replace($input);
    }

}