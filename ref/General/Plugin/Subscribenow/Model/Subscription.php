<?php

namespace Ktpl\General\Plugin\Subscribenow\Model;
use Magedelight\Subscribenow\Model\Source\PurchaseOption;
class Subscription
{
	public function aroundIsValidBuyFromList(
		\Magedelight\Subscribenow\Model\Subscription $subject,
		\Closure $proceed,
		$product
	) {

		$result = $proceed($product);
		$isSubscriptionProduct = $product->getIsSubscription();
        $productSubscriptionType = $product->getSubscriptionType();
        $defineStartFrom = $product->getDefineStartFrom();
        $billingPeriodDefineBy = $product->getBillingPeriodType();
        $request = $subject->request->getFullActionName();
        $actionArray = [
        	"catalog_product_view",
        	"generalaction_index_productlist",
        	"productslider_ajax_randomproducts",
        	"cms_index_index",
        	"catalog-category-view",
        	"catalogsearch_result_index"
        ];

        if (!in_array($request, $actionArray)
            && $isSubscriptionProduct == '1'
            && ($productSubscriptionType == PurchaseOption::EITHER
                || $defineStartFrom == "defined_by_customer"
                || $billingPeriodDefineBy == "customer")
        ) {
            return false;
        }
        return true;
	}
}