<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>

    <!-- Bootstrap & jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">My Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                        Cart <span class="badge bg-primary" id="cart-count">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Product List -->
<div class="container my-5">
    <div class="row" id="product-list"></div>
</div>

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cart Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cart-items">
                <!-- Cart items will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AJAX Script -->
<script>
$(document).ready(function () {

    // Load products
    function loadProducts() {
        $.ajax({
            url: "/api/products",
            method: "GET",
            success: function (res) {
                if (res.status) {
                    let html = '';
                    $.each(res.data, function (i, product) {
                        html += `
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="/${product.image}" class="card-img-top" alt="${product.name}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="card-text">$${product.price}</p>
                                        <button class="btn btn-success mt-auto add-to-cart" 
                                            data-name="${product.name}" data-price="${product.price}">Add to Cart</button>
                                    </div>
                                </div>
                            </div>`;
                    });
                    $('#product-list').html(html);
                }
            }
        });
    }

    // Load cart
    function loadCart() {
        $.ajax({
            url: "/api/cart_items", // You should add this route in backend to fetch cart items
            method: "GET",
            success: function (res) {
                if (res.status) {
                    let html = '';
                    $.each(res.data, function (i, item) {
                        html += `
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <strong>${item.name}</strong> - $${item.price}
                                </div>
                                <button class="btn btn-danger btn-sm delete-cart-item" data-id="${item.id}">Remove</button>
                            </div>`;
                    });
                    $('#cart-items').html(html);
                    $('#cart-count').text(res.data.length);
                }
            }
        });
    }

    // Add to cart
    $(document).on('click', '.add-to-cart', function () {
        const name = $(this).data('name');
        const price = $(this).data('price');

        $.ajax({
            url: "/api/add_to_cart",
            method: "POST",
            data: {
                name: name,
                price: price,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (res.status) {
                    loadCart();
                } else {
                    alert("Failed to add to cart");
                }
            },
            error: function () {
                alert("Error adding to cart.");
            }
        });
    });

    // Delete from cart
    $(document).on('click', '.delete-cart-item', function () {
        const id = $(this).data('id');

        $.ajax({
            url: "/api/delete_from_cart",
            method: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (res.status) {
                    loadCart();
                } else {
                    alert("Failed to delete from cart");
                }
            },
            error: function () {
                alert("Error deleting item from cart.");
            }
        });
    });

    // Initial Load
    loadProducts();
    loadCart();
});
</script>

</body>
</html>
