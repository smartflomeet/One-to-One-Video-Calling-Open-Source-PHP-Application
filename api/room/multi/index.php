<?php

// POST api/room/multi
// To create a Conference Room for multi party - using contact room information.
//
// Return: Returns result code with room-meta of newly created room

require '../../error.php';
require '../../utils.php';

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $error = [];
    $error = $appError['5001'];					// Invalid request method
    $error['desc'] = 'HTTP POST Requests only';
    print json_encode($error);
    exit;
}

// create a Conference Room
$ret = createRoomMulti();
if ($ret) {
    print $ret;
    exit;
}
