<?php

namespace Ktpl\General\Plugin\Magento\Checkout\Block;

use Magento\Checkout\Block\Cart as CheckoutCart;

class Cart
{
    protected $redirect;

    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect
    )
    {
        $this->redirect = $redirect;
    }

    public function beforeGetContinueShoppingUrl(CheckoutCart $subject)
    {
        $redirectUrl = $this->redirect->getRefererUrl();
        $subject->setData('continue_shopping_url', $redirectUrl);
        return $this;
    }
}