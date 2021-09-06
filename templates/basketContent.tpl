<div class="container">
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td class="text-right"><strong id="total">{{total}} руб.</strong></td>
                        </tfoot>
                        <tbody class="product-basket">
                        {% if basket %}
                             {% for item in basket %}
                                <tr>
                                    <td><img src="/{{item.images}}" style="height: 50px;width: 50px;object-fit: cover;"/> </td>
                                    <td>{{item.name}}</td>
                                    <td><input class="form-control" type="text" value="{{item.count}}" readonly=""/></td>
                                    <td class="text-right">{{item.price}}</td>
                                    <td class="text-right"><button class="btn btn-sm btn-danger delete-basket" data-id="{{item.id}}"><i class="fa fa-trash"></i> </button> </td>
                                </tr>
                             {% endfor %}
                        {% else %}
                            <tr>
                                <td colspan="5">Корзина пуста!</td>
                            </tr>
                        {% endif %}
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="text-right" style="width: 100%">
                    {% if auth and basket %}
                            <a href="/order/"  class="btn btn-lg btn-success text-uppercase">Далее</a>
                    {% elseif auth and basket == false %}
                         <a href="/product/" class="btn btn-lg btn-success text-uppercase">Продукты</a>
                    {% else %}
                        <a href="/autorisation/login/"  class="btn btn-lg btn-success text-uppercase">Вход</a>
                    {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>