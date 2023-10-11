<?php

class Ticket
{
    public $id;
    public $description;
    public $status;
    public $priority;
    public $agentId;
    public $agentName;
    public $agentEmail;
    public $contactId;
    public $contactName;
    public $contactEmail;
    public $groupId;
    public $groupName;
    public $companyId;
    public $companyName;
    public $comments;
    public $createdAt;

    public function __construct
    (
        $id,
        $description,
        $status,
        $priority,
        $agentId,
        $agentName,
        $agentEmail,
        $contactId,
        $contactName,
        $contactEmail,
        $groupId,
        $groupName,
        $companyId,
        $companyName,
        $comments,
        $createdAt
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->agentId = $agentId;
        $this->agentName = $agentName;
        $this->agentEmail = $agentEmail;
        $this->contactId = $contactId;
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->groupId = $groupId;
        $this->groupName = $groupName;
        $this->companyId = $companyId;
        $this->companyName = $companyName;
        $this->comments = $comments;
        $this->createdAt = $createdAt;
    }
}
