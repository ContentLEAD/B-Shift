jQuery(document).ready(function($){
    $(document).on('click','.upload_image_button',function(e) {
    	var i = $(this).attr('data-id');
    	console.log(i);
        jQuery.data(document.body, 'prevElement', $(this).prev());
        //console.log($(this).prev());
        jQuery.data(document.body, 'nextElement', $(this).next());
        jQuery.data(document.body, 'previewImage', $(this).attr('data-target'));
        //console.log($(this).next());
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            
            //console.log($('.slide-preview div'));
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            var image_url = uploaded_image.toJSON().url;
            console.log(uploaded_image.toJSON());
            // Let's assign the url value to the input field
            var inputText = jQuery.data(document.body, 'prevElement');
            //console.log(inputText);
            var showImage = jQuery.data(document.body, 'nextElement');
            var imgPreview = $('#'+jQuery.data(document.body, 'previewImage'));
            //console.log(imgPreview);
            if(inputText != undefined && inputText != '')
            {
                inputText.val(image_url);
                //$('.much_hate').css({'background-image': 'url('+image_url+')', 'background-size': 'cover', 'background-position': '0px center'});
                imgPreview.attr('src', image_url);
                
            }
         	background_url = $('#image_url').val();
         	//var i = 0;
         	img_url = $('.image_url_'+i).val();
         	
         	$('.inner-image-'+i).attr('src',img_url);
         	$('div.option-b .inner-image-'+i).css('display', 'inline');
            $('.inner_prev').css({'background-image': 'url('+background_url+')', 'background-size': 'cover', 'background-position': '0px center'});
            $('.btn_save').show();

            function shiftText() {

                console.log('inside shift_text function');
            }
        });
    });
});