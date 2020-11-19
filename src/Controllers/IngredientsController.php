<?php


namespace Controllers;


use Config\Config;
use Data\IngredientsDataHandler;
use Services\PostService;

class IngredientsController extends AbstractController
{
    /** @var IngredientsDataHandler */
    private $ingredientsDataHandler;

    /** @var PostService */
    private $postService;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ingredientsDataHandler = new IngredientsDataHandler();
        $this->postService            = new PostService();
    }

    public function index()
    {
        if ($this->postService->checkPostRequest(['id', 'ingredientName', 'category'])) {
            $this->ingredientsDataHandler->addNewIngredient($_POST);
            $this->redirect('./ingredients');
        }
        $category = (int)$this->sessionService->getValue('category');
        return $this->twigService->render('ingredients/index.html.twig', [
            'base_path'   => $this->basePath,
            'title'       => Config::SITE_NAME,
            'pageName'    => 'ingredients',
            'menuItems'   => $this->menuItems,
            'ingredients' => $this->ingredientsDataHandler->getAllIngredients(),
            'categories'  => $this->ingredientsDataHandler->getCategories(),
            'category'    => $category,
        ]);
    }
}