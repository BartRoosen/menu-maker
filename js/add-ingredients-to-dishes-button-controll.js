addIngredientToDishSaveButton.on('click', function () {
    let dishId = $('#form-input-dish-id').val(),
        ingredientId = $('#form-input-ingredient-id').val(),
        amount = $('#form-input-amount').val(),
        unit = $('#form-select-unit').val(),
        data = {
            dishId: dishId,
            ingredientId: ingredientId,
            amount: amount,
            unit: unit
        };

    $.ajax({
        type: 'POST',
        data: data,
        url: './add-ingredient-to-dish/',
        dataType: 'json',
        success: function (response) {
            showMessage(response);
        },
    }).done(function () {
        setTimeout(function () {
            window.location = window.location.href;
        }, 2000);
    });
});

addIngredientToDishButton.on('click', function () {
    let self = $(this),
        ingredientName = self.data('ingredient_name'),
        dishId = self.data('dish_id'),
        ingredientId = self.data('ingredient_id');

    $('#form-input-ingredient').val(ingredientName);
    $('#form-input-dish-id').val(dishId);
    $('#form-input-ingredient-id').val(ingredientId);
    $('.form-modal').show();
});

deleteIngredient.on('click', function () {
    let self = $(this),
        id = self.data('dish_ingredient_id');

    if (confirm('You are about to delete one ingredient, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: './delete-ingredient-from-dish/',
            dataType: 'json',
            success: function (response) {
                showMessage(response);
            },
        }).done(function () {
            setTimeout(function () {
                window.location = window.location.href;
            }, 2000);
        });
    }
});