<?php


namespace Controllers;


use Config\Config;
use Data\PreferenceDataHandler;
use Data\SettingsDataHandler;
use Data\UnitDataHandler;
use Services\PostService;

class SettingsController extends AbstractController
{
    /** @var SettingsDataHandler */
    private $settingDataHandler;

    /** @var PreferenceDataHandler */
    private $preferenceDataHandler;

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
        $this->settingDataHandler    = new SettingsDataHandler();
        $this->preferenceDataHandler = new PreferenceDataHandler();
        $this->unitsDataHandler      = new UnitDataHandler();
        $this->postService           = new PostService();
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
            'preferences'  => $this->preferenceDataHandler->getPreferences(),
            'units'        => $this->unitsDataHandler->getUnits(),
        ]);
    }
}