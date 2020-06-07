<?php


abstract class AbstractTariff implements TariffInterface
{
    protected int $pricePerDistance;
    protected int $pricePerDuration;
    protected string $description;

    public function __construct(int $pricePerDistance = 0, int $pricePerDuration = 0)
    {
        $this->pricePerDistance = $pricePerDistance;
        $this->pricePerDuration = $pricePerDuration;
    }

    public function getDescription(MoveInterface $info): string
    {
        return $this->description . "({$info->getDistance()} км., {$info->getDuration()} мин.)" ;
    }

    abstract public function cost(MoveInterface $info): int;
}
