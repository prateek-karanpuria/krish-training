<?php

/**
 * Required column data: sku=3000166001,color=FS22,size=3.5 g / 0.12 oz
 */

function print2($content = '') {
    echo '<pre>';
    print_r($content);
    echo '</pre>';
}

$fh = fopen('config-script.csv', 'r');

/**
 * Read & process data
 */
$data = $required_data = [];
if ($fh) {
    for ($row = 0; $rowData = fgetcsv($fh); $row++) {
        if (!in_array($rowData[3], ['HOB SKU Code', 'Configurable SKU Code'])) {
           $data[$rowData[3]][] = 'sku='.$rowData['4'].',color='.$rowData['27'].',size='.$rowData['28'];
        }
    }

    @fclose($fh);

    /**
     * Preparing final data by filtering configurable products
     */
    if ($data) {
        foreach ($data as $sku_code => $rowRecord) {
            if (count($rowRecord) > 1) {
                $required_data[$sku_code] = implode('|', $rowRecord);
            }
        }
    }
}

/**
 * Write process data in new CSV
 */
if ($required_data) {
    $new_fh = fopen('required-csv-sample.csv', 'a+');

    @fputcsv($new_fh, ['SKU', 'Attribute Set']);

    foreach ($required_data as $key => $rowDataRecord) {
        @fputcsv($new_fh, [$key, $rowDataRecord]);
    }

    @fclose($new_fh);
}
