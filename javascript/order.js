    $(document).ready(function() {
       var price =  $('#food-price').attr('food_price');

       $('#total').val(price);

       $('#qty').change((e) => {
           $('#food-price').html( '$ ' + e.target.value * price);
           // - olmasını sen yap
           $('#total').val(e.target.value * price);

       });
       
       
    // form işlemleri
       $('#orderForm').submit( (e) => {
        e.preventDefault();
        var formData = $( '#orderForm' ).serializeArray();

        $.ajax({
            type: 'POST',
            url: './ajax/orderform.php',
            data: formData,
            cache: false,
            success: (data) => {
                if(data == $.trim(data)) {
                    console.log('eklendi');
                    $('.food-search > .container > form').hide();
                    $('.food-search > .container > .text-center').hide();
                    $('.container').append(
                        `
                        <div class="text-center text-white" style="font-size:20px">Siparişiniz Başarıyla Alındı</div>
                        `
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    console.log('eklenmedi');
                }
            }
        })

       
    });

    });


    