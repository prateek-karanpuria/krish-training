SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_order_status_label
(
m231_studentkare.sales_order_status_label.status,
m231_studentkare.sales_order_status_label.store_id,
m231_studentkare.sales_order_status_label.label
)
SELECT
m231_studentkare_live_22112019.sales_order_status_label.status,
m231_studentkare_live_22112019.sales_order_status_label.store_id,
m231_studentkare_live_22112019.sales_order_status_label.label
FROM m231_studentkare_live_22112019.sales_order_status_label
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_order_status_label.status = m231_studentkare_live_22112019.sales_order_status_label.status,
m231_studentkare.sales_order_status_label.store_id = m231_studentkare_live_22112019.sales_order_status_label.store_id,
m231_studentkare.sales_order_status_label.label = m231_studentkare_live_22112019.sales_order_status_label.label;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
