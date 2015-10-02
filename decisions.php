<?php


class Decisions
{
    private $cardsAnalizer;

    public function __construct(GameState $gameState)
    {
        $this->cardsAnalizer = new CardAnalizer();
        $this->gameState = $gameState;
    }

    public function isHeadsUp()
    {
        $outPlayers = $this->gameState->playersWithStatus('out');
        return count($outPlayers) == count($this->gameState->players) - 2;
    }

    public function shouldRaise(array $cards)
    {
        if ($this->cardsAnalizer->isPair($cards)) {
            return true;
        }

        if ($this->isHeadsUp()){
            return true;
        }

        $activePlayers = $this->gameState->playersWithStatus('active');
        if (count($activePlayers) <= 3) {
            return true;
        }

        return false;
    }

}