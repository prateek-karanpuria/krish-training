<?php

namespace Training\FeaturedProduct\Block;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class Index extends Template
{

    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }
}
