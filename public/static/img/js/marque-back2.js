jQuery(function(){
    
    var producto = {        
        init : function() {
           this.ComboDependiente("#marque", "#modele", "--- MARQUE ---", "/default/index/get-modele", "id", "value");           
        },        
        ComboDependiente : function (c, cd, def, url, fieldv, fields) {            
            
            jQuery(c).live("change blur", function(){
                
                var actual = jQuery(c);
                
                if (actual.val() != 0) {                    
                    
                    jQuery(cd).removeAttr("disabled");
                    jQuery.ajax({
                        url: url,
                        type: 'post',
                        data: {
                           id : actual.val()
                        },
                        dataType: 'json',                        
                        success: function(data){
                                jQuery(cd).html("<option value='0'> -- Modele -- </option>");
                                jQuery.each(data, function(index, value){                                    
                                    jQuery(cd).append("<option value='"+value[fieldv]+"_"+value[fields]+"'>"+value[fields]+"</option>");
                                });
                        }
                    });                    
                } else {
                    jQuery(cd).html("");
                    jQuery(cd).append("<option value='0'> -- Modele -- </option>");
                    jQuery(cd).attr("disabled", "disabled");
                    
                    
                }
            });
       }
    };    
    producto.init();
    
});


