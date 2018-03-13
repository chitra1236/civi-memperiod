<?php

use CRM_Testmemperiod_ExtensionUtil as E;
use Civi\Test\HeadlessInterface;
use Civi\Test\HookInterface;
use Civi\Test\TransactionalInterface;

/**
 * FIXME - Add test description.
 *
 * Tips:
 *  - With HookInterface, you may implement CiviCRM hooks directly in the test class.
 *    Simply create corresponding functions (e.g. "hook_civicrm_post(...)" or similar).
 *  - With TransactionalInterface, any data changes made by setUp() or test****() functions will
 *    rollback automatically -- as long as you don't manipulate schema or truncate tables.
 *    If this test needs to manipulate schema or truncate tables, then either:
 *       a. Do all that using setupHeadless() and Civi\Test.
 *       b. Disable TransactionalInterface, and handle all setup/teardown yourself.
 *
 * @group headless
 */
class CRM_TestmemperiodTest extends \PHPUnit_Framework_TestCase implements HeadlessInterface, HookInterface, TransactionalInterface {

  public function setUpHeadless() {
    // Civi\Test has many helpers, like install(), uninstall(), sql(), and sqlFile().
    // See: https://github.com/civicrm/org.civicrm.testapalooza/blob/master/civi-test.md
    return \Civi\Test::headless()
      ->installMe(__DIR__)
      ->apply();
  }

  public function setUp() {
    parent::setUp();
  }

  public function tearDown() {
    parent::tearDown();
  }

  /**
   * Example: Test that a version is returned.
   */
  public function testWellFormedVersion() {
    $this->assertRegExp('/^([0-9\.]|alpha|beta)*$/', \CRM_Utils_System::version());
  }

  /**
   * Example: Test that we're using a fake CMS.
   */
  public function testWellFormedUF() {
    $this->assertEquals('UnitTests', CIVICRM_UF);
  }
  
  public function testMembershipPeriodDateEmpty() {
        $params = create_membership_period("", "", "2 Years", 1);
        $exp_params = [];
        $this->assertEquals($exp_params, $params);
    }
  public function testMembershipPeriodDateValidate() {
        $params = create_membership_period("2017-11-02", "2033-11-01", "2 Years", 1);
            $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2019-11-02 00:00:00",
                'end_date' => "2021-11-01 23:59:59",
            );
           $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2021-11-02 00:00:00",
                'end_date' => "2023-11-01 23:59:59",
            );
            $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2023-11-02 00:00:00",
                'end_date' => "2025-11-01 23:59:59",
            );
            $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2025-11-02 00:00:00",
                'end_date' => "2027-11-01 23:59:59",
            );
            $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2027-11-02 00:00:00",
                'end_date' => "2029-11-01 23:59:59",
            );
            $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2029-11-02 00:00:00",
                'end_date' => "2031-11-01 23:59:59",
            );
            $exp_params[] =  array('membership_id' => 1,
                'start_date' => "2031-11-02 00:00:00",
                'end_date' => "2033-11-01 23:59:59",
            );
        
        $this->assertEquals($exp_params, $params);
    }
    public function testMembershipPeriodDuration() {
          $duration=fetch_membership_duration(1);
          $this->assertEquals("2 year", $duration);
    }

}
