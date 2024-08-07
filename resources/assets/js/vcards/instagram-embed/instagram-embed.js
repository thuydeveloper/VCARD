listenClick("#addInstaBtn", function () {
    $("#addInstaModal").modal("show");
});

listenHiddenBsModal("#addInstaModal", function (e) {
    $("#addInstaForm")[0].reset();
    $("#typeId").val(null).trigger("change");
});

listenSubmit("#addInstaForm", function (e) {
    e.preventDefault();

    $("#InstagramEmbedSave").prop("disabled", true);
    $.ajax({
        url: route("instagram-embed.store"),
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#addInstaModal").modal("hide");
                $("#addInstaForm").trigger("reset");
                $("#InstagramEmbedSave").prop("disabled", false);
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $("#InstagramEmbedSave").prop("disabled", false);
        },
    });
});

listenClick(".instagramembed-edit-btn", function (event) {
    let InstagramId = $(event.currentTarget).attr("data-id");
    editInstagramRenderData(InstagramId);
});

function editInstagramRenderData(id) {
    $.ajax({
        url: route("instagram-embed.edit", id),
        type: "GET",
        success: function (result) {
            if (result.success) {
                $("#editTypeId").val(result.data.type).trigger("change");
                $("#editEmbedtag").val(result.data.embedtag);
                $("#editVcard").val(result.data.vcard_id);
                $("#editEmbedId").val(result.data.id);
                $("#editInstagramEmbedModal").modal("show");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}

listenSubmit("#EditInstaForm", function (event) {
    event.preventDefault();

    $("#editInstagramEmbedSave").prop("disabled", true);
    let embedId = $("#editEmbedId").val();
    $.ajax({
        url: route("instagram-embed.update", embedId),
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#editInstagramEmbedModal").modal("hide");
                $("#EditInstaForm").trigger("reset");
                $("#editInstagramEmbedSave").prop("disabled", false);
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            $("#editInstagramEmbedSave").prop("disabled", false);
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".instagramembed-delete-btn", function (event) {
    let recordId = $(event.currentTarget).attr("data-id");
    console.log(recordId);
    deleteItem(
        route("instagram-embed.destroy", recordId),
        Lang.get("js.embedtag")
    );
});

listenClick("#instaEmbedGuideBtn", function () {
    $("#instaEmbedGuideModal").modal("show");
});
