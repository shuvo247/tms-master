$('#selectedProduct').change(function(){
    // Get Product Details
       var productId = $(this).val();
       $.get("{{route('purchase.product_details')}}",{
           product_id : productId
           },function(data){
            $('#Stock').empty().html(data);
        });
        $.get("{{route('purchase.product_info')}}",{
           product_id : productId
           },function(data){
            $('#purchasePrice').val(data.purchase_price);
        });
    });
    // Box Update Calculation
    // End Get Product Details
    $('#purchaseBoxValue').keyup(function(){
        var sftInABox = $('#sftInABox').text();
        var box = $(this).val();
        var purchasePrice = $('#purchasePrice').val();
        var sft = box*sftInABox;
        var frontSft = parseFloat(box*sftInABox).toFixed(2);
        $('#purchaseQtyValue').val(frontSft);
        // Show Price In Price Box
        var purchaseTotal = parseFloat(purchasePrice*sft).toFixed(2);
        $('#purchaseProductTotal').val(purchaseTotal);

    });
    // Pcs Update Calculation
    $('#purchasePcsValue').keyup(function(){
        var purchaseQtyValue =$('#purchaseQtyValue').val();
        var purchaseBoxValue = $('#purchaseBoxValue').val();
        var purchasePrice = $('#purchasePrice').val();
        var sftInABox = $('#sftInABox').text();
        var purchasePcsValue = $(this).val();
        var SftInAPcs = $('#sftInAPcs').text();
        var PcsToSft = SftInAPcs*purchasePcsValue;
        var boxToSft = purchaseBoxValue*sftInABox;
        var TotalSft = PcsToSft+boxToSft;
        var frontTotalSft = parseFloat(PcsToSft+boxToSft).toFixed(2);
        $('#purchaseQtyValue').val(frontTotalSft);
        var purchaseTotal = parseFloat(purchasePrice*TotalSft).toFixed(2);
        $('#purchaseProductTotal').val(purchaseTotal);
    });
    // Quantity Update Calculation
    $('#purchaseQtyValue').keyup(function(){
        // Get Some data for calculate
        var sftInABox = $('#sftInABox').text();
        var sft = $(this).val();
        var purchasePrice = $('#purchasePrice').val();
        // Calculation Start
        var purchaseBox = sft/sftInABox; // Purchase Box
        $('#purchaseBoxValue').val(sft/sftInABox | 0); // Get purchase Box Integer Value
        var flotingBox = purchaseBox - Math.floor(purchaseBox); // Seperate Floting Value from Purchase Box
        var flotingBoxToSft = flotingBox*sftInABox; // Conver Floting Box to Sft
        var SftInAPcs = $('#sftInAPcs').text();
        var frontPurchasePcsValue = parseFloat(flotingBoxToSft/SftInAPcs).toFixed(2);
        var flotingBox = parseFloat(frontPurchasePcsValue - Math.floor(frontPurchasePcsValue)).toFixed(2); // Seperate Floting Value from Purchase Box
        if(flotingBox != 0.00){
           $('#purchasePcsValue').css('border-color','red');
        }else{
            $('#purchasePcsValue').css('border-color',''); 
        }
        $('#purchasePcsValue').val(frontPurchasePcsValue); // Convert and show floting box to PCS
        // Show Price In Price Box
        var purchaseTotal = parseFloat(purchasePrice*sft).toFixed(2);
        $('#purchaseProductTotal').val(purchaseTotal);
    });
    // Calculate Box Value
    // Price Update Calculation
    $('#purchasePrice').keyup(function(){
        var price = $(this).val();
        var sft = $('#purchaseQtyValue').val();
        var purchaseTotal = parseFloat(price*sft).toFixed(2);
        $('#purchaseProductTotal').val(purchaseTotal);
    });