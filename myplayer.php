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
        return $this->hole_cards;
    }
}