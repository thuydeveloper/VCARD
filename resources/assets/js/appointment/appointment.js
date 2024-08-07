document.addEventListener("turbo:load", loadAppointmentCalendar);
Livewire.hook("element.init", () => {
    loadAppimentFilter();
});
let popover;
let popoverState = false;
let calendar;
let data = {
    id: "",
    uId: "",
    eventName: "",
    eventDescription: "",
    eventStatus: "",
    startDate: "",
    endDate: "",
    vcardName: "",
    email: "",
    phone: "",
    startDateTime: "",
    endDateTime: "",
};

// View event variables
let viewEventName,
    viewEventDescription,
    viewEventStatus,
    viewStartDate,
    viewEndDate,
    viewModal,
    viewEditButton,
    viewDeleteButton,
    viewVcardName,
    viewEmail,
    viewPhone;

function loadAppointmentCalendar() {
    appointmentStatusUpdate();
    if (!$("#appointmentCalendar").length) {
        return;
    }

    initCalendarApp();
    let calendar = document.getElementById("appointmentCalendar");
    if (isEmpty(calendar)) {
        return;
    }
    init();
}

const initCalendarApp = function () {
    let calendarEl = document.getElementById("appointmentCalendar");
    calendar = new FullCalendar.Calendar(calendarEl, {
        buttonText: {
            today: Lang.get("js.today"),
            month: Lang.get("js.month"),
        },
        themeSystem: "bootstrap5",
        height: 750,
        locale: getLoggedInUserLang,
        headerToolbar: {
            left: "title",
            center: "prev,next today",
            right: "dayGridMonth",
        },
        initialDate: new Date(),
        timeZone: "UTC",
        dayMaxEvents: true,
        events: function (info, successCallback, failureCallback) {
            $.ajax({
                url: route("appointments.calendar"),
                type: "GET",
                data: info,
                success: function (result) {
                    if (result.success) {
                        successCallback(result.data);
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message);
                    failureCallback();
                },
            });
        },
        // MouseEnter event --- more info: https://fullcalendar.io/docs/eventMouseEnter
        eventMouseEnter: function (arg) {
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                description: arg.event.extendedProps.description,
                name: arg.event.extendedProps.name,
                vcardName: arg.event.extendedProps.vcardName,
                email: arg.event.extendedProps.email,
                phone: arg.event.extendedProps.phone,
                startDateTime: arg.event.extendedProps.startDateTime,
                endDateTime: arg.event.extendedProps.endDateTime,
            });
            // Show popover preview
            initPopovers(arg.el);
        },
        eventMouseLeave: function () {
            hidePopovers();
        },
        // Click event --- more info: https://fullcalendar.io/docs/eventClick
        eventClick: function (arg) {
            hidePopovers();
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                description: arg.event.extendedProps.description,
                name: arg.event.extendedProps.name,
                vcardName: arg.event.extendedProps.vcardName,
                email: arg.event.extendedProps.email,
                phone: arg.event.extendedProps.phone,
                startDateTime: arg.event.extendedProps.startDateTime,
                endDateTime: arg.event.extendedProps.endDateTime,
            });
            handleViewEvent();
        },
    });
    calendar.render();
};

const init = () => {
    const viewElement = document.getElementById("patientEventModal");
    viewModal = new bootstrap.Modal(viewElement);
    viewEventName = viewElement.querySelector('[data-calendar="event_name"]');
    viewEventDescription = viewElement.querySelector(
        '[data-calendar="event_description"]'
    );
    viewEventStatus = viewElement.querySelector(
        '[data-calendar="event_status"]'
    );
    viewVcardName = viewElement.querySelector(
        '[data-calendar="event_vcard_name"]'
    );
    viewEmail = viewElement.querySelector('[data-calendar="event_email"]');
    viewPhone = viewElement.querySelector('[data-calendar="event_phone"]');
    viewStartDate = viewElement.querySelector(
        '[data-calendar="event_start_date"]'
    );
    viewEndDate = viewElement.querySelector('[data-calendar="event_end_date"]');
    viewEditButton = viewElement.querySelector("#modal_view_event_edit");
    viewDeleteButton = viewElement.querySelector("#modal_view_event_delete");
};

// Format FullCalendar responses
const formatArgs = (res) => {
    data.id = res.id;
    data.eventName = res.title;
    data.eventDescription = res.description;
    data.startDate = res.startStr;
    data.endDate = res.endStr;
    data.name = res.name;
    data.vcardName = res.vcardName;
    data.email = res.email;
    data.phone = res.phone;
    data.startDateTime = res.startDateTime;
    data.endDateTime = res.endDateTime;
};

// Initialize popovers --- more info: https://getbootstrap.com/docs/4.0/components/popovers/
const initPopovers = (element) => {
    hidePopovers();
    // Generate popover content
    const startDate = data.allDay
        ? moment(data.startDate).format("Do MMM, YYYY")
        : moment(data.startDate).format("Do MMM, YYYY - h:mm a");
    const endDate = data.allDay
        ? moment(data.endDate).format("Do MMM, YYYY")
        : moment(data.endDate).format("Do MMM, YYYY - h:mm a");
    const popoverHtml =
        '<div class="fw-bolder mb-2"><b>User</b>: ' +
        data.name +
        '</div><div class="fs-7"><span class="fw-bold">Start:</span> ' +
        startDate +
        '</div><div class="fs-7 mb-2"><span class="fw-bold">End:</span> ' +
        endDate +
        "</div>" +
        '<div class="fw-bolder"><b>' +
        Lang.get("js.vcard_name") +
        "</b>:</span> " +
        data.vcardName +
        "</div>";
    // Popover options
    let options = {
        container: "body",
        trigger: "manual",
        boundary: "window",
        placement: "auto",
        dismiss: true,
        html: true,
        title: "Appointment Details",
        content: popoverHtml,
    };
};

// Hide active popovers
const hidePopovers = () => {
    if (popoverState) {
        popover.dispose();
        popoverState = false;
    }
};

// Handle view button
const handleViewButton = () => {
    const viewButton = document.querySelector("#calendar_event_view_button");
    viewButton.addEventListener("click", (e) => {
        e.preventDefault();
        hidePopovers();
        handleViewEvent();
    });
};

// Handle view event
const handleViewEvent = () => {
    $(".fc-popover").addClass("hide");
    viewModal.show();

    // Detect all day event
    let eventNameMod;
    let startDateMod;
    let endDateMod;

    eventNameMod = "";
    startDateMod = data.startDateTime;
    endDateMod = data.endDateTime;
    viewEndDate.innerText = ": " + endDateMod;
    viewStartDate.innerText = ": " + startDateMod;

    // Populate view data
    viewEventName.innerText = Lang.get("js.user") + ": " + data.name;
    $(viewEventStatus).val(data.eventStatus);
    viewVcardName.innerText = Lang.get("js.vcard_name") + ": " + data.vcardName;
    viewEmail.innerText = Lang.get("js.email") + ": " + data.email;
    viewPhone.innerText = Lang.get("js.phone") + ": " + data.phone;
};

function loadAppimentFilter() {
    $("#appointmentType,#appointmentStatus1").select2();
}
listen("change", "#appointmentType", function () {
    Livewire.dispatch("changeFilter", { type: $(this).val() });
    window.hideDropdownManually(
         $("#dropdownMenuAppoiment"),
         $(".dropdown-menu")
     );
});
listen("change", "#appointmentStatus1", function () {
    Livewire.dispatch("changeFilterStatus", { status: $(this).val() });
    window.hideDropdownManually(
         $("#dropdownMenuAppoiment"),
         $(".dropdown-menu")
     );
});

listen("click", "#appointmentResetFilter", function () {
    $("#appointmentType").val(3).change();
    $("#appointmentStatus").val(3).change();
    Livewire.dispatch("changeFilter", { type: "" });
    Livewire.dispatch("changeFilterStatus", { status: "" });
    window.hideDropdownManually(
        $("#dropdownMenuAppoiment"),
        $(".dropdown-menu")
    );
});

listen("click", "#appointmentFilterBtn", function () {
    openDropdownManually($("#appointmentFilterBtn"), $("#appointmentFilter"));
});

listenClick(".appointment-delete-btn", function (event) {
    let recordId = $(event.currentTarget).data("id");
    deleteItem(
        route("appointments.destroy", recordId),
        Lang.get("js.appointment")
    );
});

function appointmentStatusUpdate() {
    listenClick(".completed-appointment", function (event) {
        let appointmentId = $(event.currentTarget).data("id");
        let url = route("appointments.update", { appointment: appointmentId });
        appointmentItem(url, Lang.get("js.appointments"));
    });

    function appointmentItem(url, header) {
        var callFunction =
            arguments.length > 3 && arguments[3] !== undefined
                ? arguments[3]
                : null;
        swal({
            title: Lang.get("js.completed") + " !",
            text: Lang.get("js.are_you_completed"),
            buttons: {
                confirm: Lang.get("js.Yes_Change"),
                cancel: Lang.get("js.no"),
            },
            reverseButtons: true,
            icon: sweetCompletedAlertIcon,
        }).then(function (willDelete) {
            if (willDelete) {
                appointmentItemAjax(url, header, callFunction);
            }
        });
    }

    function appointmentItemAjax(url, header, callFunction = null) {
        screenLock();
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            success: function (obj) {
                screenUnLock();
                if (obj.success) {
                    Livewire.dispatch("resetPageTable");
                }
                swal({
                    icon: "success",
                    title: Lang.get("js.completed") + " !",
                    text: header + " " + Lang.get("js.has_been_completed"),
                    timer: 4000,
                    buttons: {
                        confirm: Lang.get("js.ok"),
                    },
                });
                if (callFunction) {
                    eval(callFunction);
                }
            },
            error: function (data) {
                swal({
                    title: "Error",
                    icon: "error",
                    text: data.responseJSON.message,
                    type: "error",
                    timer: 4000,
                });
            },
        });
    }
}

listenClick(".appointmentPaymentStatus", function () {
    $(this).attr("disabled", true);
    let planId = $(this).data("id");
    let tenantId = $(this).data("tenant");
    let status = $(this).data("status");
    let updateStatus = route("payment.status", planId);
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
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
