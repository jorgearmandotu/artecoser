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
if(document.documentElement.clientWidth > 500){
    $('#img_01').elevateZoom({gallery: 'gal1',
                       cursor: 'pointer',
                       galleryActiveClass: 'active', 
//                        imageCrossfade: 'true',
                        responsive: 'true',
                             });
    $('#img_02').elevateZoom({gallery: 'gal2',
                       cursor: 'pointer',
                       galleryActiveClass: 'active', 
//                        imageCrossfade: true,
                        responsive: "True",
                       });
    $('#img_03').elevateZoom({gallery: 'gal3',
                       cursor: 'pointer',
                       galleryActiveClass: 'active', 
//                        imageCrossfade: true,
                        responsive: "True",
                       });
    $('#img_04').elevateZoom({gallery: 'gal4',
                       cursor: 'pointer',
                       galleryActiveClass: 'active', 
//                        imageCrossfade: true,
                        responsive: "True",
                       });
    $('#img_05').elevateZoom({gallery: 'gal5',
                       cursor: 'pointer',
                       galleryActiveClass: 'active', 
//                        imageCrossfade: true,
                        responsive: "True",
                       });
    $('zoom_03').bind("click", function(e){
    var ez= $('#zoom_03').data('elevateZoom');
    $.fancybox(ez.getGalleryList());
    return false;
    });
}