DROP TABLE IF EXISTS `civicrm_civicrmmembershipperiod`;
CREATE TABLE `civicrm_civicrmmembershipperiod` (


     `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Unique CivicrmMembershipPeriod ID',
     `membership_id` int unsigned    COMMENT 'FK to Membership',
     `start_date` date   DEFAULT null COMMENT 'Membership period Start Date',
     `end_date` date   DEFAULT null COMMENT 'Membership period End Date'
,
        PRIMARY KEY (`id`)


,          CONSTRAINT FK_civicrm_civicrmmembershipperiod_membership_id FOREIGN KEY (`membership_id`) REFERENCES `civicrm_membership`(`id`) ON DELETE CASCADE 
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;
