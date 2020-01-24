SET GLOBAL FOREIGN_KEY_CHECKS=0;

TRUNCATE TABLE catalogsearch_fulltext_scope1

INSERT INTO m231_studentkare.catalogsearch_fulltext_scope1
(
m231_studentkare.catalogsearch_fulltext_scope1.entity_id,
m231_studentkare.catalogsearch_fulltext_scope1.attribute_id,
m231_studentkare.catalogsearch_fulltext_scope1.data_index
)
SELECT
m231_studentkare_live_22112019.catalogsearch_fulltext_scope1.entity_id,
m231_studentkare_live_22112019.catalogsearch_fulltext_scope1.attribute_id,
m231_studentkare_live_22112019.catalogsearch_fulltext_scope1.data_index
FROM m231_studentkare_live_22112019.catalogsearch_fulltext_scope1
ON DUPLICATE KEY UPDATE
m231_studentkare.catalogsearch_fulltext_scope1.entity_id = m231_studentkare_live_22112019.catalogsearch_fulltext_scope1.entity_id,
m231_studentkare.catalogsearch_fulltext_scope1.attribute_id = m231_studentkare_live_22112019.catalogsearch_fulltext_scope1.attribute_id,
m231_studentkare.catalogsearch_fulltext_scope1.data_index = m231_studentkare_live_22112019.catalogsearch_fulltext_scope1.data_index;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
