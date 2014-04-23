var urlPattern = /^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;

var form_clean;

jQuery.fn.selectText = function(){
   var doc = document;
   var element = this[0];
   //console.log(this, element);
   if (doc.body.createTextRange) {
       var range = document.body.createTextRange();
       range.moveToElementText(element);
       range.select();change-site-fontface
   } else if (window.getSelection) {
       var selection = window.getSelection();        
       var range = document.createRange();
       range.selectNodeContents(element);
       selection.removeAllRanges();
       selection.addRange(range);
   }
};


// serialize sampression form.
jQuery(function($) {
    form_clean = $("form#sampression-metadata").serialize();
    if ($('[name="meta_data"]').val() == 'custom_css_settings') {
        form_clean = $('#sam-custom-code').val();
    }
});

jQuery(document).ready(function($) {
    
    $('body').addClass('noJS');
    var bodyTag = document.getElementsByTagName("body")[0];
    bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
    
    $('pre.select-me').live('click', function() {
        $(this).selectText();
    });
    
    /* serialize sampression form after modification of form and
     check if any form element has been changed.*/
    $(window).on('beforeunload', function() {
        var form_dirty = jQuery("form#sampression-metadata").serialize();
        if ($('[name="meta_data"]').val() == 'custom_css_settings') {
            form_dirty = editor.getValue();
        }
        if (form_clean != form_dirty) {
            return "The changes that you have made has not been saved yet, are you sure you want to leave?";
        }
    });

    // check confirmation for restoring theme to default.
    $('.sampression-restore').live('click', function() {
        var answer = confirm('Do you want to restore theme to default?');
        if (answer) {
            return true;
        }
        return false;
    });

    // close div after 2 seconds.
    $('div.auto-close').each(function() {
        var i = $(this);
        setTimeout(function() {
            i.remove();
        }, 20000);
    });
    
    // close div after 5 seconds.
    $('div#self-destroy').each(function() {
        var i = $(this);
        setTimeout(function() {
            i.slideUp(1000);
        }, 5000);
    });
    
    //sanitize_text_field
    $('input.sanitize_text').live('blur', function() {
        $('#save').removeClass('save-data');
        $('#save').addClass('save-disable');
        var i = $(this);
        var val = i.val();
        var data = {
            action: 'sanitize_text',
            value: val
        };
        jQuery.post(ajaxurl, data,
            function(response) {
                i.val(response);
                $('#save').addClass('save-data');
                $('#save').removeClass('save-disable');
            });
        return false;
    });
    
    // generate wp slug for a string.
    $('#new-widget-name, #edit-widget-name').live('blur', function() {
        var i = $(this);
        var val = i.val();
        var data = {
            action: 'return_slug',
            value: val
        };
        jQuery.post(ajaxurl, data,
                function(response) {
                    i.next('input.widget-slug').val(response);
                });
        return false;
    });

    //Show blog from the following categories - Check all checkboxes and uncheck all checkboxes.
    $('#show-all-categories').live('click', function() {
        if ($(this).is(':checked')) {
            $('.show-categories').attr('checked', 'checked');
        } else {
            $('.show-categories').removeAttr('checked');
        }
    });

    //Show Meta - Blog Page Setting - check/uncheck checkbox
    $('.show-meta').live('click', function() {
        var id = $(this).attr('for');
        if ($('#' + id).is(':checked')) {
            $('#show-' + id).val('no');
        } else {
            $('#show-' + id).val('yes');
        }
    });

    //Add New - Social Media
    $('.add-custom-social-media').live('click', function() {
        /*if ($("ul.custom-social-media-sizes li:nth-last-child(1) div.message").length > 0) {
            return false;
        }*/

        var social_media_name = $.trim($('#social_media_name').val());
        var social_media_url = $.trim($('#social_media_url').val());
        var social_media_label = $('#social_media_name>option:selected').text();
        if (social_media_url === '') {
            remove_add_solial_media_notice();
            $(this).parent('li').append('<div class="message error">Social Media Name and Url fields are required.</div>');
            setTimeout(function() {
                $("ul.custom-social-media-sizes li:nth-last-child(1) div.message").remove();
            }, 5000);
            return false;
        }
        if (urlPattern.test(social_media_url)) {
            if ($('.social-media-list i.icon-' + social_media_name).length > 0) {
                remove_add_solial_media_notice();
                $(this).parent('li').append('<div class="message error">Already Created. Please click on edit button to modify</div>');
                setTimeout(function() {
                    $("ul.custom-social-media-sizes li:nth-last-child(1) div.message").remove();
                }, 5000);
                return false;
            }

            var box = '<li class="row sam-no-border" style="display: none;">';
            box += '<label for="use-' + social_media_name + '" class=""><i class="icon-' + social_media_name + '"></i>' + social_media_url + '</label>';
            box += '<div class="button-wrapper alignright">';
            box += '<a data-social-media-slug="' + social_media_name + '" data-social-media-url="' + social_media_url + '" data-social-media-label="' + social_media_label + '" class="button3 edit-social-media" href="javascript:;">EDIT</a>';
            box += '<a class="button4 delete-social-media" href="javascript:;">DELETE</a>';
            box += '</div>';
            box += '<input type="hidden" name="social_media_slug[]" value="' + social_media_name + '" />';
            box += '<input type="hidden" name="social_media_url[]" value="' + social_media_url + '" />';
            box += '<input type="hidden" name="social_media_label[]" value="' + social_media_label + '" />';
            box += '</li>';
            $('ul.social-media-list li').removeClass('sam-no-border');
            $(box).insertBefore('.add-social-option');
            var $new = $('ul.social-media-list').children('li:nth-last-child(2)');
            $new.show('slow');
            $('#social_media_url').val('');
            remove_add_solial_media_notice();
        } else {
            remove_add_solial_media_notice();
            $(this).parent('li').append('<div class="message error">Invalid Url</div>');
            setTimeout(function() {
                remove_add_solial_media_notice();
            }, 5000);
            return false;
        }
    });
    
    function remove_add_solial_media_notice() {
        if($("ul.custom-social-media-sizes li:nth-last-child(1) div.message").length > 0) {
            $("ul.custom-social-media-sizes li:nth-last-child(1) div.message").remove();
        }
    }

    //Edit Social Media List
    $('.edit-social-media').live('click', function() {
        if ($('ul.social-media-list li').hasClass('edit-area')) {
            return false;
        }
        $('.save-data').addClass('dont-save-social-media').removeClass('save-data');
        $(this).parent('div').parent('li').addClass('edit-area');
        $('ul.social-media-list li:last-child').hide();
        var social_media_name = $.trim($(this).attr('data-social-media-slug'));
        var social_media_url = $.trim($(this).attr('data-social-media-url'));
        var social_media_label = $.trim($(this).attr('data-social-media-label'));
        var box = '';
        box += '<label for="use-' + social_media_name + '" class=""><i class="icon-' + social_media_name + '"></i></label>';
        box += '<input type="text" id="edit_social_media_url" value="' + social_media_url + '" />';
        box += '<input type="hidden" id="edit_social_media_slug" value="' + social_media_name + '" />';
        box += '<input type="hidden" id="edit_social_media_label" value="' + social_media_label + '" />';
        box += '<a class="button1 small-button update-social-media" href="javascript:void(0);">Update</a> <a class="cancel-update-social-media" data-social-media-slug="' + social_media_name + '" data-social-media-url="' + social_media_url + '" data-social-media-label="' + social_media_label + '" href="javascript:void(0);">Cancel</a>'
        $(this).parent('div').parent('li').html(box);
    });

    // Cancel Update Social Media
    $('.cancel-update-social-media').live('click', function() {
        $('ul.social-media-list li:last-child').show();
        var social_media_name = $.trim($(this).attr('data-social-media-slug'));
        var social_media_url = $.trim($(this).attr('data-social-media-url'));
        var social_media_label = $.trim($(this).attr('data-social-media-label'));
        var box = '';
        box += '<label for="use-' + social_media_name + '" class=""><i class="icon-' + social_media_name + '"></i>' + social_media_url + '</label>';
        box += '<div class="button-wrapper alignright">';
        box += '<a data-social-media-slug="' + social_media_name + '" data-social-media-url="' + social_media_url + '" data-social-media-label="' + social_media_label + '" class="button3 edit-social-media" href="javascript:;">EDIT</a>';
        box += '<a class="button4 delete-social-media" href="javascript:;">DELETE</a>';
        box += '</div>';
        box += '<input type="hidden" name="social_media_slug[]" value="' + social_media_name + '" />';
        box += '<input type="hidden" name="social_media_url[]" value="' + social_media_url + '" />';
        box += '<input type="hidden" name="social_media_label[]" value="' + social_media_label + '" />';
        $(this).parent('li').html(box);
        $('ul.social-media-list li').removeClass('edit-area');
        $('.dont-save-social-media').addClass('save-data').removeClass('dont-save-social-media');
    });

    //Update Social Media
    $('.update-social-media').live('click', function() {

        var social_media_name = $.trim($('#edit_social_media_slug').val());
        var social_media_url = $.trim($('#edit_social_media_url').val());
        var social_media_label = $.trim($('#edit_social_media_label').val());

        if (social_media_url === '') {
            $(this).parent('li').append('<div class="message error">Social Media Name and Url fields are required.</div>');
            setTimeout(function() {
                $(this).parent("li div.message").remove();
            }, 5000);
            return false;
        }
        if (urlPattern.test(social_media_url)) {
            var box = '';
            box += '<label for="use-' + social_media_name + '" class=""><i class="icon-' + social_media_name + '"></i>' + social_media_url + '</label>';
            box += '<div class="button-wrapper alignright">';
            box += '<a data-social-media-slug="' + social_media_name + '" data-social-media-url="' + social_media_url + '" data-social-media-label="' + social_media_label + '" class="button3 edit-social-media" href="javascript:;">EDIT</a>';
            box += '<a class="button4 delete-social-media" href="javascript:;">DELETE</a>';
            box += '</div>';
            box += '<input type="hidden" name="social_media_slug[]" value="' + social_media_name + '" />';
            box += '<input type="hidden" name="social_media_url[]" value="' + social_media_url + '" />';
            box += '<input type="hidden" name="social_media_label[]" value="' + social_media_label + '" />';

            $(this).parent('li').html(box);
            $('ul.social-media-list li').removeClass('edit-area');
            $('ul.social-media-list li:last-child').show();
        } else {
            $(this).parent('li').append('<div class="message error">Invalid Url</div>');
            setTimeout(function() {
                $("ul.custom-social-media-sizes li:nth-last-child(1) div.message").remove();
            }, 5000);
            return false;
        }
        $('.dont-save-social-media').addClass('save-data').removeClass('dont-save-social-media');

    });

    //Message if update or cancel is not clicked on clicking edit button - Generate while clicked on Save button
    $('.dont-save-social-media').live('click', function() {
        var box = '<div class="message info">Please update or cancel Social media to save.</div>';
        $('#response').html(box);
        setTimeout(function() {
            $('#response').children('div.message').remove();
        }, 5000);
        return false;
    });

    //Delete Social Media Confirmation Message
    $('.delete-social-media').live('click', function() {
        if ($(this).parent('div').parent('li').parent('ul').find('.message').length > 0) {
            return false;
        }
        $(this).parent('div').parent('li.row').append('<div class="message info">Are you sure you want to delete this Social Media? <a href="javascript:void(0);" id="yes-delete-this-social-media">Yes</a> <a href="javascript:void(0);" id="cancel-delete-this-social-media">Cancel</a></div>');
    });

    //Cancel deleting Social Media
    $('#cancel-delete-this-social-media').live('click', function() {
        $(this).parent('div.message').remove();
    });

    //Delete Social Media
    $('#yes-delete-this-social-media').live('click', function() {
        $(this).parent('div.message').parent('li.row').slideUp("slow", function() {
            $(this).remove();
        });
    });

    //Check/Uncheck checkbox - Apple Touch Icons - Logos & Icons
    $('.samp-style').live('click', function() {
        if ($(this).hasClass('appleicons') && !$(this).is(':checked')) {
            $('#no-touchicon').prop('checked', false);
            $('.sam-no-touchicon').val('no');
        }
        if ($(this).is(':checked')) {
            $('.sam-' + $(this).attr('id')).val('yes');
        } else {
            $('.sam-' + $(this).attr('id')).val('no');
        }
    });

    //Check/Uncheck checkbox - Disable All - Apple Touch Icons - Logos & Icons
    $('#no-touchicon').click(function() {
        $('.appleicons').prop('checked', $(this).prop('checked'));
        $('.appleicons').each(function() {
            if ($(this).is(':checked')) {
                $('.sam-' + $(this).attr('id')).val('yes');
            } else {
                $('.sam-' + $(this).attr('id')).val('no');
            }
        });
    });
    
    //Check/Uncheck - Website Description - Logos & Icons
    $('#no-webdesc').live('click', function() {
        check_checkbox_with_value($(this), '#sam-use-webdesc', 'yes', 'no');
    });
    
    /*
     * Check for checkbox is checked or not and put value in destination_id
     * 
     * @param {type} i Clicked Element
     * @param {type} destination Destination Element class or id. Example: '#my_id' or '.my_class'
     * @param {type} true_val
     * @param {type} false_val
     * @returns {undefined}
     */
    function check_checkbox_with_value(i, destination, true_val, false_val) {
        if (i.is(':checked')) {
            $(destination).val(true_val);
        } else {
            $(destination).val(false_val);
        }
    }

    //Get WP Default Image Uploader
    $('.upload_image_button').live('click', function(e) {
        e.preventDefault();
        var i = $(this);
        get_custom_uploader(i);
    });

    //Popup Uploader Function
    function get_custom_uploader(elem) {
        var figure = elem.parent('div.fileUpload').parent('div.backgroundimage-option').siblings('figure.image-preview').children('img');
        var loader = '../wp-content/themes/sampression/inc/admin/images/ajax-loader.gif';
        var prev_img = figure.attr('src');
        figure.attr('src', loader);
        
        var custom_uploader;
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            library: {
                type: 'image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            //Object:
            //attachment.alt - image alt
            //attachment.author - author id
            //attachment.caption
            //attachment.dateFormatted - date of image uploaded
            //attachment.description
            //attachment.editLink - edit link of media
            //attachment.filename
            //attachment.height
            //attachment.icon - don't know WTF?))
            //attachment.id - id of attachment
            //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
            //attachment.menuOrder
            //attachment.mime - mime type, for example image/jpeg"
            //attachment.name - name of attachment file, for example "my-image"
            //attachment.status - usual is "inherit"
            //attachment.subtype - "jpeg" if is "jpg"
            //attachment.title
            //attachment.type - "image"
            //attachment.uploadedTo
            //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
            //attachment.width
            //$('#upload_image').val(attachment.url);
            //console.log(attachment.url);
            if (attachment.type != 'image') {
                alert('Only Image Type are allowed!!');
                return false;
            } else {
                
                elem.prev('.upload_image').val(attachment.url);
                elem.parent('div').parent('div').siblings('.image-preview').children('img').attr('src', attachment.url);
                var file_name = truncate_filename(attachment.filename);
                elem.parent('div').siblings('div.image-title').html(file_name);
            }
            return false;
        });
        custom_uploader.on('close', function() {
            if(figure.attr('src') == loader) {
                figure.attr('src', prev_img);
            }
        });
        //Open the uploader dialog
        custom_uploader.open();
    }
    
    /*
     * Truncate the file name
     * @param {type} str = File Name
     * @returns {String} = Truncate File Name
     */
    function truncate_filename(str) {
        var strLen = 20;
        if (str.length <= strLen) return str;

        var separator = '...';

        var sepLen = separator.length,
            charsToShow = strLen - sepLen,
            frontChars = Math.ceil((charsToShow/2)-1),
            backChars = Math.floor((charsToShow/2)+1);

        return str.substr(0, frontChars) + separator + str.substr(str.length - backChars);
    }
    
    //Select Layout - Theme Layout - Customize - Styling
    $('#layout-selector li a').click(function() {
        var name = $(this).attr('data-layout');
        $('#layout').val(name);
        $('#layout-selector li').removeClass('active');
        $(this).parent('li').addClass('active');
        // check if element is changed
        check_custom();
    });
    
    //Select sidebar layout - Sidebar - Customze - Styling
    $('#sidebar-selector li a').click(function() {
        var name = $(this).attr('data-sidebar');
        $('#sidebar').val(name);
        $('#sidebar-selector li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
    
    // show hide background image
    $('#use-bgimage').live('click', function() {
        if ($(this).is(':checked')) {
            $('#bgimage_none').val('yes');
            $(this).parent('div.right-cnt').parent('div.box-title').siblings('div.box-entry').css('display', 'none');
            $(this).parent('div.right-cnt').parent('div.box-title').parent('div.titled-box').animate({
                height: "47px"
            }, 500);
        } else {
            $('#bgimage_none').val('no');
            $(this).parent('div.right-cnt').parent('div.box-title').siblings('div.box-entry').css('display', 'block');
            $(this).parent('div.right-cnt').parent('div.box-title').parent('div.titled-box').animate({
                height: "387px"
            }, 500);
        }
    });
    
    $('#bg_img_repeat').css({
        'position': 'absolute',
        'left': '-999px'
    });
    
    // apply style to select box
    new SelectBox({
        selectbox: $('#bg_img_repeat'),
        height: 250,
        changeCallback: function(val) {
            if (val == 'no-repeat') {
                $('#bg_img_repeat').closest('li').nextAll('li').css('display', 'block');
            } else {
                $('#bg_img_repeat').closest('li').nextAll('li').css('display', 'none');
            }
            // check if any modification is made
            //check_custom();
        }
    });

    // show hide backgroung color
    $('#use-bgcolor').live('click', function() {
        if ($(this).is(':checked')) {
            $('#bgcolor_none').val('yes');
            $(this).parent('div.right-cnt').parent('div.box-title').siblings('div.box-entry').css('display', 'none');
            $(this).parent('div.right-cnt').parent('div.box-title').parent('div.titled-box').animate({
                height: "47px"
            }, 500);
        } else {
            $('#bgcolor_none').val('no');
            $(this).parent('div.right-cnt').parent('div.box-title').siblings('div.box-entry').css('display', 'block');
            $(this).parent('div.right-cnt').parent('div.box-title').parent('div.titled-box').animate({
                height: "387px"
            }, 500);
        }
    });
    
    function isAnalytics(str){
        return (/^ua-\d{4,9}-\d{1,4}$/i).test(str.toString());
    }
    
    //Saving Theme Data
    $('.save-data').live("click", function() {
        if ($('#sam-custom-code').length > 0) {
            $('#sam-custom-code').val(editor.getValue());
        }
        if ($(this).hasClass('saving')) {
            return false;
        }
        
        // check miscellaneous page
        if ($('[name="meta_data"]').val() == 'miscellaneous-settings') {
            var ga = $('[name="sam-ga"]').val();
            if(ga != '') {
                if(!isAnalytics(ga)) {
                    $('#response').html('Please enter a valid Google Analytics Id.');
                    setTimeout(function() {
                        $('#response').html('');
                    }, 5000);
                    return false;
                }
            }
        }
        
        $(this).css('background-color', '#333333');
        $(this).addClass('saving');
        $('.save-data').html('Saving');
        $( $(this) ).after( '<i class="icon-spinner circle alignright"></i>' );
        var serial = $('#sampression-metadata').serialize();
        var data = {
            action: 'save_style',
            elements: serial
        };
        jQuery.post(ajaxurl, data,
                function(response) {
                    $('#response').html(response);

                    form_clean = $("form#sampression-metadata").serialize();
                    if ($('[name="meta_data"]').val() == 'custom_css_settings') {
                        form_clean = $('#sam-custom-code').val();
                    }
                        $('.save-data').css('background-color', '#57B94A');
                        $('.save-data').html("Save");
                        $('.save-data').removeClass('saving');
                        $('.save-data').siblings('i.icon-spinner').remove();
                });
        return false;
    });
    
    
    //Fancyselect for styling selectbox.
    $('.sam-select').each(function() {
        var sb = new SelectBox({
            selectbox: $(this),
            height: 250,
            changeCallback: function(val) {
                if (val === 'general' || val === 'primary-nav' || val === 'post-pages' || val === 'widget' || val === 'footer') {
                    var menu = [ 'general', 'primary-nav', 'post-pages', 'widget', 'footer' ];
                    for(var i = 0; i < menu.length; i++) {
                        $('.typo-'+menu[i]).slideUp(500);
                    }
                    $('.typo-'+val).slideDown(750);
                }
            }
        });
    });

    /**
     * add css to select element in social media page
     * for some modification from default
     **/
    $('#social_media_name').css({
        'position': 'absolute',
        'left': '-999em'
    });

    // apply style to select box
    new SelectBox({
        selectbox: $('#social_media_name'),
        height: 250,
        changeCallback: function(val) {
            $('.example').addClass('hidden');
            $('#social_example_' + val).removeClass('hidden');
        }
    });
    
    /*
     * Function for change typography preview for font face, size and style
     * 
     */
    function typography_fontface_preview(i, select_font_face, select_font_size, select_font_style, select_font_case, where_to_change) {
        if(typeof select_font_style === 'undefined') {
            select_font_style = '';
        }
        if(typeof select_font_case === 'undefined') {
            select_font_case = '';
        }
        var font_face = '', font_size = '', font_style = '', font_color = '', font_trans = '';
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            font_face = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_face).val();
            font_size = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.font-size').children('div.customSelect').children('select.'+select_font_size).val();
            if(select_font_style != '') {
                font_style = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.font-style').children('div.customSelect').children('select.'+select_font_style).val();
                font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            }
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            if(select_font_style != '') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
                //console.log(font_color);
                if(font_color == '#ffffff') {
                    $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
                }
            }
            if(select_font_case != '') {
                font_trans = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.font-transformation').children('div.customSelect').children('select.'+select_font_case).val();
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('text-transform', font_trans);
            }
            /////////////////////////////////////////console.log($(this).parent().eq(2));
        });
    }
    
    function typography_fontsize_preview(i, select_font_face, select_font_size, select_font_style, select_font_case, where_to_change) {
        if(typeof select_font_style === 'undefined') {
            select_font_style = '';
        }
        if(typeof select_font_case === 'undefined') {
            select_font_case = '';
        }
        var font_face = '', font_size = '', font_style = '', font_color = '', font_trans = '';
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            font_face = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.font-face').children('div.customSelect').children('select.'+select_font_face).val();
            font_size = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_size).val();
            if(select_font_style != '') {
                font_style = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.font-style').children('div.customSelect').children('select.'+select_font_style).val();
                font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            }
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            if(select_font_style != '') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
                if(font_color == '#ffffff') {
                    $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
                }
            }
            if(select_font_case != '') {
                font_trans = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.font-transformation').children('div.customSelect').children('select.'+select_font_case).val();
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('text-transform', font_trans);
                //console.log(font_trans);
            }
        });
    }
    
    function typography_fontstyle_preview(i, select_font_face, select_font_size, select_font_style, select_font_case, where_to_change) {
        if(typeof select_font_style === 'undefined') {
            select_font_style = '';
        }        
        if(typeof select_font_case === 'undefined') {
            select_font_case = '';
        }
        var font_face = '', font_size = '', font_style = '', font_color = '', font_trans = '';
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            font_face = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-style').siblings('div.font-face').children('div.customSelect').children('select.'+select_font_face).val();
            font_size = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-style').siblings('div.font-size').children('div.customSelect').children('select.'+select_font_size).val();
            if(select_font_style != '') {
                font_style = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_style).val();
                font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-style').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            }
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            if(select_font_style != '') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
                if(font_color == '#ffffff') {
                    $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
                }
            }
            if(select_font_case != '') {
                font_trans = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings('div.font-transformation').children('div.customSelect').children('select.'+select_font_case).val();
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('text-transform', font_trans);
            }
        });
    }
    
    

    /*
     * Website Title Styling - Start
     */
    //change Website Title font face
    $('.change-site-fontface').each(function() {
        //console.log($(this));
        typography_fontface_preview($(this), 'change-site-fontface', 'change-site-fontsize', 'change-site-fontstyle', '', 'div.sam-site-title');
    });
    //change Website Title font size
    $('.change-site-fontsize').each(function() {
        typography_fontsize_preview($(this), 'change-site-fontface', 'change-site-fontsize', 'change-site-fontstyle', '', 'div.sam-site-title');
    });    
    //change Website Title font style
    $('.change-site-fontstyle').each(function() {
        typography_fontstyle_preview($(this), 'change-site-fontface', 'change-site-fontsize', 'change-site-fontstyle', '', 'div.sam-site-title');
    });
    /*
     * Website Title Styling - End
     */
    
    
    /*
     * Website Description Styling - Start
     */
    //change Website Description fontface
    $('.change-sitedesc-fontface').each(function() {
        typography_fontface_preview($(this), 'change-sitedesc-fontface', 'change-sitedesc-fontsize', 'change-sitedesc-fontstyle', '', 'div.sam-site-desc');
    });    
    //change Website Description font size
    $('.change-sitedesc-fontsize').each(function() {
        typography_fontsize_preview($(this), 'change-sitedesc-fontface', 'change-sitedesc-fontsize', 'change-sitedesc-fontstyle', '', 'div.sam-site-desc');
    });    
    //change Website Description font style
    $('.change-sitedesc-fontstyle').each(function() {
        typography_fontstyle_preview($(this), 'change-sitedesc-fontface', 'change-sitedesc-fontsize', 'change-sitedesc-fontstyle', '', 'div.sam-site-desc');
    });
    /*
     * Website Description Styling - End
     */
    
    /*
     * Typography H/body Tag Styling - Start
     */
    //change H/body Tag fontface
    $('.change-fontface').each(function() {
        typography_fontface_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', '', '.font-demo');
    });
    $('.change-fontface-navi').each(function() {
        typography_fontface_preview($(this), 'change-fontface-navi', 'change-fontsize-navi', 'change-fontstyle-navi', 'change-transformation', '.font-demo');
    });
    //change H/body Tag font size
    $('.change-fontsize').each(function() {
        typography_fontsize_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', '', '.font-demo');
    });    
    $('.change-fontsize-navi').each(function() {
        typography_fontsize_preview($(this), 'change-fontface-navi', 'change-fontsize-navi', 'change-fontstyle-navi', 'change-transformation', '.font-demo');
    });    
    //change H/body Tag font style
    $('.change-fontstyle').each(function() {
        typography_fontstyle_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', '', '.font-demo');
    });
    $('.change-fontstyle-navi').each(function() {
        typography_fontstyle_preview($(this), 'change-fontface-navi', 'change-fontsize-navi', 'change-fontstyle-navi', 'change-transformation', '.font-demo');
    });
    /*
     * Typography H/body Tag Styling - End
     */
    
    /*
     * Typography Navigation - Transfermation
     * 
     */
    $('.change-transformation').each(function() {
        typography_fonttransformation_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', 'change-transformation', '.font-demo');
    });
    
    function typography_fonttransformation_preview(i, select_font_face, select_font_size, select_font_style, select_font_transformation, where_to_change) {
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            var font_face = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.font-face').children('div.customSelect').children('select.'+select_font_face).val();
            var font_size = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.font-size').children('div.customSelect').children('select.'+select_font_size).val();
            var font_style = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.font-style').children('div.customSelect').children('select.'+select_font_style).val();
            var font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            var font_trans = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_transformation).val();
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('text-transform', font_trans);
            if(font_color == '#ffffff') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
            }
        });
    }
    //changing the color of site title with color picker
    var sam_site_title = get_color_option_head($head_div = '.sam-site-title');
    // caling color box
    $('.sam-site-title-color').wpColorPicker(sam_site_title);
    
    //changing the color of site description with color picker
    var sam_site_desc = get_color_option_head($head_div = '.sam-site-desc');
    // caling color box
    $('.sam-site-desc-color').wpColorPicker(sam_site_desc);
    
    //DEFAULT COLOR PICKER ONLY
    $('.wp_color_picker, .wp-color-picker').wpColorPicker();
    
    //changing the color of heading tags with color picker
    var heading1_color = get_color_option_head($head_div = '#heading1');
    // caling color box
    $('.heading1-color').wpColorPicker(heading1_color);


    //changing the color of heading tags with color picker
    var heading2_color = get_color_option_head($head_div = '#heading2');
    // caling color box
    $('.heading2-color').wpColorPicker(heading2_color);

    //changing the color of heading tags with color picker
    var heading3_color = get_color_option_head($head_div = '#heading3');
    // caling color box
    $('.heading3-color').wpColorPicker(heading3_color);

    //changing the color of heading tags with color picker
    var heading4_color = get_color_option_head($head_div = '#heading4');
    // caling color box
    $('.heading4-color').wpColorPicker(heading4_color);

    //changing the color of heading tags with color picker
    var heading5_color = get_color_option_head($head_div = '#heading5');
    // caling color box
    $('.heading5-color').wpColorPicker(heading5_color);

    //changing the color of heading tags with color picker
    var heading6_color = get_color_option_head($head_div = '#heading6');
    // caling color box
    $('.heading6-color').wpColorPicker(heading6_color);


    //changing the color of body with color picker
    var paragraphtext_color = get_color_option_head($head_div = '#paragraphtext');
    // caling color box
    $('.paragraphtext-color').wpColorPicker(paragraphtext_color);


    //changing the color of body with color picker
    var link_normal_color = get_color_option_head($head_div = '.link-normal-text');
    // caling color box
    $('.link-normal-color').wpColorPicker(link_normal_color);


    //changing the color of body with color picker
    var link_hover_color = get_color_option_head($head_div = '.link-hover-text');
    // caling color box
    $('.link-hover-color').wpColorPicker(link_hover_color);
    
    //
    var nav_font_color = get_color_option_head($head_div = '#navigation-text');
    $('.nav-font-color').wpColorPicker(nav_font_color);
    
    var nav_font_color_hover = get_color_option_head($head_div = '.nav-link-font-color-hover');
    $('.nav-font-color-hover').wpColorPicker(nav_font_color_hover);
    
    var sam_post_title = get_color_option_head($head_div = '#sam-post-title');
    $('.meta-title-color').wpColorPicker(sam_post_title);
    
    var meta_title_hover_color = get_color_option_head($head_div = '.pp-title-link-color-hover');
    $('.meta-title-hover-color').wpColorPicker(meta_title_hover_color);
    
    var sam_meta_text = get_color_option_head($head_div = '#sam-meta-text');
    $('.metatext-color').wpColorPicker(sam_meta_text);
    var metatext_normal_color = get_color_option_head($head_div = '.pp-meta-link-color-normal');
    $('.metatext-normal-color').wpColorPicker(metatext_normal_color);
    var metatext_hover_color = get_color_option_head($head_div = '.pp-meta-link-color-hover');
    $('.metatext-hover-color').wpColorPicker(metatext_hover_color);
    
    var sam_readmore_text = get_color_option_head($head_div = '#sam-readmore-text');
    $('.readmore-normal-color').wpColorPicker(sam_readmore_text);
    var readmore_hover_color = get_color_option_head($head_div = '.pp-more-link-color-hover');
    $('.readmore-hover-color').wpColorPicker(readmore_hover_color);
    
    var widget_title = get_color_option_head($head_div = '#widget-title');
    $('.widget-title-color').wpColorPicker(widget_title);
    var widget_text = get_color_option_head($head_div = '#widget-text');
    $('.widget-text-color').wpColorPicker(widget_text);
    var widgetlink_normal_color = get_color_option_head($head_div = '.wid-link-font-color-normal');
    $('.widgetlink-normal-color').wpColorPicker(widgetlink_normal_color);
    var widgetlink_hover_color = get_color_option_head($head_div = '.wid-link-font-color-hover');
    $('.widgetlink-hover-color').wpColorPicker(widgetlink_hover_color);
    
    var footer_text = get_color_option_head($head_div = '#footer-text');
    $('.footertext-color').wpColorPicker(footer_text);
    var footer_text_normal_color = get_color_option_head($head_div = '.footer-text-link-color-normal');
    $('.footertext-normal-color').wpColorPicker(footer_text_normal_color);
    var footer_text_hover_color = get_color_option_head($head_div = '.footer-text-link-color-hover');
    $('.footertext-hover-color').wpColorPicker(footer_text_hover_color);

    // generate color option
    function get_color_option_head($head_div) {
        var colorOptions = {
            // a callback to fire whenever the color changes to a valid color
            change: function(event, ui) {
                //changing background of heading if white color is selected
                if (ui.color.toString() == '#ffffff') {
                    $($head_div).css({
                        "background-color": "rgb(87,185,74)",
                        "box-shadow": "0 0 0 3px rgb(87,185,74)"
                    });
                } else {
                    $($head_div).css({
                        'background-color': 'rgb(255, 255, 255)',
                        'box-shadow': 'none'
                    });
                }
                ;
                $($head_div).css('color', ui.color.toString());
            }
        };
        return colorOptions;
    }

    //maintaining the equal height
    function equalHeight(parentobj, obj) {
        $(parentobj).each(function() {
            var highestBox = 0;
            $(obj, this).each(function() {
                if ($(this).height() > highestBox)
                    highestBox = $(this).height();
            });
            $(obj, this).css({
                'min-height': highestBox
            });
        });
    }
    //calling equal height function on .box.col
    equalHeight('.sam-logooption', '.col');

    if ($('#sam-custom-code').length > 0) {
        var editor = CodeMirror.fromTextArea(document.getElementById("sam-custom-code"), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true
        });

    }

    // generate tooltip
    $('.sam-tooltip').tooltip({
        position: {
            my: "left+20 center-5"
        }
    });

    $('.sam-hooks-cb input.samp-style').live('click', function() {
        var i = $(this);
        var ta = i.parent('div.right-cnt').parent('div.box-title').siblings('div.sam-hooks-option');
        var hook = $.trim(ta.children('textarea').val());
        if(ta.children('pre.select-me').siblings('div.message').length > 0) {
            ta.children('pre.select-me').siblings('div.message').remove();
        }
        if(hook == '') {
            ta.children('textarea').focus();
            ta.children('pre.select-me').after('<div class="message error">Enter something to execute the hook.</div>');
            setTimeout(function() {
                ta.children('pre.select-me').siblings('div.message').remove();
            }, 5000);
            return false;
        }        
    });
    
    $('div.sam-hooks-option textarea').live('blur', function() {
        var i = $(this);
        if(i.val() == '') {
            i.parent('div.sam-hooks-option').siblings('div.sam-hooks-cb').children('div.right-cnt').children('input.samp-style').prop('checked', false);
            i.parent('div.sam-hooks-option').siblings('div.sam-hooks-cb').children('div.right-cnt').children('input.sam-use-excute-sam_after_sidebar').val('no');
        }
    });

});
// end ready function here.