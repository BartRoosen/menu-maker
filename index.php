<?php

require __DIR__ . '/vendor/autoload.php';

if ('/menu-maker/' === $_SERVER['REQUEST_URI']) {
    header('location: /menu-maker/home');
} else {
    new \Services\NavigationService($_SERVER['REQUEST_URI']);
}

