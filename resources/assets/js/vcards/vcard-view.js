import "flatpickr/dist/l10n";


document.addEventListener("DOMContentLoaded", displayError);
document.addEventListener("DOMContentLoaded", loadVcardView);
document.addEventListener("DOMContentLoaded", passwordLoad);
document.addEventListener("DOMContentLoaded", langDropdown);
// if (typeof oneSignalNotification != 'undefined' && oneSignalNotification == 1) {
//     document.addEventListener('DOMContentLoaded', OneSignalFunction);
// }


function displayError(selector, msg) {
    let selectorAttr = $(selector);
    selectorAttr.removeClass("d-none");
    selectorAttr.show();
    selectorAttr.text(msg);
    setTimeout(function () {
        $(selector).slideUp();
    }, 3000);
}
let selectedDate;
let selectedSlotTime;
let timezone_offset_minutes;
function loadVcardView() {
    let urlStr = window.location.href;
    if (urlStr.indexOf("?") != -1) {
        window.history.pushState(null, "", route("vcard.show", vcardAlias));
        let message = urlStr.split("?").pop();
        // displaySuccessMessage(message.replace(/%20/g, ' '))
        displaySuccessMessage(decodeURIComponent(message));
    }
    if (!$(".date").length) {
        return;
    }
    timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes =
        timezone_offset_minutes === 0 ? 0 : -timezone_offset_minutes;

    $(".date").flatpickr({
        locale: lang,
        minDate: new Date(),
        disableMobile: true,
    });

    setTimeout(function () {
        if (isEdit) {
            $(".date").val(date).trigger("change");
        }
    }, 1000);
    if (!$(".no-time-slot").length) {
        return;
    }
    $(".no-time-slot").removeClass("d-none");
}

listenChange(".date, .appoint-input", function () {
    $("#slotData").empty();
    let templateId =
        $("#templateId").length == 1
            ? "#appoitmentTemplateV11"
            : "#appoitmentTemplate";
    selectedDate = $(this).val();
    var formattedDate = moment(selectedDate).format(getFormattedDateTime(userDateFormate, 1));

    $("#Date").val(formattedDate);
    $(".date").val(formattedDate);
    $.ajax({
        url: slotUrl,
        type: "GET",
        data: {
            date: formattedDate,
            date: selectedDate,
            timezone_offset_minutes: timezone_offset_minutes,
            vcardId: vcardId,
        },
        success: function (result) {
            if (result.success) {
                $.each(result.data, function (index, value) {
                    let data = [
                        {
                            value: value,
                        },
                    ];
                    let buttonStyle = result.message;

                    $("#slotData").append(prepareTemplateRender(templateId, data));

                    $(".time-slot").addClass(`dynamic-btn-${buttonStyle}`);


                });
            }
        },
        error: function (result) {
            $("#slotData").html("");
            displayErrorMessage(result.responseJSON.message);
        },
    });
});


listenClick(".appointmentAdd", function () {
    if (!$(".time-slot").hasClass("activeSlot")) {
        displayErrorMessage(Lang.get("js.select_hour"));
    } else {
        $("#AppointmentModal").modal("show");
        $("#appointmentPaymentMethod").select2({
            dropdownParent: $("#AppointmentModal"),
        });
    }
});

listenChange('#appointmentPaymentMethod',function()
{
    let value = $(this).val();

    if(value == 7) // if  Manually payment method
    {
        $('.manual-payment-guide').removeClass('d-none');
    }else{
        $('.manual-payment-guide').addClass('d-none');
    }
});

listenClick(".time-slot", function () {
    if ($("#templateId").length) {
        if ($(this).hasClass("btn-primary")) {
            $(".time-slot").removeClass("btn-primary");
            $(this).removeClass("btn-primary");
            selectedSlotTime = $(this).addClass("btn-primary");
            if (selectedSlotTime) {
                $(this).removeClass("btn-primary");
            }
        } else {
            $(".time-slot").removeClass("btn-primary");
            selectedSlotTime = $(this).addClass("btn-primary");
        }
    }
    if ($(this).hasClass("activeSlot")) {
        $(".time-slot").removeClass("activeSlot");
        $(this).removeClass("activeSlot");
        selectedSlotTime = $(this).addClass("activeSlot");
        if (selectedSlotTime) {
            $(this).removeClass("activeSlot");
        }
    } else {
        $(".time-slot").removeClass("activeSlot");
        selectedSlotTime = $(this).addClass("activeSlot");
    }
    let fromToTime = $(this).attr("data-id").split("-");
    let fromTime = fromToTime[0];
    let toTime = fromToTime[1];
    $("#timeSlot").val("");
    $("#toTime").val("");
    $("#timeSlot").val(fromTime);
    $("#toTime").val(toTime);
});

listenHiddenBsModal("#AppointmentModal", function () {
    resetModalForm("#addAppointmentForm");
});

listenSubmit("#addAppointmentForm", function (event) {
    event.preventDefault();
    $("#serviceSave").prop("disabled", true);
    $.ajax({
        url: appointmentUrl,
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                if (!isEmpty(result.data)) {
                    if (result.data.payment_method == 1) {
                        let sessionId = result.data[0].sessionId;
                        stripe.redirectToCheckout({
                            sessionId: sessionId,
                        });
                    }
                    if (result.data.payment_method == 2) {
                        if (result.data[0].original.link) {
                            window.location.href = result.data[0].original.link;
                        }

                        if (result.data[0].original.statusCode === 201) {
                            let redirectTo = "";

                            $.each(
                                result.data[0].original.result.links,
                                function (key, val) {
                                    if (val.rel == "approve") {
                                        redirectTo = val.href;
                                    }
                                }
                            );
                            location.href = redirectTo;
                        }
                    }
                    if (result.data.payment_method == 3) {
                        if (result) {
                            window.location.href = result.data[0];
                        }
                    }
                    if (result.data.payment_method == 8) {
                        window.location.href = result.data[0];
                    }
                    if (result.data.payment_method == 4) {
                        if (result.data[0].original.link) {
                            window.location.href = result.data[0].original.link
                        }
                    }
                }
                displaySuccessMessage(result.message);
                $("#addAppointmentForm")[0].reset();
                $("#AppointmentModal").modal("hide");
                $("#slotData").empty();
                $("#pickUpDate").val("");
                $(".date").flatpickr({
                    minDate: new Date(),
                    allowInput: true,
                    locale: lang,
                    disableMobile: true,
                });
                $("#serviceSave").prop("disabled", false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $("#serviceSave").prop("disabled", false);
        },
    });
});

function langDropdown() {
    if (!$(".dropdown1").length) {
        return;
    }
    $(".dropdown1").hover(
        function () {
            $(this)
                .find(".dropdown-menu")
                .stop(true, true)
                .delay(100)
                .fadeIn(100);
        },
        function () {
            $(this)
                .find(".dropdown-menu")
                .stop(true, true)
                .delay(100)
                .fadeOut(100);
        }
    );
}

listenClick("#languageName", function () {
    let languageName = $(this).attr("data-name");
    $.ajax({
        url: languageChange + "/" + languageName + "/" + vcardAlias,
        type: "GET",
        success: function (result) {
            displaySuccessMessage(result.message);
            setTimeout(function () {
                location.reload();
            }, 2000);
        },
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".share", function () {
    $("#vcard1-shareModel").modal("hide");
});

listenClick(".share2", function () {
    $("#vcard2-shareModel").modal("hide");
});

listenClick(".share3", function () {
    $("#vcard3-shareModel").modal("hide");
});
listenClick(".share4", function () {
    $("#vcard4-shareModel").modal("hide");
});
listenClick(".share5", function () {
    $("#vcard5-shareModel").modal("hide");
});
listenClick(".share6", function () {
    $("#vcard6-shareModel").modal("hide");
});
listenClick(".share7", function () {
    $("#vcard7-shareModel").modal("hide");
});
listenClick(".share8", function () {
    $("#vcard8-shareModel").modal("hide");
});
listenClick("share9", function () {
    $("#vcard9-shareModel").modal("hide");
});
listenClick(".share10", function () {
    $("#vcard10-shareModel").modal("hide");
});
listenClick(".share13", function () {
    $("#vcard13-shareModel").modal("hide");
});
listenClick(".share17", function () {
    $("#vcard17-shareModel").modal("hide");
});
listenClick(".share21", function () {
    $("#vcard21-shareModel").modal("hide");
});
listenClick(".share31", function () {
    $("#vcard31-shareModel").modal("hide");
});
listenClick(".share29", function () {
    $("#vcard29-shareModel").modal("hide");
});
listenClick(".share27", function () {
    $("#vcard27-shareModel").modal("hide");
});
listenClick(".share26", function () {
    $("#vcard26-shareModel").modal("hide");
});
listenClick(".share28", function () {
    $("#vcard28-shareModel").modal("hide");
});
listenClick(".share30", function () {
    $("#vcard30-shareModel").modal("hide");
});
listenClick(".share24", function () {
    $("#vcard24-shareModel").modal("hide");
});
listenClick(".share25", function () {
    $("#vcard25-shareModel").modal("hide");
});
listenClick(".share22", function () {
    $("#vcard22-shareModel").modal("hide");
});
listenClick(".vcard23-share", function () {
    $("#vcard23-shareModel").modal("show");
});
listenClick(".share20", function () {
    $("#vcard20-shareModel").modal("hide");
});
listenClick(".share14", function () {
    $("#vcard14-shareModel").modal("hide");
});
listenClick(".share12", function () {
    $("#vcard12-shareModel").modal("hide");
});
listenClick(".share15", function () {
    $("#vcard15-shareModel").modal("hide");
});
listenClick(".share18", function () {
    $("#vcard18-shareModel").modal("hide");
});
listenClick(".share19", function () {
    $("#vcard19-shareModel").modal("hide");
});

listenClick(".copy-referral-btn", function () {
    let code = $(this).attr("data-id");
    let $temp = $("<input>");
    $("body").append($temp);
    $temp.val(route("register") + "?referral-code=" + code).select();
    document.execCommand("copy");
    $temp.remove();
    displaySuccessMessage(Lang.get("js.copied_successfully"));
});

$(window).resize(function () {
    if ($(window).width() < 1025) {
        $(".vcard11-referral-text").addClass("d-none");
        $(".vcard11-referral-icon").removeClass("me-2");
    } else {
        $(".vcard11-referral-text").removeClass("d-none");
        $(".vcard11-referral-icon").addClass("me-2");
    }
});
$(window).trigger("resize");

function passwordLoad() {
    if (password) {
        let passwordAttr = $("#passwordModal");
        passwordAttr.appendTo("body").modal("show");
    } else {
        $(".content-blur").removeClass("content-blur");
    }
}

listenHiddenBsModal("#passwordModal", function () {
    $(this).find("#password").focus();
});

listenSubmit("#passwordForm", function (event) {
    event.preventDefault();
    $.ajax({
        url: passwordUrl,
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                $("#passwordModal").modal("hide");
                $(".content-blur").removeClass("content-blur");
            }
        },
        error: function (result) {
            displayError("#passwordError", result.responseJSON.message);
        },
    });
});

// var $window = $(window), previousScrollTop = 0, scrollLock = true;
//
// $window.scroll(function (event) {
//     if (scrollLock) {
//         previousScrollTop = $window.scrollTop();
//     }
//     $window.scrollTop(previousScrollTop);
//
// });

listenSubmit("#enquiryForm", function (event) {
    event.preventDefault();
    $(".contact-btn").prop("disabled", true);
    $.ajax({
        url: enquiryUrl,
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#enquiryForm")[0].reset();
                $(".contact-btn").prop("disabled", false);
            }
        },
        error: function (result) {
            displayError("#enquiryError", result.responseJSON.message);
            $(".contact-btn").prop("disabled", false);
        },
    });
});

listenSubmit('#newsLatterForm', function (event) {
    event.preventDefault();

    $('#newsLatterModal').prop('disabled', true);
    $.ajax({
        url: 'emailSubscriprion-store',
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#emailSubscription').val('');
                $('#newsLatterModal').modal('hide');
                $('#newsLatterModal').addClass('d-none');
                //  window.location.reload();

                const now = new Date();
                const expires = new Date(now.getTime() + 10 * 365 * 24 * 60 * 60 * 1000);
                document.cookie = "newsletter_popup=2; expires=" + expires.toUTCString();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick('.vcard1-share', function () {
    $('#vcard1-shareModel').modal('show');
});

listenClick(".vcard2-share", function () {
    $("#vcard2-shareModel").modal("show");
});

listenClick(".vcard3-share", function () {
    $("#vcard3-shareModel").modal("show");
});

listenClick(".vcard4-share", function () {
    $("#vcard4-shareModel").modal("show");
});

listenClick(".vcard5-share", function () {
    $("#vcard5-shareModel").modal("show");
});

listenClick(".vcard6-share", function () {
    $("#vcard6-shareModel").modal("show");
});

listenClick(".vcard7-share", function () {
    $("#vcard7-shareModel").modal("show");
});

listenClick(".vcard8-share", function () {
    $("#vcard8-shareModel").modal("show");
});

listenClick(".vcard9-share", function () {
    $("#vcard9-shareModel").modal("show");
});

listenClick(".vcard10-share", function () {
    $("#vcard10-shareModel").modal("show");
});

listenClick(".vcard13-share", function () {
    $("#vcard13-shareModel").modal("show");
});
listenClick(".vcard17-share", function () {
    $("#vcard17-shareModel").modal("show");
});
listenClick(".vcard21-share", function () {
    $("#vcard21-shareModel").modal("show");
});
listenClick(".vcard31-share", function () {
    $("#vcard31-shareModel").modal("show");
});
listenClick(".vcard29-share", function () {
    $("#vcard29-shareModel").modal("show");
});
listenClick(".vcard27-share", function () {
    $("#vcard27-shareModel").modal("show");
});
listenClick(".vcard22-share", function () {
    $("#vcard22-shareModel").modal("show");
});
listenClick(".vcard26-share", function () {
    $("#vcard26-shareModel").modal("show");
});
listenClick(".vcard28-share", function () {
    $("#vcard28-shareModel").modal("show");
});
listenClick(".vcard30-share", function () {
    $("#vcard30-shareModel").modal("show");
});
listenClick(".vcard25-share", function () {
    $("#vcard25-shareModel").modal("show");
});
listenClick(".vcard24-share", function () {
    $("#vcard24-shareModel").modal("show");
});
listenClick(".vcard23-share", function () {
    $("#vcard23-shareModel").modal("show");
});
listenClick(".vcard20-share", function () {
    $("#vcard20-shareModel").modal("show");
});
listenClick(".vcard14-share", function () {
    $("#vcard14-shareModel").modal("show");
});

listenClick(".vcard12-share", function () {
    $("#vcard12-shareModel").modal("show");
});

listenClick(".vcard15-share", function () {
    $("#vcard15-shareModel").modal("show");
});
listenClick(".vcard18-share", function () {
    $("#vcard18-shareModel").modal("show");
});
listenClick(".vcard19-share", function () {
    $("#vcard19-shareModel").modal("show");
});

listenClick(".gallery-link", function () {
    let url = $(this).data("id");
    $("#video").attr("src", url);
});

listenHiddenBsModal("#exampleModal", function () {
    $("#video").attr("src", "");
});

listen("click", ".paymentByPaypal", function () {
    let campaignId = $("#campaignId").val();
    let firstName = $("#firstName").val();
    let LastName = $("#lastName").val();
    let email = $("#email").val();
    let currencyCode = $("#currencyCode").val();
    let amount = $("#amount").val();

    if (amount.trim().length === 0) {
        iziToast.error({
            title: "Error",
            message: "The amount field is required",
            position: "topRight",
        });

        return false;
    } else if (amount === "0") {
        iziToast.error({
            title: "Error",
            message: "The amount is required greater than zero",
            position: "topRight",
        });

        return false;
    } else if (firstName.trim().length === 0) {
        iziToast.error({
            title: "Error",
            message: "The first name field is required",
            position: "topRight",
        });

        return false;
    } else if (LastName.trim().length === 0) {
        iziToast.error({
            title: "Error",
            message: "The last name field is required",
            position: "topRight",
        });

        return false;
    }

    $(this).addClass("disabled");
    $(".donate-btn").text(Lang.get("js.please_wait"));

    $.ajax({
        type: "GET",
        url: route("paypal.init"),
        data: {
            amount: parseFloat($("#amount").val()),
            currency_code: $("#currencyCode").val(),
            campaign_id: campaignId,
            first_name: firstName,
            last_name: LastName,
            email: email,
        },
        success: function (result) {
            if (result.link) {
                window.location.href = result.link;
            }

            if (result.statusCode === 201) {
                let redirectTo = "";

                $.each(result.result.links, function (key, val) {
                    if (val.rel == "approve") {
                        redirectTo = val.href;
                    }
                });
                location.href = redirectTo;
            }
        },
        error: function (error) {
            iziToast.error({
                title: "Error",
                message: error.responseJSON.message,
                position: "topRight",
            });
        },
        complete: function () {},
    });
});

listenClick(".copy-vcard-clipboard", function () {
    let vcardId = $(this).data("id");
    let $temp = $("<input>");
    $(".modal-body").append($temp);
    $temp.val($("#vcardUrlCopy" + vcardId).text()).select();
    document.execCommand("copy");
    $temp.remove();
    displaySuccessMessage(Lang.get("js.copied_successfully"));
});

// $(document).ready(function() {
// Configure/customize these variables.
var showChar = 80; // How many characters are shown by default
var ellipsestext = "...";
var moretext = "Show more";
var lesstext = "Show less";

// $('.more').each(function (key) {
// var content = $(this).html()

// if (content.length > showChar) {

//     var c = content.substr(0, showChar)
//     var h = content.substr(showChar, content.length - showChar)

// var html = c + '<span class="moreellipses">' + ellipsestext +
//     '&nbsp;</span><span class="morecontent"><span>' + h +
//     '</span>&nbsp;&nbsp;<a class="morelink text-decoration-none fw-bold">' +
//     moretext + '</a></span>'
//    var html =  '<p>' + c +  '<span id="dots-'+ key +'">...</span><span class="d-none" id="moreContent-'+ key +'">' + h  + '</span>&nbsp;<a href="javascript:void(0)" data-id="'+ key +'" class="toggle-description toggle-description-'+ key +' text-primary text-decoration-none" id="myBtn-'+ key +'">Show more</a></p>';

//     $(this).html(html)
// }

// })

listenClick(".toggle-description", function () {
    var index = $(this).attr("data-id");
    var dots = $("#dots-" + index);
    var moreText = $("#moreContent-" + index);
    var btnText = $("#myBtn-" + index);

    if (moreText.hasClass("d-none")) {
        moreText.removeClass("d-none");
        dots.addClass("d-none");
        btnText.html("Show less");
    } else {
        dots.removeClass("d-none");
        moreText.addClass("d-none");
        btnText.html("Show More");
    }
});

$(".morelink").click(function () {
    if ($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
    } else {
        $(this).addClass("less");
        $(this).html(lesstext);
    }
    $(this).parent().prev().toggle();
    $(this).prev().toggle();
    return false;
});

$(".next-arrow , .prev-arrow").click(function () {
    $(".morelink").removeClass("less");
    $(".morelink").html(moretext);
    $(".morecontent span").css("display", "none");
});

$(".testimonial-slider, .testimonials-section, .testimonial-box").on(
    "swipe",
    function () {
        $(".morelink").removeClass("less");
        $(".morelink").html(moretext);
        $(".morecontent span").css("display", "none");
    }
);

$(
    ".testimonial-slider, .testimonials-section, .testimonial-box, .testimonial-card, .testimonial-vcard"
).on("beforeChange", function () {
    $(".morelink").removeClass("less");
    $(".morelink").html(moretext);
    $(".morecontent span").css("display", "none");
});

listenClick(".share-to-wp-btn", function () {
    let number = $("#wpNumber");
    if (number.hasClass("d-none")) {
        $(".underline").css("transition", "all 0.5s linear");
        number.removeClass("d-none");
    } else {
        $(".underline").css("transition", "none");
        number.addClass("d-none");
        $(".share-wp-btn").addClass("d-none");
        number.val("");
    }
});

listenClick(".bars-btn", function () {
    $(".sub-btn").fadeToggle();
    let sub_btn = $(".sub-btn");
    if (sub_btn.hasClass("d-none")) {
        sub_btn.removeClass("d-none");
    }
});

listenClick(".bars-btn", function () {
    var os = navigator.platform;
    if (os == "MacIntel" || "ios" || "macos") {
        $("#videobtn").removeClass("d-none");
    }
});

listenClick("#videobtn", function () {
    window.location.href = "facetime://";
});

listenClick(".share-wp-btn", function () {
    let number = $("#wpNumber").val();
    let url = "https://wa.me/" + number + "?text=" + document.URL;
    $("#wpNumber").val("");
    $(".vcard11-input").val("");
    $(".share-wp-btn").addClass("d-none");
    window.open(url, "_blank");
});

$(document).on("keyup", "#wpNumber", function () {
    let btn = $(".share-wp-btn");
    if ($(this).val().length > 0) {
        btn.removeClass("d-none");
    } else {
        btn.addClass("d-none");
    }
});

listenClick(".buy-product", function (e) {
    e.preventDefault();
    $("#productPaymentMethod").select2({
        dropdownParent: $("#buyProductModal"),
    });

    let id = $(this).attr("data-id");
    $("#productId").val(id);
    $("#price").text($(".product-price-" + id).text());

    $("#buyProductModal").modal("show");
});

listenChange('#productPaymentMethod',function()
{
    let value = $(this).val();

    if(value == 3) // if  Manually payment method
    {
        $('.manual-payment-guide').removeClass('d-none');
    }else{
        $('.manual-payment-guide').addClass('d-none');
    }
})

listenSubmit("#productBuyForm", function (event) {
    event.preventDefault();
    $("#buyProductBtn").attr("disabled", true);
    $.ajax({
        url: route("buy.product"),
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                if (result.data.payment_method == 4) {
                    if (result.data[0].original.link) {
                        window.location.href = result.data[0].original.link
                    }
                }
                if (result.data.payment_method == 5) {
                    window.location.href = result.data[0];
                }

                if (result.data.payment_method == 7) {
                    window.location.href = result.data[0];
                }

                if (!isEmpty(result.data)) {
                    if (result.data.payment_method == 1) {
                        let sessionId = result.data[0].sessionId;
                        stripe.redirectToCheckout({
                            sessionId: sessionId,
                        });
                    }
                    if (result.data[0].payment_method == 6) {

                        let { id, amount, name, email, contact } = result.data[0]
                        if (result.data[0]) {
                            let { id, amount, name, email, contact } = result.data[0];
                                options.amount = amount
                                options.order_id = id
                                options.prefill = {
                                    name: name,
                                    email: email,
                                    contact: contact
                                };
                                let razorPay = new Razorpay(options);
                                razorPay.open();
                                razorPay.on('product.payment.failed');
                                return false;
                        }
                    }
                    if (result.data.payment_method == 2) {
                        if (result.data[0].original.link) {
                            window.location.href = result.data[0].original.link;
                        }

                        if (result.data[0].original.statusCode === 201) {
                            let redirectTo = "";

                            $.each(
                                result.data[0].original.result.links,
                                function (key, val) {
                                    if (val.rel == "approve") {
                                        redirectTo = val.href;
                                    }
                                }
                            );
                            location.href = redirectTo;
                        }
                    }
                }
                displaySuccessMessage(result.message);
                $("#productBuyForm")[0].reset();
                $("#buyProductModal").modal("hide");
                $("#buyProductBtn").attr("disabled", false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $("#buyProductBtn").attr("disabled", false);
        },
    });
});

listenHiddenBsModal('#buyProductModal', function () {
    resetModalForm('#productBuyForm');
})


window.onload = function() {
    var currentPageUrl = window.location.href;
    $.ajax({
        url: route("getCookie"),
        type: "GET",
        data: { url: currentPageUrl },
        success: function (result) {
            if (result.success) {
               setTimeout(function() {
                if (document.cookie.includes("newsletter_popup")) {
                    $('#newsLatterModal').modal('hide');
                }else{
                    $('#newsLatterModal').modal('show');
                }
                },result.data);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

listenClick('#closeNewsLatterModal', function () {
    $('#newsLatterModal').modal('hide');
});


listenHiddenBsModal("#newsLatterModal", function () {
    const now = new Date();
    const expires = new Date(now.getTime() + 7 * 24 * 60 * 60 * 1000);
    document.cookie = "newsletter_popup=2; expires=" + expires.toUTCString();
});


document.addEventListener('DOMContentLoaded', function () {
    $('#reelContent').addClass('d-none');
    $('#reelContent').removeClass('d-block');
});
listenClick('.postbtn', function () {
    $('#postContent').addClass('d-block');
    $('#postContent').removeClass('d-none');
    $('#reelContent').addClass('d-none');
    $('#reelContent').removeClass('d-block');
});
listenClick('.reelsbtn', function () {
    $('#postContent').addClass('d-none');
    $('#postContent').removeClass('d-block');
    $('#reelContent').removeClass('d-none');
    $('#reelContent').addClass('d-block');
});


listenClick(".banner-close", function () {
    $(".support-banner").addClass("d-none");
});

// setSubscription popup

//     var playerId = '';
//     function OneSignalFunction() {
//         window.OneSignal = window.OneSignal || [];
//         OneSignal.push(function () {
//             OneSignal.init({
//                 appId: oneSignalAppId,
//             });

//             window.OneSignal.getUserId(function (userId) {
//                 playerId = userId;
//                 console.log('Player id is : ' + playerId);
//                 if (playerId) {
//                     console.log("Calling")
//                     setTimeout(function () {
//                         updateWebPushNotification(playerId)
//                     }, 1000);

//                 }
//             });

//             OneSignal.isPushNotificationsEnabled(function (isEnabled) {
//                 if (isEnabled) {
//                     return;
//                 }
//                 OneSignal.showSlidedownPrompt({ force: true });
//             });

//             OneSignal.on('popoverCancelClick', function (promptClickResult) {
//                 console.log('popoverCancelClick');
//                 OneSignal.setSubscription(false);
//             });

//             OneSignal.on('popoverAllowClick', function (promptClickResult) {
//                 console.log('popoverAllowClick');

//                 OneSignal.setSubscription(true);
//                 setTimeout(function () {
//                     window.location.reload();
//                 }, 8000)
//             });

//         });
//     }

// function updateWebPushNotification(playerID, subscribe = false) {
//     /** Change Web notification Status */
//     let data = {};
//     data.subscribe = subscribe;
//     data.player_id = playerID;
//     data.vcard_alias = window.location.pathname.replace('/', '');

//     if (!playerID) {
//         return;
//     }

//     $.ajax({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
//         url: route('subscribe.vcard'),
//         type: 'post',
//         data: data,
//         success: function (result) {
//             if (result.success) {
//                 // if (reload) {
//                 //     setTimeout(function () {
//                 //         location.reload(); // need timeout here, because we can't direct reload while one signal is processing its data
//                 //     }, 3000);
//                 // }
//                 // $('#editProfileModal').modal('hide');
//             }
//         },
//         error: function (result) {
//             // swal({
//             //     title: 'Subscribe Vcard',
//             //     text: 'Stay up-to-date! Click to uncover the latest update - Simple Tap',
//             //     buttons: {
//             //         confirm:Lang.get('Yes'),
//             //         cancel: Lang.get('No'),
//             //     },
//             //     reverseButtons: true,
//             //     icon: 'assets/img/aboutemail.png',
//             //     }).then(function (success) {
//             //         if (success) {
//             //             updateWebPushNotification(playerID, true)
//             //         }
//             //     });
//         },
//     });
// }


document.addEventListener('DOMContentLoaded', function () {
    if (userlanguage == 'Arabic') {

        var languageBtn = $('.language-btn');
        // languageBtn.append('dir', 'rtl');
        languageBtn.removeClass('end-0');
        languageBtn.addClass('start-0');
    }
})
