<div id="mySidebar" class="me-5 sidebar d-lg-block d-xl-block">
    <a href="javascript:void(0)" class="closebtn d-lg-none d-block pt-3" onclick="closeNav()">×</a>
    <ul class="d-flex nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap flex-column setting-tab" id="myTab" role="tablist">
        <li class=" nav-item position-relative">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : '' }}"    href="{{ route('user.setting.index',['section' => 'general']) }}"> <i class="fa-solid fa-gears icon-color-bs-blue"></i>&nbsp;
                {{ __('messages.setting.general') }}</a>
        </li>
        <li class=" nav-item position-relative" role="presentation">
            <a class="nav-link me-0 p-0 {{ (isset($sectionName) && $sectionName == 'payment_method') ? 'active' : '' }}"
               href="{{ route('user.setting.index',['section' => 'payment_method']) }}" data-turbo="false"><i class="fa-solid fa-money-bill-1-wave icon-color-bs-green"></i> &nbsp;{{__('messages.vcard.payment_config') }}</a>
        </li>
    </ul>
</div>

<script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
    }
    </script>
