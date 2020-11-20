<?php


namespace Config;


class Config
{
    const SITE_NAME = 'MENU MAKER';

    /* BASE PATH */
    const BASE_PATH_DEVELOP    = 'http://192.168.0.149/menu-maker/';
    const BASE_PATH_PRODUCTION = 'https://www.barts-pr.be/pwa/menu-maker/';
    const BASE_PATH            = self::BASE_PATH_DEVELOP;

    /* Database */
    const DB_CONNECTIONSTRING = "mysql:host=localhost; dbname=menucreator; charset=utf8";
    const DB_USER             = "root";
    const DB_PASSWORD         = "";

    /* Pictures default path */
    const PIC_DEFAULT_PATH = 'img';

    const DEFAULT_COMPLEXITY = 1;
    const DEFAULT_TIME = 1.00;
}