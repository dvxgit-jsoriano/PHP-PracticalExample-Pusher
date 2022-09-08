<?php
require __DIR__ . '/vendor/autoload.php';

// This is the data or payload that you will pass to the pusher channel and event trigger.
$data = [
  "agent_id" => $_GET['agent_id'] ?? 1,
  "agent_name" => $_GET['agent_name'] ?? 'James Harden',
  "status" => $_GET['status'] ?? 'ON'
];

// This is pusher options
$options = array(
  'cluster' => 'ap1',
  'useTLS' => true
);
$pusher = new Pusher\Pusher(
  '<YOUR-KEY>',
  '<YOUR-SECRET>',
  '<YOUR-APP-ID>',
  $options
);

$pusher->trigger('my-channel', 'event-update-rtm', $data);
