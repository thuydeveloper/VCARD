@role(App\Models\Role::ROLE_SUPER_ADMIN)
    <li class="nav-item {{ Request::is('sadmin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('sadmin.dashboard') }}">
            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-circle-dot icon-color-bs-blue"></i></span>
            <span class="aside-menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/admins*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('admins.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-house-user icon-color-bs-purple"></i></span>
            <span class="aside-menu-title">{{ __('messages.admins') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/users*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('users.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-users icon-color-bs-green"></i></span>
            <span class="aside-menu-title">{{ __('messages.vcard.user') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/vcard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('sadmin.vcards.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-id-card icon-color-bs-red"></i></span>
            <span class="aside-menu-title">{{ __('messages.vcards') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/nfc*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('sadmin.nfc.card.types') }}">
            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-credit-card icon-color-bs-orange"></i></span>
            <span class="aside-menu-title">{{ __('messages.nfc.sell_nfc_cards') }}</span>
        </a>
    </li>


    <li class="nav-item {{ Request::is('sadmin/templates*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page"
            href="{{ route('sadmin.templates.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-id-card-clip icon-color-bs-yellow"></i></span>
            <span class="aside-menu-title">{{ __('messages.vcards_templates') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/planSubscription*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('subscription.cash') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-money-bill icon-color-bs-green"></i></span>
            <span class="aside-menu-title">{{ __('messages.cash_payment') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/subscribedPlan*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page"
            href="{{ route('subscription.user.plan') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-paper-plane icon-color-bs-teal"></i></span>
            <span class="aside-menu-title">{{ __('messages.subscribed_plans') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/plans*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('plans.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-columns icon-color-bs-darkyellow"></i></span>
            <span class="aside-menu-title">{{ __('messages.plans') }}</span>
        </a>
    </li>

{{--
    <li class="nav-item {{ Request::is('sadmin/affiliate-users*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page"
            href="{{ route('sadmin.affiliate-user.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-user-group"></i></span>
            <span class="aside-menu-title">{{ __('messages.vcard.affiliate_user') }}</span>
        </a>
    </li> --}}

    <li class="nav-item {{ Request::is('sadmin/affiliation-transactions*') || Request::is('sadmin/affiliate-users*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page"
            href="{{ route('sadmin.affiliate-user.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-coins icon-color-bs-peach"></i></span>
            <span class="aside-menu-title">{{ __('messages.affiliation.affiliations') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/withdraw-transactions*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page"
            href="{{ route('sadmin.withdraw-transactions') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-receipt icon-color-bs-lightred"></i></span>
            <span class="aside-menu-title">{{ __('messages.setting.withdrawals') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/currencies*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('currencies.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-dollar-sign icon-color-bs-blue"></i></span>
            <span class="aside-menu-title">{{ __('messages.currency.currencies') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/countries*', 'sadmin/states*', 'sadmin/cities*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('countries.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-globe-americas icon-color-bs-purple"></i></span>
            <span class="aside-menu-title">{{ __('messages.country.countries') }}</span>
        </a>
    </li>

    {{-- <li class="nav-item {{ Request::is('sadmin/languages*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('languages.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-language"></i></span>
            <span class="aside-menu-title">{{ __('messages.languages.languages') }}</span>
        </a>
    </li> --}}

    <li class="nav-item {{ Request::is('sadmin/language*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('languages.default-language') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-language  icon-color-bs-orange"></i></span>
            <span class="aside-menu-title">{{ __('messages.languages.languages') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('sadmin/coupon-codes*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('coupon-codes.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-tags icon-color-bs-pink"></i></span>
            <span class="aside-menu-title">{{ __('messages.coupon_code.coupon_codes') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sadmin/send*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('send.mail.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-envelope icon-color-bs-teal"></i></span>
            <span class="aside-menu-title">{{ __('messages.send_mail.send_mail') }}</span>
        </a>
    </li>

    <li
        class="nav-item {{ Request::is('sadmin/front-cms*') ||
        Request::is('sadmin/email-subscription*') ||
        Request::is('sadmin/features*') ||
        Request::is('sadmin/about-us*') ||
        Request::is('sadmin/frontTestimonial*') ||
        Request::is('sadmin/frontFaqs*') ||
        Request::is('sadmin/inquiries*') ||
        Request::is('sadmin/banner*') ||
        Request::is('sadmin/contact-us*') ||
        Request::is('sadmin/app-download*') ||
        Request::is('sadmin/theme-configuration*')
            ? 'active'
            : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('setting.front.cms') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-home icon-color-bs-red"></i></span>
            <span class="aside-menu-title">{{ __('messages.front_cms.front_cms') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('sadmin/settings*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('setting.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-cogs icon-color-bs-orange"></i></span>
            <span class="aside-menu-title">{{ __('messages.settings') }}</span>
        </a>
    </li>
@endrole


@role(App\Models\Role::ROLE_ADMIN)
    <li class="user-dashboard nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('admin.dashboard') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-chart-pie icon-color-bs-blue"></i></span>
            <span class="aside-menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </li>

    <li class="vcard-option nav-item {{ Request::is('admin/vcard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('vcards.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-id-card icon-color-bs-orange"></i></span>
            <span class="aside-menu-title">{{ __('messages.vcards') }}</span>
        </a>
    </li>


    <li class="nav-item {{ Request::is('admin/inquiries*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('inquiries.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-info-circle icon-color-bs-red"></i></span>
            <span class="aside-menu-title">{{ __('messages.contact_us.inquries') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/appointments*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('appointments.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-calendar icon-color-bs-green"></i></span>
            <span class="aside-menu-title">{{ __('messages.vcard.appointments') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/product-orders*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('product-orders.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-money-bills icon-color-bs-darkyellow"></i></span>
            <span class="aside-menu-title">{{ __('messages.product_orders') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/virtual-backgrounds*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page"
            href="{{ route('virtual-backgrounds.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-id-card-clip icon-color-bs-lightred"></i></span>
            <span class="aside-menu-title">{{ __('messages.virtual_backgrounds') }}</span>
        </a>
    </li>

    @if (checkFeature('affiliation'))
        <li class="nav-item {{ Request::is('admin/affiliations*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                href="{{ route('user.affiliation.index') }}">
                <span class="aside-menu-icon pe-3"><i class="fas fa-coins icon-color-bs-pink"></i></span>
                <span class="aside-menu-title">{{ __('messages.plan.affiliation') }}</span>
            </a>
        </li>
    @endif
    @if (getNfcCard()->count() > 0)
        <li class="nav-item {{ Request::is('admin/my-nfc-cards*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                href="{{ route('user.orders') }}">
                <span class="aside-menu-icon pe-3"><i class="fas fa-id-card icon-color-bs-teal"></i></i></span>
                <span class="aside-menu-title">{{ __('messages.nfc.my_nfc_cards') }}</span>
            </a>
        </li>
    @endif
    <li class="nav-item {{ Request::is('admin/storage*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('user.storage') }}">
            <span class="aside-menu-icon pe-3"> <i class="fa-solid fa-memory icon-color-bs-red"></i></span>
            <span class="aside-menu-title">{{ __('messages.storage') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('admin/user-setting*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('user.setting.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-cog icon-color-bs-orange"></i></span>
            <span class="aside-menu-title">{{ __('messages.settings') }}</span>
        </a>
    </li>
@endrole
