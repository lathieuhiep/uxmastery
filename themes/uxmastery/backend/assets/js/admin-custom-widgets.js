(function($){
    "use strict";

    $(document).ready(function(){
        // Hàm để hiển thị hoặc ẩn tùy chọn kích thước ảnh
        const toggleImageSizeOption = (widgetContainer) => {
            const hiddenInput = widgetContainer.find('.custom-img-id-input');
            const imageSizeOption = widgetContainer.find('p:has(label[for$="image_size"])');
            if (hiddenInput.val()) {
                imageSizeOption.show();
            } else {
                imageSizeOption.hide();
            }
        };

        // Lắng nghe sự kiện click vào button 'Chọn ảnh' trong widget
        $(document).on('click', '.widget .custom-img-upload', function(e) {
            e.preventDefault();

            // Lấy container cha của widget
            const widgetContainer = $(this).closest('.widget');
            const hiddenInput = widgetContainer.find('.custom-img-id-input');
            const previewImage = widgetContainer.find('.custom-img-preview');
            const removeButton = widgetContainer.find('.custom-img-remove');

            let mediaUploader = wp.media({
                title: 'Chọn ảnh',
                button: {
                    text: 'Sử dụng ảnh này'
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();

                hiddenInput.val(attachment.id);
                previewImage.attr('src', attachment.url).show();
                removeButton.show();

                hiddenInput.trigger('change');

                // Hiển thị tùy chọn kích thước ảnh
                toggleImageSizeOption(widgetContainer);
            });

            mediaUploader.open();
        });

        // Lắng nghe sự kiện click vào button 'Gỡ ảnh'
        $(document).on('click', '.widget .custom-img-remove', function(e) {
            e.preventDefault();

            // Lấy container cha của widget
            const widgetContainer = $(this).closest('.widget');
            const hiddenInput = widgetContainer.find('.custom-img-id-input');
            const previewImage = widgetContainer.find('.custom-img-preview');
            const removeButton = $(this);

            hiddenInput.val('');
            previewImage.attr('src', '').hide();
            removeButton.hide();

            hiddenInput.trigger('change');

            // Ẩn tùy chọn kích thước ảnh
            toggleImageSizeOption(widgetContainer);
        });

        // Chạy hàm kiểm tra khi widget được tải lần đầu
        $('.widget').each(function() {
            toggleImageSizeOption($(this));
        });
    });
})(jQuery);