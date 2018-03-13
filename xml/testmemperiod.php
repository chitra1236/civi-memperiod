<?php

require_once 'testmemperiod.civix.php';
use CRM_Testmemperiod_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function testmemperiod_civicrm_config(&$config) {
  _testmemperiod_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function testmemperiod_civicrm_xmlMenu(&$files) {
  _testmemperiod_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function testmemperiod_civicrm_install() {
  _testmemperiod_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function testmemperiod_civicrm_postInstall() {
  _testmemperiod_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function testmemperiod_civicrm_uninstall() {
  _testmemperiod_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function testmemperiod_civicrm_enable() {
  _testmemperiod_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function testmemperiod_civicrm_disable() {
  _testmemperiod_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function testmemperiod_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _testmemperiod_civix_civicrm_upgrade($op, $queue);
}

function testmemperiod_civicrm_post($op, $objectName, $objectId, &$objectRef) {
if($objectName != 'Membership' &&  $op!='create' && $op!='edit' ){
    return;
}
//$params=['membership_id'=>];
//
//$result = civicrm_api3('CivicrmMembershipPeriod', 'create');
//echo '=======================================op=======================';
//print_r($op);
//echo '===========================objectName=========================';
//print_R($objectName);
//echo '================================objectid============================';
//print_r( $objectId);
echo '====================objectRef========================================';
print_r($objectRef);

exit;
}
/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function testmemperiod_civicrm_managed(&$entities) {
  _testmemperiod_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function testmemperiod_civicrm_caseTypes(&$caseTypes) {
  _testmemperiod_civix_civicrm_caseTypes($caseTypes);
}
function testmemperiod_civicrm_entityTypes(&$entityTypes) {
  $entityTypes[] = array(
    'name'  => 'CivicrmMembershipPeriod',
    'class' => 'CRM_Testmemperiod_DAO_CivicrmMembershipPeriod',
    'table' => 'civicrm_civicrmmembershipperiod',
  );
}
/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function testmemperiod_civicrm_angularModules(&$angularModules) {
  _testmemperiod_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function testmemperiod_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _testmemperiod_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function testmemperiod_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function testmemperiod_civicrm_navigationMenu(&$menu) {
  _testmemperiod_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _testmemperiod_civix_navigationMenu($menu);
} // */
