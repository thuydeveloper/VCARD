<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salon</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard15.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
  </head>
  <body>
    <div class="container p-0">
      <div class="main-content mx-auto w-100 overflow-hidden">
        <div class="banner-section position-relative">
          <div class="banner-img">
            <img src="{{asset('assets/img/vcard15/Banner.png')}}" class="img-fluid" loading="lazy"/>
            <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3 z-index-9">
                <div class="language pt-3 me-2">
                    <ul class="text-decoration-none">
                        <li class="dropdown1 dropdown lang-list">
                            <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-language me-2"></i>Language</a>
                            <ul class="dropdown-menu start-0 lang-hover-list top-100 mt-0">
                                <li>
                                    <img src="{{asset('assets/img/vcard1/english.png')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">English</a></li>
                                <li>
                                    <img src="{{asset('assets/img/vcard1/spain.png')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">Spanish</a></li>
                                <li>
                                    <img src="{{asset('assets/img/vcard1/france.png')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">Franch</a></li>
                                <li>
                                    <img src="{{asset('assets/img/vcard1/arabic.svg')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">Arabic</a></li>
                                <li>
                                    <img src="{{asset('assets/img/vcard1/german.png')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">German</a></li>
                                <li>
                                    <img src="{{asset('assets/img/vcard1/russian.jpeg')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">russian</a></li>
                                <li>
                                    <img src="{{asset('assets/img/vcard1/turkish.png')}}" width="25px" height="20px"
                                         class="me-3" loading="lazy"><a href="#">Turkish</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
          </div>
          <svg
            class="curve-shape"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px"
            y="0px"
            viewBox="0 0 4000 275"
          >
            <path
              style="fill: #043636"
              d="M4000,125.3V275H0V109.9C1907.2,500.4,2670.5-323.1,4000,125.3z"
            ></path>
          </svg>
        </div>
        <div class="bg-primary">
          <div class="profile-section pb-60 px-30">
            <div class="card">
              <div
                class="card-img d-flex justify-content-center align-items-center"
              >
                <img src="{{asset('assets/img/vcard15/profile.png')}}" class="img-fluid" loading="lazy"/>
              </div>
              <div class="card-body px-0">
                <div class="profile-name">
                  <h2 class="font-cormorant">Ezra Miller</h2>
                  <p class="fs-18 text-white">Hair Dresser at Abc Salon</p>
                  <p class="text-primary-light mb-0">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it.
                  </p>
                </div>
              </div>
            </div>
            <div class="social-media d-flex">
              <a
                href=""
                class="social-icon d-flex justify-content-center align-items-center"
              >
                <svg
                  width="10"
                  height="20"
                  viewBox="0 0 10 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2.79059 11.2889C2.34698 11.2889 1.93968 11.2889 1.53237 11.2889C1.18499 11.2889 0.837601 11.2954 0.49082 11.2863C0.127698 11.2772 0.00907804 11.1596 0.00605203 10.7711C-0.00181561 9.753 -0.00242081 8.73429 0.00665723 7.71622C0.0102884 7.33094 0.137381 7.20882 0.495661 7.20621C1.16744 7.20164 1.83921 7.20491 2.51159 7.20491C2.5939 7.20491 2.67621 7.20491 2.79059 7.20491C2.79059 7.09455 2.78938 6.99986 2.79059 6.90582C2.80633 5.97788 2.77365 5.04601 2.84748 4.12329C3.03449 1.77307 4.69698 0.0947997 6.88297 0.0183961C7.77262 -0.012949 8.66469 0.0046826 9.55494 0.00729469C9.86844 0.00794771 9.99553 0.146388 9.99674 0.48596C10.001 1.43872 10.001 2.39213 9.99735 3.34489C9.99614 3.70993 9.87752 3.84249 9.52953 3.85098C8.91827 3.86666 8.30702 3.86666 7.69516 3.8771C7.00946 3.88821 6.72138 4.1775 6.70686 4.90823C6.69233 5.6468 6.70383 6.38667 6.70383 7.15397C6.80732 7.15397 6.88781 7.15397 6.96831 7.15397C7.74599 7.15397 8.52368 7.15266 9.30136 7.15462C9.79158 7.15528 9.90657 7.27805 9.90717 7.79785C9.90778 8.76694 9.90899 9.73667 9.90657 10.7058C9.90536 11.1394 9.79945 11.2563 9.39517 11.2582C8.51218 11.2621 7.62919 11.2595 6.70444 11.2595C6.70444 11.3731 6.70444 11.4744 6.70444 11.5749C6.70444 14.1243 6.70444 16.6744 6.70444 19.2238C6.70444 19.9264 6.63545 19.9996 5.97335 19.9996C5.10489 19.9996 4.23703 20.0009 3.36856 19.9989C2.90376 19.9983 2.79059 19.8775 2.79059 19.3812C2.78999 16.7906 2.78999 14.2001 2.78999 11.6102C2.79059 11.5142 2.79059 11.4182 2.79059 11.2889Z"
                    fill="url(#paint0_linear_317_40)"
                  />
                  <defs>
                    <linearGradient
                      id="paint0_linear_317_40"
                      x1="-3.72529e-08"
                      y1="10"
                      x2="10"
                      y2="10"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                  </defs>
                </svg>
              </a>
              <a
                href=""
                class="social-icon d-flex justify-content-center align-items-center"
              >
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M20 8.98051C20 9.37148 20 9.76195 20 10.1529C19.9686 10.4103 19.9431 10.6682 19.9054 10.9246C19.6001 12.9983 18.7208 14.7927 17.2485 16.287C15.6704 17.8891 13.7574 18.8335 11.5225 19.0923C9.56846 19.3189 7.70799 18.9763 5.95927 18.0657C5.8387 18.0031 5.73627 17.9786 5.59561 18.029C4.56049 18.3999 3.52047 18.7566 2.48291 19.1212C1.65462 19.4118 0.827799 19.7069 0 20C0.0171539 19.9183 0.0249957 19.8336 0.052442 19.7553C0.665082 18.0006 1.27674 16.245 1.89918 14.4937C1.97221 14.2887 1.96682 14.1296 1.86488 13.931C0.925331 12.1029 0.616071 10.1617 0.91749 8.13545C1.22038 6.0989 2.10013 4.32952 3.55772 2.87037C5.71961 0.706596 8.3471 -0.228495 11.3878 0.0469922C13.236 0.21434 14.8979 0.896452 16.3487 2.05859C18.238 3.57156 19.4197 5.51514 19.8481 7.90303C19.9118 8.25974 19.95 8.62135 20 8.98051ZM8.23192 7.89373C8.24417 7.8722 8.24613 7.86535 8.25054 7.86094C8.50295 7.6065 8.75683 7.35401 9.00728 7.09809C9.30134 6.79716 9.30134 6.47372 9.00434 6.17377C8.57794 5.74366 8.14958 5.31501 7.71828 4.8893C7.41441 4.58935 7.09437 4.58935 6.79148 4.88735C6.47585 5.19807 6.17198 5.52102 5.84851 5.82342C5.48239 6.16594 5.37359 6.58529 5.42309 7.06384C5.50592 7.85948 5.83429 8.56654 6.24011 9.2374C7.29532 10.9813 8.69508 12.3989 10.3943 13.5204C11.0814 13.974 11.8112 14.3459 12.6297 14.5113C13.259 14.6385 13.8138 14.548 14.2608 14.0313C14.5156 13.7367 14.8112 13.4769 15.0866 13.1994C15.4023 12.8809 15.4018 12.5658 15.0837 12.2453C14.6798 11.8386 14.273 11.4345 13.8672 11.0298C13.4947 10.6584 13.2007 10.6574 12.8302 11.0268C12.5871 11.2695 12.3449 11.5132 12.1048 11.754C10.3605 10.9001 9.07883 9.62005 8.23192 7.89373Z"
                    fill="url(#paint0_linear_317_51)"
                  />
                  <defs>
                    <linearGradient
                      id="paint0_linear_317_51"
                      x1="-7.45057e-08"
                      y1="10"
                      x2="20"
                      y2="10"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                  </defs>
                </svg>
              </a>

              <a
                href=""
                class="social-icon d-flex justify-content-center align-items-center"
              >
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M19.9863 12.1092C19.9798 11.181 19.8872 10.258 19.6173 9.36114C19.2797 8.2379 18.6675 7.33447 17.5757 6.81916C16.7321 6.42126 15.8326 6.30972 14.9134 6.33712C13.3046 6.38539 12.0028 7.00637 11.1326 8.4101C11.1228 8.42575 11.0967 8.43163 11.042 8.46294C11.042 7.84652 11.042 7.2575 11.042 6.66783C9.70369 6.66783 8.398 6.66783 7.09557 6.66783C7.09557 11.123 7.09557 15.5605 7.09557 20C8.47427 20 9.83081 20 11.2225 20C11.2225 19.878 11.2225 19.7815 11.2225 19.6843C11.2225 17.6009 11.2167 15.5168 11.2271 13.4334C11.2291 12.9709 11.2591 12.5052 11.3249 12.0479C11.5048 10.7942 12.1423 10.1165 13.3001 9.97951C14.5719 9.82949 15.4597 10.2933 15.7113 11.6585C15.8006 12.1438 15.8397 12.6441 15.843 13.1379C15.8573 15.3192 15.8508 17.5004 15.8515 19.6817C15.8515 19.7756 15.8515 19.8689 15.8515 19.9583C17.253 19.9583 18.6154 19.9583 19.9902 19.9583C19.9941 19.9035 20 19.8643 20 19.8245C19.9967 17.2532 20.0032 14.6812 19.9863 12.1092Z"
                    fill="url(#paint0_linear_157_777)"
                  />
                  <path
                    d="M0.343781 19.9909C1.72509 19.9909 3.09336 19.9909 4.4662 19.9909C4.4662 15.5416 4.4662 11.1106 4.4662 6.66456C3.09011 6.66456 1.7277 6.66456 0.343781 6.66456C0.343781 11.1191 0.343781 15.5507 0.343781 19.9909Z"
                    fill="url(#paint1_linear_157_777)"
                  />
                  <path
                    d="M2.38454 9.52735e-05C1.07363 0.0118365 -0.000651573 1.09464 2.96507e-07 2.40314C0.000652166 3.73381 1.09905 4.83488 2.41778 4.82705C3.72934 4.81922 4.80493 3.72011 4.7971 2.394C4.78993 1.06333 3.70653 -0.011646 2.38454 9.52735e-05Z"
                    fill="url(#paint2_linear_157_777)"
                  />
                  <defs>
                    <linearGradient
                      id="paint0_linear_157_777"
                      x1="-7.45056e-08"
                      y1="10"
                      x2="20"
                      y2="10"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                    <linearGradient
                      id="paint1_linear_157_777"
                      x1="-7.45056e-08"
                      y1="10"
                      x2="20"
                      y2="10"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                    <linearGradient
                      id="paint2_linear_157_777"
                      x1="-7.45056e-08"
                      y1="10"
                      x2="20"
                      y2="10"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                  </defs>
                </svg>
              </a>

              <a
                href=""
                class="social-icon d-flex justify-content-center align-items-center"
              >
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M19.9977 4.60899C19.9977 8.20239 19.9977 11.7952 19.9977 15.3886C19.9189 15.7622 19.8724 16.1468 19.7556 16.5081C19.0745 18.6096 17.1845 19.9884 14.9669 19.9945C11.6541 20.0037 8.34136 19.9994 5.02861 19.9957C3.96472 19.9945 2.98398 19.7004 2.12246 19.0706C0.699046 18.03 0.000788423 16.6145 0.000788423 14.853C0.000176989 11.6313 -0.00165731 8.40967 0.00384559 5.18802C0.00445703 4.85784 0.0197429 4.52156 0.079052 4.1975C0.414729 2.34974 1.46456 1.06084 3.19859 0.355243C3.6431 0.174259 4.13775 0.11495 4.60917 0C8.20256 0 11.7954 0 15.3887 0C15.5288 0.0250688 15.6694 0.0483033 15.8088 0.074595C17.6443 0.421278 18.9296 1.46072 19.6364 3.1819C19.8216 3.63131 19.881 4.13207 19.9977 4.60899ZM18.3194 9.99878C18.3218 9.99878 18.3242 9.99878 18.3267 9.99878C18.3267 8.37176 18.3236 6.74473 18.3285 5.11709C18.3297 4.59554 18.26 4.08927 18.0271 3.6203C17.3961 2.34913 16.367 1.67716 14.9442 1.67227C11.6443 1.66066 8.34442 1.66799 5.04451 1.67044C4.85007 1.67044 4.65441 1.68878 4.46242 1.7163C2.9479 1.92969 1.69385 3.2993 1.68407 4.83278C1.66144 8.23663 1.67489 11.6405 1.67306 15.0443C1.67306 15.5066 1.76355 15.9529 1.96716 16.3663C2.60672 17.6619 3.65533 18.3235 5.10259 18.3253C8.36337 18.3302 11.6242 18.3277 14.8849 18.3247C15.105 18.3247 15.327 18.3076 15.5453 18.2776C17.0305 18.074 18.2937 16.6891 18.3139 15.1917C18.3377 13.4613 18.3194 11.7304 18.3194 9.99878Z"
                    fill="url(#paint0_linear_317_116)"
                  />
                  <path
                    d="M14.9974 10.0232C14.9711 12.7918 12.7033 15.0327 9.9641 14.9966C7.19858 14.9606 4.97418 12.7099 5.00047 9.9731C5.02677 7.20331 7.29274 4.96485 10.0332 4.9997C12.7993 5.03577 15.0237 7.28646 14.9974 10.0232ZM10.002 6.67014C8.16281 6.66708 6.67825 8.14675 6.67091 9.99084C6.66296 11.8276 8.14141 13.3152 9.98672 13.3274C11.829 13.339 13.3294 11.8435 13.3276 9.99695C13.3258 8.15531 11.8436 6.67319 10.002 6.67014Z"
                    fill="url(#paint1_linear_317_116)"
                  />
                  <path
                    d="M15.4248 5.82573C14.729 5.83063 14.1714 5.27728 14.1714 4.58208C14.172 3.89788 14.7192 3.34453 15.4059 3.33353C16.084 3.32252 16.666 3.89972 16.6654 4.58269C16.6654 5.26321 16.1084 5.82084 15.4248 5.82573Z"
                    fill="url(#paint2_linear_317_116)"
                  />
                  <defs>
                    <linearGradient
                      id="paint0_linear_317_116"
                      x1="-7.44973e-08"
                      y1="10"
                      x2="19.9977"
                      y2="10"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                    <linearGradient
                      id="paint1_linear_317_116"
                      x1="5.00024"
                      y1="9.99819"
                      x2="14.9977"
                      y2="9.99819"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                    <linearGradient
                      id="paint2_linear_317_116"
                      x1="14.1714"
                      y1="4.57957"
                      x2="16.6654"
                      y2="4.57957"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                  </defs>
                </svg>
              </a>
              <a
                href=""
                class="social-icon d-flex justify-content-center align-items-center"
              >
                <svg
                  width="19"
                  height="17"
                  viewBox="0 0 19 17"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M5.61598 12.8971C3.83258 12.6534 2.64937 11.769 1.9806 10C2.55506 10 3.06092 10 3.55821 10C1.7491 9.2509 0.728792 7.94224 0.600182 5.86643C1.14892 6.02888 1.65478 6.18231 2.16065 6.32672C2.18637 6.29061 2.2121 6.25451 2.23782 6.21841C1.4833 5.57762 0.943142 4.78339 0.754514 3.77256C0.565886 2.76173 0.651626 1.78701 1.17464 0.7852C3.33529 3.37545 5.97608 4.88267 9.22563 5.09928C9.22563 4.72022 9.21706 4.39531 9.22563 4.0704C9.27708 2.34657 10.083 1.09206 11.5492 0.397114C12.981 -0.279781 14.3872 -0.099276 15.6218 0.965706C15.9648 1.26354 16.2735 1.32672 16.6593 1.16426C17.2509 0.920579 17.8425 0.676897 18.4856 0.42419C18.2112 1.32672 17.6453 1.94044 17.0537 2.6083C17.671 2.43682 18.2884 2.25632 18.9057 2.08484C18.9314 2.11192 18.9657 2.13899 18.9914 2.16607C18.5027 2.69856 18.0397 3.27617 17.5081 3.75451C17.2166 4.01625 17.1051 4.27798 17.0966 4.66607C17.0451 7.38267 16.2735 9.84657 14.6787 11.9946C12.5352 14.8917 9.68863 16.3538 6.18186 16.426C4.17554 16.4711 2.29784 16.0289 0.53159 15.0271C0.36011 14.9278 0.18863 14.8195 0.00857544 14.6661C2.04062 14.7653 3.8926 14.2599 5.61598 12.8971Z"
                    fill="url(#paint0_linear_317_155)"
                  />
                  <defs>
                    <linearGradient
                      id="paint0_linear_317_155"
                      x1="0.00857537"
                      y1="8.21355"
                      x2="18.9914"
                      y2="8.21355"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#D68328" />
                      <stop offset="0.489583" stop-color="#FFC994" />
                      <stop offset="1" stop-color="#D68328" />
                    </linearGradient>
                  </defs>
                </svg>
              </a>
            </div>
          </div>
        </div>
        <div class="contact-section bg-primary position-relative">
          <div class="section-heading text-center">
            <h2 class="font-cormorant text-white mb-0 d-inline-block">
              Contact
            </h2>
          </div>
          <div class="px-30 pt-3 mt-3">
            <div class="row">
              <div class="col-sm-6 mb-40">
                <div class="contact-box d-flex align-items-center">
                  <div
                    class="contact-icon d-flex justify-content-center align-items-center"
                  >
                    <svg
                      width="27"
                      height="22"
                      viewBox="0 0 27 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M14.0249 0.999531C17.3357 0.999531 20.6398 0.992862 23.9506 1.0062C24.3836 1.0062 24.8233 1.05288 25.243 1.14625C25.9957 1.31964 26.5153 1.7998 26.8417 2.49336C27.1282 3.10023 27.0349 3.43368 26.4753 3.78713C25.7492 4.24728 25.0165 4.70076 24.2904 5.16092C21.1195 7.18159 17.9486 9.18892 14.791 11.2229C14.2181 11.5964 13.7651 11.5831 13.1922 11.2163C9.34852 8.74211 5.48483 6.3013 1.6278 3.84715C1.54786 3.7938 1.46126 3.74711 1.38798 3.69376C1.00827 3.43368 0.934997 3.22694 1.06823 2.79346C1.39464 1.72644 2.20735 1.10623 3.39977 1.03954C3.8794 1.01287 4.35903 1.01287 4.832 1.0062C7.89631 1.0062 10.9606 1.0062 14.0249 0.999531Z"
                        fill="url(#paint0_linear_159_258)"
                      />
                      <path
                        d="M13.9701 21C10.606 21 7.24862 21.0067 3.88454 20.9934C3.46486 20.9934 3.03186 20.9467 2.6255 20.8333C1.80614 20.5999 1.29986 20.0197 1.05338 19.2128C0.926811 18.7926 1.00009 18.5859 1.3798 18.3458C4.48408 16.3918 7.58835 14.4378 10.6926 12.4838C11.019 12.2771 11.3654 12.2771 11.6919 12.4705C12.2781 12.8173 12.851 13.1774 13.4239 13.5442C13.8968 13.851 14.0967 13.8576 14.5563 13.5575C15.1625 13.1641 15.7754 12.7839 16.3816 12.3905C16.708 12.1771 17.0011 12.2438 17.3009 12.4372C18.2935 13.0774 19.286 13.7109 20.2853 14.3445C22.3237 15.6382 24.3688 16.9187 26.4072 18.2124C27.0334 18.6059 27.1333 18.9327 26.8269 19.5929C26.4072 20.4865 25.6478 20.8666 24.7218 20.98C24.4887 21.0067 24.2555 21.0067 24.0224 21.0067C20.6716 21 17.3209 21 13.9701 21Z"
                        fill="url(#paint1_linear_159_258)"
                      />
                      <path
                        d="M1.04706 16.3651C1.04706 12.7773 1.04706 9.24944 1.04706 5.66158C3.85823 7.45551 6.62943 9.2161 9.44727 11.01C6.63609 12.804 3.86489 14.5712 1.04706 16.3651Z"
                        fill="url(#paint2_linear_159_258)"
                      />
                      <path
                        d="M18.5732 11.01C21.3778 9.22277 24.149 7.45551 26.9601 5.66158C26.9601 9.2361 26.9601 12.7573 26.9601 16.3518C24.1556 14.5712 21.3844 12.804 18.5732 11.01Z"
                        fill="url(#paint3_linear_159_258)"
                      />
                      <defs>
                        <linearGradient
                          id="paint0_linear_159_258"
                          x1="0.996277"
                          y1="11.0023"
                          x2="26.9994"
                          y2="11.0023"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint1_linear_159_258"
                          x1="0.996277"
                          y1="11.0023"
                          x2="26.9994"
                          y2="11.0023"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint2_linear_159_258"
                          x1="0.996277"
                          y1="11.0023"
                          x2="26.9994"
                          y2="11.0023"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint3_linear_159_258"
                          x1="0.996277"
                          y1="11.0023"
                          x2="26.9994"
                          y2="11.0023"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <p class="text-primary-light mb-0 fs-14">E-mail address</p>
                    <a href="mailto:jackie@gmail.com" class="text-white"
                      >jackie@gmail.com</a
                    >
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mb-40">
                <div class="contact-box d-flex align-items-center">
                  <div
                    class="contact-icon d-flex justify-content-center align-items-center"
                  >
                    <svg
                      width="26"
                      height="26"
                      viewBox="0 0 26 26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M5.24875 11.2533C7.38447 15.3496 10.4178 18.4566 14.4261 20.5898C14.5964 20.6825 14.9988 20.5743 15.169 20.4197C16.0821 19.5541 16.9797 18.673 17.8464 17.761C18.3261 17.2509 18.8523 17.1736 19.5178 17.2973C21.0964 17.5755 22.6904 17.8537 24.2845 18.0392C25.5535 18.1938 26.0023 18.6112 26.0023 19.9096C26.0023 21.3008 26.0023 22.6766 26.0023 24.0678C26.0023 25.5672 25.5226 26.0309 23.9904 26C13.0952 25.8145 3.34518 18.0856 0.776133 7.48157C0.327324 5.61118 0.188038 3.64804 0.0177999 1.71581C-0.0905334 0.571938 0.54399 0.0154578 1.68923 0.0154578C3.2059 0 4.72256 0 6.23923 0C7.35351 0 7.8178 0.510107 7.95709 1.62307C8.17375 3.26159 8.4678 4.90012 8.77732 6.52319C8.90113 7.21879 8.77732 7.77527 8.26661 8.26992C7.24518 9.25922 6.2547 10.2485 5.24875 11.2533Z"
                        fill="url(#paint0_linear_159_244)"
                      />
                      <defs>
                        <linearGradient
                          id="paint0_linear_159_244"
                          x1="0.00585928"
                          y1="13.0007"
                          x2="26.0023"
                          y2="13.0007"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <p class="text-primary-light mb-0 fs-14">Mobile Number</p>
                    <a href="tel:+1 4078461474" class="text-white"
                      >+1 4078461474</a
                    >
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mb-40">
                <div class="contact-box d-flex align-items-center">
                  <div
                    class="contact-icon d-flex justify-content-center align-items-center"
                  >
                    <svg
                      width="30"
                      height="26"
                      viewBox="0 0 30 26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_159_232)">
                        <path
                          d="M0.390592 26C0.264594 25.7615 0.0629984 25.5355 0.0251991 25.2844C-0.0377996 24.8324 0.0251991 24.3679 -3.51807e-07 23.916C-0.0126001 23.5017 0.163796 23.2883 0.592188 23.3008C0.718185 23.3008 0.844183 23.3008 0.97018 23.3008C10.3318 23.3008 19.6808 23.3008 29.0424 23.3134C29.3574 23.3134 29.6724 23.4389 29.9874 23.5017C29.9874 24.3303 29.9874 25.1714 29.9874 26C20.1344 26 10.2562 26 0.390592 26Z"
                          fill="url(#paint0_linear_159_232)"
                        />
                        <path
                          d="M15.0315 10.6461C18.3957 10.6461 21.7598 10.6461 25.1365 10.6461C27.0391 10.6461 27.9715 11.5877 27.9841 13.4959C27.9841 13.521 27.9841 13.5336 27.9841 13.5587C28.2109 14.6635 27.6943 15.2912 26.7115 15.718C25.7161 16.1449 24.7585 16.2328 23.8892 15.492C23.4608 15.128 23.108 14.6886 22.7552 14.2492C22.289 13.6842 21.848 13.6717 21.3692 14.2241C21.0542 14.5881 20.7392 14.9522 20.3864 15.2661C19.391 16.1574 18.2949 16.2579 17.1735 15.5423C16.6695 15.2159 16.2159 14.8016 15.7749 14.3873C15.1701 13.8223 14.9055 13.8223 14.3133 14.4124C13.9731 14.7513 13.6204 15.0778 13.2298 15.354C11.9068 16.3081 10.7098 16.2453 9.47504 15.1907C9.28604 15.0275 9.10965 14.8518 8.94585 14.6635C8.10167 13.6968 7.92527 13.6968 7.08109 14.7011C5.93451 16.057 4.48554 16.3583 2.87277 15.6301C2.24278 15.3414 2.00339 14.902 2.06639 14.2492C2.10419 13.9353 2.14199 13.6215 2.10419 13.3201C1.88999 11.776 3.13737 10.621 4.75013 10.6335C8.16467 10.6712 11.5918 10.6461 15.0315 10.6461Z"
                          fill="url(#paint1_linear_159_232)"
                        />
                        <path
                          d="M27.7322 21.606C19.2526 21.606 10.8107 21.606 2.33112 21.606C2.33112 20.2878 2.33112 18.9696 2.33112 17.6012C4.43527 18.3042 6.27484 17.8522 7.78681 16.2327C10.3068 18.6432 12.6251 18.3168 15.0569 16.1574C18.0682 18.7687 20.2354 18.1661 22.2891 16.1198C22.9821 16.8605 23.7381 17.5384 24.7713 17.802C25.7918 18.0657 26.7494 17.8522 27.7574 17.4254C27.7322 18.8315 27.7322 20.1874 27.7322 21.606Z"
                          fill="url(#paint2_linear_159_232)"
                        />
                        <path
                          d="M13.2297 9.46596C13.2297 8.22308 13.2171 7.00531 13.2423 5.77499C13.2549 5.37325 13.5447 5.13472 13.9605 5.13472C14.6535 5.12217 15.3465 5.12217 16.0269 5.13472C16.5056 5.13472 16.7828 5.41092 16.7828 5.87542C16.808 7.05553 16.7954 8.24819 16.7954 9.46596C15.5985 9.46596 14.4393 9.46596 13.2297 9.46596Z"
                          fill="url(#paint3_linear_159_232)"
                        />
                        <path
                          d="M15.0189 0C15.3213 0.55239 15.6741 1.18011 16.0143 1.82038C16.1655 2.10913 16.3671 2.39788 16.4553 2.71173C16.6443 3.40222 16.3419 4.15548 15.8001 4.45678C15.2583 4.75809 14.4267 4.67021 13.9857 4.26847C13.5196 3.82907 13.3684 2.98793 13.6959 2.37277C14.1243 1.54418 14.5905 0.740705 15.0189 0Z"
                          fill="url(#paint4_linear_159_232)"
                        />
                      </g>
                      <defs>
                        <linearGradient
                          id="paint0_linear_159_232"
                          x1="-0.00384533"
                          y1="24.6501"
                          x2="29.9874"
                          y2="24.6501"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint1_linear_159_232"
                          x1="2.05664"
                          y1="13.3389"
                          x2="28.037"
                          y2="13.3389"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint2_linear_159_232"
                          x1="2.33112"
                          y1="18.8629"
                          x2="27.7574"
                          y2="18.8629"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint3_linear_159_232"
                          x1="13.2266"
                          y1="7.29563"
                          x2="16.7986"
                          y2="7.29563"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint4_linear_159_232"
                          x1="13.5206"
                          y1="2.31819"
                          x2="16.5118"
                          y2="2.31819"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <clipPath id="clip0_159_232">
                          <rect width="30" height="26" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <p class="text-primary-light mb-0 fs-14">Date of Birth</p>
                    <p class="mb-0 text-white">12th June, 1990</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mb-40">
                <div class="contact-box d-flex align-items-center">
                  <div
                    class="contact-icon d-flex justify-content-center align-items-center"
                  >
                    <svg
                      width="20"
                      height="26"
                      viewBox="0 0 20 26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_159_224)">
                        <path
                          d="M9.99342 21.3252C9.65855 20.9328 9.33682 20.5606 9.02165 20.185C7.32106 18.1393 5.71239 16.0232 4.3204 13.7462C3.69335 12.7233 3.14509 11.6603 2.67562 10.5502C1.81219 8.50122 1.95993 6.48574 2.912 4.53398C4.14312 2.01212 6.16216 0.509733 8.89361 0.0905402C13.0958 -0.55334 17.088 2.45814 17.7741 6.71378C17.9974 8.10886 17.784 9.41674 17.2488 10.6978C16.6513 12.1264 15.8798 13.4544 15.0394 14.7388C13.5391 17.0259 11.8614 19.1688 10.0755 21.2279C10.0558 21.2514 10.0328 21.2782 9.99342 21.3252ZM13.9429 7.37108C13.9461 5.15103 12.1733 3.34347 9.9967 3.34347C7.81679 3.34347 6.04726 5.14768 6.04726 7.36772C6.04726 9.58777 7.81679 11.3953 9.99342 11.3953C12.17 11.3953 13.9396 9.59447 13.9429 7.37108Z"
                          fill="url(#paint0_linear_159_224)"
                        />
                        <path
                          d="M6.92352 18.592C6.54269 18.649 6.16515 18.7027 5.79088 18.7698C4.66153 18.9676 3.55517 19.246 2.51117 19.7457C2.10408 19.9435 1.71669 20.1716 1.39824 20.5036C0.886091 21.0401 0.886091 21.5901 1.41137 22.1166C1.85786 22.566 2.41268 22.8276 2.98721 23.0556C4.10014 23.4916 5.26232 23.7297 6.44092 23.8906C8.066 24.1153 9.70093 24.169 11.3391 24.0885C13.1743 23.9979 14.9898 23.7632 16.7397 23.1529C17.2584 22.9718 17.764 22.7571 18.2105 22.4218C18.4107 22.2709 18.6044 22.0965 18.7587 21.8986C19.0575 21.5163 19.0673 21.0904 18.7587 20.7182C18.5486 20.4633 18.2892 20.2319 18.0135 20.0508C17.242 19.5444 16.3753 19.256 15.4888 19.0481C14.7535 18.8771 14.0082 18.7664 13.2663 18.6289C13.2006 18.6155 13.1382 18.6054 13.0726 18.5954C13.194 18.3338 13.217 18.3271 13.4829 18.3472C14.5795 18.4344 15.6727 18.5551 16.7462 18.8C17.3306 18.9307 17.9084 19.0884 18.437 19.3734C18.7686 19.5511 19.0969 19.7591 19.3693 20.0139C20.0686 20.6712 20.1934 21.5834 19.7469 22.4419C19.5072 22.9047 19.156 23.2702 18.7554 23.5888C17.8822 24.283 16.8874 24.7424 15.8434 25.0945C13.6471 25.8357 11.3851 26.0805 9.08045 25.9799C7.31091 25.8994 5.58077 25.6076 3.90645 24.9973C2.87559 24.6217 1.89397 24.1522 1.05352 23.4144C0.685829 23.0925 0.373944 22.7169 0.176964 22.2575C-0.154618 21.4828 -0.00360029 20.6645 0.57749 20.0642C1.06337 19.5612 1.67729 19.2829 2.31748 19.0649C3.19404 18.7664 4.10014 18.6122 5.01281 18.4981C5.5184 18.4344 6.02398 18.3975 6.53284 18.3439C6.77907 18.3204 6.79876 18.3338 6.92352 18.592Z"
                          fill="url(#paint1_linear_159_224)"
                        />
                      </g>
                      <defs>
                        <linearGradient
                          id="paint0_linear_159_224"
                          x1="2.10541"
                          y1="10.6645"
                          x2="17.8617"
                          y2="10.6645"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <linearGradient
                          id="paint1_linear_159_224"
                          x1="0.00390618"
                          y1="22.1687"
                          x2="20.0084"
                          y2="22.1687"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#D68328" />
                          <stop offset="0.489583" stop-color="#FFC994" />
                          <stop offset="1" stop-color="#D68328" />
                        </linearGradient>
                        <clipPath id="clip0_159_224">
                          <rect width="20" height="26" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <p class="text-primary-light mb-0 fs-14">Address</p>
                    <p class="text-white mb-0">New York, USA</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <svg
            class="curve-shape"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px"
            y="0px"
            viewBox="0 0 4000 275"
          >
            <path
              style="fill: #f1f1f1"
              d="M4000,125.3V275H0V109.9C1907.2,585.4,2670.5-323.1,4000,125.3z"
            ></path>
          </svg>
        </div>
        <div class="our-services-section bg-gray px-30 pt-3 pb-60">
          <h2 class="font-cormorant text-primary text-center mb-0">
            Our Services
          </h2>
          <div class="services pt-3 mt-3">
            <div class="row">
              <div class="col-sm-6 mb-sm-0 mb-40">
                <div class="service-card card h-100">
                  <div class="card-img mb-4 mx-auto">
                    <img
                      src="{{asset('assets/img/vcard15/hair-spa.png')}}"
                      alt="Hair Spa"
                      class="img-fluid"
                      loading="lazy"
                    />
                  </div>
                  <div class="card-body p-0 text-center">
                    <h3 class="card-title fs-18 text-primary">Hair Spa</h3>
                    <p class="mb-0 fs-14 text-primary-light">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum is dummy.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="service-card card h-100">
                  <div class="card-img mb-4 mx-auto">
                    <img
                      src="{{asset('assets/img/vcard15/hair-cut.png')}}"
                      alt="Hair Cut"
                      class="img-fluid"
                      loading="lazy"
                    />
                  </div>
                  <div class="card-body p-0 text-center">
                    <h3 class="card-title fs-18 text-primary">Hair Cut</h3>
                    <p class="mb-0 fs-14 text-primary-light">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum is dummy.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="appointment-section bg-primary pt-50 pb-60">
          <div class="section-heading text-center">
            <h2 class="font-cormorant text-white mb-0 d-inline-block">
              Make an Appointment
            </h2>
          </div>
          <div class="appointment px-30 mt-3 pt-3">
            <div class="row justify-content-center">
              <div class="col-sm-10">
                <form action="">
                  <div class="row">
                    <div class="col-12 mb-20">
                      <input
                        type="text"
                        class="form-control appointment-input"
                        placeholder="Pick a Date"
                      />
                    </div>
                    <div class="col-sm-6 mb-20 mt-10">
                      <div
                        class="hour-input bg-gray-300 d-flex justify-content-center align-items-center"
                      >
                        <span class="text-white">8:10 - 20:00</span>
                      </div>
                    </div>
                    <div class="col-sm-6 mb-20 mt-10">
                      <div
                        class="hour-input bg-gray-300 d-flex justify-content-center align-items-center"
                      >
                        <span class="text-white">8:10 - 20:00</span>
                      </div>
                    </div>
                    <div class="col-sm-6 mb-20 mt-10">
                      <div
                        class="hour-input bg-gray-300 d-flex justify-content-center align-items-center"
                      >
                        <span class="text-white">8:10 - 20:00</span>
                      </div>
                    </div>
                    <div class="col-sm-6 mb-20 mt-10">
                      <div
                        class="hour-input bg-gray-300 d-flex justify-content-center align-items-center"
                      >
                        <span class="text-white">8:10 - 20:00</span>
                      </div>
                    </div>
                    <div class="col-12 text-center pt-2 mt-10">
                      <button class=" rounded-2 w-50 btn-gradient" type="button">
                        Make an Appointment
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="gallery-section pt-50 pb-40 px-30">
          <h2 class="font-cormorant text-primary text-center mb-2">Gallery</h2>
          <div class="gallery-slider">
            <div class="slide">
              <div class="gallery-img">
                <img src="{{asset('assets/img/vcard15/gallery-img1.png')}}" loading="lazy"/>
              </div>
            </div>

            <div class="slide">
              <div class="gallery-img">
                <img src="{{asset('assets/img/vcard15/gallery-img2.png')}}" loading="lazy"/>
              </div>
            </div>

            <div class="slide">
              <div class="gallery-img">
                <img src="{{asset('assets/img/vcard15/gallery-img3.png')}}" loading="lazy"/>
              </div>
            </div>
          </div>
        </div>
        <div class="product-section bg-gray pt-50 pb-30 px-30">
          <h2 class="font-cormorant text-primary text-center mb-2">Products</h2>
          <div class="product-slider">
            <div class="">
              <div class="product-card card">
                <div class="product-img card-img">
                  <img
                    src="{{asset('assets/img/vcard15/product-img1.png')}}"
                    class="img-fluid h-100"
                    loading="lazy"
                  />
                </div>
                <div class="product-desc card-body">
                  <div class="d-flex justify-content-between">
                    <div class="product-title">
                      <h3 class="text-primary fs-6 fw-7">Hair Dryer</h3>
                    </div>
                    <div class="product-amount">$25</div>
                  </div>
                  <p class="fs-14 text-primary-light mb-0">
                    Lorem is dummy text
                  </p>
                </div>
              </div>
            </div>
            <div class="">
              <div class="product-card card">
                <div class="product-img card-img">
                  <img
                    src="{{asset('assets/img/vcard15/product-img2.png')}}"
                    class="img-fluid h-100"
                    loading="lazy"
                  />
                </div>
                <div class="product-desc card-body">
                  <div class="d-flex justify-content-between">
                    <div class="product-title">
                      <h3 class="text-primary fs-6 fw-7">Hair Styling Set</h3>
                    </div>
                    <div class="product-amount">$155</div>
                  </div>
                  <p class="fs-14 text-primary-light mb-0">
                    Lorem is dummy text
                  </p>
                </div>
              </div>
            </div>
            <div class="">
              <div class="product-card card">
                <div class="product-img card-img">
                  <img
                    src="{{asset('assets/img/vcard15/product-img1.png')}}"
                    class="img-fluid h-100"
                    loading="lazy"
                  />
                </div>
                <div class="product-desc card-body">
                  <div class="d-flex justify-content-between">
                    <div class="product-title">
                      <h3 class="text-primary fs-6 fw-7">Hair Styling Set</h3>
                    </div>
                    <div class="product-amount">$155</div>
                  </div>
                  <p class="fs-14 text-primary-light mb-0">
                    Lorem is dummy text
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-section pt-50">
          <div class="section-heading text-center mb-40">
            <h2 class="font-cormorant text-white mb-0 d-inline-block">
              Testimonial
            </h2>
          </div>
          <div class="px-30">
            <div class="testimonial-slider">
              <div class="">
                <div
                  class="testimonial-card d-flex flex-sm-row flex-column align-items-center"
                >
                  <div class="card-img">
                    <img
                      src="{{asset('assets/img/vcard15/testimonial-card.png')}}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="card-body p-0">
                    <div class="quote-img">
                      <img src="{{asset('assets/img/vcard15/quote-img.png')}}" class="h-100" loading="lazy"/>
                    </div>
                    <div class="text-sm-start text-center">
                      <p class="text-white fs-14">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text.
                      </p>
                      <h6 class="name mb-0">Shane Watson</h6>
                      <span class="fs-14 text-primary-light">- Customer</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="">
                <div
                  class="testimonial-card d-flex flex-sm-row flex-column align-items-center"
                >
                  <div class="card-img">
                    <img
                      src="{{asset('assets/img/vcard15/testimonial-card.png')}}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="card-body p-0">
                    <div class="quote-img">
                      <img src="{{asset('assets/img/vcard15/quote-img.png')}}" class="h-100" loading="lazy"/>
                    </div>
                    <div class="text-sm-start text-center">
                      <p class="text-white fs-14">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text.
                      </p>
                      <h6 class="name mb-0">Shane Watson</h6>
                      <span class="fs-14 text-primary-light">- Customer</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="blog-section pt-50 pb-30 px-30">
          <h2 class="font-cormorant text-primary text-center mb-0">Blog</h2>
          <div class="blog-slider">
            <div class="">
              <div class="blog-card card">
                <div class="card-img">
                  <img src="{{asset('assets/img/vcard15/blog-img1.png')}}" class="h-100" loading="lazy"/>
                </div>
                <div class="card-body">
                  <h6 class="card-title text-primary fw-7">Hair Treatments</h6>
                  <p class="mb-0 fs-14 text-primary-light">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the dummy text.
                  </p>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img">
                  <img src="{{asset('assets/img/vcard15/blog-img2.png')}}" class="h-100" loading="lazy"/>
                </div>
                <div class="card-body">
                  <h6 class="card-title text-primary fw-7">Hair Growth</h6>
                  <p class="mb-0 fs-14 text-primary-light">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the dummy text.
                  </p>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img">
                  <img src="{{asset('assets/img/vcard15/blog-img1.png')}}" class="h-100" loading="lazy"/>
                </div>
                <div class="card-body">
                  <h6 class="card-title text-primary fw-7">Hair Treatments</h6>
                  <p class="mb-0 fs-14 text-primary-light">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the dummy text.
                  </p>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img">
                  <img src="{{asset('assets/img/vcard15/blog-img2.png')}}" class="h-100" loading="lazy"/>
                </div>
                <div class="card-body">
                  <h6 class="card-title text-primary fw-7">Hair Growth</h6>
                  <p class="mb-0 fs-14 text-primary-light">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the dummy text.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bussiness-hour-section pt-50 pb-60 px-30">
          <h2 class="font-cormorant text-primary text-center mb-0 pb-30">
            Business Hours
          </h2>
          <div class="bussiness-hour-card">
            <div class="mb-10 d-flex align-items-center justify-content-center">
              <span class="me-2">Sunday:</span>
              <span>08:10 - 20:00</span>
            </div>
            <div class="mb-10 d-flex align-items-center justify-content-center">
              <span class="me-2">Monday:</span>
              <span>08:10 - 20:00</span>
            </div>
            <div class="mb-10 d-flex align-items-center justify-content-center">
              <span class="me-2">Tueday:</span>
              <span>08:10 - 20:00</span>
            </div>
            <div class="mb-10 d-flex align-items-center justify-content-center">
              <span class="me-2">Wednesday:</span>
              <span>08:10 - 20:00</span>
            </div>
            <div class="mb-10 d-flex align-items-center justify-content-center">
              <span class="me-2">Thursday:</span>
              <span>08:10 - 20:00</span>
            </div>
            <div class="mb-10 d-flex align-items-center justify-content-center">
              <span class="me-2">Friday:</span>
              <span>08:10 - 20:00</span>
            </div>
            <div class="d-flex align-items-center justify-content-center">
              <span class="me-2">Saturday:</span>
              <span>Closed</span>
            </div>
          </div>
        </div>
        <div class="qr-code-section pt-50 pb-60">
          <div class="section-heading text-center">
            <h2 class="font-cormorant text-white mb-0 d-inline-block">
              QR Code
            </h2>
          </div>
          <div class="px-30">
            <div
              class="qr-code d-flex justify-content-center align-items-center"
            >
              <div class="qr-code-img">
                <img src="{{asset('assets/img/vcard15/qr-code.png')}}" loading="lazy"/>
              </div>
            </div>
          </div>
        </div>
        <div class="contact-us-section pt-50 pb-60 px-30">
          <h2 class="font-cormorant text-primary text-center mb-0 pb-30">
            Inquiries
          </h2>
          <div class="contact-form">
            <form action="">
              <div class="row">
                <div class="col-sm-6 pe-sm-1">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Your Name"
                  />
                </div>
                <div class="col-sm-6 ps-sm-1">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email Address"
                  />
                </div>
                <div class="col-12">
                  <input
                    type="tel"
                    class="form-control"
                    placeholder="Enter Phone Number"
                  />
                </div>
                <div class="col-12">
                  <textarea
                    class="form-control h-100"
                    placeholder="Type a message here..."
                    rows="3"
                  ></textarea>
                </div>
                <div class="col-12 text-center mt-4">
                  <button class="rounded-2 w-50 btn-gradient" type="submit">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="create-vcard-section pt-50 pb-60 px-30">
          <h2 class="font-cormorant text-primary text-center mb-0 pb-30">
            Create Your VCard
          </h2>
          <div class="vcard-link-card card">
            <div class="d-flex justify-content-center align-items-center">
              <a
                href="https://vcards.infyom.com/marlonbrasil"
                class="fw-6 text-primary link-text"
                >https://vcards.infyom.com/marlonbrasil</a
              >
              <i class="icon fa-solid fa-arrow-up-right-from-square ms-3"></i>
            </div>
          </div>
        </div>
        <div class="add-to-conact-section pt-40 pb-40 px-30 bg-primary">
          <div class="text-center">
            <button class="rounded-2 w-50 btn-gradient">Add to Contact</button>
          </div>
        </div>
        <div class="btn-section cursor-pointer">
          <div class="fixed-btn-section">
            {{-- <div class="bars-btn salon-bars-btn">
              <svg
                width="25"
                height="25"
                viewBox="0 0 25 25"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M15.4134 0.540771H22.489C23.572 0.540771 24.4601 1.42891 24.4601 2.51188V9.5875C24.4601 10.6776 23.5731 11.5586 22.489 11.5586H15.4134C14.3222 11.5586 13.4423 10.6787 13.4423 9.5875V2.51188C13.4423 1.42783 14.3233 0.540771 15.4134 0.540771Z"
                  stroke="#043636"
                />
                <path
                  d="M2.97143 0.500122H8.74589C10.1129 0.500122 11.2173 1.61232 11.2173 2.97155V8.74602C11.2173 10.1141 10.1139 11.2174 8.74589 11.2174H2.97143C1.6122 11.2174 0.5 10.113 0.5 8.74602V2.97155C0.5 1.61341 1.61328 0.500122 2.97143 0.500122Z"
                  stroke="#043636"
                />
                <path
                  d="M2.97143 13.783H8.74589C10.1139 13.783 11.2173 14.8863 11.2173 16.2544V22.0289C11.2173 23.3881 10.1129 24.5003 8.74589 24.5003H2.97143C1.61328 24.5003 0.5 23.387 0.5 22.0289V16.2544C0.5 14.8874 1.6122 13.783 2.97143 13.783Z"
                  stroke="#043636"
                />
                <path
                  d="M16.2537 13.783H22.0282C23.3874 13.783 24.4996 14.8874 24.4996 16.2544V22.0289C24.4996 23.387 23.3863 24.5003 22.0282 24.5003H16.2537C14.8867 24.5003 13.7823 23.3881 13.7823 22.0289V16.2544C13.7823 14.8863 14.8857 13.783 16.2537 13.783Z"
                  stroke="#043636"
                />
              </svg>
            </div>
            <div class="sub-btn">
              <div class="social-btn salon-sub-btn wp-btn">
                <i class="fa-brands fa-whatsapp"></i>
              </div>
              <div class="social-btn salon-sub-btn wp-btn mt-3">
                <i class="fa-solid fa-share-nodes"></i>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
  <script>
    $().ready(function () {
      $(".gallery-slider").slick({
        arrows: true,
        infinite: true,
        dots: false,
        slidesToShow: 1,
        autoplay: true,
        responsive: [
          {
            breakpoint: 575,
            settings: {
              arrows: false,
              dots: true,
            },
          },
        ],
      });
      $(".product-slider").slick({
        arrows: false,
        infinite: true,
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        responsive: [
          {
            breakpoint: 575,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
      $(".testimonial-slider").slick({
        arrows: false,
        infinite: true,
        dots: false,
        slidesToShow: 1,
        autoplay: true,
      });
      $(".blog-slider").slick({
        arrows: false,
        infinite: true,
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        responsive: [
          {
            breakpoint: 575,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    });
  </script>
  <script>
    $("#myID").flatpickr();
</script>

<script>
    $(document).ready(function () {
        $('.dropdown1').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
        });
    });
</script>
</html>
