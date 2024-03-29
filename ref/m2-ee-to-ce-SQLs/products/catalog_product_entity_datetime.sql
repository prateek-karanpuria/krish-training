SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_product_entity_datetime
(
m231_studentkare.catalog_product_entity_datetime.value_id,
m231_studentkare.catalog_product_entity_datetime.attribute_id,
m231_studentkare.catalog_product_entity_datetime.store_id,
m231_studentkare.catalog_product_entity_datetime.entity_id,
m231_studentkare.catalog_product_entity_datetime.value
)
SELECT
m231_studentkare_live_22112019.catalog_product_entity_datetime.value_id,
m231_studentkare_live_22112019.catalog_product_entity_datetime.attribute_id,
m231_studentkare_live_22112019.catalog_product_entity_datetime.store_id,
m231_studentkare_live_22112019.catalog_product_entity_datetime.row_id,
m231_studentkare_live_22112019.catalog_product_entity_datetime.value
FROM m231_studentkare_live_22112019.catalog_product_entity_datetime
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_product_entity_datetime.value_id = m231_studentkare_live_22112019.catalog_product_entity_datetime.value_id,
m231_studentkare.catalog_product_entity_datetime.attribute_id = m231_studentkare_live_22112019.catalog_product_entity_datetime.attribute_id,
m231_studentkare.catalog_product_entity_datetime.store_id = m231_studentkare_live_22112019.catalog_product_entity_datetime.store_id,
m231_studentkare.catalog_product_entity_datetime.entity_id = m231_studentkare_live_22112019.catalog_product_entity_datetime.row_id,
m231_studentkare.catalog_product_entity_datetime.value = m231_studentkare_live_22112019.catalog_product_entity_datetime.value;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
