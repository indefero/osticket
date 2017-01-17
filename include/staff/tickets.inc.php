
<?php

switch(strtolower($_REQUEST['status'])){ //Status is overloaded
    case 'open':
        $status='open';
		$results_type=__('Open Tickets');
        break;


    case 'closed':
        $status='closed';
		$results_type=__('Closed Tickets');
        $showassigned=true; //closed by.
        break;
    case 'overdue':
        $status='open';
        $showoverdue=true;
        $results_type=__('Overdue Tickets');
        break;
    case 'assigned':
        $status='open';
        $staffId=$thisstaff->getId();
        $results_type=__('My Tickets');
        break;
    case 'answered':
        $status='open';
        $showanswered=true;
        $results_type=__('Answered Tickets');
        break;
    default:
    //CHANGE THIS BLOCK
        if (!$search && !isset($_REQUEST['advsid'])) {
            if (!isset($_REQUEST['status'])) {
                $status = 'open';
                $results_type = __('Open Tickets');
            } else {
                $results_type = __('Records');
                $status = $_REQUEST['status'];
            }
        }
        break;
}



.
.
.
.
.

if (isset($_REQUEST['uid']) && $_REQUEST['uid']) {
    $qwhere .= ' AND (ticket.user_id='.db_input($_REQUEST['uid'])
            .' OR collab.user_id='.db_input($_REQUEST['uid']).') ';
    $qs += array('uid' => $_REQUEST['uid']);
}

//add this line here
$qwhere.=Tabs::getTicketListSqlQuery($_REQUEST['status'],$results_type);


?>



