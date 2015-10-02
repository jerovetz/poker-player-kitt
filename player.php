<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest($game_state)
    {
        return $this->betMinimumRaise($game_state);
    }

    public function showdown($game_state)
    {

    }

    private function betMinimumRaise($game_state)
    {
        return $game_state['current_buy_in'] + $game_state['minimum_raise'];
    }
}
