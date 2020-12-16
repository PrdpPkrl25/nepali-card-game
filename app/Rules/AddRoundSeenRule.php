<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AddRoundSeenRule implements Rule
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
         $winner=request()->input['winner'];
        return array_key_exists($winner,$value) ?  true :  false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The seen field is off for winner.';
    }
}
