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
                $callAmount = $this->call($gameState);
                return (int)$callAmount;
            }

            if (!$gameState->isSomeBodyRaised()) {
                $callAmount = $this->call($gameState);
                return (int)$callAmount;
            }

            $c1Rank = CardHelper::mapRankToValues($myCards[0]->rank);
            $c2Rank = CardHelper::mapRankToValues($myCards[1]->rank);

            if ($c1Rank > 10 || $c2Rank > 10) {
                $callAmount = $this->call($gameState);
                return (int)$callAmount;
            }

            return 0;
        }
        else
        {
            if ($cardAnalizer->IHavePair($gameState->getAllCards(), $gameState->getCommunityCards())) {
                $minBet = $this->betMinimumRaise($gameState);
                return (int)$minBet;
            }

            $rank = Rainman::getRank($gameState->getAllCards());
            $noService = array(0, 1,2,3);
            if (!in_array($rank, $noService)) {
                if (rand(0,1)) {
                    $minBet = $this->betMinimumRaise($gameState);
                    return (int)$minBet;
                }
                $callAmount = $this->call($gameState);
                return (int)$callAmount;
            }
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
