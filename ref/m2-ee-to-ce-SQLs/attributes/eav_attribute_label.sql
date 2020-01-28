SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.eav_attribute_label
(
m231_studentkare.eav_attribute_label.attribute_label_id,
m231_studentkare.eav_attribute_label.attribute_id,
m231_studentkare.eav_attribute_label.store_id,
m231_studentkare.eav_attribute_label.value
)
SELECT
m231_studentkare_live_22112019.eav_attribute_label.attribute_label_id,
m231_studentkare_live_22112019.eav_attribute_label.attribute_id,
m231_studentkare_live_22112019.eav_attribute_label.store_id,
m231_studentkare_live_22112019.eav_attribute_label.value
FROM m231_studentkare_live_22112019.eav_attribute_label
ON DUPLICATE KEY UPDATE
m231_studentkare.eav_attribute_label.attribute_label_id = m231_studentkare_live_22112019.eav_attribute_label.attribute_label_id,
m231_studentkare.eav_attribute_label.attribute_id = m231_studentkare_live_22112019.eav_attribute_label.attribute_id,
m231_studentkare.eav_attribute_label.store_id = m231_studentkare_live_22112019.eav_attribute_label.store_id,
m231_studentkare.eav_attribute_label.value = m231_studentkare_live_22112019.eav_attribute_label.value;

SET GLOBAL FOREIGN_KEY_CHECKS=1;