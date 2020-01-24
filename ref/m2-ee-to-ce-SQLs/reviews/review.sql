SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.review
(
m231_studentkare.review.review_id,
m231_studentkare.review.created_at,
m231_studentkare.review.entity_id,
m231_studentkare.review.entity_pk_value,
m231_studentkare.review.status_id
)
SELECT
m231_studentkare_live_22112019.review.review_id,
m231_studentkare_live_22112019.review.created_at,
m231_studentkare_live_22112019.review.entity_id,
m231_studentkare_live_22112019.review.entity_pk_value,
m231_studentkare_live_22112019.review.status_id
FROM m231_studentkare_live_22112019.review
ON DUPLICATE KEY UPDATE
m231_studentkare.review.review_id = m231_studentkare_live_22112019.review.review_id,
m231_studentkare.review.created_at = m231_studentkare_live_22112019.review.created_at,
m231_studentkare.review.entity_id = m231_studentkare_live_22112019.review.entity_id,
m231_studentkare.review.entity_pk_value = m231_studentkare_live_22112019.review.entity_pk_value,
m231_studentkare.review.status_id = m231_studentkare_live_22112019.review.status_id;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
