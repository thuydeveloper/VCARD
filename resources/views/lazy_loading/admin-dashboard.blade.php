<div class="container-fluid">
    <div class="d-flex flex-column">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="row">
                    @for($i=0; $i<=3; $i++)
                    <div class="col-xxl-3 col-xl-3 col-sm-6 widget">
                        <div
                            class="skeleton shadow-md rounded-10  px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                            <div class="skeleton-left flex1">
                                <div class="square total-box"></div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            <div class="col-xxl-12 mb-7 col-12">
                <div class="skeleton shadow-md rounded-10">
                    <div class="skeleton-left">
                        <div class="square" style="height: 400px"></div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-12 col-12 mb-7">
                <div class="card">
                    <div class="skeleton-loader clearfix">
                        <div class="skeleton-1"></div>
                        <div class="skeleton-2"></div>
                        <div class="skeleton-3"></div>
                    </div>

                    <div class="skeleton-loader clearfix">
                        <div class="skeleton-1"></div>
                        <div class="skeleton-2"></div>
                        <div class="skeleton-3"></div>
                    </div>

                    <div class="skeleton-loader clearfix">
                        <div class="skeleton-1"></div>
                        <div class="skeleton-2"></div>
                        <div class="skeleton-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
