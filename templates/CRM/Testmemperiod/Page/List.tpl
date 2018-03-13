{*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*}

    {if $rows}
      <div id="configure_contribution_page">
             {strip}

       {include file="CRM/common/pager.tpl" location="top"}
             {include file="CRM/common/pagerAToZ.tpl"}
             {* handle enable/disable actions *}
             {include file="CRM/common/enableDisableApi.tpl"}
       {include file="CRM/common/jsortable.tpl"}
             <table id="options" class="display">
               <thead>
               <tr>
                 <th>{ts}Membership{/ts}</th>
               <th>{ts}Start Date{/ts}</th>
               <th>{ts}End Date{/ts}</th>
            <th></th>
               </tr>
               </thead>
               {foreach from=$rows item=row}
                 <tr id="contribution_page-{$row.id}" class="crm-entity">
                     <td><a href='/index.php?q=civicrm/contact/view/contribution&reset=1&force=1&cid={$cid}'><strong>{$row.name}</strong></a></td>
                     <td>{$row.start_date}</td>
                     <td>{$row.end_date}</td>
          {if call_user_func(array('CRM_Campaign_BAO_Campaign','isCampaignEnable'))}
          <td>{$row.campaign}</td>
          {/if}
          <td class="crm-contribution-page-actions right nowrap">




        <div class="crm-contribution-page-more">
                    {$row.action|replace:'xx':$row.id}
            </div>

      </td>

         </tr>
         {/foreach}
      </table>

        {/strip}
      </div>
  
    {/if}
