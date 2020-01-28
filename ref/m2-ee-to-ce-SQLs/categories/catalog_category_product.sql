SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_category_product
(
m231_studentkare.catalog_category_product.entity_id,
m231_studentkare.catalog_category_product.category_id,
m231_studentkare.catalog_category_product.product_id,
m231_studentkare.catalog_category_product.position
)
SELECT
m231_studentkare_live_22112019.catalog_category_product.entity_id,
m231_studentkare_live_22112019.catalog_category_product.category_id,
m231_studentkare_live_22112019.catalog_category_product.product_id,
m231_studentkare_live_22112019.catalog_category_product.position
FROM m231_studentkare_live_22112019.catalog_category_product
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_category_product.entity_id = m231_studentkare_live_22112019.catalog_category_product.entity_id,
m231_studentkare.catalog_category_product.category_id = m231_studentkare_live_22112019.catalog_category_product.category_id,
m231_studentkare.catalog_category_product.product_id = m231_studentkare_live_22112019.catalog_category_product.product_id,
m231_studentkare.catalog_category_product.position = m231_studentkare_live_22112019.catalog_category_product.position;

SET GLOBAL FOREIGN_KEY_CHECKS=1;