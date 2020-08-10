<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AddRoundPointRule implements Rule
{
    private $countSeen=true;
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

        $seenArray=request()->input('seen');
        if(!($seenArray)){
            $this->countSeen=false;
               return false;
        }
        foreach ($value as $key=>$point){
            if(intval($point)>0){
                if(!array_key_exists($key,$seenArray)){
                    return false;
                }
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
        if ($this->countSeen==false){
            return 'Click seen on at least one player';
        }
         return  'Seen field is off for player having point';
    }
}
