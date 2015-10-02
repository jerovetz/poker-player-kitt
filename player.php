<?php

require_once 'cardanalizer.php';
require_once 'gameobject.php';
require_once 'gamestate.php';
require_once 'myplayer.php';
require_once 'decisions.php';

class Player
{
    const VERSION = "Project Grinder";

    public function betRequest($game_state)
    {
        $gameState = GameState::fromArray($game_state);
        $myself = $gameState->getMyself();
        $myCards = $myself->getHand();

        $cardAnalizer = new CardAnalizer();
        $decision = new Decisions($gameState);

        if ($gameState->isPreFlop()) {

            if ($cardAnalizer->isHighPair($myCards)) {
                $bet = $myself->stack / 2;
                return (int)$bet;
            }

            if ($cardAnalizer->isPair($myCards)) {
                $minBet = $this->betMinimumRaise($gameState);
                return (int)$minBet;
            }

            if (!$gameState->isSomeBodyRaised()) {
                $callAmount = $this->call($gameState);
                return (int)$callAmount;
            }

            return 0;
        }
        else
        {
            $rank = Rainman::getRank($gameState->getAllCards());
            if ($rank > 0) {
                return 999999;
            }
        }
        


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

    private function call(GameState $gameState)
    {
        return $gameState->current_buy_in;
    }
}
