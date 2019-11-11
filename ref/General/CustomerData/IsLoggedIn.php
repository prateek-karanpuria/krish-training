<?php

namespace Ktpl\General\CustomerData;

class IsLoggedIn extends \Magento\Framework\DataObject implements \Magento\Customer\CustomerData\SectionSourceInterface
{
    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    private $customerSession;
    /**
     * Cartweight constructor.
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        parent::__construct($data);
        $this->customerSession = $customerSession;
    }

    public function getSectionData()
    {
        if ($this->customerSession->isLoggedIn()) {
            $firstname = $this->customerSession->getCustomer()->getFirstname();
            return [
                'firstname' => $firstname
            ];
        }

    }
}
