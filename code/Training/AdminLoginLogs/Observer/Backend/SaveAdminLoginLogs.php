<?php

/**
 * Save Admin use login activity
 */

namespace Training\AdminLoginLogs\Observer\Backend;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\Header;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\User\Model\User;
use Training\AdminLoginLogs\Model\AdminLoginLogsFactory;

/**
 * class SaveAdminLoginLogs
 * @package Training\AdminLoginLogs\Observer\Backend
 */
class SaveAdminLoginLogs implements ObserverInterface
{
    /**
     * @var Header
     */
    protected $httpHeader;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @var RemoteAddress
     */
    protected $remoteAddress;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var AdminLoginLogsFactory
     */
    protected $adminLoginLogsFactory;

    public function __construct(
        Header $httpHeader,
        RemoteAddress $remoteAddress,
        TimezoneInterface $timezone,
        ScopeConfigInterface $scopeConfig,
        AdminLoginLogsFactory $adminLoginLogsFactory
    )
    {
        $this->httpHeader = $httpHeader;
        $this->remoteAddress = $remoteAddress;
        $this->timezone = $timezone;
        $this->scopeConfig = $scopeConfig;
        $this->adminLoginLogsFactory = $adminLoginLogsFactory->create();
    }

    /**
     * [execute description]
     * @param  EventObserver $observer [description]
     * @return [type]                  [description]
     */
    public function execute(EventObserver $observer)
    {
        /**
         * NOTE:
         * -----
         * 
         * If value saved as "Yes/No" then value will be saved in core_config_data 
         *
         * If value saved as Use system value then value will not be saved in core_config_data & system will read
         * it's value from config.xml file. 
         */

        if ($this->scopeConfig->getValue('adminloginlogs/general/module_enable', ScopeInterface::SCOPE_STORE)) {
            $user = $observer->getEvent()->getUser();
            $authResult = $observer->getEvent()->getResult();

            $data = array(
                'name'       => $user->getUserName() ?? '',
                'user_ip'    => $this->remoteAddress->getRemoteAddress(),
                'user_agent' => $this->httpHeader->getHttpUserAgent(),
                'status'     => $authResult ?? 0,
                'added_on'   => $this->timezone->date()->format('Y-m-d H:i:s'),
            );

            try {
                $this->adminLoginLogsFactory->setData($data)->save();

            } catch (Exception $exception) {
                $this->messageManager->addErrorMessage(__("Admin Login Log record save failed!"));
            }
        }
    }
}
