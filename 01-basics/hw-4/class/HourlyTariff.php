<?php


class HourlyTariff extends AbstractTariff
{
    protected int $timingPeriod;
    protected string $description = "Тариф Почасовой";

    public function __construct(int $pricePerDistance = 0, int $pricePerDuration = 0, int $timingPeriod = 0)
    {
        $this->timingPeriod = $timingPeriod;
        if ($pricePerDistance !== 0) {
            $pricePerDistance = 0;
        }
        parent::__construct($pricePerDistance, $pricePerDuration);
    }

    public function cost($info): int
    {
        return ceil($info->getDuration() / $this->timingPeriod) * $this->pricePerDuration;
    }
}
