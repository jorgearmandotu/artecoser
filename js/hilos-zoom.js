$('#zoom_01').elevateZoom({
    zoomType: "window",
    cursor: "crosshair",
    zoomWindowFadeIn: 200,
    zoomWindowFadeOut: 200,
    zoomWindowPosition: 2,
    zoomWindowWidth: 500,
    tint: true,
    tintColour:'#F90', tintOpacity:0.5,
    responsive: true,
   }); 
$('#img_01').elevateZoom({gallery: 'gal1',
                       cursor: 'pointer',
                       galleryActiveClass: 'active', 
                        imageCrossfade: true,
                        loadingIcon:'http://www.elevateweb.co.uk/spinner.gif',
                       });
$('zoom_03').bind("click", function(e){
    var ez= $('#zoom_03').data('elevateZoom');
    $.fancybox(ez.getGalleryList());
    return false;
});