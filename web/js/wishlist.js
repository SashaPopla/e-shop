$('.add-wishlist').on('click', function (e){
   e.preventDefault();
    let id = $(this).data('id');
   $.ajax({
       url: '/e-shop/web/wishlist/add-wishlist',
       type: 'GET',
       data: {id: id},
       success: function (res){
           if(!res)
               return alert("Ошибка");
           console.log(res);
       },
       error: function (){
           alert('Error');
       }
   });
});