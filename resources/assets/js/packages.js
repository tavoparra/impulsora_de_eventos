var pIndex = 0;

var rowTemplate =                   '<tr class="itemRow">' +
                                        '<td><input type="number" name="product[{COUNTER}][qty]" min="1" value="1" class="input-xsmall" style="" /></td>' +
                                        '<td><input type="hidden" name="product[{COUNTER}][id]" value="{PRODUCT_ID}" />{PRODUCT_NAME}</td>' +
                                        '<td><a href="javascript:void(0);"><img src="/images/delete.png"/></a></td>' +
                                    '</tr>';

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

        var tempRow = rowTemplate.replace('{PRODUCT_ID}', $optionSelected.val());
        var tempRow = tempRow.replace('{PRODUCT_NAME}', $optionSelected.text());
        var tempRow = tempRow.replace(/{COUNTER}/g, counter);
        $("#itemsTable").show().append(tempRow);
         
        counter++;
    });   

    $("#itemsTable").on("click", "a img", function(){
        $(this).closest("tr").remove();
        
        if ($(".itemRow").length == 0) {
            $("#itemsTable").hide();
            $("#noProductsSpan").show();
        }
    });

});
