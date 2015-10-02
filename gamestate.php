<?php

/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 10:09
 */
class GameState extends GameObject
{

    public function getMyself()
    {
        $myself = $this->getPlayer($this->in_action);
        $dealer = $this->getDealer();
        $myself->isDealer = $myself->id === $dealer->id;
        return $myself;
    }

    public function getDealer()
    {
        return $this->getPlayer($this->dealer);
    }

    public function playersWithStatus($status)
    {
        $outPlayers = array();
        foreach ($this->players as $player) {
            if ($player->status == $status) {
                $outPlayers[] = $player;
            }
        }
        return $outPlayers;

    }

    public function getCommunityCards()
    {
        return $this->sortCards($this->community_cards);
    }

    public function getAllCards()
    {
        return $this->sortCards(array_merge($this->getMyself()->getHand(), $this->getCommunityCards()));
    }

    private function getPlayer($index)
    {
        return new MyPlayer($this->players[$index]);
    }

    public function sortCards($cards)
    {
        usort($cards, function($a, $b) {
            return (CardHelper::mapRankToValues($a->rank) < CardHelper::mapRankToValues($b->rank)) ? -1 : 1;
        });
        return $cards;
    }

    public function isPreFlop()
    {
        $communityCards = $this->getCommunityCards();
        return empty($communityCards);
    }

    public function isSomeBodyRaised()
    {
        return $this->current_buy_in > 2 * $this->small_blind;
    }

}