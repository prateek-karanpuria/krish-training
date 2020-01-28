SET GLOBAL FOREIGN_KEY_CHECKS=0;

ALTER TABLE sales_order_status_history ADD checkmo_number VARCHAR(30) NULL DEFAULT NULL COMMENT ' Check Money Payment number' AFTER entity_name;

INSERT INTO m231_studentkare.sales_order_status_history
(
m231_studentkare.sales_order_status_history.entity_id,
m231_studentkare.sales_order_status_history.parent_id,
m231_studentkare.sales_order_status_history.is_customer_notified,
m231_studentkare.sales_order_status_history.is_visible_on_front,
m231_studentkare.sales_order_status_history.comment,
m231_studentkare.sales_order_status_history.status,
m231_studentkare.sales_order_status_history.created_at,
m231_studentkare.sales_order_status_history.entity_name,
m231_studentkare.sales_order_status_history.checkmo_number
)
SELECT
m231_studentkare_live_22112019.sales_order_status_history.entity_id,
m231_studentkare_live_22112019.sales_order_status_history.parent_id,
m231_studentkare_live_22112019.sales_order_status_history.is_customer_notified,
m231_studentkare_live_22112019.sales_order_status_history.is_visible_on_front,
m231_studentkare_live_22112019.sales_order_status_history.comment,
m231_studentkare_live_22112019.sales_order_status_history.status,
m231_studentkare_live_22112019.sales_order_status_history.created_at,
m231_studentkare_live_22112019.sales_order_status_history.entity_name,
m231_studentkare_live_22112019.sales_order_status_history.checkmo_number
FROM m231_studentkare_live_22112019.sales_order_status_history
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_order_status_history.entity_id = m231_studentkare_live_22112019.sales_order_status_history.entity_id,
m231_studentkare.sales_order_status_history.parent_id = m231_studentkare_live_22112019.sales_order_status_history.parent_id,
m231_studentkare.sales_order_status_history.is_customer_notified = m231_studentkare_live_22112019.sales_order_status_history.is_customer_notified,
m231_studentkare.sales_order_status_history.is_visible_on_front = m231_studentkare_live_22112019.sales_order_status_history.is_visible_on_front,
m231_studentkare.sales_order_status_history.comment = m231_studentkare_live_22112019.sales_order_status_history.comment,
m231_studentkare.sales_order_status_history.status = m231_studentkare_live_22112019.sales_order_status_history.status,
m231_studentkare.sales_order_status_history.created_at = m231_studentkare_live_22112019.sales_order_status_history.created_at,
m231_studentkare.sales_order_status_history.entity_name = m231_studentkare_live_22112019.sales_order_status_history.entity_name,
m231_studentkare.sales_order_status_history.checkmo_number = m231_studentkare_live_22112019.sales_order_status_history.checkmo_number;

SET GLOBAL FOREIGN_KEY_CHECKS=1;