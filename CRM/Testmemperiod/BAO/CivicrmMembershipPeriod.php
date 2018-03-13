<?php
use CRM_Testmemperiod_ExtensionUtil as E;

class CRM_Testmemperiod_BAO_CivicrmMembershipPeriod extends CRM_Testmemperiod_DAO_CivicrmMembershipPeriod {

  /**
   * Create a new CivicrmMembershipPeriod based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Testmemperiod_DAO_CivicrmMembershipPeriod|NULL
   *
   */
  public static function create($params) {
    $className = 'CRM_Testmemperiod_DAO_CivicrmMembershipPeriod';
    $entityName = 'CivicrmMembershipPeriod';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } 

}
