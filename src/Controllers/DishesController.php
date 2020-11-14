<?php


namespace Controllers;


use Config\Config;
use Data\DishesDataHandler;
use Services\PostService;

class DishesController extends AbstractController
{
    const TITLE = 'MENU CREATOR';

    /** @var DishesDataHandler */
    private $dishesDataHandler;

    /** @var PostService */
    private $postService;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->dishesDataHandler = new DishesDataHandler();
        $this->postService       = new PostService();
    }

    public function index()
    {
        if ($this->postService->checkPostRequest(['name', 'complexity', 'time'])) {
            $this->dishesDataHandler->addDish($_POST);
            $this->redirect('./dishes');
        }

        return $this->twigService->render('dishes/index.html.twig', [
            'base_path'    => $this->basePath,
            'title'        => Config::SITE_NAME,
            'menuItems'    => $this->menuItems,
            'dishes'       => $this->dishesDataHandler->getAllDishes(),
            'complexities' => $this->dishesDataHandler->getComplexity(),
        ]);
    }
}