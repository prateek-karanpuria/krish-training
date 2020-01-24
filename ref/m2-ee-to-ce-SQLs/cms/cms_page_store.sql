SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.cms_page_store
(
m231_studentkare.cms_page_store.page_id,
m231_studentkare.cms_page_store.store_id
)
SELECT
m231_studentkare_live_22112019.cms_page_store.row_id,
m231_studentkare_live_22112019.cms_page_store.store_id
FROM m231_studentkare_live_22112019.cms_page_store
ON DUPLICATE KEY UPDATE
m231_studentkare.cms_page_store.page_id = m231_studentkare_live_22112019.cms_page_store.row_id,
m231_studentkare.cms_page_store.store_id = m231_studentkare_live_22112019.cms_page_store.store_id;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
