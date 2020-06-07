<?php


class GPSService extends AbstractServiceTariff
{
    protected int $timingPeriod;
    protected string $description = "GPS";

    public function __construct(TariffInterface $tariff, int $servicePrice = 0, int $timingPeriod = 60)
    {
        $this->timingPeriod = $timingPeriod;
        parent::__construct($tariff, $servicePrice);
    }

    public function cost(MoveInterface $info): int
    {

        return ceil($info->getDuration() / $this->timingPeriod) * $this->servicePrice + $this->tariff->cost($info);
    }
}
