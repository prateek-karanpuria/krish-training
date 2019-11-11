<?php
namespace Ktpl\ShippingDate\Ui\DataProvider;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    /**
     * @param \Magento\Framework\Api\Filter $filter
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        if ($filter->getField() == 'website_id') {
            $filter->setConditionType('finset');
        }
        parent::addFilter($filter);
    }
}
