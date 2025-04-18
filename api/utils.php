<?php

require 'config.php';

/*
* To create a Conference Room - using contact room information.
* @return: result in json format with room-meta of newly created room
*/
function createRoom()
{
    $randomName = rand(100000, 999999);

    /* Create Room Meta */
    $room = [
        'name'		=> 'room for one to one video meeting: ' . $randomName,
        'owner_ref'	=> $randomName,
        'settings'	=> [
			'scheduled'		 => false,
			'adhoc'			 => true,
			'moderators'     => '1',
			'participants'	 => '1',
			'duration'		 => '30',
            'quality'		 => 'SD',
            'auto_recording' => false,
		],
    ];

    /* CURL POST Request */
    return httpPost(API_URL . '/rooms/', json_encode($room));
}

/*
* To create a Conference Room - using contact room information.
* @return: result in json format with room-meta of newly created room
*/
function createRoomMulti()
{
    $randomName = rand(100000, 999999);

    /* Create Room Meta */
    $room = [
        'name'		=> 'room for multi party video meeting: ' . $randomName,
        'owner_ref'	=> $randomName,
        'settings'	=> [
			'scheduled'		 => false,
			'adhoc'			 => true,
			'moderators'     => '1',
			'participants'	 => '5',
			'duration'		 => '30',
            'quality'		 => 'SD',
            'auto_recording' => false,
		],
    ];

    /* CURL POST Request */
    return httpPost(API_URL . '/rooms/', json_encode($room));
}

/*
* To get information of a given room
* @param: string roomId
* @return: Returns Room Meta
*/
function getRoom($roomId)
{
    /* CURL GET Request */
    return httpGet(API_URL . '/rooms/' . $roomId);
}

/*
* To create a Token for a given room
* @return: result in json format with created token
*/
function createToken($data)
{
    /* Create Token Payload */
    $token = [
        'name'	   => $data->name,
        'role'	   => $data->role,
        'user_ref' => $data->user_ref
    ];

    /* CURL POST Request */
    return httpPost(API_URL . '/rooms/' . $data->roomId . '/tokens', json_encode($token));
}

/*
* Utility function for creating API header
* @return: API header
*/
function appHeader()
{
    /* Prepare HTTP Post Request */
    return [
        'Content-Type: application/json',
        'Authorization: Basic '. base64_encode(APP_ID . ':' . APP_KEY)
    ];
}

/*
* Utility function for making curl POST request
* @return: response of http request
*/
function httpPost($url, $params)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, appHeader());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

/*
* Utility function for making curl GET request
* @return: response of http request
*/
function httpGet($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, appHeader());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}
