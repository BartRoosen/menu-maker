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
        default:
            break;
    }
});

$('.dish-selector').on('change', function () {
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
        }, 2000);
    });
});

dateSelector.on('change', function () {
    wrongDate.hide();
    possibleDishes.html('');
    $.ajax({
        type: 'POST',
        data: {date: $(this).val()},
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
                        let dish = '<div class="dish-selector" data-id="' + key + '">'+ name +'</div>';
                        possibleDishes.append(dish);
                    });
                }
            }
        },
    });
});

body.on('click', '.dish-selector', function () {
    let id = $(this).data('id');

    alert('good choice : ' + id);
});