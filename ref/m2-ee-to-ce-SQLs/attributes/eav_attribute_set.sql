SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.eav_attribute_set
(
m231_studentkare.eav_attribute_set.attribute_set_id,
m231_studentkare.eav_attribute_set.entity_type_id,
m231_studentkare.eav_attribute_set.attribute_set_name,
m231_studentkare.eav_attribute_set.sort_order
)
SELECT
m231_studentkare_live_22112019.eav_attribute_set.attribute_set_id,
m231_studentkare_live_22112019.eav_attribute_set.entity_type_id,
m231_studentkare_live_22112019.eav_attribute_set.attribute_set_name,
m231_studentkare_live_22112019.eav_attribute_set.sort_order
FROM m231_studentkare_live_22112019.eav_attribute_set
ON DUPLICATE KEY UPDATE
m231_studentkare.eav_attribute_set.attribute_set_id = m231_studentkare_live_22112019.eav_attribute_set.attribute_set_id,
m231_studentkare.eav_attribute_set.entity_type_id = m231_studentkare_live_22112019.eav_attribute_set.entity_type_id,
m231_studentkare.eav_attribute_set.attribute_set_name = m231_studentkare_live_22112019.eav_attribute_set.attribute_set_name,
m231_studentkare.eav_attribute_set.sort_order = m231_studentkare_live_22112019.eav_attribute_set.sort_order;

SET GLOBAL FOREIGN_KEY_CHECKS=1;