SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.email_importer
(
m231_studentkare.email_importer.id,
m231_studentkare.email_importer.import_type,
m231_studentkare.email_importer.website_id,
m231_studentkare.email_importer.import_status,
m231_studentkare.email_importer.import_id,
m231_studentkare.email_importer.import_data,
m231_studentkare.email_importer.import_mode,
m231_studentkare.email_importer.import_file,
m231_studentkare.email_importer.message,
m231_studentkare.email_importer.created_at,
m231_studentkare.email_importer.updated_at,
m231_studentkare.email_importer.import_started,
m231_studentkare.email_importer.import_finished
)
SELECT
m231_studentkare_live_22112019.email_importer.id,
m231_studentkare_live_22112019.email_importer.import_type,
m231_studentkare_live_22112019.email_importer.website_id,
m231_studentkare_live_22112019.email_importer.import_status,
m231_studentkare_live_22112019.email_importer.import_id,
m231_studentkare_live_22112019.email_importer.import_data,
m231_studentkare_live_22112019.email_importer.import_mode,
m231_studentkare_live_22112019.email_importer.import_file,
m231_studentkare_live_22112019.email_importer.message,
m231_studentkare_live_22112019.email_importer.created_at,
m231_studentkare_live_22112019.email_importer.updated_at,
m231_studentkare_live_22112019.email_importer.import_started,
m231_studentkare_live_22112019.email_importer.import_finished
FROM m231_studentkare_live_22112019.email_importer
ON DUPLICATE KEY UPDATE
m231_studentkare.email_importer.id = m231_studentkare_live_22112019.email_importer.id,
m231_studentkare.email_importer.import_type = m231_studentkare_live_22112019.email_importer.import_type,
m231_studentkare.email_importer.website_id = m231_studentkare_live_22112019.email_importer.website_id,
m231_studentkare.email_importer.import_status = m231_studentkare_live_22112019.email_importer.import_status,
m231_studentkare.email_importer.import_id = m231_studentkare_live_22112019.email_importer.import_id,
m231_studentkare.email_importer.import_data = m231_studentkare_live_22112019.email_importer.import_data,
m231_studentkare.email_importer.import_mode = m231_studentkare_live_22112019.email_importer.import_mode,
m231_studentkare.email_importer.import_file = m231_studentkare_live_22112019.email_importer.import_file,
m231_studentkare.email_importer.message = m231_studentkare_live_22112019.email_importer.message,
m231_studentkare.email_importer.created_at = m231_studentkare_live_22112019.email_importer.created_at,
m231_studentkare.email_importer.updated_at = m231_studentkare_live_22112019.email_importer.updated_at,
m231_studentkare.email_importer.import_started = m231_studentkare_live_22112019.email_importer.import_started,
m231_studentkare.email_importer.import_finished = m231_studentkare_live_22112019.email_importer.import_finished;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
