SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_category_product_index_store1_replica
(
m231_studentkare.catalog_category_product_index_store1_replica.category_id,
m231_studentkare.catalog_category_product_index_store1_replica.product_id,
m231_studentkare.catalog_category_product_index_store1_replica.position,
m231_studentkare.catalog_category_product_index_store1_replica.is_parent,
m231_studentkare.catalog_category_product_index_store1_replica.store_id,
m231_studentkare.catalog_category_product_index_store1_replica.visibility
)
SELECT
m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.category_id,
m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.product_id,
m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.position,
m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.is_parent,
m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.store_id,
m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.visibility
FROM m231_studentkare_live_22112019.catalog_category_product_index_store1_replica
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_category_product_index_store1_replica.category_id = m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.category_id,
m231_studentkare.catalog_category_product_index_store1_replica.product_id = m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.product_id,
m231_studentkare.catalog_category_product_index_store1_replica.position = m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.position,
m231_studentkare.catalog_category_product_index_store1_replica.is_parent = m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.is_parent,
m231_studentkare.catalog_category_product_index_store1_replica.store_id = m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.store_id,
m231_studentkare.catalog_category_product_index_store1_replica.visibility = m231_studentkare_live_22112019.catalog_category_product_index_store1_replica.visibility;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
