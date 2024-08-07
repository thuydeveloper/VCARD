document.addEventListener("turbo:load", loadCustomData);
function loadCustomData() {
    $(".vcard-numbers").each(function () {
        let selectedOption = $(this).find("option:selected");
        let planId = $(this).attr("data-plan-id");
        let choosePaymnetURL = route("choose.payment.type", planId);
        $("#vcardNumberSelect-" + planId).select2();
        $("#planId" + planId).attr(
            "href",
            choosePaymnetURL + "?customFieldId=" + selectedOption.val()
        );
        $("#planId" + planId).removeClass("freePayment");
    });
    $("#userStatus").select2();
}

listenChange(".vcard-numbers", function () {
    let selectedOption = $(this).find("option:selected");
    let newPrice = selectedOption.data("price");
    let planId = $(this).data("plan-id");
    $("#currentPrice-" + planId).text(newPrice);
    let choosePaymnetURL = route("choose.payment.type", planId);
    $("#planId" + planId).attr(
        "href",
        choosePaymnetURL + "?customFieldId=" + selectedOption.val()
    );
});
listenClick(".makePayment", function () {
    let payloadData = {
        planId: $(this).data("id"),
        from_pricing: typeof fromPricing != "undefined" ? fromPricing : null,
        price: $(this).data("plan-price"),
        payment_type: $("#paymentType option:selected").val(),
        couponCode: $("#couponCode").val(),
        couponCodeId: $("#couponCodeId").val(),
        customFieldId: $("#customFieldId").val(),
    };

    $(this).addClass("disabled");
    $(".makePayment").text(Lang.get("js.please_wait"));
    $.post(route("purchase-subscription"), payloadData)
        .done((result) => {
            if (typeof result.data == "undefined") {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    Turbo.visit(route("subscription.index"));
                }, 3000);

                return true;
            }

            let sessionId = result.data.sessionId;
            stripe
                .redirectToCheckout({
                    sessionId: sessionId,
                })
                .then(function (result) {
                    $(this)
                        .html(Lang.get("js.purchase"))
                        .removeClass("disabled");
                    $(".makePayment").attr("disabled", false);
                    displaySuccessMessage(result.message);
                });
        })
        .catch((error) => {
            $(this).html(Lang.get("js.purchase")).removeClass("disabled");
            $(".makePayment").attr("disabled", false);
            displayErrorMessage(error.responseJSON.message);
        });
});

listenChange("#paymentType", function () {
    let paymentType = $(this).val();
    if (isEmpty(paymentType)) {
        $(".proceed-to-payment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".stripePayment").addClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
    if (paymentType == 1) {
        $(".proceed-to-payment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".flutterwavePayment").addClass("d-none");
        $(".stripePayment").removeClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
    if (paymentType == 2) {
        $(".proceed-to-payment").addClass("d-none");
        $(".paypalPayment").removeClass("d-none");
        $(".flutterwavePayment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
    if (paymentType == 3) {
        $(".proceed-to-payment").addClass("d-none");
        $(".paypalPayment").addClass("d-none");
        $(".flutterwavePayment").addClass("d-none");
        $(".RazorPayPayment").removeClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
    if (paymentType == 4) {
        $(".proceed-to-payment").addClass("d-none");
        $(".paypalPayment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".flutterwavePayment").addClass("d-none");
        $(".ManuallyPayment").removeClass("d-none");
        $(".manuallyPayAttachment").removeClass("d-none");
    }
    if (paymentType == 5) {
        $(".proceed-to-payment").addClass("d-none");
        $(".paystackPayment").removeClass("d-none");
        $(".flutterwavePayment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
    if (paymentType == 6) {
        $(".proceed-to-payment").addClass("d-none");
        $(".phonepePayment").removeClass("d-none");
        $(".flutterwavePayment").addClass("d-none");
        $(".paystackPayment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
    if (paymentType == 7) {
        $(".proceed-to-payment").addClass("d-none");
        $(".phonepePayment").addClass("d-none");
        $(".flutterwavePayment").removeClass("d-none");
        $(".paystackPayment").addClass("d-none");
        $(".RazorPayPayment").addClass("d-none");
        $(".ManuallyPayment").addClass("d-none");
        $(".manuallyPayAttachment").addClass("d-none");
    }
});
listenClick(".manuallyPay", function () {
    $(this).addClass("disabled");
});

listenClick(".paymentByPaypal", function () {
    $(".paymentByPaypal").text(Lang.get("js.please_wait"));
    let pricing = typeof fromPricing != "undefined" ? fromPricing : null;
    $(this).addClass("disabled");
    $.ajax({
        type: "GET",
        url: route("paypal.init"),
        data: {
            planId: $(this).data("id"),
            from_pricing: pricing,
            payment_type: $("#paymentType option:selected").val(),
            couponCode: $("#couponCode").val(),
            couponCodeId: $("#couponCodeId").val(),
            customFieldId: $("#customFieldId").val(),
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
            displayErrorMessage(error.responseJSON.message);
            $(".paymentByPaypal").text("Pay / Switch Plan");
        },
        complete: function () {},
    });
});

listenClick(".paymentByRazorPay", function () {
    let pricing = typeof fromPricing != "undefined" ? fromPricing : null;
    $(".paymentByRazorPay").text(Lang.get("js.please_wait"));
    $(this).addClass("disabled");
    $.ajax({
        type: "GET",
        url: route("razorpay.init"),
        data: {
            planId: $(this).data("id"),
            from_pricing: pricing,
            payment_type: $("#paymentType option:selected").val(),
            couponCode: $("#couponCode").val(),
            couponCodeId: $("#couponCodeId").val(),
            customFieldId: $("#customFieldId").val(),
        },
        success: function (result) {
            if (result.success) {
                let { id, amount, name, email, contact } = result.data;

                options.amount = amount;
                options.order_id = id;
                options.prefill.name = name;
                options.prefill.email = email;
                options.prefill.contact = contact;
                let razorPay = new Razorpay(options);
                razorPay.open();
                razorPay.on("payment.failed");
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message);
        },
        complete: function () {},
    });
});
listenClick(".paymentBypaystack", function () {
    let pricing =
        typeof $(".fromPricing").val() != "undefined"
            ? $(".fromPricing").val()
            : null;
    window.location.replace(
        route("paystack.init", {
            planId: $(this).data("id"),
            from_pricing: pricing,
            payment_type: $("#paymentType option:selected").val(),
            couponCode: $("#couponCode").val(),
            couponCodeId: $("#couponCodeId").val(),
            customFieldId: $("#customFieldId").val(),
        })
    );
});

listenClick(".paymentByflutterwave", function () {
    let pricing =
        typeof $(".fromPricing").val() != "undefined"
            ? $(".fromPricing").val()
            : null;
    window.location.replace(
        route("flutterwave.subscription", {
            planId: $(this).data("id"),
            from_pricing: pricing,
            payment_type: $("#paymentType option:selected").val(),
            couponCode: $("#couponCode").val(),
            couponCodeId: $("#couponCodeId").val(),
            customFieldId: $("#customFieldId").val(),
        })
    );
});

listenClick(".paymentByPhonepe", function () {
    let pricing =
        typeof $(".fromPricing").val() != "undefined"
            ? $(".fromPricing").val()
            : null;
    window.location.replace(
        route("phonepe-subscription", {
            planId: $(this).data("id"),
            from_pricing: pricing,
            payment_type: $("#paymentType option:selected").val(),
            couponCode: $("#couponCode").val(),
            couponCodeId: $("#couponCodeId").val(),
            customFieldId: $("#customFieldId").val(),
        })
    );
});

listenSubmit(".manuallyPaymentForm", function (e) {
    e.preventDefault();
    if (
        !checkPhpFile(
            "#manual_payment_attachment",
            "#manualPaymentValidationErrorsBox"
        )
    ) {
        return false;
    }
    $(".paymentByRazorPay").text(Lang.get("js.please_wait"));
    $(this).addClass("disabled");
    let planId = $(".manuallyPaymentPlanId").val();
    let formData = new FormData($(".manuallyPaymentForm")[0]);
    formData.append("customFieldId", $("#customFieldId").val());
    $.ajax({
        type: "POST",
        url: route("subscription.manual", planId),
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            Turbo.visit(route("subscription.index"));
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message);
        },
        complete: function () {},
    });
});

listenChange("#manual_payment_attachment", function () {
    if (
        !checkPhpFile(
            "#manual_payment_attachment",
            "#manualPaymentValidationErrorsBox"
        )
    ) {
        return false;
    }
});

listenClick(".plan-zero", function () {
    let planId = $(this).attr("data-id");
    $(this)
        .html(
            `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only"> </span>
            </div> ${Lang.get("js.loading")}`
        )
        .addClass("disabled");
    $.post(route("subscription.plan-zero", planId))
        .done((result) => {
            displaySuccessMessage(result.message);
            setTimeout(function () {
                Turbo.visit(route("subscription.index"));
            }, 2000);
        })
        .catch((error) => {
            $(this).attr("disabled", false);
            $(this).html(Lang.get("js.purchase")).removeClass("disabled");
            displayErrorMessage(error.responseJSON.message);
        });
});

listenClick(".freePayment", function () {
    if (
        typeof getLoggedInUserdata != "undefined" &&
        getLoggedInUserdata == ""
    ) {
        window.location.href = route("login");

        return true;
    }

    if ($(this).data("plan-price") === 0) {
        $(this).addClass("disabled");
        let data = {
            planId: $(this).data("id"),
            price: $(this).data("plan-price"),
        };
        $.post(route("purchase-subscription"), data)
            .done((result) => {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    Turbo.visit(window.location.href);
                }, 5000);
            })
            .catch((error) => {
                $(this)
                    .html(Lang.get("js.choose_plan"))
                    .removeClass("disabled");
                $(".freePayment").attr("disabled", false);
                displayErrorMessage(error.responseJSON.message);
            });

        return true;
    }
});

listenKeyup("#paymentCouponCode", function () {
    let code = $(this);
    let applyBtn = $("#applyCouponCodeBtn");
    code.val(
        code
            .val()
            .toUpperCase()
            .split(/[^a-zA-Z0-9_]/)
            .join("")
    );
    code.val().trim().length
        ? applyBtn.removeClass("disabled")
        : applyBtn.addClass("disabled");
});

listenClick("#applyCouponCodeBtn", function () {
    let planId = $(this).attr("data-id");
    let planPrice = $(this).attr("data-plan-price");
    let customFieldId = $("#customFieldId").val();
    let url;
    if ($(this).hasClass("apply-coupon-code-btn")) {
        url = route("apply-coupon-code", $("#paymentCouponCode").val());
    } else {
        url = route("apply-coupon-code");
    }
    $(this).addClass("disabled");
    applyCouponCode(url, planId, planPrice, customFieldId);
});

function applyCouponCode(url, planId, planPrice, customFieldId) {
    $.ajax({
        url: url,
        type: "post",
        data: {
            planId: planId,
            planPrice: planPrice,
            customFieldId: customFieldId,
        },
        success: function (result) {
            if (result.data.afterDiscount) {
                let afterDiscount = result.data.afterDiscount;
                let currencyIcon = $("#currencyIcon").val();
                $(".coupon-discount")
                    .text(
                        getCurrencyAmount(afterDiscount.discount, currencyIcon)
                    )
                    .parent()
                    .parent()
                    .removeClass("d-none");
                $("#couponCodeId").val(afterDiscount.couponId);
                $("#couponCode").val(afterDiscount.couponCode);
                $("#amountToPay").val(afterDiscount.amountToPay);
                $(".payable-amount").text(
                    getCurrencyAmount(
                        afterDiscount.amountToPay.toFixed(2),
                        currencyIcon
                    )
                );
                if (afterDiscount.amountToPay == 0) {
                    $(".plan-payment-type").addClass("d-none");
                    $(".switch-plan-btn").removeClass("d-none");
                    $(".manuallyPayAttachment").addClass("d-none");
                    $(".RazorPayPayment").addClass("d-none");
                    $(".paypalPayment").addClass("d-none");
                    $(".stripePayment").addClass("d-none");
                }
                swal({
                    icon: "success",
                    title:
                        `"` +
                        afterDiscount.couponCode +
                        `" Coupon Code Applied successfully.`,
                    timer: 2000,
                });
                $("#paymentCouponCode").attr("disabled", true);
                $("#applyCouponCodeBtn")
                    .removeClass("disabled apply-coupon-code-btn bg-primary")
                    .addClass("remove-coupon-code-btn bg-secondary")
                    .text(Lang.get("js.remove"));
            } else {
                $(".coupon-discount")
                    .text("")
                    .parent()
                    .parent()
                    .addClass("d-none");
                $(".payable-amount").text(result.data.amountToPay);
                $("#couponCodeId").val("");
                $("#couponCode").val("");
                $("#amountToPay").val(result.data.amountToPay);
                $("#paymentCouponCode").attr("disabled", false).val("");
                $("#applyCouponCodeBtn")
                    .removeClass("disabled remove-coupon-code-btn bg-secondary")
                    .addClass("apply-coupon-code-btn bg-primary")
                    .text(Lang.get("js.apply"));
                $("#paymentCouponCode").trigger("keyup");
                $(".plan-payment-type").removeClass("d-none");
                $(".switch-plan-btn").addClass("d-none");
                $("#paymentType").val("").trigger("change");
            }
        },
        error: function (result) {
            $("#applyCouponCodeBtn").removeClass("disabled");
            displayErrorMessage(result.responseJSON.message);
        },
    });
}
