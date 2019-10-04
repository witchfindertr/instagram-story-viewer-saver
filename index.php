<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    require 'vendor/autoload.php';

    \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

    $username = 'guccisekspir';
    $password = '///////';
    $user_id = '2251399297';

    $ig = new \InstagramAPI\Instagram(false,false);

    try {
        $ig->login($username, $password);

        $story_list = [];
        foreach ($ig->story->getUserReelMediaFeed($user_id)->getItems() as $key => $value)
        {
            array_push($story_list, $value->getId());
        }

        //foreach ($story_list as $stories) {
            $maxId = null;
            do {
                $response = $ig->story->getStoryItemViewers($story_list[0], $maxId);
                
                foreach ($response->getUsers() as $key => $value) {
                    d($value);
                }

                $maxId = $response->getNextMaxId();
                sleep(5);
            } while ($maxId !== null);

            echo '<br> ================================= <br>';
        //}

    } catch (\Exception $e) {
        die('A error occured. ->' . $e->getMessage());
    }

