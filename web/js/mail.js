$(document).ready(function (){
    $('#city-dropdown').change(function (){
        let cityId = $(this).val();
        console.log(`It is city id - ${cityId}`);
        $.ajax({
            url: '/e-shop/web/en/cart/mail',
            method: 'GET',
            data: {cityId: cityId},
            dataType: 'json',
            success: function (data){
                console.log('Id is get post');
                $('#mail-name').val('');
                $('#mail-name').attr('placeholder', 'Введіть відділ...');

                console.log(data.mails);

                if(data.mails.length > 0){
                    /*$('#mail-name').autocomplete({
                        source: data.mails,
                        minLength: 0
                    });*/
                    let options = '';
                    data.mails.forEach(function (mail){
                        options += '<option value ="' + mail['name'] + '">';
                    });

                    $('#mail').html(options);
                } else {
                    $('#mail-name').attr('placeholder', 'Введіть відділ та вулицю');
                }
            },
            error: function (error){
                console.error(error);
            }
        });
    });
});