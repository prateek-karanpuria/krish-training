SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_category_product_index_store1
(
m231_studentkare.catalog_category_product_index_store1.category_id,
m231_studentkare.catalog_category_product_index_store1.product_id,
m231_studentkare.catalog_category_product_index_store1.position,
m231_studentkare.catalog_category_product_index_store1.is_parent,
m231_studentkare.catalog_category_product_index_store1.store_id,
m231_studentkare.catalog_category_product_index_store1.visibility
)
SELECT
m231_studentkare_live_22112019.catalog_category_product_index_store1.category_id,
m231_studentkare_live_22112019.catalog_category_product_index_store1.product_id,
m231_studentkare_live_22112019.catalog_category_product_index_store1.position,
m231_studentkare_live_22112019.catalog_category_product_index_store1.is_parent,
m231_studentkare_live_22112019.catalog_category_product_index_store1.store_id,
m231_studentkare_live_22112019.catalog_category_product_index_store1.visibility
FROM m231_studentkare_live_22112019.catalog_category_product_index_store1
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_category_product_index_store1.category_id = m231_studentkare_live_22112019.catalog_category_product_index_store1.category_id,
m231_studentkare.catalog_category_product_index_store1.product_id = m231_studentkare_live_22112019.catalog_category_product_index_store1.product_id,
m231_studentkare.catalog_category_product_index_store1.position = m231_studentkare_live_22112019.catalog_category_product_index_store1.position,
m231_studentkare.catalog_category_product_index_store1.is_parent = m231_studentkare_live_22112019.catalog_category_product_index_store1.is_parent,
m231_studentkare.catalog_category_product_index_store1.store_id = m231_studentkare_live_22112019.catalog_category_product_index_store1.store_id,
m231_studentkare.catalog_category_product_index_store1.visibility = m231_studentkare_live_22112019.catalog_category_product_index_store1.visibility;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
