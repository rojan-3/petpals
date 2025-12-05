$(document).ready(function () {
  $(".increment-btn").click(function (e) {
    e.preventDefault();
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      value++;
      $(this).closest(".product_data").find(".input-qty").val(value);
    }
  });

  $(".decrement-btn").click(function (e) {
    e.preventDefault();

    var qty = $(this).closest(".product_data").find(".input-qty").val();

    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
      $(this).closest(".product_data").find(".input-qty").val(value);
    }
  });

  $(".addToCartBtn").click(function (e) {
   e.preventDefault();
   var qty = $(this).closest(".product_data").find(".input-qty").val();
   var prod_id = $(this).val();

   if (qty < 1 || qty == null) {
       qty = 1;
   }

   $.ajax({
       method: "POST",
       url: "../Login/functions/handlecart.php",
       data: {
           prod_id: prod_id,
           prod_qty: qty,
           scope: "add",
       },
       success: function (response) {
           if (response == 201) {
            Swal.fire({
              title: 'Wow',
              text: "Product Added to Cart!",
              icon: 'info',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Okay!'
            });
           } else if (response == "Existing") {
            Swal.fire({
              title: 'Exist',
              text: "Product Already on cart!",
              icon: 'info',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Okay!'
            });
           } else if (response == 401) {
            Swal.fire({
              title: 'Warning',
              text: "Login to Continue!",
              icon: 'Warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Okay!'
            });
           } else if (response == 500) {
               alert("Something went wrong");
           }
       },
   });
});


  $(document).on("click", ".updateQty", function () {
    var qty = $(this).closest(".product_data").find(".input-qty").val();

    var prod_id = $(this).closest(".product_data").find(".prodId").val();

    $.ajax({
      method: "POST",
      url: "../Login/functions/handlecart.php",
      data: {
        prod_id: prod_id,
        prod_qty: qty,
        scope: "update",
      },
      success: function (response) {
        // alert(response);
      },
    });
  });

  $(document).on("click", ".deleteItem", function () {
    var cart_id = $(this).val();
    //   alert(cart_id);
    $.ajax({
      method: "POST",
      url: "../Login/functions/handlecart.php",
      data: {
        cart_id: cart_id,
        scope: "delete",
      },
      success: function (response) {
        if (response == 200) {
          alert("Product deleted from cart");
          $("#myReload").load(location.href + " #myReload");
        } else {
          alert(response);
        }
      },
    });
  });
});
