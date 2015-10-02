<?php

/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 10:09
 */
class GameState
{

    public function __construct($gameStateData) {

        foreach ($gameStateData as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public static function fromArray($array) {
        return new GameState(json_decode(json_encode($array)));
    }

    public function getMyself() {
        return $this->players[$this->in_action];
    }

}