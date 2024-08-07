function displayError (selector, msg) {
    let selectorAttr = $(selector);
    selectorAttr.removeClass('d-none');
    selectorAttr.show();
    selectorAttr.text(msg);
    setTimeout(function () {
        $(selector).slideUp();
    }, 3000);
}

listenSubmit('#myForm', function (event) {
    event.preventDefault();
    $.ajax({
        url: route('contact.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#myForm')[0].reset();
            }
        },
        error: function (result) {
            displayError('#contactError', result.responseJSON.message);
        },
    });
});

listenClick('.contact-enquiry-delete-btn', function (event) {
    let recordId = $(event.currentTarget).attr('data-id');
    deleteItem(route('contactus.destroy', recordId), 'Enquiry');
});
