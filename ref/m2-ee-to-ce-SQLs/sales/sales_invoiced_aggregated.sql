SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_invoiced_aggregated
(
m231_studentkare.sales_invoiced_aggregated.id,
m231_studentkare.sales_invoiced_aggregated.period,
m231_studentkare.sales_invoiced_aggregated.store_id,
m231_studentkare.sales_invoiced_aggregated.order_status,
m231_studentkare.sales_invoiced_aggregated.orders_count,
m231_studentkare.sales_invoiced_aggregated.orders_invoiced,
m231_studentkare.sales_invoiced_aggregated.invoiced,
m231_studentkare.sales_invoiced_aggregated.invoiced_captured,
m231_studentkare.sales_invoiced_aggregated.invoiced_not_captured
)
SELECT
m231_studentkare_live_22112019.sales_invoiced_aggregated.id,
m231_studentkare_live_22112019.sales_invoiced_aggregated.period,
m231_studentkare_live_22112019.sales_invoiced_aggregated.store_id,
m231_studentkare_live_22112019.sales_invoiced_aggregated.order_status,
m231_studentkare_live_22112019.sales_invoiced_aggregated.orders_count,
m231_studentkare_live_22112019.sales_invoiced_aggregated.orders_invoiced,
m231_studentkare_live_22112019.sales_invoiced_aggregated.invoiced,
m231_studentkare_live_22112019.sales_invoiced_aggregated.invoiced_captured,
m231_studentkare_live_22112019.sales_invoiced_aggregated.invoiced_not_captured
FROM m231_studentkare_live_22112019.sales_invoiced_aggregated
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_invoiced_aggregated.id = m231_studentkare_live_22112019.sales_invoiced_aggregated.id,
m231_studentkare.sales_invoiced_aggregated.period = m231_studentkare_live_22112019.sales_invoiced_aggregated.period,
m231_studentkare.sales_invoiced_aggregated.store_id = m231_studentkare_live_22112019.sales_invoiced_aggregated.store_id,
m231_studentkare.sales_invoiced_aggregated.order_status = m231_studentkare_live_22112019.sales_invoiced_aggregated.order_status,
m231_studentkare.sales_invoiced_aggregated.orders_count = m231_studentkare_live_22112019.sales_invoiced_aggregated.orders_count,
m231_studentkare.sales_invoiced_aggregated.orders_invoiced = m231_studentkare_live_22112019.sales_invoiced_aggregated.orders_invoiced,
m231_studentkare.sales_invoiced_aggregated.invoiced = m231_studentkare_live_22112019.sales_invoiced_aggregated.invoiced,
m231_studentkare.sales_invoiced_aggregated.invoiced_captured = m231_studentkare_live_22112019.sales_invoiced_aggregated.invoiced_captured,
m231_studentkare.sales_invoiced_aggregated.invoiced_not_captured = m231_studentkare_live_22112019.sales_invoiced_aggregated.invoiced_not_captured;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
