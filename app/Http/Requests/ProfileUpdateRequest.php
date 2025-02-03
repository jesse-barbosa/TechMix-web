<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'description' => [ 'required','string','max:500'],
            'cnpj' => [ 'required', 'string', 'max:18' ],
            'street' => [ 'required', 'string', 'max:255' ],
            'number' => [ 'required', 'string', 'max:10' ],
            'complement' => [ 'required', 'string', 'max:255' ],
            'neighborhood  ' => [ 'required', 'string', 'max:255' ],
            'city' => [ 'required', 'string', 'max:255' ],
            'state' => [ 'required', 'string', 'max:2' ],
            'postalCode  ' => [ 'required', 'string', 'max:10' ],
            Rule::unique(Store::class)->ignore($this->user()->id),
        ];
    }
}

// 'imageURL' => [ 'required', 'string', 'max:500' ],
 // 'status  ' => [ 'required', 'number', 'max:11' ],