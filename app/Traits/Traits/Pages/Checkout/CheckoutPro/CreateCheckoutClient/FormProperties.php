<?php

declare(strict_types=1);

namespace App\Traits\Traits\Pages\Checkout\CheckoutPro\CreateCheckoutClient;

use App\Models\SubAcquirer;
use Livewire\Attributes\Validate;

trait FormProperties
{
    #[Validate('string|required')]
    public $first_name = '';
    #[Validate('string|required')]
    public $second_name = '';
    #[Validate('required')]
    public $cpf_cnpj = '';

    #[Validate('required|string|email|ends_with:com,br')]
    public $email = '';
    #[Validate('required|string')]
    public $phone = '';
    #[Validate('string|required')]
    public $street      = '';
    #[Validate('string|required')]
    public $neighborhood= '';
    #[Validate('string|required')]
    public $city        = '';
    #[Validate('string|required')]
    public $zip_code    = '';
    #[Validate('string|nullable')]
    public $number      = '';
    #[Validate('string|nullable')]
    public $complement  = '';
    #[Validate('string|nullable')]
    public $client_name = '';

    public ?SubAcquirer $subAcquirer = null;

    public $planId;

    public $referral;

    public $plan;

    public function mockFormData(): void
    {
        $this->first_name    = 'João';
        $this->second_name   = 'Silva';
        $this->cpf_cnpj      = '123.456.789-09';
        $this->email         = 'joao.silva@example.com';
        $this->phone         = '11987654321';
        $this->street        = 'Rua das Flores';
        $this->neighborhood  = 'Jardim Primavera';
        $this->city          = 'São Paulo';
        $this->zip_code      = '01234-567';
        $this->number        = '123';
        $this->complement    = 'Apto 45';
        $this->client_name   = 'João Silva';
    }


    public function messages()
    {
        return [
            'first_name.required' => 'O campo :attribute é obrigatório.',
            'second_name.required' => 'O campo :attribute é obrigatório.',
            'cpf_cpnj.required' => 'O campo :attribute é obrigatório.',
            'email.required' => 'O campo :attribute é obrigatório.',
            'email.email' => 'O campo :attribute deve ser um e-mail válido.',
            'email.ends_with' => 'O campo :attribute deve terminar com .com ou .br.',
            'phone.required' => 'O campo :attribute é obrigatório.',
            'street.required' => 'O campo :attribute é obrigatório.',
            'neighborhood.required' => 'O campo :attribute é obrigatório.',
            'city.required' => 'O campo :attribute é obrigatório.',
            'zip_code.required' => 'O campo :attribute é obrigatório.',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'primeiro nome',
            'second_name' => 'segundo nome',
            'cpf_cpnj' => 'CPF ou CNPJ',
            'email' => 'e-mail',
            'phone' => 'telefone',
            'street' => 'rua',
            'neighborhood' => 'bairro',
            'city' => 'cidade',
            'zip_code' => 'CEP',
            'number' => 'número',
            'complement' => 'complemento',
            'client_name' => 'nome do cliente',
        ];
    }

}
