var inspirationDiv = $('.inspiration'),
    linkContainer = $('.link-container'),
    inspirationCaption = $('.inspiration-caption'),
    animationSpeed = 100;

$('body').on('click', '.action-button', function () {
    let self = $(this),
        action = self.data('action');

    switch (action) {
        case 'remove-inspiration':
            removeInspiration(self);
            break;
        case 'change-view':
            switchView(self.data('target'));
            break;
        case 'add-inspiration-as-dish':
            addInspirationAsDish(self);
            break;
        case 'save-inspiration':
            saveInspiration(self);
            break;
        default:
            break;
    }
});

saveInspiration = function (button) {
    $.ajax({
        type: 'POST',
        data: {
            name: $(button.data('target_name')).val(),
            link: $(button.data('target_link')).val(),
            picture: $(button.data('target_picture')).val()
        },
        url: './save-inspiration/',
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

addInspirationAsDish = function (button) {
    $.ajax({
        type: 'POST',
        data: {name: button.data('name')},
        url: './add-inspiration-as-dish/',
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

switchView = function (target) {
    $('.inspiration-view').hide();
    $(target).show();
};

removeInspiration = function (button) {
    if (confirm('You are about to remove an inspiration, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {id: button.data('id')},
            url: './remove-inspiration/',
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

inspirationDiv.on('mouseenter', function () {
    let self = $(this),
        captionTarget = self.data('caption_target'),
        linkTarget = self.data('link_target');

    $(captionTarget).animate({marginTop: '0em'}, animationSpeed);
    $(linkTarget).animate({marginTop: '-3em'}, animationSpeed);
});

inspirationDiv.on('mouseleave', function () {
    linkContainer.animate({marginTop: '20em'}, animationSpeed);
    inspirationCaption.animate({marginTop: '-10em'}, animationSpeed);
});