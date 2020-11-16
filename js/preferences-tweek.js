// variables

var selects = $('.selects'), inputs = $('.inputs');

// document ready

$(document).ready(function () {
    let tweeker = new Tweeker();

    tweeker.complexityLevelChanger();
    tweeker.maxTimeChanger();
});

// classes

class Tweeker
{
    complexityLevelChanger = function () {
        return selects.on('change', function () {
            let self = $(this),
                value = self.val(),
                day = self.data('day'),
                data = {
                    day: day,
                    level: value
                };

            $.ajax({
                type: 'POST',
                data: data,
                url: './setComplexityLevel/',
                dataType: 'json',
                success: function (response) {
                    showMessage(response);
                }
            });
        });
    };

    maxTimeChanger = function () {
        return inputs.on('change', function () {
            let self = $(this), day = self.data('day'), newTime = self.val(),
                data = {day: day, time: newTime};

            $.ajax({
                type: 'POST',
                data: data,
                url: './setMaxTime/',
                dataType: 'json',
                success: function (response) {
                    showMessage(response);
                }
            });
        });
    };
}