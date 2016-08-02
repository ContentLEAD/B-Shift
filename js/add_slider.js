jQuery(document).ready(function($){

    var button_color = $('.b-shift-content').attr('color');
    $('.slick-arrow').attr('color', button_color);

    $('.slick-arrow').mouseover(function() {
        var button_color = $('.slick-active .b-shift-content').attr('color');
        $('.slick-arrow').attr('color', button_color);
    });

    

    function tinyMce_init(_mode) {

            tinyMCE.init({ 
                            mode: _mode,
                            selector : ".bshift-editor",
                            browser_spellcheck : true,
                            valid_elements : 'h1,h2,h3,h4,h5,ul,div,br,a[href],em,strong',
                            menubar : false,
                            plugins: ['code  anchor fullscreen'],
                            resize: 'both',
                            toolbar: ["code | link image | bold italic | alignleft | aligncenter | alignright | bullist | undo redo | anchor | fullscreen"],
                            selection_toolbar: 'h2',
                            setup: function(editor) {
                                editor.on('keyup', function(editor){
                                    var mce = $('#tinymce');
                                    var latest = tinyMCE.activeEditor.getContent({format : 'html'});
                                    console.log(latest);
                                    dynamicText(latest);
                                    });
                                editor.on('change', function(editor){
                                    var mce = $('#tinymce');
                                    var latest = tinyMCE.activeEditor.getContent({format : 'html'});
                                    console.log(latest);
                                    dynamicText(latest);

                                    });
                            }
                             
                            
                        }); 

    }

    $('.ih').keyup(function() {
        console.log($(this).val());
        img_height = $(this).val();
        var i = $(this).attr('data-index');
        $('.inner-image-'+i).css('height',img_height);
    });

    $('.btm').keyup(function() {
        bottom = $(this).val();
        $('.option-b').css('bottom', bottom+'px' );
    });

   $('.tp').on('change', function() {
        text_position = $(this).val();
        if(text_position=="center") {
            $('.option-a').css({'float': text_position, 'transform': "none" });
        } else {
            $('.option-a').css({'float': text_position, 'transform': "translateY(-50%)" });
        }
        
   });

   $('.ip').change('select',function() {
        image_position = $(this).val();
        console.log(image_position);
        if(image_position=="none") {
            $('.option-b').css({'float': image_position, 'transform': "none" });
        } else {
            $('.option-b').css({'float': image_position, 'transform': "translateY(-50%)" });
        }
   });

   $('.ih').on('keyup', function() {
        
        
   });

   $('#slide_width').keyup(function() {

        var prev_width = $(this).val();
        var metric = $(this).next().val();
        console.log(metric);
        var new_width = prev_width + metric;
        $('.slide-preview div').css('width', new_width);
   });

    $('.jscolor').on('blur', function() {

          var color_input = $(this).val();
          $('.show_slide .slide-preview div').css('color','#'+color_input);      

    });

    $(document).on('click', function() {


          var color_input = $('.jscolor-active').val();
          $('.slide-preview div').css('color','#'+color_input);      

    });

    function dynamicText(a) {
        $('.slide-preview div div div.option-a').html(a);
        var dynamic_height = $('input[name="height"]').val();
        $('.inner_prev').css('height',dynamic_height);
    }
    tinyMce_init('textareas');
    
            

    var qid = $('#new_slide').attr('data-pid');
    var data = {
        'action': 'bshift_action',
        'id': qid
        };
    $.post(ajaxurl, data, function(response) {
            console.log(response);
            var reta = JSON.parse(response);
            slides_length = reta.lid;
        });

    $('.slide_input').mousedown(function() {
        $('.btn_save').show();
    });

    $('textarea').mousedown(function() {
        $('.btn_save').show();
    });

    $(document).on('click','.slide_title',function( event ) {


        var parent = $(this).parent();
        var grand_parent = $(parent).parent();
        //console.log(grand_parent);
        var engaged = $(grand_parent).find('.engaged');
        $(engaged).removeClass('engaged');
        var active_slide = $(parent).find('.ib');
        //console.log(active_slide);
        var obj = $('.ib.show_slide');
        //console.log(obj);
        $(obj).removeClass('show_slide').addClass('collapse');
        $(active_slide).removeClass('collapse').addClass('show_slide');
        $(this).addClass('engaged');

    });

    $(document).on('click','.delete_slide',function( event ) {
        event.preventDefault();
        var garbage = $(this).parent();
        $(garbage).remove();
        $('.btn_save').show();
        console.log($(this).attr('data-ref'));
        if($(this).attr('data-ref')==0) {
            location.reload();
        }
        
    });

    $(document).on('change','input #image_url', function() {
        var pic_url = $(this).val();
        $('.slide-preview div').css("background-color","red");
        console.log($('.slide-preview div').css("background-color"));
    });

    $(document).on('click','.b-current .switch-html', function() {
        $('.mce-tinymce').hide();
        $('.b-current .bshift-editor').show();
    });

    $(document).on('click','.add_new_slide',function(e) {
        //$(this).hide();
        $('#slides ul li').hide();
        $('.btn_save').parent().show();
        var pid = $(this).attr('data-pid');
        var parent = $(this).context;
        //console.log($(parent).attr('id'));
        //console.log(pid);
        var data = {
        'action': 'bshift_action',
        'id': pid
        };
        //console.log(pid);

        //ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            //console.log(JSON.parse(response));
            var ret = JSON.parse(response);
            var width = ret.wid;
            var width_metric = ret.widm;
            var height = ret.hid;
            var effect = ret.eid;
            var delay = ret.did;
            var slides_length = ret.lid;
            var dynamic_box =  ret.cid;
            console.log(dynamic_box);
            console.log(ret);
            //console.log(ret);
            //$('.btn_save').after(dynamic_box);
            var slides = $('#slides').find('.ib');
            //console.log(dynamic_box);
            $('.ib').hide();
            $('.b-current').show();
            //$(".slide_content").val(slides_length);
            var slide_name = 'content['+slides_length+']';
            //console.log(dynamic_box);
            $(".slide_content").attr('name',slide_name);
            //$(".slide_label").after(dynamic_box); 

            //console.log(tinyMCE););
            //$('.wp-core-ui').attr('id',slides_length);
            $(".b-current input[class='slide_width']").val(width);
            $(".b-current input[class='slide_height']").val(height);
            //$(".ib input[class='slide_effect']").val(effect);
            $(".b-current input[class='slide_delay']").val(delay);
            $(".b-current input[class='slide_index']").val(slides_length);
            $(".b-current select[class='slide_effect']").val(effect);
            $(".b-current select[class='slide_width_metric']").val(width_metric);
            //$(".b-current textarea").attr('name','slide_content['+slides_length+']');
            //$('.bshift-editor').attr('id','slide_editor');
            $(".b-current h4[class='slide_content_label']").attr('id',slides_length);
            $('.delete_slide').css('margin-top','0px');
            $('.slide-preview').css({'height': height+'px', 'bottom' : '700px'});
            
            //$(".slide_label").after(dynamic_box); // loading wp_editor function via output buffer in ajax call
            //console.log(tinyMCE);
            tinyMce_init('none');
            
        });
        
        $('.btn_save').show();
        $(document).on('click','.btn_save', function() { console.log($('.b-current textarea').val());});
        var inp = document.createElement('INPUT');
        var picker = new jscolor(inp);
        picker.fromHSV();
        $('.btn_save').before('<div class="b-current"><div class="slide-preview"><div class="inner_prev"><div style="position: relative; top: 50%; transform: translateY(-50%);"><div class="option-a" id="text-frame"></div><div class="option-b"><img src="" id="inner-image" /></div></div></div></div><h4 class="slide_label">Content</h4><textarea hidden="false" class="bshift-editor wp-editor-area" style="height: 182px;" autocomplete="off" cols="40" name="slide_content[]"></textarea><div class="bshift-form-element"><input id="image_url" class="slide_input image_url" name="slide_upload[]" value="" type="text"></input><input class="upload_image_button" value="Add Background" data-target="brafton-end-button-preview" type="button"></input></br></div><div class="bshift-form-element"><h4 style="display:inline">Image Height</h4><input type="text" name="image_height[]" class="slide_input ih" ></input></div><div class="bshift-form-element"><h4 style="display:inline">Image Position</h4><select name="image_position[]" class="ip"><option value="center" >Center</option><option value="left" >Left</option><option value="right" >Right</option></select></div><div class="bshift-form-element"><h4>Text Position</h4><select name="text_position[]" class="tp" onchange="shiftText(this.value)"><option value="left">Left</option><option value="right">Right</option><option value="none">Center</option></select></br></div><div class="bshift-form-element"><h4>Image Bottom Adjustment</h4><input type="text" name="position_bottom[]" class="slide_input btm" value=""></input>%</br></div><div class="bshift-form-element"><input id="inner-image-url" class="slide_input image_url" name="image_upload[]" type="text"></input><input class="upload_image_button" value="Add Image" data-target="slide-button-preview" type="button"></input></div><div class="bshift-form-element"><h4 id="color_label">Content Color</h4></div><div class="bshift-form-element"><h4>Width</h4><input type="text" name="width[]" class="slide_width" value="" ></input><br><select name="width_metric[]" class="slide_width_metric"><option value="px" class="slide_width_metric_px" selected="">Pixels</option><option value="%" class="slide_width_metric_pc" selected="">Percent</option></select></br></div><div class="bshift-form-element"><h4>Delay</h4><input type="text" name="delay[]" value="" class="slide_delay" ></input></div><div class="bshift-form-element"><h4>Effect</h4><select name="effect[]" class="slide_effect"><option value="fader">Fade</option><option value="slide_vertical">Slide Vertical</option><option value="slide_left">Slide Left</option><option value="slide_right">Slide Right</option><option value="toggle">Standard Toggle</option></select></div><div class="bshift-form-element"><h4>Index</h4><input type="text" name="index[]" class="slide_index" style="display: block;"></input></div><img src="../wp-content/plugins/B-Shift/img/delete-512.png" data-ref="0" class="delete_slide" title="Delete this slide."/><input type="hidden" name="counter[]"></input></div>');
        document.getElementById('color_label').appendChild(inp);

        b = document.getElementById("color_label");
        c = b.children[0];
        //console.log(c);
        c.setAttribute("name", "color[]");
        c.style.width = "110px";
        c.style.marginLeft = "10px";
    });

    
    
});

function shiftText(val) {
        console.log(val);
        text_pos = document.getElementById("text-frame");
        console.log(text_pos);
        console.log("selected"+val);
        text_pos.style.float=val;
        text_pos.style.transform="translateY(-50%)";
}