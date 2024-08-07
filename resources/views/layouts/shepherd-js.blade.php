<script>
    var steps = {{ getLogInUser()->steps }};
    var hasActiveSub = {{ json_encode(hasActiveSubscription()) }};


    if (steps == 0 && hasActiveSub == true) {
        if (performance.navigation.type === 1) {
            window.location.href = '/admin/dashboard';
        }

        const tour = new Shepherd.Tour({
            useModalOverlay: true,
            defaultStepOptions: {
                classes: 'shadow-md bg-purple-dark',
                scrollTo: true
            }
        });

        let currentPath = window.location.pathname;
        // Step 1
        if (currentPath === '/admin/manage-subscription') {
            if(window.innerWidth < 1200){
                $("#sidebar").addClass("collapsed-menu");
                $("body").addClass("collapsed-menu");
            }
            tour.addStep({
                id: 'example-step',
                text:(Lang.get("js.click_to_go_dashboard")),
                attachTo: {
                    element: '.user-dashboard ',
                    on: 'bottom'
                },
                beforeShowPromise: function() {
                return new Promise(function(resolve) {
                        $('html, body').animate({
                            scrollTop: $('.user-dashboard').offset().top - 100
                        }, 500, function() {
                            resolve();
                        });
                });
                },
                classes: 'shepherd example-step-extra-class',
                buttons: [{
                        text:(Lang.get("js.skip")),
                        classes: 'shepherd-button-secondary',
                        action: function() {
                            $.ajax({
                                url: route("update-steps", {
                                    steps: 1
                                }),
                                type: "GET",
                                success: function() {
                                    tour.complete();
                                }
                            });
                        }
                    },
                    {
                        text:(Lang.get("js.next")),
                        action: function() {
                            localStorage.setItem('startFromStep2', 'true');
                            window.location.href = '/admin/dashboard';
                        }
                    }
                ]
            });
        }

            // Step 2
            tour.addStep({
            id: 'example-step2',
            text: Lang.get("js.this_is_analytics_chart"),
            attachTo: {
                element: '.analytics-chart',
                on: 'bottom'
            },
            beforeShowPromise: function() {
                return new Promise(function(resolve) {
                    var analyticsChart = $('.analytics-chart');
                    if (analyticsChart.length > 0) {
                        $('html, body').animate({
                            scrollTop: analyticsChart.offset().top - 100
                        }, 500, function() {
                            resolve();
                        });
                    } else {

                    }
                });
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                    text: Lang.get("js.skip"),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text: Lang.get("js.next"),
                    action: function() {
                        if (window.innerWidth < 1200) {
                            tour.next('example-step3');
                        } else {
                            tour.show('example-step4');
                        }
                    }
                }
            ]
        });
        // Step 3
        tour.addStep({
            id: 'example-step3',
            text:(Lang.get("js.click_open_sidebar")),
            attachTo: {
                element: '.sidemenu-btn',
                on: 'bottom'
            },
            classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
            buttons: [
                {
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", { steps: 1 }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    classes: 'shepherd-button-example-primary',
                    action: function() {
                        $("#sidebar").addClass("collapsed-menu");
                        $("body").addClass("collapsed-menu");
                        tour.next();
                    }
                }
            ]
        });

        // Step 4
        tour.addStep({
            id: 'example-step4',
            text:(Lang.get("js.click_to_make_vcards")),
            attachTo: {
                element: '.vcard-option',
                on: 'bottom'
            },
            beforeShowPromise: function() {
                return new Promise(function(resolve) {
                    if ($(window).width() < 1200) {
                        $('html, body').animate({
                            scrollTop: $('.vcard-option').offset().top - 100
                        }, 500, function() {
                            resolve();
                        });
                    } else {
                        resolve();
                    }
                });
            },
            classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
            buttons: [
                {
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", { steps: 1 }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    classes: 'shepherd-button-example-primary',
                    action: function() {
                        localStorage.setItem('startFromStep5', 'true');
                        window.location.href = 'vcards';
                    }
                }
            ]
        });

        // Step 5
        tour.addStep({
            id: 'example-step5',
            text:(Lang.get("js.click_to_create_vcards")),
            attachTo: {
                element: '.new-vcard',
                on: 'bottom'
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    action: function() {
                        localStorage.setItem('startFromStep6', 'true');
                        window.location.href = 'vcards/create';
                    }
                }
            ]
        });

        // Step 6
        tour.addStep({
            id: 'example-step6',
            text:(Lang.get("js.click_to_generate_alias")),
            attachTo: {
                element: '#generate-url-alias',
                on: 'bottom'
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    action: function() {
                        const urlAliasValue = document.querySelector('.vcard-url-alias').value;
                        if (urlAliasValue) {
                            tour.next();
                        } else {
                            displayErrorMessage(Lang.get("js.generate_url_alias"));
                        }
                    }
                }
            ]
        });

        // Step 7
        tour.addStep({
            id: 'example-step7',
            text:(Lang.get("js.click_to_add_vcard_name")),
            attachTo: {
                element: '.vcard-name',
                on: 'bottom'
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    action: function() {
                        const vcardNameValue = document.querySelector('.vcard-name').value;
                        if (vcardNameValue) {
                            tour.next();
                        } else {
                            displayErrorMessage(Lang.get("js.enter_vcard_name"));
                        }
                    }
                }
            ]
        });

        // Step 8
        tour.addStep({
            id: 'example-step8',
            text:(Lang.get("js.click_to_save_vcard")),
            attachTo: {
                element: '#vcardSaveBtn',
                on: 'bottom'
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    action: function() {
                        const vcardSaveBtn = document.querySelector('#vcardSaveBtn');
                        vcardSaveBtn.click();
                        localStorage.setItem('startFromStep9', 'true');
                        if (window.innerWidth < 990) {
                            setTimeout(() => {
                                const dynamicId = window.location.href.split('/').slice(-2, -1)[
                                    0];
                                window.location.href = `/admin/vcards/${dynamicId}/edit`;
                                tour.next('example-step9')
                            }, 500);
                        } else {
                            setTimeout(() => {
                                const dynamicId = window.location.href.split('/').slice(-2, -1)[
                                    0];
                                localStorage.setItem('startFromStep10', 'true');
                                window.location.href =
                                    `/admin/vcards/${dynamicId}/edit?part=templates`;
                                tour.show('example-step10');
                            }, 1000);
                        }
                    }
                }
            ]
        });
        // Step 9
        function openNav() {
            const sidebar = document.getElementById("mySidebar");
            sidebar.style.width = "250px";
        }
        const urlParams = new URLSearchParams(window.location.search);
        const openSidebar = urlParams.get('openSidebar');
        if (openSidebar === 'true') {
            openNav();
        }

        tour.addStep({
            id: 'example-step9',
            text:(Lang.get("js.click_to_open_edit_sidebar")),
            attachTo: {
                element: '.edit-menu',
                on: 'bottom'
            },
            classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
            buttons: [{
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    classes: 'shepherd-button-example-primary',
                    action: function() {
                        const dynamicId = window.location.href.split('/').slice(-2, -1)[0];
                        localStorage.setItem('startFromStep10', 'true');
                        window.location.href =
                            `/admin/vcards/${dynamicId}/edit?part=templates&openSidebar=true`;
                    }
                }
            ]
        });
        // Step 10
        tour.addStep({
            id: 'example-step10',
            text:(Lang.get("js.here_select_vcard_template")),
            attachTo: {
                element: '.vcards-templates',
                on: 'bottom'
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                    text:(Lang.get("js.skip")),
                    classes: 'shepherd-button-secondary',
                    action: function() {
                        $.ajax({
                            url: route("update-steps", {
                                steps: 1
                            }),
                            type: "GET",
                            success: function() {
                                tour.complete();
                            }
                        });
                    }
                },
                {
                    text:(Lang.get("js.next")),
                    action: function() {
                        localStorage.setItem('startFromStep11', 'true');
                        window.location.href = '/admin/vcards';
                    }
                }
            ]
        });

        // Step 11
        tour.addStep({
            id: 'example-step11',
            text:(Lang.get("js.click_to_preview")),
            attachTo: {
                element: '.preview-url',
                on: 'bottom'
            },
            classes: 'shepherd example-step-extra-class',
            buttons: [{
                text: 'Exit',
                action: function() {
                    $.ajax({
                        url: route("update-steps", {
                            steps: 1
                        }),
                        type: "GET",
                    });
                    tour.next();
                }
            }]
        });

        tour.start();
        if (steps === 0 && hasActiveSub === true) {
            const startFromStep3 = localStorage.getItem('startFromStep3');
            if (startFromStep3 === 'true') {
                tour.show('example-step3');
                localStorage.removeItem('startFromStep3');
            }

            const startFromStep4 = localStorage.getItem('startFromStep4');
            if (startFromStep4 === 'true') {
                tour.show('example-step4');
                localStorage.removeItem('startFromStep4');
            }

            const startFromStep5 = localStorage.getItem('startFromStep5');
            if (startFromStep5 === 'true') {
                tour.show('example-step5');
                localStorage.removeItem('startFromStep5');
            }

            const startFromStep6 = localStorage.getItem('startFromStep6');
            if (startFromStep6 === 'true') {
                tour.show('example-step6');
                localStorage.removeItem('startFromStep6');
            }

            const startFromStep7 = localStorage.getItem('startFromStep7');
            if (startFromStep7 === 'true') {
                tour.show('example-step7');
                localStorage.removeItem('startFromStep7');
            }

            const startFromStep8 = localStorage.getItem('startFromStep8');
            if (startFromStep8 === 'true') {
                tour.show('example-step8');
                localStorage.removeItem('startFromStep8');
            }

            const startFromStep9 = localStorage.getItem('startFromStep9');
            if (startFromStep9 === 'true') {
                tour.show('example-step9');
                localStorage.removeItem('startFromStep9');
            }

            const startFromStep10 = localStorage.getItem('startFromStep10');
            if (startFromStep10 === 'true') {
                tour.show('example-step10');
                localStorage.removeItem('startFromStep10');
            }

            const startFromStep11 = localStorage.getItem('startFromStep11');
            if (startFromStep11 === 'true') {
                tour.show('example-step11');
                localStorage.removeItem('startFromStep11');
            }
        }
    }
</script>
