(function($) {
    'use strict';
    $(document).ready(function() {
        /* Serialize object */
        (function($,undefined){
            '$:nomunge';
            $.fn.serializeObject = function(){
                var obj = {};
                $.each( this.serializeArray(), function(i,o){
                    var n = o.name,
                        v = o.value;
                    obj[n] = obj[n] === undefined ? v
                        : $.isArray( obj[n] ) ? obj[n].concat( v )
                            : [ obj[n], v ];
                });
                return obj;
            };
        })(jQuery);

        /* Add or update record */
        function save(selector, action, form = null, modal = null, reloadTables = []) {
            jQuery(document).on('click', selector, function(event) {
                var data = {
                    action: action,
                    data: form ? jQuery(form).serializeArray() : []
                };
                var formData = {};
                if(form) {
                    formData = jQuery(form).serializeObject();
                }
                jQuery(selector).prop('disabled', true);
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: jQuery.extend(formData, data),
                    success: function(response) {
                        jQuery(selector).prop('disabled', false);
                        if(response.success) {
                            var successSpan = '<div class="alert alert-success">\n' +
                                ' <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '  <strong>Success! </strong>' + response.data.message + '\n' +
                                '</div>';
                            jQuery(successSpan).insertBefore(form);
                        } else {
                            jQuery('span.text-danger').remove();
                            if(response.data && jQuery.isPlainObject(response.data)) {
                                jQuery(form + ' :input').each(function() {
                                    var input = this;
                                    if(response.data[input.name]) {
                                        var errorSpan = '<div class="alert alert-danger">\n' +
                                            ' <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                            '  <strong>Failed! </strong>' + response.data[input.name] + '\n' +
                                            '</div>';
                                        jQuery(errorSpan).insertAfter(this);
                                    }
                                });
                            } else {
                                var errorSpan = '<div class="alert alert-danger">\n' +
                                    ' <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '  <strong>Failed! </strong>' + response.data + '\n' +
                                    '</div>';
                                jQuery(errorSpan).insertBefore(form);
                            }
                        }
                    },
                    error: function(response) {
                        jQuery(selector).prop('disabled', false);
                    },
                    dataType: 'json'
                });
            });
        }
        save('.update-timeline-options-btn', 'wct-update-timeline-options', '#wct-update-timeline-options-form', '', []);
    });
})(jQuery);