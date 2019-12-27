<?php

namespace Ktpl\ApiConnector\Model\Query;

class CategoryProducts
{
    public $productRepository;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository->create();
    }

    public static function getProductList()
    {
        //$this->productRepository->getList();
        echo 'in';
    }
}
