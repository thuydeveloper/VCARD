<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('assets/css/vcard27.css') }}">
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
            <div class="bg-img">
                <img src="{{ asset('assets/img/vcard27/bg-img.png') }}" alt="bg-img" />
            </div>
            <div class="banner-section position-relative bg-white">
                <div class="banner-img">
                    <img src="{{ asset('assets/img/vcard27/banner-img.png') }}" alt="banner-img" />
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
            <div class="profile-section pb-60 px-30">
                <div class="card d-flex flex-sm-row-reverse align-items-sm-end align-items-center mb-30">
                    <div class="card-img">
                        <img src="{{ asset('assets/img/vcard27/profile-img.png') }}"
                            class="w-100 h-100 object-fit-cover" />
                    </div>
                    <div class="card-body p-0 text-sm-start text-center mb-3">
                        <div class="profile-name">
                            <h2 class="text-primary mb-0 mt-4 fs-30">Richard Madden</h2>
                            <p class="fs-18 text-white mb-0">Pet Shop</p>
                        </div>
                    </div>
                </div>
                <p class="text-white profile-desc mb-30 fs-14 text-sm-start text-center">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book.
                </p>
                <div class="social-media pt-30 d-flex flex-wrap justify-content-sm-start justify-content-center">
                    <div
                        class="social-icons d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill mx-2">
                        <a href="" class="social-icon d-flex justify-content-center align-items-center">
                            <svg width="15" height="30" viewBox="0 0 15 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.18589 16.9334C3.52047 16.9334 2.90951 16.9334 2.29856 16.9334C1.77748 16.9334 1.2564 16.9432 0.736229 16.9294C0.191547 16.9157 0.0136171 16.7394 0.00907804 16.1566C-0.00272341 14.6295 -0.00363122 13.1014 0.00998585 11.5743C0.0154327 10.9964 0.206072 10.8132 0.743492 10.8093C1.75115 10.8025 2.75882 10.8074 3.76739 10.8074C3.89085 10.8074 4.01431 10.8074 4.18589 10.8074C4.18589 10.6418 4.18407 10.4998 4.18589 10.3587C4.20949 8.96682 4.16047 7.56902 4.27122 6.18494C4.55173 2.6596 7.04547 0.1422 10.3245 0.0275941C11.6589 -0.0194235 12.997 0.0070239 14.3324 0.010942C14.8027 0.0119216 14.9933 0.219583 14.9951 0.72894C15.0015 2.15808 15.0015 3.5882 14.996 5.01734C14.9942 5.5649 14.8163 5.76374 14.2943 5.77648C13.3774 5.79998 12.4605 5.79998 11.5427 5.81566C10.5142 5.83231 10.0821 6.26624 10.0603 7.36234C10.0385 8.47019 10.0557 9.58001 10.0557 10.731C10.211 10.731 10.3317 10.731 10.4525 10.731C11.619 10.731 12.7855 10.729 13.952 10.7319C14.6874 10.7329 14.8599 10.9171 14.8608 11.6968C14.8617 13.1504 14.8635 14.605 14.8599 16.0586C14.858 16.709 14.6992 16.8844 14.0928 16.8873C12.7683 16.8932 11.4438 16.8893 10.0567 16.8893C10.0567 17.0597 10.0567 17.2115 10.0567 17.3624C10.0567 21.1865 10.0567 25.0116 10.0567 28.8357C10.0567 29.8897 9.95317 29.9994 8.96003 29.9994C7.65733 29.9994 6.35554 30.0013 5.05284 29.9984C4.35565 29.9974 4.18589 29.8162 4.18589 29.0717C4.18498 25.1859 4.18498 21.3001 4.18498 17.4153C4.18589 17.2713 4.18589 17.1273 4.18589 16.9334Z"
                                    fill="#ffffff" />
                            </svg>
                        </a>
                    </div>
                    <div
                        class="social-icons d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill mx-2">
                        <a href="" class="social-icon d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                viewBox="0 0 30 30" fill="none">
                                <path
                                    d="M30 13.4708C30 14.0572 30 14.6429 30 15.2294C29.953 15.6155 29.9147 16.0023 29.8581 16.3869C29.4001 19.4975 28.0812 22.189 25.8728 24.4306C23.5055 26.8336 20.6362 28.2502 17.2838 28.6385C14.3527 28.9783 11.562 28.4645 8.93891 27.0986C8.75806 27.0046 8.60441 26.9679 8.39341 27.0435C6.84074 27.5999 5.28071 28.135 3.72436 28.6818C2.48193 29.1178 1.2417 29.5603 0 30C0.0257309 29.8774 0.0374936 29.7504 0.078663 29.633C0.997623 27.001 1.91511 24.3674 2.84878 21.7405C2.95832 21.433 2.95023 21.1944 2.79731 20.8964C1.388 18.1543 0.924106 15.2426 1.37623 12.2032C1.83057 9.14836 3.1502 6.49428 5.33659 4.30555C8.57941 1.05989 12.5206 -0.342743 17.0816 0.0704882C19.8539 0.321509 22.3469 1.34468 24.523 3.08788C27.3571 5.35735 29.1296 8.27272 29.7721 11.8545C29.8677 12.3896 29.925 12.932 30 13.4708ZM12.3479 11.8406C12.3663 11.8083 12.3692 11.798 12.3758 11.7914C12.7544 11.4097 13.1352 11.031 13.5109 10.6471C13.952 10.1957 13.952 9.71058 13.5065 9.26065C12.8669 8.61549 12.2244 7.97252 11.5774 7.33396C11.1216 6.88403 10.6416 6.88403 10.1872 7.33102C9.71377 7.7971 9.25797 8.28153 8.77276 8.73513C8.22359 9.24891 8.06038 9.87793 8.13463 10.5958C8.25888 11.7892 8.75144 12.8498 9.36016 13.8561C10.943 16.472 13.0426 18.5984 15.5914 20.2806C16.6221 20.961 17.7168 21.5189 18.9445 21.7669C19.8885 21.9578 20.7207 21.822 21.3912 21.0469C21.7735 20.6051 22.2168 20.2153 22.6299 19.7991C23.1034 19.3213 23.1027 18.8486 22.6255 18.3679C22.0198 17.7579 21.4096 17.1517 20.8008 16.5447C20.2421 15.9876 19.801 15.9861 19.2452 16.5403C18.8806 16.9043 18.5174 17.2698 18.1572 17.631C15.5407 16.3502 13.6183 14.4301 12.3479 11.8406Z"
                                    fill="#ffffff" />
                            </svg>
                        </a>
                    </div>
                    <div
                        class="social-icons d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill mx-2">
                        <a href="" class="social-icon d-flex justify-content-center align-items-center">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M29.9796 18.1639C29.9698 16.7715 29.831 15.3871 29.4262 14.0417C28.9197 12.3568 28.0015 11.0017 26.3637 10.2287C25.0984 9.63189 23.7491 9.46457 22.3704 9.50567C19.9571 9.57807 18.0045 10.5095 16.6991 12.6151C16.6844 12.6386 16.6453 12.6474 16.5632 12.6944C16.5632 11.7698 16.5632 10.8862 16.5632 10.0017C14.5557 10.0017 12.5972 10.0017 10.6436 10.0017C10.6436 16.6845 10.6436 23.3408 10.6436 30C12.7116 30 14.7464 30 16.834 30C16.834 29.817 16.834 29.6722 16.834 29.5264C16.834 26.4013 16.8252 23.2752 16.8409 20.1501C16.8438 19.4564 16.8888 18.7578 16.9875 18.0719C17.2574 16.1913 18.2137 15.1747 19.9503 14.9693C21.858 14.7442 23.1898 15.4399 23.5672 17.4878C23.7011 18.2157 23.7598 18.9662 23.7647 19.7069C23.7862 22.9787 23.7764 26.2506 23.7774 29.5225C23.7774 29.6634 23.7774 29.8033 23.7774 29.9374C25.8797 29.9374 27.9233 29.9374 29.9855 29.9374C29.9914 29.8552 30.0002 29.7965 30.0002 29.7368C29.9953 25.8798 30.005 22.0218 29.9796 18.1639Z"
                                    fill="#ffffff" />
                                <path
                                    d="M0.515625 29.9863C2.58759 29.9863 4.64 29.9863 6.69926 29.9863C6.69926 23.3124 6.69926 16.6659 6.69926 9.99686C4.63511 9.99686 2.5915 9.99686 0.515625 9.99686C0.515625 16.6786 0.515625 23.3261 0.515625 29.9863Z"
                                    fill="#ffffff" />
                                <path
                                    d="M3.57681 0.00014291C1.61044 0.0177548 -0.000977359 1.64196 4.44761e-07 3.6047C0.000978248 5.60072 1.64858 7.25232 3.62667 7.24058C5.59402 7.22883 7.20739 5.58017 7.19566 3.59101C7.1849 1.595 5.55979 -0.017469 3.57681 0.00014291Z"
                                    fill="#ffffff" />
                            </svg>
                        </a>
                    </div>
                    <div
                        class="social-icons d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill mx-2">
                        <a href="" class="social-icon d-flex justify-content-center align-items-center">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M29.9966 6.91349C29.9966 12.3036 29.9966 17.6928 29.9966 23.0829C29.8783 23.6432 29.8086 24.2201 29.6334 24.7622C28.6117 27.9144 25.7768 29.9826 22.4503 29.9918C17.4812 30.0055 12.512 29.9991 7.54292 29.9936C5.94707 29.9918 4.47596 29.5506 3.1837 28.6059C1.04857 27.045 0.00118263 24.9218 0.00118263 22.2794C0.000265483 17.447 -0.00248597 12.6145 0.00576839 7.78203C0.00668554 7.28677 0.0296143 6.78233 0.118578 6.29624C0.622094 3.52461 2.19684 1.59126 4.79788 0.532865C5.46465 0.261388 6.20663 0.172424 6.91375 0C12.3038 0 17.693 0 23.0831 0C23.2931 0.0376032 23.5041 0.072455 23.7132 0.111892C26.4665 0.631917 28.3943 2.19107 29.4546 4.77286C29.7325 5.44696 29.8214 6.19811 29.9966 6.91349ZM27.479 14.9982C27.4827 14.9982 27.4864 14.9982 27.49 14.9982C27.49 12.5576 27.4854 10.1171 27.4928 7.67564C27.4946 6.89331 27.3901 6.13391 27.0406 5.43045C26.0941 3.52369 24.5506 2.51575 22.4164 2.50841C17.4665 2.49098 12.5166 2.50199 7.56676 2.50566C7.27511 2.50566 6.98162 2.53317 6.69363 2.57444C4.42185 2.89453 2.54077 4.94895 2.5261 7.24916C2.49217 12.3549 2.51234 17.4607 2.50959 22.5665C2.50959 23.2599 2.64533 23.9294 2.95074 24.5494C3.91008 26.4928 5.48299 27.4852 7.65389 27.4879C12.5451 27.4953 17.4362 27.4916 22.3274 27.487C22.6576 27.487 22.9905 27.4613 23.3179 27.4164C25.5457 27.111 27.4405 25.0336 27.4708 22.7875C27.5065 20.192 27.479 17.5955 27.479 14.9982Z"
                                    fill="#ffffff" />
                                <path
                                    d="M22.4963 15.0348C22.4568 19.1877 19.0551 22.5491 14.9463 22.495C10.798 22.4408 7.4614 19.0648 7.50083 14.9596C7.54027 10.8049 10.9392 7.44726 15.0499 7.49953C19.1991 7.55365 22.5357 10.9297 22.4963 15.0348ZM15.0031 10.0052C12.2443 10.0006 10.0175 12.2201 10.0065 14.9862C9.99457 17.7414 12.2122 19.9728 14.9802 19.9911C17.7436 20.0086 19.9943 17.7652 19.9915 14.9954C19.9888 12.233 17.7656 10.0098 15.0031 10.0052Z"
                                    fill="#ffffff" />
                                <path
                                    d="M23.137 8.7386C22.0933 8.74594 21.2568 7.91592 21.2568 6.87312C21.2578 5.84682 22.0786 5.0168 23.1086 5.00029C24.1257 4.98378 24.9988 5.84958 24.9979 6.87403C24.9979 7.89482 24.1624 8.73126 23.137 8.7386Z"
                                    fill="#ffffff" />
                            </svg>
                        </a>
                    </div>
                    <div
                        class="social-icons d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill mx-2">
                            <a href="" class="social-icon d-flex justify-content-center align-items-center">
                                <svg width="30" height="25" viewBox="0 0 30 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.86746 19.3457C6.05158 18.9801 4.18335 17.6534 3.12739 15C4.03443 15 4.83317 15 5.61836 15C2.76187 13.8763 1.15086 11.9134 0.947787 8.79963C1.81421 9.04332 2.61295 9.27346 3.41169 9.49007C3.4523 9.43591 3.49291 9.38176 3.53353 9.32761C2.34219 8.36642 1.4893 7.17508 1.19147 5.65884C0.893636 4.14259 1.02901 2.6805 1.85483 1.17779C5.26638 5.06317 9.43605 7.324 14.5669 7.64891C14.5669 7.08032 14.5534 6.59295 14.5669 6.10559C14.6481 3.51985 15.9207 1.63808 18.2357 0.595663C20.4965 -0.41968 22.7167 -0.148922 24.6662 1.44855C25.2077 1.8953 25.6951 1.99007 26.3043 1.74638C27.2384 1.38086 28.1725 1.01534 29.1879 0.636277C28.7546 1.99007 27.8611 2.91064 26.927 3.91245C27.9018 3.65523 28.8765 3.38447 29.8512 3.12725C29.8918 3.16787 29.946 3.20848 29.9866 3.24909C29.2149 4.04783 28.4839 4.91425 27.6445 5.63176C27.1842 6.02436 27.0083 6.41696 26.9947 6.99909C26.9135 11.074 25.6951 14.7698 23.177 17.9919C19.7925 22.3375 15.298 24.5307 9.76096 24.639C6.59309 24.7067 3.62829 24.0433 0.839484 22.5406C0.568726 22.3917 0.297968 22.2292 0.0136719 21.9991C3.22216 22.148 6.14634 21.3899 8.86746 19.3457Z"
                                        fill="#ffffff" />
                                </svg>
                            </a>
                    </div>
                </div>
            </div>
            <div class="contact-section pt-30 pb-30 px-30">
                <div class="bg-img1">
                    <img src="{{ asset('assets/img/vcard27/bg-img1.png') }}" alt="bg-img" />
                </div>
                <div class="bg-img2">
                    <img src="{{ asset('assets/img/vcard27/bg-img2.png') }}" alt="bg-img" />
                </div>
                <div class="bg-img3 text-end">
                    <img src="{{ asset('assets/img/vcard27/bg-img3.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading">
                    <h2>Contact</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-sm-0 mb-4">
                        <div class="contact-box d-flex align-items-center mb-3">
                            <div class="contact-icon d-flex justify-content-center align-items-center bg-orange">
                                <svg width="22" height="15" viewBox="0 0 22 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.0229 0.00124986C13.824 0.00124986 16.6195 -0.00374959 19.4206 0.00624932C19.7869 0.00624932 20.1589 0.0412455 20.5139 0.111238C21.1508 0.241224 21.5904 0.601185 21.8666 1.12113C22.1089 1.57608 22.03 1.82605 21.5566 2.09102C20.9423 2.43599 20.3223 2.77595 19.708 3.12091C17.0253 4.63575 14.3425 6.14058 11.671 7.66542C11.1863 7.94539 10.8031 7.93539 10.3184 7.66042C7.06643 5.80562 3.79755 3.97582 0.534299 2.13602C0.466667 2.09602 0.393399 2.06103 0.331403 2.02103C0.0101504 1.82605 -0.0518457 1.67107 0.0608744 1.3461C0.337039 0.546191 1.02463 0.0812412 2.03348 0.0312466C2.43927 0.0112488 2.84506 0.0112488 3.24522 0.00624932C5.83778 0.00624932 8.43034 0.00624932 11.0229 0.00124986Z"
                                        fill="#ffffff" />
                                    <path
                                        d="M10.9765 14.995C8.13035 14.995 5.2898 15 2.44362 14.99C2.08855 14.99 1.72221 14.955 1.37841 14.87C0.685182 14.695 0.256845 14.2601 0.0483128 13.6551C-0.0587713 13.3402 0.00322478 13.1852 0.324477 13.0052C2.95086 11.5404 5.57723 10.0755 8.20361 8.61069C8.47978 8.4557 8.77285 8.4557 9.04901 8.60069C9.54498 8.86066 10.0297 9.13063 10.5144 9.4056C10.9145 9.63558 11.0836 9.64058 11.4725 9.4156C11.9854 9.12063 12.5039 8.83566 13.0168 8.54069C13.2929 8.38071 13.5409 8.43071 13.7945 8.57569C14.6343 9.05564 15.4741 9.53059 16.3195 10.0055C18.0441 10.9754 19.7743 11.9353 21.499 12.9052C22.0287 13.2002 22.1133 13.4452 21.854 13.9401C21.499 14.61 20.8564 14.895 20.073 14.98C19.8758 15 19.6785 15 19.4813 15C16.6464 14.995 13.8114 14.995 10.9765 14.995Z"
                                        fill="#ffffff" />
                                    <path
                                        d="M0.0429635 11.5204C0.0429635 8.83066 0.0429635 6.18595 0.0429635 3.49624C2.42136 4.8411 4.76594 6.16095 7.14997 7.50581C4.77157 8.85066 2.42699 10.1755 0.0429635 11.5204Z"
                                        fill="#ffffff" />
                                    <path
                                        d="M14.871 7.50581C17.2438 6.16596 19.5884 4.8411 21.9667 3.49624C21.9667 6.17595 21.9667 8.81567 21.9667 11.5104C19.594 10.1755 17.2494 8.85067 14.871 7.50581Z"
                                        fill="#ffffff" />
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <a href="mailto:jackie@gmail.com" class="text-black fw-5">jackie@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-box d-flex align-items-center mb-3">
                            <div class="contact-icon d-flex justify-content-center align-items-center bg-blue">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.03788 8.65636C5.68074 11.8074 8.01407 14.1974 11.0974 15.8383C11.2284 15.9096 11.5379 15.8264 11.6688 15.7075C12.3712 15.0416 13.0617 14.3639 13.7284 13.6623C14.0974 13.2699 14.5022 13.2105 15.0141 13.3056C16.2284 13.5196 17.4545 13.7337 18.6807 13.8763C19.6569 13.9952 20.0022 14.3163 20.0022 15.3151C20.0022 16.3853 20.0022 17.4435 20.0022 18.5137C20.0022 19.6671 19.6331 20.0238 18.4545 20C10.0736 19.8573 2.57359 13.912 0.597401 5.75505C0.252163 4.31629 0.14502 2.80618 0.0140678 1.31986C-0.0692655 0.439952 0.41883 0.0118906 1.29978 0.0118906C2.46645 0 3.63312 0 4.79978 0C5.65693 0 6.01407 0.39239 6.12121 1.24851C6.28788 2.50892 6.51407 3.76932 6.75216 5.01784C6.8474 5.55291 6.75216 5.98098 6.35931 6.36147C5.57359 7.12247 4.81169 7.88347 4.03788 8.65636Z"
                                        fill="#ffffff" />
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <a href="tel:+1 4078461474" class="text-black fw-5">+1 4078461474</a>
                            </div>
                        </div>
                        <div class="contact-box d-flex align-items-center mb-3">
                            <div class="contact-icon d-flex justify-content-center align-items-center bg-green">
                                <svg width="24" height="20" viewBox="0 0 24 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1990_491)">
                                        <path
                                            d="M0.31262 20C0.211822 19.8165 0.0505452 19.6427 0.0203058 19.4495C-0.0300932 19.1019 0.0203058 18.7446 0.000146203 18.3969C-0.0099336 18.0782 0.131184 17.9141 0.473897 17.9237C0.574695 17.9237 0.675493 17.9237 0.776291 17.9237C8.26558 17.9237 15.7448 17.9237 23.2341 17.9334C23.4861 17.9334 23.7381 18.0299 23.9901 18.0782C23.9901 18.7156 23.9901 19.3626 23.9901 20C16.1077 20 8.2051 20 0.31262 20Z"
                                            fill="#ffffff" />
                                        <path
                                            d="M12.0254 8.18927C14.7167 8.18927 17.408 8.18927 20.1094 8.18927C21.6315 8.18927 22.3774 8.91356 22.3874 10.3814C22.3874 10.4008 22.3874 10.4104 22.3874 10.4297C22.5689 11.2796 22.1556 11.7624 21.3694 12.0908C20.5731 12.4191 19.807 12.4867 19.1115 11.9169C18.7688 11.6369 18.4866 11.2989 18.2043 10.9609C17.8314 10.5263 17.4786 10.5166 17.0956 10.9416C16.8436 11.2216 16.5916 11.5017 16.3093 11.7431C15.513 12.4288 14.6361 12.506 13.739 11.9556C13.3358 11.7045 12.9729 11.3858 12.6201 11.0671C12.1363 10.6325 11.9246 10.6325 11.4509 11.0864C11.1787 11.3472 10.8965 11.5983 10.584 11.8107C9.52563 12.5447 8.56805 12.4964 7.58023 11.6852C7.42903 11.5596 7.28791 11.4244 7.15687 11.2796C6.48153 10.536 6.34041 10.536 5.66506 11.3085C4.7478 12.3515 3.58863 12.5833 2.29841 12.0232C1.79442 11.8011 1.60291 11.4631 1.6533 10.9609C1.68354 10.7194 1.71378 10.478 1.68354 10.2462C1.51219 9.05842 2.51009 8.16996 3.8003 8.17961C6.53193 8.20858 9.27363 8.18927 12.0254 8.18927Z"
                                            fill="#ffffff" />
                                        <path
                                            d="M22.1861 16.62C15.4024 16.62 8.64894 16.62 1.86523 16.62C1.86523 15.606 1.86523 14.592 1.86523 13.5394C3.54856 14.0802 5.02021 13.7325 6.22979 12.4867C8.24575 14.3409 10.1004 14.0898 12.0458 12.4288C14.4549 14.4375 16.1886 13.9739 17.8316 12.3998C18.386 12.9696 18.9908 13.4911 19.8174 13.6939C20.6338 13.8967 21.3999 13.7325 22.2063 13.4042C22.1861 14.4858 22.1861 15.5287 22.1861 16.62Z"
                                            fill="#ffffff" />
                                        <path
                                            d="M10.5836 7.2815C10.5836 6.32544 10.5735 5.3887 10.5937 4.44229C10.6037 4.13326 10.8356 3.94978 11.1682 3.94978C11.7226 3.94012 12.277 3.94012 12.8213 3.94978C13.2043 3.94978 13.4261 4.16224 13.4261 4.51955C13.4462 5.42732 13.4362 6.34475 13.4362 7.2815C12.4786 7.2815 11.5512 7.2815 10.5836 7.2815Z"
                                            fill="#ffffff" />
                                        <path
                                            d="M12.015 0C12.257 0.424915 12.5392 0.907774 12.8113 1.40029C12.9323 1.6224 13.0936 1.84452 13.1641 2.08595C13.3153 2.61709 13.0734 3.19652 12.64 3.4283C12.2066 3.66007 11.5413 3.59247 11.1885 3.28344C10.8155 2.94544 10.6946 2.29841 10.9567 1.82521C11.2994 1.18783 11.6723 0.569773 12.015 0Z"
                                            fill="#ffffff" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1990_491">
                                            <rect width="24" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <p class="mb-0 text-black fw-5">12th June, 1990</p>
                            </div>
                        </div>
                        <div class="contact-box d-flex align-items-center">
                            <div class="contact-icon d-flex justify-content-center align-items-center bg-pink">
                                <svg width="18" height="24" viewBox="0 0 18 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1990_518)">
                                        <path
                                            d="M8.99374 19.6847C8.69236 19.3226 8.4028 18.979 8.11915 18.6322C6.58862 16.7439 5.14082 14.7906 3.88803 12.6887C3.32368 11.7446 2.83024 10.7633 2.40772 9.73866C1.63064 7.84726 1.7636 5.98682 2.62046 4.1852C3.72847 1.85732 5.54561 0.470506 8.00392 0.0835592C11.7859 -0.510791 15.3788 2.26904 15.9964 6.19732C16.1973 7.48508 16.0052 8.69236 15.5236 9.87487C14.9859 11.1936 14.2915 12.4194 13.5351 13.605C12.1848 15.7162 10.675 17.6943 9.06761 19.595C9.04988 19.6166 9.0292 19.6414 8.99374 19.6847ZM12.5482 6.80405C12.5512 4.75478 10.9557 3.08627 8.9967 3.08627C7.03478 3.08627 5.4422 4.75169 5.4422 6.80096C5.4422 8.85023 7.03478 10.5187 8.99374 10.5187C10.9527 10.5187 12.5453 8.85642 12.5482 6.80405Z"
                                            fill="#ffffff" />
                                        <path
                                            d="M6.23156 17.1619C5.88881 17.2145 5.54902 17.264 5.21219 17.3259C4.19577 17.5086 3.20004 17.7655 2.26045 18.2267C1.89406 18.4094 1.54541 18.6199 1.25881 18.9263C0.797873 19.4216 0.797873 19.9293 1.27062 20.4153C1.67246 20.8301 2.17181 21.0716 2.68888 21.2821C3.69052 21.6845 4.73648 21.9043 5.79722 22.0529C7.25979 22.2603 8.73123 22.3098 10.2056 22.2355C11.8573 22.1519 13.4912 21.9352 15.0661 21.3719C15.5329 21.2047 15.988 21.0066 16.3898 20.697C16.57 20.5577 16.7444 20.3967 16.8832 20.2141C17.1521 19.8612 17.161 19.4681 16.8832 19.1245C16.6941 18.8892 16.4607 18.6756 16.2125 18.5084C15.5182 18.041 14.7381 17.7748 13.9404 17.5829C13.2785 17.425 12.6078 17.3228 11.94 17.1959C11.8809 17.1835 11.8248 17.1743 11.7657 17.165C11.875 16.9235 11.8957 16.9173 12.135 16.9359C13.1219 17.0164 14.1058 17.1278 15.072 17.3538C15.5979 17.4745 16.118 17.62 16.5937 17.8831C16.8921 18.0472 17.1876 18.2391 17.4328 18.4744C18.0622 19.0811 18.1744 19.9231 17.7726 20.7156C17.5569 21.1428 17.2407 21.4802 16.8803 21.7743C16.0943 22.4151 15.1991 22.8392 14.2595 23.1642C12.2828 23.8483 10.247 24.0743 8.17279 23.9814C6.58021 23.9071 5.02309 23.6378 3.51619 23.0744C2.58842 22.7277 1.70496 22.2943 0.948562 21.6133C0.617636 21.3161 0.33694 20.9694 0.159659 20.5453C-0.138766 19.8303 -0.00284963 19.0749 0.520131 18.5208C0.957426 18.0565 1.50995 17.7996 2.08612 17.5983C2.87502 17.3228 3.69052 17.1804 4.51192 17.0752C4.96695 17.0164 5.42197 16.9823 5.87995 16.9328C6.10155 16.9111 6.11928 16.9235 6.23156 17.1619Z"
                                            fill="#ffffff" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1990_518">
                                            <rect width="18" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="contact-desc">
                                <p class="mb-0 text-black fw-5">New York, USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="pet-img">
                            <img src="{{ asset('assets/img/vcard27/contact-img.png') }}" alt="pet"
                                class="w-100" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="our-services-section pt-60 pb-60 px-30">
                <div class="services-bg-img img-1">
                    <img src="{{ asset('assets/img/vcard27/services-bg-img1.png') }}" alt="bg-img" />
                </div>
                <div class="services-bg-img img-2 text-end">
                    <img src="{{ asset('assets/img/vcard27/services-bg-img2.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading">
                    <h2>Our Services</h2>
                </div>
                <div class="services">
                    <div class="row">
                        <div class="col-sm-6 mb-sm-0 mb-40">
                            <div class="service-card h-100">
                                <div class="card-img mx-auto d-flex justify-content-center align-items-center mb-20">
                                    <img src="{{ asset('assets/img/vcard27/service-img1.png') }}" class="h-100" />
                                </div>
                                <div class="card-body text-center p-0">
                                    <h3 class="card-title fs-18 text-black mb-10">
                                        Healthcare
                                    </h3>
                                    <p class="mb-0 fs-14 text-gray-100 text-center">
                                        It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card h-100">
                                <div class="card-img mx-auto d-flex justify-content-center align-items-center mb-20">
                                    <img src="{{ asset('assets/img/vcard27/service-img2.png') }}" class="h-100" />
                                </div>
                                <div class="card-body text-center p-0">
                                    <h3 class="card-title fs-18 text-black mb-10">
                                        Pet Supplies
                                    </h3>
                                    <p class="mb-0 fs-14 text-gray-100 text-center">
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
            <div class="appointment-section pt-30 pb-30 px-30">
                <div class="appointment-bg img-1">
                    <img src="{{ asset('assets/img/vcard27/appointment-bg-img1.png') }}" alt="bg-img" />
                </div>
                <div class="appointment-bg img-2 text-end">
                    <img src="{{ asset('assets/img/vcard27/appointment-bg-img2.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading">
                    <h2>Make an Appointment</h2>
                </div>
                <div class="appointment">
                    <div class="mb-30">
                        <label for="date" class="appoint-date text-black fs-18 mb-1">Date:</label>
                        <div class="row">
                            <div class="col-12">
                                <div class="position-relative">
                                    <input type="text" class="form-control appointment-input"
                                        placeholder="Pick a date" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <label class="text-black fs-18 mb-10">Hour :</label>
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3">
                                <div class="hour-input d-flex justify-content-center align-items-center">
                                    <span class="text-black fw-5">8:10 - 20:00</span>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="hour-input d-flex justify-content-center align-items-center">
                                    <span class="text-black fw-5">8:10 - 20:00</span>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="hour-input d-flex justify-content-center align-items-center">
                                    <span class="text-black fw-5">8:10 - 20:00</span>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="hour-input d-flex justify-content-center align-items-center">
                                    <span class="text-black fw-5">8:10 - 20:00</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary w-100">
                                Make an Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery-section pt-60 pb-60">
                <div class="section-heading px-30">
                    <h2 class="text-white">Gallery</h2>
                </div>
                <div class="gallery-slider">
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard27/gallery-img.png') }}" />
                        </div>
                    </div>
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard27/gallery-img.png') }}" />
                        </div>
                    </div>
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/vcard27/gallery-img.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section pt-30 pb-30 px-3">
                <div class="section-heading px-3">
                    <h2 class="mb-0">Products</h2>
                </div>
                <div class="product-slider">
                    <div class="">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard27/product-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" />
                            </div>
                            <div class="product-desc card-body p-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h3 class="text-black fs-18 fw-5 mb-0">Lorem Ipsum</h3>
                                    <p class="amount fs-18 mb-0 text-secondary">$125</p>
                                </div>
                                <p class="fs-14 text-gray-500 mb-0">
                                    It is a long established
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="product-card card">
                            <div class="product-img card-img">
                                <img src="{{ asset('assets/img/vcard27/product-img2.png') }}"
                                    class="w-100 h-100 object-fit-cover" />
                            </div>
                            <div class="product-desc card-body p-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h3 class="text-black fs-18 fw-5 mb-0">Lorem Ipsum</h3>
                                    <p class="amount fs-18 mb-0 text-secondary">$125</p>
                                </div>
                                <p class="fs-14 text-gray-500 mb-0">
                                    It is a long established
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-section pt-60">
                <div class="testimonial-bg img-1">
                    <img src="{{ asset('assets/img/vcard27/testimonial-bg-img1.png') }}" alt="bg-img" />
                </div>
                <div class="testimonial-bg img-2 text-end">
                    <img src="{{ asset('assets/img/vcard27/testimonial-bg-img2.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading text-center px-30">
                    <h2>Testimonials</h2>
                </div>
                <div class="pt-60">
                    <div class="testimonial-slider">
                        <div class="py-1 px-sm-4">
                            <div class="testimonial-card card px-30">
                                <div class="testimonial-profile-img">
                                    <img src="{{ asset('assets/img/vcard27/testimonial-img.png') }}"
                                        class="w-100 h-100 object-fit-cover" />
                                </div>
                                <div class="card-body p-0 pt-3">
                                    <div class="text-center">
                                        <h3 class="text-black fs-20 mb-0">Jane Doe</h3>
                                        <p class="fs-6 text-black mb-2">CEO</p>
                                        <div class="d-flex gap-sm-3 gap-2">
                                            <div class="quote-left">
                                                <img src="{{ asset('assets/img/vcard27/quote-left.png') }}"
                                                    alt="quote" />
                                            </div>
                                            <p class="desc text-gray-100 fs-14 mb-0">
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy text.
                                            </p>
                                            <div class="quote-right mt-auto">
                                                <img src="{{ asset('assets/img/vcard27/quote-right.png') }}"
                                                    alt="quote" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 px-sm-4">
                            <div class="testimonial-card card px-30">
                                <div class="testimonial-profile-img">
                                    <img src="{{ asset('assets/img/vcard27/testimonial-img.png') }}"
                                        class="w-100 h-100 object-fit-cover" />
                                </div>
                                <div class="card-body p-0 pt-3">
                                    <div class="text-center">
                                        <h3 class="text-black fs-20 mb-0">Jane Doe</h3>
                                        <p class="fs-6 text-black mb-2">CEO</p>
                                        <div class="d-flex gap-sm-3 gap-2">
                                            <div class="quote-left">
                                                <img src="{{ asset('assets/img/vcard27/quote-left.png') }}"
                                                    alt="quote" />
                                            </div>
                                            <p class="desc text-gray-100 fs-14 mb-0">
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy text.
                                            </p>
                                            <div class="quote-right mt-auto">
                                                <img src="{{ asset('assets/img/vcard27/quote-right.png') }}"
                                                    alt="quote" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-section pt-30 pb-30 px-3">
                <div class="blog-bg-img">
                    <img src="{{ asset('assets/img/vcard27/blog-bg-img.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading px-3">
                    <h2 class="mb-0">Blog</h2>
                </div>
                <div class="blog-slider">
                    <div>
                        <div class="blog-card card">
                            <div class="card-img mb-3">
                                <img src="{{ asset('assets/img/vcard27/blog-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" />
                            </div>
                            <div class="card-body p-0">
                                <h2 class="fs-18 text-black">Dog</h2>
                                <p class="text-gray-500 blog-desc fs-14 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and type
                                    setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="blog-card card">
                            <div class="card-img mb-3">
                                <img src="{{ asset('assets/img/vcard27/blog-img2.png') }}"
                                    class="w-100 h-100 object-fit-cover" />
                            </div>
                            <div class="card-body p-0">
                                <h2 class="fs-18 text-black">Cat</h2>
                                <p class="text-gray-500 blog-desc fs-14 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and type
                                    setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="blog-card card">
                            <div class="card-img mb-3">
                                <img src="{{ asset('assets/img/vcard27/blog-img1.png') }}"
                                    class="w-100 h-100 object-fit-cover" />
                            </div>
                            <div class="card-body p-0">
                                <h2 class="fs-18 text-black">Dog</h2>
                                <p class="text-gray-500 blog-desc fs-14 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and type
                                    setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="blog-card card">
                            <div class="card-img mb-3">
                                <img src="{{ asset('assets/img/vcard27/blog-img2.png') }}"
                                    class="w-100 h-100 object-fit-cover" />
                            </div>
                            <div class="card-body p-0">
                                <h2 class="fs-18 text-black">Cat</h2>
                                <p class="text-gray-500 blog-desc fs-14 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and type
                                    setting industry.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="business-hour-section pt-60 pb-60 px-30">
                <div class="section-heading">
                    <h2 class="text-white">Business Hours</h2>
                </div>
                <div class="">
                    <div class="business-hour-card row justify-content-center">
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Sunday :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Monday :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Tueday :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Wednesday :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Thursday :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="business-hour">
                                <span class="me-2">Friday :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="business-hour">
                                <span class="me-2">Saturday :</span>
                                <span>Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qr-code-section pt-30 px-30">
                <div class="qr-code-bg-img text-end">
                    <img src="{{ asset('assets/img/vcard27/qr-code-bg-img.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading">
                    <h2>QR Code</h2>
                </div>
                <div class="qr-code d-flex justify-content-center align-items-center flex-wrap mb-30">
                    <div class="qr-profile-img">
                        <img src="{{ asset('assets/img/vcard27/qr-profile-img.png') }}"
                            class="w-100 h-100 object-fit-cover" />
                    </div>
                    <div class="qr-code-img">
                        <img src="{{ asset('assets/img/vcard27/qr-code-img.png') }}"
                            class="w-100 h-100 object-fit-cover" />
                    </div>
                </div>
            </div>
            <div class="contact-us-section pt-60 px-30">
                <div class="contact-us-bg-img">
                    <img src="{{ asset('assets/img/vcard27/contact-us-bg.png') }}" alt="bg-img" />
                </div>
                <div class="contact-bg-img img-1">
                    <img src="{{ asset('assets/img/vcard27/contact-bg-img1.png') }}" alt="bg-img" />
                </div>
                <div class="contact-bg-img img-2 text-end">
                    <img src="{{ asset('assets/img/vcard27/contact-bg-img2.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading">
                    <h2>Inquiries</h2>
                </div>
                <div class="contact-form">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Full Name" />
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" placeholder="Email Address" />
                            </div>
                            <div class="col-12">
                                <input type="tel" class="form-control" placeholder="Phone Number" />
                            </div>

                            <div class="col-12 mb-30">
                                <textarea class="form-control h-100" placeholder="Your Message" rows="3"></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button class="send-btn rounded-2 btn btn-secondary" type="submit">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="create-vcard-section pt-60 pb-60 px-30 mb-5">
                <div class="create-vcard-bg-img text-end">
                    <img src="{{ asset('assets/img/vcard27/create-vcard-bg.png') }}" alt="bg-img" />
                </div>
                <div class="section-heading">
                    <h2>Create Your VCard</h2>
                </div>
                <div class="pb-5">
                    <div class="vcard-link-card card mx-sm-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="https://vcards.infyom.com/marlonbrasil"
                                class="text-black link-text fw-5">https://vcards.infyom.com/marlonbrasil</a>
                            <i class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-to-contact-section">
                <div class="text-center ">
                    <div class="text-center d-flex align-items-center justify-content-center">
                        <a href="" class="add-contact-btn rounded-2 btn-primary"><i
                                class="fas fa-download fa-address-book"></i>
                            &nbsp;{{ __('messages.setting.add_contact') }}</a>
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
            arrows: true,
            infinite: false,
            dots: false,
            slidesToShow: 1,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    infinite: true,
                    arrows: false,
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
                },
            }, ],
        });
        $(".testimonial-slider").slick({
            arrows: false,
            infinite: true,
            dots: true,
            slidesToShow: 1,
            autoplay: true,
        });
        $(".blog-slider").slick({
            arrows: false,
            infinite: true,
            dots: false,
            slidesToShow: 2,
            autoplay: true,
            responsive: [{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
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
