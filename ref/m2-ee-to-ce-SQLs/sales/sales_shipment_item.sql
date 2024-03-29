SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_shipment_item
(
m231_studentkare.sales_shipment_item.entity_id,
m231_studentkare.sales_shipment_item.parent_id,
m231_studentkare.sales_shipment_item.row_total,
m231_studentkare.sales_shipment_item.price,
m231_studentkare.sales_shipment_item.weight,
m231_studentkare.sales_shipment_item.qty,
m231_studentkare.sales_shipment_item.product_id,
m231_studentkare.sales_shipment_item.order_item_id,
m231_studentkare.sales_shipment_item.additional_data,
m231_studentkare.sales_shipment_item.description,
m231_studentkare.sales_shipment_item.name,
m231_studentkare.sales_shipment_item.sku
)
SELECT
m231_studentkare_live_22112019.sales_shipment_item.entity_id,
m231_studentkare_live_22112019.sales_shipment_item.parent_id,
m231_studentkare_live_22112019.sales_shipment_item.row_total,
m231_studentkare_live_22112019.sales_shipment_item.price,
m231_studentkare_live_22112019.sales_shipment_item.weight,
m231_studentkare_live_22112019.sales_shipment_item.qty,
m231_studentkare_live_22112019.sales_shipment_item.product_id,
m231_studentkare_live_22112019.sales_shipment_item.order_item_id,
m231_studentkare_live_22112019.sales_shipment_item.additional_data,
m231_studentkare_live_22112019.sales_shipment_item.description,
m231_studentkare_live_22112019.sales_shipment_item.name,
m231_studentkare_live_22112019.sales_shipment_item.sku
FROM m231_studentkare_live_22112019.sales_shipment_item
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_shipment_item.entity_id = m231_studentkare_live_22112019.sales_shipment_item.entity_id,
m231_studentkare.sales_shipment_item.parent_id = m231_studentkare_live_22112019.sales_shipment_item.parent_id,
m231_studentkare.sales_shipment_item.row_total = m231_studentkare_live_22112019.sales_shipment_item.row_total,
m231_studentkare.sales_shipment_item.price = m231_studentkare_live_22112019.sales_shipment_item.price,
m231_studentkare.sales_shipment_item.weight = m231_studentkare_live_22112019.sales_shipment_item.weight,
m231_studentkare.sales_shipment_item.qty = m231_studentkare_live_22112019.sales_shipment_item.qty,
m231_studentkare.sales_shipment_item.product_id = m231_studentkare_live_22112019.sales_shipment_item.product_id,
m231_studentkare.sales_shipment_item.order_item_id = m231_studentkare_live_22112019.sales_shipment_item.order_item_id,
m231_studentkare.sales_shipment_item.additional_data = m231_studentkare_live_22112019.sales_shipment_item.additional_data,
m231_studentkare.sales_shipment_item.description = m231_studentkare_live_22112019.sales_shipment_item.description,
m231_studentkare.sales_shipment_item.name = m231_studentkare_live_22112019.sales_shipment_item.name,
m231_studentkare.sales_shipment_item.sku = m231_studentkare_live_22112019.sales_shipment_item.sku;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
