<?php


class CardAnalizer
{

    public function isSuited(array $cards) 
    {
        $suitsCount = $this->countSuit($cards);
        $largestSuit = reset($suitsCount);

        return $largestSuit >= 2;
    }

    public function countSuit(array $cards)
    {
        $suits = array_unique(array_map(function($cards) {
            return $cards->suit;
        }, $cards));

        $suitsCount = array_count_values($suits);
        arsort($suitsCount);

        return $suitsCount;
    }

    public function isConnected(array $cards)
    {
        $diff = abs($this->rankDiff($cards));
        return $diff == 1 or $diff == 12;
    }

    public function isPair(array $cards)
    {
        return $this->rankDiff($cards) == 0;
    }

    public function isHighPair(array $cards)
    {
        return $this->isPair($cards)
            && CardHelper::mapRankToValues($cards[0]->rank) >= 10;
    }

    public function rankDiff(array $cards)
    {
        $firstRank = CardHelper::mapRankToValues($cards[0]->rank);
        $secondRank = CardHelper::mapRankToValues($cards[1]->rank);
        return $firstRank - $secondRank;
    }


}