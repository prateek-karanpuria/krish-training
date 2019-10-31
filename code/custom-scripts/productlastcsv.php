<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$generateImgDirPath = 'generated-hob-images-configurable-test';

$fh = @fopen('configmissingimg31oct.csv', 'r');
//echo"<pre>"; print_r(fgetcsv($fh));die;
if ($fh) {
    for ($i = 0; $row = fgetcsv($fh); $i++) {
        /**
         * Skip header
         */
        if ($i) {
            /**
             * Create directories if not present.
             */
            if (!is_dir($generateImgDirPath)) mkdir($generateImgDirPath, 0777);

            if (!is_dir($generateImgDirPath.DIRECTORY_SEPARATOR.$row[3])) {
                $dir_generated = @mkdir($generateImgDirPath.DIRECTORY_SEPARATOR.$row[3], 0777);
            } else {
                $dir_generated = true;
            }

            /**
             * If directory present then save images in the set media folder
             */
            if ($dir_generated) {
                /**
                 * Change column values according to csv file to get contents
                 * @var array
                 */
                $multiImage = [$row[59], $row[60]];
		foreach ($multiImage as $imgValue) {
                    if ($imgValue) {
                        $parts     = explode(DIRECTORY_SEPARATOR, parse_url($imgValue)['path']);
                        $file_name = array_pop($parts);

                        $filename  = str_replace(['.'.pathinfo($file_name, PATHINFO_EXTENSION), '%20', ' '], '', $file_name);
                        $filename  = str_replace('dl=0', 'dl=1', $filename);

			$extractZip = false;
			if (strpos($file_name, '.jpg') === false)  {
                            $filename = $file_name.'.zip';
			    $extractZip = true;
			}

                        try {
			    @file_put_contents($generateImgDirPath.DIRECTORY_SEPARATOR.$row[3].DIRECTORY_SEPARATOR.$filename, @file_get_contents($imgValue));

                            if ($extractZip) {
				$zip     = new ZipArchive();
				$zipInfo = $zip->open($file_name);

				if ($zipInfo === TRUE) {
				    $zip->extractTo($generateImgDirPath.DIRECTORY_SEPARATOR.$row[3]);
				    $zip->close();
				}
			    }

                        } catch(Exception $e){
                            echo 'Message: ' .$e->getMessage();
                        }
                    }
                }
            }
        }
    }
    @fclose($fh);
}
