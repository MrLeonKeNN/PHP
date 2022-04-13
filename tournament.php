<?php

class Tournament
{
    public $name, $date;
    private $players = [];

    public function __construct($name, $date = null)
    {
        if ($date == null) {
            $date = strtotime("+1 day");
        } else {
            $dateParce = DateTime::createFromFormat("Y.m.d", $date);
            $date = $dateParce  ->getTimestamp();
        }
        $this->name = $name;
        $this->date = $date;
    }

    public function addPlayer($player)
    {
        $this->players[] = $player;
        return $this;
    }

    public function createPairs()
    {
        if (count($this->players) % 2 != 0) {
            $this->addPlayer((new Player(""))->setFake(true));
        }
        $cnt = count($this->players);

        for ($day = 0; $day < $cnt - 1; $day++) {
            $timestamp = strtotime("+$day day", $this->date);
            $localDate = date("Y-m-d", $timestamp);
            echo $this->name . ",   " . $localDate . "<br/>";
            for ($i = 0; $i < $cnt / 2; $i++) {
                $playerOne = $this->players[$this->shiftIndex($i, $cnt, $day)];
                $playerTwo = $this->players[$this->shiftIndex($cnt - $i - 1, $cnt, $day)];

                if ($playerOne->getFake() || $playerTwo->getFake()) {
                    continue;
                }
                echo $playerOne->toString() . " - " . $playerTwo->toString() . "<br/>";
            }
            echo "<br/>";
        }
    }

    public function shiftIndex($index, $length, $day)
    {
        if ($index == 0) {
            return 0;
        }
        $shifted_index = $index - $day;
        if ($shifted_index < 1) {
            $shifted_index = $shifted_index + $length - 1;
        }

        return $shifted_index;
    }

}
