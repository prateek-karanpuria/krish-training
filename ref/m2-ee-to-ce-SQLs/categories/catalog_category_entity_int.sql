SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_category_entity_int
(
m231_studentkare.catalog_category_entity_int.value_id,
m231_studentkare.catalog_category_entity_int.attribute_id,
m231_studentkare.catalog_category_entity_int.store_id,
m231_studentkare.catalog_category_entity_int.entity_id,
m231_studentkare.catalog_category_entity_int.value
)
SELECT
m231_studentkare_live_22112019.catalog_category_entity_int.value_id,
m231_studentkare_live_22112019.catalog_category_entity_int.attribute_id,
m231_studentkare_live_22112019.catalog_category_entity_int.store_id,
m231_studentkare_live_22112019.catalog_category_entity_int.row_id,
m231_studentkare_live_22112019.catalog_category_entity_int.value
FROM m231_studentkare_live_22112019.catalog_category_entity_int
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_category_entity_int.value_id = m231_studentkare_live_22112019.catalog_category_entity_int.value_id,
m231_studentkare.catalog_category_entity_int.attribute_id = m231_studentkare_live_22112019.catalog_category_entity_int.attribute_id,
m231_studentkare.catalog_category_entity_int.store_id = m231_studentkare_live_22112019.catalog_category_entity_int.store_id,
m231_studentkare.catalog_category_entity_int.entity_id = m231_studentkare_live_22112019.catalog_category_entity_int.row_id,
m231_studentkare.catalog_category_entity_int.value = m231_studentkare_live_22112019.catalog_category_entity_int.value;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
