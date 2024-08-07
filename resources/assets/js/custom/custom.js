"use strict";
let jsrender = require("jsrender");
let csrfToken = $('meta[name="csrf-token"]').attr("content");

document.addEventListener("turbo:load", initAllComponents);

function initAllComponents() {
    select2initialize();
    refreshCsrfToken();
    alertInitialize();
    modalInputFocus();
    inputFocus();
    IOInitImageComponent();
    IOInitSidebar();
    togglePassword();
    vcardTableCardRemove();
    tooltip();
    frontTestimonials();
}

function tooltip() {
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function togglePassword() {
    $('[data-toggle="password"]').each(function () {
        var input = $(this);
        var eye_btn = $(this).parent().find(".input-icon");
        eye_btn.css("cursor", "pointer").addClass("input-password-hide");
        eye_btn.on("click", function () {
            if (eye_btn.hasClass("input-password-hide")) {
                eye_btn
                    .removeClass("input-password-hide")
                    .addClass("input-password-show");
                eye_btn
                    .find(".bi")
                    .removeClass("bi-eye-slash-fill")
                    .addClass("bi-eye-fill");
                input.attr("type", "text");
            } else {
                eye_btn
                    .removeClass("input-password-show")
                    .addClass("input-password-hide");
                eye_btn
                    .find(".bi")
                    .removeClass("bi-eye-fill")
                    .addClass("bi-eye-slash-fill");
                input.attr("type", "password");
            }
        });
    });
}

function alertInitialize() {
    $(".alert").delay(5000).slideUp(300);
}

function refreshCsrfToken() {
    csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    });
}

function select2initialize() {
    $('[data-control="select2"]').each(function () {
        $(this).select2();
    });
}

document.addEventListener("click", function (e) {
    let filterBtnEle = $(e.target).closest(
        '.show[data-ic-dropdown-btn="true"]'
    );
    let filterDropDownEle = $(e.target).closest(
        '.show[data-ic-dropdown="true"]'
    );

    if (!(filterBtnEle.length > 0 || filterDropDownEle.length > 0)) {
        $('[data-ic-dropdown-btn="true"]').removeClass("show");
        $('[data-ic-dropdown="true"]').removeClass("show");
    }
});

document.addEventListener("livewire:load", function () {
    window.livewire.hook("message.processed", () => {
        $('[data-control="select2"]').each(function () {
            $(this).select2();
        });
    });
});

const inputFocus = () => {
    $(
        'input:text:not([readonly="readonly"]):not([name="search"]):not(.front-input)'
    )
        .first()
        .focus();
};

const modalInputFocus = () => {
    $(function () {
        $(".modal").on("shown.bs.modal", function () {
            if ($(this).find("input:text")[0]) {
                $(this).find("input:text")[0].focus();
            }
        });
    });
};

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).on("select2:open", () => {
    document.querySelector(".select2-search__field").focus();
});

toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

window.resetModalForm = function (formId, validationBox = null) {
    $(formId)[0].reset();
    $("select.select2Selector").each(function (index, element) {
        let drpSelector = "#" + $(this).attr("id");
        $(drpSelector).val("");
        $(drpSelector).trigger("change");
    });
    $(validationBox).hide();
};

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html("");
    $(selector).text(errorResult.responseJSON.message);
};

window.manageAjaxErrors = function (data) {
    var errorDivId =
        arguments.length > 1 && arguments[1] !== undefined
            ? arguments[1]
            : "editValidationErrorsBox";
    if (data.status == 404) {
        toastr.error(data.responseJSON.message);
    } else {
        printErrorMessage("#" + errorDivId, data);
    }
};

window.displaySuccessMessage = function (message) {
    if(lang == "ar"){
        toastr.options.rtl = "rtl";
        toastr.options.positionClass = "toast-top-left";
    } else {
        toastr.options.positionClass = "toast-top-right";
    }
    toastr.success(message, Lang.get("js.successful"));
};

window.displayErrorMessage = function (message) {
    if(lang == "ar"){
        toastr.options.rtl = "rtl";
        toastr.options.positionClass = "toast-top-left";
    } else {
        toastr.options.positionClass = "toast-top-right";
    }
    toastr.error(message, Lang.get("js.error"));
};

window.deleteItem = function (url, header) {
    var callFunction =
        arguments.length > 3 && arguments[3] !== undefined
            ? arguments[3]
            : null;
    swal({
        title: Lang.get("js.delete") + " !",
        text: Lang.get("js.are_you_sure") + ' "' + header + '" ?',
        buttons: {
            confirm: Lang.get("js.yes"),
            cancel: Lang.get("js.no"),
        },
        reverseButtons: true,
        icon: sweetAlertIcon,
    }).then(function (willDelete) {
        if (willDelete) {
            deleteItemAjax(url, header, callFunction);
        }
    });
};

function deleteItemAjax(url, header, callFunction = null) {
    $.ajax({
        url: url,
        type: "DELETE",
        dataType: "json",
        success: function (obj) {
            if (obj.success) {
                Livewire.dispatch("resetPageTable");
                Livewire.dispatch("refresh");
            }
            swal({
                icon: "success",
                title: Lang.get("js.deleted") + " !",
                text: header + " " + Lang.get("js.has_been_deleted"),
                timer: 2000,
                buttons: {
                    confirm: Lang.get("js.ok"),
                },
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: Lang.get("js.error"),
                icon: "error",
                text: data.responseJSON.message,
                type: "error",
                timer: 4000,
                buttons: {
                    confirm: Lang.get("js.ok"),
                },
            });
        },
    });
}

window.format = function (dateTime, dateFormat = "DD-MMM-YYYY") {
    var format =
        arguments.length > 1 && arguments[1] !== undefined
            ? arguments[1]
            : dateFormat;
    return moment(dateTime).format(format);
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId);
    if (state === "loading") {
        loadingButton.button("loading");
    } else {
        loadingButton.button("reset");
    }
};

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

window.changeImg = function (
    inputSelector,
    imgErrorsSelector,
    previewSelector,
    defaultImg
) {
    let validFile = isValidFile($(inputSelector), imgErrorsSelector);
    if (validFile) {
        displayPhoto(inputSelector, previewSelector);
    } else {
        $("#servicePreview").attr("src", defaultImg);
    }
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split(".").pop().toLowerCase();
    if ($.inArray(ext, ["png", "jpg", "jpeg"]) == -1) {
        $(inputSelector).val("");
        $(validationMessageSelector).removeClass("d-none");
        $(validationMessageSelector)
            .html("The image must be a file of type: jpeg, jpg, png.")
            .show();
        $(validationMessageSelector).delay(5000).slideUp(300);

        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr("src", e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};
window.removeCommas = function (str) {
    return str.replace(/,/g, "");
};

window.DatetimepickerDefaults = function (opts) {
    return $.extend(
        {},
        {
            sideBySide: true,
            ignoreReadonly: true,
            icons: {
                close: "fa fa-times",
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
                today: "fa fa-clock-o",
                clear: "fa fa-trash-o",
            },
        },
        opts
    );
};

window.isEmpty = (value) => {
    return value === undefined || value === null || value === "";
};

window.screenLock = function () {
    $("#overlay-screen-lock").show();
    $("body").css({ "pointer-events": "none", opacity: "0.6" });
};

window.screenUnLock = function () {
    $("body").css({ "pointer-events": "auto", opacity: "1" });
    $("#overlay-screen-lock").hide();
};

window.onload = function () {
    window.startLoader = function () {
        $(".infy-loader").show();
    };

    window.stopLoader = function () {
        $(".infy-loader").hide();
    };

    // infy loader js
    stopLoader();
};

$(document).ready(function () {
    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document)
        .find(".nav-item.dropdown ul li")
        .hasClass("active");
    if (hasActiveMenu) {
        $(document)
            .find(".nav-item.dropdown ul li.active")
            .parent("ul")
            .css("display", "block");
        $(document)
            .find(".nav-item.dropdown ul li.active")
            .parent("ul")
            .parent("li")
            .addClass("active");
    }
});

window.urlValidation = function (value, regex) {
    let urlCheck = value == "" ? true : value.match(regex) ? true : false;
    if (!urlCheck) {
        return false;
    }

    return true;
};

listenClick(".languageSelection", function () {
    let languageName = $(this).data("prefix-value");
    $.ajax({
        type: "POST",
        url: "/change-language",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: { languageName: languageName },
        success: function () {
            location.reload();
        },
    });
});

if ($(window).width() > 992) {
    $(".no-hover").on("click", function () {
        $(this).toggleClass("open");
    });
}

$(document).on("click", "#readNotification", function (e) {
    e.preventDefault();
    let notificationId = $(this).data("id");
    let notification = $(this);
    $.ajax({
        type: "POST",
        url: readNotification + "/" + notificationId + "/read",
        data: { notificationId: notificationId },
        success: function () {
            notification.remove();
            let notificationCounter =
                document.getElementsByClassName("readNotification").length;
            if (notificationCounter == 0) {
                $("#readAllNotification").addClass("d-none");
                $(".empty-state").removeClass("d-none");
                $(".notification-toggle").removeClass("beep");
            }
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$("#register").on("click", function (e) {
    e.preventDefault();
    $(".open #dropdownLanguage").trigger("click");
    $(".open #dropdownLogin").trigger("click");
});

$("#language").on("click", function (e) {
    e.preventDefault();
    $(".open #dropdownRegister").trigger("click");
    $(".open #dropdownLogin").trigger("click");
});

$("#login").on("click", function (e) {
    e.preventDefault();
    $(".open #dropdownRegister").trigger("click");
    $(".open #dropdownLanguage").trigger("click");
});

window.preparedTemplate = function () {
    let source = $("#actionTemplate").html();
    window.preparedTemplate = Handlebars.compile(source);
};

$(document).delegate("textarea", "keydown", function (e) {
    let keyCode = e.keyCode || e.which;
    if (keyCode === 9) {
        e.preventDefault();
        let start = this.selectionStart;
        let end = this.selectionEnd;
        let text = $(this).val();
        let selText = text.substring(start, end);
        $(this).val(
            text.substring(0, start) +
                "\t" +
                selText.replace(/\n/g, "\n\t") +
                text.substring(end)
        );
        this.selectionStart = this.selectionEnd = start + 1;
    }
});

$(document).ready(function () {
    $("#languageDropdown").click(function (e) {
        e.stopPropagation();
    });
});

function isEmailEditProfile(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listenSubmit("#userProfileEditForm", function () {
    if ($.trim($("#editProfileFirstName").val()) == "") {
        displayErrorMessage(Lang.get("js.first_name_required"));
        return false;
    }

    if ($.trim($("#editProfileLastName").val()) == "") {
        displayErrorMessage(Lang.get("js.last_name_required"));
        return false;
    }

    if (!isEmailEditProfile($("#isEmailEditProfile").val())) {
        displayErrorMessage(Lang.get("js.enter_valid_email"));
        return false;
    }

    if (!$("#userProfileEditForm").find("#error-msg").hasClass("d-none")) {
        return false;
    }
});

window.openDropdownManually = function (dropdownBtnEle, dropdownEle) {
    if (!dropdownBtnEle.hasClass("show")) {
        dropdownBtnEle.addClass("show");
        dropdownEle.addClass("show");
    } else {
        dropdownBtnEle.removeClass("show");
        dropdownEle.removeClass("show");
    }
};

window.hideDropdownManually = function (dropdownBtnEle, dropdownEle) {
    dropdownBtnEle.removeClass("show");
    dropdownEle.removeClass("show");
};

function vcardTableCardRemove() {
    listenClick("#vcards-tab", function () {
        $(".card-check").removeClass("card");
        $(".card-body-check").removeClass("card-body");
    });

    listenClick("#overview-tab", function () {
        $(".card-check").addClass("card");
        $(".card-body-check").addClass("card-body");
    });
}

function frontTestimonials() {
    if ($(".pricing-carousel").length > 0) {
        $("#toogler-icon").click(function () {
            $(this).toggleClass("open");
        });
        $(".pricing-carousel").slick({
            dots: true,
            centerMode: true,
            centerPadding: "0",
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: "250px",
                    },
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: "150px",
                    },
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: "100px",
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: "50px",
                        arrows: false,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        arrows: false,
                    },
                },
            ],
        });
        $(".testimonial-carousel").slick({
            // autoplay: true,
            autoplaySpeed: 1000,
            speed: 600,
            draggable: true,
            infinite: true,
            dots: true,
            centerMode: true,
            centerPadding: "0",
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        // centerPadding: '250px',
                    },
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        // centerMode: true,
                        // centerPadding: '120px',
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        // centerPadding: '50px',
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }
}

window.checkPhpFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split(".").pop().toLowerCase();
    if ($.inArray(ext, ["php"]) !== -1) {
        $(inputSelector).val("");
        $(validationMessageSelector).removeClass("d-none");
        $(validationMessageSelector)
            .html("PHP file is not valid type for attachment")
            .show();
        $(validationMessageSelector).delay(5000).slideUp(300);

        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

// window.downloadVcard = function (fileName, id) {
//     $('.spinner-border').removeClass('d-none');
//     $.ajax({
//         url: '/vcards/' + id,
//         type: 'GET',
//         success: function (result) {
//             if (result.success) {
//                 let vcard = result.data
//                 let url = vcard.social_link.website ?? appUrl + '/' +
//                     vcard.url_alias
//                 let vcardString = 'BEGIN:VCARD\n' +
//                     'VERSION:3.0\n'

//                 if (!isEmpty(vcard.first_name) || !isEmpty(vcard.last_name)) {
//                     vcardString += 'N;CHARSET=UTF-8:' + vcard.last_name + ';' +
//                         vcard.first_name + ';;;\n'
//                 }
//                 if (!isEmpty(vcard.dob)) {
//                     vcardString += 'BDAY;CHARSET=UTF-8:' + new Date(vcard.dob) +
//                         '\n'
//                 }
//                 if (!isEmpty(vcard.email)) {
//                     vcardString += 'EMAIL;CHARSET=UTF-8:' + vcard.email + '\n'
//                 }
//                 if (!isEmpty(vcard.alternative_email)) {
//                     vcardString += 'EMAIL;CHARSET=UTF-8:' +
//                         vcard.alternative_email + '\n'
//                 }
//                 if (!isEmpty(vcard.job_title)) {
//                     vcardString += 'TITLE;CHARSET=UTF-8:' + vcard.job_title +
//                         '\n'
//                 }
//                 if (!isEmpty(vcard.company)) {
//                     vcardString += 'ORG;CHARSET=UTF-8:' + vcard.company + '\n'
//                 }
//                 if (!isEmpty(vcard.region_code) && !isEmpty(vcard.phone)) {
//                     vcardString += 'TEL;TYPE=WORK,VOICE:' + '+' +
//                         vcard.region_code + ' ' + vcard.phone + '\n'
//                 }
//                 if (!isEmpty(vcard.region_code) &&
//                     !isEmpty(vcard.alternative_phone)) {
//                     vcardString += 'TEL;TYPE=WORK,VOICE:' + '+' +
//                         vcard.region_code + ' ' + vcard.alternative_phone + '\n'
//                 }
//                 if (!isEmpty(vcard.url_alias)) {
//                     vcardString += 'URL;CHARSET=UTF-8:' + url + '\n'
//                 }
//                 if (!isEmpty(vcard.description)) {
//                     vcardString += 'NOTE;CHARSET=UTF-8:' + vcard.description +
//                         '\n'
//                 }
//                 if (!isEmpty(vcard.location)) {
//                     vcardString += 'ADR;CHARSET=UTF-8:' + vcard.location + '\n'
//                 }
//                 var extension = vcard.profile_url.split('.').pop()
//                 vcardString += 'PHOTO;ENCODING=BASE64;TYPE=' +
//                     extension.toUpperCase() + ':' + vcard.profile_url_base64 +
//                     '\n'
//                 vcardString += 'REV:' + moment().toISOString() + '\n'
//                 vcardString += 'END:VCARD'

//                 var a = $('<a />')
//                 a.attr('download', fileName)
//                 a.attr('href',
//                     'data:text/vcard;charset=UTF-8,' + encodeURI(vcardString))
//                 $('body').append(a)
//                 a[0].click()
//                 $('body').remove(a)
//             }
//             $('.download-icon').removeClass('d-none');
//             $('.spinner-border').addClass('d-none');
//         },
//         error: function (result) {
//             displayError('#enquiryError', result.responseJSON.message)
//         },
//     })
// }

window.allowAlphaNumeric = function (input) {
    input.value = input.value
        .toUpperCase()
        .split(/[^a-zA-Z0-9_-]/)
        .join("");
};

window.getCurrencyAmount = (amount, currencyCode) => {
    var formattedAmount = currencyCode + "" + amount;
    if (currencyAfterAmount == true) {
        formattedAmount = amount + "" + currencyCode;
    }

    return formattedAmount;
};

$(document).ready(function () {
    var $searchTrigger = $('[data-ic-class="search-trigger"]'),
        $searchInput = $('[data-ic-class="search-input"]'),
        $searchClear = $('[data-ic-class="search-clear"]');

    $searchTrigger.click(function () {
        $(".share-wp-btn").addClass("d-none");
        var $this = $('[data-ic-class="search-trigger"]');
        $this.addClass("active");
        $searchInput.focus();
    });

    $searchInput.blur(function () {
        if ($searchInput.val().length > 0) {
            return false;
        } else {
            $searchTrigger.removeClass("active");
        }
    });

    $searchClear.click(function () {
        $searchInput.val("");
    });

    $searchInput.focus(function () {
        $searchTrigger.addClass("active");
    });
});

listenChange(".file-validation", function () {
    let ext = $(this).val().split(".").pop().toLowerCase();
    if ($.inArray(ext, ["png", "jpg", "jpeg"]) == -1) {
        displayErrorMessage(Lang.get("js.allowed_file_types"));
        $(this).val("");
    }
});

// delete multiples success event JS code
document.addEventListener("bulk-delete-vcard", function (data) {
    let vcardIds = data.detail;

    if (vcardIds.length > 0) {
        swal({
            title: "Delete" + " !",
            text: Lang.get("js.are_you_sure_want_to_delete_selected_Vcards"),
            buttons: {
                confirm: "Yes",
                cancel: "No",
            },
            reverseButtons: true,
            icon: sweetAlertIcon,
        }).then(function (willDelete) {
            if (willDelete) {
                Livewire.dispatch("deleteVcard", vcardIds);
            }
        });
    } else {
        displayErrorMessage(
            "Please select one or more records for multiples delete."
        );
        return false;
    }
});

document.addEventListener("delete-vcard-success", function () {
    Livewire.dispatch("refresh");
    Livewire.dispatch("resetPageTable");
    swal({
        icon: "success",
        title: Lang.get("js.deleted") + " !",
        text: "Vcards " + Lang.get("js.has_been_deleted"),
        timer: 3000,
        buttons: {
            confirm: Lang.get("js.ok"),
        },
    });
});

document.addEventListener("bulk-delete-error", function () {
    displayErrorMessage(
        "Please select one or more records for multiples delete."
    );
});

// delete multiples success event JS code
document.addEventListener("bulk-delete-vcard", function (data) {
    let vcardIds = data.detail;

    if (vcardIds.length > 0) {
        swal({
            title: "Delete" + " !",
            text: Lang.get("js.are_you_sure_want_to_delete_selected_Vcards"),
            buttons: {
                confirm: "Yes",
                cancel: "No",
            },
            reverseButtons: true,
            icon: sweetAlertIcon,
        }).then(function (willDelete) {
            if (willDelete) {
                Livewire.dispatch("deleteVcard", vcardIds);
            }
        });
    } else {
        displayErrorMessage(
            "Please select one or more records for multiples delete."
        );
        return false;
    }
});

document.addEventListener("delete-vcard-success", function () {
    Livewire.dispatch("refresh");
    Livewire.dispatch("resetPageTable");
    swal({
        icon: "success",
        title: Lang.get("messages.common.deleted") + " !",
        text: "Vcards " + Lang.get("messages.common.has_been_deleted"),
        timer: 3000,
        buttons: {
            confirm: Lang.get("messages.common.ok"),
        },
    });
});

document.addEventListener("bulk-delete-error", function () {
    displayErrorMessage(
        "Please select one or more records for multiples delete."
    );
});
// delete multiples success event JS code
document.addEventListener("bulk-delete-vcard", function (data) {
    let vcardIds = data.detail;

    if (vcardIds.length > 0) {
        swal({
            title: "Delete" + " !",
            text: Lang.get("js.are_you_sure_want_to_delete_selected_Vcards"),
            buttons: {
                confirm: "Yes",
                cancel: "No",
            },
            reverseButtons: true,
            icon: sweetAlertIcon,
        }).then(function (willDelete) {
            if (willDelete) {
                Livewire.dispatch("deleteVcard", vcardIds);
            }
        });
    } else {
        displayErrorMessage(
            "Please select one or more records for multiples delete."
        );
        return false;
    }
});

document.addEventListener("delete-vcard-success", function () {
    Livewire.dispatch("refresh");
    Livewire.dispatch("resetPageTable");
    swal({
        icon: "success",
        title: Lang.get("js.deleted") + " !",
        text: "Vcards " + Lang.get("js.has_been_deleted"),
        timer: 3000,
        buttons: {
            confirm: Lang.get("js.ok"),
        },
    });
});

document.addEventListener("bulk-delete-error", function () {
    displayErrorMessage(
        "Please select one or more records for multiples delete."
    );
});

listenChange("#primary_color", function () {
    let primaryColor = $("#primary_color").val();
    document.documentElement.style.setProperty("--primary-color", primaryColor);
});
listenChange("#back_color", function () {
    let backColor = $("#back_color").val();
    document.documentElement.style.setProperty("--green-100", backColor);
});
listenChange("#back_seconds_color", function () {
    let backSecondColor = $("#back_seconds_color").val();
    document.documentElement.style.setProperty("--green", backSecondColor);
});
listenChange("#cards_back", function () {
    let cardsBackColor = $("#cards_back").val();
    document.documentElement.style.setProperty("--light", cardsBackColor);
});
listenChange("#social_icon_color", function () {
    let socialIconColor = $("#social_icon_color").val();
    $(".soical-icon-color").attr("fill", socialIconColor);
    $(".icon-color").attr("fill", socialIconColor);
    document.documentElement.style.setProperty("--light-100", socialIconColor);
});
listenChange("#button_text_color", function () {
    let buttonTextColor = $("#button_text_color").val();
    document.documentElement.style.setProperty("--black", buttonTextColor);
});
listenChange("#text_description_color", function () {
    let textDescriptionColor = $("#text_description_color").val();
    document.documentElement.style.setProperty(
        "--gray-100",
        textDescriptionColor
    );
});
listenChange("#text_label_color", function () {
    let textLabelColor = $("#text_label_color").val();
    document.documentElement.style.setProperty("--white", textLabelColor);
});

listenClick(".sticky-btn", function () {
    if ($(this).val() == 1) {
        $("#sticky-dynamic-btn")
            .removeClass("dynamic-sticky-left")
            .addClass("dynamic-sticky-right");
    } else {
        $("#sticky-dynamic-btn")
            .removeClass("dynamic-sticky-right")
            .addClass("dynamic-sticky-left");
    }
});

window.onload = function () {
    let primaryColor = $("#primary_color").val();
    document.documentElement.style.setProperty("--primary-color", primaryColor);

    let backColor = $("#back_color").val();
    document.documentElement.style.setProperty("--green-100", backColor);

    let backSecondColor = $("#back_seconds_color").val();
    document.documentElement.style.setProperty("--green", backSecondColor);

    let buttonTextColor = $("#button_text_color").val();
    document.documentElement.style.setProperty("--black", buttonTextColor);

    let cardsBackColor = $("#cards_back").val();
    document.documentElement.style.setProperty("--light", cardsBackColor);

    let socialIconColor = $("#social_icon_color").val();
    $(".soical-icon-color").attr("fill", socialIconColor);
    $(".icon-color").attr("fill", socialIconColor);
    document.documentElement.style.setProperty("--light-100", socialIconColor);

    let textDescriptionColor = $("#text_description_color").val();
    document.documentElement.style.setProperty(
        "--gray-100",
        textDescriptionColor
    );

    let textLabelColor = $("#text_label_color").val();
    document.documentElement.style.setProperty("--white", textLabelColor);
};
//dynamic buttons
document.addEventListener("DOMContentLoaded", function () {
    applyButtonStyle("dynamic-btn");
    applyButtonStyle("send-btn");
    applyButtonStyle("appointment-btn");
    applyButtonStyle("select-language-btn");
    applyButtonStyle("support-banner-btn");
    previewButtonStyle("appointment-slot1");
    previewButtonStyle("appointment-slot2");
    previewButtonStyle("appointment-slot3");
    previewButtonStyle("appointment-slot4");
});

function applyButtonStyle(buttonId) {
    const button = document.getElementById(buttonId);
    if (!button) {
        return;
    }
    let buttonStyle = button.getAttribute("data-button-style");
    if (buttonStyle === "default" || !buttonStyle) {
        buttonStyle = "1";
    }
    button.classList.add(`dynamic-btn-${buttonStyle}`);
}

listenClick(".button-style", function () {
    previewButtonStyle("dynamic-btn");
    previewButtonStyle("send-btn");
    previewButtonStyle("appointment-btn");
    previewButtonStyle("select-language-btn");
    previewButtonStyle("support-banner-btn");
    previewButtonStyle("appointment-slot1");
    previewButtonStyle("appointment-slot2");
    previewButtonStyle("appointment-slot3");
    previewButtonStyle("appointment-slot4");
});

function previewButtonStyle(buttonId) {
    const button = document.getElementById(buttonId);
    if (!button) {
        return;
    }
    let buttonStyle = $("input[name='button_style']:checked").val();

    if (buttonStyle === "default" || !buttonStyle) {
        buttonStyle = "1";
    }
    button.className = `dynamic-btn-${buttonStyle}`;
}
