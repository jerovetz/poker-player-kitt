<?php

require_once 'cardanalizer.php';
require_once 'gameobject.php';
require_once 'gamestate.php';
require_once 'myplayer.php';
require_once 'decisions.php';

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest($game_state)
    {
        $gameState = GameState::fromArray($game_state);
        $myself = $gameState->getMyself();
        $myCards = $myself->getHand();

        $decision = new Decisions($gameState);
        if ($decision->shouldRaise($myCards)) {
            // all in
            return 9999999;
        }

        if ($decision->isHeadsUp()) {
            $minBet = $this->betMinimumRaise($game_state);
            return (int)$minBet;
        }
        return 0;
    }

    public function showdown($game_state)
    {

    }

    private function betMinimumRaise($game_state)
    {
        return $game_state['current_buy_in'] + $game_state['minimum_raise'];
    }
}
