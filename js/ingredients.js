editButton.on('click', function () {
    let self = $(this),
        ingredientId = self.data('ingredient_id'),
        categoryId = self.data('category_id'),
        ingredientName = self.data('ingredient_name'),
        textIngredientId = $('#ingredient-id'),
        textIngredientName = $('#ingredient-name'),
        selectCategory = $('#form-category-select');

    textIngredientId.val(ingredientId);
    textIngredientName.val(ingredientName);
    selectCategory.val(categoryId);
});

deleteButton.on('click', function () {
    let self = $(this),
        ingredientId = self.data('ingredient_id');

    if (confirm('You are about to delete this ingredient, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {ingredientId: ingredientId},
            url: './delete-ingredient/',
            dataType: 'json',
            success: function (response) {
                if ('success' === response) {
                    window.location = window.location.href;
                } else {
                    alert('Something went wrong, please try again...');
                }
            }
        });
    }
});