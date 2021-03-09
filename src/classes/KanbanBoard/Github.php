<?php

class GithubClient
{
    private $client;
    private $milestone_api;
    private $account;

    public function __construct($token=NULL, $account, $client)
    {
        $this->account = $account;
        $this->client = $client;
        $this->authenticateWithToken($token);
        $this->milestone_api = $this->client->api('issues')->milestones();
    }

    private function authenticateWithToken($token){
        if($token !== NULL)
            $this->client->authenticate($token, \Github\Client::AUTH_HTTP_TOKEN);
        return true;
    }
        

    public function milestones($repository)
    {   
        return $this->milestone_api->all($this->account, $repository);
    }

    public function issues($repository, $milestone_id)
    {
        $issue_parameters = array('milestone' => $milestone_id, 'state' => 'all');
        return $this->client->api('issue')->all($this->account, $repository, $issue_parameters);
    }
}