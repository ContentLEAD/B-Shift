jQuery(document).ready(function($) {
           
           $(document).on('button-color', function() {
            var button = $('button');
            var content_color = $('.b-shift-content').css('color');
            console.log(content_color);
            $('button').attr('color', content_color);
           });

           $('button').click(function() {
              var content_color = $('.b-shift-content').css('color');
              console.log(content_color);
              
           })

           $('.b-shift-content').css('text-align', 'center');
           
           var arrow = $('.left-bframe').attr('data-pid');
           
           //console.log(button_array[0]);
           
           var data = {
	        'action': 'bshift_action_two',
	        'id': arrow
	        };
    		/*$.post(ajaxurl, data, function(response) {
	            console.log(response);
	            //var reta = JSON.parse(response);
              
              //var array = response.split(',');
	            var j_array = JSON.parse(response);
              console.log(j_array['colors'][0]);
              var ind = $('.slick-current').attr('data-index');
              var color = '#'+response[ind];
              $('.slick-arrow').css('color','#'+j_array['colors'][ind]);
              //console.log(ind);
        	}); */
        var qid = $('.left-bframe').attr('data-pid');
           
           //console.log(button_array[0]);
           
           var data = {
          'action': 'bshift_action',
          'id': qid
          };
        var rtl = $('.left-bframe').attr('data-rtl');
        var autoplay = $('.left-bframe').attr('data-autoplay');
        console.log(autoplay);
        var speed = $('.left-bframe').attr('data-speed');
        var _this = $('.left-bframe');
        $(_this).slick({
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          autoplay: eval(autoplay),                      
                          arrows: true,
                          //appendArrows: $(".b-shift-content"), 
                          autoplaySpeed: speed,
                          rtl: eval(rtl)                              
                        });

        /*
        $.post(ajaxurl, data, function(response) {
            //console.log(JSON.parse(response));
            var reta = JSON.parse(response);
            speed = reta.did;
            var autoplay = $('.left-bframe').attr('data-autoplay');

            $('.left-bframe').slick({
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          autoplay: false,                          
                          arrows: true,
                          //appendArrows: $(".b-shift-content"), 
                          autoplaySpeed: speed                                
           });

        }); */
        
        /*$(document).on('change','.slick-current', function() {
            

            var arrow = $('.left-bframe').attr('data-pid');

           
           //console.log(button_array[0]);
           
            var data = {
            'action': 'bshift_action_two',
            'id': arrow
            };
            $.post(ajaxurl, data, function(response) {
                  console.log(response);
                  //var reta = JSON.parse(response);
                  
                  //var array = response.split(',');
                  var j_array = JSON.parse(response);
                  console.log(j_array['colors'][0]);
                  var ind = $('.slick-current').attr('data-index');
                  var color = '#'+response[ind];
                  console.log(color);
                  $('.slick-arrow').css('color','#'+j_array['colors'][ind]);
                  //console.log(ind);
              });
        });*/
        $('.slick-next').on('click', function() {
           console.log('test'+$('.slick-active').nextElementSibling());

        })
       
});
