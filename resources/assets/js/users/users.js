Livewire.hook("element.init", () => {
    loadUserfilter();
});

listenClick(".user-is-verified", function () {
    let userId = $(this).data("id");
    let updateUrl = route("users.email-verified", userId);
    $.ajax({
        type: "get",
        url: updateUrl,
        success: function (response) {
            Livewire.dispatch("refresh");
            displaySuccessMessage(response.message);
        },
    });
});

listenClick(".user-active", function () {
    let userId = $(this).data("id");
    let updateUrl = route("users.status", userId);
    $.ajax({
        type: "get",
        url: updateUrl,
        success: function (response) {
            displaySuccessMessage(response.message);
            Livewire.dispatch("refresh");
        },
    });
});

listenClick(".vcards-verified", function () {
    let userId = $(this).data("id");
    let updateUrl = route("vcard.verified", userId);
    $.ajax({
        type: "get",
        url: updateUrl,
        success: function (response) {
            Livewire.dispatch("refresh");
            displaySuccessMessage(response.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".user-delete-btn", function (event) {
    let recordId = $(event.currentTarget).data("id");
    let name = $(event.currentTarget).data("name");
    let deleteName =
        name == "superAdmin" ? Lang.get("js.admin") : Lang.get("js.user");

    deleteItem(route("users.destroy", recordId), deleteName);
});

listenClick(".admin-delete-btn", function (event) {
    let recordId = $(event.currentTarget).data("id");
    let name = $(event.currentTarget).data("name");
    let deleteName =
        name == "superAdmin" ? Lang.get("js.admin") : Lang.get("js.user");

    deleteItem(route("admins.destroy", recordId), deleteName);
});
listen("contextmenu", ".user-impersonate", function (e) {
    e.preventDefault(); // Stop right click on link
    return false;
});

var control = false;
listen("keyup keydown", function (e) {
    control = e.ctrlKey;
});

listenClick(".user-impersonate", function () {
    if (control) {
        return false; // Stop ctrl + click on link
    }
    let id = $(this).data("id");
    let element = document.createElement("a");
    element.setAttribute("href", route("impersonate", id));
    element.setAttribute("data-turbo", false);
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
    $(".user-impersonate").prop("disabled", true);
});

function isEmailUser(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listenSubmit("#userCreateForm", function () {
    if ($.trim($("#userFirstName").val()) == "") {
        displayErrorMessage(Lang.get("js.first_name_required"));
        return false;
    }

    if ($.trim($("#userLastName").val()) == "") {
        displayErrorMessage(Lang.get("js.last_name_required"));
        return false;
    }
    if (!isEmailUser($("#email").val())) {
        displayErrorMessage(Lang.get("js.enter_valid_email"));
        return false;
    }

    let passwordVal = $("#password").val();
    if ($.trim(passwordVal) == "") {
        displayErrorMessage(Lang.get("js.passwords"));
        return false;
    }
    if (passwordVal.length < 8) {
        displayErrorMessage(Lang.get("js.password_character"));
        return false;
    }

    let confirmPassWord = $("#cPassword").val();
    if (passwordVal !== confirmPassWord) {
        displayErrorMessage(Lang.get("js.password_must_match"));
        return false;
    }
});

listenSubmit("#userEditForm", function () {
    if ($.trim($("#userFirstName").val()) == "") {
        displayErrorMessage(Lang.get("js.first_name_required"));
        return false;
    }
    if (!isEmailUser($("#email").val())) {
        displayErrorMessage(Lang.get("js.enter_valid_email"));
        return false;
    }

    if ($.trim($("#userLastName").val()) == "") {
        displayErrorMessage(Lang.get("js.last_name_required"));
        return false;
    }
});

listenClick(".user-change-password", function () {
    let userId = $(this).attr("data-id");
    $("#changePasswordUserId").val(userId);
    $("#changeUserPasswordModal").modal("show").appendTo("body");
});

listenClick("#UserPasswordChangeBtn", function () {
    let userId = $("#changePasswordUserId").val();
    $(this).attr("disabled", true);

    $.ajax({
        url: route("changePassword", userId),
        type: "PUT",
        data: $("#changeUserPasswordForm").serialize(),
        success: function (result) {
            $("#changeUserPasswordModal").modal("hide");
            displaySuccessMessage(result.message);
            $("#UserPasswordChangeBtn").attr("disabled", false);
        },
        error: function error(result) {
            $("#UserPasswordChangeBtn").attr("disabled", false);
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenHiddenBsModal("#changeUserPasswordModal", function () {
    $("#changeUserPasswordForm")[0].reset();
});
function loadUserfilter() {
    $("#userStatus").select2();
}
listen("change", "#userStatus", function () {
    Livewire.dispatch("statusFilter", { status: $(this).val() });
    window.hideDropdownManually(
        $("#dropdownMenuUserStatus"),
        $(".dropdown-menu")
    );
});
function hideDropdownManually(button, menu) {
    button.attr("aria-expanded", "false"); // Set aria-expanded attribute to false on the dropdown button
    menu.removeClass("show"); // Remove 'show' class from the dropdown menu
}
listen("click", "#userResetFilter", function () {
    $("#userStatus").val(2).change();
    Livewire.dispatch("statusFilter", { status: "" });
    window.hideDropdownManually(
        $("#dropdownMenuUserStatus"),
        $(".dropdown-menu")
    );
});
listenKeyup(".check-email", function () {
         let originalEmail = document.getElementById('originalEmail').value;
         let email = $(this).val();

         if(email == originalEmail || email == ""){
             $("#email-error-msg").text("");
             return false;
         }
         $.ajax({
             url: route('check.email', email),
             type: "GET",
             success: function (result) {
                 if(result.success){
                     $("#email-error-msg").text("");
                 }else{
                     $("#email-error-msg").text(Lang.get("js.check_email"));
                 }
             },
         });
});
