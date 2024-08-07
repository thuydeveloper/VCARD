      {{-- Card --}}
      <div class="col-12 mb-4">
         <div class="row">
             <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                 <div class="bg-primary shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center
                     justify-content-between my-3 gap-3">
                     <div
                         class="bg-cyan-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                         <i class="fa-solid fa-user fs-1-xl text-white"></i>
                     </div>
                     <div class="text-end text-white">
                         <h2 class="fs-1-xxl fw-bolder text-white">{{ $activeUsersCount }}</h2>
                         <h3 class="mb-0 fs-4 fw-light">{{__('messages.common.total_active_users')}}</h3>
                     </div>
                 </div>
             </div>
             <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                 <div
                     class="bg-success shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 gap-3">
                     <div
                         class="bg-green-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                         <i class="fa-solid fa-id-card-clip fs-1-xl text-white"></i>
                     </div>
                     <div class="text-end text-white">
                         <h2 class="fs-1-xxl fw-bolder text-white">{{ $activeVcard }}</h2>
                         <h3 class="mb-0 fs-4 fw-light">{{ __('messages.common.total__active_vcards') }}</h3>
                     </div>
                 </div>
             </div>
             <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                 <div
                     class="bg-info shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 gap-3">
                     <div
                         class="bg-blue-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                         <i class="fa-solid fa-user-large-slash fs-1-xl text-white"></i>
                     </div>
                     <div class="text-end text-white">
                         <h2 class="fs-1-xxl fw-bolder text-white">{{ $deActiveUsersCount }}</h2>
                         <h3 class="mb-0 fs-4 fw-light">{{ __('messages.common.total_deactive_users') }}</h3>
                     </div>
                 </div>
             </div>
             <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                 <div
                     class="bg-warning shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 gap-3">
                     <div
                         class="bg-yellow-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                         <img src="{{ asset('assets/img/dashboard/deactive-vcard.svg') }}" alt="" class="w-50 h-50">
                     </div>
                     <div class="text-end text-white">
                         <h2 class="fs-1-xxl fw-bolder text-white">{{ $deActiveVcard }}</h2>
                         <h3 class="mb-0 fs-4 fw-light">{{ __('messages.common.total__deactive_vcards') }}</h3>
                     </div>
                 </div>
             </div>
         </div>
     </div>

