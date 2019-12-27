<?php

namespace Ktpl\ApiConnector\Model;

/**
 * Result class
 * @package Ktpl\ApiConnector\Model
 */
class Result
{
    /**
     * @var string
     */
    const QUERY_MODEL_CLASS = '\Ktpl\ApiConnector\Model\Query\\';

    /**
     * @var Request
     */
    public $request;

    /**
     * @var HelperMethods
     */
    public $helperMethods;

    /**
     * @var Dynamic class object stack
     */
    public $dataProcessor;

    /**
     * Result class constructor
     * 
     * @param \Magento\Framework\Webapi\Rest\Request  $request
     * @param \Ktpl\ApiConnector\Helper\HelperMethods $helperMethods
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request,
        \Ktpl\ApiConnector\Helper\HelperMethods $helperMethods
    )
    {
        $this->request = $request;
        $this->helperMethods = $helperMethods;
    }

    /**
     * {@inheritdoc}
     */
    public function getResults()
    {
        $request = $this->request->getParams();

        $classFileFirstName = $classFileLastName = $data = '';

        /**
         * For action class file name 'category-product', class file 'CategoryProduct' will be used.
         */
        $actionFile = $this->helperMethods->getClassName($request['actionFile']) ?? '';

        /**
         * For action method name 'get-category-product', method 'getCategoryProduct' will be executed.
         */
        $actionMethod = $this->helperMethods->getMethodName($request['actionMethod']) ?? '';

        /**
         * Any additional data string like id/name
         * can be passed for the API call
         */
        $data = $request['data'] ?? '';
        $data = trim($data) ?? '';
    
        $classFileName = self::QUERY_MODEL_CLASS.$actionFile;

        /**
         * Display output
         */
        $result[] = 'No result found, try changing parameters';
        if (class_exists($classFileName))
        {
            try
            {
                $result = $this->getDataObject($classFileName)->$actionMethod($data);
            }
            catch (\Exception $exception)
            {
                $result = $exception->getMessage();
            }
        }

        return $result;
    }

    /**
     * Loads class based on name
     * 
     * @param  Dynamic classes $class
     * @return Dynamic class object
     */
    public function getDataObject($class)
    {
        if ($this->dataProcessor === null)
        {
            $this->dataProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get($class);
        }

        return $this->dataProcessor;
    }
}
