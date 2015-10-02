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

        $outPlayers = $activePlayers = $gameState->playersWithStatus('out');
        if (count($outPlayers) == 0) {
            return 0;
        }

        if ($gameState->isPreFlop()) {
            if ($cardAnalizer->hasPreFlopPotential($myCards)) {
                $callAmount = $this->call($gameState);
                return (int)$callAmount;
            }
            if ($myCards->isDealer && !$gameState->isSomeBodyRaised()) {
                $minBet = $this->betMinimumRaise($gameState);
                return (int)$minBet;
            }
            return 0;
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
