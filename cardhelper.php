<?php


class CardHelper
{
    public static function mapRankToValues($rank)
    {
        switch (strtoupper($rank))
        {
            case 'J': return 11;
            case 'Q': return 12;
            case 'K': return 13;
            case 'A': return 14;
            default: return $rank;
        }
    }
}