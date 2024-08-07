"use strict";

const { pull } = require("lodash");

document.addEventListener("DOMContentLoaded", load);

function load() {
    $("html, body").animate({
        scrollTop: $("html, body").offset().top,
    });

    $(".customSelect").each(function () {
        let selectedOption = $(this).find("option:selected");
        let newPrice = selectedOption.data("price");
        let planId = $(this).data("plan-id");
        let choosePaymnetURL = route("choose.payment.type", planId);
        $(".custom-price-" + planId).text(newPrice);
        $("#planId" + planId).attr(
            "href",
            choosePaymnetURL + "?customFieldId=" + selectedOption.val()
        );
    });
}

listenSubmit("#addEmail", function (e) {
    e.preventDefault();
    $(".subscribeBtn").attr("disabled", true);
    $.ajax({
        url: route("email.sub"),
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                document.getElementById("addEmail").reset();
            }
            $(".subscribeBtn").attr("disabled", false);
        },
        error: function (result) {
            $(".subscribeBtn").attr("disabled", false);
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".navbar-nav .nav-item .nav-link", function () {
    $(".navbar-collapse").collapse("hide");
});

listenClick(".js-cookie-consent-declined", function () {
    $(".js-cookie-consent").addClass("d-none");
    $.ajax({
        url: route("declineCookie"),
        type: "GET",
        success: function (result) {},
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
listenClick(".js-cookie-consent-agree", function () {
    $(".js-cookie-consent").addClass("d-none");
});

listenClick(".fa-scroll-torah-custom", function () {
    $("html, body").animate({
        scrollTop: $("html, body").offset().top,
    });
});

listenClick(".nav-link", function () {
    $(".navbar-toggler ").removeClass("open");
});

listenClick(".close-btn", function () {
    $(".banner-section ").addClass("d-none");
    var expires = new Date();
    expires.setHours(expires.getHours() + 24);
    document.cookie = "banner-section=1; expires=" + expires.toUTCString();
});

window.onload = function () {
    if (document.cookie.includes("banner-section")) {
        $(".banner-cookie").addClass("d-none").removeClass("d-block");
    } else {
        $(".banner-cookie").addClass("d-block").removeClass("d-none");
    }
};

listenClick(".show-plan-features", function (event) {
    var pricingCard = $(this).closest(".pricing-card");
    var allFeatures = pricingCard.find(".all-features");
    allFeatures.removeClass("d-none");
    allFeatures.slideDown("slow", function () {
        pricingCard.find(".show-plan-features").addClass("d-none");
        pricingCard.find(".less-plan-features").removeClass("d-none");
    });
});

listenClick(".less-plan-features", function (event) {
    var pricingCard = $(this).closest(".pricing-card");
    var allFeatures = pricingCard.find(".all-features");
    allFeatures.slideUp("slow", function () {
        allFeatures.addClass("d-none");
        pricingCard.find(".show-plan-features").removeClass("d-none");
        pricingCard.find(".less-plan-features").addClass("d-none");
    });
});



function listenChange(selector, callback) {
    $(document).on("change", selector, function () {
        callback.call(this);
    });
}

listenChange(".customSelect", function () {
    let selectedOption = $(this).find("option:selected");
    let newPrice = selectedOption.data("price");
    let planId = $(this).data("plan-id");
    let choosePaymnetURL = route("choose.payment.type", planId);
    $(".custom-price-" + planId).text(newPrice);
    $("#planId" + planId).attr(
        "href",
        choosePaymnetURL + "?customFieldId=" + selectedOption.val()
    );
});
