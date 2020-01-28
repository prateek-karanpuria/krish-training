SET GLOBAL FOREIGN_KEY_CHECKS=0;

ALTER TABLE quote ADD ship_to_school SMALLINT(6) NULL DEFAULT '0' COMMENT 'Ship To School' AFTER is_persistent;
ALTER TABLE quote ADD checkout_is_tax_credit TINYINT(1) NULL DEFAULT '0' COMMENT 'Checkout Is Tax Credit' AFTER ship_to_school;
ALTER TABLE quote ADD checkout_gst_number TEXT NULL DEFAULT NULL COMMENT 'Checkout Gst Number' AFTER checkout_is_tax_credit;

INSERT INTO m231_studentkare.quote
(
m231_studentkare.quote.entity_id,
m231_studentkare.quote.store_id,
m231_studentkare.quote.created_at,
m231_studentkare.quote.updated_at,
m231_studentkare.quote.converted_at,
m231_studentkare.quote.is_active,
m231_studentkare.quote.is_virtual,
m231_studentkare.quote.is_multi_shipping,
m231_studentkare.quote.items_count,
m231_studentkare.quote.items_qty,
m231_studentkare.quote.orig_order_id,
m231_studentkare.quote.store_to_base_rate,
m231_studentkare.quote.store_to_quote_rate,
m231_studentkare.quote.base_currency_code,
m231_studentkare.quote.store_currency_code,
m231_studentkare.quote.quote_currency_code,
m231_studentkare.quote.grand_total,
m231_studentkare.quote.base_grand_total,
m231_studentkare.quote.checkout_method,
m231_studentkare.quote.customer_id,
m231_studentkare.quote.customer_tax_class_id,
m231_studentkare.quote.customer_group_id,
m231_studentkare.quote.customer_email,
m231_studentkare.quote.customer_prefix,
m231_studentkare.quote.customer_firstname,
m231_studentkare.quote.customer_middlename,
m231_studentkare.quote.customer_lastname,
m231_studentkare.quote.customer_suffix,
m231_studentkare.quote.customer_dob,
m231_studentkare.quote.customer_note,
m231_studentkare.quote.customer_note_notify,
m231_studentkare.quote.customer_is_guest,
m231_studentkare.quote.remote_ip,
m231_studentkare.quote.applied_rule_ids,
m231_studentkare.quote.reserved_order_id,
m231_studentkare.quote.password_hash,
m231_studentkare.quote.coupon_code,
m231_studentkare.quote.global_currency_code,
m231_studentkare.quote.base_to_global_rate,
m231_studentkare.quote.base_to_quote_rate,
m231_studentkare.quote.customer_taxvat,
m231_studentkare.quote.customer_gender,
m231_studentkare.quote.subtotal,
m231_studentkare.quote.base_subtotal,
m231_studentkare.quote.subtotal_with_discount,
m231_studentkare.quote.base_subtotal_with_discount,
m231_studentkare.quote.is_changed,
m231_studentkare.quote.trigger_recollect,
m231_studentkare.quote.ext_shipping_info,
m231_studentkare.quote.gift_message_id,
m231_studentkare.quote.is_persistent,
m231_studentkare.quote.ship_to_school,
m231_studentkare.quote.checkout_is_tax_credit,
m231_studentkare.quote.checkout_gst_number
)
SELECT
m231_studentkare_live_22112019.quote.entity_id,
m231_studentkare_live_22112019.quote.store_id,
m231_studentkare_live_22112019.quote.created_at,
m231_studentkare_live_22112019.quote.updated_at,
m231_studentkare_live_22112019.quote.converted_at,
m231_studentkare_live_22112019.quote.is_active,
m231_studentkare_live_22112019.quote.is_virtual,
m231_studentkare_live_22112019.quote.is_multi_shipping,
m231_studentkare_live_22112019.quote.items_count,
m231_studentkare_live_22112019.quote.items_qty,
m231_studentkare_live_22112019.quote.orig_order_id,
m231_studentkare_live_22112019.quote.store_to_base_rate,
m231_studentkare_live_22112019.quote.store_to_quote_rate,
m231_studentkare_live_22112019.quote.base_currency_code,
m231_studentkare_live_22112019.quote.store_currency_code,
m231_studentkare_live_22112019.quote.quote_currency_code,
m231_studentkare_live_22112019.quote.grand_total,
m231_studentkare_live_22112019.quote.base_grand_total,
m231_studentkare_live_22112019.quote.checkout_method,
m231_studentkare_live_22112019.quote.customer_id,
m231_studentkare_live_22112019.quote.customer_tax_class_id,
m231_studentkare_live_22112019.quote.customer_group_id,
m231_studentkare_live_22112019.quote.customer_email,
m231_studentkare_live_22112019.quote.customer_prefix,
m231_studentkare_live_22112019.quote.customer_firstname,
m231_studentkare_live_22112019.quote.customer_middlename,
m231_studentkare_live_22112019.quote.customer_lastname,
m231_studentkare_live_22112019.quote.customer_suffix,
m231_studentkare_live_22112019.quote.customer_dob,
m231_studentkare_live_22112019.quote.customer_note,
m231_studentkare_live_22112019.quote.customer_note_notify,
m231_studentkare_live_22112019.quote.customer_is_guest,
m231_studentkare_live_22112019.quote.remote_ip,
m231_studentkare_live_22112019.quote.applied_rule_ids,
m231_studentkare_live_22112019.quote.reserved_order_id,
m231_studentkare_live_22112019.quote.password_hash,
m231_studentkare_live_22112019.quote.coupon_code,
m231_studentkare_live_22112019.quote.global_currency_code,
m231_studentkare_live_22112019.quote.base_to_global_rate,
m231_studentkare_live_22112019.quote.base_to_quote_rate,
m231_studentkare_live_22112019.quote.customer_taxvat,
m231_studentkare_live_22112019.quote.customer_gender,
m231_studentkare_live_22112019.quote.subtotal,
m231_studentkare_live_22112019.quote.base_subtotal,
m231_studentkare_live_22112019.quote.subtotal_with_discount,
m231_studentkare_live_22112019.quote.base_subtotal_with_discount,
m231_studentkare_live_22112019.quote.is_changed,
m231_studentkare_live_22112019.quote.trigger_recollect,
m231_studentkare_live_22112019.quote.ext_shipping_info,
m231_studentkare_live_22112019.quote.gift_message_id,
m231_studentkare_live_22112019.quote.is_persistent,
m231_studentkare_live_22112019.quote.ship_to_school,
m231_studentkare_live_22112019.quote.checkout_is_tax_credit,
m231_studentkare_live_22112019.quote.checkout_gst_number
FROM m231_studentkare_live_22112019.quote
ON DUPLICATE KEY UPDATE
m231_studentkare.quote.entity_id = m231_studentkare_live_22112019.quote.entity_id,
m231_studentkare.quote.store_id = m231_studentkare_live_22112019.quote.store_id,
m231_studentkare.quote.created_at = m231_studentkare_live_22112019.quote.created_at,
m231_studentkare.quote.updated_at = m231_studentkare_live_22112019.quote.updated_at,
m231_studentkare.quote.converted_at = m231_studentkare_live_22112019.quote.converted_at,
m231_studentkare.quote.is_active = m231_studentkare_live_22112019.quote.is_active,
m231_studentkare.quote.is_virtual = m231_studentkare_live_22112019.quote.is_virtual,
m231_studentkare.quote.is_multi_shipping = m231_studentkare_live_22112019.quote.is_multi_shipping,
m231_studentkare.quote.items_count = m231_studentkare_live_22112019.quote.items_count,
m231_studentkare.quote.items_qty = m231_studentkare_live_22112019.quote.items_qty,
m231_studentkare.quote.orig_order_id = m231_studentkare_live_22112019.quote.orig_order_id,
m231_studentkare.quote.store_to_base_rate = m231_studentkare_live_22112019.quote.store_to_base_rate,
m231_studentkare.quote.store_to_quote_rate = m231_studentkare_live_22112019.quote.store_to_quote_rate,
m231_studentkare.quote.base_currency_code = m231_studentkare_live_22112019.quote.base_currency_code,
m231_studentkare.quote.store_currency_code = m231_studentkare_live_22112019.quote.store_currency_code,
m231_studentkare.quote.quote_currency_code = m231_studentkare_live_22112019.quote.quote_currency_code,
m231_studentkare.quote.grand_total = m231_studentkare_live_22112019.quote.grand_total,
m231_studentkare.quote.base_grand_total = m231_studentkare_live_22112019.quote.base_grand_total,
m231_studentkare.quote.checkout_method = m231_studentkare_live_22112019.quote.checkout_method,
m231_studentkare.quote.customer_id = m231_studentkare_live_22112019.quote.customer_id,
m231_studentkare.quote.customer_tax_class_id = m231_studentkare_live_22112019.quote.customer_tax_class_id,
m231_studentkare.quote.customer_group_id = m231_studentkare_live_22112019.quote.customer_group_id,
m231_studentkare.quote.customer_email = m231_studentkare_live_22112019.quote.customer_email,
m231_studentkare.quote.customer_prefix = m231_studentkare_live_22112019.quote.customer_prefix,
m231_studentkare.quote.customer_firstname = m231_studentkare_live_22112019.quote.customer_firstname,
m231_studentkare.quote.customer_middlename = m231_studentkare_live_22112019.quote.customer_middlename,
m231_studentkare.quote.customer_lastname = m231_studentkare_live_22112019.quote.customer_lastname,
m231_studentkare.quote.customer_suffix = m231_studentkare_live_22112019.quote.customer_suffix,
m231_studentkare.quote.customer_dob = m231_studentkare_live_22112019.quote.customer_dob,
m231_studentkare.quote.customer_note = m231_studentkare_live_22112019.quote.customer_note,
m231_studentkare.quote.customer_note_notify = m231_studentkare_live_22112019.quote.customer_note_notify,
m231_studentkare.quote.customer_is_guest = m231_studentkare_live_22112019.quote.customer_is_guest,
m231_studentkare.quote.remote_ip = m231_studentkare_live_22112019.quote.remote_ip,
m231_studentkare.quote.applied_rule_ids = m231_studentkare_live_22112019.quote.applied_rule_ids,
m231_studentkare.quote.reserved_order_id = m231_studentkare_live_22112019.quote.reserved_order_id,
m231_studentkare.quote.password_hash = m231_studentkare_live_22112019.quote.password_hash,
m231_studentkare.quote.coupon_code = m231_studentkare_live_22112019.quote.coupon_code,
m231_studentkare.quote.global_currency_code = m231_studentkare_live_22112019.quote.global_currency_code,
m231_studentkare.quote.base_to_global_rate = m231_studentkare_live_22112019.quote.base_to_global_rate,
m231_studentkare.quote.base_to_quote_rate = m231_studentkare_live_22112019.quote.base_to_quote_rate,
m231_studentkare.quote.customer_taxvat = m231_studentkare_live_22112019.quote.customer_taxvat,
m231_studentkare.quote.customer_gender = m231_studentkare_live_22112019.quote.customer_gender,
m231_studentkare.quote.subtotal = m231_studentkare_live_22112019.quote.subtotal,
m231_studentkare.quote.base_subtotal = m231_studentkare_live_22112019.quote.base_subtotal,
m231_studentkare.quote.subtotal_with_discount = m231_studentkare_live_22112019.quote.subtotal_with_discount,
m231_studentkare.quote.base_subtotal_with_discount = m231_studentkare_live_22112019.quote.base_subtotal_with_discount,
m231_studentkare.quote.is_changed = m231_studentkare_live_22112019.quote.is_changed,
m231_studentkare.quote.trigger_recollect = m231_studentkare_live_22112019.quote.trigger_recollect,
m231_studentkare.quote.ext_shipping_info = m231_studentkare_live_22112019.quote.ext_shipping_info,
m231_studentkare.quote.gift_message_id = m231_studentkare_live_22112019.quote.gift_message_id,
m231_studentkare.quote.is_persistent = m231_studentkare_live_22112019.quote.is_persistent,
m231_studentkare.quote.ship_to_school = m231_studentkare_live_22112019.quote.ship_to_school,
m231_studentkare.quote.checkout_is_tax_credit = m231_studentkare_live_22112019.quote.checkout_is_tax_credit,
m231_studentkare.quote.checkout_gst_number = m231_studentkare_live_22112019.quote.checkout_gst_number;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
