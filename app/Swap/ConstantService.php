<?php

namespace App\Swap;

use Exchanger\Contract\ExchangeRateQuery;
use Exchanger\Contract\ExchangeRate;
use Exchanger\Service\HttpService;

class ConstantService extends HttpService
{
    /**
     * Gets the exchange rate.
     *
     * @param ExchangeRateQuery $exchangeQuery
     *
     * @return ExchangeRate
     */
    public function getExchangeRate(ExchangeRateQuery $exchangeQuery): ExchangeRate
    {
        // If you want to make a request you can use
        // $content = $this->request('http://example.com');

        return $this->createInstantRate($exchangeQuery->getCurrencyPair(), $this->options['value']);
    }

    /**
     * Processes the service options.
     *
     * @param array &$options
     *
     * @return void
     */
    public function processOptions(array &$options): void
    {
        if (!isset($options['value'])) {
            throw new \InvalidArgumentException('The "value" option must be provided.');
        }
    }

    /**
     * Tells if the service supports the exchange rate query.
     *
     * @param ExchangeRateQuery $exchangeQuery
     *
     * @return bool
     */
    public function supportQuery(ExchangeRateQuery $exchangeQuery): bool
    {
        // For example, our service only supports EUR as base currency
        return 'EUR' === $exchangeQuery->getCurrencyPair()->getBaseCurrency();
    }

    /**
     * Gets the name of the exchange rate service.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'constant';
    }
}
