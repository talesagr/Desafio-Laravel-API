<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PessoaResource extends JsonResource
{

    public function toArray(Request $request):array
    {
        return [
            'id' => $this->uuid,
            'apelido' => $this->apelido,
            'nome' => $this->nome,
            'nascimento' => $this->nascimento->format('Y-m-d'),
            'stack' => $this->stack,
        ];
    }
}
