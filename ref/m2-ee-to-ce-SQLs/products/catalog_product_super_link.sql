SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_product_super_link
(
m231_studentkare.catalog_product_super_link.link_id,
m231_studentkare.catalog_product_super_link.product_id,
m231_studentkare.catalog_product_super_link.parent_id
)
SELECT
m231_studentkare_live_22112019.catalog_product_super_link.link_id,
m231_studentkare_live_22112019.catalog_product_super_link.product_id,
m231_studentkare_live_22112019.catalog_product_super_link.parent_id
FROM m231_studentkare_live_22112019.catalog_product_super_link
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_product_super_link.link_id = m231_studentkare_live_22112019.catalog_product_super_link.link_id,
m231_studentkare.catalog_product_super_link.product_id = m231_studentkare_live_22112019.catalog_product_super_link.product_id,
m231_studentkare.catalog_product_super_link.parent_id = m231_studentkare_live_22112019.catalog_product_super_link.parent_id;

SET GLOBAL FOREIGN_KEY_CHECKS=1;