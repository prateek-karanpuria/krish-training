<?php
require_once 'Mage/Newsletter/controllers/SubscriberController.php'; 
class Wage_Newsletter_SubscriberController extends Mage_Newsletter_SubscriberController
{
	
     function _redirectReferer()
     {

        $refererUrl = $this->_getRefererUrl();
        if (empty($refererUrl)) {
            $refererUrl = empty($defaultUrl) ? Mage::getBaseUrl() : $defaultUrl;
        }
 
          /*inject ignore global full page cache param*/
          if (!strpos($refererUrl, '?___store'))
          {
               $refererUrl .= '?___store';
          }
          /*end of hacking*/
 
        $this->getResponse()->setRedirect($refererUrl);
          //parent::_redirectReferer($url); // call _redirectReferer from Mage_Core_Controller_Varien_Action
        return $this;
     }
}
