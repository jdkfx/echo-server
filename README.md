# echo-server

PHPerKaigi 2022 パンフレットの「PHPでechoサーバーを書いてI/Oモデルを理解する（[@hanhan1978](https://twitter.com/hanhan1978)）」を実践してみる．

## 環境について

### Docker

Docker version 20.10.16

### PHP
PHP 8.1.1 (cli)

## Getting Started

### リポジトリをクローン
```shell
$ git clone
```

### Dockerコンテナの立ち上げまで
```shell
$ docker build -t php-apache . --no-cache
$ docker images
REPOSITORY   TAG       IMAGE ID       CREATED              SIZE
php-apache   latest    c31800a98129   About a minute ago   477MB
 
$ docker run -d --name echo-server -v ${pwd}:/var/www/html -p 8080:80 php-apache
$ docker ps
CONTAINER ID   IMAGE        COMMAND                  CREATED          STATUS          PORTS                  NAMES
b291260c78e8   php-apache   "docker-php-entrypoi…"   40 seconds ago   Up 40 seconds   0.0.0.0:8080->80/tcp   echo-server
```

### コンテナ内で「ブロッキングI/O」か「I/Oの多重化」を実行
```shell
$ docker exec -it echo-server /bin/bash

$ php src/blocking.php
$ php src/iomulti.php
```

### telnetで疎通確認
```shell
$ telnet localhost 8080
```