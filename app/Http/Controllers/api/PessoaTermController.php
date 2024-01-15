<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PessoaResource;
use App\Http\Services\PessoaService;
use Illuminate\Http\Request;

class PessoaTermController extends Controller
{
    public function __construct(private PessoaService $pessoaService)
    {
    }
//
//    public function show(Request $request)
//    {
//        $term = $request->input('term');
//        $pessoa = $this->pessoaService->getByTerm($term);
//
//        return PessoaResource::collection($pessoa);
//    }

    public function find(Request $request)
    {
        $term = $request->query('t');
        $result = $this->pessoaService->getByTerm($term);

        return PessoaResource::collection($result);
    }
}
