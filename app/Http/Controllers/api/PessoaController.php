<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaFormRequest;
use App\Http\Resources\PessoaResource;
use App\Http\Services\PessoaService;
use Illuminate\Http\Response;

class PessoaController extends Controller
{

    public function __construct(private PessoaService $pessoaService)
    {
    }

    public function store(PessoaFormRequest $request)
    {
        $pessoa = $this->pessoaService->create($request->validated());

        $response = (new PessoaResource($pessoa))
            ->toResponse($request);
        $response->setStatusCode(Response::HTTP_CREATED);

        $response->header('Location', sprintf('/pessoas/%s', $pessoa['uuid']));
        return $response;
    }

    public function show(string $uuid)
    {
        $pessoa = $this->pessoaService->getByUuid($uuid);
        return new PessoaResource($pessoa);
    }

    public function count()
    {
        return $this->pessoaService->count();
    }
}
