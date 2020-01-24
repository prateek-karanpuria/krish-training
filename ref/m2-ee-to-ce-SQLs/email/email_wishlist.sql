SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.email_wishlist
(
m231_studentkare.email_wishlist.id,
m231_studentkare.email_wishlist.wishlist_id,
m231_studentkare.email_wishlist.item_count,
m231_studentkare.email_wishlist.customer_id,
m231_studentkare.email_wishlist.store_id,
m231_studentkare.email_wishlist.wishlist_imported,
m231_studentkare.email_wishlist.wishlist_modified,
m231_studentkare.email_wishlist.created_at,
m231_studentkare.email_wishlist.updated_at
)
SELECT
m231_studentkare_live_22112019.email_wishlist.id,
m231_studentkare_live_22112019.email_wishlist.wishlist_id,
m231_studentkare_live_22112019.email_wishlist.item_count,
m231_studentkare_live_22112019.email_wishlist.customer_id,
m231_studentkare_live_22112019.email_wishlist.store_id,
m231_studentkare_live_22112019.email_wishlist.wishlist_imported,
m231_studentkare_live_22112019.email_wishlist.wishlist_modified,
m231_studentkare_live_22112019.email_wishlist.created_at,
m231_studentkare_live_22112019.email_wishlist.updated_at
FROM m231_studentkare_live_22112019.email_wishlist
ON DUPLICATE KEY UPDATE
m231_studentkare.email_wishlist.id = m231_studentkare_live_22112019.email_wishlist.id,
m231_studentkare.email_wishlist.wishlist_id = m231_studentkare_live_22112019.email_wishlist.wishlist_id,
m231_studentkare.email_wishlist.item_count = m231_studentkare_live_22112019.email_wishlist.item_count,
m231_studentkare.email_wishlist.customer_id = m231_studentkare_live_22112019.email_wishlist.customer_id,
m231_studentkare.email_wishlist.store_id = m231_studentkare_live_22112019.email_wishlist.store_id,
m231_studentkare.email_wishlist.wishlist_imported = m231_studentkare_live_22112019.email_wishlist.wishlist_imported,
m231_studentkare.email_wishlist.wishlist_modified = m231_studentkare_live_22112019.email_wishlist.wishlist_modified,
m231_studentkare.email_wishlist.created_at = m231_studentkare_live_22112019.email_wishlist.created_at,
m231_studentkare.email_wishlist.updated_at = m231_studentkare_live_22112019.email_wishlist.updated_at;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
