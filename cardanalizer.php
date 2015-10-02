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
        return $this->countSameAttributes($cards, 'suit');
    }

    public function isConnected(array $cards)
    {
        $diffs = $this->rankDiff($cards);
        return isset($diffs[1]) && $diffs[1] >= 1;
    }

    public function isPair(array $cards)
    {
        $diffs = $this->rankDiff($cards);
        return isset($diffs[0]) && $diffs[0] >= 1;
    }

    public function isHighPair(array $cards)
    {
        return $this->isPair($cards)
            && CardHelper::mapRankToValues($cards[0]->rank) >= 8;
    }

    public function twoFigures(array $cards)
    {
        $c1Rank = CardHelper::mapRankToValues($cards[0]->rank);
        $c2Rank = CardHelper::mapRankToValues($cards[1]->rank);
        return $c1Rank >= 10 && $c2Rank >= 10;
    }

    public function rankDiff(array $cards)
    {
        $diffs = array();
        for($i = 1; $i < count($cards); $i++)
            $diffs[] = CardHelper::mapRankToValues($cards[$i]->rank) - CardHelper::mapRankToValues($cards[$i - 1]->rank);

        $diffCount = array_count_values($diffs);
        arsort($diffCount);

        return $diffCount;
    }

    public function hasPreFlopPotential(array $cards)
    {
        return $this->isPair($cards)
        || $this->isConnected($cards)
        || $this->isSuited($cards)
        || $this->twoFigures($cards);
    }

    public function IHavePair($allCards, $communityCards)
    {
        $communityDiff = $this->rankDiff($communityCards);
        $allDiff = $this->rankDiff($allCards);
        return $allDiff[0] > $communityDiff[0];
    }



    private function countSameAttributes(array $cards, $attribute)
    {
        $cardAttrs = array_map(function($card) use ($attribute) {
            return $card->$attribute;
        }, $cards);

        $cardAttrCounts = array_count_values($cardAttrs);
        arsort($cardAttrCounts);

        return $cardAttrCounts;
    }
}