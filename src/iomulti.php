<?php

$master_socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
socket_set_option($master_socket, SOL_SOCKET, SO_REUSEADDR, 1);

if (!socket_bind($master_socket, '127.0.0.1', 8080) || !socket_listen($master_socket, 0)) {
    die("port in use.\n");
}

$sockets = [$master_socket];

while (true) {
    $read = $sockets;
    $null = null;
    socket_select($read, $null, $null, $null);

    foreach ($read as $socket) {
        if ($socket === $master_socket) {
            echo "connected.\n";
            $sockets[] = socket_accept($master_socket);
        } else {
            $input = socket_read($socket, 1024);
            if (trim($input) === 'quit') {
                $key = array_search($socket, $sockets);
                unset($sockets[$key]);
                socket_close($socket);
            } else {
                socket_write($socket, $input);
            }
        }
    }
}