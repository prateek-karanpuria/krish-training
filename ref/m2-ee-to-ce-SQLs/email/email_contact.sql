SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.email_contact
(
m231_studentkare.email_contact.email_contact_id,
m231_studentkare.email_contact.is_guest,
m231_studentkare.email_contact.contact_id,
m231_studentkare.email_contact.customer_id,
m231_studentkare.email_contact.website_id,
m231_studentkare.email_contact.store_id,
m231_studentkare.email_contact.email,
m231_studentkare.email_contact.is_subscriber,
m231_studentkare.email_contact.subscriber_status,
m231_studentkare.email_contact.email_imported,
m231_studentkare.email_contact.subscriber_imported,
m231_studentkare.email_contact.suppressed
)
SELECT
m231_studentkare_live_22112019.email_contact.email_contact_id,
m231_studentkare_live_22112019.email_contact.is_guest,
m231_studentkare_live_22112019.email_contact.contact_id,
m231_studentkare_live_22112019.email_contact.customer_id,
m231_studentkare_live_22112019.email_contact.website_id,
m231_studentkare_live_22112019.email_contact.store_id,
m231_studentkare_live_22112019.email_contact.email,
m231_studentkare_live_22112019.email_contact.is_subscriber,
m231_studentkare_live_22112019.email_contact.subscriber_status,
m231_studentkare_live_22112019.email_contact.email_imported,
m231_studentkare_live_22112019.email_contact.subscriber_imported,
m231_studentkare_live_22112019.email_contact.suppressed
FROM m231_studentkare_live_22112019.email_contact
ON DUPLICATE KEY UPDATE
m231_studentkare.email_contact.email_contact_id = m231_studentkare_live_22112019.email_contact.email_contact_id,
m231_studentkare.email_contact.is_guest = m231_studentkare_live_22112019.email_contact.is_guest,
m231_studentkare.email_contact.contact_id = m231_studentkare_live_22112019.email_contact.contact_id,
m231_studentkare.email_contact.customer_id = m231_studentkare_live_22112019.email_contact.customer_id,
m231_studentkare.email_contact.website_id = m231_studentkare_live_22112019.email_contact.website_id,
m231_studentkare.email_contact.store_id = m231_studentkare_live_22112019.email_contact.store_id,
m231_studentkare.email_contact.email = m231_studentkare_live_22112019.email_contact.email,
m231_studentkare.email_contact.is_subscriber = m231_studentkare_live_22112019.email_contact.is_subscriber,
m231_studentkare.email_contact.subscriber_status = m231_studentkare_live_22112019.email_contact.subscriber_status,
m231_studentkare.email_contact.email_imported = m231_studentkare_live_22112019.email_contact.email_imported,
m231_studentkare.email_contact.subscriber_imported = m231_studentkare_live_22112019.email_contact.subscriber_imported,
m231_studentkare.email_contact.suppressed = m231_studentkare_live_22112019.email_contact.suppressed;

SET GLOBAL FOREIGN_KEY_CHECKS=1;