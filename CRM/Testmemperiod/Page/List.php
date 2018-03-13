<?php

use CRM_Testmemperiod_ExtensionUtil as E;

class CRM_Testmemperiod_Page_List extends CRM_Core_Page {

    /**
     * The action links that we need to display for the browse screen.
     *
     * @var array
     */

    public $_contactId = NULL;


    public function preProcess() {
        $context = CRM_Utils_Request::retrieve('context', 'String', $this);
        $this->_action = CRM_Utils_Request::retrieve('action', 'String', $this, FALSE, 'browse');
        $this->_contactId = CRM_Utils_Request::retrieve('cid', 'Positive', $this, empty($this->_id));

        $this->assign('contactId', $this->_contactId);
        // check logged in url permission
        CRM_Contact_Page_View::checkUserPermission($this);
        $this->assign('action', $this->_action);
    }

    public function run() {
        $this->preProcess();
        // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
        CRM_Utils_System::setTitle(E::ts('Membership Periods'));
        $displayName = CRM_Contact_BAO_Contact::displayName($this->_contactId);
        $resultMembership = civicrm_api3('Membership', 'get', array(
          'sequential' => 1,
          'contact_id' => $this->_contactId,
        ));
        //fetch all memberships of contactId
        $memIds=array();
        foreach($resultMembership['values'] as $membership){
            $memIds[]=$membership['id'];
        }
        //fetch all membership periods for fetched memberships
        $resultPeriods = civicrm_api3('CivicrmMembershipPeriod', 'get', array(
          'membership_id' => array('IN' => $memIds),
            'return' => [
                'id','start_date','end_date',
                'membership_id.membership_type_id.name'
                ],
        ));  
        foreach ($resultPeriods['values'] as $key=>$row){
            $resultPeriods['values'][$key]['name']=$row['membership_id.membership_type_id.name'];
        }

        // Assign variables for use in a template

        $this->assign('rows', $resultPeriods['values']);
        $this->assign('cid', $this->_contactId);
        parent::run();
    }

}
