(function(){
    $(document).ready(function ()
    {
        var selectElement;
        var totalHtml;
        var countTr;
        $('.add-basket').click(function (e) {
            var idProduct = $(this).data('id');
            console.log(idProduct);
            addBasket(idProduct);
        });


        $('.delete-basket').click(function (e) {
            var idProduct = $(this).data('id');
            totalHtml = $('#total');
            selectElement = $(this).parents('tr')[0];
            deleteBasket(idProduct);
        });

        function addBasket(id) {
            $.get( '/basket/?action=addBasket&id='+id+'', function( data ) {
                if(data){
                    alert('товар успешно добавлен в корзину!');
                }else{
                    alert('произошла ошибки при добавлении в корзину!');
                }
            });
        }

        function deleteBasket(id) {
            $.get( '/basket/?action=deleteBasketId&id='+id+'', function( data ) {
                if(data){
                    selectElement.remove();
                    countTr =  $('.product-basket > tr').length;
                    if(countTr === 0){
                        $('.product-basket').append('<tr> <td colspan="5">Корзина пуста!</td> </tr>');
                    }
                    getTotalSum();
                }else{
                    alert('произошла ошибки при удалении корзины!');
                }
            });
        }


        function getTotalSum() {
            $.get( '/basket/?action=getTotalSum', function( data ) {

                console.log(data);

                if(data){
                    totalHtml.html(data+' руб.');
                }else{
                    alert('произошла ошибки при получении данных!');
                }
            });
        }

    });
})();
