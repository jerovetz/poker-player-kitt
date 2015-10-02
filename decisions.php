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
        if ($this->isHeadsUp()){
            return $this->cardsAnalizer->isPair($cards);
        }

        $myself = $this->gameState->getMyself();
        if($myself->isDealer) {
            return true;
        }

        return $this->cardsAnalizer->isHighPair($cards);
    }

}