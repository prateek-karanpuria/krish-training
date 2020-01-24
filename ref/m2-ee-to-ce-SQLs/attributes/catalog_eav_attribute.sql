SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.catalog_eav_attribute
(
    m231_studentkare.catalog_eav_attribute.attribute_id, m231_studentkare.catalog_eav_attribute.frontend_input_renderer, m231_studentkare.catalog_eav_attribute.is_global, m231_studentkare.catalog_eav_attribute.is_visible, m231_studentkare.catalog_eav_attribute.is_searchable, m231_studentkare.catalog_eav_attribute.is_filterable, m231_studentkare.catalog_eav_attribute.is_comparable, m231_studentkare.catalog_eav_attribute.is_visible_on_front, m231_studentkare.catalog_eav_attribute.is_html_allowed_on_front, m231_studentkare.catalog_eav_attribute.is_used_for_price_rules, m231_studentkare.catalog_eav_attribute.is_filterable_in_search, m231_studentkare.catalog_eav_attribute.used_in_product_listing, m231_studentkare.catalog_eav_attribute.used_for_sort_by, m231_studentkare.catalog_eav_attribute.apply_to, m231_studentkare.catalog_eav_attribute.is_visible_in_advanced_search, m231_studentkare.catalog_eav_attribute.position, m231_studentkare.catalog_eav_attribute.is_wysiwyg_enabled, m231_studentkare.catalog_eav_attribute.is_used_for_promo_rules, m231_studentkare.catalog_eav_attribute.is_required_in_admin_store, m231_studentkare.catalog_eav_attribute.is_used_in_grid, m231_studentkare.catalog_eav_attribute.is_visible_in_grid, m231_studentkare.catalog_eav_attribute.is_filterable_in_grid, m231_studentkare.catalog_eav_attribute.search_weight, m231_studentkare.catalog_eav_attribute.additional_data
)
SELECT
    m231_studentkare_live_22112019.catalog_eav_attribute.attribute_id, m231_studentkare_live_22112019.catalog_eav_attribute.frontend_input_renderer, m231_studentkare_live_22112019.catalog_eav_attribute.is_global, m231_studentkare_live_22112019.catalog_eav_attribute.is_visible, m231_studentkare_live_22112019.catalog_eav_attribute.is_searchable, m231_studentkare_live_22112019.catalog_eav_attribute.is_filterable, m231_studentkare_live_22112019.catalog_eav_attribute.is_comparable, m231_studentkare_live_22112019.catalog_eav_attribute.is_visible_on_front, m231_studentkare_live_22112019.catalog_eav_attribute.is_html_allowed_on_front, m231_studentkare_live_22112019.catalog_eav_attribute.is_used_for_price_rules, m231_studentkare_live_22112019.catalog_eav_attribute.is_filterable_in_search, m231_studentkare_live_22112019.catalog_eav_attribute.used_in_product_listing, m231_studentkare_live_22112019.catalog_eav_attribute.used_for_sort_by, m231_studentkare_live_22112019.catalog_eav_attribute.apply_to, m231_studentkare_live_22112019.catalog_eav_attribute.is_visible_in_advanced_search, m231_studentkare_live_22112019.catalog_eav_attribute.position, m231_studentkare_live_22112019.catalog_eav_attribute.is_wysiwyg_enabled, m231_studentkare_live_22112019.catalog_eav_attribute.is_used_for_promo_rules, m231_studentkare_live_22112019.catalog_eav_attribute.is_required_in_admin_store, m231_studentkare_live_22112019.catalog_eav_attribute.is_used_in_grid, m231_studentkare_live_22112019.catalog_eav_attribute.is_visible_in_grid, m231_studentkare_live_22112019.catalog_eav_attribute.is_filterable_in_grid, m231_studentkare_live_22112019.catalog_eav_attribute.search_weight, m231_studentkare_live_22112019.catalog_eav_attribute.additional_data
FROM m231_studentkare_live_22112019.catalog_eav_attribute
ON DUPLICATE KEY UPDATE
    m231_studentkare.catalog_eav_attribute.attribute_id = m231_studentkare_live_22112019.catalog_eav_attribute.attribute_id,
    m231_studentkare.catalog_eav_attribute.frontend_input_renderer = m231_studentkare_live_22112019.catalog_eav_attribute.frontend_input_renderer,
    m231_studentkare.catalog_eav_attribute.is_global = m231_studentkare_live_22112019.catalog_eav_attribute.is_global,
    m231_studentkare.catalog_eav_attribute.is_visible = m231_studentkare_live_22112019.catalog_eav_attribute.is_visible,
    m231_studentkare.catalog_eav_attribute.is_searchable = m231_studentkare_live_22112019.catalog_eav_attribute.is_searchable,
    m231_studentkare.catalog_eav_attribute.is_filterable = m231_studentkare_live_22112019.catalog_eav_attribute.is_filterable,
    m231_studentkare.catalog_eav_attribute.is_comparable = m231_studentkare_live_22112019.catalog_eav_attribute.is_comparable,
    m231_studentkare.catalog_eav_attribute.is_visible_on_front = m231_studentkare_live_22112019.catalog_eav_attribute.is_visible_on_front,
    m231_studentkare.catalog_eav_attribute.is_html_allowed_on_front = m231_studentkare_live_22112019.catalog_eav_attribute.is_html_allowed_on_front,
    m231_studentkare.catalog_eav_attribute.is_used_for_price_rules = m231_studentkare_live_22112019.catalog_eav_attribute.is_used_for_price_rules,
    m231_studentkare.catalog_eav_attribute.is_filterable_in_search = m231_studentkare_live_22112019.catalog_eav_attribute.is_filterable_in_search,
    m231_studentkare.catalog_eav_attribute.used_in_product_listing = m231_studentkare_live_22112019.catalog_eav_attribute.used_in_product_listing,
    m231_studentkare.catalog_eav_attribute.used_for_sort_by = m231_studentkare_live_22112019.catalog_eav_attribute.used_for_sort_by,
    m231_studentkare.catalog_eav_attribute.apply_to = m231_studentkare_live_22112019.catalog_eav_attribute.apply_to,
    m231_studentkare.catalog_eav_attribute.is_visible_in_advanced_search = m231_studentkare_live_22112019.catalog_eav_attribute.is_visible_in_advanced_search,
    m231_studentkare.catalog_eav_attribute.position = m231_studentkare_live_22112019.catalog_eav_attribute.position,
    m231_studentkare.catalog_eav_attribute.is_wysiwyg_enabled = m231_studentkare_live_22112019.catalog_eav_attribute.is_wysiwyg_enabled,
    m231_studentkare.catalog_eav_attribute.is_used_for_promo_rules = m231_studentkare_live_22112019.catalog_eav_attribute.is_used_for_promo_rules,
    m231_studentkare.catalog_eav_attribute.is_required_in_admin_store = m231_studentkare_live_22112019.catalog_eav_attribute.is_required_in_admin_store,
    m231_studentkare.catalog_eav_attribute.is_used_in_grid = m231_studentkare_live_22112019.catalog_eav_attribute.is_used_in_grid,
    m231_studentkare.catalog_eav_attribute.is_visible_in_grid = m231_studentkare_live_22112019.catalog_eav_attribute.is_visible_in_grid,
    m231_studentkare.catalog_eav_attribute.is_filterable_in_grid = m231_studentkare_live_22112019.catalog_eav_attribute.is_filterable_in_grid,
    m231_studentkare.catalog_eav_attribute.search_weight = m231_studentkare_live_22112019.catalog_eav_attribute.search_weight,
    m231_studentkare.catalog_eav_attribute.additional_data = m231_studentkare_live_22112019.catalog_eav_attribute.additional_data

SET GLOBAL FOREIGN_KEY_CHECKS=1;
