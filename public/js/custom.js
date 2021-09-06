$('document').ready(function () {

var divProduct = $('#product-row');
var loadProductButton = $('#load-product');
var nextPage;

loadProductButton.click(function (e) {
    e.preventDefault();
    var lastElement = $('#product-row .col-md-4').last();
    var lastElementId = $(lastElement[0]).attr('data-id');
    send(nextPage,lastElementId)
});


//Авторизация

function send(data,lastId) {
    $.ajax({
        data:{action:'pagination',nextPage:data,lastId:lastId},
        dataType : 'json',
        method:'GET',
        asyns:false,
        success: function (e)
        {
            if(e.html.length <= 0){
                //Удаляем кнопку если получили все
                loadProductButton.remove();
            }
            else {
                divProduct.append(e.html);
            }
        },
        error:function (e) {
            alert('Произошла ошибка при передаче на сервер!');
        }
    });
}


    $('#login').submit(function (e) {
        e.preventDefault();
        login();
    });


    function login() {

        const login_input = $('[name="login"]');
        const password_input = $('[name="password"]');

        const login = login_input.val();
        const password = password_input.val();

        const message_field = $('.message');

        $.post({
            url: '/autorisation/?action=auth',
            data: {
                login: login,
                password: password
            },
            success: function (data) {
               if(data.error) {
                    message_field.empty();
                    message_field.append('<div style="margin:15px 20px" class="alert alert-danger" role="alert">'+data.text+'</div>');
                } else {
                    message_field.empty();
                    document.location.href = "/cabinet/";
                }
            }
        });
    }


    $('#register').submit(function (e) {
        e.preventDefault();
        register();
    });

    function register() {

        const name_input = $('[name="name"]');
        const login_input = $('[name="login"]');
        const password_input = $('[name="password"]');


        const name = name_input.val();
        const login = login_input.val();
        const password = password_input.val();


        const message_field = $('.message');


        $.post({
            url: '/autorisation/?action=create',
            data: {
                name: name,
                login: login,
                password: password,
            },
            success: function (data) {
                if(data.error){
                    message_field.empty();
                    message_field.append('<div style="margin:15px 20px" class="alert alert-danger" role="alert">'+data.text+'</div>');
                }else{
                    message_field.empty();
                    document.location.href = "/autorisation/?action=login";
                }
            }
        });
    }


});