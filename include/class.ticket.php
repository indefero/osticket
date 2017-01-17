<?php

// First you have to add this reference;
require_once(INCLUDE_DIR . 'class.tabs.php');

// And change the getstaffstats function like this or add function  between part of query Tabs::getTicketTabSqlQuery($where,$where2)


function getStaffStats($staff) {
        global $cfg;

        /* Unknown or invalid staff */
        if(!$staff || (!is_object($staff) && !($staff=Staff::lookup($staff))) || !$staff->isStaff())
            return null;

        $where = array('(ticket.staff_id='.db_input($staff->getId()) .' AND
                    status.state="open")');
        $where2 = '';

        if(($teams=$staff->getTeams()))
            $where[] = ' ( ticket.team_id IN('.implode(',', db_input(array_filter($teams)))
                        .') AND status.state="open")';

        if(!$staff->showAssignedOnly() && ($depts=$staff->getDepts())) //Staff with limited access just see Assigned tickets.
            $where[] = 'ticket.dept_id IN('.implode(',', db_input($depts)).') ';

        if(!$cfg || !($cfg->showAssignedTickets() || $staff->showAssignedTickets()))
            $where2 =' AND ticket.staff_id=0 ';
        $where = implode(' OR ', $where);
        if ($where) $where = 'AND ( '.$where.' ) ';

        $sql =  'SELECT \'open\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'open\') '
                .'WHERE ticket.isanswered = 0 '
                . $where . $where2

                .'UNION SELECT \'answered\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'open\') '
                .'WHERE ticket.isanswered = 1 '
                . $where
                
                // ADD THIS LINE
                .
                   Tabs::getTicketTabSqlQuery($where,$where2)
                .

                .'UNION SELECT \'overdue\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'open\') '
                .'WHERE ticket.isoverdue =1 '
                . $where

                .'UNION SELECT \'assigned\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'open\') '
                .'WHERE ticket.staff_id = ' . db_input($staff->getId()) . ' '
                . $where

                .'UNION SELECT \'closed\', count( ticket.ticket_id ) AS tickets '
                .'FROM ' . TICKET_TABLE . ' ticket '
                .'INNER JOIN '.TICKET_STATUS_TABLE. ' status
                    ON (ticket.status_id=status.id
                            AND status.state=\'closed\' ) '
                .'WHERE 1 '
                . $where;

        $res = db_query($sql);
        $stats = array();
        while($row = db_fetch_row($res)) {
            $stats[$row[0]] = $row[1];
        }
        return $stats;
    }
