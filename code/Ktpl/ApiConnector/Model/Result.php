<?php

namespace Ktpl\ApiConnector\Model;

/**
 * Result class
 * @package Ktpl\ApiConnector\Model
 */
class Result
{
    public $request;

    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request
    )
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getResults()
    {
        $request = $this->request->getParams();

        $classFileFirstName = $classFileLastName = $data = '';

        $actionFile = $request['actionFile'] ?? '';

        if ($actionFile)
        {
            $actionFile = strtolower($actionFile);

            $actionFileParts = explode('-', trim($actionFile));
            $actionFileParts = array_map('ucfirst', $actionFileParts);

            $actionFile = implode("", $actionFileParts);
        }

        $actionMethod = $request['actionMethod'] ?? '';
        $data = $request['data'] ?? '';
    
        $classFileName = 'Ktpl\ApiConnector\Model\Query\\'.$actionFile;

        $result[] = 'No result found, try changing parameters';

        if (class_exists($classFileName))
        {
            try
            {
                $result = $classFileName::$actionMethod();
            }
            catch (\Exception $exception)
            {
                $result = $exception->getMessage();
            }
        }

        return $result;
    }
}
