var body = $('body'),
    formModal = $('.form-modal'),
    wrongDate = $('#wrong-date'),
    dateSelector = $('#date-selector'),
    possibleDishes = $('#posible-dishes');

body.on('click', '.action-button', function () {
    let self = $(this),
        action = self.data('action');

    switch (action) {
        case 'open-form':
            $(self.data('form_id')).show();
            $(self.data('view_id')).hide();
            break;
        case 'open-form-modal':
            formModal.show();
            break;
        case 'cancel':
            formModal.hide();
            break;
        case 'delete':
            deleteMenuItem(self.data('id'));
            break;
        default:
            break;
    }
});

deleteMenuItem = function (id) {
    if (confirm('You are about to delete a menu item, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: './delete-menu-item/',
            dataType: 'json',
            success: function (response) {
                showMessage(response);
            },
        }).done(function () {
            setTimeout(function () {
                window.location = window.location.href;
            }, 1500);
        });
    }
};

$('.dish-select').on('change', function () {
    let self = $(this),
        id = self.data('id'),
        selectOption = '#select_' + id + ' option:selected';

    $.ajax({
        type: 'POST',
        data:
            {
                id: self.data('id'),
                dishId: self.val()
            },
        url: './change-menu-of-the-day/',
        dataType: 'json',
        success: function (response) {
            showMessage(response.message);
        },
    }).done(function () {
        setTimeout(function () {
            $('#view_' + id).html($(selectOption).text());
            $('.list_views').show();
            $('.list_forms').hide();
        }, 1500);
    });
});

dateSelector.on('change', function () {
    wrongDate.hide();
    possibleDishes.html('');

    let date = $(this).val();

    $.ajax({
        type: 'POST',
        data: {date: date},
        url: './check-for-existing-date/',
        dataType: 'json',
        success: function (response) {
            // showMessage(response.message);

            if (!response) {
                wrongDate.show();
                dateSelector.val('');
            } else {
                $('#day-indicator').html(response.day);
                if (null !== response.dishes) {
                    $.each(response.dishes, function (key, name) {
                        let dish = '<div class="dish-selector" data-id="' + key + '" data-date="' + date + '">' + name + '</div>';
                        possibleDishes.append(dish);
                    });
                }
            }
        },
    });
});

body.on('click', '.dish-selector', function () {
    let self = $(this),
        data = {
            dishId: self.data('id'),
            date: self.data('date')
        };

    $.ajax({
        type: 'POST',
        data: data,
        url: './add-menu-item/',
        dataType: 'json',
        success: function (response) {
            showMessage(response);
        },
    }).done(function () {
        setTimeout(function () {
            window.location = window.location.href;
        }, 1500);
    });
});