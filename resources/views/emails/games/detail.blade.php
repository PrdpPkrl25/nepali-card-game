@component('mail::message')
Your Marriage Card game can be viewed by clicking button below:

@component('mail::button', ['url' => $game_url])
View Game
@endcomponent
To add the points ask the edit code from the game creator.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
