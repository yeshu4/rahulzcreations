jQuery(document).ready(function($) {/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */

    $(function () {
        $('#upload').on('change', function () {
            readURL(input);
        });
    });

    $(function () {
        var fileFrame;
        $('#upload').on('click', function (e) {
            e.preventDefault();
            if(fileFrame) {
                fileFrame.open();
                return;
            }
            fileFrame = wp.media.frames.file_frame = wp.media({
                title: 'Insert Image',
                library: {type: 'image'},
                multiple: false,
                button: {text: 'Insert Image'}
            });

            fileFrame.on('select', function() {
                var attachment = fileFrame.state().get('selection').toJSON();
                if(attachment.length > 0) {
                    var i;
                    for(i = 0; i < attachment.length; i++) {
                        $('#custom_image_upload_id').val(attachment[i].id);
                        $('#imageResult').attr('src', attachment[i].url);
                    }
                }
            });

            fileFrame.open();

            // open_custom_media_window();
        });
    });

    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById('upload');
    var infoArea = document.getElementById('upload-label');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            jQuery('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function open_custom_media_window() {
    if (this.window === undefined) {
        this.window = wp.media({
            title: 'Insert Image',
            library: {type: 'image'},
            multiple: false,
            button: {text: 'Insert Image'}
        });

        var self = this;
        this.window.on('select', function() {
            var response = self.window.state().get('selection').first().toJSON();
            $('#custom_image_upload_id').val(response.id);
        });
    }

    this.window.open();
    return false;
}
