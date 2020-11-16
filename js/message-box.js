showMessage = function (message, delay) {
    let messageBoxDiv = $('.message-box'),
        messageContainer = $('.message-container'),
        loading = $('.loading');

    loading.show();
    messageContainer.html(message);
    messageBoxDiv.show();
    messageBoxDiv.animate({
        opacity: 1
    }, 1000);
    hideMessage(messageBoxDiv, delay);
};

hideMessage = function (messageBoxDiv, delay = 2000) {
    setTimeout(function () {
        messageBoxDiv.animate({
            opacity: 0
        }, 1000);
        messageBoxDiv.hide();
    }, delay)
};