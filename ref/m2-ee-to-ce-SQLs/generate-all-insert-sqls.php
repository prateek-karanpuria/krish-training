<?php

/**
 * Generate SQL for inserting data from database table 1 to database table 2
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

function print2($content = '', $die = 0)
{
    echo '<pre>';
    print_r($content);
    echo '</pre>';

    if ($die) exit;
}

$directoryPath = 'StudentKareSQLs';
$db1_name = 'studentkare';
$db2_name = 'ee_studentkare';


$content = '';
foreach (glob($directoryPath."/*/*.sql") as $i => $filename) {
    if (stripos($filename, '--do-not-use-this-folder') === false
        && stripos($filename, 'amasty_amshopby_cms_page') === false
        && stripos($filename, 'catalogsearch_fulltext_scope6') === false)
    {
        $sqlContent = file_get_contents($filename);
        
        $sqlContent = str_ireplace(['SET GLOBAL FOREIGN_KEY_CHECKS=0;', 'SET GLOBAL FOREIGN_KEY_CHECKS=1;'], '', $sqlContent);

        $sqlContent = str_ireplace('m231_studentkare_live_22112019', $db2_name, $sqlContent);
        $sqlContent = str_ireplace('m231_studentkare', $db1_name, $sqlContent);

        $content .= $sqlContent;
    }
}

echo "SET GLOBAL FOREIGN_KEY_CHECKS=0;";
print2($content);
echo "SET GLOBAL FOREIGN_KEY_CHECKS=1;";
