<?php
namespace Reciproci\CommitApis\Helper\Notifications;

use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class OrderApiNotifications extends AbstractHelper
{
    protected $storeManager;
    protected $_transport;
    protected $_transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Mail\Template\TransportBuilder $_transportBuilder,
        \Magento\Framework\Mail\TransportInterface $_transport,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig
    ){
        $this->storeManager = $storeManager;
        $this->_transport = $_transport;
        $this->_transportBuilder = $_transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
    }
    public function setEmailTemplate($templateVars)
    {
        $templateOptions = [
            'area' => \Magento\Framework\App\Area::AREA_FRONTEND, 
            'store' => $this->storeManager->getStore()->getId()
        ];
        $adminEmail = $this->scopeConfig->getValue('trans_email/ident_support/email',ScopeInterface::SCOPE_STORE);
        
        $from = array('email' => $adminEmail, 'name' => 'Boddess');

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $this->inlineTranslation->suspend();

        $notificationsEmail = $this->scopeConfig->getValue('customer_management/emailnotification/customer_email_notification',ScopeInterface::SCOPE_STORE);
        if($notificationsEmail) {
            $to = explode(',', $notificationsEmail);
            $transport = $this->_transportBuilder->setTemplateIdentifier('reciproci_template', $storeScope)
                        ->setTemplateOptions($templateOptions)
                        ->setTemplateVars($templateVars)
                        ->setFrom($from)
                        ->addTo($to)
                        ->getTransport();
        
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        }
        //print_r($to);die;
    }
}
