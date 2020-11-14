<?php


namespace Controllers;


use Config\Config;

class HomeController extends AbstractController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->twigService->render('home/index.html.twig', [
            'base_path' => $this->basePath,
            'title'     => Config::SITE_NAME,
            'menuItems' => $this->menuItems,
        ]);
    }
}