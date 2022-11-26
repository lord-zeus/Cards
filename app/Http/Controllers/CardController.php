<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public GameService $gameService;

    public function __construct(GameService $gameService){
        $this->gameService = $gameService;
    }
    public function generate(Request $request): array
    {
        return $this->gameService->playCards($request);

    }
}
