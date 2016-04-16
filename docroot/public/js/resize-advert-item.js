var maxImageWidth = 0;
$( window ).load(function(){
    if($(window).width() <= 992){
        $( ".description" , ".advert-item").each(function(i, obj) {
            $(obj).css( "width", "100%" );
            var image = $( "img" , $( ".img-container" , $(this).parent() ) );
            var imgContA = $( "a" , $( ".img-container" , $(this).parent() ) );
            imgContA.css( "width", "100%" );
            var imgW = image.width();
            var imgH = image.height();
            var ratio = imgW / imgH;
            image.css( "width", "100%" );
            var newImgW = image.width();
            image.height((newImgW / ratio) + "px");
        });
    }
    else{
        $( ".description" , ".advert-item").each(function(i, obj) {
            var imgContWidth = $( ".img-container" , $(this).parent() ).width();
            if(imgContWidth > maxImageWidth)
                maxImageWidth = imgContWidth;
        });
    }
    if($(window).width() > 992){
        $( ".description" , ".advert-item").each(function(i, obj) {
            $( ".img-container" , $(this).parent() ).width(maxImageWidth);
            $(obj).css( "width", $(this).parent().width() - $( ".img-container" , $(this).parent() ).width() - 11 );
            var image = $( "img" , $( ".img-container" , $(this).parent() ));
            image.css("margin-left",(maxImageWidth - image.width()) / 2 );
        });
    }
});
$( window ).resize(function() {
    if($(window).width() <= 992){
        $( ".description" , ".advert-item").each(function(i, obj) {
            $(obj).css( "width", "100%" );
            var image = $( "img" , $( ".img-container" , $(this).parent() ) );
            var imgContA = $( "a" , $( ".img-container" , $(this).parent() ) );
            imgContA.css( "width", "100%" );
            var imgW = image.width();
            var imgH = image.height();
            var ratio = imgW / imgH;
            image.css( "width", "100%" );
            var newImgW = image.width();
            image.height((newImgW / ratio) + "px");
        });
    }
    else{
        $( ".description" , ".advert-item").each(function(i, obj) {
            var imgContWidth = $( ".img-container" , $(this).parent() ).width();
            if(imgContWidth > maxImageWidth)
                maxImageWidth = imgContWidth;
        });
    }
    if($(window).width() > 992){
        $( ".description" , ".advert-item").each(function(i, obj) {
            $( ".img-container" , $(this).parent() ).width(maxImageWidth);
            $(obj).css( "width", $(this).parent().width() - $( ".img-container" , $(this).parent() ).width() - 11 );
            var image = $( "img" , $( ".img-container" , $(this).parent() ));
            image.css("margin-left",(maxImageWidth - image.width()) / 2 );
        });
    }
});
