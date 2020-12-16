<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AddPlayerEmailRule implements Rule
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
        foreach ($value as $key=>$point){
            if(!is_null($point) && !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $point)){
                    return false;
            }
         }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Email is Invalid.';
    }
}
