$(document).ready(function () {

    $(document).on('change','.filters-options,.metadata-on',function () {
            $(this).parents('form').trigger('submit');
    })
})