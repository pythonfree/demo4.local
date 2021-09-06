<div class="album py-5 bg-light">
    <div class="container">
        <div class="row" id="product-row">
            {% for item in products %}
                <div class="col-md-4" data-id="{{item.id}}">
                    <div class="card mb-4 shadow-sm">
                        <div class="cart-images">
                            <img src="/{{item.images}}">
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{item.name}}<p>

                            <p class="card-text">{{item.description}}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="#" data-id="{{item.id}}" data-price="{{item.price}}" class="add-basket btn btn-sm btn-outline-secondary">add basket</a>
                                    </div>
                                <small class="text-muted">{{item.price}} руб.</small>
                            </div>
                        </div>
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary btn-lg" id="load-product">Показать еще</a>
            </div>
        </div>
    </div>
</div>
