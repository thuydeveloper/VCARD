<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marriage vCard</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/vcard29.css') }}">
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
      <div class="main-content mx-auto w-100 overflow-hidden bg-green">
        <div class="banner-section position-relative">
          <div class="banner-img">
            <img
              src="{{ asset('assets/img/vcard29/banner-img.png') }}"
              class="w-100 h-100 object-fit-cover"
              alt="banner"
            />
          </div>
          <div class="overlay"></div>
        </div>
        <div class="profile-section px-40">
          <div class="card d-flex mb-30">
            <div class="card-img">
              <img
                src="{{ asset('assets/img/vcard29/profile-img.png') }}"
                class="w-100 h-100 object-fit-cover"
              />
            </div>
            <div
              class="card-body pt-sm-3 pt-5 mt-sm-0 mt-40 p-0 text-sm-start text-center"
            >
              <div class="profile-name">
                <h2 class="text-white mb-0 fs-30">Pallavi Hegde</h2>
                <p class="fs-18 text-primary mb-0">Lorem Ipsum</p>
              </div>
            </div>
          </div>
          <p
            class="text-gray-100 profile-desc mb-30 fs-14 text-sm-start text-center"
          >
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type
            and scrambled it to make a type specimen book.
          </p>
        </div>
        <div class="social-media-section px-40">
          <div class="d-flex flex-wrap justify-content-center pt-4">
            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="26"
                height="26"
                viewBox="0 0 26 26"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M14.9704 25.4998C14.9704 22.5882 14.9704 19.6825 14.9704 16.7413C15.9436 16.7413 16.8934 16.7413 17.8667 16.7413C18.0543 15.5188 18.2361 14.3257 18.4237 13.0973C17.2628 13.0973 16.1254 13.0973 15.0114 13.0973C15.0114 12.0992 14.941 11.1365 15.029 10.1857C15.1052 9.35292 15.797 8.83319 16.6706 8.78594C17.1866 8.75641 17.7084 8.76823 18.2243 8.76823C18.3299 8.76823 18.4354 8.76823 18.5527 8.76823C18.5527 7.71696 18.5527 6.70113 18.5527 5.66168C17.2335 5.50222 15.9319 5.28961 14.6127 5.53175C12.6779 5.89202 11.3353 7.28583 11.1359 9.27023C11.0245 10.4042 11.0714 11.5499 11.048 12.6898C11.048 12.8138 11.048 12.9378 11.048 13.0973C9.97505 13.0973 8.93729 13.0973 7.88781 13.0973C7.88781 14.3257 7.88781 15.5188 7.88781 16.7413C8.94315 16.7413 9.97505 16.7413 11.0245 16.7413C11.0245 19.6766 11.0245 22.5823 11.0245 25.4939C6.61553 25.0097 0.969417 20.8873 0.529689 13.9064C0.0723718 6.71885 5.53673 0.877845 12.3203 0.51758C19.6432 0.127786 25.4652 6.00423 25.5062 13.0028C25.5414 19.9423 20.1826 24.8502 14.9704 25.4998Z"
                  fill="white"
                />
              </svg>
            </a>
            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="22"
                height="22"
                viewBox="0 0 22 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <g clip-path="url(#clip0_3172_1287)">
                  <path
                    d="M5.72008 0.166672C9.25094 0.166672 12.7658 0.166672 16.2966 0.166672C16.5213 0.198747 16.746 0.230822 16.9546 0.278934C19.4102 0.824209 20.983 2.3157 21.6571 4.73736C21.7374 5.05811 21.7695 5.37886 21.8337 5.71565C21.8337 9.2439 21.8337 12.7561 21.8337 16.2844C21.8176 16.3645 21.8176 16.4287 21.7855 16.5089C21.6411 17.0702 21.5769 17.6636 21.3361 18.1928C20.2608 20.5343 18.3991 21.7692 15.8312 21.8173C12.6213 21.8654 9.39539 21.8333 6.18551 21.8333C4.93366 21.8333 3.7781 21.4965 2.76699 20.7749C1.03366 19.5239 0.183042 17.84 0.166992 15.723C0.166992 12.5637 0.166992 9.40427 0.166992 6.26092C0.166992 5.85998 0.183042 5.44301 0.279338 5.04207C0.825017 2.58833 2.31761 1.01666 4.74107 0.343084C5.06205 0.262897 5.38304 0.230822 5.72008 0.166672ZM2.09292 10.992C2.09292 12.5637 2.09292 14.1193 2.09292 15.691C2.09292 16.1881 2.14107 16.6693 2.31761 17.1504C2.92749 18.8664 4.40403 19.9088 6.26576 19.9088C9.42748 19.9088 12.5892 19.9249 15.7349 19.9088C16.2003 19.9088 16.6979 19.8447 17.1472 19.6843C18.8806 19.107 19.9077 17.5994 19.9077 15.723C19.9077 12.5797 19.9238 9.42031 19.8917 6.27696C19.8917 5.81187 19.8275 5.31471 19.683 4.86566C19.1053 3.13361 17.6127 2.09117 15.7509 2.09117C12.5892 2.09117 9.42748 2.09117 6.24971 2.09117C4.83736 2.09117 3.68181 2.65248 2.83119 3.80718C2.28551 4.54491 2.07687 5.37886 2.07687 6.293C2.09292 7.84863 2.09292 9.42031 2.09292 10.992Z"
                    fill="white"
                  />
                  <path
                    d="M11.0002 16.573C7.93479 16.573 5.41504 14.0551 5.41504 10.992C5.41504 7.92882 7.95084 5.41093 11.0002 5.41093C14.0657 5.42697 16.5694 7.91278 16.5694 10.9759C16.6015 14.0391 14.0817 16.557 11.0002 16.573ZM14.6595 10.992C14.6595 8.9873 13.0224 7.33543 11.0002 7.33543C8.99405 7.33543 7.34097 8.97126 7.34097 10.992C7.34097 12.9967 8.978 14.6485 11.0002 14.6485C13.0064 14.6485 14.6595 13.0127 14.6595 10.992Z"
                    fill="white"
                  />
                  <path
                    d="M16.8101 3.79117C17.5805 3.79117 18.2385 4.43267 18.2224 5.20247C18.2224 5.97227 17.5805 6.59773 16.8101 6.59773C16.0397 6.59773 15.3817 5.95623 15.3977 5.18643C15.4138 4.41663 16.0397 3.79117 16.8101 3.79117Z"
                    fill="white"
                  />
                </g>
                <defs>
                  <clipPath id="clip0_3172_1287">
                    <rect
                      width="21.6667"
                      height="21.6667"
                      fill="white"
                      transform="translate(0.166992 0.166672)"
                    />
                  </clipPath>
                </defs>
              </svg>
            </a>
            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="22"
                height="22"
                viewBox="0 0 22 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <g clip-path="url(#clip0_3172_1293)">
                  <path
                    d="M17.3423 21.8237C17.3423 21.7078 17.3423 21.6016 17.3423 21.5002C17.3423 19.1582 17.3519 16.8163 17.3327 14.4743C17.3279 13.8804 17.2749 13.2816 17.1594 12.7022C16.9331 11.5626 16.2688 11.0266 15.1087 10.9783C14.3626 10.9445 13.6646 11.0893 13.1255 11.6543C12.6682 12.1324 12.4708 12.736 12.3986 13.383C12.3456 13.8707 12.3216 14.3632 12.3216 14.851C12.3119 17.0818 12.3168 19.3079 12.3168 21.5388C12.3168 21.6305 12.3168 21.7271 12.3168 21.8333C10.8149 21.8333 9.34187 21.8333 7.84961 21.8333C7.84961 17.0142 7.84961 12.2 7.84961 7.37603C9.27448 7.37603 10.6897 7.37603 12.1387 7.37603C12.1387 8.02308 12.1387 8.66048 12.1387 9.29787C12.1579 9.3027 12.1724 9.30753 12.1916 9.31236C12.2301 9.26407 12.2686 9.22061 12.3023 9.17233C13.0773 7.93616 14.223 7.27945 15.6334 7.07181C16.6491 6.92212 17.6504 7.00904 18.6324 7.31808C20.0428 7.76233 20.9045 8.74257 21.357 10.1188C21.6891 11.1231 21.8047 12.1613 21.8143 13.214C21.8335 16.0388 21.8287 18.8637 21.8287 21.6885C21.8287 21.7271 21.8239 21.7657 21.8191 21.8333C20.3413 21.8237 18.8635 21.8237 17.3423 21.8237Z"
                    fill="white"
                  />
                  <path
                    d="M0.547852 7.37602C2.04493 7.37602 3.51793 7.37602 5.00057 7.37602C5.00057 12.2 5.00057 17.0094 5.00057 21.8333C3.51312 21.8333 2.04011 21.8333 0.547852 21.8333C0.547852 17.0191 0.547852 12.2048 0.547852 7.37602Z"
                    fill="white"
                  />
                  <path
                    d="M5.35999 2.76938C5.36481 4.218 4.20469 5.38174 2.76057 5.38174C1.32126 5.38174 0.156334 4.21318 0.161148 2.76938C0.170775 1.3304 1.32126 0.1715 2.75576 0.166672C4.19507 0.161843 5.35999 1.32075 5.35999 2.76938Z"
                    fill="white"
                  />
                </g>
                <defs>
                  <clipPath id="clip0_3172_1293">
                    <rect
                      width="21.6667"
                      height="21.6667"
                      fill="white"
                      transform="translate(0.166992 0.166672)"
                    />
                  </clipPath>
                </defs>
              </svg>
            </a>

            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="22"
                height="22"
                viewBox="0 0 22 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M0.166992 21.8325C0.200861 21.7072 0.220215 21.6253 0.244408 21.5434C0.708901 19.8615 1.17339 18.1844 1.62821 16.5026C1.66208 16.3725 1.64273 16.1942 1.57983 16.0785C-0.524909 12.1606 -0.147508 7.54869 2.70235 4.13195C5.29093 1.01399 8.66818 -0.263067 12.6938 0.291129C15.2969 0.652562 17.4452 1.89589 19.1822 3.85244C22.5739 7.68363 22.7143 13.4232 19.5644 17.4953C16.4678 21.5 10.8165 22.806 6.28282 20.5362C5.99251 20.3916 5.74575 20.3675 5.43609 20.4542C3.77649 20.9024 2.1169 21.3265 0.452462 21.7602C0.375046 21.7795 0.292792 21.7988 0.166992 21.8325ZM5.52802 8.49323C5.60543 8.85949 5.65865 9.23537 5.76026 9.59681C5.96832 10.3197 6.40378 10.9221 6.8344 11.5244C8.32465 13.6063 10.2068 15.158 12.7131 15.8809C13.7583 16.1797 14.7405 16.1411 15.6646 15.4906C16.3081 15.0376 16.5162 14.4063 16.5065 13.6738C16.5065 13.5533 16.4097 13.3798 16.3081 13.3268C15.5824 12.9605 14.8469 12.6087 14.1066 12.2714C13.8163 12.1365 13.6808 12.1943 13.4825 12.4497C13.226 12.7726 12.9696 13.0907 12.7083 13.4039C12.5632 13.5822 12.3841 13.6448 12.1519 13.5533C10.5407 12.9172 9.30686 11.8473 8.4311 10.363C8.31497 10.1703 8.32465 10.0112 8.47948 9.84258C8.66818 9.63536 8.84721 9.4185 9.02139 9.19682C9.24396 8.90768 9.29718 8.60889 9.13268 8.2571C8.89559 7.75591 8.70205 7.23545 8.48432 6.72463C8.1553 5.93911 8.1553 5.91984 7.29406 5.94875C7.06181 5.95839 6.78602 6.04513 6.61667 6.19452C5.91993 6.79209 5.56672 7.56315 5.52802 8.49323Z"
                  fill="white"
                />
              </svg>
            </a>

            <a
              href=""
              class="social-icon d-flex justify-content-center align-items-center"
            >
              <svg
                width="22"
                height="19"
                viewBox="0 0 22 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.57116 14.8052C4.53747 14.5412 3.18819 13.583 2.42555 11.6667C3.08064 11.6667 3.6575 11.6667 4.22459 11.6667C2.16157 10.8551 0.998057 9.43742 0.851397 7.18863C1.47715 7.36462 2.05401 7.53083 2.63088 7.68727C2.66021 7.64816 2.68954 7.60905 2.71888 7.56994C1.85847 6.87575 1.24249 6.01534 1.02739 4.92028C0.812287 3.82521 0.910061 2.76925 1.50648 1.68396C3.97038 4.49007 6.98181 6.12289 10.6874 6.35755C10.6874 5.9469 10.6777 5.59491 10.6874 5.24293C10.7461 3.37545 11.6652 2.01639 13.3371 1.26354C14.9699 0.530233 16.5734 0.72578 17.9814 1.87951C18.3725 2.20216 18.7244 2.27061 19.1644 2.09461C19.8391 1.83062 20.5137 1.56663 21.247 1.29287C20.9341 2.27061 20.2888 2.93547 19.6142 3.65899C20.3181 3.47322 21.0221 3.27768 21.7261 3.09191C21.7554 3.12124 21.7945 3.15057 21.8239 3.1799C21.2666 3.75677 20.7386 4.38252 20.1324 4.90072C19.7999 5.18426 19.6728 5.46781 19.6631 5.88824C19.6044 8.83123 18.7244 11.5004 16.9058 13.8275C14.4615 16.966 11.2154 18.5499 7.21647 18.6282C4.92856 18.677 2.78732 18.198 0.773178 17.1127C0.57763 17.0051 0.382083 16.8878 0.176758 16.7216C2.494 16.8291 4.60591 16.2816 6.57116 14.8052Z"
                  fill="white"
                />
              </svg>
            </a>
          </div>
        </div>
        <div class="contact-section pt-60 px-40">
          <div class="contact-bg img-1">
            <img src="{{ asset('assets/img/vcard29/contact-bg1.png') }}" alt="bg" />
          </div>
          <div class="contact-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/contact-bg2.png')}}" alt="bg" />
          </div>
          <div class="section-heading">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/contact-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Contact</h2>
          </div>
          <div class="row">
            <div class="col-sm-6 mb-40">
              <div class="contact-box d-flex align-items-center">
                <div
                  class="contact-icon d-flex justify-content-center align-items-center"
                >
                  <svg
                    width="22"
                    height="15"
                    viewBox="0 0 22 15"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M11.0229 0.00124986C13.824 0.00124986 16.6195 -0.00374959 19.4206 0.00624932C19.7869 0.00624932 20.1589 0.0412455 20.5139 0.111238C21.1508 0.241224 21.5904 0.601185 21.8666 1.12113C22.1089 1.57608 22.03 1.82605 21.5566 2.09102C20.9423 2.43599 20.3223 2.77595 19.708 3.12091C17.0253 4.63575 14.3425 6.14058 11.671 7.66542C11.1863 7.94539 10.8031 7.93539 10.3184 7.66042C7.06643 5.80562 3.79755 3.97582 0.534299 2.13602C0.466667 2.09602 0.393399 2.06103 0.331403 2.02103C0.0101504 1.82605 -0.0518457 1.67107 0.0608744 1.3461C0.337039 0.546191 1.02463 0.0812412 2.03348 0.0312466C2.43927 0.0112488 2.84506 0.0112488 3.24522 0.00624932C5.83778 0.00624932 8.43034 0.00624932 11.0229 0.00124986Z"
                      fill="#FA3769"
                    />
                    <path
                      d="M10.9765 14.995C8.13035 14.995 5.2898 15 2.44362 14.99C2.08855 14.99 1.72221 14.955 1.37841 14.87C0.685182 14.695 0.256845 14.2601 0.0483128 13.6551C-0.0587713 13.3402 0.00322478 13.1852 0.324477 13.0052C2.95086 11.5404 5.57723 10.0755 8.20361 8.61069C8.47978 8.4557 8.77285 8.4557 9.04901 8.60069C9.54498 8.86066 10.0297 9.13063 10.5144 9.4056C10.9145 9.63558 11.0836 9.64058 11.4725 9.4156C11.9854 9.12063 12.5039 8.83566 13.0168 8.54069C13.2929 8.38071 13.5409 8.43071 13.7945 8.57569C14.6343 9.05564 15.4741 9.53059 16.3195 10.0055C18.0441 10.9754 19.7743 11.9353 21.499 12.9052C22.0287 13.2002 22.1133 13.4452 21.854 13.9401C21.499 14.61 20.8564 14.895 20.073 14.98C19.8758 15 19.6785 15 19.4813 15C16.6464 14.995 13.8114 14.995 10.9765 14.995Z"
                      fill="#FA3769"
                    />
                    <path
                      d="M0.0429635 11.5204C0.0429635 8.83066 0.0429635 6.18595 0.0429635 3.49624C2.42136 4.8411 4.76594 6.16095 7.14997 7.50581C4.77157 8.85066 2.42699 10.1755 0.0429635 11.5204Z"
                      fill="#FA3769"
                    />
                    <path
                      d="M14.871 7.50581C17.2438 6.16596 19.5884 4.8411 21.9667 3.49624C21.9667 6.17595 21.9667 8.81567 21.9667 11.5104C19.594 10.1755 17.2494 8.85067 14.871 7.50581Z"
                      fill="#FA3769"
                    />
                  </svg>
                </div>
                <div class="contact-desc">
                  <a href="mailto:jackie@gmail.com" class="text-white fw-5"
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
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.03788 8.65636C5.68074 11.8074 8.01407 14.1974 11.0974 15.8383C11.2284 15.9096 11.5379 15.8264 11.6688 15.7075C12.3712 15.0416 13.0617 14.3639 13.7284 13.6623C14.0974 13.2699 14.5022 13.2105 15.0141 13.3056C16.2284 13.5196 17.4545 13.7337 18.6807 13.8763C19.6569 13.9952 20.0022 14.3163 20.0022 15.3151C20.0022 16.3853 20.0022 17.4435 20.0022 18.5137C20.0022 19.6671 19.6331 20.0238 18.4545 20C10.0736 19.8573 2.57359 13.912 0.597401 5.75505C0.252163 4.31629 0.14502 2.80618 0.0140678 1.31986C-0.0692655 0.439952 0.41883 0.0118906 1.29978 0.0118906C2.46645 0 3.63312 0 4.79978 0C5.65693 0 6.01407 0.39239 6.12121 1.24851C6.28788 2.50892 6.51407 3.76932 6.75216 5.01784C6.8474 5.55291 6.75216 5.98098 6.35931 6.36147C5.57359 7.12247 4.81169 7.88347 4.03788 8.65636Z"
                      fill="#FA3769"
                    />
                  </svg>
                </div>
                <div class="contact-desc">
                  <a href="tel:+1 4078461474" class="text-white fw-5"
                    >+1 4078461474</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mb-sm-0 mb-40">
              <div class="contact-box d-flex align-items-center">
                <div
                  class="contact-icon d-flex justify-content-center align-items-center"
                >
                  <svg
                    width="24"
                    height="20"
                    viewBox="0 0 24 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_1990_491)">
                      <path
                        d="M0.31262 20C0.211822 19.8165 0.0505452 19.6427 0.0203058 19.4495C-0.0300932 19.1019 0.0203058 18.7446 0.000146203 18.3969C-0.0099336 18.0782 0.131184 17.9141 0.473897 17.9237C0.574695 17.9237 0.675493 17.9237 0.776291 17.9237C8.26558 17.9237 15.7448 17.9237 23.2341 17.9334C23.4861 17.9334 23.7381 18.0299 23.9901 18.0782C23.9901 18.7156 23.9901 19.3626 23.9901 20C16.1077 20 8.2051 20 0.31262 20Z"
                        fill="#FA3769"
                      />
                      <path
                        d="M12.0254 8.18927C14.7167 8.18927 17.408 8.18927 20.1094 8.18927C21.6315 8.18927 22.3774 8.91356 22.3874 10.3814C22.3874 10.4008 22.3874 10.4104 22.3874 10.4297C22.5689 11.2796 22.1556 11.7624 21.3694 12.0908C20.5731 12.4191 19.807 12.4867 19.1115 11.9169C18.7688 11.6369 18.4866 11.2989 18.2043 10.9609C17.8314 10.5263 17.4786 10.5166 17.0956 10.9416C16.8436 11.2216 16.5916 11.5017 16.3093 11.7431C15.513 12.4288 14.6361 12.506 13.739 11.9556C13.3358 11.7045 12.9729 11.3858 12.6201 11.0671C12.1363 10.6325 11.9246 10.6325 11.4509 11.0864C11.1787 11.3472 10.8965 11.5983 10.584 11.8107C9.52563 12.5447 8.56805 12.4964 7.58023 11.6852C7.42903 11.5596 7.28791 11.4244 7.15687 11.2796C6.48153 10.536 6.34041 10.536 5.66506 11.3085C4.7478 12.3515 3.58863 12.5833 2.29841 12.0232C1.79442 11.8011 1.60291 11.4631 1.6533 10.9609C1.68354 10.7194 1.71378 10.478 1.68354 10.2462C1.51219 9.05842 2.51009 8.16996 3.8003 8.17961C6.53193 8.20858 9.27363 8.18927 12.0254 8.18927Z"
                        fill="#FA3769"
                      />
                      <path
                        d="M22.1861 16.62C15.4024 16.62 8.64894 16.62 1.86523 16.62C1.86523 15.606 1.86523 14.592 1.86523 13.5394C3.54856 14.0802 5.02021 13.7325 6.22979 12.4867C8.24575 14.3409 10.1004 14.0898 12.0458 12.4288C14.4549 14.4375 16.1886 13.9739 17.8316 12.3998C18.386 12.9696 18.9908 13.4911 19.8174 13.6939C20.6338 13.8967 21.3999 13.7325 22.2063 13.4042C22.1861 14.4858 22.1861 15.5287 22.1861 16.62Z"
                        fill="#FA3769"
                      />
                      <path
                        d="M10.5836 7.2815C10.5836 6.32544 10.5735 5.3887 10.5937 4.44229C10.6037 4.13326 10.8356 3.94978 11.1682 3.94978C11.7226 3.94012 12.277 3.94012 12.8213 3.94978C13.2043 3.94978 13.4261 4.16224 13.4261 4.51955C13.4462 5.42732 13.4362 6.34475 13.4362 7.2815C12.4786 7.2815 11.5512 7.2815 10.5836 7.2815Z"
                        fill="#FA3769"
                      />
                      <path
                        d="M12.015 0C12.257 0.424915 12.5392 0.907774 12.8113 1.40029C12.9323 1.6224 13.0936 1.84452 13.1641 2.08595C13.3153 2.61709 13.0734 3.19652 12.64 3.4283C12.2066 3.66007 11.5413 3.59247 11.1885 3.28344C10.8155 2.94544 10.6946 2.29841 10.9567 1.82521C11.2994 1.18783 11.6723 0.569773 12.015 0Z"
                        fill="#FA3769"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_1990_491">
                        <rect width="24" height="20" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <div class="contact-desc">
                  <p class="mb-0 text-white fw-5">12th June, 1990</p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="contact-box d-flex align-items-center">
                <div
                  class="contact-icon d-flex justify-content-center align-items-center"
                >
                  <svg
                    width="18"
                    height="24"
                    viewBox="0 0 18 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_1990_518)">
                      <path
                        d="M8.99374 19.6847C8.69236 19.3226 8.4028 18.979 8.11915 18.6322C6.58862 16.7439 5.14082 14.7906 3.88803 12.6887C3.32368 11.7446 2.83024 10.7633 2.40772 9.73866C1.63064 7.84726 1.7636 5.98682 2.62046 4.1852C3.72847 1.85732 5.54561 0.470506 8.00392 0.0835592C11.7859 -0.510791 15.3788 2.26904 15.9964 6.19732C16.1973 7.48508 16.0052 8.69236 15.5236 9.87487C14.9859 11.1936 14.2915 12.4194 13.5351 13.605C12.1848 15.7162 10.675 17.6943 9.06761 19.595C9.04988 19.6166 9.0292 19.6414 8.99374 19.6847ZM12.5482 6.80405C12.5512 4.75478 10.9557 3.08627 8.9967 3.08627C7.03478 3.08627 5.4422 4.75169 5.4422 6.80096C5.4422 8.85023 7.03478 10.5187 8.99374 10.5187C10.9527 10.5187 12.5453 8.85642 12.5482 6.80405Z"
                        fill="#FA3769"
                      />
                      <path
                        d="M6.23156 17.1619C5.88881 17.2145 5.54902 17.264 5.21219 17.3259C4.19577 17.5086 3.20004 17.7655 2.26045 18.2267C1.89406 18.4094 1.54541 18.6199 1.25881 18.9263C0.797873 19.4216 0.797873 19.9293 1.27062 20.4153C1.67246 20.8301 2.17181 21.0716 2.68888 21.2821C3.69052 21.6845 4.73648 21.9043 5.79722 22.0529C7.25979 22.2603 8.73123 22.3098 10.2056 22.2355C11.8573 22.1519 13.4912 21.9352 15.0661 21.3719C15.5329 21.2047 15.988 21.0066 16.3898 20.697C16.57 20.5577 16.7444 20.3967 16.8832 20.2141C17.1521 19.8612 17.161 19.4681 16.8832 19.1245C16.6941 18.8892 16.4607 18.6756 16.2125 18.5084C15.5182 18.041 14.7381 17.7748 13.9404 17.5829C13.2785 17.425 12.6078 17.3228 11.94 17.1959C11.8809 17.1835 11.8248 17.1743 11.7657 17.165C11.875 16.9235 11.8957 16.9173 12.135 16.9359C13.1219 17.0164 14.1058 17.1278 15.072 17.3538C15.5979 17.4745 16.118 17.62 16.5937 17.8831C16.8921 18.0472 17.1876 18.2391 17.4328 18.4744C18.0622 19.0811 18.1744 19.9231 17.7726 20.7156C17.5569 21.1428 17.2407 21.4802 16.8803 21.7743C16.0943 22.4151 15.1991 22.8392 14.2595 23.1642C12.2828 23.8483 10.247 24.0743 8.17279 23.9814C6.58021 23.9071 5.02309 23.6378 3.51619 23.0744C2.58842 22.7277 1.70496 22.2943 0.948562 21.6133C0.617636 21.3161 0.33694 20.9694 0.159659 20.5453C-0.138766 19.8303 -0.00284963 19.0749 0.520131 18.5208C0.957426 18.0565 1.50995 17.7996 2.08612 17.5983C2.87502 17.3228 3.69052 17.1804 4.51192 17.0752C4.96695 17.0164 5.42197 16.9823 5.87995 16.9328C6.10155 16.9111 6.11928 16.9235 6.23156 17.1619Z"
                        fill="#FA3769"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_1990_518">
                        <rect width="18" height="24" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <div class="contact-desc">
                  <p class="mb-0 text-white fw-5">New York, USA</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-services-section pt-60 pb-40 px-40">
          <div class="services-bg img-1">
            <img src="{{ asset('assets/img/vcard29/services-bg1.png')}}" alt="bg" />
          </div>
          <div class="services-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/services-bg2.png')}}" alt="bg" />
          </div>
          <div class="section-heading">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/services-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Our Services</h2>
          </div>
          <div class="services">
            <div class="row">
              <div class="col-sm-6 mb-sm-0 mb-40">
                <div class="service-card h-100">
                  <div
                    class="card-img d-flex justify-content-center align-items-center mb-20"
                  >
                    <img
                      src="{{ asset('assets/img/vcard29/service-img1.png')}}"
                      class="h-100"
                    />
                  </div>
                  <div class="card-body p-0">
                    <h3 class="card-title fs-18 text-white mb-10">
                      Lorem Ipsum
                    </h3>
                    <p class="mb-0 fs-14 text-gray-100">
                      It is a long established fact that a reader will be
                      distracted by the readable content of a page when looking.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="service-card h-100">
                  <div
                    class="card-img d-flex justify-content-center align-items-center mb-20"
                  >
                    <img
                      src="{{ asset('assets/img/vcard29/service-img2.png')}}"
                      class="h-100"
                    />
                  </div>
                  <div class="card-body p-0">
                    <h3 class="card-title fs-18 text-white mb-10">
                      Lorem Ipsum
                    </h3>
                    <p class="mb-0 fs-14 text-gray-100">
                      It is a long established fact that a reader will be
                      distracted by the readable content of a page when looking.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="appointment-section pt-40 pb-40 px-40">
          <div class="appointment">
            <div class="section-heading">
              <div class="heading-img">
                <img
                  src="{{ asset('assets/img/vcard29/appointment-heading.png')}}"
                  class="w-100"
                  alt="img"
                />
              </div>
              <h2 class="mb-0">Make an Appointment</h2>
            </div>
            <div>
              <div class="row mb-20">
                <div class="col-12">
                  <div class="position-relative">
                    <input
                      type="text"
                      class="form-control appointment-input"
                      placeholder="Pick a date"
                    />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-white fw-5">8:10 - 20:00</span>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-white fw-5">8:10 - 20:00</span>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-white fw-5">8:10 - 20:00</span>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div
                    class="hour-input d-flex justify-content-center align-items-center"
                  >
                    <span class="text-white fw-5">8:10 - 20:00</span>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary w-100">
                  Make an Appointment
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="gallery-section pt-60">
          <div class="gallery-bg img-1">
            <img src="{{ asset('assets/img/vcard29/gallery-bg1.png')}}" alt="bg" />
          </div>
          <div class="gallery-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/gallery-bg2.png')}}" alt="bg" />
          </div>
          <div class="section-heading px-40">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/gallery-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Gallery</h2>
          </div>
          <div class="gallery-slider px-sm-0 px-30">
            <div>
              <div class="gallery-img">
                <img
                  src="{{ asset('assets/img/vcard29/gallery-img1.png')}}"
                  class="w-100 h-100 object-fit-cover"
                />
              </div>
            </div>
            <div>
              <div class="gallery-img">
                <img
                  src="{{ asset('assets/img/vcard29/gallery-img2.png')}}"
                  class="w-100 h-100 object-fit-cover"
                />
              </div>
            </div>
            <div>
              <div class="gallery-img">
                <img
                  src="{{ asset('assets/img/vcard29/gallery-img3.png')}}"
                  class="w-100 h-100 object-fit-cover"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="product-section pt-60 px-30">
          <div class="product-bg img-1">
            <img src="{{ asset('assets/img/vcard29/product-bg1.png')}}" alt="bg" />
          </div>
          <div class="product-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/product-bg2.png')}}" alt="bg" />
          </div>
          <div class="section-heading px-3">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/product-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Products</h2>
          </div>
          <div class="product-slider">
            <div>
              <div class="product-card card">
                <div class="product-img card-img">
                  <img
                    src="{{ asset('assets/img/vcard29/product-img1.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="product-desc card-body p-3">
                  <div
                    class="d-flex justify-content-between align-items-center mb-1"
                  >
                    <h3 class="text-white fs-6 fw-5 mb-0">Lorem Ipsum</h3>
                    <p class="amount fs-6 mb-0 fw-5 text-primary">$125</p>
                  </div>
                  <p class="fs-14 text-gray-100 mb-0">
                    It is a long established
                  </p>
                </div>
              </div>
            </div>
            <div>
              <div class="product-card card">
                <div class="product-img card-img">
                  <img
                    src="{{ asset('assets/img/vcard29/product-img2.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="product-desc card-body p-3">
                  <div
                    class="d-flex justify-content-between align-items-center mb-1"
                  >
                    <h3 class="text-white fs-6 fw-5 mb-0">Lorem Ipsum</h3>
                    <p class="amount fs-6 mb-0 fw-5 text-primary">$125</p>
                  </div>
                  <p class="fs-14 text-gray-100 mb-0">
                    It is a long established
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-section pt-60 px-40">
          <div class="testimonial-bg img-1">
            <img src="{{ asset('assets/img/vcard29/testimonial-bg1.png')}}" alt="bg" />
          </div>
          <div class="section-heading px-3">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/testimonial-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Testimonial</h2>
          </div>
          <div class="testimonial-slider">
            <div>
              <div class="testimonial-card card">
                <div class="card-img testimonial-profile-img mb-20">
                  <img
                    src="{{ asset('assets/img/vcard29/testimonial-profile-img.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="card-body p-0 text-center">
                  <p class="desc text-gray-100 fs-14">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text.
                  </p>
                  <h3 class="text-white fs-18 mb-0">Perry Madison</h3>
                </div>
              </div>
            </div>
            <div>
              <div class="testimonial-card card">
                <div class="card-img testimonial-profile-img mb-20">
                  <img
                    src="{{ asset('assets/img/vcard29/testimonial-profile-img.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="card-body p-0 text-center">
                  <p class="desc text-gray-100 fs-14">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text.
                  </p>
                  <h3 class="text-white fs-18 mb-0">Perry Madison</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="blog-section pt-60">
          <div class="blog-bg img-1">
            <img src="{{ asset('assets/img/vcard29/blog-bg1.png')}}" alt="bg" />
          </div>
          <div class="blog-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/blog-bg2.png')}}" alt="bg" />
          </div>
          <div class="section-heading px-40">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/blog-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Blog</h2>
          </div>
          <div class="blog-slider px-sm-0 px-40">
            <div>
              <div class="blog-card card">
                <div class="card-img">
                  <img
                    src="{{ asset('assets/img/vcard29/blog-img.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="card-body">
                  <h2 class="fs-18 fw-5 text-white">Lorem Ipsum</h2>
                  <p class="text-white blog-desc fw-5 fs-14 mb-0">
                    It is a long established fact that a reader will be
                    distracted by the readable content of a page when looking.
                  </p>
                </div>
              </div>
            </div>
            <div>
              <div class="blog-card card">
                <div class="card-img">
                  <img
                    src="{{ asset('assets/img/vcard29/blog-img.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="card-body">
                  <h2 class="fs-18 fw-5 text-white">Lorem Ipsum</h2>
                  <p class="text-white blog-desc fw-5 fs-14 mb-0">
                    It is a long established fact that a reader will be
                    distracted by the readable content of a page when looking.
                  </p>
                </div>
              </div>
            </div>
            <div>
              <div class="blog-card card">
                <div class="card-img">
                  <img
                    src="{{ asset('assets/img/vcard29/blog-img.png')}}"
                    class="w-100 h-100 object-fit-cover"
                  />
                </div>
                <div class="card-body">
                  <h2 class="fs-18 fw-5 text-white">Lorem Ipsum</h2>
                  <p class="text-white blog-desc fw-5 fs-14 mb-0">
                    It is a long established fact that a reader will be
                    distracted by the readable content of a page when looking.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="business-hour-section pt-60 pb-40 px-40">
          <div class="hour-bg img-1">
            <img src="{{ asset('assets/img/vcard29/hour-bg1.png')}}" alt="bg" />
          </div>
          <div class="hour-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/hour-bg2.png')}}" alt="bg" />
          </div>
          <div class="section-heading">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/hour-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Business Hours</h2>
          </div>
          <div class="business-hour-card row justify-content-center">
            <div class="col-sm-6 mb-3 pe-sm-2">
              <div class="business-hour">
                <span class="me-2">Sunday:</span>
                <span>08:10 - 20:00</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3 ps-sm-2">
              <div class="business-hour">
                <span class="me-2">Monday:</span>
                <span>08:10 - 20:00</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3 pe-sm-2">
              <div class="business-hour">
                <span class="me-2">Tueday:</span>
                <span>08:10 - 20:00</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3 ps-sm-2">
              <div class="business-hour">
                <span class="me-2">Wednesday:</span>
                <span>08:10 - 20:00</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3 pe-sm-2">
              <div class="business-hour">
                <span class="me-2">Thursday:</span>
                <span>08:10 - 20:00</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3 ps-sm-2">
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
        <div class="qr-code-section pt-40 pb-40 px-40">
          <div class="qr-bg img-1">
            <img src="{{ asset('assets/img/vcard29/qr-bg1.png')}}" alt="bg" />
          </div>
          <div class="section-heading">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/qr-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">QR Code</h2>
          </div>
          <div class="qr-code gap-3 mb-20">
            <div class="qr-profile-img">
              <img
                src="{{ asset('assets/img/vcard29/qr-profile-img.png')}}"
                class="w-100 h-100 object-fit-cover"
              />
            </div>
            <div class="qr-code-img">
              <img
                src="{{ asset('assets/img/vcard29/qr-code-img.png')}}"
                class="w-100 h-100 object-fit-cover"
              />
            </div>
          </div>
          <div class="text-center">
            <button class="btn btn-primary" type="button">
              Download My QR Code
            </button>
          </div>
        </div>
        <div class="contact-us-section pt-60 pb-40 px-40">
          <div class="contact-us-bg img-1 text-end">
            <img src="{{ asset('assets/img/vcard29/contact-us-bg1.png')}}" alt="bg" />
          </div>
          <div class="section-heading">
            <div class="heading-img">
              <img
                src="{{ asset('assets/img/vcard29/contact-us-heading.png')}}"
                class="w-100"
                alt="img"
              />
            </div>
            <h2 class="mb-0">Contact Us</h2>
          </div>
          <div class="contact-form">
            <form action="">
              <div class="row">
                <div class="col-sm-6">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Full Name"
                  />
                </div>
                <div class="col-sm-6">
                  <input
                    type="tel"
                    class="form-control"
                    placeholder="Phone Number"
                  />
                </div>
                <div class="col-12">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email Address"
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
                  <button class="btn btn-primary" type="submit">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="create-vcard-section pt-40 pb-60 px-40">
          <div class="create-vcard-bg img-1">
            <img src="{{ asset('assets/img/vcard29/create-vcard-bg1.png')}}" alt="bg" />
          </div>
          <div class="create-vcard-bg img-2 text-end">
            <img src="{{ asset('assets/img/vcard29/create-vcard-bg2.png')}}" alt="bg" />
          </div>
          <div class="overlay"></div>
          <div class="content">
            <div class="section-heading">
              <div class="heading-img">
                <img
                  src="{{ asset('assets/img/vcard29/create-vcard-heading.png')}}"
                  class="w-100"
                  alt="img"
                />
              </div>
              <h2 class="mb-0">Create Your VCard</h2>
            </div>
            <div class="pb-4">
              <div class="pb-5 mb-5">
                <div class="vcard-link-card card mx-sm-3 mb-5">
                  <div class="d-flex align-items-center justify-content-center">
                    <a
                      href="https://vcards.infyom.com/marlonbrasil"
                      class="text-secondary link-text fw-5"
                      >https://vcards.infyom.com/marlonbrasil</a
                    >
                    <i
                      class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-primary"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="add-to-contact-section">
              <div class="text-center">
                <button class="btn btn-primary">Add to Contact</button>
              </div>
            </div>
          </div>
        </div>
        <div class="btn-section cursor-pointer">
          <div class="fixed-btn-section">
            <div class="bars-btn marriage-bars-btn">
              <svg
                width="25"
                height="25"
                viewBox="0 0 25 25"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M15.4135 0.540405H22.4891C23.5721 0.540405 24.4602 1.42855 24.4602 2.51152V9.58713C24.4602 10.6773 23.5732 11.5582 22.4891 11.5582H15.4135C14.3223 11.5582 13.4424 10.6783 13.4424 9.58713V2.51152C13.4424 1.42746 14.3234 0.540405 15.4135 0.540405Z"
                  stroke="#ffffff"
                />
                <path
                  d="M2.97143 0.5H8.74589C10.1129 0.5 11.2173 1.6122 11.2173 2.97143V8.74589C11.2173 10.1139 10.1139 11.2173 8.74589 11.2173H2.97143C1.6122 11.2173 0.5 10.1129 0.5 8.74589V2.97143C0.5 1.61328 1.61328 0.5 2.97143 0.5Z"
                  stroke="#ffffff"
                />
                <path
                  d="M2.97143 13.7828H8.74589C10.1139 13.7828 11.2173 14.8862 11.2173 16.2543V22.0287C11.2173 23.388 10.1129 24.5002 8.74589 24.5002H2.97143C1.61328 24.5002 0.5 23.3869 0.5 22.0287V16.2543C0.5 14.8873 1.6122 13.7828 2.97143 13.7828Z"
                  stroke="#ffffff"
                />
                <path
                  d="M16.2537 13.7828H22.0281C23.3873 13.7828 24.4995 14.8873 24.4995 16.2543V22.0287C24.4995 23.3869 23.3863 24.5002 22.0281 24.5002H16.2537C14.8867 24.5002 13.7822 23.388 13.7822 22.0287V16.2543C13.7822 14.8862 14.8856 13.7828 16.2537 13.7828Z"
                  stroke="#ffffff"
                />
              </svg>
            </div>
            <div class="sub-btn">
              <div class="social-btn marriage-sub-btn wp-btn">
                <i class="fa-brands fa-whatsapp text-primary"></i>
              </div>
              <div class="social-btn marriage-sub-btn wp-btn mt-3">
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
    $().ready(function () {
      $(".gallery-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        arrows: false,
        dots: true,
        speed: 300,
        centerPadding: "145px",
        infinite: true,
        autoplaySpeed: 5000,
        autoplay: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              centerPadding: "125px",
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
        arrows: true,
        infinite: true,
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
              arrows: false,
              dots: true,
            },
          },
        ],
      });
      $(".blog-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        arrows: false,
        dots: true,
        speed: 300,
        centerPadding: "55px",
        infinite: true,
        autoplay: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              centerPadding: "40px",
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
    });
  </script>
</html>
