var viewPanes = $('.view-pane'),
    navButtons = $('.nav-button'),
    firstButton = $('#first');

$(document).ready(function () {
    let navigator = new Navigator();

    navigator.initNavigation();
    navigator.triggerFirstView();
});

class Navigator
{
    triggerFirstView = function () {
        firstButton.trigger('click');
    };

    initNavigation = function () {
        return navButtons.on('click', function () {
            let self = $(this), target = self.data('target');

            navButtons.removeClass('btn-warning').addClass('btn-outline-warning');
            self.removeClass('btn-outline-warning').addClass('btn-warning');
            viewPanes.hide();
            $(target).show();
        });
    };
}