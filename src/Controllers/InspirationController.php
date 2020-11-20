<?php


namespace Controllers;


use Config\Config;
use Data\DishesDataHandler;
use Data\InspirationDataHandler;
use Entities\Dish;

class InspirationController extends AbstractController
{
    /** @var InspirationDataHandler */
    private $inspirationDataHandler;

    /** @var DishesDataHandler */
    private $dishesDataHandler;

    public function __construct()
    {
        parent::__construct();
        $this->inspirationDataHandler = new InspirationDataHandler();
        $this->dishesDataHandler      = new DishesDataHandler();
    }

    public function index()
    {
        $dishNames = null;
        $dishes    = $this->dishesDataHandler->getAllDishes();

        if (null !== $dishes) {
            foreach ($dishes as $dish) {
                if ($dish instanceof Dish) {
                    $dishNames[] = $dish->getName();
                }
            }
        }

        return $this->twigService->render('inspiration/index.html.twig', [
            'base_path'    => $this->basePath,
            'title'        => Config::SITE_NAME,
            'pageName'     => 'inspiration',
            'menuItems'    => $this->menuItems,
            'inspirations' => $this->inspirationDataHandler->getAllInspirations(),
            'dishNames'    => $dishNames,
        ]);
    }
}
