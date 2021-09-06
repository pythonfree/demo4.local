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
                </div>
                <small class="text-muted">{{item.price}} руб.</small>
            </div>
        </div>
    </div>
</div>
{% endfor %}