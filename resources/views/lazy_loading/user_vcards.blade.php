<div class="listing-skeleton container-fluid">
    <div class="card">
        <div class="card-content">
            <div class="d-flex justify-content-between">
                <div class="search-box pulsate rounded-1"> </div>
                <div class="d-flex">
                    <div class="add-button-box pulsate rounded-1"> </div>
                </div>
            </div>
        </div>
            <div class="d-flex flex-column">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="row">
                            @for ($i = 0; $i <= 5; $i++)
                                <div class="col-md-6 col-lg-6 col-12 col-xl-4 widget">
                                    <div
                                        class="skeleton shadow-md rounded-10  px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="skeleton-left flex1">
                                            <div class="square vcard-box"></div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
