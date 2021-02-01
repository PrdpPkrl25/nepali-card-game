<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGamePost extends FormRequest
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
            'number_of_players'=>['required','integer','max:6'],
            'rate_per_point'=>['required'],
            'winner_points_per_seen'=>['required','integer'],
            'winner_points_per_unseen'=>['required','integer'],
            'dubli_winner_points_per_seen'=>['required','integer'],
            'dubli_winner_points_per_unseen'=>['required','integer']
        ];
    }
}
