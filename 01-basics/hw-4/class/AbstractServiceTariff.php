<?php


abstract class AbstractServiceTariff implements TariffInterface
{
    protected int $servicePrice;
    protected TariffInterface $tariff;
    protected string $description;

    public function __construct(TariffInterface $tariff, int $servicePrice)
    {
        $this->servicePrice = $servicePrice;
        $this->tariff = $tariff;
    }
    public function getDescription(MoveInterface $info): string
    {
        return "{$this->tariff->getDescription($info)}<br>- Добавить услугу '{$this->description}'";
    }
    abstract public function cost(MoveInterface $info): int;
}
