/*! Sortable 1.1.1 - MIT | git://github.com/rubaxa/Sortable.git */
!function(a){"use strict";"function"==typeof define&&define.amd?define(a):"undefined"!=typeof module&&"undefined"!=typeof module.exports?module.exports=a():"undefined"!=typeof Package?Sortable=a():window.Sortable=a()}(function(){"use strict";function a(a,b){this.el=a,this.options=b=b||{};var d={group:Math.random(),sort:!0,disabled:!1,store:null,handle:null,scroll:!0,scrollSensitivity:30,scrollSpeed:10,draggable:/[uo]l/i.test(a.nodeName)?"li":">*",ghostClass:"sortable-ghost",ignore:"a, img",filter:null,animation:0,setData:function(a,b){a.setData("Text",b.textContent)},dropBubble:!1,dragoverBubble:!1};for(var e in d)!(e in b)&&(b[e]=d[e]);var g=b.group;g&&"object"==typeof g||(g=b.group={name:g}),["pull","put"].forEach(function(a){a in g||(g[a]=!0)}),M.forEach(function(d){b[d]=c(this,b[d]||N),f(a,d.substr(2).toLowerCase(),b[d])},this),b.groups=" "+g.name+(g.put.join?" "+g.put.join(" "):"")+" ",a[F]=b;for(var h in this)"_"===h.charAt(0)&&(this[h]=c(this,this[h]));f(a,"mousedown",this._onTapStart),f(a,"touchstart",this._onTapStart),f(a,"dragover",this),f(a,"dragenter",this),Q.push(this._onDragOver),b.store&&this.sort(b.store.get(this))}function b(a){s&&s.state!==a&&(i(s,"display",a?"none":""),!a&&s.state&&t.insertBefore(s,q),s.state=a)}function c(a,b){var c=P.call(arguments,2);return b.bind?b.bind.apply(b,[a].concat(c)):function(){return b.apply(a,c.concat(P.call(arguments)))}}function d(a,b,c){if(a){c=c||H,b=b.split(".");var d=b.shift().toUpperCase(),e=new RegExp("\\s("+b.join("|")+")\\s","g");do if(">*"===d&&a.parentNode===c||(""===d||a.nodeName.toUpperCase()==d)&&(!b.length||((" "+a.className+" ").match(e)||[]).length==b.length))return a;while(a!==c&&(a=a.parentNode))}return null}function e(a){a.dataTransfer.dropEffect="move",a.preventDefault()}function f(a,b,c){a.addEventListener(b,c,!1)}function g(a,b,c){a.removeEventListener(b,c,!1)}function h(a,b,c){if(a)if(a.classList)a.classList[c?"add":"remove"](b);else{var d=(" "+a.className+" ").replace(/\s+/g," ").replace(" "+b+" ","");a.className=d+(c?" "+b:"")}}function i(a,b,c){var d=a&&a.style;if(d){if(void 0===c)return H.defaultView&&H.defaultView.getComputedStyle?c=H.defaultView.getComputedStyle(a,""):a.currentStyle&&(c=a.currentStyle),void 0===b?c:c[b];b in d||(b="-webkit-"+b),d[b]=c+("string"==typeof c?"":"px")}}function j(a,b,c){if(a){var d=a.getElementsByTagName(b),e=0,f=d.length;if(c)for(;f>e;e++)c(d[e],e);return d}return[]}function k(a){a.draggable=!1}function l(){K=!1}function m(a,b){var c=a.lastElementChild,d=c.getBoundingClientRect();return b.clientY-(d.top+d.height)>5&&c}function n(a){for(var b=a.tagName+a.className+a.src+a.href+a.textContent,c=b.length,d=0;c--;)d+=b.charCodeAt(c);return d.toString(36)}function o(a){for(var b=0;a&&(a=a.previousElementSibling);)"TEMPLATE"!==a.nodeName.toUpperCase()&&b++;return b}function p(a,b){var c,d;return function(){void 0===c&&(c=arguments,d=this,setTimeout(function(){1===c.length?a.call(d,c[0]):a.apply(d,c),c=void 0},b))}}var q,r,s,t,u,v,w,x,y,z,A,B,C,D,E={},F="Sortable"+(new Date).getTime(),G=window,H=G.document,I=G.parseInt,J=!!("draggable"in H.createElement("div")),K=!1,L=function(a,b,c,d,e,f){var g=H.createEvent("Event");g.initEvent(b,!0,!0),g.item=c||a,g.from=d||a,g.clone=s,g.oldIndex=e,g.newIndex=f,a.dispatchEvent(g)},M="onAdd onUpdate onRemove onStart onEnd onFilter onSort".split(" "),N=function(){},O=Math.abs,P=[].slice,Q=[],R=p(function(a,b,c){if(c&&b.scroll){var d,e,f,g,h=b.scrollSensitivity,i=b.scrollSpeed,j=a.clientX,k=a.clientY,l=window.innerWidth,m=window.innerHeight;if(w!==c&&(v=b.scroll,w=c,v===!0)){v=c;do if(v.offsetWidth<v.scrollWidth||v.offsetHeight<v.scrollHeight)break;while(v=v.parentNode)}v&&(d=v,e=v.getBoundingClientRect(),f=(O(e.right-j)<=h)-(O(e.left-j)<=h),g=(O(e.bottom-k)<=h)-(O(e.top-k)<=h)),f||g||(f=(h>=l-j)-(h>=j),g=(h>=m-k)-(h>=k),(f||g)&&(d=G)),(E.vx!==f||E.vy!==g||E.el!==d)&&(E.el=d,E.vx=f,E.vy=g,clearInterval(E.pid),d&&(E.pid=setInterval(function(){d===G?G.scrollTo(G.scrollX+f*i,G.scrollY+g*i):(g&&(d.scrollTop+=g*i),f&&(d.scrollLeft+=f*i))},24)))}},30);return a.prototype={constructor:a,_dragStarted:function(){t&&q&&(h(q,this.options.ghostClass,!0),a.active=this,L(t,"start",q,t,z))},_onTapStart:function(a){var b=a.type,c=a.touches&&a.touches[0],e=(c||a).target,g=e,h=this.options,i=this.el,l=h.filter;if(!("mousedown"===b&&0!==a.button||h.disabled)&&(e=d(e,h.draggable,i))){if(z=o(e),"function"==typeof l){if(l.call(this,a,e,this))return L(g,"filter",e,i,z),void a.preventDefault()}else if(l&&(l=l.split(",").some(function(a){return a=d(g,a.trim(),i),a?(L(a,"filter",e,i,z),!0):void 0})))return void a.preventDefault();if((!h.handle||d(g,h.handle,i))&&e&&!q&&e.parentNode===i){C=a,t=this.el,q=e,u=q.nextSibling,B=this.options.group,q.draggable=!0,h.ignore.split(",").forEach(function(a){j(e,a.trim(),k)}),c&&(C={target:e,clientX:c.clientX,clientY:c.clientY},this._onDragStart(C,"touch"),a.preventDefault()),f(H,"mouseup",this._onDrop),f(H,"touchend",this._onDrop),f(H,"touchcancel",this._onDrop),f(q,"dragend",this),f(t,"dragstart",this._onDragStart),J||this._onDragStart(C,!0);try{H.selection?H.selection.empty():window.getSelection().removeAllRanges()}catch(m){}}}},_emulateDragOver:function(){if(D){i(r,"display","none");var a=H.elementFromPoint(D.clientX,D.clientY),b=a,c=" "+this.options.group.name,d=Q.length;if(b)do{if(b[F]&&b[F].groups.indexOf(c)>-1){for(;d--;)Q[d]({clientX:D.clientX,clientY:D.clientY,target:a,rootEl:b});break}a=b}while(b=b.parentNode);i(r,"display","")}},_onTouchMove:function(a){if(C){var b=a.touches?a.touches[0]:a,c=b.clientX-C.clientX,d=b.clientY-C.clientY,e=a.touches?"translate3d("+c+"px,"+d+"px,0)":"translate("+c+"px,"+d+"px)";D=b,i(r,"webkitTransform",e),i(r,"mozTransform",e),i(r,"msTransform",e),i(r,"transform",e),a.preventDefault()}},_onDragStart:function(a,b){var c=a.dataTransfer,d=this.options;if(this._offUpEvents(),"clone"==B.pull&&(s=q.cloneNode(!0),i(s,"display","none"),t.insertBefore(s,q)),b){var e,g=q.getBoundingClientRect(),h=i(q);r=q.cloneNode(!0),i(r,"top",g.top-I(h.marginTop,10)),i(r,"left",g.left-I(h.marginLeft,10)),i(r,"width",g.width),i(r,"height",g.height),i(r,"opacity","0.8"),i(r,"position","fixed"),i(r,"zIndex","100000"),t.appendChild(r),e=r.getBoundingClientRect(),i(r,"width",2*g.width-e.width),i(r,"height",2*g.height-e.height),"touch"===b?(f(H,"touchmove",this._onTouchMove),f(H,"touchend",this._onDrop),f(H,"touchcancel",this._onDrop)):(f(H,"mousemove",this._onTouchMove),f(H,"mouseup",this._onDrop)),this._loopId=setInterval(this._emulateDragOver,150)}else c&&(c.effectAllowed="move",d.setData&&d.setData.call(this,c,q)),f(H,"drop",this);setTimeout(this._dragStarted,0)},_onDragOver:function(a){var c,e,f,g=this.el,h=this.options,j=h.group,k=j.put,n=B===j,o=h.sort;if(q&&(void 0!==a.preventDefault&&(a.preventDefault(),!h.dragoverBubble&&a.stopPropagation()),B&&!h.disabled&&(n?o||(f=!t.contains(q)):B.pull&&k&&(B.name===j.name||k.indexOf&&~k.indexOf(B.name)))&&(void 0===a.rootEl||a.rootEl===this.el))){if(R(a,h,this.el),K)return;if(c=d(a.target,h.draggable,g),e=q.getBoundingClientRect(),f)return b(!0),void(s||u?t.insertBefore(q,s||u):o||t.appendChild(q));if(0===g.children.length||g.children[0]===r||g===a.target&&(c=m(g,a))){if(c){if(c.animated)return;v=c.getBoundingClientRect()}b(n),g.appendChild(q),this._animate(e,q),c&&this._animate(v,c)}else if(c&&!c.animated&&c!==q&&void 0!==c.parentNode[F]){x!==c&&(x=c,y=i(c));var p,v=c.getBoundingClientRect(),w=v.right-v.left,z=v.bottom-v.top,A=/left|right|inline/.test(y.cssFloat+y.display),C=c.offsetWidth>q.offsetWidth,D=c.offsetHeight>q.offsetHeight,E=(A?(a.clientX-v.left)/w:(a.clientY-v.top)/z)>.5,G=c.nextElementSibling;K=!0,setTimeout(l,30),b(n),p=A?c.previousElementSibling===q&&!C||E&&C:G!==q&&!D||E&&D,p&&!G?g.appendChild(q):c.parentNode.insertBefore(q,p?G:c),this._animate(e,q),this._animate(v,c)}}},_animate:function(a,b){var c=this.options.animation;if(c){var d=b.getBoundingClientRect();i(b,"transition","none"),i(b,"transform","translate3d("+(a.left-d.left)+"px,"+(a.top-d.top)+"px,0)"),b.offsetWidth,i(b,"transition","all "+c+"ms"),i(b,"transform","translate3d(0,0,0)"),clearTimeout(b.animated),b.animated=setTimeout(function(){i(b,"transition",""),i(b,"transform",""),b.animated=!1},c)}},_offUpEvents:function(){g(H,"mouseup",this._onDrop),g(H,"touchmove",this._onTouchMove),g(H,"touchend",this._onDrop),g(H,"touchcancel",this._onDrop)},_onDrop:function(b){var c=this.el,d=this.options;clearInterval(this._loopId),clearInterval(E.pid),g(H,"drop",this),g(H,"mousemove",this._onTouchMove),g(c,"dragstart",this._onDragStart),this._offUpEvents(),b&&(b.preventDefault(),!d.dropBubble&&b.stopPropagation(),r&&r.parentNode.removeChild(r),q&&(g(q,"dragend",this),k(q),h(q,this.options.ghostClass,!1),t!==q.parentNode?(A=o(q),L(q.parentNode,"sort",q,t,z,A),L(t,"sort",q,t,z,A),L(q,"add",q,t,z,A),L(t,"remove",q,t,z,A)):(s&&s.parentNode.removeChild(s),q.nextSibling!==u&&(A=o(q),L(t,"update",q,t,z,A),L(t,"sort",q,t,z,A))),a.active&&L(t,"end",q,t,z,A)),t=q=r=u=s=v=w=C=D=x=y=B=a.active=null,this.save())},handleEvent:function(a){var b=a.type;"dragover"===b||"dragenter"===b?(this._onDragOver(a),e(a)):("drop"===b||"dragend"===b)&&this._onDrop(a)},toArray:function(){for(var a,b=[],c=this.el.children,e=0,f=c.length;f>e;e++)a=c[e],d(a,this.options.draggable,this.el)&&b.push(a.getAttribute("data-id")||n(a));return b},sort:function(a){var b={},c=this.el;this.toArray().forEach(function(a,e){var f=c.children[e];d(f,this.options.draggable,c)&&(b[a]=f)},this),a.forEach(function(a){b[a]&&(c.removeChild(b[a]),c.appendChild(b[a]))})},save:function(){var a=this.options.store;a&&a.set(this)},closest:function(a,b){return d(a,b||this.options.draggable,this.el)},option:function(a,b){var c=this.options;return void 0===b?c[a]:void(c[a]=b)},destroy:function(){var a=this.el,b=this.options;M.forEach(function(c){g(a,c.substr(2).toLowerCase(),b[c])}),g(a,"mousedown",this._onTapStart),g(a,"touchstart",this._onTapStart),g(a,"dragover",this),g(a,"dragenter",this),Array.prototype.forEach.call(a.querySelectorAll("[draggable]"),function(a){a.removeAttribute("draggable")}),Q.splice(Q.indexOf(this._onDragOver),1),this._onDrop(),this.el=null}},a.utils={on:f,off:g,css:i,find:j,bind:c,is:function(a,b){return!!d(a,b,a)},throttle:p,closest:d,toggleClass:h,dispatchEvent:L,index:o},a.version="1.1.1",a.create=function(b,c){return new a(b,c)},a});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

var FTG = function($) {
    var _loading = null;
    var $backToTop = null;

    return {
        show_loading: function() {
            $("#spinner").addClass('shown');
        },
        hide_loading: function() {
            $("#spinner").removeClass('shown');
        },
        delete_image: function(id) {
            FTG.show_loading();
            $.post(ajaxurl, {
                action: 'delete_image',
                FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                id: id
            }, function() {
                FTG.load_images();
            });
        },
        load_images: function() {
            if (!_loading)
                FTG.show_loading();

            var source = $("[name=ftg_source]").val();
            var post_type = '';
            var data = {
                action: 'refresh_gallery',
                source: source,
                list_size: currentListSize,
                FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                gid: $("#gallery-id").val()
            };
            
/* Premium Code Stripped by Freemius */

            $.post(ajaxurl, data, function(html) {
                $("#image-list").empty().append(html);
                
                if (source == 'images') {
                    $("#image-list").sortable({
                        cancel: ".nosort",
                        update: function() {
                            FTG.show_loading();
                            var ids = [];
                            $("#image-list .item").each(function() {
                                ids.push($(this).data("id"));
                            });
                            var data = {
                                action: 'sort_images',
                                FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                                ids: ids.join(',')
                            };
                            $.post(ajaxurl, data, function() {
                                FTG.hide_loading();
                                M.toast({ html: "Gallery updated", classes: 'rounded' });
                            });
                        }
                    });
                };

                $("#image-list .remove").click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var $item = $(this).parents(".item:first");
                    var id = $item.data("id");

                    var data = {
                        action: 'delete_image',
                        FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                        id: id
                    };

                    FTG.show_loading();
                    $.post(ajaxurl, data, function() {
                        $item.remove();
                        FTG.hide_loading();
                    });
                });

                $("#image-list .checkbox").click(function() {
                    $(this).toggleClass("checked");
                    $(this).parents(".item:first").toggleClass("selected");
                });

                FTG.hide_loading();
            });
        },
        edit_image: function(form) {
            var data = {};
            form.find("input[type=text], input:checked, textarea, input[type=hidden], select").each(function() {
                data[$(this).attr("name")] = $(this).val();
            });
            data.action = 'save_image';
            data.type = 'edit';
            data.source = $("[name=ftg_source]").val();
            data.FinalTiles_gallery = $('#FinalTiles_gallery').val();

            FTG.show_loading();
            $.ajax({
                url: ajaxurl,
                data: data,
                dataType: "json",
                type: "post",
                error: function(a, b, c) {
                    FTG.hide_loading();
                },
                success: function(r) {
                    if (r.success) {
                        FTG.load_images();
                    } else {
                        FTG.hide_loading();
                    }
                }
            });
        },
        update_filters: function() {
            
/* Premium Code Stripped by Freemius */

        },
        update_custom_isf: function() {
            var isf = [];
            
/* Premium Code Stripped by Freemius */

        },
        add_filter: function(value) {
            
/* Premium Code Stripped by Freemius */

        },
        add_isf: function(value) {
            var $item = $("<tr><td class='del'></td><td></td><td></td></tr>");
            $("td", $item).eq(0).append("<a class='btn-floating waves-effect red' href='#'><i class='fa fa-times'></i></a>");
            $("td", $item).eq(1).append("<input type='text' class='res' placeholder='Resolution' />");
            $("td", $item).eq(2).append("<input type='text' class='size' placeholder='Size factor' />");

            $item.find("a").click(function(e) {
                e.preventDefault();
                $item.remove();
            });
            if (value) {
                var data = value.split(',');
                $item.find(".res").val(data[0]);
                $item.find(".size").val(data[1]);
            }
            $(".custom_isf tbody").append($item);
        },
        init_gallery: function() {

            var source = $('[name="ftg_source"]').val();

            
/* Premium Code Stripped by Freemius */

        },
        refresh_woocommerce: function() {
            
/* Premium Code Stripped by Freemius */

        },
        refresh_posts: function() {
            
/* Premium Code Stripped by Freemius */

        },
        save_gallery: function() {
            // !gallery save
            var data = {};
            data.action = 'save_gallery';
            FTG.update_filters();
            FTG.update_custom_isf();

            $(".form-fields").find("input[type=text], input[type=range], select, input:checked, input[type=hidden], textarea").each(function() {
                var name = $(this).attr("name");
                if (name && name.substr(0, 4) == "ftg_") {
                    var value = $(this).val();

                    if ($.isArray(value))
                        value = value[0];
                    data[name] = value;
                }
            });
            data.ftg_source = $("[name=ftg_source]").val();

            data.FinalTiles_gallery = $("[name=FinalTiles_gallery]").val();
            data.ftg_gallery_edit = $("[name=ftg_gallery_edit]").val();

            if (parseInt(data.gridCellSize) < 2)
                data.gridCellSize = 2;

            if (data.galleryName == "") {
                var p = $("<div title='Attention'>Insert a name for the gallery</div>").dialog({
                    modal: true,
                    buttons: {
                        Close: function() {
                            p.dialog("destroy");
                        }
                    }
                });
                return false;
            }

            FTG.show_loading();

            $.ajax({
                url: ajaxurl,
                data: data,
                dataType: "json",
                type: "post",
                error: function(a, b, c) {
                    FTG.hide_loading();
                },
                success: function(r) {
                    if (data.ftg_gallery_edit) {
                        FTG.hide_loading();
                        M.toast({ html: "Gallery saved", classes: 'rounded' });
                    } else
                        location.href = "?page=edit-gallery";
                }
            });
        },
        /*! FTG Choose images */
        choose_images: function(currentImageSize, caption_field, title_field, callback) {
            tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
                multiple: true,
                library: {
                    type: 'image'
                },
                date: true,
                title: 'Add image(s)',
                button: {
                    text: 'Add image(s)'
                },
                states: [
                    new wp.media.controller.Library({
                        library: wp.media.query({
                            type: 'image'
                        }),
                        multiple: true,
                        priority: 20,
                        filterable: 'all'
                    })
                ]
            });

            tgm_media_frame.on('select', function() {
                var selection = tgm_media_frame.state().get('selection');
                //var images = [];

                var errors = 0;
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();

                    if (!attachment.sizes) {
                        errors++;
                        return;
                    }

                    var obj = {
                        imageId: attachment.id
                    };

                    obj.alt = attachment.alt;

                    if (caption_field != 'none')
                        obj.description = attachment[caption_field];

                    if (title_field != 'none')
                        obj.title = attachment[title_field];

                    if (attachment.sizes.thumbnail)
                        obj.thumbnail = attachment.sizes.thumbnail.url;

                    if (attachment.sizes.large)
                        obj.altImagePath = attachment.sizes.large.url;

                    $.ajax({
                        url: ajaxurl,
                        async: false,
                        type: 'POST',
                        data: {
                            action: 'get_image_size_url',
                            FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                            id: attachment.id,
                            size: currentImageSize
                        },
                        success: function(url) {
                            obj.imagePath = url;

                            //images.push(obj);

                            if (errors) {
                                alert(errors + " images could not be added because the selected size is not available");
                            }
                            callback([obj]);
                        },
                        error: function () {
                            alert("Error adding image");
                            callback([obj]);
                        }
                    });
                });
            });

            tgm_media_frame.open();
        },
        bind: function() {

            currentListSize = 'medium';
            if (getCookie('ftg_imglist_size'))
                currentListSize = getCookie('ftg_imglist_size');
            $("#listview-" + currentListSize).addClass("selected");
            $(".list-view-control li").click(function() {
                currentListSize = $(this).data('size');
                FTG.load_images();
                $(".list-view-control li").removeClass("selected");
                $(this).addClass("selected");

            });

            $(".reset-default-filter").click(function(e) {
                e.preventDefault();

                $("[name='ftg_filterDef']").each(function() {
                    this.checked = false;
                });
            });

            $("body").on("keyup", ".filters .f", function() {
                $(this).siblings("input").val(this.value);
            });
            
            $('[name="ftg_lightbox"]').change(function () {
                if($(this).val() == "everlightbox")
                    $(".ftg-everlightbox-settings").show();
                else
                    $(".ftg-everlightbox-settings").hide();
            }).change();

            $('#ftg-export').click(function(e) {
                e.preventDefault();

                var data = {
                    action: 'get_gallery_configuration',
                    galleryId: $("#gallery-id").val(),
                    FinalTiles_gallery: $('#FinalTiles_gallery').val()
                };
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: data,
                    success: function(r) {
                        $('#ftg-export-code').val(r);
                    }

                });
            });

            $("[data-action-assign-group]").click(function () {
                var selected = [];
                $("#images .item.selected").each(function(i, o) {
                    selected.push($(o).data("id"));
                });
                if (selected.length == 0) {
                    return
                } else {    
                                        
                    var data = {
                        action: 'assign_group',
                        FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                        group: $("#group-name-to-assign").val(),
                        id: selected.join(",")
                    };

                    FTG.show_loading();
                    $.post(ajaxurl, data, function() {
                        FTG.hide_loading();
                        FTG.load_images();
                        M.toast({ html: "Group assigned", classes: 'rounded' });
                    });
                }
            });

            $("[data-action-assign-filters]").click(function () {
                var selected = [];
                $("#images .item.selected").each(function(i, o) {
                    selected.push($(o).data("id"));
                });
                if (selected.length == 0) {
                    return
                } else {    
                                        
                    var filters = [];
                    $("#filters-to-assign :checked").each(function(i, o) {
                        filters.push($(o).val());
                    });

                    var data = {
                        action: 'assign_filters',
                        FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                        filters: filters.join("|"),
                        id: selected.join(","),
                        source: $("[name=ftg_source]").val()
                    };

                    FTG.show_loading();
                    $.post(ajaxurl, data, function() {
                        FTG.hide_loading();
                        FTG.load_images();
                        M.toast({ html: "Filters assigned", classes: 'rounded' });
                    });
                }
            });

            $('[data-ftg-import]').click(function(e) {
                e.preventDefault();

                var config = $('[data-import-text]').val();

                var data = {
                    action: 'update_gallery_configuration',
                    config: config,
                    galleryId: $("#gallery-id").val(),
                    FinalTiles_gallery: $('#FinalTiles_gallery').val()
                };

                if (config != "") {
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: data,
                        success: function(r) {
                            alert("Gallery configuration has been updated successfully");
                        }
                    });
                }
            });
           

            $("[name=ftg_layout]").change(function() {

                var bp = ['', 'TabletLandscape', 'TabletPortrait', 'PhoneLandscape', 'PhonePortrait', 'Custom'];
                if ($(this).val() == "final") {
                    $.each(bp, function() {
                        $(".row-imageSizeFactor" + this).show();
                        $(".row-columns" + this).hide();
                    });
                } else {
                    $.each(bp, function() {
                        $(".row-imageSizeFactor" + this).hide();
                        $(".row-columns" + this).show();
                    });
                    //$("[name=ftg_gridCellSize]").val(0);
                }
            }).change();

            $(".filter-select-control em").click(function() {
                $('#image-list .item').removeClass('selected');
                var currentFilter = $(this).html().trim();
                $(".filter-select-control em").removeClass('selected');
                $(this).addClass('selected');
                $('[data-type=image]').each(function() {

                    var img = $(this);
                    var filters = $(this).find('.current_image_filter').val().split('|');

                    if ($.inArray(currentFilter, filters) >= 0) {
                        img.addClass('selected');
                    }
                })
            });

            $("#image-list").on("mouseenter", ".item .filters li", function() {
                $(this).css('cursor', 'pointer');
            })

            $("#image-list").on("click", ".item .filters li", function() {
                var filter = $(this).html().trim();

                $('.filter-select-control li').removeClass('selected');
                $('.filter-select-control li:contains(' + filter + ')').addClass('selected');
                $('#image-list .item').removeClass('selected');
                $('[data-type=image]').each(function() {

                    var img = $(this);
                    var filters = $(this).find('.current_image_filter').val().split('|');

                    if ($.inArray(filter, filters) >= 0) {
                        img.addClass('selected');
                    }
                })

            });

            $('.js-ajax-loading-control').change(function () {
                if($(this).val() == "F")
                {
                    $(".js-ajax-loading").hide();
                }                    
                else
                {
                    var val = parseInt($('[name="ftg_tilesPerPage"]').val());
                    if(val == 0)
                        $('[name="ftg_tilesPerPage"]').val(20);
                    $(".js-ajax-loading").show();
                }                    
            }).change();

            $(".field .text .integer-only").keypress(function(e) {
                var charCode = (e.which) ? e.which : e.keyCode;

                if (charCode != 46 && charCode > 31 &&
                    (charCode < 48 || charCode > 57))
                    return false;

                return true;
            });

            $("#add-submit").click(function(e) {
                e.preventDefault();
                FTG.add_image();
            });
            $("#add-gallery, [data-update-gallery]").click(function(e) {
                e.preventDefault();
                FTG.save_gallery();
            });
            
/* Premium Code Stripped by Freemius */

            $("#image-list").on("click", ".item .thumb", function() {
                $(this).parents(".item").toggleClass("selected");
                $(this).parents(".item").find(".checkbox").toggleClass("checked");
            });
            $("#image-panel-model input[name=hidden]").click(function () {
                if(this.checked)
                    $(".js-no-hidden").hide();
                else
                    $(".js-no-hidden").show();
            });
            $("#image-list").on("click", ".edit", function(e) {
                e.preventDefault();
                var source = $("[name=ftg_source]").val();

                var $item = $(this).parents(".item");
                if ($item.data("type") == "video")
                {
                    // !video edit
                    var embed = $("pre.imagepath", $item).html();
                    embed = String(embed).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');

                    var selFilters = $item.find("[name=filters]").val().split('|');
                    var $panel = $("#video-panel-model");
                    $('#video-panel-action').val('edit');

                    var filters = "";
                    if($(".gallery-filters [name=ftg_filters]").length)
                        filters = $(".gallery-filters [name=ftg_filters]").val().split('|');
                    $(".video-filters", $panel).empty();
                    for (var i = 0; i < filters.length; i++) {
                        if ($.trim(filters[i]).length > 0) {
                            var ft = $("<input class='browser-default' type='checkbox' />");
                            ft.val($.trim(filters[i]));
                            ft.attr("id", "vidft" + i);
                            $(".video-filters", $panel).append(ft);

                            ft.after("<label for='vidft" + i + "'>" + $.trim(filters[i]) + "</label>");
                            if ($.inArray(filters[i], selFilters) > -1)
                                ft.attr("checked", "checked");
                        }
                    }

                    $("textarea", $panel).val(embed);
                    $("input[type=hidden]", $item).each(function() {
                        if ($(this).attr("name"))
                            $(this).clone().appendTo($panel);
                    });
                    $(".save", $panel).text("Update");

                    var instance = M.Modal.getInstance($panel);
                    instance.open();
                    return;
                }

                var panel = $("#image-panel-model"); //.clone().attr("id", "image-panel");
                panel.attr("data-source", $("[name=ftg_source]").val());
                //panel.openModal();

                panel.find(".copy").remove();

                $("[name=target]", panel).val($("[name=target]", $item).val());
                $("[name=link]", panel).val($("[name=link]", $item).val());
                $("[name=group]", panel).val($("[name=group]", $item).val());
                $(".figure", panel).empty().append($("img", $item).clone());
                $(".figure", panel).css("background", $item.find(".figure").css("background"));
                $(".sizes", panel).empty().append($("select", $item).clone().addClass("browser-default"));
                $("[name=description]", panel).val($("pre.description", $item).html());
                $(".copy", $item).clone().appendTo(panel);
                $('[name=imageTitle]', panel).val($('#img-title', $item).val());
                $('[name=alt]', panel).val($('#img-alt', $item).val());
                $("[name=hidden]", panel).get(0).checked = $("[name=hidden]", $item).val() == 'T';

                if($("[name=hidden]", panel).get(0).checked)
                    $(".js-no-hidden").hide();
                else
                    $(".js-no-hidden").show();

                
/* Premium Code Stripped by Freemius */


                var link = $item.find("[name=link]").val();

                $(".buttons a", panel).click(function(e) {
                    e.preventDefault();

                    switch ($(this).data("action")) {
                        case "save":
                            var data = {
                                source: source,
                                action: 'save_image',
                                FinalTiles_gallery: $('#FinalTiles_gallery').val()
                            };
                            $("input[type=text], input[type=hidden], input[type=radio]:checked, input[type=checkbox]:checked, textarea, select", panel).each(function() {

                                if ($(this).attr("name"))
                                    data[$(this).attr("name")] = $(this).val();
                            });

                            var savFilters = [];

                            $(".filters input:checked", panel).each(function(i, o) {
                                savFilters.push($(o).val());
                            });
                            data.filters = savFilters.join("|");

                            $("#image-panel .close").trigger("click");
                            FTG.show_loading();
                            $.ajax({
                                url: ajaxurl,
                                data: data,
                                dataType: "json",
                                type: "post",
                                error: function(a, b, c) {
                                    console.log(a, b, c);
                                    FTG.hide_loading();
                                },
                                success: function(r) {
                                    FTG.hide_loading();
                                    FTG.load_images();
                                }
                            });
                            break;
                    }
                });
            });

            $("body").on("change", "[name=ftg_source]", function() {
                $("#images .source-panel").hide();
                $("#images .source-" + $(this).val()).show();

                var source = $(this).val();

                $("[data-action='remove']").hide();
                if (source == 'images') {
                    FTG.load_images();
                    $("[data-action='remove']").show();
                }

                
/* Premium Code Stripped by Freemius */

            });

            var refreshPostsTO = 0;
            function refresh() {
                var post_taxonomy = [];
                $('[name="post_taxonomy"]:checked').each(function () {
                    post_taxonomy.push($(this).data("taxonomy") + "|" + $(this).val());
                });
                $('[name="ftg_post_taxonomies"]').val(post_taxonomy.join());

                $('[name="ftg_post_types"]').val($('[name="post_types"]:checked').map(function() {
                    return this.value;
                }).get().join());

                FTG.refresh_posts();
            }
            $("body").on("click", '[name="post_types"],[name="post_taxonomy"],[name="post_tags"]', refresh);
            $("body").on("change", '[name="ftg_taxonomyOperator"]', refresh);
            $("body").on("keyup", '[name="ftg_max_posts"]', function() {
                var delay = setTimeout(function() {
                    clearTimeout(delay);
                    FTG.refresh_posts();
                }, 500);
            });

            
/* Premium Code Stripped by Freemius */

            $("body").on("click", "[name=click_action]", function() {
                if ($(this).val() == "url") {
                    $(this).siblings("[name=url]").get(0).disabled = false;
                } else {
                    $(this).siblings("[name=url]").val("").get(0).disabled = true;
                }
            });
            $("body").on("change", ".presets", function () {
                var idx = $(this).data("field-idx");                
                for(p in presets["preset_" + idx + "_" + $(this).val()]) {
                    $('[name="ftg_'+ p +'"]').val(presets["preset_" + idx + "_" + $(this).val()][p]).change();
                }
            });

            $(".bulk [data-action]").click(function(e) {
                e.preventDefault();

                var $bulk = $(".bulk");

                switch ($(this).data("action")) {
                    case "select":
                        $("#images .item").addClass("selected");
                        $("#images .item .checkbox").addClass("checked");
                        $('.filter-select-control li').removeClass('selected');
                        break;
                    case "deselect":
                        $("#images .item").removeClass("selected");
                        $("#images .item .checkbox").removeClass("checked");
                        $('.filter-select-control li').removeClass('selected');
                        break;
                    case "toggle":
                        $("#images .item").toggleClass("selected");
                        $("#images .item .checkbox").toggleClass("checked");
                        $('.filter-select-control li').removeClass('selected');
                        break;
                    case "show-hide":
                        var selected = [];
                        $("#images .item.selected").each(function(i, o) {
                            selected.push($(o).data("id"));
                        });
                        if (selected.length == 0) {
                            alert("No images selected");
                        } else {

                            var data = {
                                action: 'toggle_visibility',
                                FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                                id: selected.join(",")
                            };

                            FTG.show_loading();
                            $.post(ajaxurl, data, function() {
                                FTG.hide_loading();
                                FTG.load_images();
                            });
                        }
                        break;
                    case "group":
                        break;
                        var selected = [];
                        $("#images .item.selected").each(function(i, o) {
                            selected.push($(o).data("id"));
                        });
                        if (selected.length == 0) {
                            alert("No images selected");
                        } else {    
                            $("#groups-modal").data("ids", selected);

                            //var instance = M.Modal.getInstance($("#groups-modal"));
                            //instance.open();

                            $(".proceed", $bulk).unbind("click").click(function(e) {
                                e.preventDefault();

                                var filters = [];
                                $(".panel :checked", $bulk).each(function(i, o) {
                                    filters.push($(o).val());
                                });

                                $(".panel", $bulk).slideUp();

                                var data = {
                                    action: 'assign_group',
                                    FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                                    group: $(".panel input", $bulk).val(),
                                    id: selected.join(",")
                                };

                                FTG.show_loading();
                                $.post(ajaxurl, data, function() {
                                    FTG.hide_loading();
                                    FTG.load_images();
                                });
                            });

                            $(".panel", $bulk).slideDown();
                        }
                        break;
                    case "filter":
                        var selected = [];
                        $("#images .item.selected").each(function(i, o) {
                            selected.push($(o).data("id"));
                        });
                        if (selected.length == 0) {
                            alert("No images selected");
                        } else {
                            $(".panel", $bulk).hide();
                            $(".panel strong", $bulk).text("");
                            $(".panel .text", $bulk).text("");
                            $(".panel .input", $bulk).hide();
                            $(".panel input", $bulk).val("");

                            var filters = $("[name=ftg_filters]").val().split('|');
                            for (var i = 0; i < filters.length; i++) {
                                if ($.trim(filters[i]).length > 0) {
                                    var ft = $("<input id='bulkft" + i + "' type='checkbox' value='" + $.trim(filters[i]) + "' />");
                                    $(".panel .text", $bulk).append(ft);
                                    ft.after("<label for='bulkft" + i + "'>" + $.trim(filters[i]) + "</label>");
                                }
                            }

                            $(".cancel", $bulk).unbind("click").click(function(e) {
                                e.preventDefault();
                                $(".panel", $bulk).slideUp();
                            });

                            $(".proceed", $bulk).unbind("click").click(function(e) {
                                e.preventDefault();

                                var filters = [];
                                $(".panel :checked", $bulk).each(function(i, o) {
                                    filters.push($(o).val());
                                });

                                $(".panel", $bulk).slideUp();

                                var data = {
                                    action: 'assign_filters',
                                    FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                                    filters: filters.join("|"),
                                    id: selected.join(","),
                                    source: $("[name=ftg_source]").val()
                                };

                                FTG.show_loading();
                                $.post(ajaxurl, data, function() {
                                    FTG.hide_loading();
                                    FTG.load_images();
                                });
                            });

                            $(".panel", $bulk).slideDown();
                        }
                    break;                    
                }
            });
            $("body").on("click", "[data-remove-images]", function () {
                var selected = [];
                $("#images .item.selected").each(function(i, o) {
                    selected.push($(o).data("id"));
                });
                if (selected.length == 0) {
                    alert("No images selected");
                } else {
                    var data = {
                        action: 'delete_image',
                        FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                        id: selected.join(",")
                    };

                    FTG.show_loading();
                    $.post(ajaxurl, data, function() {
                        $("#images .item.selected").remove();
                        FTG.hide_loading();
                    });
                }
            });
            $("body").on("click", ".lever", function() {
                var shortcode = $(this).parents('.field').find('.shortcode-val').text().split("=");
                if ($(this).siblings("input").attr("checked")) {
                    $(this).siblings("input").removeAttr("checked");
                    $(this).parents('.field').find('.shortcode-val').text(shortcode[0] + '="F"' );
                } else {
                    $(this).siblings("input").attr("checked", "checked");
                    $(this).parents('.field').find('.shortcode-val').text(shortcode[0] + '="T"' );
                }
            });
            $("body").on("click", ".show-help", function(e) {
                e.preventDefault();
                $(this).parents(".field:first").find(".help").show();
            });
            $("body #edit-gallery .js-update-shortcode").on("change keyup", "input, select", function(e) {
                e.preventDefault();
                var code = $(this).attr("name").substr(4);
                if($(this).attr("type") == "checkbox") {
                    var val = this.checked ? "T" : "F";

                } else {
                    var val = $(this).val();                                        
                }
                if($("#preview-" + code).length) {
                    $("#preview-" + code).text(val);
                }
                var shortcode = $("#shortcode-" + code + " code").text().split("=");
                $("#shortcode-" + code + " code").text(shortcode[0] + '="' + val + '"');
            });
            //$("input[type=range]").change()
            $("body").on("click", ".toggle-shortcode", function(e) {
                e.preventDefault();
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
                var code = $(this).data("code");
                $("#shortcode-" + code).toggleClass("visible");
            });

            
/* Premium Code Stripped by Freemius */


            $(".open-media-panel").on("click", function(e) {
                e.preventDefault();
                var currentImageSize = $(".current-image-size").val();
                var caption_field = $("[name=ftg_wp_field_caption]").val();

                var title_field = $("[name=ftg_wp_field_title]").val();
                FTG.choose_images(currentImageSize, caption_field, title_field, function(images) {


                    var data = {
                        action: 'add_image',
                        enc_images: JSON.stringify(images),
                        galleryId: $("#gallery-id").val(),
                        FinalTiles_gallery: $('#FinalTiles_gallery').val()
                    };

                    FTG.show_loading();
                    $.ajax({
                        url: ajaxurl,
                        data: data,
                        dataType: "json",
                        type: "post",
                        error: function(a, b, c) {
                            FTG.hide_loading();
                            console.log(a, b, c);
                            alert("error adding images");
                        },
                        success: function(r) {
                            if (r.success) {
                                FTG.hide_loading();
                                FTG.load_images();
                            }
                        }
                    });
                });
            });
            $(".jump").on("change", function() {
                var field = $(this).val();
                $('html, body').animate({
                    scrollTop: $(".row-" + field).offset().top - 20
                }, 1000);
                $(this).get(0).selectedIndex = 0;
            });
            $backToTop.on("click", function(e) {
                e.preventDefault();

                var to = $("#all-settings .active").length ?
                $("#all-settings .active").offset().top - 28 :
                    0;

                $('html, body').animate({
                    scrollTop: to
                }, 1000);
            });
            $("#all-settings .collapsible-header").click(function() {
                var el = this;
                setTimeout(function() {
                    if ($(el).parent().hasClass("active")) {
                        $('html, body').animate({
                            scrollTop: $(el).offset().top - 28
                        }, 500);
                    }
                }, 500);
            });
            $(".bullet-menu li a").click(function(e) {
                e.preventDefault();

                var target = $(this).attr("rel");
                $("#" + target + " .collapsible-header").click();
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $("#" + target).offset().top - 28
                    }, 1000);
                }, 500);
            });

            $(".open-checkout").click(function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                
                var strWindowFeatures = "menubar=no,location=no,resizable=yes,scrollbars=yes,status=yes,width=650";
                window.open(url, "EverlightBox", strWindowFeatures);                
            });
        },
        init: function() {
            $backToTop = $(".back-to-top");
            FTG.bind();
            // $("[name=ftg_source]").change();
            $imageList = $("#image-list");
            setInterval(function() {
                $("iframe", $imageList).each(function(i, o) {
                    $(o).height($(o).width() - 4);
                });
            }, 1000);


        }
    }
}(jQuery);
var FTGWizard = function($) {

    var _curPage = 1;
    var $_wizard = null;
    var _lock = false;

    return {
        init: function() {
            $_wizard = $("#ftg-wizard");
            //$_wizard.find('select').material_select();

            /*! Wizard next */
            $_wizard.find(".next").click(function() {
                if ($(this).hasClass("disabled"))
                    return;

                var branch = $("[name=ftg_source]:checked").val();

                $(".invalid").removeClass("invalid");

                if (_curPage == 1) {
                    var name = $.trim($("[name=ftg_name]").val());
                    if (name.length == 0) {
                        $("[name=ftg_name]").addClass("invalid");
                        return false;
                    }
                }

                /*! Wizard save */
                if ($_wizard.find("fieldset[data-step=" + _curPage + "]").data("save")) {
                    FTGWizard.save();
                    return;
                } else {

                    $_wizard.find("fieldset").hide();
                    _curPage++;

                    var $fs = $_wizard.find("fieldset[data-step=" + _curPage + "]");
                    if (_curPage == 3) {

                        $fs = $fs.filter("[data-branch=" + branch + "]");
                    }
                    $fs.show();

                    if ($fs.data("save")) {
                        $(this).text("Save");
                        if (branch == 'images') {
                            $(".select-images").show();
                            
/* Premium Code Stripped by Freemius */

                            //$("[name=ftg_max_posts]").val(0);
                        } else if (branch == 'posts') {
                            $(".select-images").hide();
                            $("[name=enc_images]").val("");
                            
/* Premium Code Stripped by Freemius */

                        } else {
                            $(".select-images").hide();
                            $("[name=enc_images]").val("");
                            
/* Premium Code Stripped by Freemius */

                        }
                    } else {
                        $(this).text("Next");
                    }
                }

                $_wizard.find(".prev").css({
                    visibility: 'visible'
                });
            });

            /*! Wizard prev */
            $_wizard.find(".prev").click(function() {
                if ($(this).hasClass("disabled"))
                    return;
                _curPage--;

                var branch = $("[name=ftg_source]:checked").val();

                if (_curPage == 1) {
                    $(this).css({
                        visibility: 'hidden'
                    });
                }

                $_wizard.find("fieldset").hide();
                var $fs = $_wizard.find("fieldset[data-step=" + _curPage + "]");
                if (_curPage == 3) {
                    $fs = $fs.filter("[data-branch=" + branch + "]");
                }
                $fs.show();
                $_wizard.find(".next").css({
                    visibility: 'visible'
                }).text("Next");
            });

            /*! Wizard add images */
            $_wizard.find(".add-images").click(function(e) {
                e.preventDefault();
                var size = $_wizard.find("[name=def_imgsize]").val();
                var caption_field = $("[name=ftg_wp_field_caption]").val();
                var title_field = $("[name=ftg_wp_field_title]").val();
                FTG.choose_images(size, caption_field, title_field, function(images) {

                    var addImages = [];
                    if($("[name=enc_images]").val())
                        addImages = JSON.parse($("[name=enc_images]").val());
                    addImages.push(images[0]);

                    $("[name=enc_images]").val(JSON.stringify(addImages));

                    $.each(images, function() {

                        var $_tile = $("<div class='tile list-group-item' />");
                        $_tile.append("<a class='btn-floating waves-effect waves-light red del'><i class='fa fa-times'></i></a>");
                        $_tile.append('<img src="' + this.thumbnail + '" />');

                        $_wizard.find(".images").append($_tile);

                        $_tile.find(".del").click(function() {
                            $(this).parents(".tile").fadeOut(200, function() {
                                $(this).remove();
                            });
                        });
                    });

                });
                Sortable.create($_wizard.find(".images").get(0), {});
            });
        },
        save: function() {
            var data = $_wizard.find("form").serialize();

            $_wizard.find("footer a").addClass("disabled");
            $_wizard.find(".loading").show();

            $.ajax({
                url: ajaxurl,
                data: data,
                dataType: "json",
                type: "post",
                error: function(a, b, c) {
                    M.Modal.getInstance($("#error")).open();                    
                },
                success: function(id) {
                    id = $.trim(id);
                    $_wizard.find(".loading").hide();

                    $_success = $('#success');
                    $_success.find(".code").val("[FinalTilesGallery id='" + id + "']");
                    $_success.find(".gallery-name").text($("[name=ftg_name]").val());
                    $_success.find(".customize").attr("href", "?page=ftg-lite-gallery-admin&id=" + id);

                    M.Modal.getInstance($_success).open();
                }
            });
        }
    }
}(jQuery);
jQuery(function() {
    var $ = jQuery;
    $(".pickColor").wpColorPicker({
        change: function (event, ui) {
            var element = event.target;
            var color = ui.color.toString();

            if($(element).parents(".field").hasClass("js-update-shortcode")) {
                var code = $(element).parents(".field").find(".shortcode-val");
                var shortcode = $(element).val();
                code.text(shortcode[0] + '="' + color + '"');
            }
        },
    });
    FTG.init();
    FTGWizard.init();
    $('.collapsible').collapsible();
    $('.modal').modal();
});