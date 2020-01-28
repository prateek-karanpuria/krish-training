SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.quote_item_option
(
m231_studentkare.quote_item_option.option_id,
m231_studentkare.quote_item_option.item_id,
m231_studentkare.quote_item_option.product_id,
m231_studentkare.quote_item_option.code,
m231_studentkare.quote_item_option.value
)
SELECT
m231_studentkare_live_22112019.quote_item_option.option_id,
m231_studentkare_live_22112019.quote_item_option.item_id,
m231_studentkare_live_22112019.quote_item_option.product_id,
m231_studentkare_live_22112019.quote_item_option.code,
m231_studentkare_live_22112019.quote_item_option.value
FROM m231_studentkare_live_22112019.quote_item_option
ON DUPLICATE KEY UPDATE
m231_studentkare.quote_item_option.option_id = m231_studentkare_live_22112019.quote_item_option.option_id,
m231_studentkare.quote_item_option.item_id = m231_studentkare_live_22112019.quote_item_option.item_id,
m231_studentkare.quote_item_option.product_id = m231_studentkare_live_22112019.quote_item_option.product_id,
m231_studentkare.quote_item_option.code = m231_studentkare_live_22112019.quote_item_option.code,
m231_studentkare.quote_item_option.value = m231_studentkare_live_22112019.quote_item_option.value;

SET GLOBAL FOREIGN_KEY_CHECKS=1;