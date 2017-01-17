<?php
/* First ;

Add the reference top of the class.ticket.php */

require_once(INCLUDE_DIR . 'class.tabs.php');

.
.
.
.
.




function getStaffStats($staff) {
        .
        .
        .
        

        $sql =  'SELECT \'open\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'open\') '
                .'WHERE ticket.isanswered = 0 '
                . $where . $where2
                
                .
                // Add this line                 
                Tabs::getTicketTabSqlQuery($where,$where2)

                .
                
                .'UNION SELECT \'answered\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'open\') '
                .'WHERE ticket.isanswered = 1 '
                . $where







?>
