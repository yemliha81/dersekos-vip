@extends('layouts.main')

@section('content')

<main class="main-field header-space corporate-page">
    <div  id="who-are-we-section"></div>
    <?php
        $pageTitle = $about->upper_title;
        $breadcrumbImage = "corporate-breadcrumb.jpg";
        $breadcrumbVideo = "breadcrumb-video.mp4";
        $pageLink = "page-corporate.php";
        $imageOrVideo = "image";
    ?>
    <section class="breadcrumb relative w-full h-[400px] xl:h-[300px] md:h-[270px] sm:h-[220px]" id="breadcrumb">
    <div class="image-video relative pointer-events-none w-full h-full overflow-hidden">
        <?php if ($imageOrVideo == "image") { ?>
            <img src="<?=env('HTTP_DOMAIN'). '/'. getFolder(['uploads_folder', 'images_folder'], app()->getLocale()) .'/' .$about['banner_image']?>" alt="Kariyer" width="1785" height="400" class="w-full h-full object-cover">
        <?php } elseif ($imageOrVideo == "video") { ?>
            <video autoplay loop muted playsinline class="w-full h-full object-cover">
                <source srcset="../assets/video/<?= !empty($breadcrumbVideo) ? $breadcrumbVideo : '' ?>" src="../assets/video/<?= !empty($breadcrumbVideo) ? $breadcrumbVideo : '' ?>">
            </video>
        <?php } ?>
        <div class="overlay absolute top-0 left-0 w-full h-full z-2 [background:linear-gradient(180deg,_#083355_7.01%,_rgba(8,51,85,0.50)_48.57%,_#083355_92.89%)]"></div>
        <div class="vector w-full h-full absolute top-0 left-0 z-3 flex items-end justify-center">
            <svg width="575" height="390" viewBox="0 0 575 390" fill="none" xmlns="http://www.w3.org/2000/svg" class="min-sm:w-[575px] min-sm:h-auto sm:h-[200px] sm:w-auto">
                <g clip-path="url(#clip0_2101_28405)">
                    <g opacity="0.65">
                        <mask id="mask0_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="72" y="77" width="403" height="395">
                            <path d="M227.862 471.571C227.632 471.571 227.402 471.467 227.256 471.279L73.0269 283.744C72.7967 283.472 72.7967 283.074 73.0059 282.781L223.364 77.4427C223.553 77.1917 223.887 77.0662 224.18 77.1498L471.34 137.779C471.695 137.862 471.946 138.176 471.946 138.532L474.331 381.34C474.331 381.674 474.122 381.967 473.808 382.093L228.134 471.509C228.134 471.509 227.946 471.551 227.862 471.551M74.6378 283.2L228.134 469.835L472.762 380.796L470.377 139.159L224.327 78.7817L74.6378 283.179V283.2Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_2101_28405)">
                            <path d="M474.331 77.0664H72.7754V471.572H474.331V77.0664Z" fill="url(#paint0_linear_2101_28405)"/>
                        </g>
                        <mask id="mask1_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="65" y="69" width="417" height="408">
                            <path d="M218.196 476.072C217.945 476.072 217.715 475.967 217.569 475.758L65.4109 276.988C65.1808 276.696 65.2017 276.298 65.4109 276.026L227.715 69.8716C227.904 69.6206 228.238 69.516 228.552 69.5997L481.025 140.961C481.381 141.065 481.611 141.379 481.611 141.735L475.335 391.97C475.335 392.304 475.105 392.597 474.791 392.702L218.447 475.988C218.447 475.988 218.28 476.03 218.196 476.03M67.0428 276.486L218.489 474.314L473.766 391.363L480 142.3L228.636 71.2315L67.0428 276.465V276.486Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask1_2101_28405)">
                            <path d="M481.591 69.5137H65.1816V476.048H481.591V69.5137Z" fill="url(#paint1_linear_2101_28405)"/>
                        </g>
                        <mask id="mask2_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="57" y="61" width="435" height="420">
                            <path d="M208.072 480.338C207.821 480.338 207.57 480.212 207.423 480.003L57.797 269.748C57.5878 269.455 57.6087 269.058 57.8389 268.786L232.486 62.2336C232.696 61.9826 233.03 61.8989 233.323 61.9826L490.88 144.599C491.215 144.704 491.445 145.038 491.424 145.394L475.964 402.993C475.964 403.328 475.713 403.621 475.399 403.704L208.302 480.296C208.302 480.296 208.155 480.338 208.093 480.338M59.4498 269.329L208.386 478.643L474.416 402.365L489.813 145.938L233.344 63.6562L59.4498 269.329Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask2_2101_28405)">
                            <path d="M491.445 61.8984H57.5879V480.337H491.445V61.8984Z" fill="url(#paint2_linear_2101_28405)"/>
                        </g>
                        <mask id="mask3_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="50" y="54" width="452" height="431">
                            <path d="M197.486 484.376C197.235 484.376 196.984 484.251 196.837 484.02L50.2238 262.008C50.0146 261.715 50.0564 261.318 50.3075 261.046L237.654 54.5145C237.863 54.2843 238.198 54.2007 238.512 54.3053L500.881 148.679C501.216 148.805 501.425 149.14 501.404 149.495L476.215 414.354C476.173 414.689 475.943 414.961 475.608 415.044L197.653 484.355C197.653 484.355 197.528 484.376 197.465 484.376M51.8975 261.652L197.842 482.682L474.709 413.643L499.793 149.956L238.47 55.9789L51.8975 261.652Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask3_2101_28405)">
                            <path d="M501.445 54.2002H50.0352V484.376H501.445V54.2002Z" fill="url(#paint3_linear_2101_28405)"/>
                        </g>
                        <mask id="mask4_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="42" y="46" width="470" height="443">
                            <path d="M186.418 488.163C186.146 488.163 185.895 488.017 185.749 487.787L42.7127 253.766C42.5244 253.452 42.5663 253.054 42.8173 252.803L243.281 46.7744C243.511 46.5443 243.846 46.4815 244.139 46.5861L511.069 153.262C511.403 153.387 511.613 153.743 511.55 154.099L476.068 426.07C476.026 426.405 475.775 426.677 475.44 426.74L186.565 488.143C186.565 488.143 186.46 488.143 186.397 488.143M44.3864 253.473L186.816 486.49L474.583 425.317L509.918 154.517L244.034 48.2598L44.3864 253.473Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask4_2101_28405)">
                            <path d="M511.612 46.46H42.5234V488.163H511.612V46.46Z" fill="url(#paint4_linear_2101_28405)"/>
                        </g>
                        <mask id="mask5_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="35" y="38" width="487" height="454">
                            <path d="M174.891 491.657C174.619 491.657 174.347 491.51 174.2 491.259L35.2437 244.999C35.0763 244.686 35.1181 244.288 35.3901 244.037L249.348 38.9914C249.578 38.7612 249.913 38.7194 250.206 38.8449L521.382 158.366C521.717 158.512 521.905 158.868 521.843 159.224L475.503 438.162C475.44 438.497 475.189 438.748 474.854 438.811L175.016 491.678C175.016 491.678 174.932 491.678 174.87 491.678M36.9382 244.769L175.309 490.004L474.038 437.325L520.19 159.558L250.059 40.4977L36.9382 244.769Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask5_2101_28405)">
                            <path d="M521.905 38.6973H35.0762V491.656H521.905V38.6973Z" fill="url(#paint5_linear_2101_28405)"/>
                        </g>
                        <mask id="mask6_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="27" y="30" width="506" height="465">
                            <path d="M162.903 494.857C162.61 494.857 162.338 494.69 162.192 494.439L27.8794 235.71C27.7121 235.397 27.7748 234.999 28.0468 234.748L255.875 31.1878C256.105 30.9786 256.461 30.9158 256.754 31.0622L531.864 163.973C532.178 164.14 532.366 164.496 532.303 164.851L474.52 450.568C474.457 450.903 474.185 451.154 473.85 451.196L163.028 494.878C163.028 494.878 162.945 494.878 162.924 494.878M29.574 235.522L163.342 493.205L473.055 449.668L530.608 165.102L256.524 32.715L29.574 235.522Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask6_2101_28405)">
                            <path d="M532.344 30.918H27.7109V494.86H532.344V30.918Z" fill="url(#paint6_linear_2101_28405)"/>
                        </g>
                        <mask id="mask7_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="20" y="23" width="523" height="475">
                            <path d="M150.414 497.724C150.121 497.724 149.828 497.556 149.703 497.263L20.6416 225.878C20.4952 225.543 20.5789 225.166 20.8508 224.936L262.885 23.3842C263.136 23.175 263.47 23.1332 263.763 23.3005L542.409 170.123C542.722 170.291 542.89 170.646 542.806 171.002L472.993 463.288C472.909 463.623 472.637 463.853 472.303 463.895L150.498 497.724C150.498 497.724 150.435 497.724 150.414 497.724ZM22.3362 225.752L150.895 496.071L471.591 462.367L541.133 171.211L263.491 24.9324L22.3362 225.752Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask7_2101_28405)">
                            <path d="M542.888 23.1338H20.4727V497.724H542.888V23.1338Z" fill="url(#paint7_linear_2101_28405)"/>
                        </g>
                        <mask id="mask8_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="13" y="15" width="541" height="486">
                            <path d="M137.441 500.213C137.127 500.213 136.834 500.025 136.709 499.732L13.5058 215.48C13.3593 215.145 13.4639 214.769 13.7359 214.538L270.372 15.5807C270.624 15.3924 270.979 15.3506 271.251 15.5179L553.077 176.818C553.39 177.006 553.537 177.362 553.453 177.718L471.004 476.363C470.92 476.677 470.627 476.928 470.293 476.949L137.525 500.213C137.525 500.213 137.483 500.213 137.462 500.213M15.2004 215.417L137.943 498.602L469.602 475.401L551.738 177.885L270.937 17.1498L15.2004 215.417Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask8_2101_28405)">
                            <path d="M553.537 15.3721H13.3594V500.214H553.537V15.3721Z" fill="url(#paint8_linear_2101_28405)"/>
                        </g>
                        <mask id="mask9_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="6" y="7" width="559" height="496">
                            <path d="M124.01 502.306C123.676 502.306 123.404 502.118 123.278 501.804L6.56057 204.518C6.43504 204.183 6.56057 203.807 6.83254 203.597L278.386 7.84059C278.637 7.6523 278.992 7.63138 279.264 7.81967L563.809 184.141C564.123 184.329 564.249 184.706 564.144 185.041L468.452 489.753C468.347 490.067 468.055 490.297 467.72 490.297L124.031 502.306H124.01ZM8.25516 204.497L124.554 500.716L467.134 488.749L562.471 185.145L278.888 9.43058L8.25516 204.497Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask9_2101_28405)">
                            <path d="M564.249 7.63086H6.41406V502.305H564.249V7.63086Z" fill="url(#paint9_linear_2101_28405)"/>
                        </g>
                        <mask id="mask10_2101_28405" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="-1" y="0" width="576" height="504">
                            <path d="M464.624 504H110.077C109.743 504 109.45 503.791 109.324 503.477L-0.217523 192.948C-0.343049 192.613 -0.217523 192.237 0.0962901 192.028L286.901 0.141216C287.173 -0.047072 287.508 -0.047072 287.78 0.141216L574.605 192.049C574.898 192.258 575.023 192.634 574.919 192.969L465.356 503.477C465.251 503.791 464.938 504 464.603 504M110.621 502.41H464.038L573.203 193.011L287.34 1.7312L1.47707 193.011L110.642 502.41H110.621Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask10_2101_28405)">
                            <path d="M575.044 -0.046875H-0.34375V504H575.044V-0.046875Z" fill="url(#paint10_linear_2101_28405)"/>
                        </g>
                    </g>
                </g>
                <defs>
                    <linearGradient id="paint0_linear_2101_28405" x1="273.553" y1="77.0664" x2="273.553" y2="471.572" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_2101_28405" x1="273.386" y1="69.5137" x2="273.386" y2="476.049" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint2_linear_2101_28405" x1="274.517" y1="61.8984" x2="274.517" y2="480.337" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint3_linear_2101_28405" x1="275.74" y1="54.2002" x2="275.74" y2="484.376" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint4_linear_2101_28405" x1="277.068" y1="46.46" x2="277.068" y2="488.163" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint5_linear_2101_28405" x1="278.491" y1="38.6973" x2="278.491" y2="491.656" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint6_linear_2101_28405" x1="280.027" y1="30.918" x2="280.027" y2="494.86" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint7_linear_2101_28405" x1="281.68" y1="23.1338" x2="281.68" y2="497.724" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint8_linear_2101_28405" x1="283.448" y1="15.3721" x2="283.448" y2="500.214" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint9_linear_2101_28405" x1="285.331" y1="7.63086" x2="285.331" y2="502.305" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint10_linear_2101_28405" x1="287.35" y1="-0.046875" x2="287.35" y2="504" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                    <clipPath id="clip0_2101_28405">
                        <rect width="575" height="390" fill="white"/>
                    </clipPath>
                </defs>
            </svg >

        </div>
    </div>
    <div class="absolute left-0 top-0 w-full h-full z-2">
        <div class="container h-full max-w-[1650px] flex items-center justify-center">
            <div class="flex flex-col text-center gap-[10px] [&_a]:text-[18px] [&_a]:leading-[32px] [&_a]:font-light [&_a]:text-white [&_a]:lg:text-[16px] [&_li]:flex [&_li]:items-center before:[&_li_+_li]:block before:[&_li_+_li]:content-['/'] before:[&_li_+_li]:px-[5px] before:[&_li_+_li]:text-white before:[&_li_+_li]:font-light before:[&_li_+_li]:text-[18px] before:[&_li_+_li]:lg:text-[16px] before:[&_li_+_li]:leading-[32px]">
                <h1 class="reveal text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-bold text-white"><?= $pageTitle ?></h1>
                <ul class="flex items-center flex-wrap justify-center">
                    <li class="reveal">
                        <a href="<?=env('HTTP_DOMAIN')?>"><?=getStaticText(10)?></a>
                    </li>
                    <li class="reveal">
                        <a href="<?= $pageLink ?>"><?= $pageTitle ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>   
    <div class="fixed-bar fixed md:hidden top-0 left-0 w-full opacity-0 z-[50] pointer-events-none transition-all duration-300 [&.is-fixed]:opacity-100 [&.is-fixed]:pointer-events-auto [&.extra-top]:top-[112px]">
        <div class="bar bg-secondary-main/90 backdrop-blur-[25px] shadow-[0px_4px_100px_0px_rgba(0,0,0,0.15)] py-[20px]">
            <div class="container max-w-[1650px]">
                <div class="flex items-center gap-[30px]">
                    <?php $items = [
                                [
                                    'title' => getStaticText(13),
                                    'section' => '#who-are-we-section',
                                    'id' => 'who-are-we',
                                ],

                                [
                                    'title' => getStaticText(14),
                                    'section' => '#what-we-do-section',
                                    'id' => 'what-we-do',
                                ],

                                [
                                    'title' => getStaticText(15),
                                    'section' => '#how-we-do-section',
                                    'id' => 'how-we-do',
                                ],

                                [
                                    'title' => getStaticText(16),
                                    'section' => '#vision-section',
                                    'id' => 'vision',
                                ],

                                [
                                    'title' => getStaticText(17),
                                    'section' => '#memberships-section',
                                    'id' => 'memberships',
                                ],

                                [
                                    'title' => getStaticText(18),
                                    'section' => '#policies-section',
                                    'id' => 'policies',
                                ],
                        ]; foreach ($items as $item): ?>
                        <div class="item w-full flex items-center gap-[30px] scrollable-selector group whitespace-nowrap cursor-pointer [&_div]:last:hidden last:w-max" data-scrollable-section="<?= $item['section'] ?>" data-section-id="<?= $item['id'] ?>">
                            <p class="text-[16px] leading-[40px] font-light text-white/65 transition-all duration-300 group-hover:tracking-[0.1px] group-[&.active]:tracking-[0.1px] group-hover:text-primary-main group-[&.active]:opacity-65 group-hover:[-webkit-text-stroke:1px_rgba(182,163,107,1)] [-webkit-text-stroke:1px_rgba(255,255,255,0)] group-[&.active]:[-webkit-text-stroke:1px_rgba(182,163,107,1)] group-[&.active]:text-primary-main"><?= $item['title'] ?></p>
                            <div class="line flex items-center w-full">
                                <div class="line w-full h-[1px] bg-white/16 transition-all duration-300 relative after:absolute after:z-2 after:left-0 after:top-0 after:w-0 after:h-[1px] after:transition-all after:duration-300 after:delay-100 after:[background:linear-gradient(270deg,_rgba(182,163,107,0.65)_27.61%,_rgba(182,163,107,0.00)_101.87%)] group-[&.active]:after:w-full "></div>
                                <div class="box w-[12px] aspect-square bg-white/65"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="bottom bg-primary-main/90 backdrop-blur-[25px] shadow-[0px_4px_100px_0px_rgba(0,0,0,0.15)] h-[77px] mt-[-57px] mx-[24px] relative -z-[1]"></div>
    </div>
    <section class="content mt-[130px] xl:mt-[100px] mb:mt-[70px] sm:mt-[50px]">
        <section class="about-us relative mb-[150px] xl:mb-[120px] lg:mb-[90px] md:mb-[60px]" data-section-id="who-are-we">
            <div id="who-are-we" class="absolute left-0 top-[-150px] xs:top-[-50px]"></div>
            <img src="../assets/image/static/vectorel.svg" alt="Vektör" width="387" height="588" class="pointer-events-none absolute top-1/2 -translate-y-1/2 right-0 ">
            <div class="container max-w-[1650px]">
                <div class="flex flex-wrap items-center">
                    <div class="w-3/5 md:w-full translate-x-[-30px] [@media(max-width:1670px)]:pr-[50px] md:!pr-0">
                        <div class="image-wrapper reveal w-full h-[677px] md:h-[580px] sm:h-[320px] relative">
                                <img src="<?=env('HTTP_DOMAIN'). '/'. getFolder(['uploads_folder', 'images_folder'], app()->getLocale()) .'/' .$about['image']?>" alt="<?=$about['alt']?>" width="911" height="677" class="w-full h-full object-cover relative z-2">
                            <div class="bg-primary-main absolute -top-[38px] sm:-top-[20px] -right-[38px] sm:-right-[20px] w-[421px] sm:w-[320px] aspect-square"></div>
                        </div>
                    </div>
                    <div class="w-2/5 md:w-full md:p-0 md:mt-[30px] [@media(min-width:1760px)]:translate-x-[-20px]">
                        <div class="flex flex-col text-editor reveal">
                            <span class="text-[16px] leading-[32px] font-light text-paragraph opacity-65 tracking-[7.2px] block mb-[30px] lg:mb-[5px]"><?=$about['upper_title']?></span>
                            <h2 class="text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-light text-secondary-main mb-[80px] 2xl:mb-[50px] md:mb-[30px] xs:mb-[20px]">
                                <?=$about['title']?>
                            </h2>
                            <p class="text-[22px] lg:text-[18px] leading-[45px] lg:leading-[40px] font-light tracking-[-0.22px] text-paragraph mb-[30px] xs:mb-[20px]"><?=$about['title_1']?></p>
                            <p class="text-[18px] lg:text-[16px] leading-[32px] font-light text-paragraph mb-[60px] xl:mb-[40px] md:mb-[30px]">
                                <?=$about['description']?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="career-slider-area overflow-hidden md:bg-secondary-main mb-[185px] xl:mb-[120px] lg:mb-[90px] md:mb-[60px] relative" data-section-id="what-we-do" id="what-we-do-section">
            <div id="what-we-do" class="absolute left-0 top-[-150px] xs:top-[-50px]"></div>
            <div class="max-w-[1920px] mx-auto relative overflow-hidden">
                <div class="container max-w-[1800px]">
                    <div class="bg-primary-main absolute -z-[1] -bottom-[90px] xl:-bottom-[60px] lg:-bottom-[20px] -right-0 max-w-[440px] [@media(max-width:1780px)_and_(min-width:1441px)]:max-w-[400px] xl:max-w-[360px] w-full h-[426px] md:hidden"></div>
                    <div class="wrapper min-sm:overflow-hidden bg-secondary-main md:bg-transparent p-[50px] pl-[105px] xl:pl-[80px] lg:pl-[30px] lg:p-[30px] sm:p-[20px_0] relative">
                        <img src="../assets/image/static/vectorel-2.svg" alt="Vektör" width="610" height="535" class="reveal max-w-[610px] xl:max-w-[500px] sm:max-w-full sm:w-full h-auto absolute z-2 pointer-events-none left-1/2 top-1/2 sm:top-[30px] -translate-x-1/2 min-sm:-translate-y-1/2">
                        <div class="sector-slider reveal overflow-hidden relative z-4">
                            <div class="swiper-wrapper">
                                <?php foreach ($what_we_do as $key => $item) { ?>
                                    <div class="swiper-slide overflow-hidden" data-slide-name="<?= $item->title ?>" data-slide-id="<?= $key + 1 ?>">
                                        <div class="item w-full grid grid-cols-2 sm:grid-cols-1 items-end gap-[200px] 2xl:gap-[160px] xl:gap-[100px] lg:gap-[60px] md:gap-[30px]">
                                            <div class="left mb-[90px] 2xl:mb-[60px] xl:mb-[45px] lg:mb-[30px] md:mb-0">
                                                <span class="block mb-[50px] md:mb-[30px] text-[16px] leading-[32px] font-light text-white opacity-65 tracking-[7.2px]"><?= $item->title ?></span>
                                                <div class="flex flex-col gap-[30px] sm:gap-[20px] text-editor">
                                                    <h3 class="text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-light text-white [&_span]:font-bold"><?= $item->title_1 ?></h3>
                                                    <p class="text-[17px] md:text-[16px] sm:text-[15px] leading-[32px] sm:leading-[28px] font-light text-white mb-[20px] sm:mb-[5px]"><?= $item->description ?></p>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="image-wrapper w-full h-[500px]  xl:h-[450px] sm:h-[320px] xsm:mt-[40px]">
                                                    <img src="<?=env('HTTP_DOMAIN'). '/'. getFolder(['uploads_folder', 'images_folder'], app()->getLocale()) .'/' .$item->image?>" alt="<?= $item->title ?>" width="745" height="535" class="w-full h-full object-cover" data-swiper-parallax="50%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-navigation flex items-end gap-[112px] pt-[40px] xsm:pt-[20px] xs:pt-0 pb-[20px] md:pb-[40px] lg:gap-[50px] pl-[95px] 2xl:pl-[45px] xl:pl-0 pr-[85px] xl:pr-0 relative z-5 xsm:absolute xsm:bottom-[370px] xs:bottom-[360px] xsm:w-[calc(100%-60px)] xsm:p-0">
                        <div class="reveal sector-pagination flex items-center gap-[30px] xl:gap-[20px] xsm:gap-[15px] xs:gap-[10px] [&_.swiper-pagination-bullet]:!max-w-[234px] xsm:hidden"></div>
                        <div class="reveal nav-buttons pb-[5px] flex items-center gap-[30px] sm:hidden">
                            <div class="sector-prev cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.sector-disabled]:opacity-65 relative [&.sector-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                                <i class="icon-angle-left text-[12px] leading-none text-white"></i>
                                <span class="text-[16px] leading-[32px] text-white md:hidden"><?=getStaticText(2)?></span>
                            </div>

                            <div class="separator w-[1px] h-[22px] bg-white/20"></div>

                            <div class="sector-next cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.sector-disabled]:opacity-65 relative [&.sector-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                                <span class="text-[16px] leading-[32px] text-white md:hidden"><?=getStaticText(3)?></span>
                                <i class="icon-angle-right text-[12px] leading-none text-white"></i>
                            </div>
                        </div>
                        <div class="swiper-scrollbar hidden xsm:block bg-white/15 [&_.swiper-scrollbar-drag]:bg-white relative left-0 w-full">
                            <div class="swiper-scrollbar-drag relative flex flex-col-reverse items-center">
                                <span class="block mb-[10px] text-white text-[13px] whitespace-nowrap pointer-events-none" id="scrollbar-name"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="box-area relative mb-[150px] md:mb-[200px] xs:mb-[150px]" data-section-id="how-we-do" id="how-we-do-section">
            <div id="how-we-do"></div>
            <img src="../assets/image/static/vectorel.svg" alt="Vektör" width="387" height="588" class="pointer-events-none absolute top-1/2 -translate-y-1/2 right-0 ">
            <div class="container max-w-[1650px]">
                <div class="flex flex-wrap items-center">
                    <div class="w-3/5 md:w-full pr-[120px] 2xl:pr-[90px] xl:pr-[60px] md:p-0 md:mt-[10px] md:order-2">
                        <div class="image-wrapper reveal w-full h-[667px] md:h-[580px] sm:h-[320px] relative">
                            <img src="<?=env('HTTP_DOMAIN'). '/'. getFolder(['uploads_folder', 'images_folder'], app()->getLocale()) .'/' .$how_we_do[0]->image?>" alt="Hakkımızda" width="814" height="667" class="w-full h-full object-cover relative z-2 transition-all duration-500 [&.changed]:opacity-0 [&.changed]:translate-y-[10px]" id="box-image">
                            <div class="bg-primary-main absolute -bottom-[38px] sm:-bottom-[20px] -left-[38px] sm:-left-[20px] w-[421px] sm:w-[320px] aspect-square"></div>
                        </div>
                    </div>
                    <div class="w-2/5 md:w-full md:p-0 md:order-1">
                        <div class="flex flex-col text-editor reveal pt-[38px] lg:pt-[25px] md:pt-0">
                            <span class="text-[18px] leading-[32px] font-light text-paragraph opacity-65 tracking-[7.2px] block mb-[50px] lg:mb-[30px]"><?=getStaticText(19)?></span>
                            <div class="boxes flex items-center gap-[28px] sm:gap-[15px] mb-[80px] xl:mb-[50px]">
                                <?php foreach($how_we_do as $index => $item): ?>
                                <div class="box min-sm:max-w-[250px] w-full tab cursor-pointer border border-solid border-black/16 grid place-items-center gap-[30px] p-[35px] lg:p-[20px] xs:p-[15px] transition-all duration-500 group/box <?= $index === 0 ? 'active' : '' ?> [&.active]:bg-secondary-main [&_*]:[&.active]:text-white" data-tab-id="arge-<?= $index ?>" 
                                    data-image="<?=env('HTTP_DOMAIN'). '/'. getFolder(['uploads_folder', 'images_folder'], app()->getLocale()) .'/' .$item->image?>">
                                    <i class="<?=$item->icon_image?> text-[55px] leading-none text-paragraph/50 transition-all duration-500"></i>
                                    <p class="text-[18px] lg:text-[16px] md:text-[15px] xs:text-[14px] leading-[27px] font-medium text-paragraph/50 transition-all duration-500 text-center">
                                        <?= $item->title ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="boxes-content w-full flex flex-col relative overflow-hidden">
                                <?php foreach($how_we_do as $index => $item): ?>
                                <div class="content w-full opacity-0 translate-x-full absolute left-0 top-0 z-2 h-full transition-all duration-500 [&.active]:relative [&.active]:opacity-100 [&.active]:translate-x-0 <?= $index === 0 ? 'active' : '' ?>" id="arge-<?= $index ?>">
                                    <h3 class="text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-light text-secondary-main mb-[30px] xs:mb-[20px]">
                                        <?= $item->title_1 ?>
                                    </h3>
                                    <p class="text-[18px] lg:text-[16px] leading-[32px] font-light text-paragraph mb-[60px] xl:mb-[40px] md:mb-[30px]">
                                        <?= $item->description ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mv relative mb-[130px] xl:mb-[100px] lg:mb-[60px] md:mb-[50px]" data-section-id="vision" id="vision-section">
            <div id="vision" class="absolute left-0 top-[-150px] xs:top-[-50px]"></div>
            <div class="container max-w-[1650px]">
                <div class="video relative">
                    <div class="bg-primary-main absolute -z-[1] -top-[30px] sm:-top-[20px] -right-[30px] sm:-right-[20px] w-[421px] xsm:w-[290px] aspect-square"></div>
                    <div class="video-image  h-[700px] md:h-[500px] sm:h-[420px] xsm:h-[320px] md:order-2" id="mv-video">
                        <video autoplay loop muted playsinline class="w-full h-full object-cover">
                            <source srcset="<?=env('HTTP_DOMAIN').'/'.getFolder(['uploads_folder','images_folder'], app()->getLocale()).'/'.$about['bg_video'] ?>" src="<?=env('HTTP_DOMAIN').'/'.getFolder(['uploads_folder','images_folder'], app()->getLocale()).'/'.$about['bg_video'] ?>">
                        </video>

                    </div>
                    <div class="content grid grid-rows-2 md:flex md:flex-col absolute md:static left-0 top-0 z-2 w-full h-full" id="mv-video-content">
                        <div class="row reveal h-full md:h-auto md:w-full md:order-1">
                            <div class="item bg-[#FBFAF6] flex flex-col justify-center gap-[30px] lg:gap-[15px] px-[60px] py-[75px] lg:py-[30px] 2xl:px-[45px] sm:p-[24px] w-2/5 md:h-auto md:w-full">
                                <div class="flex items-center gap-[20px]">
                                    <i class="icon-share text-[70px] lg:text-[40px] leading-none text-primary-main"></i>
                                    <p class="text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-bold text-secondary-main"><?=$about['mission_title']?></p>
                                </div>
                                <p class="text-[18px] lg:text-[16px] leading-[32px] font-light text-paragraph tracking-[-0.18px]"><?=$about['mission_text']?></p>
                            </div>
                        </div>
                        <div class="row reveal h-full md:h-auto md:w-full flex items-end justify-end md:order-3">
                            <div class="item bg-[#FBFAF6] flex flex-col justify-center gap-[30px] lg:gap-[15px] px-[60px] py-[75px] lg:py-[30px] 2xl:px-[45px] sm:p-[24px] w-2/5 md:h-auto md:w-full">
                                <div class="flex items-center gap-[20px]">
                                    <i class="icon-gps text-[70px] lg:text-[40px] leading-none text-primary-main"></i>
                                    <p class="text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-bold text-secondary-main"><?=$about['vision_title']?></p>
                                </div>
                                <p class="text-[18px] lg:text-[16px] leading-[32px] font-light text-paragraph tracking-[-0.18px]"><?=$about['vision_text']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="logos relative bg-[#F4F3EE] pt-[100px] xl:pt-[60px] md:pt-[50px] pb-[120px] 2xl:pb-[90px] xl:pb-[60px] md:pb-[50px] mb-[130px] xl:mb-[100px] lg:mb-[60px] md:mb-[50px]" data-section-id="memberships" id="memberships-section">
            <div id="memberships" class="absolute left-0 top-[-150px] xs:top-[-50px]"></div>
            <div class="container max-w-[1650px]">
                <div class="flex flex-col gap-[60px] 2xl:gap-[45px] md:gap-[30px]">
                    <div class="flex flex-col gap-[20px] text-center items-center">
                        <span class="reveal text-[18px] leading-[32px] font-light text-paragraph opacity-65 tracking-[7.2px] block"><?=getStaticText(17)?></span>
                        <h4 class="reveal text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-light text-secondary-main mb-[30px] xs:mb-[20px]">
                            <?=getStaticText(20)?>
                        </h4>
                    </div>
                </div>
                <div class="logos-slider overflow-hidden reveal">
                    <div class="swiper-wrapper">
                        <?php foreach ($memberships as $item): ?>
                            <div class="swiper-slide">
                                <a href="{{asset( getFolder(['uploads_folder', 'images_folder'], $item->lang) .'/'. $item->pdf_file )}}" target="_blank" class="block">
                                    <div class="item w-full h-[170px] md:h-[90px] p-[50px] xl:p-[35px] md:p-[30px] sm:p-[15px] xs:px-0 group">
                                        <img src="<?= env('HTTP_DOMAIN').'/'.getFolder(['uploads_folder','images_folder'], app()->getLocale()).'/'.$item->image ?>" alt="<?= $item->alt ?>" width="190" height="62" class="w-full h-full object-contain transition-all duration-500 min-md:opacity-50 min-md:grayscale group-hover:min-md:opacity-100 group-hover:min-md:grayscale-0">
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="policies relative mb-[150px] xl:mb-[120px] lg:mb-[90px] md:mb-[60px]" data-section-id="policies" id="policies-section">
            <div id="policies" class="absolute left-0 top-[-150px] xs:top-[-50px]"></div>
            <div class="container max-w-[1650px]">
                <div class="flex flex-wrap items-center">
                    <div class="w-1/2 md:w-full pr-[30px] 2xl:pr-[30px] md:p-0 reveal">
                        <div class="image-wrapper w-full h-[670px] 2xl:h-[620px] md:h-[580px] sm:h-[320px] relative transition-all duration-500 [&.changed]:opacity-0 [&.changed]:translate-y-[10px]">
                            <img src="<?= env('HTTP_DOMAIN').'/'.getFolder(['uploads_folder','images_folder'], app()->getLocale()).'/'.$politics[0]->image ?>" alt="Hakkımızda" width="814" height="794" class="w-full h-full object-cover relative z-2" id="tab-image">
                            <div class="bg-primary-main absolute -bottom-[38px] sm:-bottom-[20px] -left-[38px] sm:-left-[20px] w-[421px] sm:w-[320px] aspect-square transition-all duration-500 [&.changed]:opacity-0 [&.changed]:translate-y-[10px]"></div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-full pl-[90px] 2xl:pl-[60px] md:p-0 md:mt-[70px]">
                        <div class="flex flex-col">
                            <span class="reveal text-[16px] leading-[32px] font-light text-paragraph opacity-65 tracking-[7.2px] block mb-[30px]"><?=getStaticText(18)?></span>
                            <div class="tabs flex flex-col gap-[28px] w-full reveal">
                                    <?php  foreach ($politics as $key => $item): ?>
                                        <div class="tab md:overflow-hidden cursor-pointer w-full pb-[28px] last:pb-0 [&.active]:pb-[50px] [&.active]:md:pb-[30px] !border-b border-b-black/10 border-solid border-0 last:!border-0 group transition-all duration-500 <?= $key == 0 ? 'active' : ''; ?>" data-image="<?= env('HTTP_DOMAIN').'/'.getFolder(['uploads_folder','images_folder'], app()->getLocale()).'/'.$item->image ?>" data-tab-id="<?= $key ?>">
                                            <div class="flex flex-col gap-[10px] overflow-hidden">
                                                <h4 class="text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.32px] group-[&.active]:tracking-[-0.20px] font-medium text-paragraph/50 transition-all duration-300 group-[&.active]:text-secondary-main [-webkit-text-stroke:1px_rgba(51,51,51,0)] group-[&.active]:[-webkit-text-stroke:1px_rgba(8,51,85,1)] relative after:absolute after:left-[-120px] after:xl:left-[-100px] after:top-[24px] after:w-0 after:h-[3px] after:bg-primary-main after:transition-all after:duration-500 group-[&.active]:after:w-[90px] group-[&.active]:after:xl:w-[70px] after:z-2 after:md:hidden">
                                                    <?= $item->title ?>
                                                </h4>
                                                <div class="overflow-hidden description will-change-transform opacity-0 transition-all duration-500 group-[&.active]:opacity-100">
                                                    <p class="text-[18px] lg:text-[16px] leading-[32px] tracking-[-0.18px] font-light text-paragraph">
                                                        <?= $item->description ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</main>

@endsection
