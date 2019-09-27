<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    public function __construct(
        ActionFactory $actionFactory
    )
    {
        $this->actionFactory = $actionFactory;

    }

    public function match(RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');
        $paths = explode('/', $path);

        if (strpos($path, 'testimonial') !== false) {
            $request->setModuleName($paths[0])->setControllerName($paths[1])->setActionName($paths[2]);
        } else {
            // There is no match
            return;
        }

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward', ['request' => $request]);
    }
}
