SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.cms_page
(
m231_studentkare.cms_page.page_id,
m231_studentkare.cms_page.title,
m231_studentkare.cms_page.page_layout,
m231_studentkare.cms_page.meta_keywords,
m231_studentkare.cms_page.meta_description,
m231_studentkare.cms_page.identifier,
m231_studentkare.cms_page.content_heading,
m231_studentkare.cms_page.content,
m231_studentkare.cms_page.creation_time,
m231_studentkare.cms_page.update_time,
m231_studentkare.cms_page.is_active,
m231_studentkare.cms_page.sort_order,
m231_studentkare.cms_page.layout_update_xml,
m231_studentkare.cms_page.custom_theme,
m231_studentkare.cms_page.custom_root_template,
m231_studentkare.cms_page.custom_layout_update_xml,
m231_studentkare.cms_page.custom_theme_from,
m231_studentkare.cms_page.custom_theme_to,
m231_studentkare.cms_page.meta_title
)
SELECT
m231_studentkare_live_22112019.cms_page.row_id,
m231_studentkare_live_22112019.cms_page.title,
m231_studentkare_live_22112019.cms_page.page_layout,
m231_studentkare_live_22112019.cms_page.meta_keywords,
m231_studentkare_live_22112019.cms_page.meta_description,
m231_studentkare_live_22112019.cms_page.identifier,
m231_studentkare_live_22112019.cms_page.content_heading,
m231_studentkare_live_22112019.cms_page.content,
m231_studentkare_live_22112019.cms_page.creation_time,
m231_studentkare_live_22112019.cms_page.update_time,
m231_studentkare_live_22112019.cms_page.is_active,
m231_studentkare_live_22112019.cms_page.sort_order,
m231_studentkare_live_22112019.cms_page.layout_update_xml,
m231_studentkare_live_22112019.cms_page.custom_theme,
m231_studentkare_live_22112019.cms_page.custom_root_template,
m231_studentkare_live_22112019.cms_page.custom_layout_update_xml,
m231_studentkare_live_22112019.cms_page.custom_theme_from,
m231_studentkare_live_22112019.cms_page.custom_theme_to,
m231_studentkare_live_22112019.cms_page.meta_title
FROM m231_studentkare_live_22112019.cms_page
ON DUPLICATE KEY UPDATE
m231_studentkare.cms_page.page_id = m231_studentkare_live_22112019.cms_page.row_id,
m231_studentkare.cms_page.title = m231_studentkare_live_22112019.cms_page.title,
m231_studentkare.cms_page.page_layout = m231_studentkare_live_22112019.cms_page.page_layout,
m231_studentkare.cms_page.meta_keywords = m231_studentkare_live_22112019.cms_page.meta_keywords,
m231_studentkare.cms_page.meta_description = m231_studentkare_live_22112019.cms_page.meta_description,
m231_studentkare.cms_page.identifier = m231_studentkare_live_22112019.cms_page.identifier,
m231_studentkare.cms_page.content_heading = m231_studentkare_live_22112019.cms_page.content_heading,
m231_studentkare.cms_page.content = m231_studentkare_live_22112019.cms_page.content,
m231_studentkare.cms_page.creation_time = m231_studentkare_live_22112019.cms_page.creation_time,
m231_studentkare.cms_page.update_time = m231_studentkare_live_22112019.cms_page.update_time,
m231_studentkare.cms_page.is_active = m231_studentkare_live_22112019.cms_page.is_active,
m231_studentkare.cms_page.sort_order = m231_studentkare_live_22112019.cms_page.sort_order,
m231_studentkare.cms_page.layout_update_xml = m231_studentkare_live_22112019.cms_page.layout_update_xml,
m231_studentkare.cms_page.custom_theme = m231_studentkare_live_22112019.cms_page.custom_theme,
m231_studentkare.cms_page.custom_root_template = m231_studentkare_live_22112019.cms_page.custom_root_template,
m231_studentkare.cms_page.custom_layout_update_xml = m231_studentkare_live_22112019.cms_page.custom_layout_update_xml,
m231_studentkare.cms_page.custom_theme_from = m231_studentkare_live_22112019.cms_page.custom_theme_from,
m231_studentkare.cms_page.custom_theme_to = m231_studentkare_live_22112019.cms_page.custom_theme_to,
m231_studentkare.cms_page.meta_title = m231_studentkare_live_22112019.cms_page.meta_title;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
