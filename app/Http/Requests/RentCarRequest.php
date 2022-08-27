<?php

namespace App\Http\Requests;

use App\Models\Car;
use App\Rules\IsDevolved;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RentCarRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'car_id' => [
                'required',
                'exists:cars,id',
                new IsDevolved(),
            ],
        ];
    }
}
