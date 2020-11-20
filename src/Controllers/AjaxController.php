<?php


namespace Controllers;

use Data\DishesDataHandler;
use Data\IngredientsDataHandler;
use Data\InspirationDataHandler;
use Data\MenuDataHandler;
use Data\PreferenceDataHandler;
use Data\UnitDataHandler;
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

    public function deleteUnit()
    {
        if (isset($_POST, $_POST['id']) && '' !== $_POST['id']) {
            $unitsDataHandler = new UnitDataHandler();
            $unitsDataHandler->deleteUnit($_POST);

            echo json_encode('The unit has been successfully deleted');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function updateUnit()
    {
        if (isset($_POST, $_POST['id'], $_POST['name']) && '' !== $_POST['id'] && '' !== $_POST['name']) {
            $unitsDataHandler = new UnitDataHandler();
            $unitsDataHandler->updateUnit($_POST);

            echo json_encode('The unit has been successfully changed');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function saveNewUnit()
    {
        if (isset($_POST, $_POST['name']) && '' !== $_POST['name']) {
            $unitsDataHandler = new UnitDataHandler();
            $id               = $unitsDataHandler->saveNewUnit($_POST);

            echo json_encode(
                [
                    'message' => 'The new unit has been saved successfully',
                    'id'      => $id,
                ]
            );
            die;
        }

        echo json_encode(
            [
                'message' => 'Something went wrong, please try again',
                'id'      => null,
            ]
        );
        die;
    }

    public function changeMenuOfTheDay()
    {
        if (isset($_POST, $_POST['id'], $_POST['dishId']) && '' !== $_POST['id'] && '' !== $_POST['dishId']) {
            $menuDataHandler = new MenuDataHandler();
            $menuDataHandler->changeMenuOfTheDay($_POST);

            echo json_encode(
                [
                    'message' => 'The menu for the day has been changed successfully',
                ]
            );
            die;
        }

        echo json_encode(
            [
                'message' => 'Something went wrong, please try again',
            ]
        );
        die;
    }

    public function checkForExistingDate()
    {
        if (isset($_POST, $_POST['date']) && '' !== $_POST['date']) {
            $menuDataHandler = new MenuDataHandler();
            if ($menuDataHandler->findExistingDate($_POST)) {
                // date doesn't exist
                // find out what day this is and gather dishes...
                $day = date('l', strtotime($_POST['date']));

                echo json_encode(
                    [
                        'day'    => $day,
                        'dishes' => $menuDataHandler->getPossibleDishesByDay($day),
                    ]
                );
                die;
            }
        }

        echo json_encode(false);
        die;
    }

    public function addMenuItem()
    {
        if (isset($_POST, $_POST['dishId'], $_POST['date']) && '' !== $_POST['dishId'] && '' !== $_POST['date']) {
            $menuDataHandler = new MenuDataHandler();

            if ($menuDataHandler->addMenuItem($_POST)) {

                echo json_encode('The menu item has been added successfully');
                die;
            }

            echo json_encode('Something went wrong, please try again');
            die;

        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function deleteMenuItem()
    {
        if (isset($_POST, $_POST['id']) && '' !== $_POST['id']) {
            $menuDataHandler = new MenuDataHandler();
            $menuDataHandler->deleteMenuItem($_POST);

            echo json_encode('The menu item is being removed...');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function AddNewIngredient()
    {
        if (
            isset($_POST, $_POST['id'], $_POST['ingredientName'], $_POST['category']) &&
            '' !== $_POST['id'] &&
            '' !== $_POST['ingredientName'] &&
            '' !== $_POST['category']
        ) {
            $ingredientDataHandler = new IngredientsDataHandler();
            $ingredientDataHandler->addNewIngredient($_POST);

            echo json_encode('The ingredient is being added...');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function removeInspiration()
    {
        if (isset($_POST, $_POST['id']) && '' !== $_POST['id']) {
            $inspirationDataHandler = new InspirationDataHandler();
            $inspirationDataHandler->removeInspiration($_POST);

            echo json_encode('The inspiration is being removed...');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function addInspirationAsDish()
    {
        if (isset($_POST, $_POST['name']) && '' !== $_POST['name']) {
            $dishDataHandler = new DishesDataHandler();
            $dishDataHandler->addInspirationAsDish($_POST);

            echo json_encode('The inspiration is being added to the list of dishes...');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }

    public function saveInspiration()
    {
        if (
            isset($_POST, $_POST['name'], $_POST['link'], $_POST['picture']) &&
            '' !== $_POST['name'] &&
            '' !== $_POST['link']
        ) {
            if ('' === $_POST['picture']) {
                $_POST['picture'] = null;
            }

            $inspirationDataHandler = new InspirationDataHandler();
            $inspirationDataHandler->saveInspiration($_POST);

            echo json_encode('The inspiration is being saved...');
            die;
        }

        echo json_encode('Something went wrong, please try again');
        die;
    }
}
