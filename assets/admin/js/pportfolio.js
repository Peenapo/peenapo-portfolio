window.jQuery = window.$ = jQuery;

var Pportfolio = {

    start: function() {

        if( $('.pl-meta-gallery').length ) {
            Pportfolio.gallery.init();
        }

    }

    ,gallery: {

        init: function() {

            Pportfolio.gallery.create();
            Pportfolio.gallery.bind();
            Pportfolio.gallery.get_preview();

        },

        bind: function() {

            $(document).on('click', '.pl-meta-gallery .fa.close', function() {

                $(this).closest('li').remove();

            });

        },

        check_video: function() {

            var visible = $('.gallery-popup-settings.visible');

            if ($('.enable-video input', visible).is(':checked')) {
                $('.enabled-video', visible).addClass('visible');
            } else {
                $('.enabled-video', visible).removeClass('visible');
            }

        },

        check_video_thumb: function() {

            var visible = $('.gallery-popup-settings.visible');

            if ($('.enable-video input', visible).is(':checked')) {
                visible.closest('li').addClass('video');
            } else {
                visible.closest('li').removeClass('video');
            }

        },

        create: function() {

            var $addItem = $('.pl-meta-gallery .add-items');

            var frame = wp.media({
                displaySettings: false,
                id: 'bwgallery-frame',
                title: 'BwGallery',
                filterable: 'uploaded',
                frame: 'post',
                state: 'gallery-edit',
                library: {type: 'image'},
                multiple: true, // Set to true to allow multiple files to be selected
                editing: true,
                selection: Pportfolio.gallery.select()
            });

            $addItem.on('click', function(e) {

                e.preventDefault();

                frame.on('update', function() {

                    var controller = frame.states.get('gallery-edit');
                    var library = controller.get('library');
                    var ids = library.pluck('id');

                    $('.pl-meta-gallery .gallery-ids').val(ids.join(','));

                    var items = "";

                    for ( var i = 0; i < ids.length; i++ ) {
                        items += "<li><div class='item'>" + ids[i] + "</div></li>";
                    }

                    $('.pl-meta-gallery .items').html(items);

                    Pportfolio.gallery.get_preview();

                });

                frame.open();

            });

        },

        get_preview: function() {

            var $gallery = $('.pl-meta-gallery');
            ids = $('input', $gallery).val();

            $('.pl-meta-gallery').removeClass('loaded');

            $.ajax({
                type: 'POST',
                url: pportfolio_data.ajax,
                data: {
                    action: '__get_gallery_preview',
                    attachments_ids: ids,
                    field_key: $('.gallery-field', $gallery).val(),
                    post_id: $('.gallery-post', $gallery).val(),
                    field_name: $gallery.closest('.field').attr('data-field_name'),
                },
                beforeSend: function() {
                    $('#bw-gallery-add i').removeClass('fa-camera-retro').addClass('icon-spin fa-refresh');
                },
                complete: function() {
                    $('#bw-gallery-add i').removeClass('icon-spin fa-refresh').addClass('fa-camera-retro');
                },
                success: function(response) {

                    var result = JSON.parse(response);
                    if (result.success) {
                        $('.pl-meta-gallery .welcome').remove();
                        $('.pl-meta-gallery .items').html(result.output);
                    }

                    if (!result.success && !$('.pl-meta-gallery .items li').length) {
                        $('.pl-meta-gallery').append('<p class="welcome"><i class="fa fa-camera-retro"></i>Create your gallery by clicking the button above "Edit gallery".</p>');
                    }
                    setTimeout(function() {
                        $('.pl-meta-gallery').addClass('loaded');
                    }, 100);

                }
            });

        },

        select: function() {
            var galleries_ids = $('.pl-meta-gallery .gallery-ids').val(),
                shortcode = wp.shortcode.next('gallery', '[gallery ids="' + galleries_ids + '"]'),
                defaultPostId = wp.media.gallery.defaults.id,
                attachments, selection;
            // bail if we didn't match the shortcode or all of the content.
            if (!shortcode)
                return;

            // ignore the rest of the match object.
            shortcode = shortcode.shortcode;

            // no images, return false
            if ( shortcode.get('ids') == '' ) {
                return;
            }

            if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
                shortcode.set('id', defaultPostId);

            attachments = wp.media.gallery.attachments(shortcode);
            selection = new wp.media.model.Selection(attachments.models, {
                props: attachments.props.toJSON(),
                multiple: true
            });

            selection.gallery = attachments.gallery;

            // fetch the query's attachments, and then break ties from the
            // query to allow for sorting.
            selection.more().done(function() {
                // break ties with the query.
                selection.props.set({query: false});
                selection.unmirror();
                selection.props.unset('orderby');
            });

            return selection;
        }

    },

}

Pportfolio.start();
