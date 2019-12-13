<?php
// phpinfo();exit;
// ini_set('memory_limit', '500M');
// ini_set('max_execution_time', 0);
// error_reporting(E_ALL | E_STRICT);
// ini_set('display_errors', 1);
// try {
//  if (!file_exists('/mnt/projects/treadmillfactory/html/pub/static/vp')) {
//      mkdir('/mnt/projects/treadmillfactory/html/pub/static/vp', 0777, true);
//  }
//  copy('/mnt/projects/treadmillfactory/html/test.xml', '/mnt/projects/treadmillfactory/html/pub/static/vp/test.xml');
//  echo "copy";    
// } catch (Exception $e) {
//  echo $e->getMessage();
// }
#phpinfo();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '5G');
error_reporting(E_ALL);

use Magento\Framework\App\Bootstrap;
require 'app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
// $state->setAreaCode('adminhtml');
// $categories = $objectManager->get('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
// echo "string";
// die;
$token = '1c02fbaa';
$cache = $objectManager->get('\Magento\Framework\App\CacheInterface');
$timersCacheId = sprintf('%s_%s', 'MGT_DEVELOPER_TOOLBAR_PROFILE_TIMERS', $token);
$timers = $cache->load($timersCacheId);
echo count($timers);
die;
















die;
$categoryModel = $objectManager->get('Magento\Catalog\Model\CategoryRepository');
$json = file_get_contents('category.json');
$categories = json_decode($json,true);
echo "<pre>";
$i = 1;
// print_r($categories);
foreach ($categories as $id => $data) {
    // if($i <= 10)
    // {
        if(!isset($data['url_key']))
        {
            continue;
        }
        // echo $id;
        // echo "<br>";
        // print_r($data);
        $category = $objectManager->get('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory')->create()->addIdFilter($id)->addAttributeToSelect('*')->getFirstItem();
        // print_r($category->getData());
        // die;
        // $category->save();
        // die;
        // print_r($data);
        // $category = $categoryModel->get($id);
        if(isset($data['attribute_set_id']))
        {
            $category->setAttributeSetId($data['attribute_set_id']);
        }
        if(isset($data['parent_id']))
        {
            $category->setParentId($data['parent_id']);
        }
        if(isset($data['path']))
        {
            $category->setPath($data['path']);
        }
        if(isset($data['position']))
        {
            $category->setPosition($data['position']);
        }
        if(isset($data['level']))
        {
            $category->setLevel($data['level']);
        }
        if(isset($data['description']))
        {
            $category->setDescription($data['description']);
        }
        if(isset($data['meta_keywords']))
        {
            $category->setMetaKeywords($data['meta_keywords']);
        }
        if(isset($data['meta_description']))
        {
            $category->setMetaDescription($data['meta_description']);
        }
        if(isset($data['navigation_header']))
        {
            $category->setNavigationHeader($data['navigation_header']);
        }
        if(isset($data['navigation_footer']))
        {
            $category->setNavigationFooter($data['navigation_footer']);
        }

        if(isset($data['product_meta_title_tpl']))
        {
            $category->setProductMetaTitleTpl($data['product_meta_title_tpl']);
        }
        if(isset($data['umm_cat_block_right']))
        {
            $category->setUmmCatBlockRight($data['umm_cat_block_right']);
        }
        if(isset($data['umm_cat_block_top']))
        {
            $category->setUmmCatBlockTop($data['umm_cat_block_top']);
        }
        if(isset($data['layout_top_description']))
        {
            $category->setLayoutTopDescription($data['layout_top_description']);
        }
        if(isset($data['layout_bottom_description']))
        {
            $category->setLayoutBottomDescription($data['layout_bottom_description']);
        }
        if(isset($data['url_key']))
        {
            $category->setUrlKey($data['url_key']);
        }
        if(isset($data['image']))
        {
            $category->setImage($data['image']);
        }
        if(isset($data['url_path']))
        {
            $category->setUrlPath($data['url_path']);
        }
        if(isset($data['category_image']))
        {
            $category->setCategoryImage($data['category_image']);
        }
        $category->save();
    // }
    $i++;
}
?>
