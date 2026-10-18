<?php

include_once 'Zoom_Api.php';
session_start();

$zoom_meeting = new Zoom_Api();

$data = array();
$data['topic']      = 'Zoom Meeting';
$data['start_date'] = date('Y-m-d H:i:s', strtotime('tomorrow'));
$data['duration']   = 30;
$data['type']       = 2;
$data['password']   = '123456';

header('Content-Type: text/html; charset=utf-8');

try {
	$response = $zoom_meeting->createMeeting($data);

	if (!is_object($response)) {
		throw new Exception('Unexpected response type from Zoom API.');
	}

	$id       = isset($response->id) ? (string) $response->id : '';
	$topic    = isset($response->topic) ? (string) $response->topic : '';
	$password = isset($response->password) ? (string) $response->password : '';
	$joinUrl  = isset($response->join_url) ? (string) $response->join_url : '';

	if ($joinUrl === '') {
		$hint = isset($response->message)
			? (string) $response->message
			: 'No join URL in response. If you use API key + secret (JWT), note Zoom retired this for most accounts; use a Server-to-Server OAuth app instead.';
		throw new Exception($hint);
	}

	echo '<h1>Zoom Class Created Successfully</h1>';
	echo '<p><strong>Meeting ID:</strong> ' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p><strong>Topic:</strong> ' . htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p><strong>Meeting Password:</strong> ' . htmlspecialchars($password, ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p><strong>Meeting Time:</strong> ' . htmlspecialchars($data['start_date'], ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p><strong>Join URL:</strong> <a href="' . htmlspecialchars($joinUrl, ENT_QUOTES, 'UTF-8') . '">Click here to start the class</a></p>';

	$_SESSION['url']  = $joinUrl;
	$_SESSION['time'] = $data['start_date'];
} catch (Exception $ex) {
	echo '<h1>Zoom meeting could not be created</h1>';
	echo '<p>' . htmlspecialchars($ex->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p><a href="zoom.php">Back to Virtual Classroom</a></p>';
}
