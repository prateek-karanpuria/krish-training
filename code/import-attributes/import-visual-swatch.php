<?php

use Magento\Framework\App\Bootstrap;
require __DIR__ . '/app/bootstrap.php';
// adding bootstrap
$bootstraps = Bootstrap::create(BP, $_SERVER);
$object_Manager = $bootstraps->getObjectManager();

$app_state = $object_Manager->get('\Magento\Framework\App\State');
$app_state->setAreaCode('frontend');

// Visual Swatch option values array containing name, unique code as key and image url for swatch
// Swatch image are to be placed within "project_root\images" directory
// After code execution swatch images will be uploaded to "project_root\pub\media\attribute\swatch" directory

$finalProductData = array(
    'Green' => "Black.JPG",
    'Lavender' => "Black1.JPG",
    'Multi' => "Black.JPG",
    'Orange' => "Black1.JPG",
    'Purple' => "Black.JPG",
    'ABC' => "Black1.JPG",
    '01-Gel Based' => "Black1.JPG",
    'PQR' => "Black.JPG",
 );

//$stores = getAllStores($object_Manager);

$eavConfig = $object_Manager->get('\Magento\Eav\Model\Config');
$attribute = $eavConfig->getAttribute('catalog_product', 'color');
$allOptions = $attribute->getSource()->getAllOptions();

// Generating options as we are creating Visual Swatch hence passing 'visual' as parameter 
$data = generateOptions($finalProductData, $allOptions, 'visual');
$filesystem = $object_Manager->create('\Magento\Framework\Filesystem');

// Prepare visual swatches files.
$mediaDirectory = $filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
$productMediaConfig = $object_Manager->create('\Magento\Catalog\Model\Product\Media\Config');
$tmpMediaPath = $productMediaConfig->getBaseTmpMediaPath();
$fullTmpMediaPath = $mediaDirectory->getAbsolutePath($tmpMediaPath);

$driverFile = $object_Manager->create('\Magento\Framework\Filesystem\Driver\File');
$driverFile->createDirectory($fullTmpMediaPath);
$swatchHelper = $object_Manager->create('\Magento\Swatches\Helper\Media');

//echo "<pre>";print_r($data);die;
foreach ($data as $key => $attributeOptionsData) {
    if($key == "swatchvisual" ){
        $swatchVisualFiles = isset($attributeOptionsData['value'])
        ? $attributeOptionsData['value']
        : [];
        //echo "<pre>";print_r($attributeOptionsData);
        foreach ($swatchVisualFiles as $index => $swatchVisualFile) {
            if(!empty($swatchVisualFile)){
                //echo __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $swatchVisualFile;die;
                if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $swatchVisualFile)) {
                    $driverFile->copy(
                    __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $swatchVisualFile,
                    $fullTmpMediaPath . '/' . $swatchVisualFile
                    );

                    $newFile = $swatchHelper->moveImageFromTmp($swatchVisualFile);
                    if (substr($newFile, 0, 1) == '.') {
                        $newFile = substr($newFile, 1); // Fix generating swatch variations for files beginning with ".".
                    }
                    $swatchHelper->generateSwatchVariations($newFile);
                    //echo $key." ".$index.' '.$newFile."<br/>";
                    $data[$key]['value'][$index] = $newFile;
                } else {
                    $data[$key]['value'][$index] = "";
                }
            }
        }
    }    
}
//die;
//echo "<pre>";print_r($data);die;
$attribute->addData($data)->save();
//die;
//echo "<pre>";print_r($data);die;
function generateOptions($values, $allOptions, $swatchType = 'visual')
{
    //$i = 0;
    // $counter = 0;
     //echo "<pre>";print_r($allOptions); //die;
    foreach ($allOptions as $allOption) {
        $options[$allOption['label']] = $allOption['value'];
    }
    $i = max($options)+1;
    //asort($options);
    // echo "<pre>";print_r($options);
    // echo "<pre>";print_r($values); die;
    foreach ($values as $key => $value) {

        if (in_array($key, array_keys($options))) {
            $order[$options[$key]]        = $options[$key];
            $optionsStore[$options[$key]] = [$key,$key];
            $visualSwatch[$options[$key]] = $value;
            $delete[$options[$key]]       = '';
        } else{
            $order["option_{$i}"]        = $i;
            $optionsStore["option_{$i}"] = [$key, $key];
            $visualSwatch["option_{$i}"] = $value;
            $delete["option_{$i}"]       = '';
            $i++; 
        }
         
    }
    //echo "<pre>";print_r($visualSwatch);die;
    //die;
    
     
    switch ($swatchType)
    {
        case 'visual':
            return [
                'optionvisual' => [
                    'order'     => $order,
                    'value'     => $optionsStore,
                    'delete'    => $delete,
                ],
                'swatchvisual' => [
                    'value'     => $visualSwatch,
                ],
            ];
            break;

        default:
            return [
                'option' => [
                    'order'     => $order,
                    'value'     => $optionsStore,
                    'delete'    => $delete,
                ],
            ];
    }
}
echo "<pre>";print_r($data);//die;
?>
