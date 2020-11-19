<?php


namespace Controllers;


use Config\Config;
use Data\DishesDataHandler;
use Data\MenuDataHandler;

class MenuMakerController extends AbstractController
{
    /** @var MenuDataHandler */
    private $menuDataHandler;

    /** @var DishesDataHandler */
    private $dishesDataHandler;

    /**
     * MenuMakerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->menuDataHandler   = new MenuDataHandler();
        $this->dishesDataHandler = new DishesDataHandler();
    }

    public function index()
    {
        return $this->twigService->render('menu-maker/index.html.twig', [
            'base_path' => $this->basePath,
            'title'     => Config::SITE_NAME,
            'pageName'  => 'menu maker',
            'menuItems' => $this->menuItems,
            'days'      => $this->menuDataHandler->getMenu(),
            'dishes'    => $this->dishesDataHandler->getAllDishes(),
            'today'     => date('Y-m-d'),
        ]);
    }
}