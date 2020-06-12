<?php


class StudentTariff extends AbstractTariff
{
    protected string $description = "Тариф Студенческий";

    public function __construct(int $pricePerDistance = 0, int $pricePerDuration = 0)
    {
        parent::__construct($pricePerDistance, $pricePerDuration);
    }

    public function cost($info): int
    {
        return $info->getDistance() * $this->pricePerDistance + $info->getDuration() * $this->pricePerDuration;
    }
}
