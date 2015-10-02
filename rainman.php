<?php

/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 13:32
 */
class Rainman
{


    public static function fetch($cards)
    {
        return json_decode(file_get_contents('http://rainman.leanpoker.org/rank?cards=' . urlencode(json_encode($cards))));
    }

    public static function getRank($cards)
    {
        return (int)self::fetch($cards)->rank;
    }

}