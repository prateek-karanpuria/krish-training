SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.salesrule_coupon
(
m231_studentkare.salesrule_coupon.coupon_id,
m231_studentkare.salesrule_coupon.rule_id,
m231_studentkare.salesrule_coupon.code,
m231_studentkare.salesrule_coupon.usage_limit,
m231_studentkare.salesrule_coupon.usage_per_customer,
m231_studentkare.salesrule_coupon.times_used,
m231_studentkare.salesrule_coupon.expiration_date,
m231_studentkare.salesrule_coupon.is_primary,
m231_studentkare.salesrule_coupon.created_at,
m231_studentkare.salesrule_coupon.type,
m231_studentkare.salesrule_coupon.generated_by_dotmailer
)
SELECT
m231_studentkare_live_22112019.salesrule_coupon.coupon_id,
m231_studentkare_live_22112019.salesrule_coupon.rule_id,
m231_studentkare_live_22112019.salesrule_coupon.code,
m231_studentkare_live_22112019.salesrule_coupon.usage_limit,
m231_studentkare_live_22112019.salesrule_coupon.usage_per_customer,
m231_studentkare_live_22112019.salesrule_coupon.times_used,
m231_studentkare_live_22112019.salesrule_coupon.expiration_date,
m231_studentkare_live_22112019.salesrule_coupon.is_primary,
m231_studentkare_live_22112019.salesrule_coupon.created_at,
m231_studentkare_live_22112019.salesrule_coupon.type,
m231_studentkare_live_22112019.salesrule_coupon.generated_by_dotmailer
FROM m231_studentkare_live_22112019.salesrule_coupon
ON DUPLICATE KEY UPDATE
m231_studentkare.salesrule_coupon.coupon_id = m231_studentkare_live_22112019.salesrule_coupon.coupon_id,
m231_studentkare.salesrule_coupon.rule_id = m231_studentkare_live_22112019.salesrule_coupon.rule_id,
m231_studentkare.salesrule_coupon.code = m231_studentkare_live_22112019.salesrule_coupon.code,
m231_studentkare.salesrule_coupon.usage_limit = m231_studentkare_live_22112019.salesrule_coupon.usage_limit,
m231_studentkare.salesrule_coupon.usage_per_customer = m231_studentkare_live_22112019.salesrule_coupon.usage_per_customer,
m231_studentkare.salesrule_coupon.times_used = m231_studentkare_live_22112019.salesrule_coupon.times_used,
m231_studentkare.salesrule_coupon.expiration_date = m231_studentkare_live_22112019.salesrule_coupon.expiration_date,
m231_studentkare.salesrule_coupon.is_primary = m231_studentkare_live_22112019.salesrule_coupon.is_primary,
m231_studentkare.salesrule_coupon.created_at = m231_studentkare_live_22112019.salesrule_coupon.created_at,
m231_studentkare.salesrule_coupon.type = m231_studentkare_live_22112019.salesrule_coupon.type,
m231_studentkare.salesrule_coupon.generated_by_dotmailer = m231_studentkare_live_22112019.salesrule_coupon.generated_by_dotmailer;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
