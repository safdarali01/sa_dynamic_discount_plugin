
jQuery(document).ready(function($)
{ 
    $("#dynamic_discount_field" ).parent().hide();
    if($('#dynamic_discount_checkbox').prop("checked") == true)
        {
            $("#dynamic_discount_field" ).parent().show();   
        }
    $('#dynamic_discount_checkbox').click(function()
    {
        $("#dynamic_discount_field" ).parent().hide();
        if($(this).prop("checked") == true)
        {
            $("#dynamic_discount_field" ).parent().show();   
        }
        
    });
});