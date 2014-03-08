$(function(){
    
    var producto = {        
        init : function() {
           this.ComboDependiente("#marque", "#modele", "--- MARQUE ---", "/default/index/get-modele", "id", "value");           
        },        
        ComboDependiente : function (c, cd, def, url, fieldv, fields) {            
            
            $(c).live("change blur", function(){
                
                var actual = $(this);
                
                if (actual.val() != 0) {                    
                    
                    $(cd).removeAttr("disabled");
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {
                           id : actual.val()
                        },
                        dataType: 'json',                        
                        success: function(data){
                                $(cd).html("<option value='0'> -- Modele -- </option>");
                                $.each(data, function(index, value){                                    
                                    $(cd).append("<option value='"+value[fieldv]+"'>"+value[fields]+"</option>");
                                });
                        }
                    });                    
                } else {
                    $(cd).html("");
                    $(cd).append("<option value='0'> -- Modele -- </option>");
                    $(cd).attr("disabled", "disabled");
                    
                    
                }
            });
       }
    };    
    producto.init();
    
});


