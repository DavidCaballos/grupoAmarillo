<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/71b7145720.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #FFC107; 
        }
    </style>
</head>
<body>

@include('navbar')

<div class="container mt-5">
    <h2 class="mb-3">Shopping Cart</h2>

    <table id="cart" class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr rowId="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>
                        <td data-th="Quantity">{{ $details['quantity'] }}</td>
                        <td data-th="Total" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions">
                            <button class="btn btn-outline-danger btn-sm delete-product" data-id="{{ $id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total $<span id="total-price">{{ $total }}</span></strong></td>
                <input type="hidden" name="total" id="total" value="{{ $total }}">
                <td>
                    <a href="{{ route('shop') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <a href="{{ route('checkout') }}" class="btn btn-danger">Checkout</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    $(".delete-product").click(function (e) {
        e.preventDefault();

        var ele = $(this);
        var productId = ele.data("id");

        if(confirm("Do you really want to delete one item?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "PATCH",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId
                },
                success: function (response) {
                    if (response.success) {
                        var row = ele.closest("tr");
                        var quantityCell = row.find("td[data-th='Quantity']");
                        var totalCell = row.find("td[data-th='Total']");
                        var price = parseFloat(row.find("td[data-th='Price']").text().replace('$', ''));
                        var quantity = parseInt(quantityCell.text()) - 1;
                        
                        if (quantity <= 0) {
                            row.remove();
                        } else {
                            quantityCell.text(quantity);
                            totalCell.text('$' + (price * quantity).toFixed(2));
                        }
                        updateTotal();
                    }
                }
            });
        }
    });

    function updateTotal() {
        var total = 0;
        $("#cart-items tr").each(function() {
            var price = parseFloat($(this).find("td[data-th='Price']").text().replace('$', ''));
            var quantity = parseInt($(this).find("td[data-th='Quantity']").text());
            total += price * quantity;
        });
        $("#total-price").text(total.toFixed(2));
    }
</script>

</body>
</html>
