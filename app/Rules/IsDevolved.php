<?php

namespace App\Rules;

use App\Models\Car;
use Illuminate\Contracts\Validation\Rule;

class IsDevolved implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $car = Car::find($value);
        $lastRent = empty($car) ? null : $car->rents->last();

        return empty($lastRent) || $lastRent->devolved == true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O carro não foi devolvido!';
    }
}
