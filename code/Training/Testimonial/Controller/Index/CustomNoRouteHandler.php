<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Framework\App\RequestInterface;

class CustomNoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    public function process(RequestInterface $request)
    {
        $request->setRouteName("testimonial")->setControllerName("index")->setActionName("customnoroute");

        return true;
    }
}
