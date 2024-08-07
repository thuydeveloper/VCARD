document.addEventListener("turbo:load", loadSocialLinks);

function loadSocialLinks() {}

listenClick(".social-links", function () {
    $(".social-links-add").append(
        '        <div class="col-lg-6 mb-7 social-links-div">\n' +
            '                            <div class="d-flex">\n' +
            '                                <div class="mb-3 mb-sm-0 me-5">\n' +
            '                                    <div class="" io-image-input="true">\n' +
            '                                        <div class="    ">\n' +
            '                                            <div class="image-picker">\n' +
            '                                                <div class="image previewImage " id="exampleInputImage"\n' +
            '                                                     style="background-image: url(' +
            defaultProfileUrl +
            ') ;width: 40px; height: 40px"></div>\n' +
            '                                                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"\n' +
            '                                                      data-placement="top" data-bs-original-title="{{__(\'messages.tooltip.profile\')}}" style="width: 22px; height: 22px">\n' +
            "                                                    <label>\n" +
            '                                                    <i class="fa-solid fa-pen" id="profileImageIcon" ></i>\n' +
            '                                                        <input type="file" id="profile_image" name="social_links_image[]"\n' +
            '                                                               class="image-upload d-none social_links_image" accept="image/*"/>\n' +
            "                                                    </label>\n" +
            "                                                </span>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            '                                <div class="d-flex ml-2 w-100">\n' +
            '                                    <input type="text" class="form-control social_links" name="social_links[]">\n' +
            '  <input type="hidden" name="social_link_id[]" class="socialLinkId" value="">' +
            '                                    <a href="javascript:void(0)"  title="{{ __(\'messages.common.delete\') }}"\n' +
            '                                       class="btn px-1 text-danger fs-3 social-links-delete-btn">\n' +
            '                                        <i class="fa-solid fa-trash"></i>\n' +
            "                                    </a>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>"
    );

    IOInitImageComponent();
});
listenClick(".social-links-delete-btn", function () {
    $(this).closest(".social-links-div").remove();
});
listenClick(".social_link_save", function (e) {
    e.preventDefault();
    let inputs = $(".social_links");
    let img = $(".social_links_image");

    for (var i = 0; i < inputs.length; i++) {
        if ($.trim($(inputs[i]).val()) == "") {
            displayErrorMessage(Lang.get("js.social_links_is_required"));
            return false;
        }
    }
    for (var i = 0; i < img.length; i++) {
        let image;
        if ($(img[i]).prop("defaultValue") != "") {
            if ($(img[i]).val() == "") {
                image = $(img[i]).prop("defaultValue");
            } else {
                image = $(img[i]).val();
            }
        } else {
            image = $(img[i]).val();
        }
        if (image == "") {
            displayErrorMessage(Lang.get("js.social_links_img_is_required"));
            return false;
        }
        var ext = image.split(".").pop().toLowerCase();
        if ($.inArray(ext, ["png", "jpg", "jpeg"]) == -1) {
            displayErrorMessage(Lang.get("js.allowed_image"));
            return false;
        }
        let links;
        if ($(inputs[i]).prop("defaultValue") != "") {
            if ($(inputs[i]).val() == "") {
                links = $(inputs[i]).prop("defaultValue");
            } else {
                links = $(inputs[i]).val();
            }
        } else {
            links = $(inputs[i]).val();
        }
        if ($.trim(links) == "") {
            displayErrorMessage(Lang.get("js.social_links_img_is_required"));
            return false;
        }
    }
    $("#editForm").submit();
});
