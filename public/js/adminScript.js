$(document).ready(function () {
    $(document).on('click','.add-select',function () {
       var  see = $('.select-form-op:first').clone();
       see.removeClass('hide').insertBefore('#register-product');
    })
    $(document).on('change','.details_value',function () {
            var that = $(this);
            if(that.val() !=0) {
                $.ajax({
                    type: "POST",
                    url: '/eachDetailVal',
                    data: {'_token': $('#ss input[name=_token]').val(), 'detail': that.val()},
                    dataType: 'json',
                    success: function (data) {
                        var option_string = '';
                        for (var i = 0; i < data.detailsValue.length; i++) {
                            option_string += '<option value="' + data.detailsValue[i].id + '">' + data.detailsValue[i].value + '</option>';
                        }
                       that.parents('.select-form-op').find('.value_container').html(option_string);
                       that.parents('.select-form-op').find('.value_container').parents('.form-group').removeClass('hide');
                    }
                });
            }else{
                that.parents('.select-form-op').find('.value_container').parents('.form-group').addClass('hide');
                that.parents('.select-form-op').find('.value_container option').remove();
            }
        })


})