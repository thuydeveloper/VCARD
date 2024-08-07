document.addEventListener("turbo:load", loadCouponCodeData);

function loadCouponCodeData() {
    var dateFormat = getFormattedDateTime(userDateFormate);
    window.couponExpireAt = $("#couponExpireAt").flatpickr({
        locale: getLoggedInUserLang,
        minDate: new Date().fp_incr(1),
        dateFormat: dateFormat,
    });
    window.editCouponExpireAt = $("#editCouponExpireAt").flatpickr({
        locale: getLoggedInUserLang,
        minDate: new Date().fp_incr(1),
        dateFormat: dateFormat,
    });
}

listenSubmit("#addCouponCodeForm", function (e) {
    e.preventDefault();

    if ($("#percentageType").prop("checked") == true) {
        if ($("#couponDiscount").val() > 100) {
            displayErrorMessage(Lang.get("js.coupon_code_percent_validation"));
            return false;
        }
    }
    $("#couponCodeSaveBtn").attr("disabled", true);

    $("#couponName").trigger("keyup");
    $.ajax({
        url: route("coupon-codes.store"),
        type: "post",
        data: $(this).serialize(),
        success: function (result) {
            $("#couponCodeSaveBtn").attr("disabled", false);
            Livewire.dispatch("refresh");
            displaySuccessMessage(result.message);
            $("#couponCodeModal").modal("hide");
        },
        error: function (result) {
            $("#couponCodeSaveBtn").attr("disabled", false);
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenSubmit("#editCouponCodeForm", function (e) {
    e.preventDefault();

    if ($("#editCouponPercentageType").prop("checked") == true) {
        if ($("#editCouponDiscount").val() > 100) {
            displayErrorMessage(Lang.get("js.coupon_code_percent_validation"));
            return false;
        }
    }
    $("#editCouponCodeSaveBtn").attr("disabled", true);
    let id = $("#editCouponId").val();
    $("#editCouponName").trigger("keyup");
    $.ajax({
        url: route("coupon-codes.update", id),
        type: "put",
        data: $(this).serialize(),
        success: function (result) {
            $("#editCouponCodeSaveBtn").attr("disabled", false);
            Livewire.dispatch("refresh");
            displaySuccessMessage(result.message);
            $("#editCouponCodeModal").modal("hide");
        },
        error: function (result) {
            $("#editCouponCodeSaveBtn").attr("disabled", false);
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".edit-coupon-code", function () {
    let couponId = $(this).attr("data-id");
    $.ajax({
        url: route("coupon-codes.edit", couponId),
        success: function (result) {
            let couponCode = result.data;
            $("#editCouponId").val(couponCode.id);
            $("#editCouponName").val(couponCode.coupon_name);
            $("#editcouponLimit").val(couponCode.coupon_limit);
            if (couponCode.type == 1) {
                $("#editCouponFixedType").prop("checked", true);
                $("#editDiscountTypeIcon").text("Flat");
            } else {
                $("#editCouponPercentageType").prop("checked", true);
                $("#editDiscountTypeIcon").text("%");
            }
            $("#editCouponDiscount").val(couponCode.discount);
            editCouponExpireAt.setDate(
                moment(couponCode.expire_at).format(
                    getFormattedDateTime(userDateFormate, 1)
                )
            );
            $("#editCouponExpireAt").val(
                moment(couponCode.expire_at).format(
                    getFormattedDateTime(userDateFormate, 1)
                )
            );
            $("#editCouponStatus").prop("checked", couponCode.status);
            $("#editCouponCodeModal").modal("show");
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".delete-coupon-code", function () {
    let id = $(this).attr("data-id");
    let url = route("coupon-codes.destroy", id);
    deleteItem(url, Lang.get("js.coupon_code"));
});

listenKeyup("#couponName, #editCouponName", function () {
    $(this).val($(this).val().toUpperCase().replace(/-/g, ""));
});

listenHiddenBsModal("#couponCodeModal", function () {
    $("#addCouponCodeForm")[0].reset();
    $("#discountTypeIcon").text("%");
    couponExpireAt.clear();
});

listenClick("#changeCouponStatus", function () {
    let codeId = $(this).attr("data-id");
    let status = $(this).prop("checked");
    let url = route("coupon-codes.change-status", codeId);
    $.ajax({
        url: url,
        type: "post",
        data: { status: status },
        success: function (result) {
            displaySuccessMessage(result.message);
            Livewire.dispatch("refresh");
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenChange('input[name="type"]', function () {
    let icon = $("#discountTypeIcon");
    let editFormIcon = $("#editDiscountTypeIcon");
    if ($(this).val() == 1) {
        icon.text(Lang.get("js.flat"));
        editFormIcon.text(Lang.get("js.flat"));
    } else {
        icon.text("%");
        editFormIcon.text("%");
    }
});
