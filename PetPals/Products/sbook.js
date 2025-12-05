// $(document).ready(function () {

//    // $('.increment-btn').click(function (e) {
//    //       e.preventDefault();

//    //       var qty = $(this).closest('.product_data').find('.input-qty').val();
         
//    //       var value = parseInt(qty, 10);
//    //       value = isNaN(value) ? 0 : value;
//    //       if(value < 20)
//    //       {
//    //          value++;
//    //          $(this).closest('.product_data').find('.input-qty').val(value);
//    //       }
//    // });

//    $('.decrement-btn').click(function (e) {
//         e.preventDefault();

//         var qty = $(this).closest('.product_data').find('.input-qty').val();
        
//         var value = parseInt(qty, 10);
//         value = isNaN(value) ? 0 : value;
//         if(value > 1)
//         {
//            value--;
//            $(this).closest('.product_data').find('.input-qty').val(value);
//         }
//    });

//    $('.addToCartBtn').click(function (e){
//       e.preventDefault();
//       var qty = $(this).closest('.product_data').find('.input-qty').val();
//       // var qty = '1';
//       if(qty<1 || qty == null)
//       {
//          qty = 1;
//       }
//       var prod_id = $(this).val();

//       $.ajax({
//          method: "POST",
//          url: "../Login/functions/handlecart.php",
//          data: {
//             "prod_id": prod_id,
//             "prod_qty": qty,
//             "scope": "add"
//          },
//          success: function (response){
//             if(response == 201)
//             {
//                Swal.fire({
//                   title: 'Wow',
//                   text: "Product Added to Cart!",
//                   confirmButtonColor: '#3085d6',
//                   cancelButtonColor: '#d33',
//                   confirmButtonText: 'Okay'
//                 });
//             }
//             else if(response == "Existing")
//             {
//                Swal.fire({
//                   title: 'Exist',
//                   text: "Product Already on cart!",
//                   confirmButtonColor: '#3085d6',
//                   cancelButtonColor: '#d33',
//                   confirmButtonText: 'Okay'
//                 });
//             }
//             else if(response == 401)
//             {
//                Swal.fire({
//                   title: 'Warning',
//                   text: "Login to Continue!",
//                   confirmButtonColor: '#3085d6',
//                   cancelButtonColor: '#d33',
//                   confirmButtonText: 'Okay!'
//                 });
//             }
//             else if(response == 500)
//             {
//                alert("Something went wrong");
//             }
//          }
//      });
//    });

//    $(document).on('click','.updateQty', function () {
//       var qty = $(this).closest('.product_data').find('.input-qty').val();

//       var prod_id = $(this).closest('.product_data').find('.prodId').val();

//       $.ajax({
//          method: "POST",
//          url: "../Login/functions/handlecart.php",
//          data: {
//             "prod_id": prod_id,
//             "prod_qty": qty,
//             "scope": "update"
//          },
//          success: function (response)
//          {
//                // alert(response);
//          }
//       })
//    });

//    $(document).on('click','.deleteItem', function () {
//         var cart_id = $(this).val();
//       //   alert(cart_id);
//       $.ajax({
//          method: "POST",
//          url: "../Login/functions/handlecart.php",
//          data: {
//             "cart_id": cart_id,
//             "scope": "delete"
//          },
//          success: function (response)
//          {
//             if(response == 200)
//             {
//                Swal.fire({
//                   title: 'Warning',
//                   text: "Product Deleted from cart!",
//                   confirmButtonColor: '#3085d6',
//                   cancelButtonColor: '#d33',
//                   confirmButtonText: 'Okay!'
//                 });
//                $('#myReload').load(location.href + " #myReload");
//             }
//             else
//             {
//                alert(response);
//             }
//          }
//       });
//    });
// });




$(document).ready(function () {

    
   // Increment button event
   $('.increment-btn').click(function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.input-qty').val();
    var availableQty = parseInt($(this).closest('.product_data').find('.addToCartBtn').attr('data-qty'), 10);

    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    
    // Increment only if the current value is less than availableQty
    if (value < availableQty) {
        value++;
        $(this).closest('.product_data').find('.input-qty').val(value);
    } else {
        alert("Cannot add more than available quantity");
    }
});

   // Decrement button event
   $('.decrement-btn').click(function (e) {
       e.preventDefault();

       var qty = $(this).closest('.product_data').find('.input-qty').val();
       var value = parseInt(qty, 10);
       value = isNaN(value) ? 0 : value;

       if (value > 1) {
           value--;
           $(this).closest('.product_data').find('.input-qty').val(value);
       }
   });

   // Add to cart button event
   $('.addToCartBtn').click(function (e) {
       e.preventDefault();
       var qty = $(this).closest('.product_data').find('.input-qty').val();
       var availableQty = parseInt($(this).attr('data-qty'), 10);
       
       // Ensure quantity is valid and does not exceed available quantity
       if (qty < 1 || qty == null) {
           qty = 1;
       }

       if (parseInt(qty, 10) > availableQty) {
           alert("Cannot add more than available quantity: " + availableQty);
           return;
       }

       var prod_id = $(this).val();

       $.ajax({
           method: "POST",
           url: "../Login/functions/handlecart.php",
           data: {
               "prod_id": prod_id,
               "prod_qty": qty,
               "scope": "add"
           },
           success: function (response) {
               if (response == 201) {
                   Swal.fire({
                       title: 'Wow',
                       text: "Product Added to Cart!",
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Okay'
                   });
               } else if (response == "Existing") {
                   Swal.fire({
                       title: 'Exist',
                       text: "Product Already in cart!",
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Okay'
                   });
               } else if (response == 401) {
                   Swal.fire({
                       title: 'Warning',
                       text: "Login to Continue!",
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Okay!'
                   });
               } else if (response == 500) {
                   alert("Something went wrong");
               }
           }
       });
   });

   // Update quantity in cart
   $(document).on('click', '.updateQty', function () {
       var qty = $(this).closest('.product_data').find('.input-qty').val();
       var prod_id = $(this).closest('.product_data').find('.prodId').val();

       $.ajax({
           method: "POST",
           url: "../Login/functions/handlecart.php",
           data: {
               "prod_id": prod_id,
               "prod_qty": qty,
               "scope": "update"
           },
           success: function (response) {
               // Handle response if needed
           }
       });
   });

   // Delete item from cart
   $(document).on('click', '.deleteItem', function () {
       var cart_id = $(this).val();

       $.ajax({
           method: "POST",
           url: "../Login/functions/handlecart.php",
           data: {
               "cart_id": cart_id,
               "scope": "delete"
           },
           success: function (response) {
               if (response == 200) {
                   Swal.fire({
                       title: 'Warning',
                       text: "Product Deleted from cart!",
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Okay!'
                   });
                   $('#myReload').load(location.href + " #myReload");
               } else {
                   alert(response);
               }
           }
       });
   });
});
