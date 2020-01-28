SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.salesrule_coupon_aggregated
(
m231_studentkare.salesrule_coupon_aggregated.id,
m231_studentkare.salesrule_coupon_aggregated.period,
m231_studentkare.salesrule_coupon_aggregated.store_id,
m231_studentkare.salesrule_coupon_aggregated.order_status,
m231_studentkare.salesrule_coupon_aggregated.coupon_code,
m231_studentkare.salesrule_coupon_aggregated.coupon_uses,
m231_studentkare.salesrule_coupon_aggregated.subtotal_amount,
m231_studentkare.salesrule_coupon_aggregated.discount_amount,
m231_studentkare.salesrule_coupon_aggregated.total_amount,
m231_studentkare.salesrule_coupon_aggregated.subtotal_amount_actual,
m231_studentkare.salesrule_coupon_aggregated.discount_amount_actual,
m231_studentkare.salesrule_coupon_aggregated.total_amount_actual,
m231_studentkare.salesrule_coupon_aggregated.rule_name
)
SELECT
m231_studentkare_live_22112019.salesrule_coupon_aggregated.id,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.period,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.store_id,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.order_status,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.coupon_code,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.coupon_uses,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.subtotal_amount,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.discount_amount,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.total_amount,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.subtotal_amount_actual,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.discount_amount_actual,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.total_amount_actual,
m231_studentkare_live_22112019.salesrule_coupon_aggregated.rule_name
FROM m231_studentkare_live_22112019.salesrule_coupon_aggregated
ON DUPLICATE KEY UPDATE
m231_studentkare.salesrule_coupon_aggregated.id = m231_studentkare_live_22112019.salesrule_coupon_aggregated.id,
m231_studentkare.salesrule_coupon_aggregated.period = m231_studentkare_live_22112019.salesrule_coupon_aggregated.period,
m231_studentkare.salesrule_coupon_aggregated.store_id = m231_studentkare_live_22112019.salesrule_coupon_aggregated.store_id,
m231_studentkare.salesrule_coupon_aggregated.order_status = m231_studentkare_live_22112019.salesrule_coupon_aggregated.order_status,
m231_studentkare.salesrule_coupon_aggregated.coupon_code = m231_studentkare_live_22112019.salesrule_coupon_aggregated.coupon_code,
m231_studentkare.salesrule_coupon_aggregated.coupon_uses = m231_studentkare_live_22112019.salesrule_coupon_aggregated.coupon_uses,
m231_studentkare.salesrule_coupon_aggregated.subtotal_amount = m231_studentkare_live_22112019.salesrule_coupon_aggregated.subtotal_amount,
m231_studentkare.salesrule_coupon_aggregated.discount_amount = m231_studentkare_live_22112019.salesrule_coupon_aggregated.discount_amount,
m231_studentkare.salesrule_coupon_aggregated.total_amount = m231_studentkare_live_22112019.salesrule_coupon_aggregated.total_amount,
m231_studentkare.salesrule_coupon_aggregated.subtotal_amount_actual = m231_studentkare_live_22112019.salesrule_coupon_aggregated.subtotal_amount_actual,
m231_studentkare.salesrule_coupon_aggregated.discount_amount_actual = m231_studentkare_live_22112019.salesrule_coupon_aggregated.discount_amount_actual,
m231_studentkare.salesrule_coupon_aggregated.total_amount_actual = m231_studentkare_live_22112019.salesrule_coupon_aggregated.total_amount_actual,
m231_studentkare.salesrule_coupon_aggregated.rule_name = m231_studentkare_live_22112019.salesrule_coupon_aggregated.rule_name;

SET GLOBAL FOREIGN_KEY_CHECKS=1;