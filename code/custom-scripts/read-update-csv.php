<?php

function print2($content = '') {
    echo '<pre>';
    print_r($content);
    echo '</pre>';
}

$fh = fopen('sample.csv', 'r');

$skipRowCellContent = ['Brand SKU Code', 'Vendor SKU#'];

$image_folder_name = 'HOB-Images';
$ignored_files = ['Thumbs.db'];

/**
 * Read HOB-Images folder
 */
$files = [];
foreach (glob($image_folder_name."/*/*") as $i => $filename) {
    $file_info = pathinfo($filename);
    $directory_path = __DIR__.DIRECTORY_SEPARATOR.$file_info['dirname'].DIRECTORY_SEPARATOR;
    $basefile_name  = $file_info['basename'];

    if (!in_array($basefile_name, $ignored_files)) {
        $f_name = str_replace($image_folder_name.DIRECTORY_SEPARATOR, '', $file_info['dirname'].DIRECTORY_SEPARATOR.$basefile_name);
        list($folder_name, $file_name) = explode('/', $f_name);

        $files[$folder_name][] = $f_name;
    }
}


if ($fh) {
    $new_fh = fopen('required-sample.csv', 'a+');

    for ($row = 0; $rowData = fgetcsv($fh); $row++) {
        if (!in_array($rowData[1], $skipRowCellContent) && $files[$rowData[1]]) {
            $rowData[60]       = '/'.$files[$rowData[1]][0];

            $additional_images = str_replace($files[$rowData[1]][0].',', '', implode(',', $files[$rowData[1]]));
            $additional_images = str_replace($files[$rowData[1]][0], '', $additional_images);
            $rowData[]         = !empty($additional_images) ? '/'.str_replace(',', ',/', $additional_images) : $additional_images;
        }
        @fputcsv($new_fh, $rowData);
    }
    @fclose($new_fh);
    @fclose($fh);
}

