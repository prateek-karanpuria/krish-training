1. Load Stores sql first, then theme, then attribute, then categories, then stocks, then products and then other tables
2. Add design folder in app directory & remove Magento_PageBuilder folder from studentKare directory.
3. Also execute, if have issue in opening admin, execute following queries:

UPDATE store SET store_id = 0 WHERE code='admin';
UPDATE store_group SET group_id = 0 WHERE name='Default';
UPDATE store_website SET website_id = 0 WHERE code='admin';
UPDATE customer_group SET customer_group_id = 0 WHERE customer_group_code='NOT LOGGED IN';

<!-- Remove inventory modules & do setup upgrade to resolve linked stock not found error.

php bin/magento module:disable -f Magento_Inventory Magento_InventoryAdminUi Magento_InventoryApi Magento_InventoryBundleProduct Magento_InventoryBundleProductAdminUi Magento_InventoryCatalog Magento_InventorySales Magento_InventoryCatalogAdminUi Magento_InventoryCatalogApi Magento_InventoryCatalogSearch Magento_InventoryConfigurableProduct Magento_InventoryConfigurableProductAdminUi Magento_InventoryConfigurableProductIndexer Magento_InventoryConfiguration Magento_InventoryConfigurationApi Magento_InventoryGroupedProduct Magento_InventoryGroupedProductAdminUi Magento_InventoryGroupedProductIndexer Magento_InventoryImportExport Magento_InventoryIndexer Magento_InventoryLowQuantityNotification Magento_InventoryLowQuantityNotificationAdminUi Magento_InventoryLowQuantityNotificationApi Magento_InventoryMultiDimensionalIndexerApi Magento_InventoryProductAlert Magento_InventoryReservations Magento_InventoryReservationsApi Magento_InventoryCache Magento_InventorySalesAdminUi Magento_InventorySalesApi Magento_InventorySalesFrontendUi Magento_InventoryShipping Magento_InventorySourceDeductionApi Magento_InventorySourceSelection Magento_InventorySourceSelectionApi Magento_InventoryShippingAdminUi Magento_InventoryDistanceBasedSourceSelectionAdminUi Magento_InventoryDistanceBasedSourceSelectionApi Magento_InventoryElasticsearch Magento_InventoryExportStockApi Magento_InventoryReservationCli Magento_InventoryExportStock Magento_CatalogInventoryGraphQl Magento_InventorySetupFixtureGenerator

These module might not exist in CE 2.3.1: Magento_InventoryExportStockApi', 'Magento_InventoryReservationCli', 'Magento_InventoryExportStock

php bin/magento setup:upgrade

=================================

Go to Stores -> Inventory -> Stocks (admin/inventory/stock/edit/stock_id/1/) and enable it for all websites, then hit save.

(See also https://community.magento.com/t5/Magento-2-x-Version-Upgrades/Magento-update-to-2-3-compilation-errors/td-p/114524) -->

