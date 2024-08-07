document.addEventListener("turbo:load", function () {
    if ($("#customField").is(":checked")) {
        $('input[name="price"]').val(0).prop("disabled", true);
        $('input[name="no_of_vcards"]').val(0).prop("disabled", true);
    } else {
        $('input[name="price"]').prop("disabled", false);
        $('input[name="no_of_vcards"]').prop("disabled", false);
    }
});

listenClick("#planStatus", function () {
    let planId = $(this).data("id");
    let updateUrl = route("plan.status", planId);
    $.ajax({
        type: "get",
        url: updateUrl,
        success: function (response) {
            displaySuccessMessage(response.message);
            $("#userTable").DataTable().ajax.reload();
        },
    });
});

listen("click", ".plan-delete-btn", function (event) {
    let deletePlanId = $(event.currentTarget).data("id");
    let url = route("plans.destroy", { plan: deletePlanId });
    deleteItem(url, "Plan");
});

listenChange(".is_default", function (event) {
    let subscriptionPlanId = $(event.currentTarget).data("id");
    $.ajax({
        url: route("make.plan.default", subscriptionPlanId),
        method: "post",
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message);
            $(event.currentTarget).prop("checked", false);
            Livewire.dispatch("refresh");
        },
    });
});

listenChange(".plan-status", function (event) {
    let subscriptionPlanId = $(event.currentTarget).data("id");
    $.ajax({
        url: route("plan-status", subscriptionPlanId),
        method: "post",
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
    });
});

listenKeyup(".price-format-input", function (e) {
    if (e.keyCode <= 95 && e.keyCode >= 106) {
        if (
            (e.which != 46 || $(this).val().indexOf(".") != -1) &&
            (e.which < 48 || e.which > 57)
        ) {
            e.preventDefault();
            let str2 = $(this).val().slice(0, -1) + "";
            return $(this).val(str2);
        }
    }

    let k = e.which ? e.which : e.keyCode;
    if (k <= 95 && k >= 106) {
        if ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32) {
            let str1 = $(this).val();
            let str2 = str1.slice(0, -1) + "";
            return $(this).val(str2);
        }
    }
    let num = $(this).val().match(/\./g)?.length || 0;
    if (num == 2) {
        let str2 = $(this).val().slice(0, -1) + "";
        return $(this).val(str2);
    }

    let val = this.value;
    val = val.replace(/,/g, "");
    if (num == 0) {
        if (val.length > 3) {
            let noCommas = Math.ceil(val.length / 3) - 1;
            let remain = val.length - noCommas * 3;
            let newVal = [];
            for (let i = 0; i < noCommas; i++) {
                newVal.unshift(val.substr(val.length - i * 3 - 3, 3));
            }
            newVal.unshift(val.substr(0, remain));
            this.value = newVal;
        } else {
            this.value = val;
        }
    }
});

listenClick("#customField", function () {
    if ($(this).is(":checked")) {
        $("#customFieldsSection").show();
        $("#addFieldsButton").show();
        $('input[name="price"]').val(0).prop("disabled", true);
        $('input[name="no_of_vcards"]').val(0).prop("disabled", true);
    } else {
        $("#customFieldsSection").hide();
        $("#addFieldsButton").hide();
        $('input[name="price"]').prop("disabled", false);
        $('input[name="no_of_vcards"]').prop("disabled", false);
    }
});

listenClick("#addFieldsButton", function () {
    var newFields = `
             <div class="col-lg-6 col-md-2 col-5 mt-7">
                 <label class="form-label required"> ${Lang.get(
                     "js.custom_vcard_number"
                 )}:</label>
                 <input type="number" name="custom_vcard_number[]" class="form-control" required placeholder="${Lang.get(
                     "js.custom_vcard_number"
                 )}">
             </div>
             <div class="col-lg-5 col-md-2 col-5 mt-7">
                 <label class="form-label required"> ${Lang.get(
                     "js.custom_vcard_price"
                 )}: </label>
                 <input type="number" name="custom_vcard_price[]" class="form-control" required placeholder="${Lang.get(
                     "js.custom_vcard_price"
                 )}">
             </div>
             <div class="col-lg-1 col-md-2 col-1 mb-2 trash">
             <a href="javascript:void(0)"><i class="fas fa-trash text-danger fs-2"></i></a>
             </div>
             `;
    $("#fieldsContainer").prepend(newFields);
});

listenClick(".trash", function () {
    $(this).prev().prev().remove();
    $(this).prev().remove();
    $(this).remove();
});
