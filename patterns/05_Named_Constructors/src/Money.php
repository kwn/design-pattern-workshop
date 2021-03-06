<?php
namespace DesignPatterns\NamedConstructor;

class Money
{
    /** @var float */
    private $floatValue;

    /** @var string */
    private $currencySymbol;

    /**
     * @param float  $floatValue
     * @param string $currencySymbol
     */
    public function __construct($floatValue, $currencySymbol)
    {
        $this->floatValue = $floatValue;
        $this->currencySymbol = $currencySymbol;
    }

    /**
     * @param string $moneyAsString
     * @return Money
     */
    public static function constructFromString($moneyAsString)
    {
        $numberFormatter = new \NumberFormatter('en_GB', \NumberFormatter::CURRENCY);

        $amount = $numberFormatter->parseCurrency($moneyAsString, $currencyIsoCode);
        $symbol = str_replace($amount, '', $moneyAsString);

        return new Money($amount, $symbol);
    }

    /**
     * @param float $floatValue
     * @return Money
     */
    public static function constructFromFloatValueInPounds($floatValue)
    {
        return new Money($floatValue, '£');
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    /**
     * @return float
     */
    public function getFloatValue()
    {
        return $this->floatValue;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->currencySymbol . number_format($this->floatValue, 2);
    }
}
