<?php


interface TariffInterface
{
    public function getDescription(MoveInterface $info): string;
    public function cost(MoveInterface $info): int;
}
