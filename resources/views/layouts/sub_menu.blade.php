@role(App\Models\Role::ROLE_SUPER_ADMIN)
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/dashboard*') ? 'active' : '' }}"
            href="{{ route('sadmin.dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/users*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/users*') ? 'active' : '' }}"
            href="{{ route('users.index') }}">{{ __('messages.users') }}</a>
    </li>

    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/affiliate-users*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/affiliate-users*') ? 'active' : '' }}"
            href="{{ route('sadmin.affiliate-user.index') }}">{{ __('messages.vcard.affiliate_user') }}</a>
    </li> --}}
    <li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/affiliation-transactions*','sadmin/affiliate-users*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('sadmin/affiliate-users*') ? 'active' : '' }}"
        href="{{ route('sadmin.affiliate-user.index') }}">{{ __('messages.vcard.affiliate_user') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/affiliation-transactions*','sadmin/affiliate-users*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/affiliation-transactions*') ? 'active' : '' }}"
            href="{{ route('sadmin.affiliation-transaction.index') }}">{{ __('messages.affiliation.affiliation_transaction') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/withdraw-transactions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/withdraw-transactions*') ? 'active' : '' }}"
            href="{{ route('sadmin.withdraw-transactions') }}">{{ __('messages.setting.withdraw_transactions') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/vcards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/vcards*') ? 'active' : '' }}"
            href="{{ route('sadmin.vcards.index') }}">{{ __('messages.vcards') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/templates*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/templates*') ? 'active' : '' }}"
            href="{{ route('sadmin.templates.index') }}">{{ __('messages.vcards_templates') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/planSubscription*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/planSubscription*') ? 'active' : '' }}"
            href="{{ route('subscription.cash') }}">{{ __('messages.cash_payment') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/subscribedPlan*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/subscribedPlan*') ? 'active' : '' }}"
            href="{{ route('subscription.user.plan') }}">{{ __('messages.subscribed_user') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/plans*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/plans*') ? 'active' : '' }}"
            href="{{ route('plans.index') }}">{{ __('messages.plans') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/currencies*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/currencies*') ? 'active' : '' }}"
            href="{{ route('currencies.index') }}">{{ __('messages.currency.currencies') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('sadmin/countries*', 'sadmin/states*', 'sadmin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/countries*') ? 'active' : '' }}"
            href="{{ route('countries.index') }}">{{ __('messages.country.countries') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('sadmin/countries*', 'sadmin/states*', 'sadmin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/states*') ? 'active' : '' }}"
            href="{{ route('states.index') }}">{{ __('messages.state.states') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('sadmin/countries*', 'sadmin/states*', 'sadmin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/cities*') ? 'active' : '' }}"
            href="{{ route('cities.index') }}">{{ __('messages.city.cities') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/language') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/language*') ? 'active' : '' }}"
            href="{{ route('languages.default-language') }}">{{ __('messages.languages.languages') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/languages*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/languages*') ? 'active' : '' }}"
            href="{{ route('languages.index') }}">{{ __('messages.languages.languages') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/send*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/send*') ? 'active' : '' }}"
            href="{{ route('send.mail.index') }}">{{ __('messages.send_mail.send_mail') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/settings*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/settings*') ? 'active' : '' }}"
            href="{{ route('setting.index') }}">{{ __('messages.settings') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sadmin/admins*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/admins*') ? 'active' : '' }}"
            href="{{ route('admins.index') }}">{{ __('messages.admins') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*'
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/front-cms*') ? 'active' : '' }}"
            href="{{ route('setting.front.cms') }}">{{ __('messages.front_cms.front_cms') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*'
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/email-subscription*') ? 'active' : '' }}"
            href="{{ route('email.sub.index') }}">{{ __('messages.subscriber') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*'
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/features*') ? 'active' : '' }}"
            href="{{ route('features.index') }}">{{ __('messages.plan.features') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*'
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/about-us*') ? 'active' : '' }}"
            href="{{ route('aboutUs.index') }}">{{ __('messages.about_us.about_us') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*'
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/frontTestimonial*') ? 'active' : '' }}"
            href="{{ route('frontTestimonials.index') }}">{{ __('messages.vcard.testimonials') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*'
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/frontFaqs*') ? 'active' : '' }}"
            href="{{ route('frontFaqs.index') }}">{{ __('messages.faqs.faqs') }}</a>
    </li>


    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
       'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*',
    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/inquiries*') ? 'active' : '' }}"
            href="{{ route('contact.contactus') }}">{{ __('messages.contact_us.inquries') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/frontFaqs*',
        'sadmin/inquiries*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*',

    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/theme-configuration*') ? 'active' : '' }}"
            href="{{ route('themeConfiguration') }}">{{__('messages.vcard.theme_config') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is(
        'sadmin/front-cms*',
        'sadmin/email-subscription*',
        'sadmin/features*',
        'sadmin/about-us*',
        'sadmin/frontTestimonial*',
        'sadmin/inquiries*',
        'sadmin/frontFaqs*',
        'sadmin/theme-configuration*',
        'sadmin/banner*',
        'sadmin/app-download*',

    )
        ? 'd-none'
        : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/banner*') ? 'active' : '' }}"
            href="{{ route('banner') }}">{{__('messages.front_cms.banner_title') }}</a>
    </li>
    <li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
{{ !Request::is(
    'sadmin/front-cms*',
    'sadmin/email-subscription*',
    'sadmin/features*',
    'sadmin/about-us*',
    'sadmin/frontTestimonial*',
    'sadmin/inquiries*',
    'sadmin/frontFaqs*',
    'sadmin/theme-configuration*',
    'sadmin/banner*',
    'sadmin/app-download*',

)
    ? 'd-none'
    : '' }}">
    <a class="nav-link p-0 {{ Request::is('sadmin/app-download*') ? 'active' : '' }}"
        href="{{ route('appDownload') }}">{{__('messages.download_app_url') }}</a>
</li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('sadmin/coupon-codes*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('sadmin/coupon-codes*') ? 'active' : '' }}"
            href="{{ route('coupon-codes.index') }}">{{ __('messages.coupon_code.coupon_codes') }}</a>
    </li>
@endrole

@role(App\Models\Role::ROLE_ADMIN)
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/vcards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/vcards*') ? 'active' : '' }}"
            href="{{ route('vcards.index') }}">{{ __('messages.vcards') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/inquiries*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/inquiries*') ? 'active' : '' }}"
            href="{{ route('inquiries.index') }}">{{ __('messages.contact_us.inquries') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/appointments*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/appointments*') ? 'active' : '' }}"
            href="{{ route('appointments.index') }}">{{ __('messages.appointments') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/virtual-backgrounds*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/virtual-backgrounds*') ? 'active' : '' }}"
            href="{{ route('virtual-backgrounds.index') }}">{{ __('messages.virtual_backgrounds') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/user-setting*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/user-setting*') ? 'active' : '' }}"
            href="{{ route('user.setting.index') }}">{{ __('messages.settings') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/affiliations*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/affiliations*') ? 'active' : '' }}"
            href="{{ route('user.affiliation.index') }}">{{ __('messages.plan.affiliation') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/manage-subscription*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/manage-subscription*') ? 'active' : '' }}"
            href="{{ route('subscription.index') }}">{{ __('messages.subscription.manage_subscription') }}</a>
    </li>
@endrole


<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('profile*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('profile*') ? 'active' : '' }}"
        href="{{ route('profile.setting') }}">{{ __('messages.user.profile_details') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/choose-payment-type*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/choose-payment-type*') ? 'active' : '' }}"
        href="{{ route('subscription.upgrade') }}">{{ __('messages.plans') }}</a>
</li>

<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/product-orders*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/product-orders*') ? 'active' : '' }}"
        href="{{ route('product-orders.index') }}">{{__('messages.product_orders') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/vcard/subscribers/*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/vcard/subscribers/*') ? 'active' : '' }}"
        href="{{ route('product-orders.index') }}">{{ __('messages.vcard.email_subscription') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('sadmin/nfc-card-types*') || Request::is('sadmin/nfc-card-orders*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('sadmin/nfc-card-types*') ? 'active' : '' }}"
        href="{{ route('sadmin.nfc.card.types') }}">{{ __('messages.nfc.nfc_card_types') }}</a>
</li>
<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('sadmin/nfc-card-orders*') || Request::is('sadmin/nfc-card-types*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('sadmin/nfc-card-orders*') ? 'active' : '' }}"
        href="{{ route('nfc-card-orders.index') }}">{{ __('messages.nfc.nfc_card_orders') }}</a>
</li>
<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('admin/my-nfc-cards*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('admin/my-nfc-cards*') ? 'active' : '' }}"
        href="{{ route('user.orders') }}">{{ __('messages.nfc.my_nfc_cards') }}</a>
</li>
<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('admin/my-nfc-orders*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('admin/my-nfc-orders*') ? 'active' : '' }}"
        href="{{ route('user.orders') }}">{{ __('messages.nfc.my_nfc_cards') }}</a>
</li><li
class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('admin/storage*') ? '' : 'd-none' }}">
<a class="nav-link p-0 {{ Request::is('admin/storage*') ? 'active' : '' }}"
    href="{{ route('user.storage') }}">{{ __('messages.storage') }}</a>
</li>
