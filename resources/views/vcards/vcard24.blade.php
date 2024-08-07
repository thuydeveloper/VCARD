<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>School VCard</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
 <!-- Bootstrap CSS -->
 <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
 <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
        {{-- css link --}}
        <link rel="stylesheet" href="{{ asset('assets/css/vcard24.css') }}">
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
          <div class="banner-img">
            <img src="{{ asset('assets/img/vcard24/banner-img.png') }}" class="w-100" />
            <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
                <div class="language pt-3 me-2">
                    <ul class="text-decoration-none">
                        <li class="dropdown1 dropdown lang-list">
                            <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"
                                role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-language me-2" loading="lazy"></i>Language</a>
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
            <div class="cloud-img">
              <img src="{{ asset('assets/img/vcard24/Cloud.png') }}" class="w-100" loading="lazy"/>
            </div>
          </div>
        </div>
        <div class="profile-section pt-60 pb-60 px-30">
          <div class="book-img text-end">
            <img src="{{ asset('assets/img/vcard24/book.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="card d-flex flex-sm-row">
            <div class="card-img">
              <img
                src="{{ asset('assets/img/vcard24/profile-img.png') }}"
                class="w-100 h-100 object-fit-cover"
                loading="lazy"
              />
            </div>
            <div class="card-body p-0 text-sm-start text-center">
              <div class="profile-name">
                <h4 class="text-black mb-0 fw-bold">Amelia Jackson</h4>
                <p class="fs-16 text-pink fw-5">Principal</p>
                <p class="fs-14 text-gray-200">
                  Lorem Ipsum has been the industry's standard dummy text ever
                  since the 1500s, when an unknown printer took a galley of type
                  and scrambled it to make a type specimen book.
                </p>
              </div>
              <div class="social-media-section">
                <div class="d-flex justify-content-sm-start justify-content-center">
                  <a href="" class="social-icon d-flex justify-content-center align-items-center">
                    <svg
                      width="15"
                      height="30"
                      viewBox="0 0 15 30"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M4.18589 16.9334C3.52047 16.9334 2.90951 16.9334 2.29856 16.9334C1.77748 16.9334 1.2564 16.9432 0.736229 16.9294C0.191547 16.9157 0.0136171 16.7394 0.00907804 16.1566C-0.00272341 14.6295 -0.00363122 13.1014 0.00998585 11.5743C0.0154327 10.9964 0.206072 10.8132 0.743492 10.8093C1.75115 10.8025 2.75882 10.8074 3.76739 10.8074C3.89085 10.8074 4.01431 10.8074 4.18589 10.8074C4.18589 10.6418 4.18407 10.4998 4.18589 10.3587C4.20949 8.96682 4.16047 7.56902 4.27122 6.18494C4.55173 2.6596 7.04547 0.1422 10.3245 0.0275941C11.6589 -0.0194235 12.997 0.0070239 14.3324 0.010942C14.8027 0.0119216 14.9933 0.219583 14.9951 0.72894C15.0015 2.15808 15.0015 3.5882 14.996 5.01734C14.9942 5.5649 14.8163 5.76374 14.2943 5.77648C13.3774 5.79998 12.4605 5.79998 11.5427 5.81566C10.5142 5.83231 10.0821 6.26624 10.0603 7.36234C10.0385 8.47019 10.0557 9.58001 10.0557 10.731C10.211 10.731 10.3317 10.731 10.4525 10.731C11.619 10.731 12.7855 10.729 13.952 10.7319C14.6874 10.7329 14.8599 10.9171 14.8608 11.6968C14.8617 13.1504 14.8635 14.605 14.8599 16.0586C14.858 16.709 14.6992 16.8844 14.0928 16.8873C12.7683 16.8932 11.4438 16.8893 10.0567 16.8893C10.0567 17.0597 10.0567 17.2115 10.0567 17.3624C10.0567 21.1865 10.0567 25.0116 10.0567 28.8357C10.0567 29.8897 9.95317 29.9994 8.96003 29.9994C7.65733 29.9994 6.35554 30.0013 5.05284 29.9984C4.35565 29.9974 4.18589 29.8162 4.18589 29.0717C4.18498 25.1859 4.18498 21.3001 4.18498 17.4153C4.18589 17.2713 4.18589 17.1273 4.18589 16.9334Z"
                        fill="#ffffff"
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
                        fill="#ffffff"
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
                        fill="#ffffff"
                      />
                      <path
                        d="M0.515625 29.9863C2.58759 29.9863 4.64 29.9863 6.69926 29.9863C6.69926 23.3124 6.69926 16.6659 6.69926 9.99686C4.63511 9.99686 2.5915 9.99686 0.515625 9.99686C0.515625 16.6786 0.515625 23.3261 0.515625 29.9863Z"
                        fill="#ffffff"
                      />
                      <path
                        d="M3.57681 0.00014291C1.61044 0.0177548 -0.000977359 1.64196 4.44761e-07 3.6047C0.000978248 5.60072 1.64858 7.25232 3.62667 7.24058C5.59402 7.22883 7.20739 5.58017 7.19566 3.59101C7.1849 1.595 5.55979 -0.017469 3.57681 0.00014291Z"
                        fill="#ffffff"
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
                        fill="#ffffff"
                      />
                      <path
                        d="M22.4963 15.0348C22.4568 19.1877 19.0551 22.5491 14.9463 22.495C10.798 22.4408 7.4614 19.0648 7.50083 14.9596C7.54027 10.8049 10.9392 7.44726 15.0499 7.49953C19.1991 7.55365 22.5357 10.9297 22.4963 15.0348ZM15.0031 10.0052C12.2443 10.0006 10.0175 12.2201 10.0065 14.9862C9.99457 17.7414 12.2122 19.9728 14.9802 19.9911C17.7436 20.0086 19.9943 17.7652 19.9915 14.9954C19.9888 12.233 17.7656 10.0098 15.0031 10.0052Z"
                        fill="#ffffff"
                      />
                      <path
                        d="M23.137 8.7386C22.0933 8.74594 21.2568 7.91592 21.2568 6.87312C21.2578 5.84682 22.0786 5.0168 23.1086 5.00029C24.1257 4.98378 24.9988 5.84958 24.9979 6.87403C24.9979 7.89482 24.1624 8.73126 23.137 8.7386Z"
                        fill="#ffffff"
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
                        fill="#ffffff"
                      />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="contact-section pb-60 px-30">
          <div class="abc-img">
            <img src="{{ asset('assets/img/vcard24/abc.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Contact</h2>
          </div>
          <div class="row">
            <div class="col-sm-6 mb-20">
              <div class="contact-box d-flex align-items-center">
                <div
                  class="contact-icon d-flex justify-content-center align-items-center"
                >
                  <svg
                    width="26"
                    height="20"
                    viewBox="0 0 26 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_2111_1227)">
                      <path
                        d="M13.025 -0.000469008C16.3358 -0.000469008 19.6399 -0.0071379 22.9507 0.00619988C23.3837 0.00619988 23.8233 0.0528821 24.243 0.146247C24.9958 0.319638 25.5154 0.799798 25.8418 1.49336C26.1282 2.10023 26.035 2.43368 25.4754 2.78713C24.7493 3.24728 24.0165 3.70076 23.2904 4.16092C20.1195 6.18159 16.9486 8.18893 13.7911 10.2229C13.2182 10.5964 12.7652 10.5831 12.1923 10.2163C8.34859 7.74211 4.48489 5.3013 0.627859 2.84715C0.54792 2.7938 0.46132 2.74711 0.388043 2.69376C0.00833517 2.43368 -0.0649418 2.22694 0.068289 1.79346C0.394705 0.72644 1.20741 0.106233 2.39983 0.0395443C2.87946 0.0128688 3.35909 0.0128688 3.83206 0.00619988C6.89637 0.00619988 9.96068 0.00619988 13.025 -0.000469008C13.025 0.00619988 13.025 -0.000469008 13.025 -0.000469008Z"
                        fill="#ED145B"
                      />
                      <path
                        d="M12.9699 20C9.60585 20 6.24843 20.0067 2.88435 19.9934C2.46468 19.9934 2.03168 19.9467 1.62532 19.8333C0.805952 19.5999 0.299675 19.0197 0.0531977 18.2128C-0.0733716 17.7926 -9.46755e-05 17.5859 0.379613 17.3458C3.48389 15.3918 6.58817 13.4378 9.69245 11.4838C10.0189 11.2771 10.3653 11.2771 10.6917 11.4705C11.2779 11.8173 11.8508 12.1774 12.4237 12.5442C12.8967 12.851 13.0965 12.8576 13.5561 12.5575C14.1623 12.1641 14.7752 11.7839 15.3814 11.3905C15.7078 11.1771 16.0009 11.2438 16.3007 11.4372C17.2933 12.0774 18.2858 12.7109 19.2851 13.3445C21.3235 14.6382 23.3686 15.9187 25.407 17.2124C26.0332 17.6059 26.1331 17.9327 25.8267 18.5929C25.407 19.4865 24.6476 19.8666 23.7217 19.98C23.4885 20.0067 23.2554 20.0067 23.0222 20.0067C19.6714 20 16.3207 20 12.9699 20Z"
                        fill="#ED145B"
                      />
                      <path
                        d="M0.046875 15.3651C0.046875 11.7773 0.046875 8.24942 0.046875 4.66156C2.85805 6.45549 5.62925 8.21608 8.44708 10.01C5.63591 11.8039 2.86471 13.5712 0.046875 15.3651Z"
                        fill="#ED145B"
                      />
                      <path
                        d="M17.5732 10.01C20.3778 8.22275 23.149 6.45549 25.9601 4.66156C25.9601 8.23608 25.9601 11.7573 25.9601 15.3518C23.1556 13.5712 20.3844 11.8039 17.5732 10.01Z"
                        fill="#ED145B"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_2111_1227">
                        <rect width="26" height="20" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <div class="contact-desc">
                  <a href="mailto:amilia@gmail.com" class="text-black fw-5"
                    >amilia@gmail.com</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mb-20">
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
                      fill="#F4C100"
                    />
                  </svg>
                </div>
                <div class="contact-desc">
                  <a href="tel:+1 4078461474" class="text-black fw-5"
                    >+1 4078461474</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mb-sm-0 mb-20">
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
                    <g clip-path="url(#clip0_2111_1209)">
                      <path
                        d="M0.390531 26C0.264533 25.7615 0.0629374 25.5355 0.0251381 25.2844C-0.0378606 24.8324 0.0251381 24.3679 -6.1387e-05 23.916C-0.0126611 23.5017 0.163735 23.2883 0.592127 23.3008C0.718124 23.3008 0.844122 23.3008 0.970119 23.3008C10.3317 23.3008 19.6807 23.3008 29.0424 23.3134C29.3574 23.3134 29.6723 23.4389 29.9873 23.5017C29.9873 24.3303 29.9873 25.1714 29.9873 26C20.1343 26 10.2561 26 0.390531 26Z"
                        fill="#F7941E"
                      />
                      <path
                        d="M15.0315 10.6461C18.3957 10.6461 21.7598 10.6461 25.1365 10.6461C27.0391 10.6461 27.9715 11.5877 27.9841 13.4959C27.9841 13.521 27.9841 13.5336 27.9841 13.5587C28.2109 14.6635 27.6943 15.2912 26.7115 15.718C25.7161 16.1449 24.7585 16.2328 23.8892 15.492C23.4608 15.128 23.108 14.6886 22.7552 14.2492C22.289 13.6842 21.848 13.6717 21.3692 14.2241C21.0542 14.5881 20.7392 14.9522 20.3864 15.2661C19.391 16.1574 18.2949 16.2579 17.1735 15.5423C16.6695 15.2159 16.2159 14.8016 15.7749 14.3873C15.1701 13.8223 14.9055 13.8223 14.3133 14.4124C13.9731 14.7513 13.6204 15.0778 13.2298 15.354C11.9068 16.3081 10.7098 16.2453 9.47504 15.1907C9.28604 15.0275 9.10965 14.8518 8.94585 14.6635C8.10167 13.6968 7.92527 13.6968 7.08109 14.7011C5.93451 16.057 4.48554 16.3583 2.87277 15.6301C2.24278 15.3414 2.00339 14.902 2.06639 14.2492C2.10419 13.9353 2.14199 13.6215 2.10419 13.3201C1.88999 11.776 3.13737 10.621 4.75013 10.6335C8.16467 10.6712 11.5918 10.6461 15.0315 10.6461Z"
                        fill="#F7941E"
                      />
                      <path
                        d="M27.7321 21.606C19.2525 21.606 10.8107 21.606 2.33105 21.606C2.33105 20.2878 2.33105 18.9696 2.33105 17.6012C4.43521 18.3042 6.27478 17.8522 7.78675 16.2327C10.3067 18.6432 12.625 18.3168 15.0568 16.1574C18.0681 18.7687 20.2353 18.1661 22.2891 16.1198C22.982 16.8605 23.738 17.5384 24.7712 17.802C25.7918 18.0657 26.7494 17.8522 27.7573 17.4254C27.7321 18.8315 27.7321 20.1874 27.7321 21.606Z"
                        fill="#F7941E"
                      />
                      <path
                        d="M13.2297 9.46596C13.2297 8.22308 13.2171 7.00531 13.2423 5.77499C13.2549 5.37325 13.5447 5.13472 13.9605 5.13472C14.6535 5.12217 15.3465 5.12217 16.0269 5.13472C16.5056 5.13472 16.7828 5.41092 16.7828 5.87542C16.808 7.05553 16.7954 8.24819 16.7954 9.46596C15.5985 9.46596 14.4393 9.46596 13.2297 9.46596Z"
                        fill="#F7941E"
                      />
                      <path
                        d="M15.0188 0C15.3212 0.55239 15.674 1.18011 16.0142 1.82038C16.1654 2.10913 16.367 2.39788 16.4552 2.71173C16.6442 3.40222 16.3418 4.15548 15.8 4.45678C15.2582 4.75809 14.4266 4.67021 13.9856 4.26847C13.5194 3.82907 13.3682 2.98793 13.6958 2.37277C14.1242 1.54418 14.5904 0.740705 15.0188 0Z"
                        fill="#F7941E"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_2111_1209">
                        <rect width="30" height="26" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <div class="contact-desc">
                  <p class="mb-0 text-black fw-5">12th June, 1990</p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="contact-box d-flex align-items-center">
                <div
                  class="contact-icon d-flex justify-content-center align-items-center"
                >
                  <svg
                    width="24"
                    height="30"
                    viewBox="0 0 24 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_2111_1201)">
                      <path
                        d="M11.5312 24.606C11.1449 24.1532 10.7736 23.7237 10.41 23.2903C8.44775 20.93 6.59159 18.4883 4.98545 15.861C4.26193 14.6808 3.62932 13.4541 3.08762 12.1733C2.09136 9.8091 2.26182 7.48355 3.36037 5.23152C4.78089 2.32168 7.11056 0.588156 10.2622 0.104472C15.111 -0.638466 19.7173 2.83632 20.509 7.74667C20.7666 9.35637 20.5203 10.8655 19.9029 12.3436C19.2135 13.992 18.3233 15.5243 17.3535 17.0063C15.6224 19.6453 13.6867 22.1179 11.6259 24.4937C11.6032 24.5208 11.5767 24.5518 11.5312 24.606ZM16.0883 8.50509C16.0921 5.9435 14.0465 3.85786 11.535 3.85786C9.01975 3.85786 6.97798 5.93963 6.97798 8.50122C6.97798 11.0628 9.01975 13.1485 11.5312 13.1485C14.0427 13.1485 16.0845 11.0705 16.0883 8.50509Z"
                        fill="#1CBBB4"
                      />
                      <path
                        d="M7.98905 21.4523C7.54963 21.5181 7.11401 21.58 6.68217 21.6574C5.37907 21.8857 4.10249 22.2069 2.89788 22.7834C2.42816 23.0117 1.98117 23.2749 1.61373 23.6579C1.02279 24.2771 1.02279 24.9116 1.62888 25.5191C2.14406 26.0377 2.78424 26.3395 3.44715 26.6026C4.73131 27.1056 6.07229 27.3804 7.4322 27.5661C9.3073 27.8254 11.1938 27.8873 13.084 27.7944C15.2015 27.6899 17.2963 27.4191 19.3154 26.7148C19.9139 26.5059 20.4973 26.2582 21.0124 25.8713C21.2435 25.6971 21.467 25.4959 21.645 25.2676C21.9898 24.8265 22.0011 24.3351 21.645 23.9056C21.4026 23.6115 21.1033 23.3445 20.7852 23.1356C19.895 22.5513 18.8949 22.2185 17.8721 21.9786C17.0236 21.7812 16.1637 21.6535 15.3076 21.4949C15.2318 21.4794 15.1599 21.4678 15.0841 21.4562C15.2243 21.1544 15.2508 21.1466 15.5576 21.1699C16.8228 21.2705 18.0843 21.4098 19.323 21.6922C19.9972 21.8432 20.6639 22.025 21.2738 22.3539C21.6564 22.559 22.0352 22.7989 22.3496 23.093C23.1565 23.8514 23.3004 24.9039 22.7853 25.8945C22.5087 26.4285 22.1034 26.8502 21.6413 27.2178C20.6336 28.0188 19.4858 28.5489 18.2812 28.9552C15.747 29.8104 13.137 30.0929 10.4778 29.9768C8.43604 29.8839 6.43973 29.5473 4.50781 28.843C3.31836 28.4096 2.18573 27.8679 1.21598 27.0166C0.791716 26.6452 0.43185 26.2118 0.204565 25.6817C-0.17803 24.7878 -0.00377858 23.8437 0.66671 23.151C1.22734 22.5706 1.93571 22.2494 2.67439 21.9979C3.6858 21.6535 4.73131 21.4756 5.78439 21.344C6.36776 21.2705 6.95112 21.2279 7.53827 21.166C7.82237 21.1389 7.8451 21.1544 7.98905 21.4523Z"
                        fill="#1CBBB4"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_2111_1201">
                        <rect width="23.0769" height="30" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <div class="contact-desc">
                  <p class="mb-0 text-black fw-5">New York, USA</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-services-section px-30">
          <div class="pencil-img1">
            <img src="{{ asset('assets/img/vcard24/pencil-img1.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="triangle-img1 text-end">
            <img src="{{ asset('assets/img/vcard24/triangle-img1.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Our Services</h2>
          </div>
          <div class="services">
            <div class="row">
              <div class="col-sm-6 mb-sm-0 mb-40 pt-30">
                <div class="service-card h-100">
                  <div
                    class="card-img learning-img mx-auto d-flex justify-content-center align-items-center"
                  >
                    <img src="{{ asset('assets/img/vcard24/learning-bg.png') }}" loading="lazy"/>
                  </div>
                  <div class="card-body p-0">
                    <h3 class="card-title fs-18 fw-5 text-black mb-10">
                      Play-Based Learning
                    </h3>
                    <p class="mb-0 fs-14 text-gray-200">
                      If you are going to use a passage of Lorem Ipsum, you need
                      to be sure there isn't anything embarrassing hidden in the
                      middle of text.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 pt-30">
                <div class="service-card h-100">
                  <div
                    class="card-img staff-img mx-auto d-flex justify-content-center align-items-center"
                  >
                    <img src="{{ asset('assets/img/vcard24/staff-bg.png') }}" loading="lazy"/>
                  </div>
                  <div class="card-body p-0">
                    <h3 class="card-title fs-18 fw-5 text-black mb-10">
                      Qualified Staff
                    </h3>
                    <p class="mb-0 fs-14 text-gray-200">
                      It is a long established fact that a reader will be
                      distracted by the readable content of a page when looking
                      at its layout.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="appointment-section pt-60 px-30">
          <div class="one-img">
            <img src="{{ asset('assets/img/vcard24/one.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="red-heart-img">
            <img src="{{ asset('assets/img/vcard24/red-heart.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="yellow-star-img text-end">
            <img src="{{ asset('assets/img/vcard24/yellow-star.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="two-img text-end">
            <img src="{{ asset('assets/img/vcard24/two.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="three-img">
            <img src="{{ asset('assets/img/vcard24/three.png') }}" alt="book" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Make an Appointment</h2>
          </div>
          <div class="appointment px-sm-4 mx-lg-3">
            <div class="mb-20">
              <div class="position-relative">
                <input
                  type="text"
                  class="form-control appointment-input"
                  placeholder="Pick a date"
                />
              </div>
            </div>
            <div class="">
              <div class="row mb-3">
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-black fw-5">8:10 - 20:00</span>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-black fw-5">8:10 - 20:00</span>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-black fw-5">8:10 - 20:00</span>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-black fw-5">8:10 - 20:00</span>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-pink w-100">
                  Make an Appointment
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="gallery-section pt-60 px-30">
          <div class="earth-img text-end">
            <img src="{{ asset('assets/img/vcard24/earth.png') }}" alt="earth" loading="lazy"/>
          </div>
          <div class="star-img text-end">
            <img src="{{ asset('assets/img/vcard24/star.png') }}" alt="star" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Gallery</h2>
          </div>
          <div class="gallery-slider">
            <div class="slide">
              <div class="gallery-img">
                <img src="{{ asset('assets/img/vcard24/gallery-img.png') }}" loading="lazy"/>
              </div>
            </div>
            <div class="slide">
              <div class="gallery-img">
                <img src="{{ asset('assets/img/vcard24/gallery-img.png') }}" loading="lazy"/>
              </div>
            </div>
            <div class="slide">
              <div class="gallery-img">
                <img src="{{ asset('assets/img/vcard24/gallery-img.png') }}" loading="lazy"/>
              </div>
            </div>
          </div>
        </div>
        <div class="product-section pt-60 px-3">
          <div class="bag-img">
            <img src="{{ asset('assets/img/vcard24/bag.png') }}" alt="bag" loading="lazy"/>
          </div>
          <div class="brush-img text-end">
            <img src="{{ asset('assets/img/vcard24/brush.png') }}" alt="brush" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Products</h2>
          </div>
          <div class="product-slider mb-30">
            <div class="">
              <div class="product-card card">
                <div class="maskborder">
                  <div class="mask">
                    <div class="content">
                      <div class="product-img card-img">
                        <img
                          src="{{ asset('assets/img/vcard24/product-img1.png') }}"
                          class="w-100 h-100 object-fit-cover"
                          loading="lazy"
                        />
                      </div>
                      <div class="product-desc card-body p-3">
                        <div
                          class="d-flex justify-content-between align-items-center mb-0"
                        >
                          <h3 class="text-black fs-18 fw-5 mb-0">Books</h3>
                          <p class="amount fs-18 fw-5 mb-0 text-green">$125</p>
                        </div>
                        <p class="fs-12 text-gray-100 mb-0">
                          It is a long established
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div class="product-card card">
                <div class="maskborder">
                  <div class="mask">
                    <div class="content">
                      <div class="product-img card-img">
                        <img
                          src="{{ asset('assets/img/vcard24/product-img2.png') }}"
                          class="w-100 h-100 object-fit-cover"
                          loading="lazy"
                        />
                      </div>
                      <div class="product-desc card-body p-3">
                        <div
                          class="d-flex justify-content-between align-items-center mb-0"
                        >
                          <h3 class="text-black fs-18 fw-5 mb-0">Books</h3>
                          <p class="amount fs-18 fw-5 mb-0 text-green">$125</p>
                        </div>
                        <p class="fs-12 text-gray-100 mb-0">
                          It is a long established
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div class="product-card card">
                <div class="maskborder">
                  <div class="mask">
                    <div class="content">
                      <div class="product-img card-img">
                        <img
                          src="{{ asset('assets/img/vcard24/product-img1.png') }}"
                          class="w-100 h-100 object-fit-cover"
                          loading="lazy"
                        />
                      </div>
                      <div class="product-desc card-body p-3">
                        <div
                          class="d-flex justify-content-between align-items-center mb-0"
                        >
                          <h3 class="text-black fs-18 fw-5 mb-0">Books</h3>
                          <p class="amount fs-18 fw-5 mb-0 text-green">$125</p>
                        </div>
                        <p class="fs-12 text-gray-100 mb-0">
                          It is a long established
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div class="product-card card">
                <div class="maskborder">
                  <div class="mask">
                    <div class="content">
                      <div class="product-img card-img">
                        <img src="{{ asset('assets/img/vcard24/product-img2.png') }}"class="w-100 h-100 object-fit-cover" loading="lazy"/>
                      </div>
                      <div class="product-desc card-body p-3">
                        <div
                          class="d-flex justify-content-between align-items-center mb-0"
                        >
                          <h3 class="text-black fs-18 fw-5 mb-0">Books</h3>
                          <p class="amount fs-18 fw-5 mb-0 text-green">$125</p>
                        </div>
                        <p class="fs-12 text-gray-100 mb-0">
                          It is a long established
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="#!" class="view-all fs-6 fw-5 text-pink">View all</a>
          </div>
        </div>
        <div class="testimonial-section pt-60">
          <div class="clip-img">
            <img src="{{ asset('assets/img/vcard24/clip.png') }}" alt="clip" loading="lazy"/>
          </div>
          <div class="color-plat-img">
            <img src="{{ asset('assets/img/vcard24/color-plat.png') }}" alt="color-plat" loading="lazy"/>
          </div>
          <div class="pencil-color-img text-end">
            <img src="{{ asset('assets/img/vcard24/pencil-color.png') }}" alt="pencil-color" loading="lazy"/>
          </div>

          <div class="section-heading text-center px-3">
            <h2 class="mb-0">Testimonial</h2>
          </div>
          <div class="testimonial-slider">
            <div class="">
              <div
                class="testimonial-card card d-flex flex-sm-row-reverse flex-column justify-content-center"
              >
                <div class="card-img mx-auto">
                  <div class="mask">
                    {{-- <img src="{{ asset('assets/img/vcard24/testimonial-img.png') }}" class="w-100 h-100 object-fit-cover"/> --}}
                    <img src="{{ asset('assets/img/vcard24/testimonial-img-bg.png') }}" class="w-100 h-100 object-fit-cover" style="position: absolute; top: 0; left: 0; z-index: 1;" loading="lazy"/>
                    <img src="{{ asset('assets/img/vcard24/testimonial-img.png') }}" class="w-100 h-100 object-fit-cover" style="position: absolute; top: 0; left: 0; z-index: 2;" loading="lazy"/>
                  </div>
                </div>
                <div class="card-body p-0 pe-sm-3 text-sm-start text-center">
                  <div class="">
                    <div class="profile-desc mt-3">
                      <h3 class="text-black fs-18 mb-0 fw-6">Shane Watson</h3>
                      <p class="text-pink fs-14 fw-5">Customer</p>
                    </div>
                    <p class="desc text-gray-100 fs-14 mb-0">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div
                class="testimonial-card card d-flex flex-sm-row-reverse flex-column justify-content-center"
              >
                <div class="card-img mx-auto">
                  <div class="mask">
                    <img
                      src="{{ asset('assets/img/vcard24/testimonial-img.png') }}"
                      class="w-100 h-100 object-fit-cover"
                      loading="lazy"
                    />
                  </div>
                </div>
                <div class="card-body p-0 pe-sm-3 text-sm-start text-center">
                  <div class="">
                    <div class="profile-desc mt-3">
                      <h3 class="text-black fs-18 mb-0 fw-6">Shane Watson</h3>
                      <p class="text-pink fs-14 fw-5">Customer</p>
                    </div>
                    <p class="desc text-gray-100 fs-14 mb-0">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="blog-section pt-60 px-3">
          <div class="paper-plane-img">
            <img src="{{ asset('assets/img/vcard24/paper-plane.png') }}" alt="paper-plane" loading="lazy"/>
          </div>
          <div class="cloud-vector-img text-end">
            <img src="{{ asset('assets/img/vcard24/cloud-vector.png') }}" alt="cloud-vector" loading="lazy"/>
          </div>
          <div class="star-img2 text-end">
            <img src="{{ asset('assets/img/vcard24/star.png') }}" alt="star" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Blog</h2>
          </div>
          <div class="blog-slider">
            <div class="">
              <div class="blog-card card">
                <div class="card-img mb-3">
                  <img
                    src="{{ asset('assets/img/vcard24/blog-img1.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0">
                  <h2 class="fs-6 fw-6 text-black">Outdoor Play Area</h2>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img mb-3">
                  <img
                    src="{{ asset('assets/img/vcard24/blog-img2.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0">
                  <h2 class="fs-6 fw-6 text-black">
                    Children’s Creativity Works
                  </h2>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img mb-3">
                  <img
                    src="{{ asset('assets/img/vcard24/blog-img1.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0">
                  <h2 class="fs-6 fw-6 text-black">Outdoor Play Area</h2>
                </div>
              </div>
            </div>
            <div class="">
              <div class="blog-card card">
                <div class="card-img mb-3">
                  <img
                    src="{{ asset('assets/img/vcard24/blog-img2.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    loading="lazy"
                  />
                </div>
                <div class="card-body p-0">
                  <h2 class="fs-6 fw-6 text-black">
                    Children’s Creativity Works
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="business-hour-section pt-60 px-30">
          <div class="rainbow-img">
            <img src="{{ asset('assets/img/vcard24/rainbow.png') }}" alt="rainbow" loading="lazy"/>
          </div>
          <div class="triangle-img2 text-end">
            <img src="{{ asset('assets/img/vcard24/triangle-img2.png') }}" alt="triangle" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Business Hours</h2>
          </div>
          <div class="">
            <div class="business-hour-card row justify-content-center">
              <div class="d-sm-flex justify-content-between">
                <div class="business-hour mb-3 text-sm-start text-center">
                  <span class="me-2">Sunday:</span>
                  <span>08:10 - 20:00</span>
                </div>
                <div class="business-hour mb-3 text-sm-start text-center">
                  <span class="me-2">Monday:</span>
                  <span>08:10 - 20:00</span>
                </div>
              </div>

              <div class="d-sm-flex justify-content-between">
                <div class="business-hour mb-3 text-sm-start text-center">
                  <span class="me-2">Tuesday:</span>
                  <span>08:10 - 20:00</span>
                </div>
                <div class="business-hour mb-3 text-sm-start text-center">
                  <span class="me-2">Wednesday:</span>
                  <span>08:10 - 20:00</span>
                </div>
              </div>
              <div class="d-sm-flex justify-content-between">
                <div class="business-hour mb-3 text-sm-start text-center">
                  <span class="me-2">Thursday:</span>
                  <span>08:10 - 20:00</span>
                </div>
                <div class="business-hour mb-3 text-sm-start text-center">
                  <span class="me-2">Friday:</span>
                  <span>08:10 - 20:00</span>
                </div>
              </div>

              <div class="d-flex justify-content-center">
                <div class="business-hour">
                  <span class="me-2">Saturday:</span>
                  <span>Closed</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="qr-code-section pt-60 px-30">
          <div class="pencil-img2">
            <img src="{{ asset('assets/img/vcard24/pencil-img2.png') }}" alt="pencil" loading="lazy"/>
          </div>
          <div class="lab-img1 text-end">
            <img src="{{ asset('assets/img/vcard24/lab-img1.png') }}" alt="lab-img" loading="lazy"/>
          </div>
          <div class="lab-img2 text-end">
            <img src="{{ asset('assets/img/vcard24/lab-img2.png') }}" alt="lab-img" loading="lazy"/>
          </div>
          <div class="blue-heart-img text-end">
            <img src="{{ asset('assets/img/vcard24/blue-heart.png') }}" alt="blue-heart" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">QR Code</h2>
          </div>
          <div
            class="qr-code d-flex justify-content-center align-items-center flex-wrap mb-30"
          >
            <div class="qr-profile-img">
              <img
                src="{{ asset('assets/img/vcard24/profile-img.png') }}"
                class="w-100 h-100 object-fit-cover"
                loading="lazy"
              />
            </div>
            <div class="qr-code-img">
              <img
                src="{{ asset('assets/img/vcard24/qr-code-img.png') }}"
                class="w-100 h-100 object-fit-cover"
                loading="lazy"
              />
            </div>
          </div>
        </div>
        <div class="contact-us-section pt-60 px-30">
          <div class="crystal-img">
            <img src="{{ asset('assets/img/vcard24/crystal.png') }}" alt="crystal" loading="lazy"/>
          </div>
          <div class="apple-img">
            <img src="{{ asset('assets/img/vcard24/apple.png') }}" alt="apple" loading="lazy"/>
          </div>
          <div class="half-round-img text-end">
            <img src="{{ asset('assets/img/vcard24/half-round.png') }}" alt="half-round" loading="lazy"/>
          </div>
          <div class="section-heading text-center">
            <h2 class="mb-0">Inquiries</h2>
          </div>
          <div class="contact-form">
            <form action="">
              <div class="row">
                <div class="col-sm-6 pe-sm-2">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Full Name"
                  />
                </div>
                <div class="col-sm-6 ps-sm-2">
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
                    placeholder="Phone Number"
                  />
                </div>

                <div class="col-12 mb-30">
                  <textarea
                    class="form-control h-100"
                    placeholder="Your Message"
                    rows="3"
                  ></textarea>
                </div>
                <div class="col-12 text-center">
                  <button class="send-btn rounded btn btn-orange" type="submit">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="mb-5">
          <div class="create-vcard-section pt-60 pb-60 mb-5">
            <div class="notes-img">
              <img src="{{ asset('assets/img/vcard24/notes.png') }}" alt="notes" loading="lazy"/>
            </div>
            <div class="fusion-img text-end">
              <img src="{{ asset('assets/img/vcard24/fusion.png') }}" alt="fusion" loading="lazy"/>
            </div>
            <div class="ball-img text-end">
              <img src="{{ asset('assets/img/vcard24/ball.png') }}" alt="ball" loading="lazy"/>
            </div>
            <div class="section-heading text-center px-30">
              <h2 class="mb-0">Create Your VCard</h2>
            </div>
            <div class="pt-60 pb-60 mb-5 vcard-bg px-30">
              <div class="vcard-link-card card">
                <div class="d-flex justify-content-center align-items-center">
                  <a
                    href="https://vcards.infyom.com/marlonbrasil"
                    class="fw-6 text-pink link-text"
                    >https://vcards.infyom.com/marlonbrasil</a
                  >
                  <i
                    class="icon fa-solid fa-arrow-up-right-from-square text-pink ms-3"
                  ></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-img">
          <img src="{{ asset('assets/img/vcard24/main-bg.png') }}" class="w-100" loading="lazy"/>
        </div>
        <div class="add-to-contact-section pb-40">
          <div class="text-center">
            <button class="btn btn-cyan add-contact-btn rounded"><i
                class="fas fa-download fa-address-book"></i>
            &nbsp;Add to Contact</button>
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
    $().ready(function () {
      $(".gallery-slider").slick({
        arrows: true,
        infinite: false,
        dots: false,
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
              infinite: true,
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
              dots: false,
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
        dots: true,
        slidesToShow: 2,
        autoplay: true,
        responsive: [
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              arrows: false,
              dots: true,
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
    $(document).ready(function() {
        $('.dropdown1').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
        });
    });
</script>
</html>
