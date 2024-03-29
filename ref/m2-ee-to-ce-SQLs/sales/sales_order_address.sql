SET GLOBAL FOREIGN_KEY_CHECKS=0;

INSERT INTO m231_studentkare.sales_order_address
(
m231_studentkare.sales_order_address.entity_id,
m231_studentkare.sales_order_address.parent_id,
m231_studentkare.sales_order_address.customer_address_id,
m231_studentkare.sales_order_address.quote_address_id,
m231_studentkare.sales_order_address.region_id,
m231_studentkare.sales_order_address.customer_id,
m231_studentkare.sales_order_address.fax,
m231_studentkare.sales_order_address.region,
m231_studentkare.sales_order_address.postcode,
m231_studentkare.sales_order_address.lastname,
m231_studentkare.sales_order_address.street,
m231_studentkare.sales_order_address.city,
m231_studentkare.sales_order_address.email,
m231_studentkare.sales_order_address.telephone,
m231_studentkare.sales_order_address.country_id,
m231_studentkare.sales_order_address.firstname,
m231_studentkare.sales_order_address.address_type,
m231_studentkare.sales_order_address.prefix,
m231_studentkare.sales_order_address.middlename,
m231_studentkare.sales_order_address.suffix,
m231_studentkare.sales_order_address.company,
m231_studentkare.sales_order_address.vat_id,
m231_studentkare.sales_order_address.vat_is_valid,
m231_studentkare.sales_order_address.vat_request_id,
m231_studentkare.sales_order_address.vat_request_date,
m231_studentkare.sales_order_address.vat_request_success
)
SELECT
m231_studentkare_live_22112019.sales_order_address.entity_id,
m231_studentkare_live_22112019.sales_order_address.parent_id,
m231_studentkare_live_22112019.sales_order_address.customer_address_id,
m231_studentkare_live_22112019.sales_order_address.quote_address_id,
m231_studentkare_live_22112019.sales_order_address.region_id,
m231_studentkare_live_22112019.sales_order_address.customer_id,
m231_studentkare_live_22112019.sales_order_address.fax,
m231_studentkare_live_22112019.sales_order_address.region,
m231_studentkare_live_22112019.sales_order_address.postcode,
m231_studentkare_live_22112019.sales_order_address.lastname,
m231_studentkare_live_22112019.sales_order_address.street,
m231_studentkare_live_22112019.sales_order_address.city,
m231_studentkare_live_22112019.sales_order_address.email,
m231_studentkare_live_22112019.sales_order_address.telephone,
m231_studentkare_live_22112019.sales_order_address.country_id,
m231_studentkare_live_22112019.sales_order_address.firstname,
m231_studentkare_live_22112019.sales_order_address.address_type,
m231_studentkare_live_22112019.sales_order_address.prefix,
m231_studentkare_live_22112019.sales_order_address.middlename,
m231_studentkare_live_22112019.sales_order_address.suffix,
m231_studentkare_live_22112019.sales_order_address.company,
m231_studentkare_live_22112019.sales_order_address.vat_id,
m231_studentkare_live_22112019.sales_order_address.vat_is_valid,
m231_studentkare_live_22112019.sales_order_address.vat_request_id,
m231_studentkare_live_22112019.sales_order_address.vat_request_date,
m231_studentkare_live_22112019.sales_order_address.vat_request_success
FROM m231_studentkare_live_22112019.sales_order_address
ON DUPLICATE KEY UPDATE
m231_studentkare.sales_order_address.entity_id = m231_studentkare_live_22112019.sales_order_address.entity_id,
m231_studentkare.sales_order_address.parent_id = m231_studentkare_live_22112019.sales_order_address.parent_id,
m231_studentkare.sales_order_address.customer_address_id = m231_studentkare_live_22112019.sales_order_address.customer_address_id,
m231_studentkare.sales_order_address.quote_address_id = m231_studentkare_live_22112019.sales_order_address.quote_address_id,
m231_studentkare.sales_order_address.region_id = m231_studentkare_live_22112019.sales_order_address.region_id,
m231_studentkare.sales_order_address.customer_id = m231_studentkare_live_22112019.sales_order_address.customer_id,
m231_studentkare.sales_order_address.fax = m231_studentkare_live_22112019.sales_order_address.fax,
m231_studentkare.sales_order_address.region = m231_studentkare_live_22112019.sales_order_address.region,
m231_studentkare.sales_order_address.postcode = m231_studentkare_live_22112019.sales_order_address.postcode,
m231_studentkare.sales_order_address.lastname = m231_studentkare_live_22112019.sales_order_address.lastname,
m231_studentkare.sales_order_address.street = m231_studentkare_live_22112019.sales_order_address.street,
m231_studentkare.sales_order_address.city = m231_studentkare_live_22112019.sales_order_address.city,
m231_studentkare.sales_order_address.email = m231_studentkare_live_22112019.sales_order_address.email,
m231_studentkare.sales_order_address.telephone = m231_studentkare_live_22112019.sales_order_address.telephone,
m231_studentkare.sales_order_address.country_id = m231_studentkare_live_22112019.sales_order_address.country_id,
m231_studentkare.sales_order_address.firstname = m231_studentkare_live_22112019.sales_order_address.firstname,
m231_studentkare.sales_order_address.address_type = m231_studentkare_live_22112019.sales_order_address.address_type,
m231_studentkare.sales_order_address.prefix = m231_studentkare_live_22112019.sales_order_address.prefix,
m231_studentkare.sales_order_address.middlename = m231_studentkare_live_22112019.sales_order_address.middlename,
m231_studentkare.sales_order_address.suffix = m231_studentkare_live_22112019.sales_order_address.suffix,
m231_studentkare.sales_order_address.company = m231_studentkare_live_22112019.sales_order_address.company,
m231_studentkare.sales_order_address.vat_id = m231_studentkare_live_22112019.sales_order_address.vat_id,
m231_studentkare.sales_order_address.vat_is_valid = m231_studentkare_live_22112019.sales_order_address.vat_is_valid,
m231_studentkare.sales_order_address.vat_request_id = m231_studentkare_live_22112019.sales_order_address.vat_request_id,
m231_studentkare.sales_order_address.vat_request_date = m231_studentkare_live_22112019.sales_order_address.vat_request_date,
m231_studentkare.sales_order_address.vat_request_success = m231_studentkare_live_22112019.sales_order_address.vat_request_success;

SET GLOBAL FOREIGN_KEY_CHECKS=1;
