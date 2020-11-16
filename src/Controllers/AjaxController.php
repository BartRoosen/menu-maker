<?php


namespace Controllers;

use Data\DishesDataHandler;
use Data\IngredientsDataHandler;
use Data\PreferenceDataHandler;
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

    public function setComplexityLevel()
    {
        if (isset($_POST, $_POST['day'], $_POST['level'])) {
            $preferenceDataHandler = new PreferenceDataHandler();
            $preferenceDataHandler->setComplexityLevel($_POST);

            echo json_encode(
                sprintf(
                    'The level for %s has been changed',
                    strtoupper($_POST['day'])
                )
            );
            die;
        }

        echo json_encode('Something went wrong while changing the complexity level...');
        die;
    }

    public function setMaxTime()
    {
        if (isset($_POST, $_POST['day'], $_POST['time'])) {
            $preferenceDataHandler = new PreferenceDataHandler();
            $preferenceDataHandler->setNewMaxTime($_POST);

            echo json_encode(
                sprintf(
                    'The max time for %s has been changed',
                    strtoupper($_POST['day'])
                )
            );
            die;
        }

        echo json_encode('Something went wrong while changing the time...');
        die;
    }

    public function deleteDish()
    {
        if (isset($_POST, $_POST['id'])) {
            $dishesDataHandler = new DishesDataHandler();
            $dishesDataHandler->deleteDish($_POST);

            echo json_encode('This dish has been removed successfully');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function deleteIngredientFromDish()
    {
        if (isset($_POST, $_POST['id'])) {
            $dishesDataHandler = new DishesDataHandler();
            $dishesDataHandler->deleteIngredientFromDish($_POST);

            echo json_encode('This ingredient has been removed successfully');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function addIngredientToDish()
    {
        if (isset($_POST, $_POST['dishId'], $_POST['ingredientId'], $_POST['amount'], $_POST['unit'])) {
            $dishesDataHandler = new DishesDataHandler();
            $dishesDataHandler->addIngredientToDish($_POST);

            echo json_encode('This ingredient has been added successfully');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }
}
