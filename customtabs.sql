--Custom Tabs Table Create Script;

/*
order_no: Tab Order
tab_name:anyword to use
page_name: for tickets.php default value is tickets( exclude '.php' extension)
display_name=Displaying tab name
tab_isenable= 1 or 0 

access rights
allow_isadmin: if this value is 1 and you have the admin account you can see tab
allow_staff_id: example staff id list : 1,2,3,4 .... allowed staffid list
allow_dept_id: example dept id list : 1,2,3,4 ... allowed dept id list

criteria
ticket_isopen: 1 or 0
ticket_isanswered: 0 or 1 and 2 for both status
ticket_status_id_list: ost_ticket_status list ids 1,2,3 ....
ticket_topic_id_list: ost_help_topic list ids 1,2,3....
ticket_dept_id_list: ost_department list ids 1,2,3...
ticket_team_id_list: ost_team list ids 1,2,3...
ticket_iconlass: example; you can select from scp.css "assignedTickets"

*/
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
