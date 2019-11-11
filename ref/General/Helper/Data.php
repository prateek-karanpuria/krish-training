<?php
namespace Ktpl\General\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper {

    const FREESHIPPING_CUTOFF = "ktpl_general/general/freeshipping_cutoff";
    const MINICART_TOOLTIP = "ktpl_general/general/minicart_tooltip";

    protected $_scopeConfig;
    protected $_productRepository;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ProductRepository $productRepository
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_productRepository = $productRepository;
    }

    public function getFreeShippingCutoff(){
        return $this->_scopeConfig->getValue(self::FREESHIPPING_CUTOFF, ScopeInterface::SCOPE_STORE);
    }

    public function getMinicartTooltipText(){
        return $this->_scopeConfig->getValue(self::MINICART_TOOLTIP, ScopeInterface::SCOPE_STORE);
    }

    public function getProductById($id){
        return $this->_productRepository->getById($id);
    }
}