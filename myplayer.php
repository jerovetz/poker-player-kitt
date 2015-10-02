<?php

/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 10:43
 */
class MyPlayer extends GameObject
{
    public function getHand() {
        return $this->sortCards($this->hole_cards);
    }

    public function sortCards($cards)
    {
        usort($cards, function($a, $b) {
            return (CardHelper::mapRankToValues($a->rank) < CardHelper::mapRankToValues($b->rank)) ? -1 : 1;
        });
        return $cards;
    }
}