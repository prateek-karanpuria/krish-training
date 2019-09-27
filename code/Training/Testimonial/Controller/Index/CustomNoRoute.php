<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class CustomNoRoute extends Action
{
    public function execute()
    {
        echo 'in custom no route Controller';
    }
}
