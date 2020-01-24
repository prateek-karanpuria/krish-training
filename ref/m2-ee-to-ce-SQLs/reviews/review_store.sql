SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.review_store
(
m231_studentkare.review_store.review_id,
m231_studentkare.review_store.store_id
)
SELECT
m231_studentkare_live_22112019.review_store.review_id,
m231_studentkare_live_22112019.review_store.store_id
FROM m231_studentkare_live_22112019.review_store
ON DUPLICATE KEY UPDATE
m231_studentkare.review_store.review_id = m231_studentkare_live_22112019.review_store.review_id,
m231_studentkare.review_store.store_id = m231_studentkare_live_22112019.review_store.store_id;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
