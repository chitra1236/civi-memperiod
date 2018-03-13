<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2018
 *
 * Generated from xml/schema/CRM/Testmemperiod/CivicrmMembershipPeriod.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:ea00abfda6113725d7084178ad2745c1)
 */

/**
 * Database access object for the CivicrmMembershipPeriod entity.
 */
class CRM_Testmemperiod_DAO_CivicrmMembershipPeriod extends CRM_Core_DAO {

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  static $_tableName = 'civicrm_civicrmmembershipperiod';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  static $_log = TRUE;

  /**
   * Unique CivicrmMembershipPeriod ID
   *
   * @var int unsigned
   */
  public $id;

  /**
   * FK to Membership
   *
   * @var int unsigned
   */
  public $membership_id;

  /**
   * Membership period Start Date
   *
   * @var date
   */
  public $start_date;

  /**
   * Membership period End Date
   *
   * @var date
   */
  public $end_date;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_civicrmmembershipperiod';
    parent::__construct();
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static ::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'membership_id', 'civicrm_membership', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'Unique CivicrmMembershipPeriod ID',
          'required' => TRUE,
          'table_name' => 'civicrm_civicrmmembershipperiod',
          'entity' => 'CivicrmMembershipPeriod',
          'bao' => 'CRM_Testmemperiod_DAO_CivicrmMembershipPeriod',
          'localizable' => 0,
        ],
        'membership_id' => [
          'name' => 'membership_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'FK to Membership',
          'table_name' => 'civicrm_civicrmmembershipperiod',
          'entity' => 'CivicrmMembershipPeriod',
          'bao' => 'CRM_Testmemperiod_DAO_CivicrmMembershipPeriod',
          'localizable' => 0,
          'FKClassName' => 'CRM_Member_DAO_Membership',
        ],
        'start_date' => [
          'name' => 'start_date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('Start Date'),
          'description' => 'Membership period Start Date',
          'default' => 'null',
          'table_name' => 'civicrm_civicrmmembershipperiod',
          'entity' => 'CivicrmMembershipPeriod',
          'bao' => 'CRM_Testmemperiod_DAO_CivicrmMembershipPeriod',
          'localizable' => 0,
        ],
        'end_date' => [
          'name' => 'end_date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('End Date'),
          'description' => 'Membership period End Date',
          'default' => 'null',
          'table_name' => 'civicrm_civicrmmembershipperiod',
          'entity' => 'CivicrmMembershipPeriod',
          'bao' => 'CRM_Testmemperiod_DAO_CivicrmMembershipPeriod',
          'localizable' => 0,
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'civicrmmembershipperiod', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'civicrmmembershipperiod', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
