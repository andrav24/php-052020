<?php


class DriverService extends AbstractServiceTariff
{
    protected string $description = "Водитель";

    public function __construct(TariffInterface $tariff, int $servicePrice)
    {
        parent::__construct($tariff, $servicePrice);
    }

    public function cost(MoveInterface $info): int
    {
        return $this->servicePrice + $this->tariff->cost($info);
    }
}
