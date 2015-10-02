<?php


class CardAnalizer
{

    public function isSuited(array $cards) 
    {
        return $cards[0]['suit'] == $cards[1]['suit'];
    }

    public function isConnected(array $cards)
    {
        return abs($this->rankDiff($cards)) == 1;
    }

    public function isPair(array $cards)
    {
        return $this->rankDiff($cards) == 0;
    }

    public function rankDiff(array $cards)
    {
        $firstRank = $this->mapRankToValues($cards[0]['rank']);
        $secondRank = $this->mapRankToValues($cards[1]['rank']);
        return $firstRank - $secondRank;
    }

    public function mapRankToValues($rank)
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