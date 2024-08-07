import "flatpickr/dist/l10n";

listenClick(".subscriptionPlanStatus", function () {
    $(this).attr("disabled", true);
    let planId = $(this).data("id");
    let tenantId = $(this).data("tenant");
    let status = $(this).data("status");
    let updateStatus = route("subscription.status", planId);
    $.ajax({
        type: "get",
        url: updateStatus,
        data: {
            id: planId,
            tenant_id: tenantId,
            status: status,
        },
        success: function (response) {
            displaySuccessMessage(response.message);
            Livewire.dispatch("resetPageTable");
        },
    });
});

listenClick(".subscribed-user-plan-edit-btn", function (event) {
    let SubscriptionId = $(event.currentTarget).data("id");
    $("#editSubscriptionModal").modal("show");
    editSubscriptionRenderData(SubscriptionId);
});

function editSubscriptionRenderData(id) {
    let SubscriptionUrl = route("subscription.user.plan.edit", id);
    $.ajax({
        url: SubscriptionUrl,
        type: "GET",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                Livewire.dispatch("refresh", "refresh");
                $("#SubscriptionId").val(result.data.id);
                $("#EndDate").val(result.data.ends_at);

                let endDate = new Date(result.data.ends_at);
                let formattedEndDate = moment
                    .utc(endDate)
                    .format(getFormattedDateTime(userDateFormate, 1));
                $("#EndDate").val(formattedEndDate);
            }
            $("#EndDate").flatpickr({
                minDate: result.data.ends_at,
                disableMobile: true,
                locale: getLoggedInUserLang,
                dateFormat: getFormattedDateTime(userDateFormate),
            });
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}

listenSubmit("#editSubscriptionForm", function (event) {
    event.preventDefault();
    let subscriptionId = $("#SubscriptionId").val();
    let subscriptionUrl = route(
        "subscription.user.plan.update",
        subscriptionId
    );
    $.ajax({
        url: subscriptionUrl,
        type: "get",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#editSubscriptionModal").modal("hide");
                Livewire.dispatch("resetPageTable");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenHiddenBsModal("#editSubscriptionModal", function (e) {
    $("#editSubscriptionForm")[0].reset();
    $("#editSubscriptionId").attr("disabled", false);
    $("#UnlimitedNote").text("");
});

listenClick(".subscribed-user-plan-view-btn", function (event) {
    let id = $(event.currentTarget).attr("data-id");
    let SubscriptionUrl = route("subscription.user.plan.edit", id);
    $.ajax({
        url: SubscriptionUrl,
        type: "GET",
        data: {
            id: id,
        },
        success: function (result) {
            let coupon = result.data.coupon_code_meta;
            let currency = result.data.plan.currency.currency_icon;
            let paymentType = result.message || result.data.payment_type;

            $("#subscriptionUserName").text(result.data.tenant.user.full_name);
            $("#subscriptionPlanName").text(result.data.plan.name);
            if (paymentType == null) {
                paymentType = "Default Plan";
            }
            $("#subscriptionPaymentType").text(paymentType);
            $("#subscriptionPlanPrice").text(
                currency === "$"
                    ? "$" +
                          (result.data.plan_amount
                              ? parseFloat(result.data.plan_amount).toFixed(2)
                              : 0)
                    : getCurrencyAmount(
                          result.data.plan_amount
                              ? parseFloat(result.data.plan_amount).toFixed(2)
                              : 0,
                          currency
                      )
            );
            $("#subscriptionPayableAmount").text(
                currency === "$"
                    ? "$" +
                          (result.data.payable_amount
                              ? parseFloat(result.data.payable_amount).toFixed(
                                    2
                                )
                              : 0)
                    : getCurrencyAmount(
                          result.data.payable_amount
                              ? parseFloat(result.data.payable_amount).toFixed(
                                    2
                                )
                              : 0,
                          currency
                      )
            );
            $("#subscriptionEndDate").text(
                moment
                    .utc(result.data.ends_at)
                    .format(getFormattedDateTime(userDateFormate, 1))
            );

            if (coupon) {
                $('.coupon-data-div').removeClass('d-none')
                $('#subscriptionCouponDiscount').text(currency + result.data.discount)
                $('#subscriptionCouponName').text(coupon.couponCode)
            } else {
                $(".coupon-data-div").addClass("d-none");
            }

            $("#showSubscriptionModal").modal("show");
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
