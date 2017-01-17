--Custom Tabs Table Create Script;



CREATE TABLE `ost_ticket_tabs` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`order_no` INT(11) NOT NULL DEFAULT '0',
	`tab_name` VARCHAR(45) NOT NULL,
	`page_name` VARCHAR(45) NOT NULL,
	`display_name` VARCHAR(45) NOT NULL,
	`tab_isenable` TINYINT(4) NOT NULL DEFAULT '0',
	`allow_isadmin` TINYINT(4) NOT NULL DEFAULT '0',
	`allow_staff_id` VARCHAR(250) NOT NULL DEFAULT '0',
	`allow_dept_id` VARCHAR(100) NOT NULL DEFAULT '0',
	`ticket_isopen` TINYINT(4) NOT NULL DEFAULT '0',
	`ticket_isanswered` TINYINT(4) NOT NULL DEFAULT '0',
	`ticket_status_id_list` VARCHAR(45) NOT NULL DEFAULT '1',
	`ticket_topic_id_list` VARCHAR(45) NOT NULL DEFAULT '0',
	`ticket_dept_id_list` VARCHAR(45) NOT NULL DEFAULT '0',
	`ticket_team_id_list` VARCHAR(45) NOT NULL DEFAULT '0',
	`ticket_iconclass` VARCHAR(45) NOT NULL DEFAULT 'assignedTickets',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `Id_UNIQUE` (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=19
;
