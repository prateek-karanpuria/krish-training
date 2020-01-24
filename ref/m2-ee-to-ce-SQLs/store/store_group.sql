SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.store_group
(
m231_studentkare.store_group.group_id,
m231_studentkare.store_group.website_id,
m231_studentkare.store_group.code,
m231_studentkare.store_group.name,
m231_studentkare.store_group.root_category_id,
m231_studentkare.store_group.default_store_id
)
SELECT
m231_studentkare_live_22112019.store_group.group_id,
m231_studentkare_live_22112019.store_group.website_id,
m231_studentkare_live_22112019.store_group.code,
m231_studentkare_live_22112019.store_group.name,
m231_studentkare_live_22112019.store_group.root_category_id,
m231_studentkare_live_22112019.store_group.default_store_id
FROM m231_studentkare_live_22112019.store_group
ON DUPLICATE KEY UPDATE
m231_studentkare.store_group.group_id = m231_studentkare_live_22112019.store_group.group_id,
m231_studentkare.store_group.website_id = m231_studentkare_live_22112019.store_group.website_id,
m231_studentkare.store_group.code = m231_studentkare_live_22112019.store_group.code,
m231_studentkare.store_group.name = m231_studentkare_live_22112019.store_group.name,
m231_studentkare.store_group.root_category_id = m231_studentkare_live_22112019.store_group.root_category_id,
m231_studentkare.store_group.default_store_id = m231_studentkare_live_22112019.store_group.default_store_id;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
