"use strict";

listenChange("#profileImg", function () {
    let validFile = isValidFile($(this), "#profileImageValidationErrors");
    if (validFile) {
        displayPhoto(this, "#profilePreview");
    } else {
        $("#profilePreview").attr("src", defaultProfileUrl);
    }
});

listenClick(".cancel-profile", function () {
    $("#profilePreview").attr("src", defaultProfileUrl);
});

listenClick(".cancel-cover", function () {
    $("#coverPreview").attr("src", defaultCoverUrl);
});

listenClick("#coverImg", function () {
    let coverImg = document.getElementById("coverImg");
    if (coverImg) {
        coverImg.addEventListener("change", function () {
            let file = this.files[0];
            let fileType = file["type"];
            let validVideoTypes = [
                "video/mp4",
                "video/mpeg",
                "video/quicktime",
                "video/x-msvideo",
            ];
            let validImageTypes = ["image/jpeg", "image/png", "image/jpg"];

            if ($.inArray(fileType, validVideoTypes) !== -1) {
                $("#coverPreview").css(
                    "background-image",
                    "url(" + defaultVideoCoverImg + ")"
                );
            } else if ($.inArray(fileType, validImageTypes) !== -1) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#coverPreview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

listenClick(".theme-img-radio ", function () {
    $(".theme-img-radio").removeClass("img-border");
    $(this).addClass("img-border");
    $("#themeInput").val($(this).attr("data-id"));
});

listenClick(".img-radio ", function () {
    $(".img-radio").removeClass("img-border");
    $(this).addClass("img-border");
    $("#templateId").val($(this).attr("data-id"));
});

listenClick(".template-save", function () {
    let template = $("#templateId").val();
    if (isEmpty(template)) {
        displayErrorMessage(Lang.get("js.choose_one_template"));
        return false;
    }
});

listenChange('select[name^="startTime"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let endTimeOptions = $(this)
        .closest(".buisness_end")
        .find('select[name^="endTime"] option');
    endTimeOptions
        .eq(selectedIndex + 1)
        .prop("selected", true)
        .trigger("change");
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr("disabled", true);
        } else {
            $(this).attr("disabled", false);
        }
    });
});

document.addEventListener("turbo:load", loadVcardCreateEdit);

function loadVcardCreateEdit() {
    if (!$("#vcardCreateEditIsTrue").length) {
        return;
    }
    if (
        $("#vcardCreateEditIsTrue").length &&
        $("#vcardCreateEditIsTrue").val()
    ) {
        $('select[name^="startTime"]').each(function () {
            let selectedIndex = $(this)[0].selectedIndex;
            let endSelectedIndex = $(this)
                .closest(".buisness_end")
                .find('select[name^="endTime"] option:selected')[0].index;
            let endTimeOptions = $(this)
                .closest(".buisness_end")
                .find('select[name^="endTime"] option');
            if (selectedIndex >= endSelectedIndex) {
                endTimeOptions
                    .eq(selectedIndex + 1)
                    .prop("selected", true)
                    .trigger("change");
            }
            endTimeOptions.each(function (index) {
                if (index <= selectedIndex) {
                    $(this).attr("disabled", true);
                } else {
                    $(this).attr("disabled", false);
                }
            });
        });
    }

    if ($("#privacyPolicyQuill").length) {
        window.quillPrivacyPolicy = new Quill("#privacyPolicyQuill", {
            modules: {
                toolbar: [
                    [
                        {
                            header: [1, 2, false],
                        },
                    ],
                    ["bold", "italic", "underline"],
                ],
            },
            theme: "snow", // or 'bubble'
            placeholder: Lang.get("js.privacy_policy"),
        });

        quillPrivacyPolicy.on(
            "text-change",
            function (delta, oldDelta, source) {
                if (quillPrivacyPolicy.getText().trim().length === 0) {
                    quillPrivacyPolicy.setContents([{ insert: "" }]);
                }
            }
        );
        let element = document.createElement("textarea");
        element.innerHTML = $("#privacyData").val();
        quillPrivacyPolicy.root.innerHTML = element.value;
    }

    if ($("#termConditionQuill").length) {
        window.termConditionQuill = new Quill("#termConditionQuill", {
            modules: {
                toolbar: [
                    [
                        {
                            header: [1, 2, false],
                        },
                    ],
                    ["bold", "italic", "underline"],
                ],
            },
            placeholder: Lang.get("js.term_condition").replace(/&amp;/g, "&"),
            theme: "snow", // or 'bubble'
        });

        termConditionQuill.on(
            "text-change",
            function (delta, oldDelta, source) {
                if (termConditionQuill.getText().trim().length === 0) {
                    termConditionQuill.setContents([{ insert: "" }]);
                }
            }
        );
        let element = document.createElement("textarea");
        element.innerHTML = $("#conditionData").val();
        termConditionQuill.root.innerHTML = element.value;
    }

    if ($("#vcardDescriptionQuill").length) {
        window.quillVcardDescription = new Quill("#vcardDescriptionQuill", {
            modules: {
                toolbar: [
                    ["bold", "italic", "underline", "strike"], // toggled buttons
                    ["blockquote", "code-block"],
                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                    [{ color: [] }, { background: [] }],
                ],
            },
            theme: "snow",
            placeholder: Lang.get("js.description"),
        });

        quillVcardDescription.on(
            "text-change",
            function (delta, oldDelta, source) {
                if (quillVcardDescription.getText().trim().length === 0) {
                    quillVcardDescription.setContents([{ insert: "" }]);
                }
            }
        );

        let element = document.createElement("textarea");
        element.innerHTML = $("#vcardDescriptionData").val();
        quillVcardDescription.root.innerHTML = element.value;
    }

    listenClick("#vcardSaveBtn", function () {
        let editor_content_1 = quillVcardDescription.root.innerHTML;
        $("#vcardDescriptionData").val(editor_content_1);
    });

    $('select[name^="endTimes"]').each(function () {
        let selectedIndex = $(this)[0].selectedIndex;
        let startTimeOptions = $(this)
            .closest(".timeSlot")
            .next()
            .find('select[name^="startTimes"] option');
        startTimeOptions.each(function (index) {
            if (index < selectedIndex) {
                $(this).attr("disabled", true);
            } else {
                $(this).attr("disabled", false);
            }
        });
    });

    $('select[name^="startTimes"]').each(function () {
        let selectedIndex = $(this)[0].selectedIndex;
        let endSelectedIndex = $(this)
            .closest(".add-slot")
            .find('select[name^="endTimes"] option:selected')[0].index;
        let endTimeOptions = $(this)
            .closest(".add-slot")
            .find('select[name^="endTimes"] option');
        if (selectedIndex >= endSelectedIndex) {
            endTimeOptions
                .eq(selectedIndex + 1)
                .prop("selected", true)
                .trigger("change");
        }
        endTimeOptions.each(function (index) {
            if (index <= selectedIndex) {
                $(this).attr("disabled", true);
            } else {
                $(this).attr("disabled", false);
            }
        });
    });
}

listenClick("#privacyPolicySave", function () {
    let element = document.createElement("textarea");
    let editor_content_1 = quillPrivacyPolicy.root.innerHTML;
    element.innerHTML = editor_content_1;
    let partName = $("#privacyPolicyPartName").val();
    if (partName == "privacy-policy") {
        if (quillPrivacyPolicy.getText().trim().length === 0) {
            displayErrorMessage(Lang.get("js.privacy_policy"));
            return false;
        }
        let input = JSON.stringify(editor_content_1);
        $("#privacyData").val(input.replace(/"/g, ""));
    }
    return true;
});

listenClick("#termConditionSave", function () {
    let element = document.createElement("textarea");
    let editor_content_1 = termConditionQuill.root.innerHTML;
    element.innerHTML = editor_content_1;
    let partName = $("#termConditionPartName").val();
    if (partName == "term-condition") {
        let input = JSON.stringify(editor_content_1);
        $("#conditionData").val(input.replace(/"/g, ""));

        if (termConditionQuill.getText().trim().length === 0) {
            displayErrorMessage(Lang.get("js.the_term_conditions"));
            return false;
        }
        return true;
    }
});

listenClick(".add-session-time", function () {
    let selectedIndex = 0;
    let dayId = $(this).data("day");
    if (
        $(this)
            .parent()
            .prev()
            .children(".session-times")
            .find(".timeSlot:last-child").length > 0
    ) {
        selectedIndex = $(this)
            .parent()
            .prev()
            .children(".session-times")
            .find(".timeSlot:last-child")
            .children(".add-slot")
            .find('select[name^="endTimes"] option:selected')[0].index;
    }

    let day = $(this).closest(".weekly-content").attr("data-day");
    let $ele = $(this);
    let weeklyEle = $(this).closest(".weekly-content");
    $.ajax({
        url: route("get.slot"),
        data: { day: day },
        success: function (data) {
            weeklyEle.find(".unavailable-time").remove();
            weeklyEle
                .find('input[name="checked_week_days[]"')
                .prop("checked", true)
                .prop("disabled", false);
            $ele.closest(".weekly-content")
                .find(".session-times")
                .append(data.data);
            weeklyEle.find('select[data-control="select2"]').select2();

            let startTimeOptions = $("#add-session-" + dayId)
                .parent()
                .prev()
                .children(".session-times")
                .find(".timeSlot:last-child")
                .children(".add-slot")
                .find('select[name^="startTimes"] option');
            startTimeOptions.each(function (index) {
                if (index < selectedIndex) {
                    $(this).attr("disabled", true);
                } else {
                    $(this).attr("disabled", false);
                }
            });
        },
    });
});
listenClick(".deleteBtn", function () {
    let selectedIndex = 0;
    if ($(this).closest(".timeSlot").prev().length > 0) {
        selectedIndex = $(this)
            .closest(".timeSlot")
            .prev()
            .children(".add-slot")
            .find('select[name^="endTimes"] option:selected')[0].index;
    }

    if (
        $(this).closest(".weekly-row").find(".session-times").find("select")
            .length === 2
    ) {
        let dayChk = $(this)
            .closest(".weekly-row")
            .find('input[name="checked_week_days[]"');
        dayChk.prop("checked", false).prop("disabled", true);
        $(this)
            .closest(".weekly-row")
            .children()
            .next()
            .append(
                '<div class="unavailable-time">' +
                    Lang.get("js.unavailable") +
                    "</div>"
            );
    }

    let startTimeOptions = $(this)
        .closest(".timeSlot")
        .next()
        .children(".add-slot")
        .find('select[name^="startTimes"] option');
    startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr("disabled", true);
        } else {
            $(this).attr("disabled", false);
        }
    });

    $(this).parent().siblings(".error-msg").remove();
    $(this).parent().closest(".timeSlot").remove();
    $(this).parent().remove();
});

listenChange('select[name^="startTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let endTimeOptions = $(this)
        .closest(".add-slot")
        .find('select[name^="endTimes"] option');
    let endSelectedIndex = $(this)
        .closest(".add-slot")
        .find('select[name^="endTimes"] option:selected')[0].index;
    if (selectedIndex >= endSelectedIndex) {
        endTimeOptions
            .eq(selectedIndex + 1)
            .prop("selected", true)
            .trigger("change");
    }
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr("disabled", true);
        } else {
            $(this).attr("disabled", false);
        }
    });
});

listenChange('select[name^="endTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let startTimeOptions = $(this)
        .closest(".timeSlot")
        .next()
        .find('select[name^="startTimes"] option');
    startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr("disabled", true);
        } else {
            $(this).attr("disabled", false);
        }
    });
});

listenClick("#freeButton", function () {
    $(this)
        .removeClass("btn-light btn-active-light-primary")
        .addClass("btn-primary");
    $("#paidButton")
        .removeClass("btn-primary")
        .addClass("btn-light btn-active-light-primary");
    $("#userPaidInputDiv").addClass("d-none");
    $("#userPaymentAmount").val("");
    $("#userPaymentAmount").prop("required", false);
    $("#isUserPaidId").val(0);
    $("#userPaymentAmount").removeAttr("required");
});
listenClick("#paidButton", function () {
    $(this)
        .removeClass("btn-light btn-active-light-primary")
        .addClass("btn-primary");
    $("#freeButton")
        .removeClass("btn-primary")
        .addClass("btn-light btn-active-light-primary");
    $("#userPaidInputDiv").removeClass("d-none");
    $("#userPaymentAmount").prop("required", true);
    $("#isUserPaidId").val(1);
    $("#isUserPaidId").addClass("required");
});

listenClick("#generate-url-alias", function () {
    $.ajax({
        url: route("vcards.get-unique-url-alias"),
        type: "GET",
        success: function (result) {
            $("#vcard-url-alias").val(result);
        },
    });
});

listen("blur", "#vcard-url-alias", function () {
    let vcardId = $("#vcardId").length ? $("#vcardId").val() : "";
    if ($(this).val().trim().length) {
        $.ajax({
            url: route("vcards.check-unique-url-alias", $(this).val()),
            type: "GET",
            success: function (result) {
                let data = result.data;
                if (!data.isUnique && data.usedInVcard != vcardId) {
                    $("#error-url-alias-msg").removeClass("d-none");
                }

                setTimeout(() => {
                    $("#error-url-alias-msg").addClass("d-none");
                }, 3000);
            },
        });
    }
});

listenClick('.copy-btn', function () {
    $(this).closest('.copy-card').removeClass('show')
    let selectEle = $(this).
        closest('.weekly-content').
        find('.session-times').
        find('select')
    // check for slot is empty
    if (selectEle.length == 0) {
        $(this).
            closest('.menu-content').
            find('.copy-label .form-check-input:checked').
            each(function () {
                let weekEle = $(`.weekly-content[data-day="${$(this).val()}"]`)
                $(weekEle).find('.session-times').html('')
                weekEle.find('.weekly-row').find('.unavailable-time').remove()
                weekEle.find('.weekly-row').
                    append('<div class="unavailable-time">Unavailable</div>')
                let dayChk = $(weekEle).
                    find('.weekly-row').
                    find('input[name="checked_week_days[]"')
                dayChk.prop('checked', false).prop('disabled', true)
            })
    } else {
        selectEle.each(function () {
            $(this).select2('destroy')
        })
        let selects = $(this).
            closest('.weekly-content').
            find('.session-times').
            find('select')
        let $cloneEle = $(this).
            closest('.weekly-content').
            find('.session-times').
            clone()
        $(this).
            closest('.menu-content').
            find('.copy-label .form-check-input:checked').
            each(function () {
                let $cloneEle2 = $cloneEle
                let currentDay = $(this).val()
                let weekEle = `.weekly-content[data-day="${currentDay}"]`
                $cloneEle2.find('select[name^="startTimes"]').
                    attr('name', `startTimes[${currentDay}][]`)
                $cloneEle2.find('select[name^="endTimes"]').
                    attr('name', `endTimes[${currentDay}][]`)
                $(weekEle).find('.unavailable-time').html('')
                $cloneEle2.find('.error-msg').html('')
                $(weekEle).find('.session-times').html($cloneEle2.html())
                $(weekEle).find('.session-times select').select2()
                $(weekEle).
                    find('input[name="checked_week_days[]"').
                    prop('disabled', false).prop('checked', true)
                $(selects).each(function (i) {
                    let select = this
                    var elementValue = $(select).val() ? $(select).val() : '12:00 AM';
                    $(weekEle).
                        find('.session-times').
                        find('select').
                        eq(i).
                        val(elementValue).
                        trigger('change')
                })
            })

        $(this).
            closest('.weekly-content').
            find('.session-times').
            find('select').
            each(function () {
                $(this).select2()
            })
        $('.copy-check-input').prop('checked', false)
    }
    $('.copy-menu, .copy-days-btn').removeClass('show')
})
