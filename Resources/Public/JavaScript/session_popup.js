$(document).ready(function() {

    var layer = $('#session_popup');
    var inner = $('#session_popup_inner');

    layer.hide().fadeIn(500);

    $(document).mouseup(function(e){
        if(!inner.is(e.target) && inner.has(e.target).length === 0){
            layer.fadeOut(500,function(){layer.remove()});
        }
    });

});



