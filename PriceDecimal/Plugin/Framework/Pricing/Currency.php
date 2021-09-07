<?php


namespace UdeyTech\PriceDecimal\Plugin\Framework\Pricing;

class Currency
{
    /**
     * @var \UdeyTech\PriceDecimal\Helper\Data
     */
    protected $priceDecimalHelperData;

    /**
     * @param \UdeyTech\PriceDecimal\Helper\Data $priceDecimalHelperData
     */
    public function __construct(
        \UdeyTech\PriceDecimal\Helper\Data $priceDecimalHelperData
    ) {
        $this->priceDecimalHelperData = $priceDecimalHelperData;
    }

    /**
     * {@inheritdoc}
     *
     * @param \Magento\Framework\CurrencyInterface $subject
     * @param array $args
     *
     * @return array
     */
    public function beforeToCurrency(
        \Magento\Framework\CurrencyInterface $subject,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                $args[1]['precision'] = $this->priceDecimalHelperData->getDecimalLength();
            } else {
                $args[1]['precision'] = 0;
            }
        }

        return $args;
    }
}
