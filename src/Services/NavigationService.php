<?php


namespace Services;

use Controllers\HomeController;

class NavigationService
{
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var YamlParserService
     */
    private $parser;

    /**
     * @var array
     */
    private $routes;

    /**
     * @var string
     */
    private $uri;

    /**
     * NavigationService constructor.
     *
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->parser = new YamlParserService();
        $this->routes = $this->parser->parseFile('routing/routes.yml');
        $this->uri    = $uri;
        $this->navigateToController();
    }

    private function navigateToController()
    {
        $uri = $this->sanitizeUri();

        // [1] => ...
        // [2] => controller
        // [3] => parameter (id)

        if (isset($this->routes[$uri[2]])) {
            $route      = $this->routes[$uri[2]];
            $class      = sprintf('\\Controllers\\%s', $route['controller']);
            $controller = new $class();

            if (!isset($uri[3])) {
//                $sessionService = new SessionService();
//                $sessionService->setValue(['productId' => (int)$uri[3]]);
                $uri[3] = null;
            }

            $controller->{$route['action']}($uri[3]);
        }
    }

    private function sanitizeUri()
    {
        return explode('/', $this->uri);
    }
}
