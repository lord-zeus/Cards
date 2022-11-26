<?php

namespace App\Services;

use App\Interfaces\IGame;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class GameService implements IGame
{
    public array $deck;
    private Collection $dealt;

    public function __construct()
    {
        $groups = [2, 3, 4, 5, 6, 7, 8, 9, "A", 'X', "J", "Q", "K"];
        $suits = ["S", "H", "D", "C"];

        foreach ($suits as $suit)
        {
            foreach ($groups as $group)
            {
                $this->deck[] = $group."-".$suit;
            }
        }

    }

    public function shuffleDeck()
    {
        $this->dealt = collect($this->deck)->shuffle();
    }

    public function playCards(Request $request)
    {
        $rules = [
            'number_people' => 'required|int|min:1',
        ];

        $customMessages = [
            'int' => 'Value is invalid',
            'required' => 'Input value does not exist.',
            'min' => 'value is invalid',
        ];
        $request->validate($rules, $customMessages);
        $user_cards = [];
        $this->shuffleDeck();

        if($request->number_people >= 52) $value = 52;
        else $value = $request->number_people;
        for( $i= 1; $i <= $value; $i++){
            $user_cards[] = ['cards' => []];
        }
        foreach ($this->dealt as $k => $card){
            $user = $k%$request->number_people;
            $user_cards[$user]['cards'][] = $card;
        }
        return $user_cards;

    }
}
