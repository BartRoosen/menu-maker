<?php


namespace Controllers;


use Config\Config;

class InspirationController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->twigService->render('inspiration/index.html.twig', [
            'base_path' => $this->basePath,
            'title'     => Config::SITE_NAME,
            'pageName'  => 'inspiration',
            'menuItems' => $this->menuItems,
        ]);
    }
}
