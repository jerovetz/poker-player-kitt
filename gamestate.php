<?php

/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 10:09
 */
class GameState
{
    public static function fromArray($array) {
        return json_decode(json_encode($array));
    }
}