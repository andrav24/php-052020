<?php


class MoveInfo implements MoveInterface
{
    protected int $distance;
    protected int $duration;

    public function __construct()
    {
        $this->distance = $_POST['distance'];
        $this->duration = $_POST['duration'];
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}
