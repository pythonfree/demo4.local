{% for item in gallery %}
<a href="?action=show&id={{item.id}}">
    <img src="/{{item.url_min_images}}" alt="image-{{item.id}}" style="max-width: 300px; max-height: 300px"/>
</a>
{% endfor %}