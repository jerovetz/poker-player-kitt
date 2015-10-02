<?php



/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 10:45
 */
class GameObject
{
    public function __construct($gameStateData) {

        foreach ($gameStateData as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public static function fromArray($array) {
        return new static(json_decode(json_encode($array)));
    }
}