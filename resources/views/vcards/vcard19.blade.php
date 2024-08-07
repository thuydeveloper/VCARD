<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fashion and Beauty</title>
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
     <link rel="stylesheet" href="{{ asset('assets/css/vcard19.css') }}">
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
          <div class="banner-img">
               <img src="{{ asset('assets/img/vcard19/banner-img.png') }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
          </div>
          <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
            <div class="language pt-3 me-2">
                <ul class="text-decoration-none">
                    <li class="dropdown1 dropdown lang-list">
                        <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-language me-2"></i>Language</a>
                        <ul class="dropdown-menu start-0 lang-hover-list top-100 m-0">
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
        <div class="profile-section px-40">
          <div class="profile-bg-img">
            <img src="{{ asset('assets/img/vcard19/profile-bg-img.png') }}" loading="lazy"/>
          </div>
          <div
            class="card d-flex flex-sm-row align-items-sm-end align-items-center"
          >
            <div class="card-img me-sm-4">
              <img
                src="{{ asset('assets/img/vcard19/profile-img.png') }}"
                class="w-100 h-100 object-fit-cover"
                loading="lazy"
              />
            </div>
            <div class="card-body">
              <div class="profile-name">
                <h2 class="text-primary mb-0 fs-28">Kara Frederick</h2>
                <p class="fs-20 text-black mb-0 fw-5">Make-up Artist</p>
              </div>
            </div>
          </div>
          <p class="text-gray-100 profile-desc mb-40 fs-14 text-center">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type
            and scrambled it to make a type specimen book.
          </p>
        </div>
        <div class="contact-section pb-60">
          <div class="px-3 mx-1">
            <div class="row">
              <div class="col-sm-6 mb-40">
                <div class="contact-box d-flex align-items-center">
                  <div
                    class="contact-icon d-flex justify-content-center align-items-center"
                  >
                    <svg
                      width="33"
                      height="25"
                      viewBox="0 0 33 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_622_1084)">
                        <path
                          d="M16.5313 -0.000601519C20.7335 -0.000601519 24.9272 -0.00893763 29.1293 0.00773459C29.6789 0.00773459 30.2369 0.0660874 30.7696 0.182793C31.725 0.399532 32.3845 0.999732 32.7988 1.86669C33.1624 2.62527 33.044 3.04208 32.3338 3.48389C31.4122 4.05908 30.4821 4.62594 29.5605 5.20113C25.536 7.72697 21.5114 10.2361 17.5037 12.7787C16.7765 13.2455 16.2016 13.2288 15.4745 12.7703C10.5959 9.67762 5.69199 6.62661 0.796522 3.55892C0.695061 3.49223 0.585146 3.43388 0.492141 3.36719C0.0102037 3.04208 -0.0828018 2.78366 0.0862989 2.24181C0.500596 0.908034 1.53211 0.132776 3.04556 0.0494151C3.65432 0.0160707 4.26309 0.0160707 4.86339 0.00773459C8.75271 0.00773459 12.642 0.00773459 16.5313 -0.000601519C16.5313 0.00773459 16.5313 -0.000601519 16.5313 -0.000601519Z"
                          fill="#753422"
                        />
                        <path
                          d="M16.4619 25C12.1921 25 7.93078 25.0084 3.66098 24.9917C3.12832 24.9917 2.57874 24.9333 2.06298 24.7916C1.02301 24.4998 0.380432 23.7746 0.0675952 22.7659C-0.0930504 22.2408 -4.50443e-05 21.9823 0.481892 21.6822C4.42194 19.2398 8.36199 16.7973 12.302 14.3548C12.7163 14.0964 13.156 14.0964 13.5703 14.3381C14.3143 14.7716 15.0415 15.2218 15.7686 15.6802C16.3689 16.0637 16.6226 16.072 17.206 15.6969C17.9754 15.2051 18.7532 14.7299 19.5226 14.2381C19.9369 13.9713 20.3089 14.0547 20.6894 14.2964C21.9492 15.0967 23.209 15.8886 24.4773 16.6806C27.0645 18.2978 29.6602 19.8983 32.2475 21.5155C33.0422 22.0074 33.1691 22.4158 32.7801 23.2411C32.2475 24.3581 31.2836 24.8333 30.1083 24.975C29.8124 25.0084 29.5165 25.0084 29.2206 25.0084C24.9677 25 20.7148 25 16.4619 25Z"
                          fill="#753422"
                        />
                        <path
                          d="M0.0595703 19.2064C0.0595703 14.7216 0.0595703 10.3118 0.0595703 5.82697C3.6276 8.06938 7.14489 10.2701 10.7214 12.5125C7.15335 14.7549 3.63605 16.964 0.0595703 19.2064Z"
                          fill="#753422"
                        />
                        <path
                          d="M22.3047 12.5125C25.8643 10.2784 29.3816 8.06938 32.9496 5.82697C32.9496 10.2951 32.9496 14.6966 32.9496 19.1898C29.39 16.964 25.8727 14.7549 22.3047 12.5125Z"
                          fill="#753422"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_622_1084">
                          <rect width="33" height="25" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <a
                      href="mailto:jackie@gmail.com"
                      class="text-primary fs-14 fw-5"
                      >jackie@gmail.com</a
                    >
                    <p class="mb-0 fs-12 text-black">Email</p>
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
                        fill="#753422"
                      />
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <a href="tel:+1 4078461474" class="text-primary fs-14 fw-5"
                      >+1 4078461474</a
                    >
                    <p class="text-black fs-12 mb-0">Mobile Number</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mb-sm-0 mb-40">
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
                      <g clip-path="url(#clip0_55_141)">
                        <path
                          d="M0.390531 26C0.264533 25.7615 0.0629374 25.5355 0.0251381 25.2844C-0.0378606 24.8324 0.0251381 24.3679 -6.1387e-05 23.916C-0.0126611 23.5017 0.163735 23.2883 0.592127 23.3008C0.718124 23.3008 0.844122 23.3008 0.970119 23.3008C10.3317 23.3008 19.6807 23.3008 29.0424 23.3134C29.3574 23.3134 29.6723 23.4389 29.9873 23.5017C29.9873 24.3303 29.9873 25.1714 29.9873 26C20.1343 26 10.2561 26 0.390531 26Z"
                          fill="#753422"
                        />
                        <path
                          d="M15.0315 10.6461C18.3957 10.6461 21.7598 10.6461 25.1365 10.6461C27.0391 10.6461 27.9715 11.5877 27.9841 13.4959C27.9841 13.521 27.9841 13.5336 27.9841 13.5587C28.2109 14.6635 27.6943 15.2912 26.7115 15.718C25.7161 16.1449 24.7585 16.2328 23.8892 15.492C23.4608 15.128 23.108 14.6886 22.7552 14.2492C22.289 13.6842 21.848 13.6717 21.3692 14.2241C21.0542 14.5881 20.7392 14.9522 20.3864 15.2661C19.391 16.1574 18.2949 16.2579 17.1735 15.5423C16.6695 15.2159 16.2159 14.8016 15.7749 14.3873C15.1701 13.8223 14.9055 13.8223 14.3133 14.4124C13.9731 14.7513 13.6204 15.0778 13.2298 15.354C11.9068 16.3081 10.7098 16.2453 9.47504 15.1907C9.28604 15.0275 9.10965 14.8518 8.94585 14.6635C8.10167 13.6968 7.92527 13.6968 7.08109 14.7011C5.93451 16.057 4.48554 16.3583 2.87277 15.6301C2.24278 15.3414 2.00339 14.902 2.06639 14.2492C2.10419 13.9353 2.14199 13.6215 2.10419 13.3201C1.88999 11.776 3.13737 10.621 4.75013 10.6335C8.16467 10.6712 11.5918 10.6461 15.0315 10.6461Z"
                          fill="#753422"
                        />
                        <path
                          d="M27.7321 21.606C19.2525 21.606 10.8107 21.606 2.33105 21.606C2.33105 20.2878 2.33105 18.9696 2.33105 17.6012C4.43521 18.3042 6.27478 17.8522 7.78675 16.2327C10.3067 18.6432 12.625 18.3168 15.0568 16.1574C18.0681 18.7687 20.2353 18.1661 22.2891 16.1198C22.982 16.8605 23.738 17.5384 24.7712 17.802C25.7918 18.0657 26.7494 17.8522 27.7573 17.4254C27.7321 18.8315 27.7321 20.1874 27.7321 21.606Z"
                          fill="#753422"
                        />
                        <path
                          d="M13.2297 9.46596C13.2297 8.22308 13.2171 7.00531 13.2423 5.77499C13.2549 5.37325 13.5447 5.13472 13.9605 5.13472C14.6535 5.12217 15.3465 5.12217 16.0269 5.13472C16.5056 5.13472 16.7828 5.41092 16.7828 5.87542C16.808 7.05553 16.7954 8.24819 16.7954 9.46596C15.5985 9.46596 14.4393 9.46596 13.2297 9.46596Z"
                          fill="#753422"
                        />
                        <path
                          d="M15.0189 0C15.3213 0.55239 15.6741 1.18011
                        16.0143 1.82038C16.1655 2.10913 16.3671 2.39788 16.4553
                        2.71173C16.6443 3.40222 16.3419 4.15548 15.8001
                        4.45678C15.2583 4.75809 14.4267 4.67021 13.9857
                        4.26847C13.5196 3.82907 13.3684 2.98793 13.6959
                        2.37277C14.1243 1.54418 14.5905 0.740705 15.0189 0Z"
                          fill="#753422"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_55_141">
                          <rect width="30" height="26" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <p class="mb-0 text-primary fs-14 fw-5">12th June, 1990</p>
                    <p class="text-black mb-0 fs-12">Date of Birth</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
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
                      <g clip-path="url(#clip0_55_132)">
                        <path
                          d="M9.99348 21.3252C9.65861 20.9328 9.33688 20.5606 9.02171 20.185C7.32112 18.1393 5.71245 16.0232 4.32046 13.7462C3.69341 12.7233 3.14515 11.6603 2.67568 10.5502C1.81225 8.50122 1.95999 6.48574 2.91206 4.53398C4.14318 2.01212 6.16222 0.509733 8.89368 0.0905402C13.0959 -0.55334 17.088 2.45814 17.7742 6.71378C17.9974 8.10886 17.784 9.41674 17.2489 10.6978C16.6514 12.1264 15.8799 13.4544 15.0394 14.7388C13.5391 17.0259 11.8615 19.1688 10.0756 21.2279C10.0559 21.2514 10.0329 21.2782 9.99348 21.3252ZM13.9429 7.37108C13.9462 5.15103 12.1734 3.34347 9.99676 3.34347C7.81685 3.34347 6.04732 5.14768 6.04732 7.36772C6.04732 9.58777 7.81685 11.3953 9.99348 11.3953C12.1701 11.3953 13.9396 9.59447 13.9429 7.37108Z"
                          fill="#753422"
                        />
                        <path
                          d="M6.92352 18.592C6.54269 18.649 6.16515 18.7027 5.79088 18.7698C4.66153 18.9676 3.55517 19.246 2.51117 19.7457C2.10408 19.9435 1.71669 20.1716 1.39824 20.5036C0.886091 21.0401 0.886091 21.5901 1.41137 22.1166C1.85786 22.566 2.41268 22.8276 2.98721 23.0556C4.10014 23.4916 5.26232 23.7297 6.44092 23.8906C8.066 24.1153 9.70093 24.169 11.3391 24.0885C13.1743 23.9979 14.9898 23.7632 16.7397 23.1529C17.2584 22.9718 17.764 22.7571 18.2105 22.4218C18.4107 22.2709 18.6044 22.0965 18.7587 21.8986C19.0575 21.5163 19.0673 21.0904 18.7587 20.7182C18.5486 20.4633 18.2892 20.2319 18.0135 20.0508C17.242 19.5444 16.3753 19.256 15.4888 19.0481C14.7535 18.8771 14.0082 18.7664 13.2663 18.6289C13.2006 18.6155 13.1382 18.6054 13.0726 18.5954C13.194 18.3338 13.217 18.3271 13.4829 18.3472C14.5795 18.4344 15.6727 18.5551 16.7462 18.8C17.3306 18.9307 17.9084 19.0884 18.437 19.3734C18.7686 19.5511 19.0969 19.7591 19.3693 20.0139C20.0686 20.6712 20.1934 21.5834 19.7469 22.4419C19.5072 22.9047 19.156 23.2702 18.7554 23.5888C17.8822 24.283 16.8874 24.7424 15.8434 25.0945C13.6471 25.8357 11.3851 26.0805 9.08045 25.9799C7.31091 25.8994 5.58077 25.6076 3.90645 24.9973C2.87559 24.6217 1.89397 24.1522 1.05352 23.4144C0.685829 23.0925 0.373944 22.7169 0.176964 22.2575C-0.154618 21.4828 -0.00360029 20.6645 0.57749 20.0642C1.06337 19.5612 1.67729 19.2829 2.31748 19.0649C3.19404 18.7664 4.10014 18.6122 5.01281 18.4981C5.5184 18.4344 6.02398 18.3975 6.53284 18.3439C6.77907 18.3204 6.79876 18.3338 6.92352 18.592Z"
                          fill="#753422"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_55_132">
                          <rect width="20" height="26" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="contact-desc">
                    <p class="text-primary mb-0 fs-14 fw-5">New York, USA</p>
                    <p class="text-black fs-12 mb-0">Location</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="social-media d-flex justify-content-center">
          <div class="social-bg-img1">
            <img src="{{ asset('assets/img/vcard19/social-bg-img1.png') }}" loading="lazy"/>
          </div>
          <div class="social-bg-img2">
            <img src="{{ asset('assets/img/vcard19/social-bg-img2.png') }}" loading="lazy"/>
          </div>
          <div class="flex-1 d-flex justify-content-center">
            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="15"
                height="30"
                viewBox="0 0 15 30"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4.18589 16.9334C3.52047 16.9334 2.90951 16.9334 2.29856 16.9334C1.77748 16.9334 1.2564 16.9432 0.736229 16.9294C0.191547 16.9157 0.0136171 16.7394 0.00907804 16.1566C-0.00272341 14.6295 -0.00363122 13.1014 0.00998585 11.5743C0.0154327 10.9964 0.206072 10.8132 0.743492 10.8093C1.75115 10.8025 2.75882 10.8074 3.76739 10.8074C3.89085 10.8074 4.01431 10.8074 4.18589 10.8074C4.18589 10.6418 4.18407 10.4998 4.18589 10.3587C4.20949 8.96682 4.16047 7.56902 4.27122 6.18494C4.55173 2.6596 7.04547 0.1422 10.3245 0.0275941C11.6589 -0.0194235 12.997 0.0070239 14.3324 0.010942C14.8027 0.0119216 14.9933 0.219583 14.9951 0.72894C15.0015 2.15808 15.0015 3.5882 14.996 5.01734C14.9942 5.5649 14.8163 5.76374 14.2943 5.77648C13.3774 5.79998 12.4605 5.79998 11.5427 5.81566C10.5142 5.83231 10.0821 6.26624 10.0603 7.36234C10.0385 8.47019 10.0557 9.58001 10.0557 10.731C10.211 10.731 10.3317 10.731 10.4525 10.731C11.619 10.731 12.7855 10.729 13.952 10.7319C14.6874 10.7329 14.8599 10.9171 14.8608 11.6968C14.8617 13.1504 14.8635 14.605 14.8599 16.0586C14.858 16.709 14.6992 16.8844 14.0928 16.8873C12.7683 16.8932 11.4438 16.8893 10.0567 16.8893C10.0567 17.0597 10.0567 17.2115 10.0567 17.3624C10.0567 21.1865 10.0567 25.0116 10.0567 28.8357C10.0567 29.8897 9.95317 29.9994 8.96003 29.9994C7.65733 29.9994 6.35554 30.0013 5.05284 29.9984C4.35565 29.9974 4.18589 29.8162 4.18589 29.0717C4.18498 25.1859 4.18498 21.3001 4.18498 17.4153C4.18589 17.2713 4.18589 17.1273 4.18589 16.9334Z"
                  fill="#753422"
                />
              </svg>
            </a>
            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="30"
                height="30"
                viewBox="0 0 30 30"
                fill="none"
              >
                <path
                  d="M30 13.4708C30 14.0572 30 14.6429 30 15.2294C29.953 15.6155 29.9147 16.0023 29.8581 16.3869C29.4001 19.4975 28.0812 22.189 25.8728 24.4306C23.5055 26.8336 20.6362 28.2502 17.2838 28.6385C14.3527 28.9783 11.562 28.4645 8.93891 27.0986C8.75806 27.0046 8.60441 26.9679 8.39341 27.0435C6.84074 27.5999 5.28071 28.135 3.72436 28.6818C2.48193 29.1178 1.2417 29.5603 0 30C0.0257309 29.8774 0.0374936 29.7504 0.078663 29.633C0.997623 27.001 1.91511 24.3674 2.84878 21.7405C2.95832 21.433 2.95023 21.1944 2.79731 20.8964C1.388 18.1543 0.924106 15.2426 1.37623 12.2032C1.83057 9.14836 3.1502 6.49428 5.33659 4.30555C8.57941 1.05989 12.5206 -0.342743 17.0816 0.0704882C19.8539 0.321509 22.3469 1.34468 24.523 3.08788C27.3571 5.35735 29.1296 8.27272 29.7721 11.8545C29.8677 12.3896 29.925 12.932 30 13.4708ZM12.3479 11.8406C12.3663 11.8083 12.3692 11.798 12.3758 11.7914C12.7544 11.4097 13.1352 11.031 13.5109 10.6471C13.952 10.1957 13.952 9.71058 13.5065 9.26065C12.8669 8.61549 12.2244 7.97252 11.5774 7.33396C11.1216 6.88403 10.6416 6.88403 10.1872 7.33102C9.71377 7.7971 9.25797 8.28153 8.77276 8.73513C8.22359 9.24891 8.06038 9.87793 8.13463 10.5958C8.25888 11.7892 8.75144 12.8498 9.36016 13.8561C10.943 16.472 13.0426 18.5984 15.5914 20.2806C16.6221 20.961 17.7168 21.5189 18.9445 21.7669C19.8885 21.9578 20.7207 21.822 21.3912 21.0469C21.7735 20.6051 22.2168 20.2153 22.6299 19.7991C23.1034 19.3213 23.1027 18.8486 22.6255 18.3679C22.0198 17.7579 21.4096 17.1517 20.8008 16.5447C20.2421 15.9876 19.801 15.9861 19.2452 16.5403C18.8806 16.9043 18.5174 17.2698 18.1572 17.631C15.5407 16.3502 13.6183 14.4301 12.3479 11.8406Z"
                  fill="#753422"
                />
              </svg>
            </a>
            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="30"
                height="30"
                viewBox="0 0 30 30"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M29.9796 18.1639C29.9698 16.7715 29.831 15.3871 29.4262 14.0417C28.9197 12.3568 28.0015 11.0017 26.3637 10.2287C25.0984 9.63189 23.7491 9.46457 22.3704 9.50567C19.9571 9.57807 18.0045 10.5095 16.6991 12.6151C16.6844 12.6386 16.6453 12.6474 16.5632 12.6944C16.5632 11.7698 16.5632 10.8862 16.5632 10.0017C14.5557 10.0017 12.5972 10.0017 10.6436 10.0017C10.6436 16.6845 10.6436 23.3408 10.6436 30C12.7116 30 14.7464 30 16.834 30C16.834 29.817 16.834 29.6722 16.834 29.5264C16.834 26.4013 16.8252 23.2752 16.8409 20.1501C16.8438 19.4564 16.8888 18.7578 16.9875 18.0719C17.2574 16.1913 18.2137 15.1747 19.9503 14.9693C21.858 14.7442 23.1898 15.4399 23.5672 17.4878C23.7011 18.2157 23.7598 18.9662 23.7647 19.7069C23.7862 22.9787 23.7764 26.2506 23.7774 29.5225C23.7774 29.6634 23.7774 29.8033 23.7774 29.9374C25.8797 29.9374 27.9233 29.9374 29.9855 29.9374C29.9914 29.8552 30.0002 29.7965 30.0002 29.7368C29.9953 25.8798 30.005 22.0218 29.9796 18.1639Z"
                  fill="#753422"
                />
                <path
                  d="M0.515625 29.9863C2.58759 29.9863 4.64 29.9863 6.69926 29.9863C6.69926 23.3124 6.69926 16.6659 6.69926 9.99686C4.63511 9.99686 2.5915 9.99686 0.515625 9.99686C0.515625 16.6786 0.515625 23.3261 0.515625 29.9863Z"
                  fill="#753422"
                />
                <path
                  d="M3.57681 0.00014291C1.61044 0.0177548 -0.000977359 1.64196 4.44761e-07 3.6047C0.000978248 5.60072 1.64858 7.25232 3.62667 7.24058C5.59402 7.22883 7.20739 5.58017 7.19566 3.59101C7.1849 1.595 5.55979 -0.017469 3.57681 0.00014291Z"
                  fill="#753422"
                />
              </svg>
            </a>

            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="30"
                height="30"
                viewBox="0 0 30 30"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M29.9966 6.91349C29.9966 12.3036 29.9966 17.6928 29.9966 23.0829C29.8783 23.6432 29.8086 24.2201 29.6334 24.7622C28.6117 27.9144 25.7768 29.9826 22.4503 29.9918C17.4812 30.0055 12.512 29.9991 7.54292 29.9936C5.94707 29.9918 4.47596 29.5506 3.1837 28.6059C1.04857 27.045 0.00118263 24.9218 0.00118263 22.2794C0.000265483 17.447 -0.00248597 12.6145 0.00576839 7.78203C0.00668554 7.28677 0.0296143 6.78233 0.118578 6.29624C0.622094 3.52461 2.19684 1.59126 4.79788 0.532865C5.46465 0.261388 6.20663 0.172424 6.91375 0C12.3038 0 17.693 0 23.0831 0C23.2931 0.0376032 23.5041 0.072455 23.7132 0.111892C26.4665 0.631917 28.3943 2.19107 29.4546 4.77286C29.7325 5.44696 29.8214 6.19811 29.9966 6.91349ZM27.479 14.9982C27.4827 14.9982 27.4864 14.9982 27.49 14.9982C27.49 12.5576 27.4854 10.1171 27.4928 7.67564C27.4946 6.89331 27.3901 6.13391 27.0406 5.43045C26.0941 3.52369 24.5506 2.51575 22.4164 2.50841C17.4665 2.49098 12.5166 2.50199 7.56676 2.50566C7.27511 2.50566 6.98162 2.53317 6.69363 2.57444C4.42185 2.89453 2.54077 4.94895 2.5261 7.24916C2.49217 12.3549 2.51234 17.4607 2.50959 22.5665C2.50959 23.2599 2.64533 23.9294 2.95074 24.5494C3.91008 26.4928 5.48299 27.4852 7.65389 27.4879C12.5451 27.4953 17.4362 27.4916 22.3274 27.487C22.6576 27.487 22.9905 27.4613 23.3179 27.4164C25.5457 27.111 27.4405 25.0336 27.4708 22.7875C27.5065 20.192 27.479 17.5955 27.479 14.9982Z"
                  fill="#753422"
                />
                <path
                  d="M22.4963 15.0348C22.4568 19.1877 19.0551 22.5491 14.9463 22.495C10.798 22.4408 7.4614 19.0648 7.50083 14.9596C7.54027 10.8049 10.9392 7.44726 15.0499 7.49953C19.1991 7.55365 22.5357 10.9297 22.4963 15.0348ZM15.0031 10.0052C12.2443 10.0006 10.0175 12.2201 10.0065 14.9862C9.99457 17.7414 12.2122 19.9728 14.9802 19.9911C17.7436 20.0086 19.9943 17.7652 19.9915 14.9954C19.9888 12.233 17.7656 10.0098 15.0031 10.0052Z"
                  fill="#753422"
                />
                <path
                  d="M23.137 8.7386C22.0933 8.74594 21.2568 7.91592 21.2568 6.87312C21.2578 5.84682 22.0786 5.0168 23.1086 5.00029C24.1257 4.98378 24.9988 5.84958 24.9979 6.87403C24.9979 7.89482 24.1624 8.73126 23.137 8.7386Z"
                  fill="#753422"
                />
              </svg>
            </a>

            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="30"
                height="25"
                viewBox="0 0 30 25"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M8.86746 19.3457C6.05158 18.9801 4.18335 17.6534 3.12739 15C4.03443 15 4.83317 15 5.61836 15C2.76187 13.8763 1.15086 11.9134 0.947787 8.79963C1.81421 9.04332 2.61295 9.27346 3.41169 9.49007C3.4523 9.43591 3.49291 9.38176 3.53353 9.32761C2.34219 8.36642 1.4893 7.17508 1.19147 5.65884C0.893636 4.14259 1.02901 2.6805 1.85483 1.17779C5.26638 5.06317 9.43605 7.324 14.5669 7.64891C14.5669 7.08032 14.5534 6.59295 14.5669 6.10559C14.6481 3.51985 15.9207 1.63808 18.2357 0.595663C20.4965 -0.41968 22.7167 -0.148922 24.6662 1.44855C25.2077 1.8953 25.6951 1.99007 26.3043 1.74638C27.2384 1.38086 28.1725 1.01534 29.1879 0.636277C28.7546 1.99007 27.8611 2.91064 26.927 3.91245C27.9018 3.65523 28.8765 3.38447 29.8512 3.12725C29.8918 3.16787 29.946 3.20848 29.9866 3.24909C29.2149 4.04783 28.4839 4.91425 27.6445 5.63176C27.1842 6.02436 27.0083 6.41696 26.9947 6.99909C26.9135 11.074 25.6951 14.7698 23.177 17.9919C19.7925 22.3375 15.298 24.5307 9.76096 24.639C6.59309 24.7067 3.62829 24.0433 0.839484 22.5406C0.568726 22.3917 0.297968 22.2292 0.0136719 21.9991C3.22216 22.148 6.14634 21.3899 8.86746 19.3457Z"
                  fill="#753422"
                />
              </svg>
            </a>
          </div>
        </div>
        <div class="gallery-section pt-60 px-40">
          <div class="gallery-bg-img">
            <img src="../images/fashion-and-beauty/gallery-bg-img.png" />
          </div>
          <div class="section-heading text-center mb-40">
            <h2 class="text-black text-center mb-2">Gallery</h2>
          </div>
          <div class="gallery-slider">
            <div class="slide px-2">
              <div class="gallery-img">
                <img src="{{ asset('assets/img/vcard19/gallery-img.png') }}" loading="lazy"/>
              </div>
            </div>
            <div class="slide px-2">
              <div class="gallery-img">
                <img src="{{ asset('assets/img/vcard19/gallery-img.png') }}" loading="lazy"/>
              </div>
            </div>
            <div class="slide px-2">
              <div class="gallery-img">
                <img src="{{ asset('assets/img/vcard19/gallery-img.png') }}" loading="lazy"/>
              </div>
            </div>
          </div>
        </div>
        <div class="product-section pt-40 px-40">
          <div class="product-bg-img1">
            <img src="{{ asset('assets/img/vcard19/product-bg-img1.png') }}" loading="lazy"/>
          </div>
          <div class="product-bg-img2">
            <img src="{{ asset('assets/img/vcard19/product-bg-img2.png') }}" loading="lazy"/>
          </div>
          <div class="section-heading text-center mb-40">
            <h2 class="text-black mb-2">Products</h2>
          </div>
          <div class="">
            <div class="product-slider">
              <div class="">
                <div class="product-card card">
                  <div class="product-img card-img">
                    <img
                      src="{{ asset('assets/img/vcard19/product-img1.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="product-desc card-body pt-2">
                    <h3 class="text-black fs-18 fw-5">Makeup Kit</h3>
                    <p class="fs-14 text-gray-100 mb-3">
                      There are many variations of passages of Lorem Ipsum
                    </p>
                    <a
                      href="#!"
                      class="product-amount text-center fs-20 fw-5 py-1"
                    >
                      $1250
                    </a>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="product-card card">
                  <div class="product-img card-img">
                    <img
                      src="{{ asset('assets/img/vcard19/product-img2.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="product-desc card-body pt-2">
                    <h3 class="text-black fs-18 fw-5">Clothes</h3>
                    <p class="fs-14 text-gray-100 mb-3">
                      There are many variations of passages of Lorem Ipsum
                    </p>
                    <a
                      href="#!"
                      class="product-amount text-center fs-20 fw-5 py-1"
                    >
                      $1400
                    </a>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="product-card card">
                  <div class="product-img card-img">
                    <img
                      src="{{ asset('assets/img/vcard19/product-img1.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="product-desc card-body pt-2">
                    <h3 class="text-black fs-18 fw-5">Makeup Kit</h3>
                    <p class="fs-14 text-gray-100 mb-3">
                      There are many variations of passages of Lorem Ipsum
                    </p>
                    <a
                      href="#!"
                      class="product-amount text-center fs-20 fw-5 py-1"
                    >
                      $1250
                    </a>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="product-card card">
                  <div class="product-img card-img">
                    <img
                      src="{{ asset('assets/img/vcard19/product-img2.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="product-desc card-body pt-2">
                    <h3 class="text-black fs-18 fw-5">Clothes</h3>
                    <p class="fs-14 text-gray-100 mb-3">
                      There are many variations of passages of Lorem Ipsum
                    </p>
                    <a
                      href="#!"
                      class="product-amount text-center fs-20 fw-5 py-1"
                    >
                      $1400
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-services-section px-40 pt-60">
          <div class="section-heading text-center mb-40">
            <h2 class="text-black text-center mb-2">Our Services</h2>
          </div>

          <div class="services">
            <div class="row">
              <div class="col-sm-6 mb-sm-0 mb-40 mt-4">
                <div class="service-card h-100">
                  <div
                    class="card-img mx-auto d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/services-img.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="card-body text-center p-0 pt-2">
                    <h3 class="card-title fs-18 text-black">Makeup</h3>
                    <p class="mb-0 fs-14 text-gray-100 text-center">
                      There are many variations of passages of Lorem Ipsum but
                      the majority have suffered alteration in some form
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mt-4">
                <div class="service-card h-100">
                  <div
                    class="card-img mx-auto d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/services-img.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="card-body text-center p-0 pt-2">
                    <h3 class="card-title fs-18 text-black">Makeup</h3>
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
        <div class="appointment-section pt-60 px-40">
          <div class="appointment-bg-img1">
            <img src="{{ asset('assets/img/vcard19/appointment-bg-img1.png') }}" loading="lazy"/>
          </div>
          <div class="appointment-bg-img2">
            <img src="{{ asset('assets/img/vcard19/appointment-bg-img2.png') }}" loading="lazy"/>
          </div>
          <div class="section-heading text-center mb-40">
            <h2 class="text-black mb-2">Make an Appointment</h2>
          </div>

          <div class="appointment px-2">
            <div class="mb-20">
              <label for="date" class="appoint-date text-black fs-6 fw-5 mb-1"
                >Date:</label
              >
              <div class="row">
                <div class="col-12 px-2">
                  <div class="position-relative">
                    <input
                      type="text"
                      class="form-control appointment-input"
                      placeholder=""
                    />
                    <span class="calendar-icon"
                      ><svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M6.25 9.375V10.625C6.25 10.9705 5.97047 11.25 5.625 11.25H4.375C4.02953 11.25 3.75 10.9705 3.75 10.625V9.375C3.75 9.02953 4.02953 8.75 4.375 8.75H5.625C5.97047 8.75 6.25 9.02953 6.25 9.375ZM5.625 13.75H4.375C4.02953 13.75 3.75 14.0295 3.75 14.375V15.625C3.75 15.9705 4.02953 16.25 4.375 16.25H5.625C5.97047 16.25 6.25 15.9705 6.25 15.625V14.375C6.25 14.0295 5.97047 13.75 5.625 13.75ZM10.625 8.75H9.375C9.02953 8.75 8.75 9.02953 8.75 9.375V10.625C8.75 10.9705 9.02953 11.25 9.375 11.25H10.625C10.9705 11.25 11.25 10.9705 11.25 10.625V9.375C11.25 9.02953 10.9705 8.75 10.625 8.75ZM10.625 13.75H9.375C9.02953 13.75 8.75 14.0295 8.75 14.375V15.625C8.75 15.9705 9.02953 16.25 9.375 16.25H10.625C10.9705 16.25 11.25 15.9705 11.25 15.625V14.375C11.25 14.0295 10.9705 13.75 10.625 13.75ZM15.625 8.75H14.375C14.0295 8.75 13.75 9.02953 13.75 9.375V10.625C13.75 10.9705 14.0295 11.25 14.375 11.25H15.625C15.9705 11.25 16.25 10.9705 16.25 10.625V9.375C16.25 9.02953 15.9705 8.75 15.625 8.75ZM15.625 13.75H14.375C14.0295 13.75 13.75 14.0295 13.75 14.375V15.625C13.75 15.9705 14.0295 16.25 14.375 16.25H15.625C15.9705 16.25 16.25 15.9705 16.25 15.625V14.375C16.25 14.0295 15.9705 13.75 15.625 13.75ZM4.375 3.75H5.625C5.97047 3.75 6.25 3.47047 6.25 3.125V0.625C6.25 0.279531 5.97047 0 5.625 0H4.375C4.02953 0 3.75 0.279531 3.75 0.625V3.125C3.75 3.47047 4.02953 3.75 4.375 3.75ZM20 5V17.5C20 18.8806 18.8806 20 17.5 20H2.5C1.11937 20 0 18.8806 0 17.5V5C0 3.61937 1.11937 2.5 2.5 2.5H3.125V3.125C3.125 3.81348 3.6859 4.375 4.375 4.375H5.625C6.3141 4.375 6.875 3.81348 6.875 3.125V2.5H13.125V3.125C13.125 3.81348 13.6865 4.375 14.375 4.375H15.625C16.3135 4.375 16.875 3.81348 16.875 3.125V2.5H17.5C18.8806 2.5 20 3.61937 20 5ZM18.75 7.5C18.75 6.81152 18.1897 6.25 17.5 6.25H2.5C1.8109 6.25 1.25 6.81152 1.25 7.5V17.5C1.25 18.1897 1.8109 18.75 2.5 18.75H17.5C18.1897 18.75 18.75 18.1897 18.75 17.5V7.5ZM14.375 3.75H15.625C15.9705 3.75 16.25 3.47047 16.25 3.125V0.625C16.25 0.279531 15.9705 0 15.625 0H14.375C14.0295 0 13.75 0.279531 13.75 0.625V3.125C13.75 3.47047 14.0295 3.75 14.375 3.75Z"
                          fill="#753422"
                        />
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <label class="text-black fs-6 fw-5 mb-1">Hour:</label>
              <div class="mb-40">
                <div class="row">
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-2 px-2">
                    <div
                      class="hour-input d-flex justify-content-center align-items-center"
                    >
                      <span class="text-primary fs-14 fw-5">8:10 - 20:00</span>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-2 px-2">
                    <div
                      class="hour-input d-flex justify-content-center align-items-center"
                    >
                      <span class="text-primary fs-14 fw-5">8:10 - 20:00</span>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-2 px-2">
                    <div
                      class="hour-input d-flex justify-content-center align-items-center"
                    >
                      <span class="text-primary fs-14 fw-5">8:10 - 20:00</span>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-2 px-2">
                    <div
                      class="hour-input d-flex justify-content-center align-items-center"
                    >
                      <span class="text-primary fs-14 fw-5">8:10 - 20:00</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary w-100  rounded-2">
                  Make an Appointment
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="blog-section pt-60 px-40">
          <div class="blog-bg-img1">
            <img src="{{ asset('assets/img/vcard19/blog-bg-img1.png') }}" loading="lazy"/>
          </div>
          <div class="blog-bg-img2">
            <img src="{{ asset('assets/img/vcard19/blog-bg-img1.png') }}" loading="lazy"/>
          </div>
          <div class="section-heading text-center mb-40">
            <h2 class="text-black mb-2">Blog</h2>
          </div>
          <div class="blog-slider">
            <div class="">
              <div class="blog-card card">
                <div class="card-img">
                  <div class="img-border">
                    <div class="mask">
                      <img
                        src="{{ asset('assets/img/vcard19/blog-img.png') }}"
                        class="w-100 h-100 object-fit-cover"
                        loading="lazy"
                      />
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <h2 class="fs-20 text-primary">Makeup</h2>
                  <p class="text-gray-100 blog-desc fs-6 fw-5">
                    Lorem Ipsum is simply dummy text of the printing and type
                    setting industry. Lorem Ipsum
                  </p>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img">
                  <div class="img-border">
                    <div class="mask">
                      <img
                        src="{{ asset('assets/img/vcard19/blog-img.png') }}"
                        class="w-100 h-100 object-fit-cover"
                        loading="lazy"
                      />
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <h2 class="fs-20 text-primary">Makeup</h2>
                  <p class="text-gray-100 blog-desc fs-6 fw-5">
                    Lorem Ipsum is simply dummy text of the printing and type
                    setting industry. Lorem Ipsum
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-section pt-60 px-40">
          <div class="testimonial-bg-img">
            <img src="{{ asset('assets/img/vcard19/testimonial-bg-img.png') }}" loading="lazy"/>
          </div>
          <div class="section-heading text-center mb-40">
            <h2 class="text-black text-center mb-2">Testimonial</h2>
          </div>
          <div class="testimonial-slider">
            <div class="">
              <div class="testimonial-card card">
                <div class="testimonial-profile-img">
                  <img
                    src="{{ asset('assets/img/vcard19/testimonial-img.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0 pt-3">
                  <div
                    class="quote-left-img quote-img d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/quote-left.png') }}"
                      class="img-fluid h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div
                    class="quote-right-img quote-img d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/quote-right.png') }}"
                      class="img-fluid h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="text-center">
                    <p class="desc text-black mb-3">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text.
                    </p>
                    <h3 class="text-primary fs-20 mb-0">- Jane Doe</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div class="testimonial-card card">
                <div class="testimonial-profile-img">
                  <img
                    src="{{ asset('assets/img/vcard19/testimonial-img.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0 pt-3">
                  <div
                    class="quote-left-img quote-img d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/quote-left.png') }}"
                      class="img-fluid h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div
                    class="quote-right-img quote-img d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/quote-right.png') }}"
                      class="img-fluid h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="text-center">
                    <p class="desc text-black mb-3">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text.
                    </p>
                    <h3 class="text-primary fs-20 mb-0">- Jane Doe</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div class="testimonial-card card">
                <div class="testimonial-profile-img">
                  <img
                    src="{{ asset('assets/img/vcard19/testimonial-img.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0 pt-3">
                  <div
                    class="quote-left-img quote-img d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/quote-left.png') }}"
                      class="img-fluid h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div
                    class="quote-right-img quote-img d-flex justify-content-center align-items-center"
                  >
                    <img
                      src="{{ asset('assets/img/vcard19/quote-right.png') }}"
                      class="img-fluid h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                  <div class="text-center">
                    <p class="desc text-black mb-3">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text.
                    </p>
                    <h3 class="text-primary fs-20 mb-0">- Jane Doe</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="qr-code-section pt-60 px-40">
          <div class="qr-bg-img">
            <img src="{{ asset('assets/img/vcard19/qr-bg-img.png') }}" loading="lazy"/>
          </div>
          <div class="section-heading mb-40 text-center">
            <h2 class="text-black mb-2">QR Code</h2>
          </div>
          <div class="qr-code d-flex justify-content-center flex-wrap mb-40">
            <div class="qr-profile-img">
              <img
                src="{{ asset('assets/img/vcard19/qr-profile-img.png') }}"
                class="w-100 h-100 object-fit-cover"
                loading="lazy"
              />
            </div>
            <div class="qr-code-img">
              <img
                src="{{ asset('assets/img/vcard19/qr-code-img.png') }}"
                class="w-100 h-100 object-fit-cover"
                loading="lazy"
              />
            </div>
          </div>
          <!-- <div class="px-30">
            <div
              class="qr-code mt-3 mx-auto d-flex flex-column align-items-center position-relative"
            >
              <div class="qr-profile-img">
                <img
                  src="../images/hospital/qr-profile.png"
                  class="w-100 h-100 object-fit-cover"
                />
              </div>
              <div class="qr-code-img">
                <img
                  src="../images/hospital/qr-code.png"
                  class="w-100 h-100 object-fit-cover"
                />
              </div>
              <div class="text-center">
                <button class="btn btn-primary" type="button">
                  Download My QR Code
                </button>
              </div>
            </div>
          </div> -->
        </div>
        <div class="business-hour-section pt-30 px-40">
          <div class="section-heading text-center mb-40">
            <h2 class="text-black mb-2">Business Hours</h2>
          </div>
          <div class="business-hours mt-3">
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
        <div class="contact-us-section pt-60 px-30">
          <div class="contact-bg-img">
            <img src="{{ asset('assets/img/vcard19/contact-bg-img.png') }}" loading="lazy"/>
          </div>
          <div class="section-heading text-center mb-40">
            <h2 class="text-black text-center mb-2">Inquiries</h2>
          </div>
          <div class="contact-form">
            <form action="">
              <div class="row">
                <div class="col-lg-6 bg-white">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="{{ __('messages.form.your_name') }}"
                  />
                </div>
                <div class="col-lg-6 bg-white">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="{{ __('messages.form.your_email') }}"
                  />
                </div>
                <div class="col-12 bg-white">
                  <input
                    type="tel"
                    class="form-control"
                    placeholder="{{ __('messages.form.phone') }}"
                  />
                </div>

                <div class="col-12 mb-40 bg-white">
                  <textarea
                    class="form-control h-100"
                    placeholder="{{ __('messages.form.type_message') }}"
                    rows="3"
                  ></textarea>
                </div>
                <div class="col-12 text-center">
                  <button class="btn btn-primary  rounded-2" type="submit">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="create-vcard-section pt-60 pb-60 mb-5 px-40">
          <div class="section-heading text-center mb-40">
            <h2 class="text-black mb-2">Create Your VCard</h2>
          </div>
          <div class="px-sm-3 mb-3">
            <div class="vcard-link-card card">
              <div class="d-flex align-items-center justify-content-center">
                <a
                  href="https://vcards.infyom.com/marlonbrasil"
                  class="text-primary link-text fw-5"
                  >https://vcards.infyom.com/marlonbrasil</a
                >
                <i
                  class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-primary"
                ></i>
              </div>
            </div>
          </div>
        </div>
        <div class="add-to-contact-section pb-40">
          <div class="text-center">
            <button class="btn btn-primary p-2 h-40  rounded-2" style="margin-bottom: -30px"><i
                class="fas fa-download fa-address-book"></i> Add to Contact</button>
          </div>
        </div>
        <div class="bg-img">
          <img src="{{ asset('assets/img/vcard19/bg-img.png') }}" loading="lazy"/>
        </div>
        <div class="btn-section cursor-pointer">
          {{-- <div class="fixed-btn-section">
            <div class="bars-btn fashion-bars-btn">
              <svg
                width="25"
                height="25"
                viewBox="0 0 25 25"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M15.4134 0.540771H22.489C23.572 0.540771 24.4601 1.42891 24.4601 2.51188V9.5875C24.4601 10.6776 23.5731 11.5586 22.489 11.5586H15.4134C14.3222 11.5586 13.4423 10.6787 13.4423 9.5875V2.51188C13.4423 1.42783 14.3233 0.540771 15.4134 0.540771Z"
                  stroke="white"
                />
                <path
                  d="M2.97143 0.5H8.74589C10.1129 0.5 11.2173 1.6122 11.2173 2.97143V8.74589C11.2173 10.1139 10.1139 11.2173 8.74589 11.2173H2.97143C1.6122 11.2173 0.5 10.1129 0.5 8.74589V2.97143C0.5 1.61328 1.61328 0.5 2.97143 0.5Z"
                  stroke="white"
                />
                <path
                  d="M2.97143 13.783H8.74589C10.1139 13.783 11.2173 14.8863 11.2173 16.2544V22.0289C11.2173 23.3881 10.1129 24.5003 8.74589 24.5003H2.97143C1.61328 24.5003 0.5 23.387 0.5 22.0289V16.2544C0.5 14.8874 1.6122 13.783 2.97143 13.783Z"
                  stroke="white"
                />
                <path
                  d="M16.2537 13.783H22.0282C23.3874 13.783 24.4996 14.8874 24.4996 16.2544V22.0289C24.4996 23.387 23.3863 24.5003 22.0282 24.5003H16.2537C14.8867 24.5003 13.7823 23.3881 13.7823 22.0289V16.2544C13.7823 14.8863 14.8856 13.783 16.2537 13.783Z"
                  stroke="white"
                />
              </svg>
            </div>
            <div class="sub-btn">
              <div class="social-btn fashion-sub-btn wp-btn">
                <i class="fa-brands fa-whatsapp text-primary"></i>
              </div>
              <div class="social-btn fashion-sub-btn wp-btn mt-3">
                <i class="fa-solid fa-share-nodes text-primary"></i>
              </div>
            </div>
          </div> --}}
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
    $().ready(function () {
      $(".gallery-slider").slick({
        arrows: false,
        infinite: true,
        dots: true,
        slidesToShow: 1,
        autoplay: true,
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
              dots: true,
            },
          },
        ],
      });
      $(".testimonial-slider").slick({
        arrows: false,
        infinite: true,
        dots: true,
        slidesToShow: 1,
        autoplay: true,
      });

      $(".blog-slider").slick({
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
    });
  </script>
  @routes
  <script src="{{ asset('messages.js') }}"></script>
  <script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
  <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
  <script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>
  <script src="{{ mix('assets/js/lightbox.js') }}"></script>
</html>
