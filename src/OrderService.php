<?php

namespace Respina;

class OrderService
{
    public function estimateCost(int $quantity, string $color): float
    {
        $base = 1.25;
        $colorSurcharge = $color === 'color' ? 0.75 : 0.00;

        return round($quantity * ($base + $colorSurcharge), 2);
    }
}
