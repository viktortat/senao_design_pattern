<?php

declare(strict_types=1);

namespace App\Decorator\PriceDecorator;

/**
 * Class TwentyPercentOffDecorator
 * @package App\Decorator\PriceDecorator
 */
final class TwentyPercentOffDecorator extends AbstractPricePriceDecorator
{
    /**
     * @param int $totalPrice
     * @return int
     */
    public function getPrice(int $totalPrice): int
    {
        return (int)($this->decorator->getPrice($totalPrice) * 0.8);
    }
}
