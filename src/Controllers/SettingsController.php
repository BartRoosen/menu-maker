<?php


namespace Controllers;


use Config\Config;
use Data\SettingsDataHandler;
use Services\PostService;

class SettingsController extends AbstractController
{
    const TITLE = 'MENU CREATOR';

    /** @var SettingsDataHandler */
    private $settingDataHandler;

    /** @var PostService */
    private $postService;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->settingDataHandler = new SettingsDataHandler();
        $this->postService        = new PostService();
    }

    public function index()
    {
        if ($this->postService->checkPostRequest(
            [
                'actionType',
                'name',
                'deleted',
            ]
        )) {
            if ('category' === $_POST['actionType']) {
                $this->settingDataHandler->addCategory($_POST);
            }

            if ('complexity' === $_POST['actionType']) {
                // add complexity to db
            }

            $this->redirect('./settings');
        }

        return $this->twigService->render('settings/index.html.twig', [
            'base_path'    => $this->basePath,
            'title'        => Config::SITE_NAME,
            'menuItems'    => $this->menuItems,
            'categories'   => $this->settingDataHandler->getAllCategories(),
            'complexities' => $this->settingDataHandler->getAllComplexities(),
        ]);
    }
}