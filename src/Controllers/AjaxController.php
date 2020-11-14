<?php


namespace Controllers;

use Data\IngredientsDataHandler;
use Services\SessionService;

class AjaxController extends AbstractController
{
    public function setCategory()
    {
        if (isset($_POST, $_POST['category']) && '' !== $_POST['category']) {
            $sessionService = new SessionService();
            $sessionService->setValue(['category' => $_POST['category']]);

            echo json_encode('success');
            die;
        }

        echo json_encode('fail');
        die;
    }

    public function deleteIngredient()
    {
        if (isset($_POST, $_POST['ingredientId']) && '' !== $_POST['ingredientId']) {
            $ingredientsDataHandler = new IngredientsDataHandler();
            $ingredientsDataHandler->deleteIngredient($_POST['ingredientId']);

            echo json_encode('success');
            die;
        }

        echo json_encode('fail');
        die;
    }
}
