<div class="me-5">
    <ul class="d-flex nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap flex-column setting-tab" id="myTab" role="tablist">
        <li class=" nav-item position-relative">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : '' }}"    href="{{ route('setting.index',['section' => 'general']) }}"> <i class="fa-solid fa-gears icon-color-bs-blue"></i>&nbsp;
                {{ __('messages.setting.general') }}</a>
        </li>

        <li class=" nav-item position-relative" role="presentation">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'terms-conditions') ? 'active' : '' }}"
               href="{{ route('setting.index',['section' => 'terms-conditions']) }}"><i class="fa-solid fa-clipboard-list icon-color-bs-purple"></i> &nbsp;{!! __('messages.vcard.term_condition') !!}</a>
        </li>

        {{-- <li class=" nav-item position-relative" role="presentation">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'manual_payment_guide') ? 'active' : '' }}"
               href="{{ route('setting.index',['section' => 'manual_payment_guide']) }}"><i class="fa-solid fa-receipt"></i> &nbsp;{{__('messages.vcard.manual_payment_guide') }}</a>
        </li> --}}

        <li class=" nav-item position-relative" role="presentation">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'google_analytics') ? 'active' : '' }}"
               href="{{ route('setting.index',['section' => 'google_analytics']) }}"><i class="fa-brands fa-google icon-color-bs-red"></i> &nbsp;{{__('messages.vcard.google_config') }}</a>
        </li>

        <li class=" nav-item position-relative" role="presentation">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'payment_method') ? 'active' : '' }}"
               href="{{ route('setting.index',['section' => 'payment_method']) }}" data-turbo="false"><i class="fa-solid fa-money-bill-1-wave icon-color-bs-green"></i> &nbsp;{{__('messages.vcard.payment_config') }}</a>
        </li>

        <li class=" nav-item position-relative" role="presentation">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'home_page_settings') ? 'active' : '' }}"
               href="{{ route('setting.index',['section' => 'home_page_settings']) }}" data-turbo="false"><i class="fa-solid fa-house icon-color-bs-pink"></i> &nbsp;{{__('messages.vcard.homepage_settings') }}</a>
        </li>
    </ul>
</div>
