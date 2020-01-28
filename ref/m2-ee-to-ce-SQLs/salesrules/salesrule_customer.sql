SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.salesrule_customer
(
m231_studentkare.salesrule_customer.rule_customer_id,
m231_studentkare.salesrule_customer.rule_id,
m231_studentkare.salesrule_customer.customer_id,
m231_studentkare.salesrule_customer.times_used
)
SELECT
m231_studentkare_live_22112019.salesrule_customer.rule_customer_id,
m231_studentkare_live_22112019.salesrule_customer.rule_id,
m231_studentkare_live_22112019.salesrule_customer.customer_id,
m231_studentkare_live_22112019.salesrule_customer.times_used
FROM m231_studentkare_live_22112019.salesrule_customer
ON DUPLICATE KEY UPDATE
m231_studentkare.salesrule_customer.rule_customer_id = m231_studentkare_live_22112019.salesrule_customer.rule_customer_id,
m231_studentkare.salesrule_customer.rule_id = m231_studentkare_live_22112019.salesrule_customer.rule_id,
m231_studentkare.salesrule_customer.customer_id = m231_studentkare_live_22112019.salesrule_customer.customer_id,
m231_studentkare.salesrule_customer.times_used = m231_studentkare_live_22112019.salesrule_customer.times_used;

SET GLOBAL FOREIGN_KEY_CHECKS=1;