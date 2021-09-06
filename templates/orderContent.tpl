{% if status != 'error' and status != 'success' %}
<form action="/order/create/" method="post">
    <div class="container">
        <div class="col mb-12">
                <div class="form-group">
                    <label for="address">Укажите ваш адрес</label>
                    <br>
                    <input type="text" name="address" class="form-control" id="address" required>
                </div>
        </div>
        <div class="col mb-12">
            <div class="row">
                <div class="text-right" style="width: 85%;">
                    <button type="submit" class="btn btn-lg btn-success text-uppercase">Далее</button>
                </div>
            </div>
        </div>
    </div>
</form>
{% endif %}

{% if status == 'error' %}
<div class="alert alert-warning" role="alert">
    Произошла ошибка при оформлении заказа!
</div>

<div class="container-fluid text-center">
    <a href="/basket/" class="btn btn-primary">Попробовать еще раз!</a>
</div>
{% endif %}


{% if status == 'success' %}
<div class="alert alert-success" role="alert">
    Ваш заказ успешно оформлен!
</div>

<div class="container-fluid text-center">
    <a href="/cabinet/" class="btn btn-primary">Личный кабинет</a>
</div>
{% endif %}