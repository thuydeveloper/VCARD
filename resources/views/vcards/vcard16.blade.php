<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>lawyers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Bootstrap CSS -->
      <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

      {{-- css link --}}
      <link rel="stylesheet" href="{{ asset('assets/css/vcard16.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
</head>

<body>
    <div class="container p-0">
        <div class="main-content mx-auto w-100 overflow-hidden">
            <div class="banner-section w-100">
                <div class="banner-img">
                    <img src="{{ asset('assets/img/vcard16/banner.png') }}" class="object-fit-cover w-100 h-100" loading="lazy"/>

            <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
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
            </div>
            <div class="profile-section pb-50  bg-primary">
                <div class="row justify-content-end ">
                    <div class="col-sm-8">
                        <div class="card flex-sm-row">
                            <div class="card-img d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/img/vcard16/profile.png') }}" class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0 text-center">
                                <div class="profile-name">
                                    <h2 class=" text-primary fs-28 fw-bold mb-1">
                                        Mary Arden
                                    </h2>
                                    <p class="fs-18 text-primary mb-0">Lawyer</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="social-media mt-sm-0 mt-40 mb-40 d-flex justify-content-center">
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <i class="fa-brands fa-facebook "></i>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>

                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.166748 21.8325C0.200617 21.7072 0.219971 21.6253 0.244164 21.5434C0.708657 19.8615 1.17315 18.1844 1.62797 16.5026C1.66184 16.3725 1.64248 16.1942 1.57958 16.0785C-0.525153 12.1606 -0.147752 7.54869 2.70211 4.13195C5.29069 1.01399 8.66794 -0.263067 12.6935 0.291129C15.2966 0.652562 17.4449 1.89589 19.1819 3.85244C22.5737 7.68363 22.714 13.4232 19.5642 17.4953C16.4676 21.5 10.8162 22.806 6.28257 20.5362C5.99227 20.3916 5.7455 20.3675 5.43584 20.4542C3.77625 20.9024 2.11665 21.3265 0.452218 21.7602C0.374802 21.7795 0.292548 21.7988 0.166748 21.8325ZM5.52777 8.49323C5.60519 8.85949 5.65841 9.23537 5.76002 9.59681C5.96807 10.3197 6.40353 10.9221 6.83416 11.5244C8.32441 13.6063 10.2066 15.158 12.7129 15.8809C13.758 16.1797 14.7402 16.1411 15.6644 15.4906C16.3079 15.0376 16.5159 14.4063 16.5063 13.6738C16.5063 13.5533 16.4095 13.3798 16.3079 13.3268C15.5821 12.9605 14.8467 12.6087 14.1064 12.2714C13.8161 12.1365 13.6806 12.1943 13.4822 12.4497C13.2258 12.7726 12.9693 13.0907 12.7081 13.4039C12.5629 13.5822 12.3839 13.6448 12.1516 13.5533C10.5404 12.9172 9.30662 11.8473 8.43085 10.363C8.31473 10.1703 8.32441 10.0112 8.47924 9.84258C8.66794 9.63536 8.84696 9.4185 9.02115 9.19682C9.24372 8.90768 9.29694 8.60889 9.13243 8.2571C8.89535 7.75591 8.70181 7.23545 8.48408 6.72463C8.15506 5.93911 8.15506 5.91984 7.29381 5.94875C7.06157 5.95839 6.78577 6.04513 6.61643 6.19452C5.91969 6.79209 5.56648 7.56315 5.52777 8.49323Z" />
                        </svg>

                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>
                <div class="desc px-30">
                    <p class="text-gray-100 text-center mb-0">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book.
                    </p>
                </div>
            </div>

            <div class="contact-section  pt-40">
                <div class="section-heading left-heading">
                    <h2 class=""> Contact</h2>
                </div>


                <div class="row align-items-center px-sm-0 px-30">
                    <div class="col-sm-6">
                        <div class="contact-img text-sm-end text-center">
                            <img src="{{ asset('assets/img/vcard16/contact-lawyer-img.png') }}" class="h-100" loading="lazy">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row mb-sm-0 mb-4">
                            <div class="col-12 mb-10">
                                <div class="contact-box d-flex align-items-center">
                                    <div class="contact-icon d-flex justify-content-center align-items-center">
                                        <svg width="33" height="25" viewBox="0 0 33 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_167_364)">
                                                <path
                                                    d="M16.5316 -0.000601519C20.7337 -0.000601519 24.9274 -0.00893763 29.1296 0.00773459C29.6792 0.00773459 30.2372 0.0660874 30.7699 0.182793C31.7253 0.399532 32.3848 0.999732 32.7991 1.86669C33.1626 2.62527 33.0443 3.04208 32.334 3.48389C31.4124 4.05908 30.4824 4.62594 29.5608 5.20113C25.5362 7.72697 21.5116 10.2361 17.5039 12.7787C16.7768 13.2455 16.2018 13.2288 15.4747 12.7703C10.5961 9.67762 5.69223 6.62661 0.796766 3.55892C0.695305 3.49223 0.58539 3.43388 0.492385 3.36719C0.0104478 3.04208 -0.0825576 2.78366 0.086543 2.24181C0.50084 0.908034 1.53235 0.132776 3.0458 0.0494151C3.65457 0.0160707 4.26333 0.0160707 4.86364 0.00773459C8.75295 0.00773459 12.6423 0.00773459 16.5316 -0.000601519C16.5316 0.00773459 16.5316 -0.000601519 16.5316 -0.000601519Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M16.4622 25C12.1924 25 7.93102 25.0084 3.66123 24.9917C3.12856 24.9917 2.57898 24.9333 2.06323 24.7916C1.02326 24.4998 0.380676 23.7746 0.0678394 22.7659C-0.0928063 22.2408 0.000199096 21.9823 0.482136 21.6822C4.42218 19.2398 8.36223 16.7973 12.3023 14.3548C12.7166 14.0964 13.1562 14.0964 13.5705 14.3381C14.3146 14.7716 15.0417 15.2218 15.7688 15.6802C16.3691 16.0637 16.6228 16.072 17.2062 15.6969C17.9756 15.2051 18.7535 14.7299 19.5229 14.2381C19.9372 13.9713 20.3092 14.0547 20.6897 14.2964C21.9495 15.0967 23.2093 15.8886 24.4775 16.6806C27.0648 18.2978 29.6605 19.8983 32.2477 21.5155C33.0425 22.0074 33.1693 22.4158 32.7804 23.2411C32.2477 24.3581 31.2838 24.8333 30.1086 24.975C29.8127 25.0084 29.5167 25.0084 29.2208 25.0084C24.9679 25 20.715 25 16.4622 25Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M0.0600586 19.2064C0.0600586 14.7216 0.0600586 10.3118 0.0600586 5.82697C3.62808 8.06938 7.14538 10.2701 10.7219 12.5125C7.15383 14.7549 3.63654 16.964 0.0600586 19.2064Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M22.3044 12.5125C25.864 10.2784 29.3813 8.06938 32.9493 5.82697C32.9493 10.2951 32.9493 14.6966 32.9493 19.1897C29.3898 16.964 25.8725 14.7549 22.3044 12.5125Z"
                                                    fill="#1F1F1F" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_167_364">
                                                    <rect width="33" height="25" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-primary fw-5 mb-0 fs-12">E-mail address</p>
                                        <a href="braxtonreyes@gmail.com"
                                            class="text-primary fw-6 mb-0 fs-14">braxtonreyes@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-10">
                                <div class="contact-box d-flex align-items-center">
                                    <div class="contact-icon d-flex justify-content-center align-items-center">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.24875 11.2533C7.38447 15.3496 10.4178 18.4566 14.4261 20.5898C14.5964 20.6825 14.9988 20.5743 15.169 20.4197C16.0821 19.5541 16.9797 18.673 17.8464 17.761C18.3261 17.2509 18.8523 17.1736 19.5178 17.2973C21.0964 17.5755 22.6904 17.8537 24.2845 18.0392C25.5535 18.1938 26.0023 18.6112 26.0023 19.9096C26.0023 21.3008 26.0023 22.6766 26.0023 24.0678C26.0023 25.5672 25.5226 26.0309 23.9904 26C13.0952 25.8145 3.34518 18.0856 0.776133 7.48157C0.327324 5.61118 0.188038 3.64804 0.0177999 1.71581C-0.0905334 0.571938 0.54399 0.0154578 1.68923 0.0154578C3.2059 0 4.72256 0 6.23923 0C7.35351 0 7.8178 0.510107 7.95709 1.62307C8.17375 3.26159 8.4678 4.90012 8.77732 6.52319C8.90113 7.21879 8.77732 7.77527 8.26661 8.26992C7.24518 9.25922 6.2547 10.2485 5.24875 11.2533Z"
                                                fill="#1F1F1F" />
                                        </svg>

                                    </div>

                                    <div class="contact-desc">
                                        <p class="text-primary fw-5 mb-0 fs-12">Mobile Number</p>
                                        <a href="tel:+49 95864 12484" class="text-primary fw-6 mb-0 fs-14">+49 95864
                                            12484</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-10">
                                <div class="contact-box d-flex align-items-center">
                                    <div class="contact-icon d-flex justify-content-center align-items-center">
                                        <svg width="30" height="26" viewBox="0 0 30 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_167_406)">
                                                <path
                                                    d="M0.390531 26C0.264533 25.7615 0.0629374 25.5355 0.0251381 25.2844C-0.0378606 24.8324 0.0251381 24.3679 -6.1387e-05 23.916C-0.0126611 23.5017 0.163735 23.2883 0.592127 23.3008C0.718124 23.3008 0.844122 23.3008 0.970119 23.3008C10.3317 23.3008 19.6807 23.3008 29.0424 23.3134C29.3574 23.3134 29.6723 23.4389 29.9873 23.5017C29.9873 24.3303 29.9873 25.1714 29.9873 26C20.1343 26 10.2561 26 0.390531 26Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M15.0315 10.6461C18.3957 10.6461 21.7598 10.6461 25.1365 10.6461C27.0391 10.6461 27.9715 11.5877 27.9841 13.4959C27.9841 13.521 27.9841 13.5336 27.9841 13.5587C28.2109 14.6635 27.6943 15.2912 26.7115 15.718C25.7161 16.1449 24.7585 16.2328 23.8892 15.492C23.4608 15.128 23.108 14.6886 22.7552 14.2492C22.289 13.6842 21.848 13.6717 21.3692 14.2241C21.0542 14.5881 20.7392 14.9522 20.3864 15.2661C19.391 16.1574 18.2949 16.2579 17.1735 15.5423C16.6695 15.2159 16.2159 14.8016 15.7749 14.3873C15.1701 13.8223 14.9055 13.8223 14.3133 14.4124C13.9731 14.7513 13.6204 15.0778 13.2298 15.354C11.9068 16.3081 10.7098 16.2453 9.47504 15.1907C9.28604 15.0275 9.10965 14.8518 8.94585 14.6635C8.10167 13.6968 7.92527 13.6968 7.08109 14.7011C5.93451 16.057 4.48554 16.3583 2.87277 15.6301C2.24278 15.3414 2.00339 14.902 2.06639 14.2492C2.10419 13.9353 2.14199 13.6215 2.10419 13.3201C1.88999 11.776 3.13737 10.621 4.75013 10.6335C8.16467 10.6712 11.5918 10.6461 15.0315 10.6461Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M27.7321 21.606C19.2525 21.606 10.8107 21.606 2.33105 21.606C2.33105 20.2878 2.33105 18.9696 2.33105 17.6012C4.43521 18.3042 6.27478 17.8522 7.78675 16.2327C10.3067 18.6432 12.625 18.3168 15.0568 16.1574C18.0681 18.7687 20.2353 18.1661 22.2891 16.1198C22.982 16.8605 23.738 17.5384 24.7712 17.802C25.7918 18.0657 26.7494 17.8522 27.7573 17.4254C27.7321 18.8315 27.7321 20.1874 27.7321 21.606Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M13.2297 9.46596C13.2297 8.22308 13.2171 7.00531 13.2423 5.77499C13.2549 5.37325 13.5447 5.13472 13.9605 5.13472C14.6535 5.12217 15.3465 5.12217 16.0269 5.13472C16.5056 5.13472 16.7828 5.41092 16.7828 5.87542C16.808 7.05553 16.7954 8.24819 16.7954 9.46596C15.5985 9.46596 14.4393 9.46596 13.2297 9.46596Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M15.0188 0C15.3212 0.55239 15.674 1.18011 16.0142 1.82038C16.1654 2.10913 16.367 2.39788 16.4552 2.71173C16.6442 3.40222 16.3418 4.15548 15.8 4.45678C15.2582 4.75809 14.4266 4.67021 13.9856 4.26847C13.5194 3.82907 13.3682 2.98793 13.6958 2.37277C14.1242 1.54418 14.5904 0.740705 15.0188 0Z"
                                                    fill="#1F1F1F" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_167_406">
                                                    <rect width="30" height="26" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-primary fw-5 mb-0 fs-12">date Of Birth</p>
                                        <p class="text-primary fw-6 fs-14 mb-0">4 June 2022</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-10">
                                <div class="contact-box d-flex align-items-center">
                                    <div class="contact-icon d-flex justify-content-center align-items-center">
                                        <svg width="20" height="26" viewBox="0 0 20 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_167_414)">
                                                <path
                                                    d="M9.99348 21.3251C9.65861 20.9328 9.33688 20.5605 9.02171 20.1849C7.32112 18.1393 5.71245 16.0232 4.32046 13.7461C3.69341 12.7233 3.14515 11.6602 2.67568 10.5502C1.81225 8.50119 1.95999 6.48571 2.91206 4.53395C4.14318 2.01209 6.16222 0.509702 8.89368 0.0905097C13.0959 -0.55337 17.088 2.45811 17.7742 6.71375C17.9974 8.10882 17.784 9.41671 17.2489 10.6978C16.6514 12.1264 15.8799 13.4544 15.0394 14.7388C13.5391 17.0259 11.8615 19.1688 10.0756 21.2279C10.0559 21.2514 10.0329 21.2782 9.99348 21.3251ZM13.9429 7.37105C13.9462 5.151 12.1734 3.34344 9.99676 3.34344C7.81685 3.34344 6.04732 5.14765 6.04732 7.36769C6.04732 9.58774 7.81685 11.3953 9.99348 11.3953C12.1701 11.3953 13.9396 9.59444 13.9429 7.37105Z"
                                                    fill="#1F1F1F" />
                                                <path
                                                    d="M6.92352 18.592C6.54269 18.649 6.16515 18.7027 5.79088 18.7698C4.66153 18.9676 3.55517 19.246 2.51117 19.7457C2.10408 19.9435 1.71669 20.1716 1.39824 20.5036C0.886091 21.0401 0.886091 21.5901 1.41137 22.1166C1.85786 22.566 2.41268 22.8276 2.98721 23.0556C4.10014 23.4916 5.26232 23.7297 6.44092 23.8906C8.066 24.1153 9.70093 24.169 11.3391 24.0885C13.1743 23.9979 14.9898 23.7632 16.7397 23.1529C17.2584 22.9718 17.764 22.7571 18.2105 22.4218C18.4107 22.2709 18.6044 22.0965 18.7587 21.8986C19.0575 21.5163 19.0673 21.0904 18.7587 20.7182C18.5486 20.4633 18.2892 20.2319 18.0135 20.0508C17.242 19.5444 16.3753 19.256 15.4888 19.0481C14.7535 18.8771 14.0082 18.7664 13.2663 18.6289C13.2006 18.6155 13.1382 18.6054 13.0726 18.5954C13.194 18.3338 13.217 18.3271 13.4829 18.3472C14.5795 18.4344 15.6727 18.5551 16.7462 18.8C17.3306 18.9307 17.9084 19.0884 18.437 19.3734C18.7686 19.5511 19.0969 19.7591 19.3693 20.0139C20.0686 20.6712 20.1934 21.5834 19.7469 22.4419C19.5072 22.9047 19.156 23.2702 18.7554 23.5888C17.8822 24.283 16.8874 24.7424 15.8434 25.0945C13.6471 25.8357 11.3851 26.0805 9.08045 25.9799C7.31091 25.8994 5.58077 25.6076 3.90645 24.9973C2.87559 24.6217 1.89397 24.1522 1.05352 23.4144C0.685829 23.0925 0.373944 22.7169 0.176964 22.2575C-0.154618 21.4828 -0.00360029 20.6645 0.57749 20.0642C1.06337 19.5612 1.67729 19.2829 2.31748 19.0649C3.19404 18.7664 4.10014 18.6122 5.01281 18.4981C5.5184 18.4344 6.02398 18.3975 6.53284 18.3439C6.77907 18.3204 6.79876 18.3338 6.92352 18.592Z"
                                                    fill="#1F1F1F" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_167_414">
                                                    <rect width="20" height="26" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-primary fw-5 mb-0 fs-12">Address</p>
                                        <p class="text-primary fw-6 fs-14 mb-0">New York, USA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="appointment-section pt-50  pb-50 bg-primary">
                <div class="section-heading right-heading mb-40">
                    <h2 class="">Make An Appointment</h2>
                </div>
                <div class="appointment   px-30">
                    <form action="">
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="text-white fw-5 mb-2">Date:</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control appointment-input" />
                                    <span class="calendar-icon">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_102_145)">
                                                <path
                                                    d="M14.25 1.5H13.5V0.75C13.5 0.551088 13.421 0.360322 13.2803 0.21967C13.1397 0.0790176 12.9489 0 12.75 0C12.5511 0 12.3603 0.0790176 12.2197 0.21967C12.079 0.360322 12 0.551088 12 0.75V1.5H6V0.75C6 0.551088 5.92098 0.360322 5.78033 0.21967C5.63968 0.0790176 5.44891 0 5.25 0C5.05109 0 4.86032 0.0790176 4.71967 0.21967C4.57902 0.360322 4.5 0.551088 4.5 0.75V1.5H3.75C2.7558 1.50119 1.80267 1.89666 1.09966 2.59966C0.396661 3.30267 0.00119089 4.2558 0 5.25L0 14.25C0.00119089 15.2442 0.396661 16.1973 1.09966 16.9003C1.80267 17.6033 2.7558 17.9988 3.75 18H14.25C15.2442 17.9988 16.1973 17.6033 16.9003 16.9003C17.6033 16.1973 17.9988 15.2442 18 14.25V5.25C17.9988 4.2558 17.6033 3.30267 16.9003 2.59966C16.1973 1.89666 15.2442 1.50119 14.25 1.5ZM1.5 5.25C1.5 4.65326 1.73705 4.08097 2.15901 3.65901C2.58097 3.23705 3.15326 3 3.75 3H14.25C14.8467 3 15.419 3.23705 15.841 3.65901C16.2629 4.08097 16.5 4.65326 16.5 5.25V6H1.5V5.25ZM14.25 16.5H3.75C3.15326 16.5 2.58097 16.2629 2.15901 15.841C1.73705 15.419 1.5 14.8467 1.5 14.25V7.5H16.5V14.25C16.5 14.8467 16.2629 15.419 15.841 15.841C15.419 16.2629 14.8467 16.5 14.25 16.5Z"
                                                    fill="
                              #ADADAD" />
                                                <path
                                                    d="M9 12.375C9.62132 12.375 10.125 11.8713 10.125 11.25C10.125 10.6287 9.62132 10.125 9 10.125C8.37868 10.125 7.875 10.6287 7.875 11.25C7.875 11.8713 8.37868 12.375 9 12.375Z"
                                                    fill="
                              #ADADAD" />
                                                <path
                                                    d="M5.25 12.375C5.87132 12.375 6.375 11.8713 6.375 11.25C6.375 10.6287 5.87132 10.125 5.25 10.125C4.62868 10.125 4.125 10.6287 4.125 11.25C4.125 11.8713 4.62868 12.375 5.25 12.375Z"
                                                    fill="
                              #ADADAD" />
                                                <path
                                                    d="M12.75 12.375C13.3713 12.375 13.875 11.8713 13.875 11.25C13.875 10.6287 13.3713 10.125 12.75 10.125C12.1287 10.125 11.625 10.6287 11.625 11.25C11.625 11.8713 12.1287 12.375 12.75 12.375Z"
                                                    fill="
                              #ADADAD" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_102_145">
                                                    <rect width="18" height="18" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    </span>
                                </div>

                            </div>
                            <div class="col-12">
                                <label class="text-white mb-2">Hour:</label>
                                <div class="row">
                                    <div class="col-sm-6 mb-20">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-white">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-20">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-white">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-20">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-white">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-20">
                                        <div class="hour-input d-flex justify-content-center align-items-center">
                                            <span class="text-white">8:10 - 20:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-2">
                                <button class="btn btn-white">Make An Appointment</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="our-services-section pt-40 pb-60">
                <div class="section-heading left-heading mb-40">
                    <h2 class="">
                        Our Services
                    </h2>
                </div>
                <div class="services-bg">
                    <img src="{{ asset('assets/img/vcard16/services-bg.png') }}" alt="" class="" loading="lazy">
                </div>
                <div class="services px-30">
                    <div class="row">
                        <div class="col-sm-6 mb-sm-0 mb-40">
                            <div class="service-card card h-100 align-items-center">
                                <div class="card-img d-flex justify-content-center align-items-center object-fit-cover">
                                    <img src="{{ asset('assets/img/vcard16/service-img.png') }}" alt="" class="" loading="lazy"/>
                                </div>
                                <div class="card-body text-center p-0">
                                    <h3 class="card-title fs-18 fw-6 text-primary">Web Design</h3>
                                    <p class="mb-0 fw-5 text-gray-300">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card card h-100 align-items-center">
                                <div class="card-img d-flex justify-content-center align-items-center mb-4">
                                    <img src="{{ asset('assets/img/vcard16/service-img.png') }}" alt="" class="" loading="lazy"/>
                                </div>
                                <div class="card-body text-center p-0">
                                    <h3 class="card-title fs-18 fw-6 text-primary">Branding Design</h3>
                                    <p class="mb-0 fw-5 text-gray-300">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery-section bg-primary position-relative pt-60 pb-60">

                <div class="gallery-bg text-end position-absolute">
                    <img src="{{ asset('assets/img/vcard16/gallery-bg.png') }}" class="h-100" loading="lazy">
                </div>
                <div class="row h-100 align-items-center flex-sm-row flex-column-reverse pt-sm-0 pt-60">
                    <div class="col-sm-6 p-0">
                        <div class="gallery-slider">
                            <div class="">
                                <div class="gallery-images">
                                    <div class="gallery-img img-2 ms-sm-auto me-sm-0 mx-auto">
                                        <img src="{{ asset('assets/img/vcard16/gallery-img1.png') }}"
                                            class="img-fluid h-100 object-fit-cover" loading="lazy">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="gallery-images">
                                    <div class="gallery-img img-2 ms-sm-auto me-sm-0 mx-auto">
                                        <img src="{{ asset('assets/img/vcard16/gallery-img2.png') }}"
                                            class="img-fluid h-100 object-fit-cover" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 overflow-hidden">
                        <div class="section-heading right-heading">
                            <h2 class="">
                                Gallery
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section pt-40 pb-30">
                <div class="section-heading left-heading ">
                    <h2 class="">
                        Products
                    </h2>
                </div>
                <div class="product-slider px-4">
                    <div class="">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard16/product-img1.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="product-desc card-body d-flex align-items-center justify-content-between">
                                <div class="product-title">
                                    <h3 class="text-primary fs-18 fw-7 mb-0">Judiciary</h3>
                                    <p class="fs-14 fw-6 text-gray-300 mb-0">Lorem Ipsum </p>
                                </div>
                                <div class="product-amount text-primary fw-7 fs-18">$ 120</div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard16/product-img2.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="product-desc card-body d-flex align-items-center justify-content-between">
                                <div class="product-title">
                                    <h3 class="text-primary fs-18 fw-7 mb-0">Judge Hamer</h3>
                                    <p class="fs-14 fw-6 text-gray-300 mb-0">Lorem Ipsum </p>
                                </div>
                                <div class="product-amount text-primary fw-7 fs-18">$ 120</div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard16/product-img1.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="product-desc card-body d-flex align-items-center justify-content-between">
                                <div class="product-title">
                                    <h3 class="text-primary fs-18 fw-7 mb-0">Judiciary</h3>
                                    <p class="fs-14 fw-6 text-gray-300 mb-0">Lorem Ipsum </p>
                                </div>
                                <div class="product-amount text-primary fw-7 fs-18">$ 120</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-section pt-40 pb-50 bg-gray-200">
                <div class="section-heading right-heading mb-4">
                    <h2 class="bg-primary text-white">
                        Blog
                    </h2>
                </div>
                <div class="blog-slider px-4">
                    <div class="">
                        <div class="blog-card card flex-sm-row align-items-center">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard16/gallery-img3.png') }}" class="img-fluid h-100 object-fit-cover" loading="lazy">
                            </div>
                            <div class="card-body p-0 text-sm-start text-center">
                                <h6 class="card-title text-primary fw-7 fs-18">Court</h6>
                                <p class="mb-0 fw-5 fs-12 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="blog-card card flex-sm-row align-items-center">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard16/gallery-img3.png') }}" class="img-fluid h-100 object-fit-cover" loading="lazy">
                            </div>
                            <div class="card-body p-0 text-sm-start text-center">
                                <h6 class="card-title text-primary fw-7 fs-18">Court</h6>
                                <p class="mb-0 fw-5 fs-12 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="blog-card card flex-sm-row align-items-center">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard16/gallery-img3.png') }}" class="img-fluid h-100 object-fit-cover" loading="lazy">
                            </div>
                            <div class="card-body p-0 text-sm-start text-center">
                                <h6 class="card-title text-primary fw-7 fs-18">Court</h6>
                                <p class="mb-0 fw-5 fs-12 text-gray-100">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took.
                                </p>
                            </div>
                        </div>
                    </div>
              </div>
                <div class="blog-bg">
                    <img src="../images/lawyers/blog-bg-img.png" loading="lazy">
                </div>
            </div>
            <div class="testimonial-section pt-40 pb-50 bg-primary position-relative">
                <div class="section-heading left-heading mb-40">
                    <h2 class="bg-white text-primary">
                        Testimonials
                    </h2>
                </div>
                <div class="testimonial-slider px-30 ">
                    <div class="">
                        <div class="testimonial-card">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard16/testimonial-img.png') }}" alt="testimonial"
                                    class="w-100 h-100 object-fit-cover" loading="lazy">
                            </div>
                            <div class="card-body p-0  text-center">
                                <p class="text-gray-100 fw-5 mb-20">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text.
                                </p>
                                <h6 class="card-title fs-20 fw-7 mb-0 text-white">
                                    Perry Madison
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="testimonial-card">
                            <div class="card-img">
                                <img src="{{ asset('assets/img/vcard16/testimonial-img.png') }}" alt="testimonial"
                                    class="w-100 h-100 object-fit-cover" loading="lazy">
                            </div>
                            <div class="card-body p-0  text-center">
                                <p class="text-gray-100 fw-5 mb-20">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text.
                                </p>
                                <h6 class="card-title fs-20 fw-7 mb-0 text-white">
                                    Perry Madison
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-bg-img">
                    <img src="{{ asset('assets/img/vcard16/testimonial-bg-img.png') }}" loading="lazy"/>
                </div>

            </div>
            <div class="qr-code-section pt-40 pb-50 position-relative">

                <div class="section-heading right-heading pb-40">
                    <h2 class="bg-primary text-white">
                        QR Code
                    </h2>
                </div>
                <div class="px-30">
                    <div class="row align-items-center flex-sm-row flex-column-reverse justify-content-center">
                        <div class="col-sm-5">
                            <div
                                class="qr-code d-flex justify-content-center position-relative ms-sm-auto mx-auto mb-sm-0 mb-4">
                                <div class="qr-profile-img">
                                    <img src="{{ asset('assets/img/vcard16/qr-profile.png') }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="qr-code-img">
                                    <img src="{{ asset('assets/img/vcard16/qr-code.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="business-hour-section pt-40 pb-50 bg-primary">
                <div class="section-heading left-heading mb-40">
                    <h2 class="bg-white text-primary">
                        Business Hours
                    </h2>
                </div>
                <div class="px-30">
                    <div class="bussiness-hour-card">
                        <div class="mb-10 d-flex align-items-center justify-content-between">
                            <span class="me-2">Sunday:</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="mb-10 d-flex align-items-center justify-content-between">
                            <span class="me-2">Monday:</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="mb-10 d-flex align-items-center justify-content-between">
                            <span class="me-2">Tueday:</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="mb-10 d-flex align-items-center justify-content-between">
                            <span class="me-2">Wednesday:</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="mb-10 d-flex align-items-center justify-content-between">
                            <span class="me-2">Thursday:</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="mb-10 d-flex align-items-center justify-content-between">
                            <span class="me-2">Friday:</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="me-2">Saturday:</span>
                            <span>Closed</span>
                        </div>
                    </div>
                </div>
                <div class="business-hour-bg">
                    <img src="{{ asset('assets/img/vcard16/hour-bg-img.png') }}">
                </div>
            </div>

            <div class="contact-us-section pt-40 pb-50">
                <div class="section-heading right-heading pb-40">
                    <h2 class="bg-primary text-white">
                        Inquiries
                    </h2>
                </div>

                <div class="contact-form  px-30 position-relative">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name" />
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address" />
                                </div>
                                <div class="mb-3">
                                    <input type="tel" class="form-control" placeholder="Enter Phone Number" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    <textarea class="form-control h-100" placeholder="Type a message here..."
                                        rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button class="btn btn-primary w-100" type="submit">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="create-vcard-section bg-primary pt-40 pb-50 ">
                <div class="section-heading left-heading mb-40">
                    <h2 class="bg-white text-primary">
                        Create Your Vcard
                    </h2>
                </div>
                <div class="vcard-link-card card mx-sm-5 mx-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="https://vcards.infyom.com/marlonbrasil"
                            class="fw-5 fs-18 text-white link-text">https://vcards.infyom.com/marlonbrasil</a>
                        <i class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="add-to-contact-section py-4 px-30 text-center">
                <div class="d-inline-block">
                    <a href=""
                        class="vcard16-sticky-btn add-contact-btn sticky-vcard16-div d-flex justify-content-center ms-0 align-items-center rounded px-5 text-decoration-none py-1 justify-content-center"><i
                            class="fas fa-download fa-address-book"></i>
                        &nbsp;{{ __('messages.setting.add_contact') }}</a>
                </div>
            </div>
            <div class="btn-section cursor-pointer">
                <div class="fixed-btn-section">
                    {{-- <div class="bars-btn lawyer-bars-btn">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <div class="social-btn lawyer-sub-btn wp-btn">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="social-btn lawyer-sub-btn wp-btn mt-3">
                            <i class="fa-solid fa-share-nodes"></i>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>
@include('vcardTemplates.template.templates')
<script src="https://js.stripe.com/v3/"></script>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>

<script>
    $().ready(function () {
        $(".gallery-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            speed: 300,
            infinite: true,
            autoplaySpeed: 5000,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        centerPadding: '125px',
                        dots: true,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerPadding: '0',
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
            arrows: true,
            infinite: true,
            dots: true,
            slidesToShow: 1,
            autoplay: true,
            prevArrow:
                '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left"></i></button>',
            nextArrow:
                '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right"></i></button>',
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        arrows: false,
                    },
                },
            ],
        });
        $(".blog-slider").slick({
            arrows: false,
            infinite: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        centerPadding: '0',
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
