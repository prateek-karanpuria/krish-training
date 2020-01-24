SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_shipping_aggregated
(
m231_studentkare.sales_shipping_aggregated.id,
m231_studentkare.sales_shipping_aggregated.period,
m231_studentkare.sales_shipping_aggregated.store_id,
m231_studentkare.sales_shipping_aggregated.order_status,
m231_studentkare.sales_shipping_aggregated.shipping_description,
m231_studentkare.sales_shipping_aggregated.orders_count,
m231_studentkare.sales_shipping_aggregated.total_shipping,
m231_studentkare.sales_shipping_aggregated.total_shipping_actual
)
SELECT
m231_studentkare_live_22112019.sales_shipping_aggregated.id,
m231_studentkare_live_22112019.sales_shipping_aggregated.period,
m231_studentkare_live_22112019.sales_shipping_aggregated.store_id,
m231_studentkare_live_22112019.sales_shipping_aggregated.order_status,
m231_studentkare_live_22112019.sales_shipping_aggregated.shipping_description,
m231_studentkare_live_22112019.sales_shipping_aggregated.orders_count,
m231_studentkare_live_22112019.sales_shipping_aggregated.total_shipping,
m231_studentkare_live_22112019.sales_shipping_aggregated.total_shipping_actual
FROM m231_studentkare_live_22112019.sales_shipping_aggregated
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_shipping_aggregated.id = m231_studentkare_live_22112019.sales_shipping_aggregated.id,
m231_studentkare.sales_shipping_aggregated.period = m231_studentkare_live_22112019.sales_shipping_aggregated.period,
m231_studentkare.sales_shipping_aggregated.store_id = m231_studentkare_live_22112019.sales_shipping_aggregated.store_id,
m231_studentkare.sales_shipping_aggregated.order_status = m231_studentkare_live_22112019.sales_shipping_aggregated.order_status,
m231_studentkare.sales_shipping_aggregated.shipping_description = m231_studentkare_live_22112019.sales_shipping_aggregated.shipping_description,
m231_studentkare.sales_shipping_aggregated.orders_count = m231_studentkare_live_22112019.sales_shipping_aggregated.orders_count,
m231_studentkare.sales_shipping_aggregated.total_shipping = m231_studentkare_live_22112019.sales_shipping_aggregated.total_shipping,
m231_studentkare.sales_shipping_aggregated.total_shipping_actual = m231_studentkare_live_22112019.sales_shipping_aggregated.total_shipping_actual;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
