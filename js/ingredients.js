$('body').on('click', '.action-button', function () {
    let self = $(this),
        action = self.data('action');

    switch (action) {
        case 'open-filter-line':
            categoryFilterLine.show();
            break;
        case 'open-add-ingredient-form-line':
            addIngredientFormLine.show();
            break;
        case 'close-add-ingredient-form-line':
            addIngredientFormLine.hide();
            break;
        case 'save-new-ingredient':
            saveNewIngredient();
            break;
        case 'delete-ingredient':
            deleteIngredient(self);
            break;
        case 'open-edit-ingredient-form-line':
            $(self.data('target_open')).show();
            $(self.data('target_close')).hide();
            break;
        case 'cancel-edit-form-line':
            $(self.data('target_open')).show();
            $(self.data('target_close')).hide();
            break;
        case 'save-changes':
            saveChanges(self);
            break;
        default:
            break;
    }
});

saveChanges = function (button) {
    let data = {
        ingredientName: $(button.data('target_name')).val(),
        category: $(button.data('target_category')).val(),
        id: button.data('id')
    };
    $(button.data('target_spinner')).show();
    $(button.data('target_close')).hide();

    saveIngredient(data);
};

saveNewIngredient = function () {
    let data = {
            ingredientName: $('#ingredient-name').val(),
            category: $('#form-category-select').val(),
            id: 0
        };

    saveIngredient(data);
};

saveIngredient = function (data) {

    $.ajax({
        type: 'POST',
        data: data,
        url: './add-new-ingredient/',
        dataType: 'json',
        success: function (response) {
            showMessage(response);
        },
    }).done(function () {
        setTimeout(function () {
            window.location = window.location.href;
        }, 1500);
    });
};

deleteIngredient = function (button) {
    if (confirm('You are about to delete this ingredient, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {ingredientId: button.data('ingredient_id')},
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
};