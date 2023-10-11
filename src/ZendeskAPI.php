<?php

use GuzzleHttp\Client;
use League\Csv\Writer;

class ZendeskAPI
{
    private $client;
    private $csvFilename;

    public function __construct($csvFilename)
    {
        $this->client = new Client();
        $this->csvFilename = $csvFilename;
    }

    public function fetchTickets($page = 1)
    {
        $response = $this->client->get("https://test9352.zendesk.com/api/v2/tickets.json?page=$page",['auth' => ['vikivikivikikoryagina@gmail.com', '1234567']]);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            return $data['tickets'];
        } else {
            throw new Exception("Failed to fetch tickets from Zendesk API.");
        }
    }

    public function storeTicketsInCSV($tickets)
    {
        $csv = Writer::createFromPath($this->csvFilename, 'w+');
        $header = [
            'Ticket ID', 'Description', 'Status', 'Priority', 'Agent ID', 'Agent Name', 'Agent Email',
            'Contact ID', 'Contact Name', 'Contact Email', 'Group ID', 'Group Name', 'Company ID', 'Company Name',
            'Comments', 'Created At'
        ];
        $csv->insertOne($header);

        foreach ($tickets as $ticket) {
            $csv->insertOne([
                $ticket->id,
                $ticket->description,
                $ticket->status,
                $ticket->priority,
                $ticket->agentId,
                $ticket->agentName,
                $ticket->agentEmail,
                $ticket->contactId,
                $ticket->contactName,
                $ticket->contactEmail,
                $ticket->groupId,
                $ticket->groupName,
                $ticket->companyId,
                $ticket->companyName,
                $ticket->comments,
                $ticket->createdAt
            ]);
        }
    }
}
