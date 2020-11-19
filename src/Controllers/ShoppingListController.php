<?php


namespace Controllers;


use Config\Config;

class ShoppingListController extends AbstractController
{
    /**
     * ShoppingListController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->twigService->render('shopping-list/index.html.twig', [
            'base_path' => $this->basePath,
            'title'     => Config::SITE_NAME,
            'pageName'  => 'shopping list',
            'menuItems' => $this->menuItems,
        ]);
    }
}