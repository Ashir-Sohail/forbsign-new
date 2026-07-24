<?php

if (!function_exists('formatCurrency')) {
    /**
     * Format a currency value with the configured currency symbol.
     *
     * @param float $amount
     * @return string
     */
    function formatCurrency($amount)
    {
        return config('app.currency.symbol') . number_format($amount, 2);
    }
}
