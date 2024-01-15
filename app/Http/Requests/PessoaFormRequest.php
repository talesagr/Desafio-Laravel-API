<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PessoaFormRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'apelido' => ['required','string','max:32'],
            'nome' => ['required','string','max:100'],
            'nascimento' => ['required','date','max:100'],
            'stack' => ['sometimes','array','nullable'],
            'stack.*' => ['string','max:32']

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errorMessages = $validator->errors()->getMessages();

        foreach ($errorMessages as $messages) {
            foreach ($messages as $key => $value) {
                if (strpos($value, 'must be') == 0) {
                    continue;
                }

                throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl())
                    ->status(Response::HTTP_BAD_REQUEST);
            }
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
