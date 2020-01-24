SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.theme
(
m231_studentkare.theme.theme_id,
m231_studentkare.theme.parent_id,
m231_studentkare.theme.theme_path,
m231_studentkare.theme.theme_title,
m231_studentkare.theme.preview_image,
m231_studentkare.theme.is_featured,
m231_studentkare.theme.area,
m231_studentkare.theme.type,
m231_studentkare.theme.code
)
SELECT
m231_studentkare_live_22112019.theme.theme_id,
m231_studentkare_live_22112019.theme.parent_id,
m231_studentkare_live_22112019.theme.theme_path,
m231_studentkare_live_22112019.theme.theme_title,
m231_studentkare_live_22112019.theme.preview_image,
m231_studentkare_live_22112019.theme.is_featured,
m231_studentkare_live_22112019.theme.area,
m231_studentkare_live_22112019.theme.type,
m231_studentkare_live_22112019.theme.code
FROM m231_studentkare_live_22112019.theme
ON DUPLICATE KEY UPDATE
m231_studentkare.theme.theme_id = m231_studentkare_live_22112019.theme.theme_id,
m231_studentkare.theme.parent_id = m231_studentkare_live_22112019.theme.parent_id,
m231_studentkare.theme.theme_path = m231_studentkare_live_22112019.theme.theme_path,
m231_studentkare.theme.theme_title = m231_studentkare_live_22112019.theme.theme_title,
m231_studentkare.theme.preview_image = m231_studentkare_live_22112019.theme.preview_image,
m231_studentkare.theme.is_featured = m231_studentkare_live_22112019.theme.is_featured,
m231_studentkare.theme.area = m231_studentkare_live_22112019.theme.area,
m231_studentkare.theme.type = m231_studentkare_live_22112019.theme.type,
m231_studentkare.theme.code = m231_studentkare_live_22112019.theme.code;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
