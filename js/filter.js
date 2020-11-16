$(document).ready(function () {
    setFilter();
});

function setFilter() {
    if (0 !== category) {
        select.val(category);
        categoryFilter.val(category).trigger('change');
    }
}

categoryFilter.on('change', function () {
    let self = $(this),
        value = self.val(),
        rows = $('.table-row'),
        affectedRows = $('.' + value);
    rows.hide();

    if (0 === parseInt(value)) {
        rows.show();
    } else {
        affectedRows.show();
        select.val(value);
    }

    $.ajax({
        type: 'POST',
        data: {category: value},
        url: './setcategory/',
        dataType: 'json',
        success: function () {
            // window.location = window.location.href;
        }
    })
});
