<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    protected $actionFactory;

    public function __construct(
        ActionFactory $actionFactory
    )
    {
        $this->actionFactory = $actionFactory;

    }

    public function match(RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');
        $paths = explode('-', $path);

        $request->setModuleName('testimonial')->setControllerName('index')->setActionName($paths[2] ?? 'index');

        if (strpos($path, 'customer') !== false && strpos($path, 'login')) {
            $request->setModuleName('customer')->setControllerName('account')->setActionName('login');
        }

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward', ['request' => $request]);
    }
}
