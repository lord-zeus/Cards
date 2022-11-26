<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface IGame {
    public function shuffleDeck();

    public function playCards(Request $request);
}
