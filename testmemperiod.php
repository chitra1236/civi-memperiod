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

/**
 * Implements hook_civicrm_tabset().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_tabset/
 */
function testmemperiod_civicrm_tabset($tabsetName, &$tabs, $context) {
    //check if the tabset is Contact Summary Page
    if ($tabsetName == 'civicrm/contact/view') {
//        print_r($context);exit;
        if (!empty($context)) {
            $contactId = $context['contact_id'];
            // adding Membership Period tab
            $url = CRM_Utils_System::url('civicrm/contact/view/membershipperiod', "reset=1&snippet=1&force=1&cid=$contactId");
            $tabs[] = array('id' => 'membershipPeriods',
                'url' => $url,
                'title' => ts('Membership Periods'),               
            );
        } else {
            $tabs[] = array(
                'title' => ts('Membership Periods'),
                'url' => 'civicrm/contact/view/membershipperiod',
            );
        }
    }
}

/**
 * Implements hook_civicrm_post().
 * 
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_post/
 */
function testmemperiod_civicrm_post($op, $objectName, $objectId, &$objectRef) {
    if ($objectName != 'Membership') {
        return;
    }
    if ($op != 'create' && $op != 'edit') {
        return;
    }
    
    //fetch membership type detail to get duration
    $mem_duration=fetch_membership_duration($objectRef->membership_type_id);
    if(strstr($mem_duration,'lifetime')){
        return;
    }
    $params=create_membership_period($objectRef->start_date,$objectRef->end_date,$mem_duration,$objectRef->id);
    //adding record to table
    foreach($params as $param){
        civicrm_api3('CivicrmMembershipPeriod', 'create', $param);
    }
}
function create_membership_period($start_date, $end_date, $duration, $mem_id) {
    if(empty($start_date) || empty($end_date) || empty($duration) || empty($mem_id))
    {
        return array();
    }
    //check if data exists in db
    $result_period = civicrm_api3('CivicrmMembershipPeriod', 'get', array(
        'membership_id' => $mem_id,
    ));
    $count = $result_period['count'];

    $begin = new DateTime($start_date);
    $end = new DateTime($end_date);

    $interval = DateInterval::createFromDateString($duration);
    //get intervals
    $period = new DatePeriod($begin, $interval, $end);
    //loop through array
    $params=[];
    foreach ($period as $dt) {
        if ($count > 0) { //skipping as data is already in db
            $count--;
            continue;
        }
        $dt_format = $dt->format("Y-m-d");
        $params[] = ['membership_id' => $mem_id,
            'start_date' => $dt_format . " 00:00:00",
            'end_date' => date('Y-m-d', strtotime("-1 day", strtotime($duration, strtotime($dt_format)))) . " 23:59:59",
        ];        
    }
    return $params;
}

function fetch_membership_duration($memtype_id){
    $result_memtype = civicrm_api3('MembershipType', 'get', array(
        'id' => $memtype_id,
    ));
    $duration_unit = $result_memtype['values'][$memtype_id]['duration_unit'];    
    $duration_interval = $result_memtype['values'][$memtype_id]['duration_interval']; 
    return $duration_interval.' '.$duration_unit;
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
