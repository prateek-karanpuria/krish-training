require(['jquery', 'jquery/ui'], function($) {
    jQuery(document).ready(function() {
        //alert(jQuery(".new-shipping-address-form .content .form .osc-fluid .fl-placeholder-state .control .select").val());
        
        setTimeout(function()
        {
            jQuery('.onestep-shipping-address .form .osc-fluid .fl-placeholder-state .control .select').find('option').each(function() {
                if(jQuery(this).val() != "AE")
                {
                    jQuery(this).remove();
                }
                
            });
        }, 
        1000);
    });
});