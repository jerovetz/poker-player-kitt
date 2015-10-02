<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest($game_state)
    {
        $outPlayers = $this->getOutPlayers($game_state);
        // waiting to play untin we are in heads up
        if(count($outPlayers) == (count($game_state['players']) - 2)) {
            $minBet = $this->betMinimumRaise($game_state);
            return (int)$minBet;
        }
        return 0;
    }

    public function showdown($game_state)
    {

    }

    private function betMinimumRaise($game_state)
    {
        return $game_state['current_buy_in'] + $game_state['minimum_raise'];
    }

    private function getOutPlayers($game_state)
    {
        $outPlayers = array();
        foreach ($game_state['players'] as $player) {
            if ($player['status'] == 'out') {
                $outPlayers[] = $player;
            }
        }
        return $outPlayers;
    }
}
