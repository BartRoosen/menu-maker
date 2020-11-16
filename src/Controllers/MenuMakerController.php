<?php


namespace Controllers;


use Config\Config;

class MenuMakerController extends AbstractController
{
    /**
     * MenuMakerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->twigService->render('menu-maker/index.html.twig', [
            'base_path' => $this->basePath,
            'title'     => Config::SITE_NAME,
            'menuItems' => $this->menuItems,
        ]);
    }
}