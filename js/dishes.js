var buttons = $('.action-button'),
    clearButton = $('.clear-button');

clearButton.on('click', function (e) {
    e.preventDefault();
    $('#input_text_id').val(0);
    $('#input_text_name').val('');
    $('#select_complexity').val(1);
    $('#input_text_time').val('');
    $('#form_title').html('Add dish');
    $('#submit-caption').html('Add dish');
});

buttons.on('click', function () {
    let self = $(this),
        action = self.data('action');

    switch (action) {
        case 'delete':
            deleteLine(self);
            break;
        case 'edit':
            editDish(self);
            break;
        case 'add-ingredients':
            addIngredientsPage(self)
            break;
        default:
            break;
    }
});

addIngredientsPage = function(button) {
    window.location.href = './add-ingredients/' + button.data('id');
};

editDish = function(button) {
    $('#input_text_id').val(button.data('id'));
    $('#input_text_name').val(button.data('name'));
    $('#select_complexity').val(button.data('complexity'));
    $('#input_text_time').val(button.data('time'));
    $('#form_title').html('Edit dish');
    $('#submit-caption').html('Update dish');
};

deleteLine = function (button) {
    if (confirm('You are about to delete a dish, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {id: button.data('id')},
            url: './delete-dish/',
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
};