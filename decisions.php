<?php


class Decisions
{
    private $cardsAnalizer;

    public function __construct()
    {
        $this->cardsAnalizer = new CardAnalizer();
    }

    public function shouldBet($countOfOutPlayers, $countOfAllPlayers)
    {
        return $countOfOutPlayers == $countOfAllPlayers - 2;
    }

    public function shouldRaise(array $cards)
    {
        $isPair = $this->cardsAnalizer->isPair($cards);
        return $isPair;
    }

}