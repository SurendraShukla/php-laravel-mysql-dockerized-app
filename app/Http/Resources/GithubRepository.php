<?php

namespace App\Http\Resources;

use App\Http\Resources\GithubResource;
use \GuzzleHttp\Client;

class GithubRepository
{

    private $guzzleHttpClient;

    public function __construct(Client $client)
    {
        $this->guzzleHttpClient = $client;
    }

    public function getCommitsForUsers(array $userNameList)
    {

        if (!$userNameList || (count($userNameList) < 0)) {
            return;
        }

        $commitsByUser = [];
        foreach ($userNameList as $username) {

            $userCommits = $this->fetchUserCommits($username);
            foreach ($userCommits as $userCommitInfo) {

                $commit = $this->transferCommitInfo($userCommitInfo);
                if (!$commit) {
                    continue;
                }
                $commitsByUser[] = $commit;

            }

        }

        return $commitsByUser;

    }

    /**
     * @return mixed
     */
    public function fetchUserCommits($username)
    {
        $res = $this->guzzleHttpClient->get('https://api.github.com/users/' . $username . '/events?per_page=50');
        return json_decode($res->getBody(), true);
    }

    public function transferCommitInfo($commitInfo)
    {

        if ($commitInfo['type'] != 'PushEvent') {
            return;
        }
        $userCommits = $commitInfo['payload']['commits'];
        if (count($userCommits) <= 0) {
            return;
        }

        $activityDateTime = date("Y-m-d H:m:s", strtotime($commitInfo['created_at']));
        $obj = new \stdClass();
        $obj->type = 'github';
        $obj->username = $userCommits[0]['author']['name'];
        $obj->message = $userCommits[0]['message'];
        $obj->link = $userCommits[0]['url'];
        $obj->activityDateTime = $activityDateTime;

        return $obj;

    }

}
