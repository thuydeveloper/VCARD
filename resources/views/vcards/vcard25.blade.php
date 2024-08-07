<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Social Services/ NGO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard25.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
</head>

<body>
    <div class="container p-0">
        <div class="main-content mx-auto w-100 overflow-hidden">
            <div class="banner-section position-relative">
                <div class="banner-img"></div>
            </div>
            <div class="profile-section px-30">
                <div class="profile-bg-img">
                    <img src="{{ asset('assets/img/vcard25/profile-bg-img.png') }}" loading="lazy"/>
                </div>
                <div class="card d-flex flex-sm-row align-items-sm-start align-items-center mb-sm-4 mb-3 pb-sm-2">
                    <div class="card-img me-sm-2">
                        <img src="{{ asset('assets/img/vcard25/profile-img.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                    <div class="card-body text-sm-start text-center mt-sm-5 pt-sm-4">
                        <div class="profile-name">
                            <h2 class="text-secondary mb-1 mt-2 fs-28 fw-5">
                                Jennifer Murray
                            </h2>
                            <p class="fs-18 text-gray-100 mb-0 text-primary">
                                Social Services / NGO
                            </p>
                        </div>
                    </div>
                </div>
                <p class="text-gray-100 profile-desc pb-30 mb-sm-0 fs-6 text-sm-start text-center">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book.
                </p>
                <div class="social-media d-flex justify-content-center flex-wrap">
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.9704 25.4998C14.9704 22.5882 14.9704 19.6825 14.9704 16.7413C15.9436 16.7413 16.8934 16.7413 17.8667 16.7413C18.0543 15.5188 18.2361 14.3257 18.4237 13.0973C17.2628 13.0973 16.1254 13.0973 15.0114 13.0973C15.0114 12.0992 14.941 11.1365 15.029 10.1857C15.1052 9.35292 15.797 8.83319 16.6706 8.78594C17.1866 8.75641 17.7084 8.76823 18.2243 8.76823C18.3299 8.76823 18.4354 8.76823 18.5527 8.76823C18.5527 7.71696 18.5527 6.70113 18.5527 5.66168C17.2335 5.50222 15.9319 5.28961 14.6127 5.53175C12.6779 5.89202 11.3353 7.28583 11.1359 9.27023C11.0245 10.4042 11.0714 11.5499 11.048 12.6898C11.048 12.8138 11.048 12.9378 11.048 13.0973C9.97505 13.0973 8.93729 13.0973 7.88781 13.0973C7.88781 14.3257 7.88781 15.5188 7.88781 16.7413C8.94315 16.7413 9.97505 16.7413 11.0245 16.7413C11.0245 19.6766 11.0245 22.5823 11.0245 25.4939C6.61553 25.0097 0.969417 20.8873 0.529689 13.9064C0.0723718 6.71885 5.53673 0.877845 12.3203 0.51758C19.6432 0.127786 25.4652 6.00423 25.5062 13.0028C25.5414 19.9423 20.1826 24.8502 14.9704 25.4998Z" />
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_616_3757)">
                                <path
                                    d="M5.71959 0.166672C9.25045 0.166672 12.7653 0.166672 16.2961 0.166672C16.5208 0.198747 16.7455 0.230822 16.9542 0.278934C19.4097 0.824209 20.9825 2.3157 21.6566 4.73736C21.7369 5.05811 21.769 5.37886 21.8332 5.71565C21.8332 9.2439 21.8332 12.7561 21.8332 16.2844C21.8171 16.3645 21.8171 16.4287 21.785 16.5089C21.6406 17.0702 21.5764 17.6636 21.3356 18.1928C20.2603 20.5343 18.3986 21.7692 15.8307 21.8173C12.6208 21.8654 9.3949 21.8333 6.18502 21.8333C4.93317 21.8333 3.77761 21.4965 2.7665 20.7749C1.03317 19.5239 0.182553 17.84 0.166504 15.723C0.166504 12.5637 0.166504 9.40427 0.166504 6.26092C0.166504 5.85998 0.182553 5.44301 0.27885 5.04207C0.824529 2.58833 2.31712 1.01666 4.74058 0.343084C5.06156 0.262897 5.38255 0.230822 5.71959 0.166672ZM2.09243 10.992C2.09243 12.5637 2.09243 14.1193 2.09243 15.691C2.09243 16.1881 2.14058 16.6693 2.31712 17.1504C2.927 18.8664 4.40354 19.9088 6.26527 19.9088C9.427 19.9088 12.5887 19.9249 15.7344 19.9088C16.1998 19.9088 16.6974 19.8447 17.1467 19.6843C18.8801 19.107 19.9072 17.5994 19.9072 15.723C19.9072 12.5797 19.9233 9.42031 19.8912 6.27696C19.8912 5.81187 19.827 5.31471 19.6826 4.86566C19.1048 3.13361 17.6122 2.09117 15.7505 2.09117C12.5887 2.09117 9.427 2.09117 6.24922 2.09117C4.83687 2.09117 3.68132 2.65248 2.8307 3.80718C2.28502 4.54491 2.07638 5.37886 2.07638 6.293C2.09243 7.84863 2.09243 9.42031 2.09243 10.992Z" />
                                <path
                                    d="M10.9997 16.573C7.9343 16.573 5.41455 14.0551 5.41455 10.992C5.41455 7.92882 7.95035 5.41093 10.9997 5.41093C14.0652 5.42697 16.5689 7.91278 16.5689 10.9759C16.601 14.0391 14.0812 16.557 10.9997 16.573ZM14.659 10.992C14.659 8.9873 13.022 7.33543 10.9997 7.33543C8.99356 7.33543 7.34048 8.97126 7.34048 10.992C7.34048 12.9967 8.97751 14.6485 10.9997 14.6485C13.0059 14.6485 14.659 13.0127 14.659 10.992Z" />
                                <path
                                    d="M16.8096 3.79117C17.58 3.79117 18.238 4.43267 18.2219 5.20247C18.2219 5.97227 17.58 6.59773 16.8096 6.59773C16.0392 6.59773 15.3812 5.95623 15.3973 5.18643C15.4133 4.41663 16.0392 3.79117 16.8096 3.79117Z" />
                            </g>
                            <defs>
                                <clipPath id="clip0_616_3757">
                                    <rect width="21.6667" height="21.6667" fill="white"
                                        transform="translate(0.166504 0.166672)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_616_3783)">
                                <path
                                    d="M17.3418 21.8237C17.3418 21.7078 17.3418 21.6016 17.3418 21.5002C17.3418 19.1582 17.3515 16.8163 17.3322 14.4743C17.3274 13.8804 17.2744 13.2816 17.1589 12.7022C16.9327 11.5626 16.2684 11.0266 15.1082 10.9783C14.3621 10.9445 13.6641 11.0893 13.125 11.6543C12.6677 12.1324 12.4703 12.736 12.3981 13.383C12.3452 13.8707 12.3211 14.3632 12.3211 14.851C12.3115 17.0818 12.3163 19.3079 12.3163 21.5388C12.3163 21.6305 12.3163 21.7271 12.3163 21.8333C10.8144 21.8333 9.34138 21.8333 7.84912 21.8333C7.84912 17.0142 7.84912 12.2 7.84912 7.37603C9.27399 7.37603 10.6892 7.37603 12.1382 7.37603C12.1382 8.02308 12.1382 8.66048 12.1382 9.29787C12.1574 9.3027 12.1719 9.30753 12.1911 9.31236C12.2296 9.26407 12.2681 9.22061 12.3018 9.17233C13.0768 7.93616 14.2225 7.27945 15.6329 7.07181C16.6486 6.92212 17.6499 7.00904 18.6319 7.31808C20.0423 7.76233 20.904 8.74257 21.3565 10.1188C21.6886 11.1231 21.8042 12.1613 21.8138 13.214C21.833 16.0388 21.8282 18.8637 21.8282 21.6885C21.8282 21.7271 21.8234 21.7657 21.8186 21.8333C20.3408 21.8237 18.863 21.8237 17.3418 21.8237Z" />
                                <path
                                    d="M0.546875 7.37602C2.04395 7.37602 3.51696 7.37602 4.99959 7.37602C4.99959 12.2 4.99959 17.0094 4.99959 21.8333C3.51214 21.8333 2.03914 21.8333 0.546875 21.8333C0.546875 17.0191 0.546875 12.2048 0.546875 7.37602Z" />
                                <path
                                    d="M5.3595 2.76938C5.36432 4.218 4.2042 5.38174 2.76008 5.38174C1.32077 5.38174 0.155846 4.21318 0.160659 2.76938C0.170287 1.3304 1.32077 0.1715 2.75527 0.166672C4.19458 0.161843 5.3595 1.32075 5.3595 2.76938Z" />
                            </g>
                            <defs>
                                <clipPath id="clip0_616_3783">
                                    <rect width="21.6667" height="21.6667" fill="white"
                                        transform="translate(0.166504 0.166672)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.166504 21.8325C0.200373 21.7072 0.219727 21.6253 0.243919 21.5434C0.708412 19.8615 1.17291 18.1844 1.62772 16.5026C1.66159 16.3725 1.64224 16.1942 1.57934 16.0785C-0.525397 12.1606 -0.147997 7.54869 2.70186 4.13195C5.29044 1.01399 8.66769 -0.263067 12.6933 0.291129C15.2964 0.652562 17.4447 1.89589 19.1817 3.85244C22.5735 7.68363 22.7138 13.4232 19.5639 17.4953C16.4673 21.5 10.816 22.806 6.28233 20.5362C5.99202 20.3916 5.74526 20.3675 5.4356 20.4542C3.776 20.9024 2.11641 21.3265 0.451974 21.7602C0.374558 21.7795 0.292304 21.7988 0.166504 21.8325ZM5.52753 8.49323C5.60494 8.85949 5.65817 9.23537 5.75977 9.59681C5.96783 10.3197 6.40329 10.9221 6.83391 11.5244C8.32416 13.6063 10.2063 15.158 12.7127 15.8809C13.7578 16.1797 14.74 16.1411 15.6641 15.4906C16.3076 15.0376 16.5157 14.4063 16.506 13.6738C16.506 13.5533 16.4092 13.3798 16.3076 13.3268C15.5819 12.9605 14.8464 12.6087 14.1061 12.2714C13.8158 12.1365 13.6803 12.1943 13.482 12.4497C13.2255 12.7726 12.9691 13.0907 12.7078 13.4039C12.5627 13.5822 12.3836 13.6448 12.1514 13.5533C10.5402 12.9172 9.30637 11.8473 8.43061 10.363C8.31449 10.1703 8.32416 10.0112 8.47899 9.84258C8.66769 9.63536 8.84672 9.4185 9.0209 9.19682C9.24347 8.90768 9.2967 8.60889 9.13219 8.2571C8.8951 7.75591 8.70156 7.23545 8.48383 6.72463C8.15482 5.93911 8.15482 5.91984 7.29357 5.94875C7.06132 5.95839 6.78553 6.04513 6.61618 6.19452C5.91944 6.79209 5.56624 7.56315 5.52753 8.49323Z" />
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1344_384)">
                                <path
                                    d="M7.3889 18.6214C5.04233 18.3168 3.48547 17.2112 2.60551 15C3.36137 15 4.02699 15 4.68132 15C2.3009 14.0636 0.958396 12.4278 0.789172 9.83305C1.51119 10.0361 2.17681 10.2279 2.84242 10.4084C2.87627 10.3633 2.91011 10.3182 2.94395 10.273C1.95118 9.47204 1.24044 8.47926 0.99224 7.21572C0.744045 5.95219 0.856861 4.73378 1.54504 3.48152C4.388 6.71934 7.86273 8.60336 12.1384 8.87412C12.1384 8.40029 12.1272 7.99415 12.1384 7.58802C12.2061 5.43323 13.2666 3.86509 15.1958 2.99641C17.0798 2.15029 18.93 2.37592 20.5545 3.70715C21.0058 4.07944 21.4119 4.15841 21.9196 3.95535C22.698 3.65074 23.4764 3.34614 24.3226 3.03026C23.9616 4.15841 23.217 4.92556 22.4385 5.7604C23.2508 5.54605 24.0631 5.32042 24.8754 5.10607C24.9092 5.13991 24.9543 5.17376 24.9882 5.2076C24.3451 5.87322 23.7359 6.59524 23.0365 7.19316C22.6529 7.52033 22.5062 7.84749 22.4949 8.3326C22.4273 11.7284 21.4119 14.8082 19.3135 17.4933C16.4931 21.1146 12.7477 22.9423 8.13348 23.0325C5.49359 23.0889 3.02293 22.5361 0.698919 21.2839C0.473287 21.1598 0.247656 21.0244 0.0107422 20.8326C2.68448 20.9567 5.1213 20.3249 7.3889 18.6214Z" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1344_384">
                                    <rect width="25" height="20.5325" fill="white"
                                        transform="translate(0 2.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="contact-section pt-60">
                <div class="bg-light px-30 pt-30 pb-30">
                    <div class="row">
                        <div class="col-sm-6 mb-4 pb-sm-2 px-lg-4 px-sm-3">
                            <div class="contact-box text-center">
                                <div
                                    class="contact-icon d-flex justify-content-center align-items-center mx-auto mb-3">
                                    <svg width="27" height="20" viewBox="0 0 27 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_671_16376)">
                                            <path
                                                d="M27 2.78896C27 2.60502 27 2.42605 27 2.24211C26.9631 2.07308 26.9367 1.90405 26.884 1.73999C26.6414 0.939597 26.1984 0.298285 25.2861 0.0894855C24.9855 0.0198857 24.6586 0.00497141 24.3475 0.00497141C17.1176 0 9.8877 0 2.65781 0C2.49961 0 2.34141 0 2.1832 0.0149142C1.7086 0.0546856 1.28672 0.223714 0.912306 0.507084C0.400782 0.894855 0.126566 1.40194 -0.00527 1.99354C-0.00527 2.19239 -0.00527 2.39125 -0.00527 2.59011C0.100199 3.09222 0.226759 3.58936 0.495705 4.04176C1.04414 4.9565 1.81406 5.66741 2.7211 6.25901C5.4 8.01889 8.07891 9.78374 10.7631 11.5387C11.2166 11.8369 11.6912 12.1054 12.1711 12.3639C13.0518 12.8362 13.9482 12.8312 14.8289 12.3589C15.2191 12.1501 15.6094 11.9413 15.9785 11.7027C18.7734 9.8782 21.5684 8.05369 24.3369 6.19935C25.6131 5.34427 26.6572 4.30524 27 2.78896Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M27 6.46783C25.36 7.9692 23.3455 8.9784 21.5209 10.2411C21.1201 10.5195 20.6982 10.7781 20.2711 11.0515C20.3186 11.1062 20.3555 11.1509 20.3924 11.1907C22.565 13.2389 24.7324 15.2822 26.8998 17.3254C26.9314 17.3552 26.9684 17.3801 27 17.4049C27 13.7609 27 10.1119 27 6.46783Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M8.53539e-05 17.4049C0.0791869 17.3353 0.158288 17.2707 0.232117 17.2011C2.33095 15.2225 4.43505 13.2439 6.53389 11.2603C6.59717 11.2006 6.65518 11.141 6.729 11.0664C6.64463 11.0067 6.5708 10.952 6.49697 10.9023C4.99931 9.93291 3.48583 8.98337 2.004 7.98908C1.3079 7.52177 0.669813 6.97492 8.53539e-05 6.46286C8.53539e-05 10.1119 8.53539e-05 13.7609 8.53539e-05 17.4049Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M8.4957 12.2347C5.94336 14.6408 3.40684 17.0321 0.854492 19.4383C1.20781 19.7564 1.64551 19.9255 2.13594 19.9801C2.27305 19.9951 2.41543 19.9951 2.55781 19.9951C9.85098 19.9951 17.1441 19.9951 24.4373 20C25.0754 20 25.6502 19.8608 26.1143 19.4731C23.5672 17.0719 21.0254 14.6756 18.4678 12.2645C17.9193 12.6324 17.3445 13.0351 16.7486 13.4129C16.0104 13.8852 15.2141 14.2481 14.3439 14.447C13.4369 14.6558 12.5773 14.4867 11.723 14.1536C10.7105 13.7609 9.85625 13.1395 8.97559 12.5529C8.81211 12.4534 8.65918 12.3441 8.4957 12.2347Z"
                                                fill="#FFA31A" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_671_16376">
                                                <rect width="27" height="20" fill="white"
                                                    transform="matrix(-1 0 0 1 27 0)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <a href="mailto:jackie@gmail.com"
                                        class="text-secondary fs-6 fw-5">jackie@gmail.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4 pb-sm-2 px-lg-4 px-sm-3">
                            <div class="contact-box text-center">
                                <div
                                    class="contact-icon d-flex justify-content-center align-items-center mx-auto mb-3">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.24875 11.2533C7.38447 15.3496 10.4178 18.4566 14.4261 20.5898C14.5964 20.6825 14.9988 20.5743 15.169 20.4197C16.0821 19.5541 16.9797 18.673 17.8464 17.761C18.3261 17.2509 18.8523 17.1736 19.5178 17.2973C21.0964 17.5755 22.6904 17.8537 24.2845 18.0392C25.5535 18.1938 26.0023 18.6112 26.0023 19.9096C26.0023 21.3008 26.0023 22.6766 26.0023 24.0678C26.0023 25.5672 25.5226 26.0309 23.9904 26C13.0952 25.8145 3.34518 18.0856 0.776133 7.48157C0.327324 5.61118 0.188038 3.64804 0.0177999 1.71581C-0.0905334 0.571938 0.54399 0.0154578 1.68923 0.0154578C3.2059 0 4.72256 0 6.23923 0C7.35351 0 7.8178 0.510107 7.95709 1.62307C8.17375 3.26159 8.4678 4.90012 8.77732 6.52319C8.90113 7.21879 8.77732 7.77527 8.26661 8.26992C7.24518 9.25922 6.2547 10.2485 5.24875 11.2533Z"
                                            fill="#FFA31A" />
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <a href="tel:+1 4078461474" class="text-secondary fs-6 fw-5">+1 4078461474</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-sm-0 mb-4 px-lg-4 px-sm-3">
                            <div class="contact-box text-center">
                                <div
                                    class="contact-icon d-flex justify-content-center align-items-center mx-auto mb-3">
                                    <svg width="30" height="26" viewBox="0 0 30 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_681_16526)">
                                            <path
                                                d="M0.390531 26C0.264533 25.7615 0.0629374 25.5355 0.0251381 25.2844C-0.0378606 24.8324 0.0251381 24.3679 -6.1387e-05 23.916C-0.0126611 23.5017 0.163735 23.2883 0.592127 23.3008C0.718124 23.3008 0.844122 23.3008 0.970119 23.3008C10.3317 23.3008 19.6807 23.3008 29.0424 23.3134C29.3574 23.3134 29.6723 23.4389 29.9873 23.5017C29.9873 24.3303 29.9873 25.1714 29.9873 26C20.1343 26 10.2561 26 0.390531 26Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M15.0315 10.6461C18.3957 10.6461 21.7598 10.6461 25.1365 10.6461C27.0391 10.6461 27.9715 11.5877 27.9841 13.4959C27.9841 13.521 27.9841 13.5336 27.9841 13.5587C28.2109 14.6635 27.6943 15.2912 26.7115 15.718C25.7161 16.1449 24.7585 16.2328 23.8892 15.492C23.4608 15.128 23.108 14.6886 22.7552 14.2492C22.289 13.6842 21.848 13.6717 21.3692 14.2241C21.0542 14.5881 20.7392 14.9522 20.3864 15.2661C19.391 16.1574 18.2949 16.2579 17.1735 15.5423C16.6695 15.2159 16.2159 14.8016 15.7749 14.3873C15.1701 13.8223 14.9055 13.8223 14.3133 14.4124C13.9731 14.7513 13.6204 15.0778 13.2298 15.354C11.9068 16.3081 10.7098 16.2453 9.47504 15.1907C9.28604 15.0275 9.10965 14.8518 8.94585 14.6635C8.10167 13.6968 7.92527 13.6968 7.08109 14.7011C5.93451 16.057 4.48554 16.3583 2.87277 15.6301C2.24278 15.3414 2.00339 14.902 2.06639 14.2492C2.10419 13.9353 2.14199 13.6215 2.10419 13.3201C1.88999 11.776 3.13737 10.621 4.75013 10.6335C8.16467 10.6712 11.5918 10.6461 15.0315 10.6461Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M27.7321 21.606C19.2525 21.606 10.8107 21.606 2.33105 21.606C2.33105 20.2878 2.33105 18.9696 2.33105 17.6012C4.43521 18.3042 6.27478 17.8522 7.78675 16.2327C10.3067 18.6432 12.625 18.3168 15.0568 16.1574C18.0681 18.7687 20.2353 18.1661 22.2891 16.1198C22.982 16.8605 23.738 17.5384 24.7712 17.802C25.7918 18.0657 26.7494 17.8522 27.7573 17.4254C27.7321 18.8315 27.7321 20.1874 27.7321 21.606Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M13.2297 9.46596C13.2297 8.22308 13.2171 7.00531 13.2423 5.77499C13.2549 5.37325 13.5447 5.13472 13.9605 5.13472C14.6535 5.12217 15.3465 5.12217 16.0269 5.13472C16.5056 5.13472 16.7828 5.41092 16.7828 5.87542C16.808 7.05553 16.7954 8.24819 16.7954 9.46596C15.5985 9.46596 14.4393 9.46596 13.2297 9.46596Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M15.0188 0C15.3212 0.55239 15.674 1.18011 16.0142 1.82038C16.1654 2.10913 16.367 2.39788 16.4552 2.71173C16.6442 3.40222 16.3418 4.15548 15.8 4.45678C15.2582 4.75809 14.4266 4.67021 13.9856 4.26847C13.5194 3.82907 13.3682 2.98793 13.6958 2.37277C14.1242 1.54418 14.5904 0.740705 15.0188 0Z"
                                                fill="#FFA31A" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_681_16526">
                                                <rect width="30" height="26" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <p class="mb-0 text-secondary fs-6 fw-5">12th June, 1990</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 px-lg-4 px-sm-3">
                            <div class="contact-box text-center">
                                <div
                                    class="contact-icon d-flex justify-content-center align-items-center mx-auto mb-3">
                                    <svg width="20" height="26" viewBox="0 0 20 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_681_16532)">
                                            <path
                                                d="M9.99348 21.3252C9.65861 20.9328 9.33688 20.5606 9.02171 20.185C7.32112 18.1393 5.71245 16.0232 4.32046 13.7462C3.69341 12.7233 3.14515 11.6603 2.67568 10.5502C1.81225 8.50122 1.95999 6.48574 2.91206 4.53398C4.14318 2.01212 6.16222 0.509733 8.89368 0.0905402C13.0959 -0.55334 17.088 2.45814 17.7742 6.71378C17.9974 8.10886 17.784 9.41674 17.2489 10.6978C16.6514 12.1264 15.8799 13.4544 15.0394 14.7388C13.5391 17.0259 11.8615 19.1688 10.0756 21.2279C10.0559 21.2514 10.0329 21.2782 9.99348 21.3252ZM13.9429 7.37108C13.9462 5.15103 12.1734 3.34347 9.99676 3.34347C7.81685 3.34347 6.04732 5.14768 6.04732 7.36772C6.04732 9.58777 7.81685 11.3953 9.99348 11.3953C12.1701 11.3953 13.9396 9.59447 13.9429 7.37108Z"
                                                fill="#FFA31A" />
                                            <path
                                                d="M6.92352 18.592C6.54269 18.649 6.16515 18.7027 5.79088 18.7698C4.66153 18.9676 3.55517 19.246 2.51117 19.7457C2.10408 19.9435 1.71669 20.1716 1.39824 20.5036C0.886091 21.0401 0.886091 21.5901 1.41137 22.1166C1.85786 22.566 2.41268 22.8276 2.98721 23.0556C4.10014 23.4916 5.26232 23.7297 6.44092 23.8906C8.066 24.1153 9.70093 24.169 11.3391 24.0885C13.1743 23.9979 14.9898 23.7632 16.7397 23.1529C17.2584 22.9718 17.764 22.7571 18.2105 22.4218C18.4107 22.2709 18.6044 22.0965 18.7587 21.8986C19.0575 21.5163 19.0673 21.0904 18.7587 20.7182C18.5486 20.4633 18.2892 20.2319 18.0135 20.0508C17.242 19.5444 16.3753 19.256 15.4888 19.0481C14.7535 18.8771 14.0082 18.7664 13.2663 18.6289C13.2006 18.6155 13.1382 18.6054 13.0726 18.5954C13.194 18.3338 13.217 18.3271 13.4829 18.3472C14.5795 18.4344 15.6727 18.5551 16.7462 18.8C17.3306 18.9307 17.9084 19.0884 18.437 19.3734C18.7686 19.5511 19.0969 19.7591 19.3693 20.0139C20.0686 20.6712 20.1934 21.5834 19.7469 22.4419C19.5072 22.9047 19.156 23.2702 18.7554 23.5888C17.8822 24.283 16.8874 24.7424 15.8434 25.0945C13.6471 25.8357 11.3851 26.0805 9.08045 25.9799C7.31091 25.8994 5.58077 25.6076 3.90645 24.9973C2.87559 24.6217 1.89397 24.1522 1.05352 23.4144C0.685829 23.0925 0.373944 22.7169 0.176964 22.2575C-0.154618 21.4828 -0.00360029 20.6645 0.57749 20.0642C1.06337 19.5612 1.67729 19.2829 2.31748 19.0649C3.19404 18.7664 4.10014 18.6122 5.01281 18.4981C5.5184 18.4344 6.02398 18.3975 6.53284 18.3439C6.77907 18.3204 6.79876 18.3338 6.92352 18.592Z"
                                                fill="#FFA31A" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_681_16532">
                                                <rect width="20" height="26" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <p class="text-secondary mb-0 fs-6 fw-5">New York, USA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery-section pt-60 px-30 position-relative">
                <div class="gallery-bg-img">
                    <img src="{{ asset('assets/img/vcard25/gallery-bg.png') }}" alt="gallery-bg" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-30">
                    <h2 class="mb-0">Gallery</h2>
                </div>
                <div class="gallery-slider">
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard25/gallery-img1.png') }}" loading="lazy"/>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard25/gallery-img2.png') }}" loading="lazy"/>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard25/gallery-img1.png') }}" loading="lazy"/>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard25/gallery-img2.png') }}" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="our-services-section pt-60">
                <div class="services-bg-img">
                    <img src="{{ asset('assets/img/vcard25/services-bg.png') }}" alt="services-bg-img" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-center mb-0">Our Services</h2>
                </div>
                <div class="services bg-light px-30 pt-30 pb-30">
                    <div class="row">
                        <div class="col-sm-6 mb-sm-0 mb-4">
                            <div class="service-card h-100">
                                <div class="card-img mx-auto d-flex justify-content-center align-items-center mb-3">
                                    <img src="{{ asset('assets/img/vcard25/services-img.png') }}" loading="lazy"/>
                                </div>
                                <div class="card-body text-center p-0 pt-2 flex-grow-0">
                                    <h3 class="card-title fs-18 text-secondary">
                                        Social welfare
                                    </h3>
                                    <p class="mb-0 fs-14 text-gray-100 text-center">
                                        There are many variations of passages of Lorem Ipsum but
                                        the majority have suffered alteration in some form
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card h-100">
                                <div class="card-img mx-auto d-flex justify-content-center align-items-center mb-3">
                                    <img src="{{ asset('assets/img/vcard25/services-img.png') }}" loading="lazy"/>
                                </div>
                                <div class="card-body text-center p-0 pt-2 flex-grow-0">
                                    <h3 class="card-title fs-18 text-secondary">Healthcare</h3>
                                    <p class="mb-0 fs-14 text-gray-100 text-center">
                                        There are many variations of passages of Lorem Ipsum but
                                        the majority have suffered alteration in some form
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section pt-60 px-30">
                <div class="product-bg-img text-end">
                    <img src="{{ asset('assets/img/vcard25/product-bg.png') }}" alt="product-bg-img" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="mb-0">Products</h2>
                </div>
                <div class="">
                    <div class="product-slider">
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{ asset('assets/img/vcard25/product-img1.png') }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="product-desc align-items-center">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h3 class="text-secondary fs-18 fw-5 mb-0">Loreum 1</h3>
                                        <h4 class="text-center text-primary mb-0 fs-20">$200</h4>
                                    </div>

                                    <p class="mb-0 text-gray-100 fs-14">
                                        There are many variations
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{ asset('assets/img/vcard25/product-img2.png') }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="product-desc align-items-center">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h3 class="text-secondary fs-18 fw-5 mb-0">Loreum 1</h3>
                                        <h4 class="text-center text-primary mb-0 fs-20">$200</h4>
                                    </div>

                                    <p class="mb-0 text-gray-100 fs-14">
                                        There are many variations
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{ asset('assets/img/vcard25/product-img1.png') }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="product-desc align-items-center">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h3 class="text-secondary fs-18 fw-5 mb-0">Loreum 1</h3>
                                        <h4 class="text-center text-primary mb-0 fs-20">$200</h4>
                                    </div>

                                    <p class="mb-0 text-gray-100 fs-14">
                                        There are many variations
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{ asset('assets/img/vcard25/product-img2.png') }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="product-desc align-items-center">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h3 class="text-secondary fs-18 fw-5 mb-0">Loreum 1</h3>
                                        <h4 class="text-center text-primary mb-0 fs-20">$200</h4>
                                    </div>

                                    <p class="mb-0 text-gray-100 fs-14">
                                        There are many variations
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="appointment-section pt-60 px-30">
                <div class="section-heading text-center mb-40">
                    <h2 class="mb-0">Make An Appointment</h2>
                </div>
                <div class="appointment">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="mt-sm-3 mb-2">Date:</label>
                            </div>
                            <div class="col-sm-10 mb-20">
                                <div class="position-relative">
                                    <input type="text" class="form-control appointment-input"
                                        placeholder="Pick a Date" />
                                    <span class="calendar-icon">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_102_145)">
                                                <path
                                                    d="M14.25 1.5H13.5V0.75C13.5 0.551088 13.421 0.360322 13.2803 0.21967C13.1397 0.0790176 12.9489 0 12.75 0C12.5511 0 12.3603 0.0790176 12.2197 0.21967C12.079 0.360322 12 0.551088 12 0.75V1.5H6V0.75C6 0.551088 5.92098 0.360322 5.78033 0.21967C5.63968 0.0790176 5.44891 0 5.25 0C5.05109 0 4.86032 0.0790176 4.71967 0.21967C4.57902 0.360322 4.5 0.551088 4.5 0.75V1.5H3.75C2.7558 1.50119 1.80267 1.89666 1.09966 2.59966C0.396661 3.30267 0.00119089 4.2558 0 5.25L0 14.25C0.00119089 15.2442 0.396661 16.1973 1.09966 16.9003C1.80267 17.6033 2.7558 17.9988 3.75 18H14.25C15.2442 17.9988 16.1973 17.6033 16.9003 16.9003C17.6033 16.1973 17.9988 15.2442 18 14.25V5.25C17.9988 4.2558 17.6033 3.30267 16.9003 2.59966C16.1973 1.89666 15.2442 1.50119 14.25 1.5ZM1.5 5.25C1.5 4.65326 1.73705 4.08097 2.15901 3.65901C2.58097 3.23705 3.15326 3 3.75 3H14.25C14.8467 3 15.419 3.23705 15.841 3.65901C16.2629 4.08097 16.5 4.65326 16.5 5.25V6H1.5V5.25ZM14.25 16.5H3.75C3.15326 16.5 2.58097 16.2629 2.15901 15.841C1.73705 15.419 1.5 14.8467 1.5 14.25V7.5H16.5V14.25C16.5 14.8467 16.2629 15.419 15.841 15.841C15.419 16.2629 14.8467 16.5 14.25 16.5Z"
                                                    fill="#FFA31A"></path>
                                                <path
                                                    d="M9 12.375C9.62132 12.375 10.125 11.8713 10.125 11.25C10.125 10.6287 9.62132 10.125 9 10.125C8.37868 10.125 7.875 10.6287 7.875 11.25C7.875 11.8713 8.37868 12.375 9 12.375Z"
                                                    fill="#FFA31A"></path>
                                                <path
                                                    d="M5.25 12.375C5.87132 12.375 6.375 11.8713 6.375 11.25C6.375 10.6287 5.87132 10.125 5.25 10.125C4.62868 10.125 4.125 10.6287 4.125 11.25C4.125 11.8713 4.62868 12.375 5.25 12.375Z"
                                                    fill="#FFA31A"></path>
                                                <path
                                                    d="M12.75 12.375C13.3713 12.375 13.875 11.8713 13.875 11.25C13.875 10.6287 13.3713 10.125 12.75 10.125C12.1287 10.125 11.625 10.6287 11.625 11.25C11.625 11.8713 12.1287 12.375 12.75 12.375Z"
                                                    fill="#FFA31A"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_102_145">
                                                    <rect width="18" height="18" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="mt-sm-3 mb-2">Hour:</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-6 pe-sm-1 mb-10">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ps-sm-1 mb-10">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pe-sm-1 mb-10">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ps-sm-1 mb-10">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-black">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary w-100">
                                        Make an Appointment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="testimonial-section pt-60">
                <div class="testimonial-vector-img">
                    <img src="{{ asset('assets/img/vcard25/testimonial-vector.png') }}" alt="testimonial-vector-img" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="mb-0">Testimonials</h2>
                </div>
                <div class="testimonial-slider pt-60 pb-40 px-40">
                    <div class="">
                        <div class="testimonial-card card flex-sm-row">
                            <div class="testimonial-profile-img">
                                <img src="{{ asset('assets/img/vcard25/testimonial-profile-img.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 text-sm-start text-center">
                                <div class="">
                                    <div class="quote-img text-center mb-3">
                                        <img src="{{ asset('assets/img/vcard25/quote-img.png') }}" alt="quote-img"
                                            class="mx-auto" loading="lazy"/>
                                    </div>
                                    <h3 class="text-white fs-20 fw-6 mb-1">
                                        Cameron Williamson
                                    </h3>
                                    <p class="fs-14 text-white">- Social Work</p>
                                    <p class="desc text-white fs-14">
                                        Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. Lorem Ipsum is simply dummy text of the
                                        printing and type setting industry
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="testimonial-card card flex-sm-row">
                            <div class="testimonial-profile-img">
                                <img src="{{ asset('assets/img/vcard25/testimonial-profile-img.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 text-sm-start text-center">
                                <div class="">
                                    <div class="quote-img text-center mb-3">
                                        <img src="{{ asset('assets/img/vcard25/quote-img.png') }}" alt="quote-img"
                                            class="mx-auto" loading="lazy"/>
                                    </div>
                                    <h3 class="text-white fs-20 fw-6 mb-1">
                                        Cameron Williamson
                                    </h3>
                                    <p class="fs-14 text-white">- Social Work</p>
                                    <p class="desc text-white fs-14">
                                        Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. Lorem Ipsum is simply dummy text of the
                                        printing and type setting industry
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="testimonial-card card flex-sm-row">
                            <div class="testimonial-profile-img">
                                <img src="{{ asset('assets/img/vcard25/testimonial-profile-img.png') }}"
                                    class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 text-sm-start text-center">
                                <div class="">
                                    <div class="quote-img text-center mb-3">
                                        <img src="{{ asset('assets/img/vcard25/quote-img.png') }}" alt="quote-img"
                                            class="mx-auto" loading="lazy"/>
                                    </div>
                                    <h3 class="text-white fs-20 fw-6 mb-1">
                                        Cameron Williamson
                                    </h3>
                                    <p class="fs-14 text-white">- Social Work</p>
                                    <p class="desc text-white fs-14">
                                        Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. Lorem Ipsum is simply dummy text of the
                                        printing and type setting industry
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-section pt-60">
                <div class="blog-bg-vector1">
                    <img src="{{ asset('assets/img/vcard25/blog-bg-vector1.png') }}" alt="blog-bg-vector" loading="lazy"/>
                </div>
                <div class="blog-bg-vector2">
                    <img src="{{ asset('assets/img/vcard25/blog-bg-vector2.png') }}" alt="blog-bg-vector" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="mb-0">Blog</h2>
                </div>
                <div class="blog-content">
                    <div class="content position-relative">
                        <div class="blog-vector">
                            <img src="{{ asset('assets/img/vcard25/blog-vector.png') }}" alt="log-vector" loading="lazy"/>
                        </div>
                        <div class="text">
                            <h3 class="text-white">Social welfare</h3>
                            <p class="text-white mb-0">
                                Lorem Ipsum is simply dummy text of the printing and type
                                setting industry. Lorem Ipsum
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="business-hour-section pt-60 px-40">
                <div class="business-hour-bg">
                    <img src="{{ asset('assets/img/vcard25/business-hour-bg.png') }}" alt="bg-img" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="mb-0">Business Hours</h2>
                </div>
                <div class="business-hours">
                    <div class="business-hour-vector1">
                        <img src="{{ asset('assets/img/vcard25/business-hour-vector.png') }}" alt="vector" loading="lazy"/>
                    </div>
                    <div class="business-hour-vector2">
                        <img src="{{ asset('assets/img/vcard25/business-hour-vector.png') }}" alt="vector" loading="lazy"/>
                    </div>
                    <div class="mb-10 d-flex justify-content-between">
                        <span>Sunday:</span>
                        <span>08:10 - 20:00</span>
                    </div>
                    <div class="mb-10 d-flex justify-content-between align-items-center">
                        <span>Monday:</span>
                        <span>08:10 - 20:00</span>
                    </div>
                    <div class="mb-10 d-flex justify-content-between align-items-center">
                        <span>Tuesday:</span>
                        <span>08:10 - 20:00</span>
                    </div>
                    <div class="mb-10 d-flex justify-content-between align-items-center">
                        <span>Wednesday:</span>
                        <span>08:10 - 20:00</span>
                    </div>
                    <div class="mb-10 d-flex justify-content-between align-items-center">
                        <span>Thursday:</span>
                        <span>08:10 - 20:00</span>
                    </div>
                    <div class="mb-10 d-flex justify-content-between align-items-center">
                        <span>Friday:</span>
                        <span>08:10 - 20:00</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Saturday:</span>
                        <span>Closed</span>
                    </div>
                </div>
            </div>
            <div class="qr-code-section pt-60 px-40">
                <div class="section-heading mb-40 pb-40 text-center">
                    <h2 class="mb-0">QR Code</h2>
                </div>
                <div class="qr-code mx-auto position-relative">
                    <div class="qr-bg-img text-end">
                        <img src="{{ asset('assets/img/vcard25/qr-code-bg.png') }}" alt="qr-bg-img" loading="lazy"/>
                    </div>
                    <div class="qr-profile-img">
                        <img src="{{ asset('assets/img/vcard25/qr-profile-img.png') }}"
                            class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                    <div class="qr-code-img mx-auto">
                        <img src="{{ asset('assets/img/vcard25/qr-code.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                </div>
            </div>
            <div class="contact-us-section pt-60 px-30 position-relative">
                <div class="contact-bg-img">
                    <img src="{{ asset('assets/img/vcard25/contact-bg.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="mb-0">Inquiries</h2>
                </div>
                <div class="contact-form">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="mb-1 fs-16 fw-5">Your Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your name" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1 fs-16 fw-5">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter email address" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1 fs-16 fw-5">Phone</label>
                                    <input type="tel" class="form-control" placeholder="Enter Mobile No." />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="mb-1 fs-16 fw-5">Your Message</label>
                                    <textarea class="form-control h-100" placeholder="Type a Message..." rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button class="btn btn-primary w-100" type="submit">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="create-vcard-section pt-100">
                <div class="create-vcard-img1">
                    <img src="{{ asset('assets/img/vcard25/create-vcard-img1.png') }}" alt="create-vcard-img" loading="lazy"/>
                </div>
                <div class="create-vcard-img2 text-end">
                    <img src="{{ asset('assets/img/vcard25/create-vcard-img2.png') }}" alt="create-vcard-img" loading="lazy"/>
                </div>
                <div class="bg-light pt-60 pb-60 px-30">
                    <div class="section-heading text-center mb-40">
                        <h2 class="mb-0">Create Your VCard</h2>
                    </div>
                    <div class="px-sm-3 pb-30 mb-4">
                        <div class="vcard-link-card card">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="https://vcards.infyom.com/marlonbrasil"
                                    class="text-secondary link-text fw-5">https://vcards.infyom.com/marlonbrasil</a>
                                <i class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-to-contact-section pb-30">
                <div class="text-center">
                    <button class="btn btn-primary">Add to Contact</button>
                </div>
            </div>
            <div class="btn-section cursor-pointer">
                <div class="fixed-btn-section">
                    <div class="bars-btn social-services-bars-btn">
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
                    </div>
                    <div class="sub-btn">
                        <div class="social-btn social-services-sub-btn wp-btn">
                            <i class="fa-brands fa-whatsapp text-primary"></i>
                        </div>
                        <div class="social-btn social-services-sub-btn wp-btn mt-3">
                            <i class="fa-solid fa-share-nodes text-primary"></i>
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
            arrows: false,
            infinite: true,
            dots: true,
            slidesToShow: 2,
            autoplay: true,
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                },
            }, ],
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
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            // prevArrow:
            //   '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left"></i></button>',
            // nextArrow:
            //   '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    arrows: false,
                    dots: true,
                },
            }, ],
        });
    });
</script>

</html>
