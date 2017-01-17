<?php
.
.
.
.
.
/*
$stats= $thisstaff->getTicketsStats();

//Navigation
$nav->setTabActive('tickets');
$open_name = _P('queue-name',
    /* This is the name of the open ticket queue */
    'Open');*/
    
// Add this function to here
Tabs::addTicketTab($thisstaff,$nav,$stats,__FILE__);    

.
.
.
.
.
/*
if($cfg->showAnsweredTickets()) {
    $nav->addSubMenu(array('desc'=>$open_name.' ('.number_format($stats['open']+$stats['answered']).')',
                            'title'=>__('Open Tickets'),
                            'href'=>'tickets.php?status=open',
                            'iconclass'=>'Ticket'),
                        (!$_REQUEST['status'] || $_REQUEST['status']=='open'));
} else {

    if ($stats) {

        $nav->addSubMenu(array('desc'=>$open_name.' ('.number_format($stats['open']).')',
                               'title'=>__('Open Tickets'),
                               'href'=>'tickets.php?status=open',
                               'iconclass'=>'Ticket'),
                            (!$_REQUEST['status'] || $_REQUEST['status']=='open'));
    }

    if($stats['answered']) {
        $nav->addSubMenu(array('desc'=>__('Answered').' ('.number_format($stats['answered']).')',
                               'title'=>__('Answered Tickets'),
                               'href'=>'tickets.php?status=answered',
                               'iconclass'=>'answeredTickets'),
                            ($_REQUEST['status']=='answered'));
    }
}
*/
