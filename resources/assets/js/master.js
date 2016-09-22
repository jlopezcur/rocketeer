$(function () {

    // Load select2 in all select2 classes
    $('.select2').select2();

    // Same for the summernote
    if (jQuery().summernote) {
        $('.summernote').summernote({
            height: 300
        });
    }

    // Load slider in all classes
    if (jQuery().slider) {
        $('.slider').slider();
    }

    // Initialize fastclick
    FastClick.attach(document.body);

    // Inistialize swipebox
    $('.swipebox').swipebox();

});
