SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.newsletter_template
(
m231_studentkare.newsletter_template.template_id,
m231_studentkare.newsletter_template.template_code,
m231_studentkare.newsletter_template.template_text,
m231_studentkare.newsletter_template.template_styles,
m231_studentkare.newsletter_template.template_type,
m231_studentkare.newsletter_template.template_subject,
m231_studentkare.newsletter_template.template_sender_name,
m231_studentkare.newsletter_template.template_sender_email,
m231_studentkare.newsletter_template.template_actual,
m231_studentkare.newsletter_template.added_at,
m231_studentkare.newsletter_template.modified_at
)
SELECT
m231_studentkare_live_22112019.newsletter_template.template_id,
m231_studentkare_live_22112019.newsletter_template.template_code,
m231_studentkare_live_22112019.newsletter_template.template_text,
m231_studentkare_live_22112019.newsletter_template.template_styles,
m231_studentkare_live_22112019.newsletter_template.template_type,
m231_studentkare_live_22112019.newsletter_template.template_subject,
m231_studentkare_live_22112019.newsletter_template.template_sender_name,
m231_studentkare_live_22112019.newsletter_template.template_sender_email,
m231_studentkare_live_22112019.newsletter_template.template_actual,
m231_studentkare_live_22112019.newsletter_template.added_at,
m231_studentkare_live_22112019.newsletter_template.modified_at
FROM m231_studentkare_live_22112019.newsletter_template
ON DUPLICATE KEY UPDATE
m231_studentkare.newsletter_template.template_id = m231_studentkare_live_22112019.newsletter_template.template_id,
m231_studentkare.newsletter_template.template_code = m231_studentkare_live_22112019.newsletter_template.template_code,
m231_studentkare.newsletter_template.template_text = m231_studentkare_live_22112019.newsletter_template.template_text,
m231_studentkare.newsletter_template.template_styles = m231_studentkare_live_22112019.newsletter_template.template_styles,
m231_studentkare.newsletter_template.template_type = m231_studentkare_live_22112019.newsletter_template.template_type,
m231_studentkare.newsletter_template.template_subject = m231_studentkare_live_22112019.newsletter_template.template_subject,
m231_studentkare.newsletter_template.template_sender_name = m231_studentkare_live_22112019.newsletter_template.template_sender_name,
m231_studentkare.newsletter_template.template_sender_email = m231_studentkare_live_22112019.newsletter_template.template_sender_email,
m231_studentkare.newsletter_template.template_actual = m231_studentkare_live_22112019.newsletter_template.template_actual,
m231_studentkare.newsletter_template.added_at = m231_studentkare_live_22112019.newsletter_template.added_at,
m231_studentkare.newsletter_template.modified_at = m231_studentkare_live_22112019.newsletter_template.modified_at;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
