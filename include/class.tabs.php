<?php

class Tabs
{

      static function getTicketListSqlQuery($requestStatus,&$results_type)
    {
        $qwhere = " ";
        $tab_query = 'select * from ' . TICKET_TABS_TABLE . ' where tab_isenable=1 order by order_no asc ';
        $tabs = db_query($tab_query);

        while ($row = db_fetch_array($tabs)) {

            if ($row['tab_name'] == $requestStatus) {

                if ($row['ticket_isopen'] == 0)
                    $tstate = 'closed';
                else
                    $tstate = 'open';

                $ticket_status_list = $row['ticket_status_id_list'];
                $topicList = $row['ticket_topic_id_list'];
                $deptList = $row['ticket_dept_id_list'];
                $teamList = $row['ticket_team_id_list'];
                $tIsAnswered = $row['ticket_isanswered'];
				$display_name = $row['display_name'];
				$results_type=$display_name;
				
                $qwhere .= ' AND status.state = \'' . $tstate . '\'';
                if ($ticket_status_list != 0)
                    $qwhere .= ' AND ticket.status_id in  ( ' . $ticket_status_list . ' )';
                if ($topicList != 0)
                    $qwhere .= ' AND ticket.topic_id in (' . $topicList . ')';
                if ($deptList != 0)
                    $qwhere .= ' AND ticket.dept_id in (' . $deptList . ')';
                if ($teamList != 0)
                    $qwhere .= ' AND ticket.team_id in (' . $teamList . ')';
                if ($tIsAnswered == 1 or $tIsAnswered == 0)
                    $qwhere .= ' AND ticket.isanswered =  ' . $tIsAnswered . ' ';
                break;
            }
        }
        return $qwhere;
    }


    static function getTicketTabSqlQuery($where, $where2)
    {
        $customsql = "";
        $tab_query = 'select * from ' . TICKET_TABS_TABLE . ' where tab_isenable=1 order by order_no asc';
        $tabs = db_query($tab_query);
        while ($row = db_fetch_array($tabs)) {

            if ($row['ticket_isopen'] == 0)
                $tstate = 'closed';
            else
                $tstate = 'open';

            $tab_name = $row['tab_name'];
            $ticket_status_list = $row['ticket_status_id_list'];
            $topicList = $row['ticket_topic_id_list'];
            $deptList = $row['ticket_dept_id_list'];
            $teamList = $row['ticket_team_id_list'];
            $tIsAnswered = $row['ticket_isanswered'];

            $customsql .= ' UNION SELECT \'' . $tab_name . '\', count( ticket.ticket_id ) AS tickets '
                . 'FROM ' . TICKET_TABLE . ' ticket '
                . 'INNER JOIN ' . TICKET_STATUS_TABLE . ' status
                    ON (ticket.status_id=status.id) '
                . 'WHERE ';

            $customsql .= '  status.state = \'' . $tstate . '\'';
            if ($ticket_status_list != 0)
                $customsql .= ' and ticket.status_id in  ( ' . $ticket_status_list . ' )';
            if ($topicList != 0)
                $customsql .= ' and ticket.topic_id in (' . $topicList . ')';
            if ($deptList != 0)
                $customsql .= ' and ticket.dept_id in (' . $deptList . ')';
            if ($teamList != 0)
                $customsql .= ' and ticket.team_id in (' . $teamList . ')';
            if ($tIsAnswered == 1 or $tIsAnswered == 0)
                $customsql .= ' and ticket.isanswered = ' . $tIsAnswered . ' ';

            $customsql .= $where . $where2 ;
        }

        return $customsql;
    }

    static function addTicketTab($thisstaff, $nav, $stats, $file)
    {
        $tab_query = 'select * from ' . TICKET_TABS_TABLE . ' where tab_isenable=1 order by order_no asc';
        $tabs = db_query($tab_query);
        while ($row = db_fetch_array($tabs)) {

            $page_name = $row['page_name'];
            $tab_name = $row['tab_name'];
            $display_name = $row['display_name'];
            $icon_class = $row['ticket_iconclass'];
            $tallow_isadmin = $row['allow_isadmin'];
            $allowedDeptIdList = explode(",", $row['allow_dept_id']);
			$allowedStaffIdList=explode(",", $row['allow_staff_id']);
            
			if (basename($file, '.php') == $page_name and
                (in_array($thisstaff->getdeptId(), $allowedDeptIdList)
                    or ($tallow_isadmin == 1 and $thisstaff->isAdmin())
                    or in_array(0, $allowedDeptIdList)
					or in_array($thisstaff->getId(),$allowedStaffIdList))
            )
                if ($stats[$tab_name] > 0)
                    $nav->addSubMenu(array('desc' => __($display_name) . ' (' . number_format($stats[$tab_name]) . ')',
                        'title' => __($display_name),
                        'href' => $page_name . '.php?status=' . $tab_name,
                        'iconclass' => $icon_class),
                        ($_REQUEST['status'] == $tab_name));
        }
    }



}
