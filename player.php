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
            $minBet = $this->betMinimumRaise($gameState);
            return (int)$minBet;
        }

        return 0;
    }

    public function showdown($game_state)
    {

    }

    private function betMinimumRaise(GameState $gameState)
    {
        return $gameState->current_buy_in + $gameState->minimum_raise;
    }
}
