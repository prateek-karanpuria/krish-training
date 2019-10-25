<?php

function print2($content = '') {
    echo '<pre>';
    print_r($content);
    echo '</pre>';
}

$not_allowed_ext = array(
    'jpg',
    'jpeg',
    'ttf',
    'ai',
    'eps',
    'png',
    'bmp',
    'tif',
    'svg',
);

$files = [];
foreach (glob("vendor-collaterals-30-09-2019/*/*") as $i => $filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array(strtolower($ext), $not_allowed_ext)) {
        $files[$i] = $filename;
    }
}

natcasesort($files);
//print2($files);

$final_files = [];
if ($files) {
    foreach ($files as $file) {
        $file_name_parts = explode('/', $file);
        
        $final_files[$file_name_parts[1]][] = $file_name_parts[2];
    }
}

echo "Total Vendors: ".count(array_keys($final_files));
echo "<br >Total Attachment Files: ".count(array_values($files));

print2($final_files);
