<?php

/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 10:09
 */
class GameState extends GameObject
{

    public function getMyself() {
        $myself = $this->getPlayer($this->in_action);
        $dealer = $this->getDealer();
        $myself->isDealer = $myself->id === $dealer->id;
        return $myself;
    }

    public function getDealer(){
        return $this->getPlayer($this->dealer);
    }

    public function playersWithStatus(array $status)
    {
        $outPlayers = array();
        foreach ($this->players as $player) {
            if ($player['status'] == $status) {
                $outPlayers[] = $player;
            }
        }
        return $outPlayers;

    }

    private function getPlayer($index)
    {
        return new MyPlayer($this->players[$index]);
    }

}