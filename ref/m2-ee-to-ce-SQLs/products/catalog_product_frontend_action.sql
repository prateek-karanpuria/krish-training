SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_product_frontend_action
(
m231_studentkare.catalog_product_frontend_action.action_id,
m231_studentkare.catalog_product_frontend_action.type_id,
m231_studentkare.catalog_product_frontend_action.visitor_id,
m231_studentkare.catalog_product_frontend_action.customer_id,
m231_studentkare.catalog_product_frontend_action.product_id,
m231_studentkare.catalog_product_frontend_action.added_at
)
SELECT
m231_studentkare_live_22112019.catalog_product_frontend_action.action_id,
m231_studentkare_live_22112019.catalog_product_frontend_action.type_id,
m231_studentkare_live_22112019.catalog_product_frontend_action.visitor_id,
m231_studentkare_live_22112019.catalog_product_frontend_action.customer_id,
m231_studentkare_live_22112019.catalog_product_frontend_action.product_id,
m231_studentkare_live_22112019.catalog_product_frontend_action.added_at
FROM m231_studentkare_live_22112019.catalog_product_frontend_action
ON DUPLICATE KEY UPDATE
m231_studentkare.catalog_product_frontend_action.action_id = m231_studentkare_live_22112019.catalog_product_frontend_action.action_id,
m231_studentkare.catalog_product_frontend_action.type_id = m231_studentkare_live_22112019.catalog_product_frontend_action.type_id,
m231_studentkare.catalog_product_frontend_action.visitor_id = m231_studentkare_live_22112019.catalog_product_frontend_action.visitor_id,
m231_studentkare.catalog_product_frontend_action.customer_id = m231_studentkare_live_22112019.catalog_product_frontend_action.customer_id,
m231_studentkare.catalog_product_frontend_action.product_id = m231_studentkare_live_22112019.catalog_product_frontend_action.product_id,
m231_studentkare.catalog_product_frontend_action.added_at = m231_studentkare_live_22112019.catalog_product_frontend_action.added_at;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
