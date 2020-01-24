SET GLOBAL FOREIGN_KEY_CHECKS=0;

-- Take backup of eav_attribute table ('eav_attribute_bkp')
TRUNCATE TABLE eav_attribute;

-- Try this first & if this fails then try below step
INSERT INTO m231_studentkare.eav_attribute
(
m231_studentkare.eav_attribute.attribute_id,
m231_studentkare.eav_attribute.entity_type_id,
m231_studentkare.eav_attribute.attribute_code,
m231_studentkare.eav_attribute.attribute_model,
m231_studentkare.eav_attribute.backend_model,
m231_studentkare.eav_attribute.backend_type,
m231_studentkare.eav_attribute.backend_table,
m231_studentkare.eav_attribute.frontend_model,
m231_studentkare.eav_attribute.frontend_input,
m231_studentkare.eav_attribute.frontend_label,
m231_studentkare.eav_attribute.frontend_class,
m231_studentkare.eav_attribute.source_model,
m231_studentkare.eav_attribute.is_required,
m231_studentkare.eav_attribute.is_user_defined,
m231_studentkare.eav_attribute.default_value,
m231_studentkare.eav_attribute.is_unique,
m231_studentkare.eav_attribute.note
)
SELECT
m231_studentkare_live_22112019.eav_attribute.attribute_id,
m231_studentkare_live_22112019.eav_attribute.entity_type_id,
m231_studentkare_live_22112019.eav_attribute.attribute_code,
m231_studentkare_live_22112019.eav_attribute.attribute_model,
m231_studentkare_live_22112019.eav_attribute.backend_model,
m231_studentkare_live_22112019.eav_attribute.backend_type,
m231_studentkare_live_22112019.eav_attribute.backend_table,
m231_studentkare_live_22112019.eav_attribute.frontend_model,
m231_studentkare_live_22112019.eav_attribute.frontend_input,
m231_studentkare_live_22112019.eav_attribute.frontend_label,
m231_studentkare_live_22112019.eav_attribute.frontend_class,
m231_studentkare_live_22112019.eav_attribute.source_model,
m231_studentkare_live_22112019.eav_attribute.is_required,
m231_studentkare_live_22112019.eav_attribute.is_user_defined,
m231_studentkare_live_22112019.eav_attribute.default_value,
m231_studentkare_live_22112019.eav_attribute.is_unique,
m231_studentkare_live_22112019.eav_attribute.note
FROM m231_studentkare_live_22112019.eav_attribute
ON DUPLICATE KEY UPDATE
m231_studentkare.eav_attribute.attribute_id = m231_studentkare_live_22112019.eav_attribute.attribute_id,
m231_studentkare.eav_attribute.entity_type_id = m231_studentkare_live_22112019.eav_attribute.entity_type_id,
m231_studentkare.eav_attribute.attribute_code = m231_studentkare_live_22112019.eav_attribute.attribute_code,
m231_studentkare.eav_attribute.attribute_model = m231_studentkare_live_22112019.eav_attribute.attribute_model,
m231_studentkare.eav_attribute.backend_model = m231_studentkare_live_22112019.eav_attribute.backend_model,
m231_studentkare.eav_attribute.backend_type = m231_studentkare_live_22112019.eav_attribute.backend_type,
m231_studentkare.eav_attribute.backend_table = m231_studentkare_live_22112019.eav_attribute.backend_table,
m231_studentkare.eav_attribute.frontend_model = m231_studentkare_live_22112019.eav_attribute.frontend_model,
m231_studentkare.eav_attribute.frontend_input = m231_studentkare_live_22112019.eav_attribute.frontend_input,
m231_studentkare.eav_attribute.frontend_label = m231_studentkare_live_22112019.eav_attribute.frontend_label,
m231_studentkare.eav_attribute.frontend_class = m231_studentkare_live_22112019.eav_attribute.frontend_class,
m231_studentkare.eav_attribute.source_model = m231_studentkare_live_22112019.eav_attribute.source_model,
m231_studentkare.eav_attribute.is_required = m231_studentkare_live_22112019.eav_attribute.is_required,
m231_studentkare.eav_attribute.is_user_defined = m231_studentkare_live_22112019.eav_attribute.is_user_defined,
m231_studentkare.eav_attribute.default_value = m231_studentkare_live_22112019.eav_attribute.default_value,
m231_studentkare.eav_attribute.is_unique = m231_studentkare_live_22112019.eav_attribute.is_unique,
m231_studentkare.eav_attribute.note = m231_studentkare_live_22112019.eav_attribute.note;

-- If have issue with insert query then export table SQL & then insert in table

-- Drop backup table: DROP TABLE eav_attribute_bkp

-- Remove EE eav attributes
DELETE
FROM eav_attribute
WHERE attribute_code IN (
    'reward_update_notification',
    'reward_warning_notification',
    'automatic_sorting',
    'allow_message',
    'allow_open_amount',
    'email_template',
    'giftcard_amounts',
    'giftcard_type',
    'gift_wrapping_available',
    'gift_wrapping_price',
    'is_redeemable',
    'is_returnable',
    'lifetime',
    'open_amount_max',
    'open_amount_min',
    'related_tgtr_position_behavior',
    'related_tgtr_position_limit',
    'upsell_tgtr_position_behavior',
    'upsell_tgtr_position_limit',
    'use_config_allow_message',
    'use_config_email_template',
    'use_config_is_redeemable',
    'use_config_lifetime',
    'reward_points_balance_refunded',
    'reward_salesrule_points',
    'condition',
    'is_qty_decimal',
    'order_item_id',
    'product_admin_name',
    'product_admin_sku',
    'product_name',
    'product_options',
    'product_sku',
    'qty_approved',
    'qty_authorized',
    'qty_requested',
    'qty_returned',
    'reason',
    'reason_other',
    'resolution',
    'rma_entity_id'
);

SET GLOBAL FOREIGN_KEY_CHECKS=1;
