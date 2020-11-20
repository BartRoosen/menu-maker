var editModal = $('#edit-modal'),
    changeId = '',
    addUnitForm = $('#add-unit-form');


$('body').on('click', '.action-button', function () {
    let self = $(this),
        action = self.data('action'),
        id = self.data('id');

    switch (action) {
        case 'edit':
            let data = {
                modal: editModal,
                id: id,
                name: self.data('name')
            };
            editUnit(data);
            break;
        case 'delete':
            deleteUnit(id);
            break;
        case 'save-changes':
            saveChanges();
            break;
        case 'open-new-unit-form':
            addUnitForm.show();
            $('#new-unit-name').focus();
            break;
        case 'cancel-new-unit':
            addUnitForm.hide();
            break;
        case 'save-new-unit':
            saveNewUnit();
            break;
        case 'cancel-edit':
            editModal.hide();
            break;
        default:
            break;
    }
});

saveNewUnit = function () {
    let newId = null,
        newName = $('#new-unit-name').val();

    $.ajax({
        type: 'POST',
        data: {name: newName},
        url: './save-new-unit/',
        dataType: 'json',
        success: function (response) {
            showMessage(response.message);
            newId = response.id;
        },
    }).done(function () {
        setTimeout(function () {
            addUnitForm.hide();
            addLineToTable({id: newId, name: newName});
        }, 1500);
    });
};

addLineToTable = function (values) {
    let line = '<tr>' +
        '<td>' + values.id + '</td>' +
        '<td id="unit_' + values.name + '_' + values.id + '">' + values.name + '</td>' +
        '<td class="text-right"><span class="badge badge-info">New unit</span></td>' +
        '</tr>';
    $('#units-table').append(line);
};

saveChanges = function () {
    let data = {
        id: $('#unit-id').val(),
        name: $('#unit-name').val()
    };

    $.ajax({
        type: 'POST',
        data: data,
        url: './update-unit/',
        dataType: 'json',
        success: function (response) {
            showMessage(response);
        },
    }).done(function () {
        setTimeout(function () {
            $(changeId).html(data.name);
            editModal.hide();
        }, 1500);
    });

};

deleteUnit = function (id) {
    if (confirm('You are about to delete a unit, are you sure?')) {
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: './delete-unit/',
            dataType: 'json',
            success: function (response) {
                showMessage(response);
            },
        }).done(function () {
            setTimeout(function () {
                $('#line_' + id).remove();
            }, 1500);
        });
    }
};

editUnit = function (data) {
    $('#unit-id').val(data.id);
    $('#unit-name').val(data.name);
    changeId = '#unit_' + data.name + '_' + data.id;
    data.modal.show();
};