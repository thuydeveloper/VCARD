listen("click", "#addLanguage", function () {
    $("#languagePreview").css(
        "background-image",
        'url("' + appUrl + "/web/media/avatars/redflag.jpeg" + '")'
    );
    $("#addLanguageModal").appendTo("body").modal("show");
    resetModalForm("#addLanguageForm");
});

listen("click", ".language-delete-btn", function (event) {
    let languageId = $(event.currentTarget).attr("data-id");
    deleteItem(route("languages.destroy", languageId), "Language");
});


    listenClick(".language-active", function () {
        let languageId = $(this).data("id");
        let updateUrl = route("languages.status", languageId);
        $.ajax({
            type: "post",
            url: updateUrl,
            success: function (response) {
                Livewire.dispatch("refresh");
                displaySuccessMessage(response.message);
            },
            error: function (response) {
                displayErrorMessage(response.responseJSON.message);
                $(".langauge-value").prop('checked', false);
                Livewire.dispatch("refresh");
            }
        });
    });

    listen('hidden.bs.modal', '#addLanguageModal', function () {
        resetModalForm('#addLanguageForm', '#languageValidationErrorsBox')
    })

listen("hidden.bs.modal", "#editLanguageModal", function () {
    resetModalForm("#editLanguageForm", "#editValidationErrorsBox");
});

listen("submit", "#addLanguageForm", function (e) {
    e.preventDefault();
    processingBtn("#addLanguageForm", "#languageBtnSave", "loading");
    $.ajax({
        url: route("languages.store"),
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#addLanguageModal").modal("hide");
                Livewire.dispatch("refresh");
                setTimeout(function () {
                    $("#languageBtnSave").button("reset");
                }, 1000);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            setTimeout(function () {
                $("#languageBtnSave").button("reset");
            }, 1000);
        },
        complete: function () {
            setTimeout(function () {
                processingBtn("#addLanguageForm", "#languageBtnSave");
            }, 1000);
        },
    });
});

listen("click", ".edit-language-btn", function (event) {
    let languageId = $(event.currentTarget).data("id");
    renderLanguageData(languageId);
});
function renderLanguageData(id) {
    let defaultLang = {
        ar: "assets/img/LanguageImage/arabic.svg",
        en: "assets/img/LanguageImage/english.png",
        zh: "assets/img/LanguageImage/china.png",
        fr: "assets/img/LanguageImage/france.png",
        de: "assets/img/LanguageImage/german.png",
        pt: "assets/img/LanguageImage/portuguese.png",
        ru: "assets/img/LanguageImage/russian.jpeg",
        es: "assets/img/LanguageImage/spain.png",
        tr: "assets/img/LanguageImage/turkish.png",
    };
    $.ajax({
        url: route("languages.edit", id),
        type: "GET",
        success: function (result) {
            if (result.success) {
                let isoCode = result.data.iso_code;
                if (result.data.iso_code in defaultLang) {
                    $.each(defaultLang, function (key, val) {
                        if (isoCode == key) {
                            $("#editlanguagePreview").css(
                                "background-image",
                                'url("' + appUrl + "/" + val + '")'
                            );
                            $(".edit-btn").addClass("d-none");
                            return false;
                        }
                    });
                } else {
                    $("#editlanguagePreview").css(
                        "background-image",
                        'url("' + result.data.image_url + '")'
                    );
                    $(".edit-btn").removeClass("d-none");
                }
                $("#languageId").val(result.data.id);
                $("#editLanguage").val(result.data.name);
                $("#editIso").val(result.data.iso_code);
                $("#editLanguageModal").appendTo("body").modal("show");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}

listen("submit", "#editLanguageForm", function (event) {
    event.preventDefault();
    processingBtn("#editLanguageForm", "#btnEditSave", "loading");
    const id = $("#languageId").val();
    $.ajax({
        url: route("language.update", id),
        type: "post",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#editLanguageModal").modal("hide");
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn("#editLanguageForm", "#btnEditSave");
        },
    });
});
