listenClick("#addiframeBtn", function () {
    $("#addiframelModal").modal("show");
});

listenHiddenBsModal("#addiframelModal", function (e) {
    resetModalForm("#addiframeForm");
    $("#addiframeForm")[0].reset();
    $("#iframeSave").prop("disabled", false);
});

listenSubmit("#addiframeForm", function (e) {
    e.preventDefault();
    $("#iframeSave").prop("disabled", true);

    var formData = new FormData(this);

    $.ajax({
        url: route("iframe.store"),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#addiframeForm")[0].reset();
                $("#addiframelModal").modal("hide");
                Livewire.dispatch("refresh");
                $("#iframeSave").prop("disabled", true);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $("#iframeSave").prop("disabled", false);
        },
    });
});

listenSubmit("#editiframeForm", function (event) {
    $("#iframeUpdate").prop("disabled", true);
    event.preventDefault();
    let iframeId = $("#iframe_id").val();

    $.ajax({
        url: route("iframe.update", iframeId),
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                $("#iframeUpdate").prop("disabled", true);
                displaySuccessMessage(result.message);
                $("#editiframeModal").modal("hide");
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $("#iframeUpdate").prop("disabled", false);
        },
    });
});

listenClick(".iframe-edit-btn", function () {
    let id = $(this).attr("data-id");

    $.ajax({
        url: route("iframe.edit", id),
        type: "GET",
        success: function (result) {
            if (result.success) {
                $("#editUrl").val(result.data.url);
                $("#iframeUpdate").prop("disabled", false);
                $("#iframe_id").val(result.data.id);
                $("#editiframeModal").modal("show");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listen("click", ".iframe-delete-btn", function (event) {
    let iframeDeleteId = $(event.currentTarget).attr("data-id");
    let url = route("iframe.destroy", { iframe: iframeDeleteId });
    deleteItem(url, Lang.get("js.vcard_iframe"));
});
