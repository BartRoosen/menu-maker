<?php


namespace Controllers;


use Config\Config;
use Services\SessionService;
use Services\TwigService;
use Services\YamlParserService;

class AbstractController
{
    /** @var TwigService */
    protected $twigService;

    /** @var YamlParserService */
    protected $parserService;

    /** @var SessionService */
    protected $sessionService;

    /** @var Config */
    protected $basePath;

    /** @var array */
    protected $menuItems;

    public function __construct()
    {
        $this->twigService    = new TwigService();
        $this->parserService  = new YamlParserService();
        $this->sessionService = new SessionService();
        $this->basePath       = Config::BASE_PATH;
        $this->menuItems      = $this->parserService->parseFile('menu.yml');
    }

    protected function redirect($path)
    {
        header(sprintf('location: %s', $path));
    }
}
