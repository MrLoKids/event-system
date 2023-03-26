<p align="center">
    <h1 align="center">Event system as example of code</h1>
<h4 align="center">based on Yii 2 Basic Project Template</h4>
    <br>
</p>

> Main code are located in **event** directory

### How to check

Clone and install with docker-compose

    docker-compose run --rm php composer install
    docker-compose up -d

Run queue listener at container

    yii queue/listen

Tail special log file in CLI

    tail -f runtime/logs/events.log

Open the following URL:

    http://127.0.0.1:8000

Press Test button and check tail logs
