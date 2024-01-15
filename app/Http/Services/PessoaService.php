<?php

namespace App\Http\Services;

use App\Models\Pessoa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PessoaService
{
    public function getByUuid(string $uuid)
    {
        return Pessoa::where('uuid',$uuid)->first();
    }
    public function create(array $data)
    {
        $formatted = [
            'uuid' => uuid_create(),
            'apelido' => $data['apelido'],
            'nome' => $data['nome'],
            'nascimento' => Carbon::createFromFormat('Y-m-d', $data['nascimento']),
            'stack'=>$data['stack']
        ];
        $pessoa = Pessoa::query()->make($formatted);

        $pessoaCacheData = json_encode($pessoa->toArray());

        Cache::set('pessoa.' . $pessoa['uuid'], $pessoaCacheData, now()->day);
        Cache::set('pessoa.' . $pessoa['uuid'], $pessoaCacheData, now()->day);

        dispatch(function () use ($formatted) {
           Pessoa::query()->create($formatted);
        });

        return $pessoa;
    }

    public function count()
    {
        return Pessoa::query()->count();
    }

    public function getByTerm(string $term, int $limit = 50)
    {
        return Pessoa::query()
            ->where('apelido', 'LIKE', "%$term%")
            ->orWhere('nome', 'LIKE', "%$term%")
            ->orWhere('stack', 'LIKE', "%$term%")
            ->limit($limit)
            ->get();
    }
}
