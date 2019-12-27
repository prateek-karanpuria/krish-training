<?php

namespace Ktpl\ApiConnector\Helper;

/**
 * HelperMethods class
 * @package Ktpl\ApiConnector\Helper
 */
class HelperMethods
{
    public $serviceOutputProcessor;

    /**
     * Helper constructor
     * 
     * @param \Magento\Framework\Webapi\ServiceOutputProcessor $serviceOutputProcessor
     */
    public function __construct(
        \Magento\Framework\Webapi\ServiceOutputProcessor $serviceOutputProcessor
    )
    {
        $this->serviceOutputProcessor = $serviceOutputProcessor;
    }

    /**
     * Prepare response for custom data
     *
     * @param array $inputParams
     * @param string
     * @param string
     * @param object $service
     * @return array
     */
    public function prepareResponse($serviceMethodName, $serviceClassName, $service, $inputParams = [])
    {
        if ($inputParams) $output = call_user_func_array([$service, $serviceMethodName], $inputParams);

        $output = $this->serviceOutputProcessor->process($output, $serviceClassName, $serviceMethodName);

        return $output;
    }

    /**
     * For action class file name 'category-product', class file 'CategoryProduct' will be used.
     * 
     * @param  string $actionFile
     * @return string
     */
    public function getClassName($actionFile)
    {
        $actionFile = strtolower($actionFile);

        $actionFileParts = explode('-', trim($actionFile));
        $actionFileParts = array_map('ucfirst', $actionFileParts);

        $actionFile = implode("", $actionFileParts);

        return $actionFile;
    }

    /**
     * For action method name 'get-category-product', method 'getCategoryProduct' will be executed.
     * 
     * @param  string $actionMethod
     * @return string
     */
    public function getMethodName($actionMethod)
    {
        $actionMethod = strtolower($actionMethod);

        $actionMethodParts = explode('-', trim($actionMethod));
        $actionMethodParts = array_map('ucfirst', $actionMethodParts);

        $actionMethod = implode("", $actionMethodParts);
        $actionMethod = lcfirst($actionMethod);

        return $actionMethod;
    }
}
