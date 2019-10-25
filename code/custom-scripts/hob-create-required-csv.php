<?php

/**
 * Read CSV, map headers & reform new CSV for simple & configurable products.
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
$required_data = $configurable_product_main_row = $csvData = [];
$additionalRequiredInfo = $all_configurable_records = $configurable_records_sku = [];
if ($fh) {
    for ($row = 0; $rowData = fgetcsv($fh); $row++) {
        if (!in_array($rowData[3], ['HOB SKU Code', 'Configurable SKU Code'])) {
            $data = [];

            $data['sku'] = $rowData[4];
            $data['brand_sku_code'] = $rowData[1];
            $data['hob_sku_code'] = $rowData[3];
            $data['ean_upc'] = $rowData[5];
            $data['store_view_code'] = '';
            $data['attribute_set_code'] = 'Default';
            $data['product_type'] = 'simple';
            $data['categories'] = !empty($rowData[11]) ? 'Default Category/Shop/'.$rowData[10].','.'Default Category/Shop/'.$rowData[10].'/'.$rowData[11] :'Default Category/Shop/'.$rowData[10];
            $data['subcatagories'] = '';
            $data['merchandise_categories'] = $rowData[12];
            $data['product_websites'] = 'base';
            $data['name'] = $rowData[7];
            $data['manufacturer'] = $rowData[8];
            $data['gender'] = $rowData[9];
            $data['range'] = $rowData[15];
            $data['formulation'] = $rowData[16];
            $data['finish'] = $rowData[17];
            $data['coverage'] = $rowData[18];
            $data['skin_tone'] = $rowData[19];
            $data['skin_type'] = $rowData[20];
            $data['spf'] = $rowData[21];
            $data['hair_type'] = $rowData[22];
            $data['scalp_type'] = $rowData[23];
            $data['variant_type'] = $rowData[24];
            $data['pack_of'] = $rowData[25];
            $data['shade'] = $rowData[26];
            $data['color'] = $rowData[27];
            $data['size'] = $rowData[28];
            $data['product_details'] = $rowData[30];
            $data['description'] = $rowData[34];
            $data['short_description'] = $rowData[31];
            $data['how_to_use'] = $rowData[32];
            $data['key_ingredients'] = $rowData[33];
            $data['concern'] = '';
            $data['hsn'] = $rowData[56];
            $data['shelf_life'] = $rowData[57];
            $data['article_type_sap'] = $rowData[2];
            $data['mc_code'] = $rowData[13];
            $data['country_of_origin'] = $rowData[59];
            $data['manufacture_info'] = $rowData[58];
            $data['weight'] = '';
            $data['product_online'] = 1;
            $data['tax_class_name'] = '';
            $data['visibility'] = 'Catalog, Search';
            $data['price'] = $rowData[55];
            $data['special_price'] = '';
            $data['special_price_from_date'] = '';
            $data['special_price_to_date'] = '';
            $data['url_key'] = '';
            $data['meta_title'] = '';
            $data['meta_keywords'] = '';
            $data['meta_description'] = '';
            $data['base_image'] = $rowData[60];
            $data['base_image_label'] = '';
            $data['small_image'] = $rowData[60];
            $data['small_image_label'] = '';
            $data['thumbnail_image'] = $rowData[60];
            $data['thumbnail_image_label'] = '';

            $additional_images = [];
            if ($rowData[61]) $additional_images[] = $rowData[61];
            if ($rowData[62]) $additional_images[] = $rowData[62];
            if ($rowData[63]) $additional_images[] = $rowData[63];
            if ($rowData[64]) $additional_images[] = $rowData[64];

            $data['additional_images'] = implode(',', $additional_images);
            $data['swatch_image'] = '';
            $data['swatch_image_label'] = '';
            $data['created_at'] = '';
            $data['updated_at'] = '';
            $data['new_from_date'] = '';
            $data['new_to_date'] = '';
            $data['display_product_options_in'] = '';
            $data['map_price'] = '';
            $data['msrp_price'] = '';
            $data['map_enabled'] = '';
            $data['gift_message_available'] = '';
            $data['custom_design'] = '';
            $data['custom_design_from'] = '';
            $data['custom_design_to'] = '';
            $data['custom_layout_update'] = '';
            $data['page_layout'] = '';
            $data['product_options_container'] = '';
            $data['msrp_display_actual_price_type'] = '';
            $data['country_of_manufacture'] = '';
            $data['additional_attributes'] = '';
            $data['qty'] = 100;
            $data['out_of_stock_qty'] = '';
            $data['use_config_min_qty'] = '';
            $data['is_qty_decimal'] = '';
            $data['allow_backorders'] = '';
            $data['use_config_backorders'] = '';
            $data['min_cart_qty'] = '';
            $data['use_config_min_sale_qty'] = '';
            $data['max_cart_qty'] = '';
            $data['use_config_max_sale_qty'] = '';
            $data['is_in_stock'] = '';
            $data['notify_on_stock_below'] = '';
            $data['use_config_notify_stock_qty'] = '';
            $data['manage_stock'] = '';
            $data['use_config_manage_stock'] = '';
            $data['use_config_qty_increments'] = '';
            $data['qty_increments'] = '';
            $data['use_config_enable_qty_inc'] = '';
            $data['enable_qty_increments'] = '';
            $data['is_decimal_divided'] = '';
            $data['website_id'] = '';
            $data['related_skus'] = '';
            $data['related_position'] = '';
            $data['crosssell_skus'] = '';
            $data['crosssell_position'] = '';
            $data['upsell_skus'] = '';
            $data['upsell_position'] = '';
            $data['additional_image_labels'] = '';
            $data['configurable_variations'] = 'sku='.$rowData[4].',color='.$rowData[27].',size='.$rowData[28];

            $csvData[$data['sku']] = $data;

            /**
             * This array will be used for filling configurable row record.
             */
            $additionalRequiredInfo[$data['hob_sku_code']][] = $data;
        }
    }

    /**
     * Prepare configurable product array
     */
    if ($additionalRequiredInfo) {
        foreach ($additionalRequiredInfo as $recordVal) {
            /**
             * Look for configurable records only as they
             * have more than 1 product count as per given CSV sample.
             */
            if (count(array_keys($recordVal)) > 1) {
                /**
                 * We'll pick last cell value which contains our required data
                 */
                foreach ($recordVal as $ky_counter => $vl) {
                    $all_configurable_records[] = $vl['sku'];

                    /**
                     * Additional first image & first name setup
                     */
                    if (!isset($first_image) || empty($first_image)) $first_image = $vl['base_image'];
                    if (!isset($first_name) || empty($first_name)) $first_name = $vl['name'];

                    $configurable_variations[] = $vl['configurable_variations'];

                    if (count($recordVal) == $ky_counter + 1) {
                        $configurable_records = [];

                        $configurable_records['sku'] = $vl['hob_sku_code'];
                        $configurable_records['brand_sku_code'] = '';
                        $configurable_records['hob_sku_code'] = '';
                        $configurable_records['ean_upc'] = '';
                        $configurable_records['store_view_code'] = '';
                        $configurable_records['attribute_set_code'] = $vl['attribute_set_code'];
                        $configurable_records['product_type'] = 'configurable';
                        $configurable_records['categories'] = $vl['categories'];
                        $configurable_records['subcatagories'] = $vl['subcatagories'];
                        $configurable_records['merchandise_categories'] = $vl['merchandise_categories'];
                        $configurable_records['product_websites'] = $vl['product_websites'];
                        $configurable_records['name'] = $first_name;
                        $configurable_records['manufacturer'] = $vl['manufacturer'];
                        $configurable_records['gender'] = $vl['gender'];
                        $configurable_records['range'] = '';
                        $configurable_records['formulation'] = '';
                        $configurable_records['finish'] = '';
                        $configurable_records['coverage'] = '';
                        $configurable_records['skin_tone'] = '';
                        $configurable_records['skin_type'] = '';
                        $configurable_records['spf'] = '';
                        $configurable_records['hair_type'] = '';
                        $configurable_records['scalp_type'] = '';
                        $configurable_records['variant_type'] = '';
                        $configurable_records['pack_of'] = '';
                        $configurable_records['shade'] = '';
                        $configurable_records['color'] = '';
                        $configurable_records['size'] = '';
                        $configurable_records['product_details'] = '';
                        $configurable_records['description'] = '';
                        $configurable_records['short_description'] = '';
                        $configurable_records['how_to_use'] = '';
                        $configurable_records['key_ingredients'] = '';
                        $configurable_records['concern'] = '';
                        $configurable_records['hsn'] = '';
                        $configurable_records['shelf_life'] = '';
                        $configurable_records['article_type_sap'] = '';
                        $configurable_records['mc_code'] = '';
                        $configurable_records['country_of_origin'] = '';
                        $configurable_records['manufacture_info'] = '';
                        $configurable_records['weight'] = '';
                        $configurable_records['product_online'] = $vl['product_online'];
                        $configurable_records['tax_class_name'] = $vl['tax_class_name'];
                        $configurable_records['visibility'] = $vl['visibility'];
                        $configurable_records['price'] = '';
                        $configurable_records['special_price'] = '';
                        $configurable_records['special_price_from_date'] = '';
                        $configurable_records['special_price_to_date'] = '';
                        $configurable_records['url_key'] = '';
                        $configurable_records['meta_title'] = '';
                        $configurable_records['meta_keywords'] = '';
                        $configurable_records['meta_description'] = '';
                        $configurable_records['base_image'] = $first_image;
                        $configurable_records['base_image_label'] = $vl['base_image_label'];
                        $configurable_records['small_image'] = $first_image;
                        $configurable_records['small_image_label'] = $vl['small_image_label'];
                        $configurable_records['thumbnail_image'] = $first_image;
                        $configurable_records['thumbnail_image_label'] = $vl['thumbnail_image_label'];
                        $configurable_records['additional_images'] = '';
                        $configurable_records['swatch_image'] = $vl['swatch_image'];
                        $configurable_records['swatch_image_label'] = $vl['swatch_image_label'];
                        $configurable_records['created_at'] = $vl['created_at'];
                        $configurable_records['updated_at'] = $vl['updated_at'];
                        $configurable_records['new_from_date'] = $vl['new_from_date'];
                        $configurable_records['new_to_date'] = $vl['new_to_date'];
                        $configurable_records['display_product_options_in'] = $vl['display_product_options_in'];
                        $configurable_records['map_price'] = $vl['map_price'];
                        $configurable_records['msrp_price'] = $vl['msrp_price'];
                        $configurable_records['map_enabled'] = $vl['map_enabled'];
                        $configurable_records['gift_message_available'] = $vl['gift_message_available'];
                        $configurable_records['custom_design'] = $vl['custom_design'];
                        $configurable_records['custom_design_from'] = $vl['custom_design_from'];
                        $configurable_records['custom_design_to'] = $vl['custom_design_to'];
                        $configurable_records['custom_layout_update'] = $vl['custom_layout_update'];
                        $configurable_records['page_layout'] = $vl['page_layout'];
                        $configurable_records['product_options_container'] = $vl['product_options_container'];
                        $configurable_records['msrp_display_actual_price_type'] = $vl['msrp_display_actual_price_type'];
                        $configurable_records['country_of_manufacture'] = $vl['country_of_manufacture'];
                        $configurable_records['additional_attributes'] = $vl['additional_attributes'];
                        $configurable_records['qty'] = $vl['qty'];
                        $configurable_records['out_of_stock_qty'] = $vl['out_of_stock_qty'];
                        $configurable_records['use_config_min_qty'] = $vl['use_config_min_qty'];
                        $configurable_records['is_qty_decimal'] = $vl['is_qty_decimal'];
                        $configurable_records['allow_backorders'] = $vl['allow_backorders'];
                        $configurable_records['use_config_backorders'] = $vl['use_config_backorders'];
                        $configurable_records['min_cart_qty'] = $vl['min_cart_qty'];
                        $configurable_records['use_config_min_sale_qty'] = $vl['use_config_min_sale_qty'];
                        $configurable_records['max_cart_qty'] = $vl['max_cart_qty'];
                        $configurable_records['use_config_max_sale_qty'] = $vl['use_config_max_sale_qty'];
                        $configurable_records['is_in_stock'] = $vl['is_in_stock'];
                        $configurable_records['notify_on_stock_below'] = $vl['notify_on_stock_below'];
                        $configurable_records['use_config_notify_stock_qty'] = $vl['use_config_notify_stock_qty'];
                        $configurable_records['manage_stock'] = $vl['manage_stock'];
                        $configurable_records['use_config_manage_stock'] = $vl['use_config_manage_stock'];
                        $configurable_records['use_config_qty_increments'] = $vl['use_config_qty_increments'];
                        $configurable_records['qty_increments'] = $vl['qty_increments'];
                        $configurable_records['use_config_enable_qty_inc'] = $vl['use_config_enable_qty_inc'];
                        $configurable_records['enable_qty_increments'] = $vl['enable_qty_increments'];
                        $configurable_records['is_decimal_divided'] = $vl['is_decimal_divided'];
                        $configurable_records['website_id'] = $vl['website_id'];
                        $configurable_records['related_skus'] = $vl['related_skus'];
                        $configurable_records['related_position'] = $vl['related_position'];
                        $configurable_records['crosssell_skus'] = $vl['crosssell_skus'];
                        $configurable_records['crosssell_position'] = $vl['crosssell_position'];
                        $configurable_records['upsell_skus'] = $vl['upsell_skus'];
                        $configurable_records['upsell_position'] = $vl['upsell_position'];
                        $configurable_records['additional_image_labels'] = $vl['additional_image_labels'];
                        $configurable_records['configurable_variations'] = implode('|', $configurable_variations);

                        $configurable_product_main_row[$vl['sku']] = $configurable_records;
                        $configurable_records_sku[] = $configurable_records['sku'];

                        $first_image = $first_name = '';
                        $configurable_variations = [];
                    }
                }
            }
        }
    }

    /**
     * Prepare final array for adding in CSV
     */
    if ($csvData) {
        foreach ($csvData as $sku_code => $rowRecord) {
            /**
             * Additional alteration for configurable's simple product
             */
            if (in_array($rowRecord['sku'], $all_configurable_records)) {
                $rowRecord['hob_sku_code'] = '';
                $rowRecord['visibility']   = 'Not Visible Individually';

                /**
                 * Skip this step for configurable product row
                 */
                if (!in_array($rowRecord['sku'], $configurable_records_sku)) {
                    $rowRecord['configurable_variations'] = '';
                }

            } else {
                /**
                 * Simple product
                 */
                $rowRecord['base_image'] = $rowRecord['small_image'] = $rowRecord['thumbnail_image'] = '';
                $rowRecord['additional_images'] =  $rowRecord['configurable_variations'] = '';
            }

            /**
             * Set data
             */
            $required_data[] = $rowRecord;

            /**
             * Add configurable row
             */
            if (in_array($rowRecord['sku'], array_keys($configurable_product_main_row))) {
                $required_data[] = $configurable_product_main_row[$rowRecord['sku']];
            }
        }
    }
    
    @fclose($fh);
}

/**
 * Write processed data in new CSV
 */
if ($required_data) {
    $new_fh = fopen('required-import-file.csv', 'a+');

    /**
     * Add rows
     */
    foreach ($required_data as $rowDataRecord) {
        /**
         * Add CSV header
         */
        if (!isset($rowHeaderFromFirstRowKeys)) {    
            @fputcsv($new_fh, array_keys($rowDataRecord));

            $rowHeaderFromFirstRowKeys = true;
        }
        @fputcsv($new_fh, $rowDataRecord);
    }
    @fclose($new_fh);
}
