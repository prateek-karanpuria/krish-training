<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function print2($content = '') {
    echo '<pre>';
    print_r($content);
    echo '</pre>';
}

// $not_allowed_ext = array(
//     'jpg',
//     'jpeg',
//     'ttf',
//     'ai',
//     'eps',
//     'png',
//     'bmp',
//     'tif',
//     'svg',
// );

$image_folder_name = 'HOB-Images';
$ignored_files = ['Thumbs.db'];

$files = [];
foreach (glob($image_folder_name."/*/*") as $i => $filename) {
    $file_info = pathinfo($filename);
    $directory_path = __DIR__.DIRECTORY_SEPARATOR.$file_info['dirname'].DIRECTORY_SEPARATOR;
    $basefile_name  = $file_info['basename'];

    if (!in_array($basefile_name, $ignored_files)) {
        $f_name = str_replace($image_folder_name.DIRECTORY_SEPARATOR, '', $file_info['dirname'].DIRECTORY_SEPARATOR.$basefile_name);
        list($folder_name, $file_name) = explode('/', $f_name);

        $files[$folder_name][] = DIRECTORY_SEPARATOR.$f_name;
    }

    // if (!in_array($basefile_name, $ignored_files)) {
    //     $old_filename = $basefile_name;
    //     $new_filename = str_replace(array('(', ')'), '', str_replace(' ', '_', $old_filename));
    //     rename($directory_path.$old_filename, $directory_path.$new_filename);
    // }
}
print2($files);

// natcasesort($files);
// //print2($files);

// $final_files = [];
// if ($files) {
//     foreach ($files as $file) {
//         $file_name_parts = explode('/', $file);
        
//         $final_files[$file_name_parts[1]][] = $file_name_parts[2];
//     }
// }

// echo "Total Vendors: ".count(array_keys($final_files));
// echo "<br >Total Attachment Files: ".count(array_values($files));

// print2($final_files);
