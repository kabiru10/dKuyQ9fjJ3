jQuery(document).ready(function($){
    if($('.zhane_upload_button').length >= 1) {
        window.zhane_uploadfield = '';

        $('.zhane_upload_button').live('click', function() {
            window.zhane_uploadfield = $('.upload_field', $(this).parent());
            tb_show('Upload', 'media-upload.php?type=image&TB_iframe=true', false);

            return false;
        });

        window.zhane_send_to_editor_backup = window.send_to_editor;
        window.send_to_editor = function(html) {
            if(window.zhane_uploadfield) {
                if($('img', html).length >= 1) {
                    var image_url = $('img', html).attr('src');
                } else {
                    var image_url = $($(html)[0]).attr('href');
                }
                $(window.zhane_uploadfield).val(image_url);
                window.zhane_uploadfield = '';
                
                tb_remove();
            } else {
                window.zhane_send_to_editor_backup(html);
            }
        }
    }
});