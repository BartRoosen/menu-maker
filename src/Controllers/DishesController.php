<?php


namespace Controllers;


use Config\Config;
use Data\DishesDataHandler;
use Data\IngredientsDataHandler;
use Data\UnitDataHandler;
use Services\PostService;

class DishesController extends AbstractController
{
    const TITLE = 'MENU CREATOR';

    /** @var DishesDataHandler */
    private $dishesDataHandler;

    /** @var IngredientsDataHandler */
    private $ingredientsDataHandler;

    /** @var UnitDataHandler */
    private $unitsDataHandler;

    /** @var PostService */
    private $postService;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->dishesDataHandler      = new DishesDataHandler();
        $this->ingredientsDataHandler = new IngredientsDataHandler();
        $this->unitsDataHandler       = new UnitDataHandler();
        $this->postService            = new PostService();
    }

    public function index()
    {
        if ($this->postService->checkPostRequest(['id', 'name', 'complexity', 'time'])) {
            if (0 === (int)$_POST['id']) {
                $this->dishesDataHandler->addDish($_POST);
            } else {
                $this->dishesDataHandler->updateDish($_POST);
            }

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

    public function addIngredients($dishId)
    {
        return $this->twigService->render('dishes/add-ingredients.html.twig', [
            'base_path'   => $this->basePath,
            'title'       => Config::SITE_NAME,
            'menuItems'   => $this->menuItems,
            'dish'        => $this->dishesDataHandler->getDishById($dishId),
            'ingredients' => $this->ingredientsDataHandler->getIngredientsByDishId($dishId),
            'notSelected' => $this->ingredientsDataHandler->getNonSelectedIngredientsByDishId($dishId),
            'categories'  => $this->ingredientsDataHandler->getCategories(),
            'category'    => (int)$this->sessionService->getValue('category'),
            'dishId'      => $dishId,
            'units'       => $this->unitsDataHandler->getUnits(),
        ]);
    }
}