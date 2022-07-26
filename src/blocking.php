<?php

$sock = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1);

if (!socket_bind($sock, '127.0.0.1', 8080) || !socket_listen($sock, 0)) {
    die("port in use.\n");
}

while (true) {
    $client_sock = socket_accept($sock);
    echo "connected.\n";
    $buf = socket_read($client_sock, 1024);
    socket_write($client_sock, $buf);
    socket_close($client_sock);
}
