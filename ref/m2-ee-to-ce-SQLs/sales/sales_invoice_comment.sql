SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_invoice_comment
(
m231_studentkare.sales_invoice_comment.entity_id,
m231_studentkare.sales_invoice_comment.parent_id,
m231_studentkare.sales_invoice_comment.is_customer_notified,
m231_studentkare.sales_invoice_comment.is_visible_on_front,
m231_studentkare.sales_invoice_comment.comment,
m231_studentkare.sales_invoice_comment.created_at
)
SELECT
m231_studentkare_live_22112019.sales_invoice_comment.entity_id,
m231_studentkare_live_22112019.sales_invoice_comment.parent_id,
m231_studentkare_live_22112019.sales_invoice_comment.is_customer_notified,
m231_studentkare_live_22112019.sales_invoice_comment.is_visible_on_front,
m231_studentkare_live_22112019.sales_invoice_comment.comment,
m231_studentkare_live_22112019.sales_invoice_comment.created_at
FROM m231_studentkare_live_22112019.sales_invoice_comment
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_invoice_comment.entity_id = m231_studentkare_live_22112019.sales_invoice_comment.entity_id,
m231_studentkare.sales_invoice_comment.parent_id = m231_studentkare_live_22112019.sales_invoice_comment.parent_id,
m231_studentkare.sales_invoice_comment.is_customer_notified = m231_studentkare_live_22112019.sales_invoice_comment.is_customer_notified,
m231_studentkare.sales_invoice_comment.is_visible_on_front = m231_studentkare_live_22112019.sales_invoice_comment.is_visible_on_front,
m231_studentkare.sales_invoice_comment.comment = m231_studentkare_live_22112019.sales_invoice_comment.comment,
m231_studentkare.sales_invoice_comment.created_at = m231_studentkare_live_22112019.sales_invoice_comment.created_at;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
