<?php

/**
 * Data patch class to add default records in training_admin_login_logs table.
 */

namespace Training\AdminLoginLogs\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\HTTP\Header;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

/**
 * class CreateDefaultAdminLogs
 * @package Training\AdminLoginLogs\Setup\Patch\Data
 */
class CreateDefaultAdminLogs implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var RemoteAddress
     */
    protected $remoteAddressObj;

    /**
     * @var Header
     */
    protected $headerObj;

    /**
     * [__construct description]
     * @param ModuleDataSetupInterface $moduleDataSetup  [description]
     * @param RemoteAddress            $remoteAddressObj [description]
     * @param Header                   $headerObj        [description]
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        RemoteAddress $remoteAddressObj,
        Header $headerObj
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->remoteAddressObj = $remoteAddressObj;
        $this->headerObj = $headerObj;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * example of implementation:
     *
     * [
     *     \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *     \Vendor_Name\Module_Name\Setup\Patch\Patch2::class,
     * ]
     */
    public static function getDependencies()
    {
        return [
            #\Magento\Store\Setup\Patch\Schema\InitializeStoresAndWebsites::class
        ];
    }

    /**
     * Get aliases (previous name) for the patches
     *
     * Ex: [
     *         \Training\AdminLoginLogs\Setup\Patch\Data\CreateDefaultAdminLogs::class
     *     ]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * [apply description]
     * @return mix
     */
    public function apply()
    {
        $admin_login_log_info = [
            [
                'name'       => 'Test',
                'user_ip'    => $this->remoteAddressObj->getRemoteAddress(),
                'user_agent' => $this->headerObj->getHttpUserAgent(),
            ],
            [
                'name'       => 'Test 1',
                'user_ip'    => $this->remoteAddressObj->getRemoteAddress(),
                'user_agent' => $this->headerObj->getHttpUserAgent(),
            ]
        ];

        $records = array_map(function($admin_login_log_info) {
            global $remoteIp, $remoteAgent;

            return array_merge($admin_login_log_info, [
                'status'     => 1,
                'added_on'   => date('Y-m-d H:i:s'),
            ]);
        }, $admin_login_log_info);

        $this->moduleDataSetup->getConnection()->insertMultiple('training_admin_login_logs', $records);

        return $this;
    }
}
