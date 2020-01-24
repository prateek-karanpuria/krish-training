SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_shipment
(
m231_studentkare.sales_shipment.entity_id,
m231_studentkare.sales_shipment.store_id,
m231_studentkare.sales_shipment.total_weight,
m231_studentkare.sales_shipment.total_qty,
m231_studentkare.sales_shipment.email_sent,
m231_studentkare.sales_shipment.send_email,
m231_studentkare.sales_shipment.order_id,
m231_studentkare.sales_shipment.customer_id,
m231_studentkare.sales_shipment.shipping_address_id,
m231_studentkare.sales_shipment.billing_address_id,
m231_studentkare.sales_shipment.shipment_status,
m231_studentkare.sales_shipment.increment_id,
m231_studentkare.sales_shipment.created_at,
m231_studentkare.sales_shipment.updated_at,
m231_studentkare.sales_shipment.packages,
m231_studentkare.sales_shipment.shipping_label,
m231_studentkare.sales_shipment.customer_note,
m231_studentkare.sales_shipment.customer_note_notify
)
SELECT
m231_studentkare_live_22112019.sales_shipment.entity_id,
m231_studentkare_live_22112019.sales_shipment.store_id,
m231_studentkare_live_22112019.sales_shipment.total_weight,
m231_studentkare_live_22112019.sales_shipment.total_qty,
m231_studentkare_live_22112019.sales_shipment.email_sent,
m231_studentkare_live_22112019.sales_shipment.send_email,
m231_studentkare_live_22112019.sales_shipment.order_id,
m231_studentkare_live_22112019.sales_shipment.customer_id,
m231_studentkare_live_22112019.sales_shipment.shipping_address_id,
m231_studentkare_live_22112019.sales_shipment.billing_address_id,
m231_studentkare_live_22112019.sales_shipment.shipment_status,
m231_studentkare_live_22112019.sales_shipment.increment_id,
m231_studentkare_live_22112019.sales_shipment.created_at,
m231_studentkare_live_22112019.sales_shipment.updated_at,
m231_studentkare_live_22112019.sales_shipment.packages,
m231_studentkare_live_22112019.sales_shipment.shipping_label,
m231_studentkare_live_22112019.sales_shipment.customer_note,
m231_studentkare_live_22112019.sales_shipment.customer_note_notify
FROM m231_studentkare_live_22112019.sales_shipment
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_shipment.entity_id = m231_studentkare_live_22112019.sales_shipment.entity_id,
m231_studentkare.sales_shipment.store_id = m231_studentkare_live_22112019.sales_shipment.store_id,
m231_studentkare.sales_shipment.total_weight = m231_studentkare_live_22112019.sales_shipment.total_weight,
m231_studentkare.sales_shipment.total_qty = m231_studentkare_live_22112019.sales_shipment.total_qty,
m231_studentkare.sales_shipment.email_sent = m231_studentkare_live_22112019.sales_shipment.email_sent,
m231_studentkare.sales_shipment.send_email = m231_studentkare_live_22112019.sales_shipment.send_email,
m231_studentkare.sales_shipment.order_id = m231_studentkare_live_22112019.sales_shipment.order_id,
m231_studentkare.sales_shipment.customer_id = m231_studentkare_live_22112019.sales_shipment.customer_id,
m231_studentkare.sales_shipment.shipping_address_id = m231_studentkare_live_22112019.sales_shipment.shipping_address_id,
m231_studentkare.sales_shipment.billing_address_id = m231_studentkare_live_22112019.sales_shipment.billing_address_id,
m231_studentkare.sales_shipment.shipment_status = m231_studentkare_live_22112019.sales_shipment.shipment_status,
m231_studentkare.sales_shipment.increment_id = m231_studentkare_live_22112019.sales_shipment.increment_id,
m231_studentkare.sales_shipment.created_at = m231_studentkare_live_22112019.sales_shipment.created_at,
m231_studentkare.sales_shipment.updated_at = m231_studentkare_live_22112019.sales_shipment.updated_at,
m231_studentkare.sales_shipment.packages = m231_studentkare_live_22112019.sales_shipment.packages,
m231_studentkare.sales_shipment.shipping_label = m231_studentkare_live_22112019.sales_shipment.shipping_label,
m231_studentkare.sales_shipment.customer_note = m231_studentkare_live_22112019.sales_shipment.customer_note,
m231_studentkare.sales_shipment.customer_note_notify = m231_studentkare_live_22112019.sales_shipment.customer_note_notify;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
