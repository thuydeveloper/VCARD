<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Social Media Influencers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard21.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
    <style>
    .bg-img{
        background-image: url("/assets/img/vcard21/bg-img.png");
        }
    </style>
</head>

<body>
    <div class="container p-0">
        <div class="main-content mx-auto w-100 overflow-hidden bg-img">
            <div class="banner-section">
                <div class="heart-img">
                    <img src="{{ asset('assets/img/vcard21/heart-img.png') }}" loading="lazy"/>
                </div>
                <div class="cherry-blossom-img">
                    <img src="{{ asset('assets/img/vcard21/cherry-blossom.png') }}" loading="lazy"/>
                </div>
                <div class="banner-img">
                    <img src="{{ asset('assets/img/vcard21/banner-img.png') }}" class="object-fit-cover w-100 h-100" loading="lazy"/>

                </div>
                <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
                    <div class="language pt-3 me-2">
                        <ul class="text-decoration-none">
                            <li class="dropdown1 dropdown lang-list">
                                <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-language me-2"></i>Language</a>
                                <ul class="dropdown-menu start-0 lang-hover-list top-100 mt-0">
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/english.png') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">English</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/spain.png') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">Spanish</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/france.png') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">Franch</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/arabic.svg') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">Arabic</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/german.png') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">German</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/russian.jpeg') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">russian</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/turkish.png') }}" width="25px"
                                            height="20px" class="me-3" loading="lazy"><a href="#">Turkish</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
            <div class="profile-section px-40">
                <div class="card flex-row align-items-end justify-content-sm-start">
                    <div class="card-img d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/vcard21/profile-img.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                    <div class="card-body px-0 text-sm-start text-center">
                        <div class="profile-name">
                            <h2 class="text-primary fs-28 mb-0">Amy Wilson</h2>
                            <p class="fs-18 text-black mb-0">Fashion Influencer</p>
                        </div>
                    </div>
                </div>
                <div class="social-media pt-30 d-flex flex-wrap justify-content-sm-start justify-content-center">
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="13" height="25" viewBox="0 0 13 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.48824 14.1111C2.93372 14.1111 2.42459 14.1111 1.91547 14.1111C1.48123 14.1111 1.047 14.1193 0.613524 14.1079C0.159622 14.0964 0.0113476 13.9495 0.00756504 13.4638C-0.00226951 12.1912 -0.00302602 10.9179 0.00832154 9.64528C0.0128606 9.16368 0.171726 9.01103 0.619577 9.00777C1.4593 9.00205 2.29901 9.00613 3.13949 9.00613C3.24237 9.00613 3.34526 9.00613 3.48824 9.00613C3.48824 8.86818 3.48673 8.74982 3.48824 8.63228C3.50791 7.47235 3.46706 6.30752 3.55935 5.15412C3.79311 2.21633 5.87123 0.1185 8.60372 0.0229951C9.71578 -0.0161863 10.8309 0.00585325 11.9437 0.00911836C12.3356 0.00993464 12.4944 0.182986 12.4959 0.60745C12.5012 1.7984 12.5012 2.99016 12.4967 4.18111C12.4952 4.63741 12.3469 4.80312 11.9119 4.81373C11.1478 4.83332 10.3838 4.83332 9.61895 4.84638C8.76183 4.86026 8.40173 5.22187 8.38357 6.13528C8.36542 7.05849 8.37979 7.98334 8.37979 8.94246C8.50915 8.94246 8.60977 8.94246 8.71038 8.94246C9.68249 8.94246 10.6546 8.94083 11.6267 8.94328C12.2395 8.9441 12.3832 9.09756 12.384 9.74731C12.3847 10.9587 12.3862 12.1708 12.3832 13.3822C12.3817 13.9242 12.2493 14.0703 11.744 14.0728C10.6402 14.0777 9.53649 14.0744 8.38055 14.0744C8.38055 14.2164 8.38055 14.343 8.38055 14.4687C8.38055 17.6554 8.38055 20.843 8.38055 24.0297C8.38055 24.908 8.29431 24.9995 7.46669 24.9995C6.38111 24.9995 5.29628 25.0011 4.2107 24.9986C3.6297 24.9978 3.48824 24.8468 3.48824 24.2264C3.48748 20.9883 3.48748 17.7501 3.48748 14.5127C3.48824 14.3927 3.48824 14.2728 3.48824 14.1111Z"
                                fill="#6554CE" />
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="26" height="25" viewBox="0 0 26 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.5 11.2256C25.5 11.7143 25.5 12.2024 25.5 12.6912C25.4608 13.0129 25.4289 13.3352 25.3818 13.6557C25.0001 16.2479 23.901 18.4908 22.0606 20.3588C20.0879 22.3613 17.6968 23.5418 14.9032 23.8654C12.4606 24.1486 10.135 23.7204 7.94909 22.5821C7.79838 22.5039 7.67034 22.4733 7.49451 22.5363C6.20062 22.9999 4.90059 23.4458 3.60363 23.9015C2.56827 24.2648 1.53475 24.6336 0.5 25C0.521442 24.8979 0.531245 24.792 0.565552 24.6942C1.33135 22.5008 2.09593 20.3062 2.87398 18.1171C2.96526 17.8608 2.95852 17.662 2.83109 17.4137C1.65666 15.1286 1.27009 12.7022 1.64686 10.1693C2.02547 7.62363 3.12516 5.4119 4.94715 3.58796C7.64951 0.883244 10.9339 -0.285619 14.7347 0.0587402C17.045 0.267925 19.1224 1.12056 20.9358 2.57323C23.2976 4.46446 24.7746 6.89393 25.3101 9.87878C25.3897 10.3247 25.4375 10.7767 25.5 11.2256ZM10.7899 9.86716C10.8052 9.84025 10.8077 9.83169 10.8132 9.82618C11.1287 9.50812 11.446 9.19251 11.7591 8.87262C12.1267 8.49645 12.1267 8.09215 11.7554 7.71721C11.2224 7.17957 10.687 6.64377 10.1479 6.11163C9.76802 5.73669 9.36796 5.73669 8.98935 6.10918C8.59481 6.49758 8.21498 6.90127 7.81063 7.27927C7.35299 7.70743 7.21698 8.23161 7.27886 8.8298C7.3824 9.82435 7.79287 10.7082 8.30013 11.5468C9.61915 13.7267 11.3688 15.4986 13.4929 16.9005C14.3518 17.4675 15.264 17.9324 16.2871 18.1391C17.0737 18.2981 17.7673 18.185 18.326 17.5391C18.6446 17.1709 19.014 16.8461 19.3583 16.4993C19.7528 16.1011 19.7522 15.7072 19.3546 15.3066C18.8498 14.7983 18.3413 14.2931 17.834 13.7872C17.3684 13.323 17.0008 13.3218 16.5377 13.7836C16.2338 14.0869 15.9312 14.3915 15.631 14.6925C13.4506 13.6251 11.8485 12.0251 10.7899 9.86716Z"
                                fill="#6554CE" />
                        </svg>
                    </a>

                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="26" height="25" viewBox="0 0 26 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_94_543)">
                                <path
                                    d="M25.4829 15.1365C25.4747 13.9763 25.359 12.8225 25.0217 11.7014C24.5996 10.2974 23.8345 9.16808 22.4696 8.52394C21.4152 8.02657 20.2908 7.88714 19.1418 7.92139C17.1308 7.98173 15.5036 8.75795 14.4158 10.5126C14.4036 10.5322 14.371 10.5395 14.3025 10.5787C14.3025 9.80814 14.3025 9.07187 14.3025 8.33478C12.6297 8.33478 10.9975 8.33478 9.36951 8.33478C9.36951 13.9037 9.36951 19.4506 9.36951 25C11.0929 25 12.7886 25 14.5282 25C14.5282 24.8475 14.5282 24.7269 14.5282 24.6054C14.5282 22.0011 14.5209 19.396 14.5339 16.7917C14.5364 16.2136 14.5739 15.6315 14.6562 15.0599C14.8811 13.4928 15.678 12.6456 17.1251 12.4744C18.7149 12.2868 19.8247 12.8666 20.1392 14.5731C20.2508 15.1798 20.2997 15.8051 20.3038 16.4224C20.3217 19.149 20.3136 21.8755 20.3144 24.6021C20.3144 24.7195 20.3144 24.8361 20.3144 24.9478C22.0663 24.9478 23.7693 24.9478 25.4878 24.9478C25.4927 24.8793 25.5 24.8304 25.5 24.7807C25.4959 21.5665 25.5041 18.3515 25.4829 15.1365Z"
                                    fill="#6554CE" />
                                <path
                                    d="M0.929749 24.9886C2.65639 24.9886 4.36673 24.9886 6.08277 24.9886C6.08277 19.427 6.08277 13.8882 6.08277 8.33069C4.36265 8.33069 2.65965 8.33069 0.929749 8.33069C0.929749 13.8988 0.929749 19.4384 0.929749 24.9886Z"
                                    fill="#6554CE" />
                                <path
                                    d="M3.48067 0.000119092C1.84204 0.0147956 0.499186 1.3683 0.5 3.00392C0.500815 4.66726 1.87381 6.0436 3.52223 6.03381C5.16168 6.02403 6.50616 4.65014 6.49638 2.99251C6.48742 1.32916 5.13316 -0.0145575 3.48067 0.000119092Z"
                                    fill="#6554CE" />
                            </g>
                            <defs>
                                <clipPath id="clip0_94_543">
                                    <rect width="25" height="25" fill="white" transform="translate(0.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>

                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="26" height="25" viewBox="0 0 26 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_94_546)">
                                <path
                                    d="M25.4972 5.76124C25.4972 10.253 25.4972 14.744 25.4972 19.2357C25.3986 19.7027 25.3405 20.1834 25.1945 20.6351C24.3431 23.262 21.9807 24.9855 19.2086 24.9931C15.0676 25.0046 10.9267 24.9993 6.78576 24.9947C5.45589 24.9931 4.22997 24.6255 3.15308 23.8383C1.37381 22.5375 0.500986 20.7681 0.500986 18.5662C0.500221 14.5391 0.497928 10.5121 0.504807 6.48502C0.505571 6.07231 0.524679 5.65194 0.598815 5.24687C1.01841 2.93718 2.3307 1.32605 4.49824 0.444054C5.05388 0.217823 5.67219 0.143687 6.26146 0C10.7532 0 15.2442 0 19.7359 0C19.911 0.031336 20.0867 0.0603791 20.261 0.0932437C22.5554 0.526598 24.162 1.8259 25.0455 3.97738C25.2771 4.53913 25.3512 5.16509 25.4972 5.76124ZM23.3992 12.4985C23.4022 12.4985 23.4053 12.4985 23.4084 12.4985C23.4084 10.4647 23.4045 8.43091 23.4107 6.39637C23.4122 5.74442 23.3251 5.11159 23.0339 4.52538C22.2451 2.93641 20.9588 2.09645 19.1803 2.09034C15.0554 2.07582 10.9305 2.08499 6.80563 2.08805C6.56259 2.08805 6.31802 2.11098 6.07803 2.14537C4.18488 2.41211 2.61731 4.12412 2.60508 6.04097C2.5768 10.2958 2.59362 14.5506 2.59133 18.8054C2.59133 19.3832 2.70444 19.9412 2.95895 20.4578C3.7584 22.0774 5.06916 22.9043 6.87824 22.9066C10.9542 22.9127 15.0302 22.9097 19.1062 22.9059C19.3813 22.9059 19.6587 22.8845 19.9316 22.847C21.7881 22.5925 23.3671 20.8614 23.3923 18.9896C23.4221 16.8267 23.3992 14.663 23.3992 12.4985Z"
                                    fill="#6554CE" />
                                <path
                                    d="M19.2468 12.529C19.214 15.9898 16.3792 18.7909 12.9552 18.7458C9.49829 18.7007 6.71779 15.8874 6.75065 12.4664C6.78352 9.00413 9.61599 6.20606 13.0415 6.24962C16.4992 6.29471 19.2797 9.10808 19.2468 12.529ZM13.0026 8.33767C10.7036 8.33385 8.84787 10.1834 8.8387 12.4885C8.82877 14.7845 10.6768 16.644 12.9835 16.6593C15.2863 16.6738 17.1618 14.8043 17.1596 12.4962C17.1573 10.1941 15.3046 8.34149 13.0026 8.33767Z"
                                    fill="#6554CE" />
                                <path
                                    d="M19.7812 7.28218C18.9114 7.28829 18.2144 6.59661 18.2144 5.72761C18.2151 4.87237 18.8992 4.18068 19.7575 4.16692C20.6051 4.15317 21.3327 4.87466 21.3319 5.72837C21.3319 6.57903 20.6356 7.27607 19.7812 7.28218Z"
                                    fill="#6554CE" />
                            </g>
                            <defs>
                                <clipPath id="clip0_94_546">
                                    <rect width="25" height="25" fill="#6554CE" transform="translate(0.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="26" height="22" viewBox="0 0 26 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.88939 16.6214C5.54282 16.3168 3.98596 15.2112 3.106 13C3.86186 13 4.52748 13 5.18181 13C2.80139 12.0636 1.45888 10.4278 1.28966 7.83304C2.01168 8.03611 2.6773 8.22789 3.34291 8.4084C3.37675 8.36327 3.4106 8.31815 3.44444 8.27302C2.45166 7.47203 1.74092 6.47925 1.49273 5.21571C1.24453 3.95217 1.35735 2.73376 2.04553 1.48151C4.88849 4.71932 8.36321 6.60335 12.6389 6.8741C12.6389 6.40028 12.6277 5.99414 12.6389 5.588C12.7066 3.43322 13.7671 1.86508 15.6962 0.996397C17.5803 0.150278 19.4305 0.37591 21.055 1.70714C21.5063 2.07943 21.9124 2.1584 22.4201 1.95533C23.1985 1.65073 23.9769 1.34613 24.8231 1.03024C24.462 2.1584 23.7175 2.92555 22.939 3.76039C23.7513 3.54604 24.5636 3.3204 25.3758 3.10605C25.4097 3.1399 25.4548 3.17374 25.4887 3.20759C24.8456 3.8732 24.2364 4.59522 23.5369 5.19315C23.1534 5.52031 23.0067 5.84748 22.9954 6.33259C22.9277 9.72835 21.9124 12.8082 19.814 15.4932C16.9936 19.1146 13.2481 20.9422 8.63397 21.0325C5.99408 21.0889 3.52341 20.5361 1.19941 19.2839C0.973776 19.1598 0.748144 19.0244 0.51123 18.8326C3.18497 18.9567 5.62179 18.3249 7.88939 16.6214Z"
                                fill="#6554CE" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="desc px-40 pt-30">
                <p class="text-gray-100 fs-14 text-sm-start text-center mb-0">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book.
                </p>
            </div>
            <div class="contact-section position-relative px-40 pt-40">
                <div class="row">
                    <div class="col-sm-6 mb-sm-4 mb-3">
                        <div class="contact-box d-flex align-items-center h-100">
                            <div class="contact-icon d-flex justify-content-center align-items-center">
                                <svg width="25" height="18" viewBox="0 0 25 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1089_1133)">
                                        <path
                                            d="M12.5238 -0.000544178C15.7072 -0.000544178 18.8843 -0.00654618 22.0677 0.00545782C22.4841 0.00545782 22.9068 0.0474718 23.3104 0.1315C24.0342 0.287552 24.5338 0.719696 24.8477 1.3439C25.1231 1.89009 25.0334 2.19019 24.4954 2.50829C23.7972 2.92243 23.0926 3.33057 22.3944 3.7447C19.3455 5.56331 16.2965 7.36991 13.2604 9.20052C12.7096 9.53663 12.274 9.52463 11.7231 9.19452C8.02726 6.96778 4.31217 4.77105 0.603485 2.56231C0.526621 2.51429 0.443352 2.47228 0.372893 2.42426C0.00778922 2.19019 -0.0626694 2.00412 0.0654371 1.61399C0.379298 0.653674 1.16075 0.0954878 2.3073 0.0354678C2.76849 0.0114598 3.22967 0.0114598 3.68445 0.00545782C6.6309 0.00545782 9.57735 0.00545782 12.5238 -0.000544178C12.5238 0.00545782 12.5238 -0.000544178 12.5238 -0.000544178Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M12.4714 18C9.23673 18 6.00845 18.006 2.77375 17.994C2.37022 17.994 1.95387 17.952 1.56315 17.85C0.775292 17.6399 0.288487 17.1177 0.0514896 16.3915C-0.0702116 16.0133 0.000247007 15.8273 0.365351 15.6112C3.35023 13.8526 6.33512 12.094 9.32 10.3354C9.63386 10.1494 9.96694 10.1494 10.2808 10.3234C10.8445 10.6355 11.3953 10.9597 11.9462 11.2898C12.401 11.5659 12.5931 11.5719 13.0351 11.3018C13.618 10.9476 14.2073 10.6055 14.7902 10.2514C15.104 10.0594 15.3858 10.1194 15.6741 10.2934C16.6285 10.8696 17.5829 11.4398 18.5437 12.01C20.5037 13.1744 22.4701 14.3268 24.4302 15.4912C25.0323 15.8453 25.1284 16.1394 24.8337 16.7336C24.4302 17.5378 23.7 17.88 22.8096 17.982C22.5854 18.006 22.3613 18.006 22.1371 18.006C18.9152 18 15.6933 18 12.4714 18Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M0.0454102 13.8286C0.0454102 10.5995 0.0454102 7.42448 0.0454102 4.1954C2.74846 5.80994 5.41308 7.39447 8.12253 9.00901C5.41948 10.6235 2.75487 12.2141 0.0454102 13.8286Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M16.8975 9.00901C19.5941 7.40047 22.2587 5.80994 24.9618 4.1954C24.9618 7.41248 24.9618 10.5815 24.9618 13.8166C22.2651 12.2141 19.6005 10.6235 16.8975 9.00901Z"
                                            fill="#6554CE" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1089_1133">
                                            <rect width="25" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <a href="kara@gmail.com" class="text-black fw-5">kara@gmail.com</a>
                                <p class="text-gray-100 mb-0 fs-14">Email</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-sm-4 mb-3">
                        <div class="contact-box d-flex align-items-center h-100">
                            <div class="contact-icon d-flex justify-content-center align-items-center">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.03788 8.65636C5.68073 11.8074 8.01407 14.1974 11.0974 15.8383C11.2284 15.9096 11.5379 15.8264 11.6688 15.7075C12.3712 15.0416 13.0617 14.3639 13.7284 13.6623C14.0974 13.2699 14.5022 13.2105 15.0141 13.3056C16.2284 13.5196 17.4545 13.7337 18.6807 13.8763C19.6569 13.9952 20.0022 14.3163 20.0022 15.3151C20.0022 16.3853 20.0022 17.4435 20.0022 18.5137C20.0022 19.6671 19.6331 20.0238 18.4545 20C10.0736 19.8573 2.57359 13.912 0.597401 5.75505C0.252163 4.31629 0.14502 2.80618 0.0140678 1.31986C-0.0692655 0.439952 0.41883 0.0118906 1.29978 0.0118906C2.46645 0 3.63311 0 4.79978 0C5.65692 0 6.01407 0.39239 6.12121 1.24851C6.28788 2.50892 6.51407 3.76932 6.75216 5.01784C6.8474 5.55291 6.75216 5.98098 6.35931 6.36147C5.57359 7.12247 4.81169 7.88347 4.03788 8.65636Z"
                                        fill="#6554CE" />
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <a href="tel:+1 4078467478" class="text-black fw-5">+1 4078467478</a>
                                <p class="text-gray-100 mb-0 fs-14">Mobile Number</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-sm-0 mb-3">
                        <div class="contact-box d-flex align-items-center h-100">
                            <div class="contact-icon d-flex justify-content-center align-items-center">
                                <svg width="25" height="22" viewBox="0 0 25 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1089_1140)">
                                        <path
                                            d="M0.32528 22C0.220282 21.7982 0.052285 21.607 0.0207857 21.3945C-0.0317133 21.0121 0.0207857 20.619 -0.000213916 20.2366C-0.0107137 19.886 0.136283 19.7055 0.493276 19.7161C0.598274 19.7161 0.703272 19.7161 0.80827 19.7161C8.60961 19.7161 16.4005 19.7161 24.2018 19.7267C24.4643 19.7267 24.7268 19.8329 24.9893 19.886C24.9893 20.5872 24.9893 21.2989 24.9893 22C16.7785 22 8.54662 22 0.32528 22Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M12.5263 9.00821C15.3297 9.00821 18.1332 9.00821 20.9471 9.00821C22.5326 9.00821 23.3096 9.80492 23.3201 11.4196C23.3201 11.4408 23.3201 11.4515 23.3201 11.4727C23.5091 12.4075 23.0786 12.9387 22.2596 13.2999C21.4301 13.661 20.6321 13.7354 19.9076 13.1086C19.5506 12.8006 19.2566 12.4288 18.9626 12.057C18.5742 11.5789 18.2067 11.5683 17.8077 12.0357C17.5452 12.3438 17.2827 12.6519 16.9887 12.9174C16.1592 13.6717 15.2457 13.7566 14.3112 13.1511C13.8912 12.8749 13.5133 12.5244 13.1458 12.1738C12.6418 11.6958 12.4213 11.6958 11.9278 12.1951C11.6443 12.4819 11.3503 12.7581 11.0248 12.9918C9.92233 13.7991 8.92484 13.746 7.89586 12.8537C7.73837 12.7156 7.59137 12.5669 7.45487 12.4075C6.75139 11.5896 6.60439 11.5896 5.90091 12.4394C4.94542 13.5867 3.73795 13.8416 2.39398 13.2255C1.86899 12.9812 1.66949 12.6094 1.72199 12.057C1.75349 11.7914 1.78499 11.5258 1.75349 11.2709C1.57499 9.96427 2.61447 8.98696 3.95844 8.99758C6.80389 9.02945 9.65983 9.00821 12.5263 9.00821Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M23.11 18.282C16.0436 18.282 9.00874 18.282 1.94238 18.282C1.94238 17.1666 1.94238 16.0512 1.94238 14.8933C3.69585 15.4882 5.22882 15.1058 6.48879 13.7354C8.58875 15.775 10.5207 15.4988 12.5472 13.6717C15.0566 15.8812 16.8626 15.3713 18.5741 13.6398C19.1515 14.2666 19.7815 14.8402 20.6425 15.0633C21.493 15.2863 22.291 15.1058 23.131 14.7446C23.11 15.9343 23.11 17.0816 23.11 18.282Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M11.0246 8.00965C11.0246 6.95799 11.0141 5.92757 11.0351 4.88653C11.0456 4.54659 11.2871 4.34476 11.6336 4.34476C12.2111 4.33414 12.7886 4.33414 13.3555 4.34476C13.7545 4.34476 13.9855 4.57846 13.9855 4.97151C14.0065 5.97006 13.996 6.97923 13.996 8.00965C12.9986 8.00965 12.0326 8.00965 11.0246 8.00965Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M12.5157 0C12.7677 0.467407 13.0617 0.998551 13.3452 1.54032C13.4711 1.78465 13.6391 2.02897 13.7126 2.29454C13.8701 2.8788 13.6181 3.51618 13.1667 3.77113C12.7152 4.02607 12.0222 3.95171 11.6547 3.61178C11.2662 3.23998 11.1402 2.52825 11.4132 2.00773C11.7702 1.30662 12.1587 0.62675 12.5157 0Z"
                                            fill="#6554CE" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1089_1140">
                                            <rect width="25" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <p class="mb-0 text-black fw-5">12th June, 1990</p>
                                <p class="text-gray-100 mb-0 fs-14">Date of Birth</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-box d-flex align-items-center h-100">
                            <div class="contact-icon d-flex justify-content-center align-items-center">
                                <svg width="20" height="25" viewBox="0 0 20 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1089_1160)">
                                        <path
                                            d="M9.99348 20.5051C9.65861 20.1278 9.33688 19.7699 9.02171 19.4088C7.32112 17.4418 5.71245 15.4071 4.32046 13.2176C3.69341 12.2341 3.14515 11.2119 2.67568 10.1446C1.81225 8.17439 1.95999 6.23643 2.91206 4.35974C4.14318 1.93487 6.16222 0.490272 8.89368 0.0872023C13.0959 -0.531913 17.088 2.36374 17.7742 6.4557C17.9974 7.79712 17.784 9.0547 17.2489 10.2865C16.6514 11.6601 15.8799 12.9371 15.0394 14.1721C13.5391 16.3712 11.8615 18.4317 10.0756 20.4116C10.0559 20.4342 10.0329 20.46 9.99348 20.5051ZM13.9429 7.08772C13.9462 4.95306 12.1734 3.21502 9.99676 3.21502C7.81685 3.21502 6.04732 4.94984 6.04732 7.08449C6.04732 9.21915 7.81685 10.9572 9.99348 10.9572C12.1701 10.9572 13.9396 9.2256 13.9429 7.08772Z"
                                            fill="#6554CE" />
                                        <path
                                            d="M6.92352 17.877C6.54269 17.9318 6.16515 17.9834 5.79088 18.0479C4.66153 18.2381 3.55517 18.5057 2.51117 18.9862C2.10408 19.1764 1.71669 19.3957 1.39824 19.715C0.886091 20.2309 0.886091 20.7597 1.41137 21.266C1.85786 21.6981 2.41268 21.9496 2.98721 22.1688C4.10014 22.588 5.26232 22.817 6.44092 22.9718C8.066 23.1878 9.70093 23.2394 11.3391 23.162C13.1743 23.0749 14.9898 22.8492 16.7397 22.2624C17.2584 22.0882 17.764 21.8819 18.2105 21.5594C18.4107 21.4143 18.6044 21.2466 18.7587 21.0564C19.0575 20.6888 19.0673 20.2792 18.7587 19.9213C18.5486 19.6763 18.2892 19.4538 18.0135 19.2796C17.242 18.7927 16.3753 18.5154 15.4888 18.3155C14.7535 18.151 14.0082 18.0446 13.2663 17.9124C13.2006 17.8995 13.1382 17.8899 13.0726 17.8802C13.194 17.6287 13.217 17.6222 13.4829 17.6416C14.5795 17.7254 15.6727 17.8415 16.7462 18.0769C17.3306 18.2026 17.9084 18.3542 18.437 18.6283C18.7686 18.7992 19.0969 18.9991 19.3693 19.2442C20.0686 19.8762 20.1934 20.7533 19.7469 21.5787C19.5072 22.0237 19.156 22.3752 18.7554 22.6815C17.8822 23.349 16.8874 23.7908 15.8434 24.1294C13.6471 24.842 11.3851 25.0774 9.08045 24.9807C7.31091 24.9033 5.58077 24.6227 3.90645 24.0359C2.87559 23.6747 1.89397 23.2233 1.05352 22.5139C0.685829 22.2043 0.373944 21.8432 0.176964 21.4014C-0.154618 20.6565 -0.00360029 19.8697 0.57749 19.2925C1.06337 18.8088 1.67729 18.5412 2.31748 18.3316C3.19404 18.0446 4.10014 17.8963 5.01281 17.7867C5.5184 17.7254 6.02398 17.6899 6.53284 17.6383C6.77907 17.6158 6.79876 17.6287 6.92352 17.877Z"
                                            fill="#6554CE" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1089_1160">
                                            <rect width="20" height="25" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <p class="text-black mb-0 fw-5">New York, USA</p>
                                <p class="text-gray-100 mb-0 fs-14">Location</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="our-services-section px-40 pt-60">
                <div class="blossom-img">
                    <img src="{{ asset('assets/img/vcard21/blossom.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">#Our Services</h2>
                </div>
                <div class="services">
                    <div class="row">
                        <div class="col-sm-6 mb-sm-0 mb-40 mt-40">
                            <div class="service-card card h-100 ">
                                <div class="card-img">
                                    <img src="{{ asset('assets/img/vcard21/branding-img.png') }}" alt="branding" loading="lazy"/>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <h3 class="fs-18 fw-6 text-black mb-2">Branding</h3>
                                    <p class="card-desc mb-0 fs-14 text-gray-100">
                                        There are many variations of passages of Lorem Ipsum but
                                        the majority have suffered alteration in some form
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-40">
                            <div class="service-card card h-100 ">
                                <div class="card-img">
                                    <img src="{{ asset('assets/img/vcard21/advertising-img.png') }}" alt="advertising" loading="lazy"/>
                                </div>

                                <div class="card-body p-0 text-center">
                                    <h3 class="fs-18 fw-6 text-black mb-2">Advertising</h3>
                                    <p class="card-desc mb-0 fs-14 text-gray-100">
                                        There are many variations of passages of Lorem Ipsum but
                                        the majority have suffered alteration in some form
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="appointment-section pt-60 px-40">
                <div class="appointment-bg-img">
                    <img src="{{ asset('assets/img/vcard21/appointment-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">
                        #Make An Appointment
                    </h2>
                </div>
                <div class="appointment">
                    <form action="">
                        <div class="row justify-content-center">
                            <div class="col-sm-9 px-sm-0 ">
                                <div class="position-relative mb-20">
                                    <input type="text" class="form-control appointment-input"
                                        placeholder="Pick a Date" />

                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 pe-sm-2 mb-3">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ps-sm-2 mb-3">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6  pe-sm-2 mb-3">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ps-sm-2 mb-3">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-primary rounded-2 w-100"> Make an Appointment</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
            <div class="gallery-section pt-60 px-3">
                <div class="gallery-bg-img">
                    <img src="{{ asset('assets/img/vcard21/gallery-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">
                        #Gallery
                    </h2>
                </div>
                <div class="gallery-slider">
                    <div class="slide px-sm-2 px-1">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard21/gallery-img.png') }}" loading="lazy"/>
                        </div>
                    </div>
                    <div class="slide px-sm-2 px-1">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard21/gallery-img.png') }}" loading="lazy"/>
                        </div>
                    </div>
                    <div class="slide px-sm-2 px-1">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard21/gallery-img.png') }}" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-section pt-60 px-40">
                <div class="testimonial-bg-img">
                    <img src="{{ asset('assets/img/vcard21/testimonial-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">
                        #Testimonials
                    </h2>
                </div>
                <div class="testimonial-slider">

                    <div class="px-2">
                        <div class="testimonial-card">
                            <div class="card-body p-0 text-sm-start text-center">
                                <p class="text-black fs-18 mb-20">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                                <div class="d-flex align-items-center justify-content-sm-start justify-content-center">
                                    <div class="profile-img me-3">
                                        <img src="{{ asset('assets/img/vcard21/testimonial-profile-img.png') }}"
                                            class="w-100 h-100 object-fit-cover" loading="lazy">
                                    </div>
                                    <div class="">
                                        <h6 class="fs-6 fw-5 text-primary mb-0">Shane Watson</h6>
                                        <span class="fs-14 text-black">- CEO at Tarsons</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="testimonial-card">
                            <div class="card-body p-0 text-sm-start text-center">
                                <p class="text-black fs-18 mb-20">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                                <div class="d-flex align-items-center justify-content-sm-start justify-content-center">
                                    <div class="profile-img me-3">
                                        <img src="{{ asset('assets/img/vcard21/testimonial-profile-img.png') }}"
                                            class="w-100 h-100 object-fit-cover" loading="lazy">
                                    </div>
                                    <div class="">
                                        <h6 class="fs-6 fw-5 text-primary mb-0">Shane Watson</h6>
                                        <span class="fs-14 text-black">- CEO at Tarsons</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section bg-gray pt-60 px-4">
                <div class="product-bg-img">
                    <img src="{{ asset('assets/img/vcard21/product-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">
                        #Products
                    </h2>
                </div>
                <div class="product-slider">
                    <div class="px-2">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard21/product-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class=" card-body">
                                <div class="product-desc d-flex justify-content-between align-items-center">
                                    <h3 class="text-black fs-18 fw-6 mb-0 me-2">Loreum</h3>
                                    <div class="product-amount text-primary fw-bold fs-18">$250</div>
                                </div>
                                <p class="fs-14 text-gray-100 mb-0">Loreum Ipsm is dummy
                                    text loreum Ipsm is dummy </p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard21/product-img2.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class=" card-body">
                                <div class="product-desc d-flex justify-content-between align-items-center">
                                    <h3 class="text-black fs-18 fw-6 mb-0 me-2">Loreum</h3>
                                    <div class="product-amount text-primary fw-bold fs-18">$250</div>
                                </div>
                                <p class="fs-14 text-gray-100 mb-0">Loreum Ipsm is dummy
                                    text loreum Ipsm is dummy </p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard21/product-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class=" card-body">
                                <div class="product-desc d-flex justify-content-between align-items-center">
                                    <h3 class="text-black fs-18 fw-6 mb-0 me-2">Loreum</h3>
                                    <div class="product-amount text-primary fw-bold fs-18">$250</div>
                                </div>
                                <p class="fs-14 text-gray-100 mb-0">Loreum Ipsm is dummy
                                    text loreum Ipsm is dummy </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-section pt-60 px-40">
                <div class="blog-bg-img">
                    <img src="{{ asset('assets/img/vcard21/blog-bg-img.png') }}">
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0 d-inline-block">
                        #Blog
                    </h2>
                </div>
                <div class="blog-slider">
                    <div class="">
                        <div class="blog-card  card flex-sm-row ">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard21/blog-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 ps-sm-3 pt-sm-0 pt-3">
                                <h6 class="card-title text-black fw-bold fs-18">Instagram</h6>
                                <p class="mb-0  fs-14 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and type setting industry. the
                                    printing and type setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="blog-card  card flex-sm-row">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard21/blog-img2.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 ps-sm-3 pt-sm-0 pt-3">
                                <h6 class="card-title text-black fw-bold fs-18">Verified</h6>
                                <p class="mb-0  fs-14 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and type setting industry. the
                                    printing and type setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="blog-card  card flex-sm-row ">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard21/blog-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 ps-sm-3 pt-sm-0 pt-3">
                                <h6 class="card-title text-black fw-bold fs-18">Instagram</h6>
                                <p class="mb-0  fs-14 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and type setting industry. the
                                    printing and type setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="blog-card  card flex-sm-row">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard21/blog-img2.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 ps-sm-3 pt-sm-0 pt-3">
                                <h6 class="card-title text-black fw-bold fs-18">Verified</h6>
                                <p class="mb-0  fs-14 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and type setting industry. the
                                    printing and type setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="business-hour-section pt-60  px-40">
                <div class="hour-bg-img">
                    <img src="{{ asset('assets/img/vcard21/hour-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40 overflow-hidden">
                    <h2 class="text-primary mb-0">
                        #Business Hours
                    </h2>
                </div>
                <div class="">
                    <div class="business-hour-card row justify-content-center">
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Sunday:</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Monday:</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Tueday:</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Wednesday:</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Thursday:</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Friday:</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="business-hour">
                                <span class="me-2">Saturday:</span>
                                <span>Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qr-code-section pt-60 px-40">
                <div class="qr-bg-img">
                    <img src="{{ asset('assets/img/vcard21/qr-code-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">
                        #QR Code
                    </h2>
                </div>
                <div class="qr-code d-flex justify-content-center align-items-center flex-wrap mb-40">
                    <div class="qr-profile-img">
                        <img src="{{ asset('assets/img/vcard21/qr-profile-img.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                    <div class="qr-code-img">
                        <img src="{{ asset('assets/img/vcard21/qr-code-img.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                </div>
            </div>
            <div class="contact-us-section pt-60 px-40">
                <div class="contact-us-bg-img">
                    <img src="{{ asset('assets/img/vcard21/contact-us-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary mb-0">
                        #Inquiries
                    </h2>
                </div>
                <div class="contact-form px-3 position-relative">
                    <form action="">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" placeholder="Full Name" />
                            </div>
                            <div class="col-12 mb-3">
                                <input type="email" class="form-control" placeholder="Email Address" />
                            </div>
                            <div class="col-12 mb-3">
                                <input type="tel" class="form-control" placeholder="Phone Number" />
                            </div>
                            <div class="col-12 mb-4">
                                <textarea class="form-control h-100" placeholder="Your Message" rows="4"></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button class="send-btn rounded-2 btn-primary" type="submit">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="create-vcard-section pt-60 pb-60 mb-5 px-40">
                <div class="create-vcard-bg-img">
                    <img src="{{ asset('assets/img/vcard21/create-vcard-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading mb-40 text-center">
                    <h2 class="text-primary mb-0">
                        #Create Your VCard
                    </h2>
                </div>
                <div class="vcard-link-card card mx-sm-3 mb-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="https://vcards.infyom.com/marlonbrasil"
                            class="fw-5 text-black link-text">https://vcards.infyom.com/marlonbrasil</a>
                        <i class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-black"></i>
                    </div>
                </div>
            </div>
            <div class="add-to-contact-section">
                <div class="text-center d-flex align-items-center justify-content-center">
                    <button class="add-contact-btn rounded-2 btn-primary"><i
                        class="fas fa-download fa-address-book"></i>
                    &nbsp;Add to Contact</button>
                </div>
            </div>
            <div class="btn-section cursor-pointer">
                <div class="fixed-btn-section">
                    {{-- <div class="bars-btn social-media-bars-btn">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.4134 0.540771H22.489C23.572 0.540771 24.4601 1.42891 24.4601 2.51188V9.5875C24.4601 10.6776 23.5731 11.5586 22.489 11.5586H15.4134C14.3222 11.5586 13.4423 10.6787 13.4423 9.5875V2.51188C13.4423 1.42783 14.3233 0.540771 15.4134 0.540771Z"
                                stroke="white" />
                            <path
                                d="M2.97143 0.5H8.74589C10.1129 0.5 11.2173 1.6122 11.2173 2.97143V8.74589C11.2173 10.1139 10.1139 11.2173 8.74589 11.2173H2.97143C1.6122 11.2173 0.5 10.1129 0.5 8.74589V2.97143C0.5 1.61328 1.61328 0.5 2.97143 0.5Z"
                                stroke="white" />
                            <path
                                d="M2.97143 13.783H8.74589C10.1139 13.783 11.2173 14.8863 11.2173 16.2544V22.0289C11.2173 23.3881 10.1129 24.5003 8.74589 24.5003H2.97143C1.61328 24.5003 0.5 23.387 0.5 22.0289V16.2544C0.5 14.8874 1.6122 13.783 2.97143 13.783Z"
                                stroke="white" />
                            <path
                                d="M16.2537 13.783H22.0282C23.3874 13.783 24.4996 14.8874 24.4996 16.2544V22.0289C24.4996 23.387 23.3863 24.5003 22.0282 24.5003H16.2537C14.8867 24.5003 13.7823 23.3881 13.7823 22.0289V16.2544C13.7823 14.8863 14.8856 13.783 16.2537 13.783Z"
                                stroke="white" />
                        </svg>
                    </div> --}}
                    <div class="sub-btn">
                        <div class="social-btn social-media-sub-btn wp-btn">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="social-btn social-media-sub-btn  mt-3">
                            <i class="fa-solid fa-share-nodes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('vcardTemplates.template.templates')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
<script>
    $().ready(function() {
        $(".gallery-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            speed: 300,
            infinite: true,
            autoplaySpeed: 5000,
            autoplay: true,
            responsive: [{
                    breakpoint: 575,
                    settings: {
                        centerPadding: "125px",
                        dots: true,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerPadding: "0",
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
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                },
            }, ],
        });
        $(".testimonial-slider").slick({
            arrows: true,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left fs-14"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right fs-14"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    dots: true,
                },
            }, ],
        });
        $(".blog-slider").slick({
            arrows: false,
            infinite: true,
            dots: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            vertical: true,
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                    vertical: false,
                },
            }, ],
        });
    });
</script>
<script>
    $("#myID").flatpickr();
</script>

<script>
    $(document).ready(function() {
        $('.dropdown1').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
        });
    });
</script>
</html>
