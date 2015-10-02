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
        return new MyPlayer($this->players[$this->in_action]);
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

}