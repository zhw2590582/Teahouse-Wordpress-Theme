 /* -------------------------------------------------------------- 
   Custom Media Upload Gallery Script 
   Author : Waleed_ds
  -------------------------------------------------------------- */
  jQuery(document).ready(function(){


        // media manager holder
        var dsf_media_manager;


        // when click on the upload button
        jQuery('.dsf_media_uploader_button').live('click' , function(e){


              // json field
              var field = jQuery(this).parent().find('.media_field_content');

              // gallery container
              var galleryWrapper = jQuery(this).parent().find('.images-container');


              e.preventDefault();

              // open the frame
              if(dsf_media_manager){

                  dsf_media_manager.open();
                  return ;
              }


              // create the media frame
              dsf_media_manager = wp.media.frames.dsf_media_manager = wp.media({

                    className : 'media-frame dsf-media-manager' ,
                    multiple: true,
                    title : 'Select Images' ,
                    button : {
                      text : 'Select'
                    }


              });


              dsf_media_manager.on('select', function(){
              
                      var selection = dsf_media_manager.state().get('selection');
       
                        selection.map( function( attachment ) {
                       
                            attachment = attachment.toJSON();

                            // insert the images to the custom gallery interface
                            galleryWrapper.html(galleryWrapper.html()  +  '<div class="single-image"><span class="delete">X</span><img src="'+attachment.url+'" alt="'+attachment.id+'" /></div>');

                            // insert images to the hidden feild
                            if(field.val() != ''){

                                field.val(field.val() + ',' + attachment.url);
                            }
                            else{
                                field.val(attachment.url);
                            }
                      });

                      });

              // Now that everything has been set, let's open up the frame.
              dsf_media_manager.open();


        });
        // end upload script
        


       /* -------------------------------------------------------------- 
          Custom Gallery Interface 
          * this will grab the content from hidden meta field 
          * and convert it to gallery interface
          * Also will handle image delete process 
        -------------------------------------------------------------- */
        jQuery('.drop_meta_item .images-container').each(function(){

              var wrapper = jQuery(this);

              // get hidden field content
              var content = jQuery(this).parent().find('.media_field_content').val(function(index , value){
                      return value.replace(',,' , ',');
                    }).val();

              var contentArray = content.split(',');

              // map the content and create the gallery
              if(content != '') {

                    jQuery.map(contentArray , function(url){
                          
                          if(url !== '')
                          wrapper.html(wrapper.html() + '<div class="single-image"><span class="delete">X</span><img src="'+url+'" alt="" /></div>');

                    });

              }



              // delete image from gallery
              wrapper.find('.single-image span.delete').live('click' , function(){

                    // image url
                    var imageurl = jQuery(this).parent().find('img').attr('src');
                    wrapper.parent().find('.media_field_content').val(function(index , value){
                      return value.replace(imageurl + ',' , '').replace(imageurl , '');
                      
                    });


                    jQuery(this).parent().hide(400);

                    
                    
              });

        });






  });