<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AddRoundWinnerRule implements Rule
{
    /**
     * Marriage a new rule instance.
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
       return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'At least one winner must be selected';
    }
}
