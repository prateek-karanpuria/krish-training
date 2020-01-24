SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_order
(
m231_studentkare.sales_order.entity_id,
m231_studentkare.sales_order.state,
m231_studentkare.sales_order.status,
m231_studentkare.sales_order.coupon_code,
m231_studentkare.sales_order.protect_code,
m231_studentkare.sales_order.shipping_description,
m231_studentkare.sales_order.is_virtual,
m231_studentkare.sales_order.store_id,
m231_studentkare.sales_order.customer_id,
m231_studentkare.sales_order.base_discount_amount,
m231_studentkare.sales_order.base_discount_canceled,
m231_studentkare.sales_order.base_discount_invoiced,
m231_studentkare.sales_order.base_discount_refunded,
m231_studentkare.sales_order.base_grand_total,
m231_studentkare.sales_order.base_shipping_amount,
m231_studentkare.sales_order.base_shipping_canceled,
m231_studentkare.sales_order.base_shipping_invoiced,
m231_studentkare.sales_order.base_shipping_refunded,
m231_studentkare.sales_order.base_shipping_tax_amount,
m231_studentkare.sales_order.base_shipping_tax_refunded,
m231_studentkare.sales_order.base_subtotal,
m231_studentkare.sales_order.base_subtotal_canceled,
m231_studentkare.sales_order.base_subtotal_invoiced,
m231_studentkare.sales_order.base_subtotal_refunded,
m231_studentkare.sales_order.base_tax_amount,
m231_studentkare.sales_order.base_tax_canceled,
m231_studentkare.sales_order.base_tax_invoiced,
m231_studentkare.sales_order.base_tax_refunded,
m231_studentkare.sales_order.base_to_global_rate,
m231_studentkare.sales_order.base_to_order_rate,
m231_studentkare.sales_order.base_total_canceled,
m231_studentkare.sales_order.base_total_invoiced,
m231_studentkare.sales_order.base_total_invoiced_cost,
m231_studentkare.sales_order.base_total_offline_refunded,
m231_studentkare.sales_order.base_total_online_refunded,
m231_studentkare.sales_order.base_total_paid,
m231_studentkare.sales_order.base_total_qty_ordered,
m231_studentkare.sales_order.base_total_refunded,
m231_studentkare.sales_order.discount_amount,
m231_studentkare.sales_order.discount_canceled,
m231_studentkare.sales_order.discount_invoiced,
m231_studentkare.sales_order.discount_refunded,
m231_studentkare.sales_order.grand_total,
m231_studentkare.sales_order.shipping_amount,
m231_studentkare.sales_order.shipping_canceled,
m231_studentkare.sales_order.shipping_invoiced,
m231_studentkare.sales_order.shipping_refunded,
m231_studentkare.sales_order.shipping_tax_amount,
m231_studentkare.sales_order.shipping_tax_refunded,
m231_studentkare.sales_order.store_to_base_rate,
m231_studentkare.sales_order.store_to_order_rate,
m231_studentkare.sales_order.subtotal,
m231_studentkare.sales_order.subtotal_canceled,
m231_studentkare.sales_order.subtotal_invoiced,
m231_studentkare.sales_order.subtotal_refunded,
m231_studentkare.sales_order.tax_amount,
m231_studentkare.sales_order.tax_canceled,
m231_studentkare.sales_order.tax_invoiced,
m231_studentkare.sales_order.tax_refunded,
m231_studentkare.sales_order.total_canceled,
m231_studentkare.sales_order.total_invoiced,
m231_studentkare.sales_order.total_offline_refunded,
m231_studentkare.sales_order.total_online_refunded,
m231_studentkare.sales_order.total_paid,
m231_studentkare.sales_order.total_qty_ordered,
m231_studentkare.sales_order.total_refunded,
m231_studentkare.sales_order.can_ship_partially,
m231_studentkare.sales_order.can_ship_partially_item,
m231_studentkare.sales_order.customer_is_guest,
m231_studentkare.sales_order.customer_note_notify,
m231_studentkare.sales_order.billing_address_id,
m231_studentkare.sales_order.customer_group_id,
m231_studentkare.sales_order.edit_increment,
m231_studentkare.sales_order.email_sent,
m231_studentkare.sales_order.send_email,
m231_studentkare.sales_order.forced_shipment_with_invoice,
m231_studentkare.sales_order.payment_auth_expiration,
m231_studentkare.sales_order.quote_address_id,
m231_studentkare.sales_order.quote_id,
m231_studentkare.sales_order.shipping_address_id,
m231_studentkare.sales_order.adjustment_negative,
m231_studentkare.sales_order.adjustment_positive,
m231_studentkare.sales_order.base_adjustment_negative,
m231_studentkare.sales_order.base_adjustment_positive,
m231_studentkare.sales_order.base_shipping_discount_amount,
m231_studentkare.sales_order.base_subtotal_incl_tax,
m231_studentkare.sales_order.base_total_due,
m231_studentkare.sales_order.payment_authorization_amount,
m231_studentkare.sales_order.shipping_discount_amount,
m231_studentkare.sales_order.subtotal_incl_tax,
m231_studentkare.sales_order.total_due,
m231_studentkare.sales_order.weight,
m231_studentkare.sales_order.customer_dob,
m231_studentkare.sales_order.increment_id,
m231_studentkare.sales_order.applied_rule_ids,
m231_studentkare.sales_order.base_currency_code,
m231_studentkare.sales_order.customer_email,
m231_studentkare.sales_order.customer_firstname,
m231_studentkare.sales_order.customer_lastname,
m231_studentkare.sales_order.customer_middlename,
m231_studentkare.sales_order.customer_prefix,
m231_studentkare.sales_order.customer_suffix,
m231_studentkare.sales_order.customer_taxvat,
m231_studentkare.sales_order.discount_description,
m231_studentkare.sales_order.ext_customer_id,
m231_studentkare.sales_order.ext_order_id,
m231_studentkare.sales_order.global_currency_code,
m231_studentkare.sales_order.hold_before_state,
m231_studentkare.sales_order.hold_before_status,
m231_studentkare.sales_order.order_currency_code,
m231_studentkare.sales_order.original_increment_id,
m231_studentkare.sales_order.relation_child_id,
m231_studentkare.sales_order.relation_child_real_id,
m231_studentkare.sales_order.relation_parent_id,
m231_studentkare.sales_order.relation_parent_real_id,
m231_studentkare.sales_order.remote_ip,
m231_studentkare.sales_order.shipping_method,
m231_studentkare.sales_order.store_currency_code,
m231_studentkare.sales_order.store_name,
m231_studentkare.sales_order.x_forwarded_for,
m231_studentkare.sales_order.customer_note,
m231_studentkare.sales_order.created_at,
m231_studentkare.sales_order.updated_at,
m231_studentkare.sales_order.total_item_count,
m231_studentkare.sales_order.customer_gender,
m231_studentkare.sales_order.discount_tax_compensation_amount,
m231_studentkare.sales_order.base_discount_tax_compensation_amount,
m231_studentkare.sales_order.shipping_discount_tax_compensation_amount,
m231_studentkare.sales_order.base_shipping_discount_tax_compensation_amnt,
m231_studentkare.sales_order.discount_tax_compensation_invoiced,
m231_studentkare.sales_order.base_discount_tax_compensation_invoiced,
m231_studentkare.sales_order.discount_tax_compensation_refunded,
m231_studentkare.sales_order.base_discount_tax_compensation_refunded,
m231_studentkare.sales_order.shipping_incl_tax,
m231_studentkare.sales_order.base_shipping_incl_tax,
m231_studentkare.sales_order.coupon_rule_name,
m231_studentkare.sales_order.paypal_ipn_customer_notified,
m231_studentkare.sales_order.gift_message_id,
m231_studentkare.sales_order.sap_invoice,
m231_studentkare.sales_order.ship_to_school,
m231_studentkare.sales_order.checkout_is_tax_credit,
m231_studentkare.sales_order.checkout_gst_number
)
SELECT
m231_studentkare_live_22112019.sales_order.entity_id,
m231_studentkare_live_22112019.sales_order.state,
m231_studentkare_live_22112019.sales_order.status,
m231_studentkare_live_22112019.sales_order.coupon_code,
m231_studentkare_live_22112019.sales_order.protect_code,
m231_studentkare_live_22112019.sales_order.shipping_description,
m231_studentkare_live_22112019.sales_order.is_virtual,
m231_studentkare_live_22112019.sales_order.store_id,
m231_studentkare_live_22112019.sales_order.customer_id,
m231_studentkare_live_22112019.sales_order.base_discount_amount,
m231_studentkare_live_22112019.sales_order.base_discount_canceled,
m231_studentkare_live_22112019.sales_order.base_discount_invoiced,
m231_studentkare_live_22112019.sales_order.base_discount_refunded,
m231_studentkare_live_22112019.sales_order.base_grand_total,
m231_studentkare_live_22112019.sales_order.base_shipping_amount,
m231_studentkare_live_22112019.sales_order.base_shipping_canceled,
m231_studentkare_live_22112019.sales_order.base_shipping_invoiced,
m231_studentkare_live_22112019.sales_order.base_shipping_refunded,
m231_studentkare_live_22112019.sales_order.base_shipping_tax_amount,
m231_studentkare_live_22112019.sales_order.base_shipping_tax_refunded,
m231_studentkare_live_22112019.sales_order.base_subtotal,
m231_studentkare_live_22112019.sales_order.base_subtotal_canceled,
m231_studentkare_live_22112019.sales_order.base_subtotal_invoiced,
m231_studentkare_live_22112019.sales_order.base_subtotal_refunded,
m231_studentkare_live_22112019.sales_order.base_tax_amount,
m231_studentkare_live_22112019.sales_order.base_tax_canceled,
m231_studentkare_live_22112019.sales_order.base_tax_invoiced,
m231_studentkare_live_22112019.sales_order.base_tax_refunded,
m231_studentkare_live_22112019.sales_order.base_to_global_rate,
m231_studentkare_live_22112019.sales_order.base_to_order_rate,
m231_studentkare_live_22112019.sales_order.base_total_canceled,
m231_studentkare_live_22112019.sales_order.base_total_invoiced,
m231_studentkare_live_22112019.sales_order.base_total_invoiced_cost,
m231_studentkare_live_22112019.sales_order.base_total_offline_refunded,
m231_studentkare_live_22112019.sales_order.base_total_online_refunded,
m231_studentkare_live_22112019.sales_order.base_total_paid,
m231_studentkare_live_22112019.sales_order.base_total_qty_ordered,
m231_studentkare_live_22112019.sales_order.base_total_refunded,
m231_studentkare_live_22112019.sales_order.discount_amount,
m231_studentkare_live_22112019.sales_order.discount_canceled,
m231_studentkare_live_22112019.sales_order.discount_invoiced,
m231_studentkare_live_22112019.sales_order.discount_refunded,
m231_studentkare_live_22112019.sales_order.grand_total,
m231_studentkare_live_22112019.sales_order.shipping_amount,
m231_studentkare_live_22112019.sales_order.shipping_canceled,
m231_studentkare_live_22112019.sales_order.shipping_invoiced,
m231_studentkare_live_22112019.sales_order.shipping_refunded,
m231_studentkare_live_22112019.sales_order.shipping_tax_amount,
m231_studentkare_live_22112019.sales_order.shipping_tax_refunded,
m231_studentkare_live_22112019.sales_order.store_to_base_rate,
m231_studentkare_live_22112019.sales_order.store_to_order_rate,
m231_studentkare_live_22112019.sales_order.subtotal,
m231_studentkare_live_22112019.sales_order.subtotal_canceled,
m231_studentkare_live_22112019.sales_order.subtotal_invoiced,
m231_studentkare_live_22112019.sales_order.subtotal_refunded,
m231_studentkare_live_22112019.sales_order.tax_amount,
m231_studentkare_live_22112019.sales_order.tax_canceled,
m231_studentkare_live_22112019.sales_order.tax_invoiced,
m231_studentkare_live_22112019.sales_order.tax_refunded,
m231_studentkare_live_22112019.sales_order.total_canceled,
m231_studentkare_live_22112019.sales_order.total_invoiced,
m231_studentkare_live_22112019.sales_order.total_offline_refunded,
m231_studentkare_live_22112019.sales_order.total_online_refunded,
m231_studentkare_live_22112019.sales_order.total_paid,
m231_studentkare_live_22112019.sales_order.total_qty_ordered,
m231_studentkare_live_22112019.sales_order.total_refunded,
m231_studentkare_live_22112019.sales_order.can_ship_partially,
m231_studentkare_live_22112019.sales_order.can_ship_partially_item,
m231_studentkare_live_22112019.sales_order.customer_is_guest,
m231_studentkare_live_22112019.sales_order.customer_note_notify,
m231_studentkare_live_22112019.sales_order.billing_address_id,
m231_studentkare_live_22112019.sales_order.customer_group_id,
m231_studentkare_live_22112019.sales_order.edit_increment,
m231_studentkare_live_22112019.sales_order.email_sent,
m231_studentkare_live_22112019.sales_order.send_email,
m231_studentkare_live_22112019.sales_order.forced_shipment_with_invoice,
m231_studentkare_live_22112019.sales_order.payment_auth_expiration,
m231_studentkare_live_22112019.sales_order.quote_address_id,
m231_studentkare_live_22112019.sales_order.quote_id,
m231_studentkare_live_22112019.sales_order.shipping_address_id,
m231_studentkare_live_22112019.sales_order.adjustment_negative,
m231_studentkare_live_22112019.sales_order.adjustment_positive,
m231_studentkare_live_22112019.sales_order.base_adjustment_negative,
m231_studentkare_live_22112019.sales_order.base_adjustment_positive,
m231_studentkare_live_22112019.sales_order.base_shipping_discount_amount,
m231_studentkare_live_22112019.sales_order.base_subtotal_incl_tax,
m231_studentkare_live_22112019.sales_order.base_total_due,
m231_studentkare_live_22112019.sales_order.payment_authorization_amount,
m231_studentkare_live_22112019.sales_order.shipping_discount_amount,
m231_studentkare_live_22112019.sales_order.subtotal_incl_tax,
m231_studentkare_live_22112019.sales_order.total_due,
m231_studentkare_live_22112019.sales_order.weight,
m231_studentkare_live_22112019.sales_order.customer_dob,
m231_studentkare_live_22112019.sales_order.increment_id,
m231_studentkare_live_22112019.sales_order.applied_rule_ids,
m231_studentkare_live_22112019.sales_order.base_currency_code,
m231_studentkare_live_22112019.sales_order.customer_email,
m231_studentkare_live_22112019.sales_order.customer_firstname,
m231_studentkare_live_22112019.sales_order.customer_lastname,
m231_studentkare_live_22112019.sales_order.customer_middlename,
m231_studentkare_live_22112019.sales_order.customer_prefix,
m231_studentkare_live_22112019.sales_order.customer_suffix,
m231_studentkare_live_22112019.sales_order.customer_taxvat,
m231_studentkare_live_22112019.sales_order.discount_description,
m231_studentkare_live_22112019.sales_order.ext_customer_id,
m231_studentkare_live_22112019.sales_order.ext_order_id,
m231_studentkare_live_22112019.sales_order.global_currency_code,
m231_studentkare_live_22112019.sales_order.hold_before_state,
m231_studentkare_live_22112019.sales_order.hold_before_status,
m231_studentkare_live_22112019.sales_order.order_currency_code,
m231_studentkare_live_22112019.sales_order.original_increment_id,
m231_studentkare_live_22112019.sales_order.relation_child_id,
m231_studentkare_live_22112019.sales_order.relation_child_real_id,
m231_studentkare_live_22112019.sales_order.relation_parent_id,
m231_studentkare_live_22112019.sales_order.relation_parent_real_id,
m231_studentkare_live_22112019.sales_order.remote_ip,
m231_studentkare_live_22112019.sales_order.shipping_method,
m231_studentkare_live_22112019.sales_order.store_currency_code,
m231_studentkare_live_22112019.sales_order.store_name,
m231_studentkare_live_22112019.sales_order.x_forwarded_for,
m231_studentkare_live_22112019.sales_order.customer_note,
m231_studentkare_live_22112019.sales_order.created_at,
m231_studentkare_live_22112019.sales_order.updated_at,
m231_studentkare_live_22112019.sales_order.total_item_count,
m231_studentkare_live_22112019.sales_order.customer_gender,
m231_studentkare_live_22112019.sales_order.discount_tax_compensation_amount,
m231_studentkare_live_22112019.sales_order.base_discount_tax_compensation_amount,
m231_studentkare_live_22112019.sales_order.shipping_discount_tax_compensation_amount,
m231_studentkare_live_22112019.sales_order.base_shipping_discount_tax_compensation_amnt,
m231_studentkare_live_22112019.sales_order.discount_tax_compensation_invoiced,
m231_studentkare_live_22112019.sales_order.base_discount_tax_compensation_invoiced,
m231_studentkare_live_22112019.sales_order.discount_tax_compensation_refunded,
m231_studentkare_live_22112019.sales_order.base_discount_tax_compensation_refunded,
m231_studentkare_live_22112019.sales_order.shipping_incl_tax,
m231_studentkare_live_22112019.sales_order.base_shipping_incl_tax,
m231_studentkare_live_22112019.sales_order.coupon_rule_name,
m231_studentkare_live_22112019.sales_order.paypal_ipn_customer_notified,
m231_studentkare_live_22112019.sales_order.gift_message_id,
m231_studentkare_live_22112019.sales_order.sap_invoice,
m231_studentkare_live_22112019.sales_order.ship_to_school,
m231_studentkare_live_22112019.sales_order.checkout_is_tax_credit,
m231_studentkare_live_22112019.sales_order.checkout_gst_number
FROM m231_studentkare_live_22112019.sales_order
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_order.entity_id = m231_studentkare_live_22112019.sales_order.entity_id,
m231_studentkare.sales_order.state = m231_studentkare_live_22112019.sales_order.state,
m231_studentkare.sales_order.status = m231_studentkare_live_22112019.sales_order.status,
m231_studentkare.sales_order.coupon_code = m231_studentkare_live_22112019.sales_order.coupon_code,
m231_studentkare.sales_order.protect_code = m231_studentkare_live_22112019.sales_order.protect_code,
m231_studentkare.sales_order.shipping_description = m231_studentkare_live_22112019.sales_order.shipping_description,
m231_studentkare.sales_order.is_virtual = m231_studentkare_live_22112019.sales_order.is_virtual,
m231_studentkare.sales_order.store_id = m231_studentkare_live_22112019.sales_order.store_id,
m231_studentkare.sales_order.customer_id = m231_studentkare_live_22112019.sales_order.customer_id,
m231_studentkare.sales_order.base_discount_amount = m231_studentkare_live_22112019.sales_order.base_discount_amount,
m231_studentkare.sales_order.base_discount_canceled = m231_studentkare_live_22112019.sales_order.base_discount_canceled,
m231_studentkare.sales_order.base_discount_invoiced = m231_studentkare_live_22112019.sales_order.base_discount_invoiced,
m231_studentkare.sales_order.base_discount_refunded = m231_studentkare_live_22112019.sales_order.base_discount_refunded,
m231_studentkare.sales_order.base_grand_total = m231_studentkare_live_22112019.sales_order.base_grand_total,
m231_studentkare.sales_order.base_shipping_amount = m231_studentkare_live_22112019.sales_order.base_shipping_amount,
m231_studentkare.sales_order.base_shipping_canceled = m231_studentkare_live_22112019.sales_order.base_shipping_canceled,
m231_studentkare.sales_order.base_shipping_invoiced = m231_studentkare_live_22112019.sales_order.base_shipping_invoiced,
m231_studentkare.sales_order.base_shipping_refunded = m231_studentkare_live_22112019.sales_order.base_shipping_refunded,
m231_studentkare.sales_order.base_shipping_tax_amount = m231_studentkare_live_22112019.sales_order.base_shipping_tax_amount,
m231_studentkare.sales_order.base_shipping_tax_refunded = m231_studentkare_live_22112019.sales_order.base_shipping_tax_refunded,
m231_studentkare.sales_order.base_subtotal = m231_studentkare_live_22112019.sales_order.base_subtotal,
m231_studentkare.sales_order.base_subtotal_canceled = m231_studentkare_live_22112019.sales_order.base_subtotal_canceled,
m231_studentkare.sales_order.base_subtotal_invoiced = m231_studentkare_live_22112019.sales_order.base_subtotal_invoiced,
m231_studentkare.sales_order.base_subtotal_refunded = m231_studentkare_live_22112019.sales_order.base_subtotal_refunded,
m231_studentkare.sales_order.base_tax_amount = m231_studentkare_live_22112019.sales_order.base_tax_amount,
m231_studentkare.sales_order.base_tax_canceled = m231_studentkare_live_22112019.sales_order.base_tax_canceled,
m231_studentkare.sales_order.base_tax_invoiced = m231_studentkare_live_22112019.sales_order.base_tax_invoiced,
m231_studentkare.sales_order.base_tax_refunded = m231_studentkare_live_22112019.sales_order.base_tax_refunded,
m231_studentkare.sales_order.base_to_global_rate = m231_studentkare_live_22112019.sales_order.base_to_global_rate,
m231_studentkare.sales_order.base_to_order_rate = m231_studentkare_live_22112019.sales_order.base_to_order_rate,
m231_studentkare.sales_order.base_total_canceled = m231_studentkare_live_22112019.sales_order.base_total_canceled,
m231_studentkare.sales_order.base_total_invoiced = m231_studentkare_live_22112019.sales_order.base_total_invoiced,
m231_studentkare.sales_order.base_total_invoiced_cost = m231_studentkare_live_22112019.sales_order.base_total_invoiced_cost,
m231_studentkare.sales_order.base_total_offline_refunded = m231_studentkare_live_22112019.sales_order.base_total_offline_refunded,
m231_studentkare.sales_order.base_total_online_refunded = m231_studentkare_live_22112019.sales_order.base_total_online_refunded,
m231_studentkare.sales_order.base_total_paid = m231_studentkare_live_22112019.sales_order.base_total_paid,
m231_studentkare.sales_order.base_total_qty_ordered = m231_studentkare_live_22112019.sales_order.base_total_qty_ordered,
m231_studentkare.sales_order.base_total_refunded = m231_studentkare_live_22112019.sales_order.base_total_refunded,
m231_studentkare.sales_order.discount_amount = m231_studentkare_live_22112019.sales_order.discount_amount,
m231_studentkare.sales_order.discount_canceled = m231_studentkare_live_22112019.sales_order.discount_canceled,
m231_studentkare.sales_order.discount_invoiced = m231_studentkare_live_22112019.sales_order.discount_invoiced,
m231_studentkare.sales_order.discount_refunded = m231_studentkare_live_22112019.sales_order.discount_refunded,
m231_studentkare.sales_order.grand_total = m231_studentkare_live_22112019.sales_order.grand_total,
m231_studentkare.sales_order.shipping_amount = m231_studentkare_live_22112019.sales_order.shipping_amount,
m231_studentkare.sales_order.shipping_canceled = m231_studentkare_live_22112019.sales_order.shipping_canceled,
m231_studentkare.sales_order.shipping_invoiced = m231_studentkare_live_22112019.sales_order.shipping_invoiced,
m231_studentkare.sales_order.shipping_refunded = m231_studentkare_live_22112019.sales_order.shipping_refunded,
m231_studentkare.sales_order.shipping_tax_amount = m231_studentkare_live_22112019.sales_order.shipping_tax_amount,
m231_studentkare.sales_order.shipping_tax_refunded = m231_studentkare_live_22112019.sales_order.shipping_tax_refunded,
m231_studentkare.sales_order.store_to_base_rate = m231_studentkare_live_22112019.sales_order.store_to_base_rate,
m231_studentkare.sales_order.store_to_order_rate = m231_studentkare_live_22112019.sales_order.store_to_order_rate,
m231_studentkare.sales_order.subtotal = m231_studentkare_live_22112019.sales_order.subtotal,
m231_studentkare.sales_order.subtotal_canceled = m231_studentkare_live_22112019.sales_order.subtotal_canceled,
m231_studentkare.sales_order.subtotal_invoiced = m231_studentkare_live_22112019.sales_order.subtotal_invoiced,
m231_studentkare.sales_order.subtotal_refunded = m231_studentkare_live_22112019.sales_order.subtotal_refunded,
m231_studentkare.sales_order.tax_amount = m231_studentkare_live_22112019.sales_order.tax_amount,
m231_studentkare.sales_order.tax_canceled = m231_studentkare_live_22112019.sales_order.tax_canceled,
m231_studentkare.sales_order.tax_invoiced = m231_studentkare_live_22112019.sales_order.tax_invoiced,
m231_studentkare.sales_order.tax_refunded = m231_studentkare_live_22112019.sales_order.tax_refunded,
m231_studentkare.sales_order.total_canceled = m231_studentkare_live_22112019.sales_order.total_canceled,
m231_studentkare.sales_order.total_invoiced = m231_studentkare_live_22112019.sales_order.total_invoiced,
m231_studentkare.sales_order.total_offline_refunded = m231_studentkare_live_22112019.sales_order.total_offline_refunded,
m231_studentkare.sales_order.total_online_refunded = m231_studentkare_live_22112019.sales_order.total_online_refunded,
m231_studentkare.sales_order.total_paid = m231_studentkare_live_22112019.sales_order.total_paid,
m231_studentkare.sales_order.total_qty_ordered = m231_studentkare_live_22112019.sales_order.total_qty_ordered,
m231_studentkare.sales_order.total_refunded = m231_studentkare_live_22112019.sales_order.total_refunded,
m231_studentkare.sales_order.can_ship_partially = m231_studentkare_live_22112019.sales_order.can_ship_partially,
m231_studentkare.sales_order.can_ship_partially_item = m231_studentkare_live_22112019.sales_order.can_ship_partially_item,
m231_studentkare.sales_order.customer_is_guest = m231_studentkare_live_22112019.sales_order.customer_is_guest,
m231_studentkare.sales_order.customer_note_notify = m231_studentkare_live_22112019.sales_order.customer_note_notify,
m231_studentkare.sales_order.billing_address_id = m231_studentkare_live_22112019.sales_order.billing_address_id,
m231_studentkare.sales_order.customer_group_id = m231_studentkare_live_22112019.sales_order.customer_group_id,
m231_studentkare.sales_order.edit_increment = m231_studentkare_live_22112019.sales_order.edit_increment,
m231_studentkare.sales_order.email_sent = m231_studentkare_live_22112019.sales_order.email_sent,
m231_studentkare.sales_order.send_email = m231_studentkare_live_22112019.sales_order.send_email,
m231_studentkare.sales_order.forced_shipment_with_invoice = m231_studentkare_live_22112019.sales_order.forced_shipment_with_invoice,
m231_studentkare.sales_order.payment_auth_expiration = m231_studentkare_live_22112019.sales_order.payment_auth_expiration,
m231_studentkare.sales_order.quote_address_id = m231_studentkare_live_22112019.sales_order.quote_address_id,
m231_studentkare.sales_order.quote_id = m231_studentkare_live_22112019.sales_order.quote_id,
m231_studentkare.sales_order.shipping_address_id = m231_studentkare_live_22112019.sales_order.shipping_address_id,
m231_studentkare.sales_order.adjustment_negative = m231_studentkare_live_22112019.sales_order.adjustment_negative,
m231_studentkare.sales_order.adjustment_positive = m231_studentkare_live_22112019.sales_order.adjustment_positive,
m231_studentkare.sales_order.base_adjustment_negative = m231_studentkare_live_22112019.sales_order.base_adjustment_negative,
m231_studentkare.sales_order.base_adjustment_positive = m231_studentkare_live_22112019.sales_order.base_adjustment_positive,
m231_studentkare.sales_order.base_shipping_discount_amount = m231_studentkare_live_22112019.sales_order.base_shipping_discount_amount,
m231_studentkare.sales_order.base_subtotal_incl_tax = m231_studentkare_live_22112019.sales_order.base_subtotal_incl_tax,
m231_studentkare.sales_order.base_total_due = m231_studentkare_live_22112019.sales_order.base_total_due,
m231_studentkare.sales_order.payment_authorization_amount = m231_studentkare_live_22112019.sales_order.payment_authorization_amount,
m231_studentkare.sales_order.shipping_discount_amount = m231_studentkare_live_22112019.sales_order.shipping_discount_amount,
m231_studentkare.sales_order.subtotal_incl_tax = m231_studentkare_live_22112019.sales_order.subtotal_incl_tax,
m231_studentkare.sales_order.total_due = m231_studentkare_live_22112019.sales_order.total_due,
m231_studentkare.sales_order.weight = m231_studentkare_live_22112019.sales_order.weight,
m231_studentkare.sales_order.customer_dob = m231_studentkare_live_22112019.sales_order.customer_dob,
m231_studentkare.sales_order.increment_id = m231_studentkare_live_22112019.sales_order.increment_id,
m231_studentkare.sales_order.applied_rule_ids = m231_studentkare_live_22112019.sales_order.applied_rule_ids,
m231_studentkare.sales_order.base_currency_code = m231_studentkare_live_22112019.sales_order.base_currency_code,
m231_studentkare.sales_order.customer_email = m231_studentkare_live_22112019.sales_order.customer_email,
m231_studentkare.sales_order.customer_firstname = m231_studentkare_live_22112019.sales_order.customer_firstname,
m231_studentkare.sales_order.customer_lastname = m231_studentkare_live_22112019.sales_order.customer_lastname,
m231_studentkare.sales_order.customer_middlename = m231_studentkare_live_22112019.sales_order.customer_middlename,
m231_studentkare.sales_order.customer_prefix = m231_studentkare_live_22112019.sales_order.customer_prefix,
m231_studentkare.sales_order.customer_suffix = m231_studentkare_live_22112019.sales_order.customer_suffix,
m231_studentkare.sales_order.customer_taxvat = m231_studentkare_live_22112019.sales_order.customer_taxvat,
m231_studentkare.sales_order.discount_description = m231_studentkare_live_22112019.sales_order.discount_description,
m231_studentkare.sales_order.ext_customer_id = m231_studentkare_live_22112019.sales_order.ext_customer_id,
m231_studentkare.sales_order.ext_order_id = m231_studentkare_live_22112019.sales_order.ext_order_id,
m231_studentkare.sales_order.global_currency_code = m231_studentkare_live_22112019.sales_order.global_currency_code,
m231_studentkare.sales_order.hold_before_state = m231_studentkare_live_22112019.sales_order.hold_before_state,
m231_studentkare.sales_order.hold_before_status = m231_studentkare_live_22112019.sales_order.hold_before_status,
m231_studentkare.sales_order.order_currency_code = m231_studentkare_live_22112019.sales_order.order_currency_code,
m231_studentkare.sales_order.original_increment_id = m231_studentkare_live_22112019.sales_order.original_increment_id,
m231_studentkare.sales_order.relation_child_id = m231_studentkare_live_22112019.sales_order.relation_child_id,
m231_studentkare.sales_order.relation_child_real_id = m231_studentkare_live_22112019.sales_order.relation_child_real_id,
m231_studentkare.sales_order.relation_parent_id = m231_studentkare_live_22112019.sales_order.relation_parent_id,
m231_studentkare.sales_order.relation_parent_real_id = m231_studentkare_live_22112019.sales_order.relation_parent_real_id,
m231_studentkare.sales_order.remote_ip = m231_studentkare_live_22112019.sales_order.remote_ip,
m231_studentkare.sales_order.shipping_method = m231_studentkare_live_22112019.sales_order.shipping_method,
m231_studentkare.sales_order.store_currency_code = m231_studentkare_live_22112019.sales_order.store_currency_code,
m231_studentkare.sales_order.store_name = m231_studentkare_live_22112019.sales_order.store_name,
m231_studentkare.sales_order.x_forwarded_for = m231_studentkare_live_22112019.sales_order.x_forwarded_for,
m231_studentkare.sales_order.customer_note = m231_studentkare_live_22112019.sales_order.customer_note,
m231_studentkare.sales_order.created_at = m231_studentkare_live_22112019.sales_order.created_at,
m231_studentkare.sales_order.updated_at = m231_studentkare_live_22112019.sales_order.updated_at,
m231_studentkare.sales_order.total_item_count = m231_studentkare_live_22112019.sales_order.total_item_count,
m231_studentkare.sales_order.customer_gender = m231_studentkare_live_22112019.sales_order.customer_gender,
m231_studentkare.sales_order.discount_tax_compensation_amount = m231_studentkare_live_22112019.sales_order.discount_tax_compensation_amount,
m231_studentkare.sales_order.base_discount_tax_compensation_amount = m231_studentkare_live_22112019.sales_order.base_discount_tax_compensation_amount,
m231_studentkare.sales_order.shipping_discount_tax_compensation_amount = m231_studentkare_live_22112019.sales_order.shipping_discount_tax_compensation_amount,
m231_studentkare.sales_order.base_shipping_discount_tax_compensation_amnt = m231_studentkare_live_22112019.sales_order.base_shipping_discount_tax_compensation_amnt,
m231_studentkare.sales_order.discount_tax_compensation_invoiced = m231_studentkare_live_22112019.sales_order.discount_tax_compensation_invoiced,
m231_studentkare.sales_order.base_discount_tax_compensation_invoiced = m231_studentkare_live_22112019.sales_order.base_discount_tax_compensation_invoiced,
m231_studentkare.sales_order.discount_tax_compensation_refunded = m231_studentkare_live_22112019.sales_order.discount_tax_compensation_refunded,
m231_studentkare.sales_order.base_discount_tax_compensation_refunded = m231_studentkare_live_22112019.sales_order.base_discount_tax_compensation_refunded,
m231_studentkare.sales_order.shipping_incl_tax = m231_studentkare_live_22112019.sales_order.shipping_incl_tax,
m231_studentkare.sales_order.base_shipping_incl_tax = m231_studentkare_live_22112019.sales_order.base_shipping_incl_tax,
m231_studentkare.sales_order.coupon_rule_name = m231_studentkare_live_22112019.sales_order.coupon_rule_name,
m231_studentkare.sales_order.paypal_ipn_customer_notified = m231_studentkare_live_22112019.sales_order.paypal_ipn_customer_notified,
m231_studentkare.sales_order.gift_message_id = m231_studentkare_live_22112019.sales_order.gift_message_id,
m231_studentkare.sales_order.sap_invoice = m231_studentkare_live_22112019.sales_order.sap_invoice,
m231_studentkare.sales_order.ship_to_school = m231_studentkare_live_22112019.sales_order.ship_to_school,
m231_studentkare.sales_order.checkout_is_tax_credit = m231_studentkare_live_22112019.sales_order.checkout_is_tax_credit,
m231_studentkare.sales_order.checkout_gst_number = m231_studentkare_live_22112019.sales_order.checkout_gst_number;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
