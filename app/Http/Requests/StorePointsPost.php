<?php

namespace App\Http\Requests;

use App\Rules\AddRoundNegativeRule;
use App\Rules\AddRoundPointRule;
use App\Rules\AddRoundSeenRule;
use App\Rules\AddRoundWinnerRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePointsPost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'winner'=>['required'],
            'seen'=>[new AddRoundSeenRule()],
            'point'=>[new AddRoundNegativeRule(), new AddRoundPointRule()],
        ];
    }


}
