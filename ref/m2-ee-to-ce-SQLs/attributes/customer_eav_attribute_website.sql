SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.customer_eav_attribute_website
(
m231_studentkare.customer_eav_attribute_website.attribute_id,
m231_studentkare.customer_eav_attribute_website.website_id,
m231_studentkare.customer_eav_attribute_website.is_visible,
m231_studentkare.customer_eav_attribute_website.is_required,
m231_studentkare.customer_eav_attribute_website.default_value,
m231_studentkare.customer_eav_attribute_website.multiline_count
)
SELECT
m231_studentkare_live_22112019.customer_eav_attribute_website.attribute_id,
m231_studentkare_live_22112019.customer_eav_attribute_website.website_id,
m231_studentkare_live_22112019.customer_eav_attribute_website.is_visible,
m231_studentkare_live_22112019.customer_eav_attribute_website.is_required,
m231_studentkare_live_22112019.customer_eav_attribute_website.default_value,
m231_studentkare_live_22112019.customer_eav_attribute_website.multiline_count
FROM m231_studentkare_live_22112019.customer_eav_attribute_website
ON DUPLICATE KEY UPDATE
m231_studentkare.customer_eav_attribute_website.attribute_id = m231_studentkare_live_22112019.customer_eav_attribute_website.attribute_id,
m231_studentkare.customer_eav_attribute_website.website_id = m231_studentkare_live_22112019.customer_eav_attribute_website.website_id,
m231_studentkare.customer_eav_attribute_website.is_visible = m231_studentkare_live_22112019.customer_eav_attribute_website.is_visible,
m231_studentkare.customer_eav_attribute_website.is_required = m231_studentkare_live_22112019.customer_eav_attribute_website.is_required,
m231_studentkare.customer_eav_attribute_website.default_value = m231_studentkare_live_22112019.customer_eav_attribute_website.default_value,
m231_studentkare.customer_eav_attribute_website.multiline_count = m231_studentkare_live_22112019.customer_eav_attribute_website.multiline_count;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
