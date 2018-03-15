<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'B2BCustomerSelectionController@index');


Route::resource('B2BCustomer','B2BCustomerController');
Route::resource('B2BCustomerCategory','B2BCustomerCategoryController');
Route::resource('B2BCustomerProduct','B2BCustomerProductController');
Route::resource('B2BCustomerCampaign','B2BCustomerCampaignController');
Route::resource('SolutionFeature','SolutionFeatureController');
Route::resource('TagManufacturer','TagManufacturerController');
Route::resource('Level1Territory','Level1TerritoryController');
Route::resource('Level2Territory','Level2TerritoryController');
Route::resource('NFCTagBundle','NFCTagBundleController');

Route::resource('B2BCustomerSelection','B2BCustomerSelectionController');
// Ajax
Route::get('ChangeStatusToCustomer', 'B2BCustomerSelectionController@ChangeStatusToCustomer');
Route::get('DeleteCustomer', 'B2BCustomerSelectionController@DeleteCustomer');


Route::resource('CategoriesProductsStep1','CategoriesProductsStep1Controller');
// Ajax
Route::get('ChangeStatusToCategory', 'CategoriesProductsStep1Controller@ChangeStatusToCategory');
Route::get('DeleteCategory', 'CategoriesProductsStep1Controller@DeleteCategory');

Route::resource('CategoriesProductsStep2','CategoriesProductsStep2Controller');
// Ajax
Route::get('ChangeStatusToProduct', 'CategoriesProductsStep2Controller@ChangeStatusToProduct');
Route::get('DeleteProduct', 'CategoriesProductsStep2Controller@DeleteProduct');
Route::get('RemoveProductFromCategoty', 'CategoriesProductsStep2Controller@RemoveProductFromCategoty');
Route::get('AddProductInCategoty', 'CategoriesProductsStep2Controller@AddProductInCategoty');
Route::get('ViewCategoriesByProduct', 'CategoriesProductsStep2Controller@ViewCategoriesByProduct');


Route::resource('CustomersTagManufacturersStep1','CustomersTagManufacturersStep1Controller');
//Ajax
Route::get('RemoveTagManufacturerFromCustomer', 'CustomersTagManufacturersStep1Controller@RemoveTagManufacturerFromCustomer');
Route::get('AddTagManuFacturerInCustomer', 'CustomersTagManufacturersStep1Controller@AddTagManuFacturerInCustomer');
Route::get('ChangeStatusToTagManufacturer', 'CustomersTagManufacturersStep1Controller@ChangeStatusToTagManufacturer');
Route::get('DeleteTagManufacturer', 'CustomersTagManufacturersStep1Controller@DeleteTagManufacturer');

Route::resource('CustomersSolutionFeaturesStep1','CustomersSolutionFeaturesStep1Controller');
//Ajax
Route::get('RemoveSolutionFeaturesFromCustomer', 'CustomersSolutionFeaturesStep1Controller@RemoveSolutionFeaturesFromCustomer');
Route::get('AddSolutionFeaturesInCustomer', 'CustomersSolutionFeaturesStep1Controller@AddSolutionFeaturesInCustomer');
Route::get('ChangeStatusToSolutionFeatures', 'CustomersSolutionFeaturesStep1Controller@ChangeStatusToSolutionFeatures');
Route::get('DeleteSolutionFeatures', 'CustomersSolutionFeaturesStep1Controller@DeleteSolutionFeatures');


Route::resource('CampaignsProductsStep1','CampaignsProductsStep1Controller');
// Ajax
Route::get('ChangeStatusToCampaign', 'CampaignsProductsStep1Controller@ChangeStatusToCampaign');
Route::get('DeleteCampaign', 'CampaignsProductsStep1Controller@DeleteCampaign');
Route::get('ViewTagCampaignInTags', 'CampaignsProductsStep1Controller@ViewTagCampaignInTags');

Route::resource('CampaignsProductsStep2','CampaignsProductsStep2Controller');
// Ajax
Route::get('ChangeStatusToProduct', 'CampaignsProductsStep2Controller@ChangeStatusToProduct');
Route::get('RemoveProductFromCampaign', 'CampaignsProductsStep2Controller@RemoveProductFromCampaign');
Route::get('AddProductInCampaign', 'CampaignsProductsStep2Controller@AddProductInCampaign');
Route::get('ViewCampaignsByProduct', 'CampaignsProductsStep2Controller@ViewCampaignsByProduct');

Route::resource('Territory1Territory2Step1','Level1TerritoriesLevel2TerritoriesStep1Controller');
// Ajax
Route::get('ChangeStatusToLevel1Territory', 'Level1TerritoriesLevel2TerritoriesStep1Controller@ChangeStatusToLevel1Territory');
Route::get('DeleteLevel1Territory', 'Level1TerritoriesLevel2TerritoriesStep1Controller@DeleteLevel1Territory');

Route::resource('Territory1Territory2Step2','Level1TerritoriesLevel2TerritoriesStep2Controller');
// Ajax
Route::get('ChangeStatusToLevel2Territory', 'Level1TerritoriesLevel2TerritoriesStep2Controller@ChangeStatusToLevel2Territory');
Route::get('RemoveLevel2TerritoryFromLevel1Territory', 'Level1TerritoriesLevel2TerritoriesStep2Controller@RemoveLevel2TerritoryFromLevel1Territory');
Route::get('AddLevel2TerritoryInLevel1Territory', 'Level1TerritoriesLevel2TerritoriesStep2Controller@AddLevel2TerritoryInLevel1Territory');
//Route::get('ViewLevel1TerritoriesByLevel2Territory', 'Level1TerritoriesLevel2TerritoriesStep2Controller@ViewLevel1TerritoriesByLevel2Territory');
Route::get('DeleteLevel2Territory', 'Level1TerritoriesLevel2TerritoriesStep2Controller@DeleteLevel2Territory');


Route::resource('CampaignsTerritoriesStep3','CampaignsTerritoriesStep3Controller');
// Ajax
//Route::get('ChangeStatusToLevel1Territory', 'CampaignsTerritoriesStep3Controller@ChangeStatusToLevel1Territory');
//Route::get('DeleteLevel1Territory', 'CampaignsTerritoriesStep3Controller@DeleteLevel1Territory');
Route::get('RemoveLevel1TerritoryFromCampaign', 'CampaignsTerritoriesStep3Controller@RemoveLevel1TerritoryFromCampaign');
Route::get('AddLevel1TerritoryInCampaign', 'CampaignsTerritoriesStep3Controller@AddLevel1TerritoryInCampaign');
Route::get('ViewCampaignsByLevel1Territory', 'CampaignsTerritoriesStep3Controller@ViewCampaignsByLevel1Territory');
Route::get('SaveL1TerritoryTargetUrl', 'CampaignsTerritoriesStep3Controller@SaveL1TerritoryTargetUrl');

Route::resource('CampaignsTerritoriesStep4','CampaignsTerritoriesStep4Controller');
// Ajax
//Route::get('ChangeStatusToLevel1Territory', 'CampaignsTerritoriesStep3Controller@ChangeStatusToLevel1Territory');
//Route::get('DeleteLevel1Territory', 'CampaignsTerritoriesStep3Controller@DeleteLevel1Territory');
Route::get('RemoveCampaignL1TerFromCampaignL1Ter', 'CampaignsTerritoriesStep4Controller@RemoveCampaignL1TerFromCampaignL1Ter');
//Route::get('AddCampaignL1TerFromCampaignL1Ter', 'CampaignsTerritoriesStep4Controller@AddCampaignL1TerFromCampaignL1Ter');
Route::post('AddCampaignL1TerFromCampaignL1Ter',array('as'=>'AddCampaignL1TerFromCampaignL1Ter','uses'=>'CampaignsTerritoriesStep4Controller@AddCampaignL1TerFromCampaignL1Ter'));
Route::get('ViewCampaignL1TerByCampaignL2Ter', 'CampaignsTerritoriesStep4Controller@ViewCampaignL1TerByCampaignL2Ter');
Route::get('SaveL2TerritoryTargetUrl', 'CampaignsTerritoriesStep4Controller@SaveL2TerritoryTargetUrl');


// For Tag Code Start

Route::resource('TagCustomerSelection','TagCustomerSelectionController');
Route::resource('TagCampaignSelection','TagCampaignSelectionController');
Route::resource('TagLevel1TerritorySelection','TagLevel1TerritorySelectionController');
Route::resource('TagLevel2TerritorySelection','TagLevel2TerritorySelectionController');

Route::resource('CampaignTagsStep3','CampaignTagsStep3Controller');
Route::get('AddTagBundleInCampaign', 'CampaignTagsStep3Controller@AddTagBundleInCampaign');
Route::get('RemoveTagBundleFromCampaign', 'CampaignTagsStep3Controller@RemoveTagBundleFromCampaign');
Route::get('ViewTagBundleInTags', 'CampaignTagsStep3Controller@ViewTagBundleInTags');

Route::resource('CampaignWithTerTagsStep3','CampaignWithTerTagsStep3Controller');
Route::get('AddTagBundleInL1Territory', 'CampaignWithTerTagsStep3Controller@AddTagBundleInL1Territory');
Route::get('RemoveTagBundleFromL1Territory', 'CampaignWithTerTagsStep3Controller@RemoveTagBundleFromL1Territory');

Route::resource('CampaignWithL2TerTagsStep3','CampaignWithL2TerTagsStep3Controlle');
Route::get('AddTagBundleInL2Territory', 'CampaignWithL2TerTagsStep3Controlle@AddTagBundleInL2Territory');
Route::get('RemoveTagBundleFromL2Territory', 'CampaignWithL2TerTagsStep3Controlle@RemoveTagBundleFromL2Territory');

Route::resource('CampaignTagsStep4','CampaignTagsStep4Controller');
Route::get('AddTagInCampaign', 'CampaignTagsStep4Controller@AddTagInCampaign');
Route::get('RemoveTagFromCampaign', 'CampaignTagsStep4Controller@RemoveTagFromCampaign');

// For Tag Code End

// For QR Code Start


Route::resource('QRCode','QRCodeController');

Route::resource('QRCustomerSelection','QRCustomerSelectionController');
Route::resource('QRCampaignSelection','QRCampaignSelectionController');
Route::resource('QRLevel1TerritorySelection','QRLevel1TerritorySelectionController');
Route::resource('QRLevel2TerritorySelection','QRLevel2TerritorySelectionController');


Route::get('ViewCampaignInQRCodes','CampaignQRCodeStep2Controller@ViewCampaignInQRCodes');
Route::get('AddQRCodeInCampaign','CampaignQRCodeStep2Controller@AddQRCodeInCampaign');
Route::get('RemoveQRCodeInCampaign','CampaignQRCodeStep2Controller@RemoveQRCodeInCampaign');
Route::get('ViewLevel1TerritoryInQRCodes','CampaignQRCodeStep2Controller@ViewLevel1TerritoryInQRCodes');
Route::get('UpdateQRCodeImageURL','CampaignQRCodeStep2Controller@UpdateQRCodeImageURL');
Route::get('DeleteQRCode','CampaignQRCodeStep2Controller@DeleteQRCode');

// For QR Code End



// For NFCTags - Roll Management Start

Route::resource('NFCTagsRollManagement','NFCTagsRollManagementController');
Route::get('OnSelectNFCTag','NFCTagsRollManagementController@OnSelectNFCTag');

// For NFCTags - Roll Management End
