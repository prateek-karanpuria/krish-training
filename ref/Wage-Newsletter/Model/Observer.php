<?php

class Wage_Newsletter_Model_Observer extends Mage_Core_Model_Abstract
{
    public function subscribeNewsletter($observer)
    {
        $willSubscribe = Mage::app()->getRequest()->getParam('subscribe');

        if ($willSubscribe) {
            $email = $observer->getEvent()->getOrder()->getData('customer_email');
            Mage::getModel('newsletter/subscriber')->subscribe($email, true);
        }
        return $this;
    }
}
