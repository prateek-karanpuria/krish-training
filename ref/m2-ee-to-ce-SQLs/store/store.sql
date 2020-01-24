SET GLOBAL FOREIGN_KEY_CHECKS=0;

-- Take backup of store table
TRUNCATE TABLE store;

-- Execute this query 2 times & check table count
INSERT INTO m231_studentkare.store
(
m231_studentkare.store.store_id,
m231_studentkare.store.code,
m231_studentkare.store.website_id,
m231_studentkare.store.group_id,
m231_studentkare.store.name,
m231_studentkare.store.sort_order,
m231_studentkare.store.is_active
)
SELECT
m231_studentkare_live_22112019.store.store_id,
m231_studentkare_live_22112019.store.code,
m231_studentkare_live_22112019.store.website_id,
m231_studentkare_live_22112019.store.group_id,
m231_studentkare_live_22112019.store.name,
m231_studentkare_live_22112019.store.sort_order,
m231_studentkare_live_22112019.store.is_active
FROM m231_studentkare_live_22112019.store
ON DUPLICATE KEY UPDATE
m231_studentkare.store.store_id = m231_studentkare_live_22112019.store.store_id,
m231_studentkare.store.code = m231_studentkare_live_22112019.store.code,
m231_studentkare.store.website_id = m231_studentkare_live_22112019.store.website_id,
m231_studentkare.store.group_id = m231_studentkare_live_22112019.store.group_id,
m231_studentkare.store.name = m231_studentkare_live_22112019.store.name,
m231_studentkare.store.sort_order = m231_studentkare_live_22112019.store.sort_order,
m231_studentkare.store.is_active = m231_studentkare_live_22112019.store.is_active;

-- Drop backup table: DROP TABLE eav_attribute_bkp

-- Also execute, if have issue in opening admin

UPDATE store SET store_id = 0 WHERE code='admin';
UPDATE store_group SET group_id = 0 WHERE name='Default';
UPDATE store_website SET website_id = 0 WHERE code='admin';
UPDATE customer_group SET customer_group_id = 0 WHERE customer_group_code='NOT LOGGED IN';

SET GLOBAL FOREIGN_KEY_CHECKS=1;
