<?php
class CreativeArc_NewsletterCheckbox_Model_Observer extends Mage_Core_Model_Abstract { 
	
	public function salesQuoteSaveBefore($observer) { 
	
		$quote = $observer->getQuote();
		//$data = $observer->getEvent()->getRequest()->getPost('billing', array());
		$data = Mage::app()->getRequest()->getPost('billing', array());
		$chkbox = isset($data['newsletter']) && $data['newsletter'];
		
		if ($chkbox == 1) {
			$quote->setCaNewsletter(1);
		} //else {
			//$quote->setCaNewsletter(0);
		//}
		
	}
	
	public function salesEventConvertQuoteToOrder($observer) {
    	
		$quote = $observer->getEvent()->getQuote();
		
	    if ($caNewsletter = $quote->getCaNewsletter()) {
	        $observer->getEvent()->getOrder()->setCaNewsletter($caNewsletter);
	    }
	
        return $this;
    }

}