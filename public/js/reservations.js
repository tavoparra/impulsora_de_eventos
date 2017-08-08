var pIndex = 0;

var productTemplate =                   '<tr class="itemRow">' +
                                        '<td><input type="number" name="product[{COUNTER}][qty]" min="1" value="1" class="input-xsmall pQty" /></td>' +
                                        '<td>' +
                                            '<input type="hidden" name="product[{COUNTER}][id]" value="{PRODUCT_ID}" />' +
                                            '{PRODUCT_NAME}' +
                                        '</td>' +
                                        '<td>$<span class="price">{PRICE}</span></td>' +
                                        '<td><a href="javascript:void(0);"><img src="/images/delete.png"/></a></td>' +
                                    '</tr>';

var packageTemplate =                   '<tr class="itemRow">' +
                                        '<td><input type="number" name="package[{COUNTER}][qty]" min="1" value="1" class="input-xsmall pQty" /></td>' +
                                        '<td>' +
                                            '<input type="hidden" name="package[{COUNTER}][id]" value="{PACKAGE_ID}" />' +
                                            '{PACKAGE_NAME}' +
                                            '<div class="packageDesc">{PACKAGE_DESC}</div>' +
                                        '</td>' +
                                        '<td>$<span class="price">{PRICE}</span></td>' +
                                        '<td><a href="javascript:void(0);"><img src="/images/delete.png"/></a></td>' +
                                    '</tr>';

function calculateTotal() {
    var total = 0;

    $(".itemRow").each(function(){
        var qty = $(this).find(".pQty").val();
        var price = $(this).find(".price").text();

        total = total + (qty * price);
    })

    $("#total").val(total);
}

$(document).ready(function(){
    var counter = $(".itemRow").length;

    if (counter === 0) {
        $("#itemsTable").hide();
    } else {
        $("#noProductsSpan").hide();
    }

    $("#productAddBtn").click(function(){
        $("#noProductsSpan").hide();
        $optionSelected = $("#productSelect option:selected");

        var tempRow = productTemplate.replace('{PRODUCT_ID}', $optionSelected.val());
        var tempRow = tempRow.replace('{PRODUCT_NAME}', $optionSelected.text());
        var tempRow = tempRow.replace(/{COUNTER}/g, counter);
        var tempRow = tempRow.replace('{PRICE}', $optionSelected.attr('data-price'));
        $("#itemsTable").show().append(tempRow);
         
        counter++;
        calculateTotal();
    });   

    $("#packageAddBtn").click(function(){
        $("#noProductsSpan").hide();
        $optionSelected = $("#packageSelect option:selected");

        var tempRow = packageTemplate.replace('{PACKAGE_ID}', $optionSelected.val());
        var tempRow = tempRow.replace('{PACKAGE_NAME}', $optionSelected.text());
        var tempRow = tempRow.replace('{PACKAGE_DESC}', $optionSelected.attr('data-content'));
        var tempRow = tempRow.replace(/{COUNTER}/g, counter);
        var tempRow = tempRow.replace('{PRICE}', $optionSelected.attr('data-price'));
        $("#itemsTable").show().append(tempRow);
         
        counter++;
        calculateTotal();
    });   

    $("#itemsTable").on("click", "a img", function(){
        $(this).closest("tr").remove();
        
        if ($(".itemRow").length == 0) {
            $("#itemsTable").hide();
            $("#noProductsSpan").show();
        }
        calculateTotal();
    });

    $("#itemsTable").on("change", ".pQty", function(){
        calculateTotal();
    });

});
