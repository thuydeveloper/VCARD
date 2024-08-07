document.addEventListener("turbo:load", loadSettingData);

let form;
let phone;
let prefixCode;

function loadSettingData() {
    TermCondition();
    ManualPaymentGuide();
    if (!$("#createSetting").length) {
        return;
    }
    form = document.getElementById("createSetting");

    form.addEventListener("reset", reset);

    phone = document.getElementById("phoneNumber").value;
    prefixCode = document.getElementById("prefix_code").value;

    let input = document.querySelector("#defaultCountryData");
    let intl = window.intlTelInput(input, {
        initialCountry: defaultCountryCodeValue,
        separateDialCode: true,
        geoIpLookup: function (success, failure) {
            $.get("https://ipinfo.io", function () {}, "jsonp").always(
                function (resp) {
                    var countryCode = resp && resp.country ? resp.country : "";
                    success(countryCode);
                }
            );
        },
        utilsScript: utilsScript,
    });
    let getCode =
        intl.selectedCountryData["name"] +
        "+" +
        intl.selectedCountryData["dialCode"];
    $("#defaultCountryData").val(getCode);
}

listenKeyup("#defaultCountryData", function () {
    let str2 = $(this).val().slice(0, -1) + "";
    return $(this).val(str2);
});

listenClick(".iti__standard,.iti__preferred", function () {
    let defaultCountryCodeInput = $(this).parents('div.iti.iti--allow-dropdown').next('#defaultCountryCode');
    if (defaultCountryCodeInput.length) {
        $("#defaultCountryData").val($(this).text());
        $("#defaultCountryCode").val($(this).attr("data-country-code"));
    }
});

listenChange("#appLogo", function () {
    displayPhoto(this, "#appLogoPreview");
});

listenClick(".cancel-app-logo", function () {
    $("#appLogoPreview").attr("src", defaultAppLogoUrl);
});

listenChange("#favicon", function () {
    displayPhoto(this, "#faviconPreview", true);
});

listenClick(".cancel-favicon", function () {
    $("#faviconPreview").attr("src", defaultFaviconUrl);
});

function reset() {
    document.getElementById("phoneNumber").setAttribute("value", phone);
    document
        .getElementById("prefix_code")
        .setAttribute("value", "+" + prefixCode);
}

function isEmail(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listenSubmit("#createSetting", function () {
    if ($.trim($("#settingAppName").val()) == "") {
        displayErrorMessage(Lang.get("js.app_name_required"));
        return false;
    }

    if (!isEmail($("#settingEmail").val())) {
        displayErrorMessage(Lang.get("js.enter_valid_email"));
        return false;
    }

    if ($.trim($("#phoneNumber").val()) == "") {
        displayErrorMessage(Lang.get("js.phone_number_required"));
        return false;
    }

    if ($.trim($("#settingPlanExpireNotification").val()) == "") {
        displayErrorMessage(Lang.get("js.plan_expire_notification"));
        return false;
    }

    if ($.trim($("#settingAddress").val()) == "") {
        displayErrorMessage(Lang.get("js.address_field"));
        return false;
    }

    if ($("#paypal_payment").prop("checked") && $("")) {
    }

    if ($("#defaultCountryCode").val() != defaultCountryCodeValue) {
        $("#createSetting")[0].submit();
    }
});

listenChange("#mobileValidation", function (e) {
    e.preventDefault();
    $.ajax({
        url: route("update.mobile.validation"),
        method: "POST",
        success: function (result) {
            window.location.reload();
        },
    });
});

listen("click", ".stripe-enable", function () {
    $(".stripe-div").toggleClass("d-none");
});

listen("click", ".flutterwave-enable", function () {
    $(".flutterwave-div").toggleClass("d-none");
});

listen("click", ".paystack-enable", function () {
    $(".paystack-div").toggleClass("d-none");
});

// listen('click', '.notifation-enable', function () {
//     $('.notifation-div').toggleClass('d-none')
// })

listen("click", ".phonepe-enable", function () {
    $(".phonepe-div").toggleClass("d-none");
});

listen("click", ".paypal-enable", function () {
    $(".paypal-div").toggleClass("d-none");
});

listen("click", "#paypal_payment", function () {
    console.log("true");
    $(".paypal-cred").toggleClass("d-none");
});

listen("click", "#stripe_payment", function () {
    $(".stripe-cred").toggleClass("d-none");
});

listen("click", "#phonepe_payment", function () {
    $(".phonepe-cred").toggleClass("d-none");
});

listen("click", "#paystack_payment", function () {
    $(".paystack-cred").toggleClass("d-none");
});

listen("click", "#manually_payment", function () {
    $(".manually-cred").toggleClass("d-none");
});

$(document).on("click", "#userManualPaymentSetting", function () {
    $(".user-manually-cred").toggleClass("d-none", !this.checked);
});

listen("click", "#razorpay_payment", function () {
    $(".razorpay-cred").toggleClass("d-none");
});
listen("click", "#rozorpayEnable", function () {
    $(".razorpay-cred").toggleClass("d-none");
});

listen("click", "#flutterwave_payment", function () {
    $(".flutterwave-cred").toggleClass("d-none");
});

listen("click", ".pwa-enable", function () {
    $(".pwa-div").toggleClass("d-none");
});

listen("submit", "#UserCredentialsSettings", function () {
    if ($("#stripeEnable").prop("checked")) {
        if ($("#stripeKey").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.stripe_secret"));
            return false;
        } else if ($("#stripeSecret").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.stripe_secret"));
            return false;
        }
    }

    if ($("#paystackEnable").prop("checked")) {
        if ($("#paystackKey").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.paystack_key"));
            return false;
        } else if ($("#paystackSecret").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.paystack_secret"));
            return false;
        }
    }

    if ($("#flutterwaveEnable").prop("checked")) {
        if ($("#flutterwaveKey").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.flutterwave_key"));
            return false;
        } else if ($("#flutterwaveSecret").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.flutterwave_secret"));
            return false;
        }
    }

    // if ($('#notifationEnable').prop('checked')) {
    //     if ($('#onesignalAppId').val().trim().length === 0) {
    //         displayErrorMessage(Lang.get('js.onesignal_app_id'))
    //         return false
    //     } else if ($('#onesignalRestApiKey').val().trim().length === 0) {
    //         displayErrorMessage(Lang.get('js.onesignal_rest_api_key'))
    //         return false
    //     }
    // }

    if ($("#paypalEnable").prop("checked")) {
        if ($("#paypalKey").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.paypal_key"));
            return false;
        } else if ($("#paypalSecret").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.paypal_secret"));
            return false;
        } else if ($("#paypalMode").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.paypal_mode"));
            return false;
        }
    }

    if ($("#rozorpayEnable").prop("checked")) {
        if ($("#razorpayKey").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.razorpay_key"));
            return false;
        } else if ($("#razorpaySecret").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.razorpay_secret"));
            return false;
        }
    }

    if ($("#phonepeEnable").prop("checked")) {
        if ($("#phonepeMerchantId").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.phonepe_merchant_id_required"));
            return false;
        } else if ($("#phonepeMerchantUserId").val().trim().length === 0) {
            displayErrorMessage(
                Lang.get("js.phonepe_merchant_user_id_required")
            );
            return false;
        } else if ($("#phonepeEnv").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.phonepe_env_required"));
            return false;
        } else if ($("#phonepeSaltKey").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.phonepe_salt_key_required"));
            return false;
        } else if ($("#phonepeSaltIndex").val().trim().length === 0) {
            displayErrorMessage(Lang.get("js.phonepe_salt_index_required"));
            return false;
        } else if (
            $("#phonepeMerchantTransactionId").val().trim().length === 0
        ) {
            displayErrorMessage(
                Lang.get("js.phonepe_merchant_transaction_id_required")
            );
            return false;
        }
    }

    processingBtn(
        "#UserCredentialsSettings",
        "#userCredentialSettingBtn",
        "loading"
    );
    $("#userCredentialSettingBtn").prop("disabled", true);
});
function TermCondition() {
    if (!$("#termConditionId").length || !$("#privacyPolicyId").length) {
        return;
    }
    quill1 = new Quill("#termConditionId", {
        modules: {
            toolbar: [
                [
                    {
                        header: [1, 2, false],
                    },
                ],
                ["bold", "italic", "underline"],
                ["image", "code-block"],
            ],
        },
        placeholder: Lang.get("js.term_condition").replace(/&amp;/g, "&"),
        theme: "snow", // or 'bubble'
    });

    quill1.on("text-change", function (delta, oldDelta, source) {
        if (quill1.getText().trim().length === 0) {
            quill1.setContents([{ insert: " " }]);
        }
    });
    quill2 = new Quill("#privacyPolicyId", {
        modules: {
            toolbar: [
                [
                    {
                        header: [1, 2, false],
                    },
                ],
                ["bold", "italic", "underline"],
                ["image", "code-block"],
            ],
        },
        placeholder: Lang.get("js.privacy_policy"),
        theme: "snow", // or 'bubble'
    });

    quill2.on("text-change", function (delta, oldDelta, source) {
        if (quill2.getText().trim().length === 0) {
            quill2.setContents([{ insert: "" }]);
        }
    });

    let element = document.createElement("textarea");
    element.innerHTML = $("#termConditionData").val();
    quill1.root.innerHTML = element.value;
    element.innerHTML = $("#privacyPolicyData").val();
    quill2.root.innerHTML = element.value;

    listenSubmit("#TermsConditions", function () {
        let elements = document.createElement("textarea");
        let editor_content_1 = quill1.root.innerHTML;

        elements.innerHTML = editor_content_1;
        let editor_content_2 = quill2.root.innerHTML;
        if (quill1.getText().trim().length === 0) {
            editor_content_1 = "";
        }

        if (quill2.getText().trim().length === 0) {
            editor_content_2 = "";
        }

        $("#termData").val(JSON.stringify(editor_content_1));
        $("#privacyData").val(JSON.stringify(editor_content_2));
    });
}

function ManualPaymentGuide() {
    if (!$("#manualPaymentGuideId").length) {
        return;
    }
    quill = new Quill("#manualPaymentGuideId", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ direction: "rtl" }],
                [{ color: [] }, { background: [] }],
                [{ font: [] }],
                [{ align: [] }],
                ["image", "code-block"],
            ],
        },
        placeholder: Lang.get("js.manual_payment_guide"),
        theme: "snow", // or 'bubble'
    });

    quill.on("text-change", function (delta, oldDelta, source) {
        if (quill.getText().trim().length === 0) {
            quill.setContents([{ insert: "" }]);
        }
    });

    let element = document.createElement("textarea");
    element.innerHTML = $("#manualPaymentGuideData").val();
    quill.root.innerHTML = element.value;

    listenSubmit("#SuperAdminCredentialsSettings", function () {
        let elements = document.createElement("textarea");
        let editor_content = quill.root.innerHTML;

        elements.innerHTML = editor_content;
        if (quill.getText().trim().length === 0) {
            editor_content = "";
        }

        $("#guideData").val(editor_content);
    });

    listenSubmit("#UserCredentialsSettings", function () {
        let elements = document.createElement("textarea");
        let editor_content = quill.root.innerHTML;

        elements.innerHTML = editor_content;
        if (quill.getText().trim().length === 0) {
            editor_content = "";
        }

        $("#guideData").val(editor_content);
    });
}

listenChange("#appLogo", function () {
    let fileExtension = ["jpeg", "jpg", "png", "gif", "bmp"];
    if (
        $.inArray(
            $(this).val().split(".").pop().toLowerCase(),
            fileExtension
        ) === -1
    ) {
        displayErrorMessage(
            "The app logo must be a file of type: jpg, jpeg, png, gif, bmp."
        );
        $(this).val("");
        return false;
    }
});

listenChange("#favicon", function () {
    let fileExtension = ["jpeg", "jpg", "png", "gif", "bmp"];
    if (
        $.inArray(
            $(this).val().split(".").pop().toLowerCase(),
            fileExtension
        ) === -1
    ) {
        displayErrorMessage(
            "The favicon must be a file of type: jpg, jpeg, png, gif, bmp."
        );
        $(this).val("");
        return false;
    }
});

listenSubmit("#createSetting", function () {
    let affiliationAmount = $("#affiliationAmount").val();
    let affiliationAmountType = $("#affiliationAmountType").val();
    let affiliationAmountError = $("#affiliationAmountError");

    affiliationAmountError.text("");

    if (affiliationAmountType === "2" && parseFloat(affiliationAmount) > 100) {
         let errorMessage = Lang.get("js.affiliation_amount_error");
        affiliationAmountError.text(errorMessage);
        return false;
    }
});

listenClick('.copy-delete-account-url', function() {
    let $temp = $('<input>');
    $('body').append($temp);
    $temp.val($('#deleteAccountURL').text()).select();
    document.execCommand('copy');
    $temp.remove();
    displaySuccessMessage(Lang.get('js.copied_successfully'));
});
