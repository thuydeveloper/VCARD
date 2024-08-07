<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard13.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">


    {{--google Font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container p-0">
        <div class="main-content mx-auto w-100 overflow-hidden">
            <div class="banner-section position-relative">
                <div class="banner-img">
                    <img src="{{asset('assets/img/vcard13/banner.png')}}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
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

                    <div class="overlay"></div>
                </div>
            </div>
            <div class="profile-section px-30">
                <div class="card d-flex flex-sm-row-reverse align-items-sm-end align-items-center justify-content-end">
                    <div class="card-img d-flex justify-content-center align-items-center">
                        <img src="{{asset('assets/img/vcard13/profile.png')}}" class="img-fluid" loading="lazy"/>
                    </div>
                    <div class="card-body pb-0 px-0">
                        <div class="profile-name">
                            <h2 class="text-primary mb-0 fs-28">Pallavi Hegde</h2>
                            <p class="fs-18 text-black mb-0 fw-5">Doctor at Doctored</p>
                        </div>
                    </div>
                </div>
                <p class="text-gray-100 profile-desc mb-40">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book.
                </p>
            </div>
            <div class="social-media d-flex justify-content-center bg-primary-light mb-40">
                <div class="social-media-icon flex-1 d-flex justify-content-center">
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="13" height="25" viewBox="0 0 13 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.73824 14.1111C3.18372 14.1111 2.67459 14.1111 2.16547 14.1111C1.73123 14.1111 1.297 14.1193 0.863524 14.1079C0.409622 14.0964 0.261348 13.9495 0.257565 13.4638C0.24773 12.1912 0.246974 10.9179 0.258322 9.64528C0.262861 9.16368 0.421726 9.01103 0.869577 9.00777C1.7093 9.00205 2.54901 9.00613 3.38949 9.00613C3.49237 9.00613 3.59526 9.00613 3.73824 9.00613C3.73824 8.86818 3.73673 8.74982 3.73824 8.63228C3.75791 7.47235 3.71706 6.30752 3.80935 5.15412C4.04311 2.21633 6.12123 0.1185 8.85372 0.0229951C9.96578 -0.0161863 11.0809 0.00585325 12.1937 0.00911836C12.5856 0.00993464 12.7444 0.182986 12.7459 0.60745C12.7512 1.7984 12.7512 2.99016 12.7467 4.18111C12.7452 4.63741 12.5969 4.80312 12.1619 4.81373C11.3978 4.83332 10.6338 4.83332 9.86895 4.84638C9.01183 4.86026 8.65173 5.22187 8.63357 6.13528C8.61542 7.05849 8.62979 7.98334 8.62979 8.94246C8.75915 8.94246 8.85977 8.94246 8.96038 8.94246C9.93249 8.94246 10.9046 8.94083 11.8767 8.94328C12.4895 8.9441 12.6332 9.09756 12.634 9.74731C12.6347 10.9587 12.6362 12.1708 12.6332 13.3822C12.6317 13.9242 12.4993 14.0703 11.994 14.0728C10.8902 14.0777 9.78649 14.0744 8.63055 14.0744C8.63055 14.2164 8.63055 14.343 8.63055 14.4687C8.63055 17.6554 8.63055 20.843 8.63055 24.0297C8.63055 24.908 8.54431 24.9995 7.71669 24.9995C6.63111 24.9995 5.54628 25.0011 4.4607 24.9986C3.8797 24.9978 3.73824 24.8468 3.73824 24.2264C3.73748 20.9883 3.73748 17.7501 3.73748 14.5127C3.73824 14.3927 3.73824 14.2728 3.73824 14.1111Z"
                                fill="#1C344F" />
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25 11.2256C25 11.7143 25 12.2024 25 12.6912C24.9608 13.0129 24.9289 13.3352 24.8818 13.6557C24.5001 16.2479 23.401 18.4908 21.5606 20.3588C19.5879 22.3613 17.1968 23.5418 14.4032 23.8654C11.9606 24.1486 9.63499 23.7204 7.44909 22.5821C7.29838 22.5039 7.17034 22.4733 6.99451 22.5363C5.70062 22.9999 4.40059 23.4458 3.10363 23.9015C2.06827 24.2648 1.03475 24.6336 0 25C0.0214424 24.8979 0.0312446 24.792 0.0655525 24.6942C0.831352 22.5008 1.59593 20.3062 2.37398 18.1171C2.46526 17.8608 2.45852 17.662 2.33109 17.4137C1.15666 15.1286 0.770088 12.7022 1.14686 10.1693C1.52547 7.62363 2.62516 5.4119 4.44715 3.58796C7.14951 0.883244 10.4339 -0.285619 14.2347 0.0587402C16.545 0.267925 18.6224 1.12056 20.4358 2.57323C22.7976 4.46446 24.2746 6.89393 24.8101 9.87878C24.8897 10.3247 24.9375 10.7767 25 11.2256ZM10.2899 9.86716C10.3052 9.84025 10.3077 9.83169 10.3132 9.82618C10.6287 9.50812 10.946 9.19251 11.2591 8.87262C11.6267 8.49645 11.6267 8.09215 11.2554 7.71721C10.7224 7.17957 10.187 6.64377 9.64785 6.11163C9.26802 5.73669 8.86796 5.73669 8.48935 6.10918C8.09481 6.49758 7.71498 6.90127 7.31063 7.27927C6.85299 7.70743 6.71698 8.23161 6.77886 8.8298C6.8824 9.82435 7.29287 10.7082 7.80013 11.5468C9.11915 13.7267 10.8688 15.4986 12.9929 16.9005C13.8518 17.4675 14.764 17.9324 15.7871 18.1391C16.5737 18.2981 17.2673 18.185 17.826 17.5391C18.1446 17.1709 18.514 16.8461 18.8583 16.4993C19.2528 16.1011 19.2522 15.7072 18.8546 15.3066C18.3498 14.7983 17.8413 14.2931 17.334 13.7872C16.8684 13.323 16.5008 13.3218 16.0377 13.7836C15.7338 14.0869 15.4312 14.3915 15.131 14.6925C12.9506 13.6251 11.3485 12.0251 10.2899 9.86716Z"
                                fill="#1C344F" />
                        </svg>
                    </a>
                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M24.9825 15.1366C24.9744 13.9763 24.8587 12.8226 24.5213 11.7014C24.0992 10.2974 23.3341 9.1681 21.9693 8.52396C20.9149 8.02659 19.7904 7.88716 18.6415 7.9214C16.6305 7.98174 15.0032 8.75797 13.9154 10.5126C13.9032 10.5322 13.8706 10.5395 13.8022 10.5787C13.8022 9.80816 13.8022 9.07188 13.8022 8.33479C12.1293 8.33479 10.4972 8.33479 8.86914 8.33479C8.86914 13.9037 8.86914 19.4507 8.86914 25C10.5925 25 12.2882 25 14.0279 25C14.0279 24.8475 14.0279 24.7269 14.0279 24.6054C14.0279 22.0011 14.0205 19.396 14.0336 16.7918C14.036 16.2137 14.0735 15.6315 14.1558 15.0599C14.3807 13.4928 15.1776 12.6456 16.6248 12.4744C18.2145 12.2869 19.3243 12.8666 19.6388 14.5731C19.7505 15.1798 19.7994 15.8052 19.8034 16.4224C19.8214 19.149 19.8132 21.8755 19.814 24.6021C19.814 24.7195 19.814 24.8361 19.814 24.9478C21.5659 24.9478 23.2689 24.9478 24.9874 24.9478C24.9923 24.8793 24.9996 24.8304 24.9996 24.7807C24.9956 21.5665 25.0037 18.3515 24.9825 15.1366Z"
                                fill="#1C344F" />
                            <path
                                d="M0.429565 24.9886C2.1562 24.9886 3.86655 24.9886 5.58259 24.9886C5.58259 19.427 5.58259 13.8882 5.58259 8.33069C3.86247 8.33069 2.15946 8.33069 0.429565 8.33069C0.429565 13.8988 0.429565 19.4384 0.429565 24.9886Z"
                                fill="#1C344F" />
                            <path
                                d="M2.98067 0.000119092C1.34204 0.0147956 -0.000814466 1.3683 3.70634e-07 3.00392C0.000815207 4.66726 1.37381 6.0436 3.02223 6.03381C4.66168 6.02403 6.00616 4.65014 5.99638 2.99251C5.98742 1.32916 4.63316 -0.0145575 2.98067 0.000119092Z"
                                fill="#1C344F" />
                        </svg>
                    </a>

                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M24.9972 5.76124C24.9972 10.253 24.9972 14.744 24.9972 19.2357C24.8986 19.7027 24.8405 20.1834 24.6945 20.6351C23.8431 23.262 21.4807 24.9855 18.7086 24.9931C14.5676 25.0046 10.4267 24.9993 6.28576 24.9947C4.95589 24.9931 3.72997 24.6255 2.65308 23.8383C0.873808 22.5375 0.000985528 20.7681 0.000985528 18.5662C0.000221236 14.5391 -0.00207164 10.5121 0.00480699 6.48502C0.00557128 6.07231 0.0246786 5.65194 0.098815 5.24687C0.518412 2.93718 1.8307 1.32605 3.99824 0.444054C4.55388 0.217823 5.17219 0.143687 5.76146 0C10.2532 0 14.7442 0 19.2359 0C19.411 0.031336 19.5867 0.0603791 19.761 0.0932437C22.0554 0.526598 23.662 1.8259 24.5455 3.97738C24.7771 4.53913 24.8512 5.16509 24.9972 5.76124ZM22.8992 12.4985C22.9022 12.4985 22.9053 12.4985 22.9084 12.4985C22.9084 10.4647 22.9045 8.43091 22.9107 6.39637C22.9122 5.74442 22.8251 5.11159 22.5339 4.52538C21.7451 2.93641 20.4588 2.09645 18.6803 2.09034C14.5554 2.07582 10.4305 2.08499 6.30563 2.08805C6.06259 2.08805 5.81802 2.11098 5.57803 2.14537C3.68488 2.41211 2.11731 4.12412 2.10508 6.04097C2.0768 10.2958 2.09362 14.5506 2.09133 18.8054C2.09133 19.3832 2.20444 19.9412 2.45895 20.4578C3.2584 22.0774 4.56916 22.9043 6.37824 22.9066C10.4542 22.9127 14.5302 22.9097 18.6062 22.9059C18.8813 22.9059 19.1587 22.8845 19.4316 22.847C21.2881 22.5925 22.8671 20.8614 22.8923 18.9896C22.9221 16.8267 22.8992 14.663 22.8992 12.4985Z"
                                fill="#1C344F" />
                            <path
                                d="M18.7465 12.5291C18.7136 15.9898 15.8788 18.7909 12.4548 18.7458C8.99792 18.7007 6.21742 15.8874 6.25029 12.4664C6.28315 9.00416 9.11562 6.20608 12.5412 6.24965C15.9988 6.29474 18.7793 9.1081 18.7465 12.5291ZM12.5022 8.33769C10.2032 8.33387 8.34751 10.1835 8.33834 12.4886C8.3284 14.7845 10.1765 16.644 12.4831 16.6593C14.7859 16.6738 16.6615 14.8044 16.6592 12.4962C16.6569 10.1942 14.8043 8.34152 12.5022 8.33769Z"
                                fill="#1C344F" />
                            <path
                                d="M19.2807 7.2822C18.4109 7.28831 17.7139 6.59663 17.7139 5.72763C17.7146 4.87238 18.3987 4.1807 19.257 4.16694C20.1046 4.15318 20.8322 4.87468 20.8314 5.72839C20.8314 6.57905 20.1351 7.27608 19.2807 7.2822Z"
                                fill="#1C344F" />
                        </svg>
                    </a>

                    <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="25" height="22" viewBox="0 0 25 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.38914 16.6214C5.04257 16.3168 3.48572 15.2112 2.60575 13C3.36162 13 4.02723 13 4.68156 13C2.30115 12.0637 0.95864 10.4278 0.789416 7.83307C1.51144 8.03614 2.17705 8.22792 2.84266 8.40843C2.87651 8.3633 2.91035 8.31818 2.9442 8.27305C1.95142 7.47206 1.24068 6.47928 0.992484 5.21574C0.744289 3.9522 0.857105 2.73379 1.54528 1.48153C4.38824 4.71935 7.86297 6.60338 12.1387 6.87413C12.1387 6.40031 12.1274 5.99417 12.1387 5.58803C12.2064 3.43325 13.2669 1.86511 15.196 0.996427C17.08 0.150308 18.9302 0.375939 20.5548 1.70717C21.006 2.07946 21.4122 2.15843 21.9198 1.95536C22.6983 1.65076 23.4767 1.34616 24.3228 1.03027C23.9618 2.15843 23.2172 2.92558 22.4388 3.76042C23.2511 3.54607 24.0633 3.32043 24.8756 3.10608C24.9094 3.13993 24.9546 3.17377 24.9884 3.20762C24.3454 3.87323 23.7362 4.59525 23.0367 5.19318C22.6531 5.52034 22.5065 5.84751 22.4952 6.33262C22.4275 9.72838 21.4122 12.8082 19.3138 15.4933C16.4934 19.1147 12.7479 20.9423 8.13373 21.0325C5.49384 21.0889 3.02317 20.5361 0.699163 19.2839C0.473531 19.1598 0.2479 19.0244 0.0109863 18.8326C2.68472 18.9567 5.12155 18.3249 7.38914 16.6214Z"
                                fill="#1C344F" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="contact-section">
                <div class="px-3 mx-1">
                    <div class="row">
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <svg width="34" height="27" viewBox="0 0 34 27" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_55_161)">
                                            <path
                                                d="M17.0325 -0.000637624C21.362 -0.000637624 25.6828 -0.0093176 30.0123 0.00804235C30.5785 0.00804235 31.1535 0.0688022 31.7023 0.190322C32.6866 0.416001 33.3661 1.04096 33.793 1.94368C34.1676 2.73355 34.0456 3.16755 33.3139 3.62759C32.3643 4.22651 31.4061 4.81675 30.4566 5.41567C26.31 8.0457 22.1635 10.6584 18.0343 13.3058C17.2852 13.7918 16.6928 13.7745 15.9436 13.2971C10.9172 10.0768 5.86471 6.89994 0.820896 3.70571C0.716361 3.63627 0.603114 3.57551 0.507291 3.50607C0.0107496 3.16755 -0.0850742 2.89847 0.0891508 2.33428C0.516002 0.945479 1.57877 0.138242 3.13809 0.0514422C3.7653 0.0167223 4.39251 0.0167223 5.01101 0.00804235C9.01818 0.00804235 13.0254 0.00804235 17.0325 -0.000637624C17.0325 0.00804235 17.0325 -0.000637624 17.0325 -0.000637624Z"
                                                fill="white" />
                                            <path
                                                d="M16.9609 26.0313C12.5617 26.0313 8.17125 26.0399 3.77207 26.0226C3.22326 26.0226 2.65703 25.9618 2.12565 25.8143C1.05416 25.5105 0.392108 24.7553 0.0697915 23.705C-0.0957222 23.1582 0.000101554 22.8891 0.496643 22.5766C4.55608 20.0334 8.61553 17.4902 12.675 14.9469C13.1018 14.6778 13.5548 14.6778 13.9817 14.9296C14.7482 15.3809 15.4974 15.8496 16.2466 16.327C16.8651 16.7263 17.1264 16.735 17.7275 16.3444C18.5202 15.8323 19.3216 15.3375 20.1144 14.8254C20.5412 14.5476 20.9245 14.6344 21.3165 14.8862C22.6145 15.7194 23.9125 16.544 25.2192 17.3686C27.8848 19.0526 30.5592 20.7191 33.2248 22.403C34.0437 22.9151 34.1743 23.3405 33.7736 24.1998C33.2248 25.3629 32.2317 25.8577 31.0209 26.0052C30.716 26.0399 30.4111 26.0399 30.1062 26.0399C25.7244 26.0313 21.3427 26.0313 16.9609 26.0313Z"
                                                fill="white" />
                                            <path
                                                d="M0.0615234 19.9987C0.0615234 15.3288 0.0615234 10.7371 0.0615234 6.06732C3.73767 8.40223 7.36155 10.6937 11.0464 13.0287C7.37026 15.3636 3.74638 17.6638 0.0615234 19.9987Z"
                                                fill="white" />
                                            <path
                                                d="M22.9803 13.0287C26.6478 10.7024 30.2717 8.40223 33.9478 6.06732C33.9478 10.7198 33.9478 15.3028 33.9478 19.9813C30.2804 17.6638 26.6565 15.3636 22.9803 13.0287Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_55_161">
                                                <rect width="34" height="26.0312" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <p class="text-white mb-0 fs-14">E-mail address</p>
                                    <a href="mailto:jackie@gmail.com" class="text-white">jackie@gmail.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.24875 11.2533C7.38447 15.3496 10.4178 18.4566 14.4261 20.5898C14.5964 20.6825 14.9988 20.5743 15.169 20.4197C16.0821 19.5541 16.9797 18.673 17.8464 17.761C18.3261 17.2509 18.8523 17.1736 19.5178 17.2973C21.0964 17.5755 22.6904 17.8537 24.2845 18.0392C25.5535 18.1938 26.0023 18.6112 26.0023 19.9096C26.0023 21.3008 26.0023 22.6766 26.0023 24.0678C26.0023 25.5672 25.5226 26.0309 23.9904 26C13.0952 25.8145 3.34518 18.0856 0.776133 7.48157C0.327324 5.61118 0.188038 3.64804 0.0177999 1.71581C-0.0905334 0.571938 0.54399 0.0154578 1.68923 0.0154578C3.2059 0 4.72256 0 6.23923 0C7.35351 0 7.8178 0.510107 7.95709 1.62307C8.17375 3.26159 8.4678 4.90012 8.77732 6.52319C8.90113 7.21879 8.77732 7.77527 8.26661 8.26992C7.24518 9.25922 6.2547 10.2485 5.24875 11.2533Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <p class="text-white mb-0 fs-14">Mobile Number</p>
                                    <a href="tel:+1 4078461474" class="text-white">+1 4078461474</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-sm-0 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <svg width="30" height="26" viewBox="0 0 30 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_55_141)">
                                            <path
                                                d="M0.390531 26C0.264533 25.7615 0.0629374 25.5355 0.0251381 25.2844C-0.0378606 24.8324 0.0251381 24.3679 -6.1387e-05 23.916C-0.0126611 23.5017 0.163735 23.2883 0.592127 23.3008C0.718124 23.3008 0.844122 23.3008 0.970119 23.3008C10.3317 23.3008 19.6807 23.3008 29.0424 23.3134C29.3574 23.3134 29.6723 23.4389 29.9873 23.5017C29.9873 24.3303 29.9873 25.1714 29.9873 26C20.1343 26 10.2561 26 0.390531 26Z"
                                                fill="white" />
                                            <path
                                                d="M15.0315 10.6461C18.3957 10.6461 21.7598 10.6461 25.1365 10.6461C27.0391 10.6461 27.9715 11.5877 27.9841 13.4959C27.9841 13.521 27.9841 13.5336 27.9841 13.5587C28.2109 14.6635 27.6943 15.2912 26.7115 15.718C25.7161 16.1449 24.7585 16.2328 23.8892 15.492C23.4608 15.128 23.108 14.6886 22.7552 14.2492C22.289 13.6842 21.848 13.6717 21.3692 14.2241C21.0542 14.5881 20.7392 14.9522 20.3864 15.2661C19.391 16.1574 18.2949 16.2579 17.1735 15.5423C16.6695 15.2159 16.2159 14.8016 15.7749 14.3873C15.1701 13.8223 14.9055 13.8223 14.3133 14.4124C13.9731 14.7513 13.6204 15.0778 13.2298 15.354C11.9068 16.3081 10.7098 16.2453 9.47504 15.1907C9.28604 15.0275 9.10965 14.8518 8.94585 14.6635C8.10167 13.6968 7.92527 13.6968 7.08109 14.7011C5.93451 16.057 4.48554 16.3583 2.87277 15.6301C2.24278 15.3414 2.00339 14.902 2.06639 14.2492C2.10419 13.9353 2.14199 13.6215 2.10419 13.3201C1.88999 11.776 3.13737 10.621 4.75013 10.6335C8.16467 10.6712 11.5918 10.6461 15.0315 10.6461Z"
                                                fill="white" />
                                            <path
                                                d="M27.7321 21.606C19.2525 21.606 10.8107 21.606 2.33105 21.606C2.33105 20.2878 2.33105 18.9696 2.33105 17.6012C4.43521 18.3042 6.27478 17.8522 7.78675 16.2327C10.3067 18.6432 12.625 18.3168 15.0568 16.1574C18.0681 18.7687 20.2353 18.1661 22.2891 16.1198C22.982 16.8605 23.738 17.5384 24.7712 17.802C25.7918 18.0657 26.7494 17.8522 27.7573 17.4254C27.7321 18.8315 27.7321 20.1874 27.7321 21.606Z"
                                                fill="white" />
                                            <path
                                                d="M13.2297 9.46596C13.2297 8.22308 13.2171 7.00531 13.2423 5.77499C13.2549 5.37325 13.5447 5.13472 13.9605 5.13472C14.6535 5.12217 15.3465 5.12217 16.0269 5.13472C16.5056 5.13472 16.7828 5.41092 16.7828 5.87542C16.808 7.05553 16.7954 8.24819 16.7954 9.46596C15.5985 9.46596 14.4393 9.46596 13.2297 9.46596Z"
                                                fill="white" />
                                            <path
                                                d="M15.0189 0C15.3213 0.55239 15.6741 1.18011 16.0143 1.82038C16.1655 2.10913 16.3671 2.39788 16.4553 2.71173C16.6443 3.40222 16.3419 4.15548 15.8001 4.45678C15.2583 4.75809 14.4267 4.67021 13.9857 4.26847C13.5196 3.82907 13.3684 2.98793 13.6959 2.37277C14.1243 1.54418 14.5905 0.740705 15.0189 0Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_55_141">
                                                <rect width="30" height="26" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <p class="text-white mb-0 fs-14">Date of Birth</p>
                                    <p class="mb-0 text-white">12th June, 1990</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <svg width="20" height="26" viewBox="0 0 20 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_55_132)">
                                            <path
                                                d="M9.99348 21.3252C9.65861 20.9328 9.33688 20.5606 9.02171 20.185C7.32112 18.1393 5.71245 16.0232 4.32046 13.7462C3.69341 12.7233 3.14515 11.6603 2.67568 10.5502C1.81225 8.50122 1.95999 6.48574 2.91206 4.53398C4.14318 2.01212 6.16222 0.509733 8.89368 0.0905402C13.0959 -0.55334 17.088 2.45814 17.7742 6.71378C17.9974 8.10886 17.784 9.41674 17.2489 10.6978C16.6514 12.1264 15.8799 13.4544 15.0394 14.7388C13.5391 17.0259 11.8615 19.1688 10.0756 21.2279C10.0559 21.2514 10.0329 21.2782 9.99348 21.3252ZM13.9429 7.37108C13.9462 5.15103 12.1734 3.34347 9.99676 3.34347C7.81685 3.34347 6.04732 5.14768 6.04732 7.36772C6.04732 9.58777 7.81685 11.3953 9.99348 11.3953C12.1701 11.3953 13.9396 9.59447 13.9429 7.37108Z"
                                                fill="white" />
                                            <path
                                                d="M6.92352 18.592C6.54269 18.649 6.16515 18.7027 5.79088 18.7698C4.66153 18.9676 3.55517 19.246 2.51117 19.7457C2.10408 19.9435 1.71669 20.1716 1.39824 20.5036C0.886091 21.0401 0.886091 21.5901 1.41137 22.1166C1.85786 22.566 2.41268 22.8276 2.98721 23.0556C4.10014 23.4916 5.26232 23.7297 6.44092 23.8906C8.066 24.1153 9.70093 24.169 11.3391 24.0885C13.1743 23.9979 14.9898 23.7632 16.7397 23.1529C17.2584 22.9718 17.764 22.7571 18.2105 22.4218C18.4107 22.2709 18.6044 22.0965 18.7587 21.8986C19.0575 21.5163 19.0673 21.0904 18.7587 20.7182C18.5486 20.4633 18.2892 20.2319 18.0135 20.0508C17.242 19.5444 16.3753 19.256 15.4888 19.0481C14.7535 18.8771 14.0082 18.7664 13.2663 18.6289C13.2006 18.6155 13.1382 18.6054 13.0726 18.5954C13.194 18.3338 13.217 18.3271 13.4829 18.3472C14.5795 18.4344 15.6727 18.5551 16.7462 18.8C17.3306 18.9307 17.9084 19.0884 18.437 19.3734C18.7686 19.5511 19.0969 19.7591 19.3693 20.0139C20.0686 20.6712 20.1934 21.5834 19.7469 22.4419C19.5072 22.9047 19.156 23.2702 18.7554 23.5888C17.8822 24.283 16.8874 24.7424 15.8434 25.0945C13.6471 25.8357 11.3851 26.0805 9.08045 25.9799C7.31091 25.8994 5.58077 25.6076 3.90645 24.9973C2.87559 24.6217 1.89397 24.1522 1.05352 23.4144C0.685829 23.0925 0.373944 22.7169 0.176964 22.2575C-0.154618 21.4828 -0.00360029 20.6645 0.57749 20.0642C1.06337 19.5612 1.67729 19.2829 2.31748 19.0649C3.19404 18.7664 4.10014 18.6122 5.01281 18.4981C5.5184 18.4344 6.02398 18.3975 6.53284 18.3439C6.77907 18.3204 6.79876 18.3338 6.92352 18.592Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_55_132">
                                                <rect width="20" height="26" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="contact-desc">
                                    <p class="text-white mb-0 fs-14">Address</p>
                                    <p class="text-white mb-0">New York, USA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="appointment-section pt-60 pb-60 mx-4">
                <div class="section-heading text-center mb-3 pb-3">
                    <h2 class="text-primary fw-bold mb-0">Make an Appointment</h2>
                </div>

                <div class="appointment p-sm-4 p-3">
                    <div class="mb-20">
                        <label for="date" class="appoint-date text-primary fs-20 fw-5 mb-2">Date:</label>
                        <div class="position-relative">
                            <input type="text" class="form-control appointment-input" placeholder="Pick a Date" />
                            <span class="calendar-icon"><svg width="20" height="20" viewBox="0 0 20 20"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.25 9.375V10.625C6.25 10.9705 5.97047 11.25 5.625 11.25H4.375C4.02953 11.25 3.75 10.9705 3.75 10.625V9.375C3.75 9.02953 4.02953 8.75 4.375 8.75H5.625C5.97047 8.75 6.25 9.02953 6.25 9.375ZM5.625 13.75H4.375C4.02953 13.75 3.75 14.0295 3.75 14.375V15.625C3.75 15.9705 4.02953 16.25 4.375 16.25H5.625C5.97047 16.25 6.25 15.9705 6.25 15.625V14.375C6.25 14.0295 5.97047 13.75 5.625 13.75ZM10.625 8.75H9.375C9.02953 8.75 8.75 9.02953 8.75 9.375V10.625C8.75 10.9705 9.02953 11.25 9.375 11.25H10.625C10.9705 11.25 11.25 10.9705 11.25 10.625V9.375C11.25 9.02953 10.9705 8.75 10.625 8.75ZM10.625 13.75H9.375C9.02953 13.75 8.75 14.0295 8.75 14.375V15.625C8.75 15.9705 9.02953 16.25 9.375 16.25H10.625C10.9705 16.25 11.25 15.9705 11.25 15.625V14.375C11.25 14.0295 10.9705 13.75 10.625 13.75ZM15.625 8.75H14.375C14.0295 8.75 13.75 9.02953 13.75 9.375V10.625C13.75 10.9705 14.0295 11.25 14.375 11.25H15.625C15.9705 11.25 16.25 10.9705 16.25 10.625V9.375C16.25 9.02953 15.9705 8.75 15.625 8.75ZM15.625 13.75H14.375C14.0295 13.75 13.75 14.0295 13.75 14.375V15.625C13.75 15.9705 14.0295 16.25 14.375 16.25H15.625C15.9705 16.25 16.25 15.9705 16.25 15.625V14.375C16.25 14.0295 15.9705 13.75 15.625 13.75ZM4.375 3.75H5.625C5.97047 3.75 6.25 3.47047 6.25 3.125V0.625C6.25 0.279531 5.97047 0 5.625 0H4.375C4.02953 0 3.75 0.279531 3.75 0.625V3.125C3.75 3.47047 4.02953 3.75 4.375 3.75ZM20 5V17.5C20 18.8806 18.8806 20 17.5 20H2.5C1.11937 20 0 18.8806 0 17.5V5C0 3.61937 1.11937 2.5 2.5 2.5H3.125V3.125C3.125 3.81348 3.6859 4.375 4.375 4.375H5.625C6.3141 4.375 6.875 3.81348 6.875 3.125V2.5H13.125V3.125C13.125 3.81348 13.6865 4.375 14.375 4.375H15.625C16.3135 4.375 16.875 3.81348 16.875 3.125V2.5H17.5C18.8806 2.5 20 3.61937 20 5ZM18.75 7.5C18.75 6.81152 18.1897 6.25 17.5 6.25H2.5C1.8109 6.25 1.25 6.81152 1.25 7.5V17.5C1.25 18.1897 1.8109 18.75 2.5 18.75H17.5C18.1897 18.75 18.75 18.1897 18.75 17.5V7.5ZM14.375 3.75H15.625C15.9705 3.75 16.25 3.47047 16.25 3.125V0.625C16.25 0.279531 15.9705 0 15.625 0H14.375C14.0295 0 13.75 0.279531 13.75 0.625V3.125C13.75 3.47047 14.0295 3.75 14.375 3.75Z"
                                        fill="#1C344F" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="">
                        <label class="text-primary fs-20 fw-5 mb-2">Hour:</label>

                        <div class="mb-20">
                            <div class="row">
                                <div class="col-sm-6 mb-2 pe-sm-1">
                                    <div class="hour-input d-flex justify-content-center align-items-center">
                                        <span class="text-primary">8:10 - 20:00</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-2 ps-sm-1">
                                    <div class="hour-input d-flex justify-content-center align-items-center">
                                        <span class="text-primary">8:10 - 20:00</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-2 pe-sm-1">
                                    <div class="hour-input d-flex justify-content-center align-items-center">
                                        <span class="text-primary">8:10 - 20:00</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 ps-sm-1">
                                    <div class="hour-input d-flex justify-content-center align-items-center">
                                        <span class="text-primary">8:10 - 20:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn vcard-13-btn w-sm-50 appointmentAdd p-2 rounded-2">
                                Make an Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="our-services-section px-30">
                <div class="section-heading text-center pb-sm-3">
                    <h2 class="text-primary text-center fw-bold mb-3">Our Services</h2>
                </div>

                <div class="services">
                    <div class="row">
                        <div class="col-sm-6 mb-sm-0 mb-40">
                            <div class="service-card h-100">
                                <div class="card-img mb-20 mx-auto d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vcard13/web-design.png')}}" class="web-design" />
                                </div>
                                <div class="card-body text-center p-0">
                                    <h3 class="card-title fs-18 text-white">Web Design</h3>
                                    <p class="mb-0 fs-14 text-white">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card h-100">
                                <div class="card-img mb-20 mx-auto d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vcard13/photography.png')}}" class="photography" />
                                </div>
                                <div class="card-body text-center p-0">
                                    <h3 class="card-title fs-18 text-white">photography</h3>
                                    <p class="mb-0 fs-14 text-gray-100">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery-section pt-60 px-sm-0">
                <h2 class="text-primary text-center mb-3 pb-3 fw-bold">Gallery</h2>
                <div class="gallery-slider ps-sm-3 pe-sm-0 px-3">
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{asset('assets/img/vcard13/gallery-img1.png')}}" loading="lazy"/>
                            <a id="play-video" class="video-play-button" href="#">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="gallery-img">
                            <img src="{{asset('assets/img/vcard13/gallery-img2.png')}}" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section pt-60">
                <div class="section-heading text-center pb-3 mb-3 px-30">
                    <h2 class="text-primary mb-0 fw-bold">Products</h2>
                </div>
                <div class="">
                    <div class="product-slider">
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{asset('assets/img/vcard13/product-img1.png')}}" class="img-fluid h-100" loading="lazy"/>
                                </div>
                                <div class="product-desc card-body">
                                    <div class="product-title">
                                        <h3 class="text-black fs-18 fw-5">Laptop</h3>
                                    </div>

                                    <p class="fs-12 text-gray-100 mb-0 fw-5">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type.
                                    </p>
                                    <div class="product-amount text-primary text-center fw-5">
                                        $200
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{asset('assets/img/vcard13/product-img1.png')}}" class="img-fluid h-100" loading="lazy"/>
                                </div>
                                <div class="product-desc card-body">
                                    <div class="product-title">
                                        <h3 class="text-black fs-18 fw-5">Laptop</h3>
                                    </div>

                                    <p class="fs-12 text-gray-100 mb-0 fw-5">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type.
                                    </p>
                                    <div class="product-amount text-primary text-center fw-5">
                                        $200
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="product-card card">
                                <div class="product-img card-img">
                                    <img src="{{asset('assets/img/vcard13/product-img1.png')}}" class="img-fluid h-100" loading="lazy"/>
                                </div>
                                <div class="product-desc card-body">
                                    <div class="product-title">
                                        <h3 class="text-black fs-18 fw-5">Laptop</h3>
                                    </div>

                                    <p class="fs-12 text-gray-100 mb-0 fw-5">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type.
                                    </p>
                                    <div class="product-amount text-primary text-center fw-5">
                                        $200
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-section pt-40 pb-60">
                <div class="section-heading mb-3 pb-3">
                    <h2 class="text-primary text-center mb-0 fw-bold">Testimonial</h2>
                </div>

                <div class="testimonial-slider">
                    <div class="px-sm-4 px-3">
                        <div
                            class="testimonial-card d-sm-flex justify-content-sm-start justify-content-center align-items-center">
                            <div class="profile-img">
                                <img src="{{asset('assets/img/vcard13/testimonial-profile-img.png')}} "
                                    class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0">
                                <div class="quote-left-img quote-img d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vcard13/quote-left.png')}}"
                                        class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div
                                    class="quote-right-img quote-img d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vcard13/quote-right.png')}}"
                                        class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="text-sm-start text-center">
                                    <p class="desc text-white mb-0">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-sm-4 px-3">
                        <div
                            class="testimonial-card d-sm-flex justify-content-sm-start justify-content-center align-items-center">
                            <div class="profile-img">
                                <img src="{{asset('assets/img/vcard13/testimonial-profile-img.png')}} "
                                    class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="card-body p-0">
                                <div class="quote-left-img quote-img d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vcard13/quote-left.png')}}"
                                        class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div
                                    class="quote-right-img quote-img d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vcard13/quote-right.png')}}"
                                        class="img-fluid h-100 object-fit-cover" loading="lazy"/>
                                </div>
                                <div class="text-sm-start text-center">
                                    <p class="desc text-white mb-0">
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

            <div class="blog-section pb-80">
                <div class="section-heading text-center mb-3 pb-3 px-4">
                    <h2 class="text-primary mb-0 fw-bold">Blog</h2>
                </div>
                <div class="blog-slider px-4">
                    <div class="">
                        <div class="blog-card mb-sm-0 mb-5 d-flex flex-sm-row-reverse flex-column-reverse">
                            <div class="card-img">
                                <img src="{{asset('assets/img/vcard13/blog-img1.png')}}"
                                    class="img-fluid h-100 object-fit-cover mx-auto" loading="lazy"/>
                            </div>
                            <div class="card-body text-sm-start text-center p-0 pe-sm-4">
                                <h2 class="fs-20 text-primary">Men's Wear</h2>
                                <p class="text-gray-100 blog-desc fs-12 fw-5">
                                    Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s, when an unknown
                                    printer took.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="blog-card mb-sm-0 mb-5 d-flex flex-sm-row-reverse flex-column-reverse">
                            <div class="card-img">
                                <img src="{{asset('assets/img/vcard13/blog-img1.png')}}"
                                    class="img-fluid h-100 object-fit-cover mx-auto" loading="lazy"/>
                            </div>
                            <div class="card-body text-sm-start text-center p-0 pe-sm-4">
                                <h2 class="fs-20 text-primary">Men's Wear</h2>
                                <p class="text-gray-100 blog-desc fs-12 fw-5">
                                    Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s, when an unknown
                                    printer took.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="qr-code-section">
                <div class="section-heading pb-60">
                    <h2 class="text-primary text-center mb-0 fw-bold">QR Code</h2>
                </div>
                <div class="px-30">
                    <div class="qr-code mt-3 mx-auto d-flex flex-column align-items-center position-relative">
                        <div class="qr-profile-img">
                            <img src="{{asset('assets/img/vcard13/qr-profile.png')}}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                        </div>
                        <div class="qr-code-img">
                            <img src="{{asset('assets/img/vcard13/qr-code.png')}}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bussiness-hour-section pt-60 pb-60">
                <div class="section-heading text-center">
                    <h2 class="text-primary mb-0 fw-bold">Business Hours</h2>
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
            </div>
            <div class="contact-us-section pt-30 pb-30 px-sm-4 px-3 bg-primary-light">
                <div class="section-heading text-center mb-3 pb-3">
                    <h2 class="text-primary text-center fw-bold mb-0">Inquiries</h2>
                </div>
                <div class="contact-form px-sm-4 px-3">
                    <form action="">
                        <div class="row m-sm-0">
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Your Name" />
                            </div>
                            <div class="col-12">
                                <input type="tel" class="form-control" placeholder="Enter Phone Number" />
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control" placeholder="Email Address" />
                            </div>
                            <div class="col-12">
                                <textarea class="form-control h-100" placeholder="Type a message here..." rows="3"></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button class="btn vcard-13-btn p-2 rounded-2 w-50 h-100" type="submit">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="create-vcard-section pt-60 pb-40 px-30">
                <div class="section-heading text-center mb-3 pb-3">
                    <h2 class="text-primary fw-bold mb-0">Create Your VCard</h2>
                </div>
                <div class="px-sm-4">
                    <div class="vcard-link-card card">
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="https://vcards.infyom.com/marlonbrasil"
                                class="text-primary link-text fw-5">https://vcards.infyom.com/marlonbrasil</a>
                            <i class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-to-conact-section pb-4 px-30">
                <div class="text-center">
                    <button class="vcard13-sticky-btn add-contact-btn justify-content-center ms-0 text-white align-items-center rounded px-5 text-decoration-none py-1  justify-content-center">Add to Contact</button>
                </div>
            </div>
            <div class="btn-section cursor-pointer">
                <div class="fixed-btn-section">
                    {{-- <div class="bars-btn hospital-bars-btn">
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
                        <div class="social-btn hospital-sub-btn wp-btn">
                            <i class="fa-brands fa-whatsapp text-primary"></i>
                        </div>
                        <div class="social-btn hospital-sub-btn wp-btn mt-3">
                            <i class="fa-solid fa-share-nodes text-primary"></i>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>
@include('vcardTemplates.template.templates')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
<script>
    $().ready(function() {
        $(".gallery-slider").slick({
            arrows: false,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            autoplay: true,
            centerMode: true,

            responsive: [{
                breakpoint: 575,
                settings: {
                    infinite: true,
                    arrows: false,
                    dots: true,
                },
            }, ],
        });
        $(".product-slider").slick({
            arrows: false,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            centerMode: true,
            centerPadding: "75px",
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        centerPadding: "58px",
                    },
                },
                {
                    breakpoint: 575,
                    settings: {
                        centerPadding: "0",
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
            arrows: true,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                },
            }, ],
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
