<?php
/* This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://sam.zoy.org/wtfpl/COPYING for more details. */

ini_set('display_errors', 1);
error_reporting(E_ALL);

require(dirname(__FILE__) . '/lib/SplClassLoader.php');

require(dirname(__FILE__) . '/lib/WebSocket/Application/Application.php');
//require(dirname(__FILE__) . '/lib/WebSocket/Application/Application.php');

require(dirname(__FILE__) . '/lib/WebSocket/Socket.php');
require(dirname(__FILE__) . '/lib/WebSocket/Connection.php');
require(dirname(__FILE__) . '/lib/WebSocket/Server.php');

//$classLoader = new SplClassLoader('WebSocket', dirname(__FILE__) . '/lib');
//$classLoader->register();

$server = new Server('websockets.possum-cms.com', 8002, false);

// server settings:
$server->setMaxClients(100);
$server->setCheckOrigin(false);
$server->setAllowedOrigin('foo.lh');
$server->setMaxConnectionsPerIp(100);
$server->setMaxRequestsPerMinute(2000);

// Hint: Status application should not be removed as it displays usefull server informations:
$server->registerApplication('status', StatusApplication::getInstance());
$server->registerApplication('demo', DemoApplication::getInstance());

$server->run();