<?php

//require __DIR__ . '/../vendor/autoload.php';
require '/var/www/html/vendor/autoload.php';

require 'Ticket.php';
require 'ZendeskAPI.php';

$csvFilename = 'tickets.csv';
$zendeskAPI = new ZendeskAPI($csvFilename);

$page = 1;
$allTickets = [];

while (true) {
    $tickets = $zendeskAPI->fetchTickets($page);
    if (empty($tickets)) {
        break;
    }

    foreach ($tickets as $ticketData) {
        $ticket = new Ticket(
            $ticketData['id'],
            $ticketData['subject'],
            $ticketData['status'],
            $ticketData['priority'],
            $ticketData['agentId'],
            $ticketData['agentName'],
            $ticketData['agentEmail'],
            $ticketData['contactId'],
            $ticketData['contactName'],
            $ticketData['contactEmail'],
            $ticketData['groupId'],
            $ticketData['groupName'],
            $ticketData['companyId'],
            $ticketData['companyName'],
            $ticketData['comments'],
            $ticketData['created_at']
        );
        $allTickets[] = $ticket;
    }

    $page++;
}

$zendeskAPI->storeTicketsInCSV($allTickets);
echo "Tickets have been successfully stored in $csvFilename.\n";
