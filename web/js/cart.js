// url: '/e-shop/web/cart/{name}'

function showCart(cart){
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}

$('#getCart').on('click', function (e){
    e.preventDefault();
    $.ajax({
        url: '/e-shop/web/en/cart/show',
        type: 'GET',
        success: function (res){
            if(!res)
                alert('Ошибка');
            //console.log(res);
            showCart(res);
        },
        error: function (){
            alert('Error');
        }
    });
});

$('.add-to-cart').on('click', function (e){
    e.preventDefault();
    let id = $(this).data('id'),
        qty = $('#qty').val();
    $.ajax({
        url:  '/e-shop/web/en/cart/add',
        data: {
            id: id,
            qty: qty
        },
        type: 'GET',
        success: function (res){
            if(!res)
                alert('Ошибка');
            //console.log(res);
            showCart(res);
        },
        error: function (){
            alert('Error');
        }
    });
});

$('#clear').on('click', function(){ // clear cart
    $.ajax({
        url: '/e-shop/web/en/cart/clear',
        type: 'GET',
        success: function (res){
            if(!res)
                alert("Ошибка");

            showCart(res);
        },
        error: function (){
            alert("Error");
        }
    });
});

$('#cart .modal-body').on('click', '.del-item', function (){
    let id = $(this).data('id');
    $.ajax({
        url: '/e-shop/web/en/cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res){
            if(!res)
                alert("Ошибка");
            showCart(res);
        },
        error: function (){
            alert("Error");
        }
    });
});