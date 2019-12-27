<?php

namespace Reciproci\CommitApis\Plugin\Rma;

use Reciproci\CommitApis\Helper\Notifications\OrderApiNotifications;

class RmaNotificationPlugin
{
    public function __construct(OrderApiNotifications $helper)
    {
        $this->helper = $helper;
    }

    public function afterSaveRma(\Ktpl\ExtendedRma\Model\Rma $subject, $result)
    {
        $templateVars = [
            'customer_name' => 'Manish Chaubey',
            'subject' => "Boddess RMA notification",
            'message'   => 'RMA Placed successfully'
        ];
        $this->helper->setEmailTemplate($templateVars);
        return $result;

    }

}
