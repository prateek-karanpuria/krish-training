<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Timeslot\Model\Renderer;

class Countrystate extends \Magento\Ui\Component\Listing\Columns\Column 
{

    protected $countryHelper;
    protected $countryFactory;


    public function __construct(
        \Magento\Directory\Model\Config\Source\Country $countryHelper,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ){
        $this->countryHelper = $countryHelper;
        $this->countryFactory = $countryFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) 
    {
        if (isset($dataSource['data']['items'])) 
        {
            foreach ($dataSource['data']['items'] as & $item) 
            {
               $countries = $this->countryHelper->toOptionArray();
                foreach ( $countries as $countryKey => $country ) 
                {
                    if ( $country['value'] != '' ) 
                    { 
                        if($country['value'] == $item['country_id'])
                        {
                            $item['country_id'] = $country['label'];
                            $stateArray = $this->countryFactory->create()->setId($country['value'])->getLoadedRegionCollection()->toOptionArray();
                            if ( count($stateArray) > 0 ) 
                            { 
                                foreach ($stateArray as $values) 
                                {
                                    if($values['value'] == $item['state_id'])
                                    {
                                        $item['state_id'] = $values['label'];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $dataSource;
    }
}