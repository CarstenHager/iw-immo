/**
 * Created by VStawizki on 24.10.2014.
 */

$(document).ready(function () {
    var index = 0;

    var page = 0;

    var iwImmoSlideShow = $('#iwimmo_slideshow');

    var thumbnailcontainer = iwImmoSlideShow.find('.thumbnailscontainer');

    var thumbnailpagination = thumbnailcontainer.find('.thumbnail_pagination');

    var thumbnails = thumbnailcontainer.find('img');

    var imageCount = thumbnails.length;

    var description = iwImmoSlideShow.find('.description');

    var previewImage = iwImmoSlideShow.find('.previewimage img');

    previewImage.click(function () {
        var bigPictureUrl = $(this).data('bigpicture');
        var bigPicture = $(this).clone();
        bigPicture.attr('src', bigPictureUrl);
        bigPicture.hide().appendTo(previewImage);

        bigPicture.dialog({
            title    : description.text(),
            autoOpen : true,
            modal    : true,
            width    : 'auto',
            height   : 'auto',
            position : 'center',
            resizable: false,
            show     : {
                effect  : "fade",
                duration: 500
            },
            close    : function (event, ui) {
                $(this).empty();
                $(this).remove();
            },
            open     : function () {
                $('.ui-dialog').css("top", "100px").css("left", "25%");
            }
        });
    });

    thumbnails.each(function () {
        index++;
        $(this).addClass('page_' + page);
        if (index % 9 == 0) {
            page++;
        }
        $(this).click(function () {
            setPreviewImage($(this));
        });
    });

    if (imageCount > 9) {
        for (var i = 0; i < Math.ceil(imageCount / 9); i++) {
            var paginationelement = $('<span>•</span>');
            if (i == 0) {
                paginationelement.addClass('current');
            }
            paginationelement.attr('title', 'Seite ' + (i + 1));
            paginationelement.data('page', i);
            paginationelement.appendTo(thumbnailpagination);

            paginationelement.click(function () {
                thumbnailpagination.find('.current').removeClass('current');
                $('.page_' + thumbnailcontainer.data('page')).hide();
                thumbnailcontainer.data('page', $(this).data('page'));
                $('.page_' + thumbnailcontainer.data('page')).show();
                $(this).addClass('current');
            });
        }
    }

    previewImage.parent().find('.prev').click(function () {
        if (previewImage.data('position') > 0) {
            var element = thumbnailcontainer.find('[data-position = "' + (previewImage.data('position') - 1) + '"]');
            setPreviewImage(element);
        }
    });

    previewImage.parent().find('.next').click(function () {
        if (previewImage.data('position') < imageCount - 1) {
            var element = thumbnailcontainer.find('[data-position = "' + (previewImage.data('position') + 1) + '"]');
            setPreviewImage(element);
        }
    });

    function setPreviewImage(element) {
        previewImage.data('bigpicture', element.data('bigpicture'));
        previewImage.data('position', element.data('position'));
        previewImage.attr('src', element.data('previewimage'));
        iwImmoSlideShow.find('.slideshow_count').html((element.data('position') + 1) + ' von ' + imageCount);
        description.text(element.data('description'));
    }
});