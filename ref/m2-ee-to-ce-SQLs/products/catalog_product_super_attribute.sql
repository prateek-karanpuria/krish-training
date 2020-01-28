SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_product_super_attribute
(
m231_studentkare.catalog_product_super_attribute.product_super_attribute_id,
m231_studentkare.catalog_product_super_attribute.product_id,
m231_studentkare.catalog_product_super_attribute.attribute_id,
m231_studentkare.catalog_product_super_attribute.position
)
SELECT
m231_studentkare_live_22112019.catalog_product_super_attribute.product_super_attribute_id,
m231_studentkare_live_22112019.catalog_product_super_attribute.product_id,
m231_studentkare_live_22112019.catalog_product_super_attribute.attribute_id,
m231_studentkare_live_22112019.catalog_product_super_attribute.position
FROM m231_studentkare_live_22112019.catalog_product_super_attribute
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_product_super_attribute.product_super_attribute_id = m231_studentkare_live_22112019.catalog_product_super_attribute.product_super_attribute_id,
m231_studentkare.catalog_product_super_attribute.product_id = m231_studentkare_live_22112019.catalog_product_super_attribute.product_id,
m231_studentkare.catalog_product_super_attribute.attribute_id = m231_studentkare_live_22112019.catalog_product_super_attribute.attribute_id,
m231_studentkare.catalog_product_super_attribute.position = m231_studentkare_live_22112019.catalog_product_super_attribute.position;

SET GLOBAL FOREIGN_KEY_CHECKS=1;