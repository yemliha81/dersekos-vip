@extends('layouts.main')

@section('content')
    <?php 
        $pageTitle = $blog->title; 
        $breadcrumbImage = "corporate-breadcrumb.jpg";
        $breadcrumbVideo = "breadcrumb-video.mp4";
        $pageLink = "page-corporate.php";
        $imageOrVideo = "image";
    ?> 

<main class="main-field header-space">
    <section class="breadcrumb relative w-full h-[320px] xl:h-[270px] md:h-[240px] sm:min-h-[220px] sm:h-auto mb-[50px] sm:flex sm:items-center">
        <div class="image-video relative sm:absolute sm:z-[-1] pointer-events-none w-full h-full overflow-hidden">
            <img src="../assets/image/general/career-breadcrumb.jpg" alt="Haber Detay" width="1785" height="400" class="w-full h-full object-cover">
            <div class="overlay absolute top-0 left-0 w-full h-full z-2 [background:linear-gradient(220deg,_#FBFAF6_36.32%,_rgba(251,250,246,0.08)_93.49%)] shadow-[0px_4px_250px_0px_rgba(0,0,0,0.01)]"></div>
            <div class="overlay absolute top-0 left-0 w-full h-full z-3 [background:linear-gradient(180deg,_#083355_7.01%,_rgba(8,51,85,0.88)_48.57%,_#083355_92.89%),_linear-gradient(188deg,_#FBFAF6_18.53%,_#FBFAF6_34.55%,_rgba(251,250,246,0.68)_42.95%,_rgba(251,250,246,0.00)_68.26%)]"></div>
        </div>
        <div class="absolute left-0 top-0 w-full h-full z-4 sm:relative">
            <div class="container h-full max-w-[1650px] flex items-end sm:items-center sm:justify-center sm:text-center pb-[80px] 2xl:pb-[50px] xl:pb-[30px] sm:pt-[30px]">
                <div class="[&_a]:text-[18px] [&_a]:leading-[32px] [&_a]:font-light [&_a]:text-white [&_a]:lg:text-[16px] [&_li]:flex [&_li]:items-center before:[&_li_+_li]:block before:[&_li_+_li]:content-['/'] before:[&_li_+_li]:px-[5px] before:[&_li_+_li]:text-white before:[&_li_+_li]:font-light before:[&_li_+_li]:text-[18px] before:[&_li_+_li]:lg:text-[16px] before:[&_li_+_li]:leading-[32px]">
                    <div class="w-2/3 md:w-full">
                        <div class="flex flex-col gap-[10px] ">
                            <h1 class="reveal text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-bold text-white"><?=$blog->title?></h1>
                            <ul class="flex items-center sm:justify-center md:flex-wrap min-md:whitespace-pre sm:hidden">
                                <li class="reveal">
                                    <a href="<?=env('HTTP_DOMAIN')?>"><?=getStaticText(10)?></a>
                                </li>
                                <li class="reveal">
                                    <a href="<?=env('HTTP_DOMAIN').'/'.getUrl('blog_url')?>">{{$blog->title}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container max-w-[1650px] mb-[60px] md:mb-[50px]">
        <div class="flex flex-wrap w-full news-detail">
            <div class="w-1/3 md:w-full">
                <div class="w-full flex md:flex-col gap-[50px] 2xl:gap-[30px]">
                    <div class="social md:order-2 h-max sticky top-[130px] pb-[30px] md:pb-0">
                        <ul class="flex flex-col md:flex-row md:justify-center items-center gap-[28px] [&_i]:hover:[&_a]:text-primary-400 [&_i]:hover:[&_p]:text-primary-400">
                            <?php $social = [
                                [
                                    'link' => 'https://wa.me',
                                    'icon' => 'whatsapp'
                                ],
                                [
                                    'link' => 'https://facebook.com',
                                    'icon' => 'facebook'
                                ],
                                [
                                    'link' => 'https://twitter.com',
                                    'icon' => 'twitter'
                                ],
                                [
                                    'link' => 'https://linkedin.com',
                                    'icon' => 'linkedin'
                                ],
                            ];
                            foreach ($social as $key => $item) { ?>
                                <li class="reveal relative">
                                    <a href="<?= $item['link'] ?>" class="group flex items-center text-[27px] text-[#B0B0B0]">
                                        <i class="icon-<?= $item['icon'] ?> transition-all duration-300"></i>
                                        <div class="tooltip md:hidden absolute opacity-0 group-hover:opacity-100 translate-x-0 2xl:group-hover:translate-x-[50px] group-hover:-translate-x-[60px] px-[10px] py-[20px] flex bg-primary-400 transition-all duration-300">
                                            <div class="icon-triangle-down absolute 2xl:left-[-12px] right-[-12px] translate-x-1/2 top-1/2 -translate-y-1/2 2xl:-translate-x-1/2 text-primary-400 2xl:rotate-90 -rotate-90 w-[26px]"></div>
                                            <span class="text-[16px] leading-none font-medium text-white 2xl:[writing-mode:vertical-rl] [writing-mode:vertical-lr]">Paylaş</span>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="reveal relative">
                                <div class="group flex items-center text-[27px] text-[#B0B0B0] cursor-pointer" id="copy-link">
                                    <i class="icon-link transition-all duration-300"></i>
                                    <div class="tooltip md:hidden absolute opacity-0 group-hover:opacity-100 translate-x-0 2xl:group-hover:translate-x-[50px] group-hover:-translate-x-[60px] px-[10px] py-[20px] flex bg-primary-400 transition-all duration-300 group-[&.copied]:bg-secondary-main ">
                                        <div class="icon-triangle-down absolute 2xl:left-[-12px] right-[-12px] translate-x-1/2 top-1/2 -translate-y-1/2 2xl:-translate-x-1/2 text-primary-400 2xl:rotate-90 -rotate-90 w-[26px] transition-all duration-300 group-[&.copied]:text-secondary-main"></div>
                                        <span id="span" class="text-[16px] leading-none font-medium text-white 2xl:[writing-mode:vertical-rl] [writing-mode:vertical-lr]">Kopyala</span>
                                        <span id="copy-text" class="hidden opacity-0 invisible h-0 w-0 overflow-hidden 2xl:[writing-mode:vertical-rl] [writing-mode:vertical-lr]">Kopyala</span>
                                        <span id="copied-text" class="hidden opacity-0 invisible h-0 w-0 overflow-hidden 2xl:[writing-mode:vertical-rl] [writing-mode:vertical-lr]">Kopyalandı</span>
                                    </div>
                                </div>
                            </li>

                            <li class="reveal relative">
                                <div class="group flex items-center text-[27px] text-[#B0B0B0] cursor-pointer" id="print">
                                    <i class="icon-printer transition-all duration-300"></i>
                                    <div class="tooltip md:hidden absolute opacity-0 group-hover:opacity-100 translate-x-0 2xl:group-hover:translate-x-[50px] group-hover:-translate-x-[60px] px-[10px] py-[20px] flex bg-primary-400 transition-all duration-300">
                                        <div class="icon-triangle-down absolute 2xl:left-[-12px] right-[-12px] translate-x-1/2 top-1/2 -translate-y-1/2 2xl:-translate-x-1/2 text-primary-400 2xl:rotate-90 -rotate-90 w-[26px] transition-all duration-300 group-[&.copied]:text-secondary-main"></div>
                                        <span class="text-[16px] leading-none font-medium text-white 2xl:[writing-mode:vertical-rl] [writing-mode:vertical-lr]">Yazdır</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="editor-area md:order-1 ">
                        <div class="title text-editor" id="news-title">
                            <h2><?=$blog->title?></h2>
                        </div>
                        <div class="flex items-center gap-[30px] mb-[20px]">
                            <div class="flex items-center gap-[6px] transition-all duration-450 opacity-50">
                                <i>
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.70393 1.99397H3.22613V1.46533C3.22613 1.16329 3.47086 0.918457 3.77276 0.918457C4.07467 0.918457 4.31939 1.16329 4.31939 1.46533V1.99397H9.68259V1.46533C9.68259 1.16329 9.92731 0.918457 10.2292 0.918457C10.5311 0.918457 10.7759 1.16329 10.7759 1.46533V1.99397H11.298C12.7884 1.99397 14.001 3.20705 14.001 4.6981V12.2143C14.001 13.7054 12.7884 14.9185 11.298 14.9185H2.70391C1.21352 14.9185 0.000976562 13.7054 0.000976562 12.2143V4.6981C0.000976562 3.20705 1.21352 1.99397 2.70393 1.99397ZM11.298 3.08772H10.7759V4.15412C10.7759 4.45616 10.5311 4.701 10.2292 4.701C9.92731 4.701 9.68259 4.45616 9.68259 4.15412V3.08772H4.31937V4.15412C4.31937 4.45616 4.07464 4.701 3.77273 4.701C3.47083 4.701 3.2261 4.45616 3.2261 4.15412V3.08772H2.70391C1.81634 3.08772 1.09424 3.81014 1.09424 4.6981V5.22053H12.9077V4.6981C12.9077 3.81014 12.1856 3.08772 11.298 3.08772ZM2.70393 13.8247H11.298C12.1856 13.8247 12.9077 13.1023 12.9077 12.2143V6.31428H1.09424V12.2143C1.09424 13.1023 1.81634 13.8247 2.70393 13.8247ZM9.14506 8.46533C9.14506 8.76737 9.38978 9.01221 9.69169 9.01221H10.7667C11.0686 9.01221 11.3134 8.76737 11.3134 8.46533C11.3134 8.16329 11.0686 7.91846 10.7667 7.91846H9.69169C9.38981 7.91846 9.14506 8.16329 9.14506 8.46533ZM2.68857 8.46533C2.68857 8.76737 2.9333 9.01221 3.2352 9.01221H4.31024C4.61214 9.01221 4.85687 8.76737 4.85687 8.46533C4.85687 8.16329 4.61214 7.91846 4.31024 7.91846H3.2352C2.93333 7.91846 2.68857 8.16329 2.68857 8.46533ZM5.91993 8.46533C5.91993 8.76737 6.16466 9.01221 6.46656 9.01221H7.5416C7.8435 9.01221 8.08823 8.76737 8.08823 8.46533C8.08823 8.16329 7.8435 7.91846 7.5416 7.91846H6.46656C6.16469 7.91846 5.91993 8.16329 5.91993 8.46533ZM9.14506 11.6919C9.14506 11.9939 9.38978 12.2388 9.69169 12.2388H10.7667C11.0686 12.2388 11.3134 11.9939 11.3134 11.6919C11.3134 11.3899 11.0686 11.145 10.7667 11.145H9.69169C9.38981 11.145 9.14506 11.3899 9.14506 11.6919ZM2.68857 11.6919C2.68857 11.9939 2.9333 12.2388 3.2352 12.2388H4.31024C4.61214 12.2388 4.85687 11.9939 4.85687 11.6919C4.85687 11.3899 4.61214 11.145 4.31024 11.145H3.2352C2.93333 11.145 2.68857 11.3899 2.68857 11.6919ZM5.91993 11.6919C5.91993 11.9939 6.16466 12.2388 6.46656 12.2388H7.5416C7.8435 12.2388 8.08823 11.9939 8.08823 11.6919C8.08823 11.3899 7.8435 11.145 7.5416 11.145H6.46656C6.16469 11.145 5.91993 11.3899 5.91993 11.6919Z" fill="#333333"/>
                                    </svg>
                                </i>
                                <time class="text-[16px] font-medium leading-none tracking-[-0.16px] text-dark/50"><?= date('d'.'.'.'m'.'.'.'Y', strtotime($blog['created_at'])) ?></time>
                            </div>
                            <div class="stars right flex gap-[10px] reveal" data-selected-rate="">
                                <a class="rating-star cursor-pointer text-[24px] flex justify-center items-center icon-star duration-450 text-[#008826]/20 [&.to-rate]:text-[#008826] [&.to-hover]:text-[#008826] [&.rated]:text-[#008826] [&.no-to-rated]:text-[#d0e8f0]" data-id="1">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                                        <path d="M8.02447 0.463524C8.17415 0.00286853 8.82585 0.00287008 8.97553 0.463525L10.5206 5.21885C10.5876 5.42486 10.7795 5.56434 10.9962 5.56434H15.9962C16.4806 5.56434 16.6819 6.18415 16.2901 6.46885L12.245 9.4078C12.0697 9.53512 11.9964 9.7608 12.0633 9.96681L13.6084 14.7221C13.7581 15.1828 13.2309 15.5659 12.839 15.2812L8.79389 12.3422C8.61865 12.2149 8.38135 12.2149 8.20611 12.3422L4.16099 15.2812C3.76913 15.5659 3.24189 15.1828 3.39157 14.7221L4.93667 9.96681C5.0036 9.7608 4.93027 9.53512 4.75503 9.4078L0.709911 6.46885C0.318054 6.18415 0.519443 5.56434 1.0038 5.56434H6.00385C6.22046 5.56434 6.41244 5.42486 6.47937 5.21885L8.02447 0.463524Z"/>
                                    </svg>
                                </a>
                                <a class="rating-star cursor-pointer text-[24px] flex justify-center items-center icon-star duration-450 text-[#008826]/20 [&.to-rate]:text-[#008826] [&.to-hover]:text-[#008826] [&.rated]:text-[#008826] [&.no-to-rated]:text-[#d0e8f0]" data-id="2">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                                        <path d="M8.02447 0.463524C8.17415 0.00286853 8.82585 0.00287008 8.97553 0.463525L10.5206 5.21885C10.5876 5.42486 10.7795 5.56434 10.9962 5.56434H15.9962C16.4806 5.56434 16.6819 6.18415 16.2901 6.46885L12.245 9.4078C12.0697 9.53512 11.9964 9.7608 12.0633 9.96681L13.6084 14.7221C13.7581 15.1828 13.2309 15.5659 12.839 15.2812L8.79389 12.3422C8.61865 12.2149 8.38135 12.2149 8.20611 12.3422L4.16099 15.2812C3.76913 15.5659 3.24189 15.1828 3.39157 14.7221L4.93667 9.96681C5.0036 9.7608 4.93027 9.53512 4.75503 9.4078L0.709911 6.46885C0.318054 6.18415 0.519443 5.56434 1.0038 5.56434H6.00385C6.22046 5.56434 6.41244 5.42486 6.47937 5.21885L8.02447 0.463524Z"/>
                                    </svg>
                                </a>
                                <a class="rating-star cursor-pointer text-[24px] flex justify-center items-center icon-star duration-450 text-[#008826]/20 [&.to-rate]:text-[#008826] [&.to-hover]:text-[#008826] [&.rated]:text-[#008826] [&.no-to-rated]:text-[#d0e8f0]" data-id="3">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                                        <path d="M8.02447 0.463524C8.17415 0.00286853 8.82585 0.00287008 8.97553 0.463525L10.5206 5.21885C10.5876 5.42486 10.7795 5.56434 10.9962 5.56434H15.9962C16.4806 5.56434 16.6819 6.18415 16.2901 6.46885L12.245 9.4078C12.0697 9.53512 11.9964 9.7608 12.0633 9.96681L13.6084 14.7221C13.7581 15.1828 13.2309 15.5659 12.839 15.2812L8.79389 12.3422C8.61865 12.2149 8.38135 12.2149 8.20611 12.3422L4.16099 15.2812C3.76913 15.5659 3.24189 15.1828 3.39157 14.7221L4.93667 9.96681C5.0036 9.7608 4.93027 9.53512 4.75503 9.4078L0.709911 6.46885C0.318054 6.18415 0.519443 5.56434 1.0038 5.56434H6.00385C6.22046 5.56434 6.41244 5.42486 6.47937 5.21885L8.02447 0.463524Z"/>
                                    </svg>
                                </a>
                                <a class="rating-star cursor-pointer text-[24px] flex justify-center items-center icon-star duration-450 text-[#008826]/20 [&.to-rate]:text-[#008826] [&.to-hover]:text-[#008826] [&.rated]:text-[#008826] [&.no-to-rated]:text-[#d0e8f0]" data-id="4">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                                        <path d="M8.02447 0.463524C8.17415 0.00286853 8.82585 0.00287008 8.97553 0.463525L10.5206 5.21885C10.5876 5.42486 10.7795 5.56434 10.9962 5.56434H15.9962C16.4806 5.56434 16.6819 6.18415 16.2901 6.46885L12.245 9.4078C12.0697 9.53512 11.9964 9.7608 12.0633 9.96681L13.6084 14.7221C13.7581 15.1828 13.2309 15.5659 12.839 15.2812L8.79389 12.3422C8.61865 12.2149 8.38135 12.2149 8.20611 12.3422L4.16099 15.2812C3.76913 15.5659 3.24189 15.1828 3.39157 14.7221L4.93667 9.96681C5.0036 9.7608 4.93027 9.53512 4.75503 9.4078L0.709911 6.46885C0.318054 6.18415 0.519443 5.56434 1.0038 5.56434H6.00385C6.22046 5.56434 6.41244 5.42486 6.47937 5.21885L8.02447 0.463524Z"/>
                                    </svg>
                                </a>
                                <a class="rating-star cursor-pointer text-[24px] flex justify-center items-center icon-star duration-450 text-[#008826]/20 [&.to-rate]:text-[#008826] [&.to-hover]:text-[#008826] [&.rated]:text-[#008826] [&.no-to-rated]:text-[#d0e8f0]" data-id="5">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                                        <path d="M8.02447 0.463524C8.17415 0.00286853 8.82585 0.00287008 8.97553 0.463525L10.5206 5.21885C10.5876 5.42486 10.7795 5.56434 10.9962 5.56434H15.9962C16.4806 5.56434 16.6819 6.18415 16.2901 6.46885L12.245 9.4078C12.0697 9.53512 11.9964 9.7608 12.0633 9.96681L13.6084 14.7221C13.7581 15.1828 13.2309 15.5659 12.839 15.2812L8.79389 12.3422C8.61865 12.2149 8.38135 12.2149 8.20611 12.3422L4.16099 15.2812C3.76913 15.5659 3.24189 15.1828 3.39157 14.7221L4.93667 9.96681C5.0036 9.7608 4.93027 9.53512 4.75503 9.4078L0.709911 6.46885C0.318054 6.18415 0.519443 5.56434 1.0038 5.56434H6.00385C6.22046 5.56434 6.41244 5.42486 6.47937 5.21885L8.02447 0.463524Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="content text-editor">
                            <?=$blog->description?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-2/3 md:w-full pl-[85px] 2xl:pl-[55px] xl:pl-[30px] sm:pl-0 md:mt-[30px] relative after:absolute after:w-full after:h-[300px] after:bottom-0 after:left-[60px] after:z-[11] after:pointer-events-none after:bg-[linear-gradient(0deg,_#FBFAF6_20%,_rgba(251,250,246,0.00)_100%)] after:md:hidden" id="news-detail-slider-area">
                <div class="sticky top-[130px] pb-[90px] sm:pb-[20px] z-10 mt-[-270px] 2xl:mt-[-250px] xl:mt-[-210px] lg:mt-[-200px] md:mt-0">
                    <div class="bg-primary-main absolute -z-[1] bottom-0 translate-y-[-70px] sm:translate-y-[-10px] translate-x-[60px] 2xl:translate-x-[30px] right-0 w-[426px] sm:w-[250px] aspect-square"></div>
                    <div class="news-detail-slider overflow-hidden reveal">
                        <div class="swiper-wrapper">
                            <?php foreach($blogSlider as $slide): ?>
                                <div class="swiper-slide">
                                    <div class="image-wrapper relative w-full h-[650px] xl:h-[580px] lg:h-[530px] sm:h-[320px] 2xl:pl-[30px] xl:pl-[60px] md:pl-0">
                                        <img src="<?= env('HTTP_DOMAIN') .'/'. getFolder(['uploads_folder','blog_images_folder'], $slide->lang) .'/'.  $slide->media_file ?>" alt="Blog" width="657" height="406" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="nav-buttons pl-[30px] pt-[15px] flex items-center justify-end gap-[30px] md:gap-[20px]">
                            <div class="news-detail-prev cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.news-detail-disabled]:opacity-65 relative z-4 [&.news-detail-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                                <i class="icon-angle-left text-[12px] leading-none text-white"></i>
                                <span class="text-[16px] leading-[32px] text-white"><?=getStaticText(2)?></span>
                            </div>

                            <div class="separator w-[1px] h-[22px] bg-white/20 relative z-4"></div>

                            <div class="news-detail-next cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.news-detail-disabled]:opacity-65 relative z-4 [&.news-detail-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                                <span class="text-[16px] leading-[32px] text-white"><?=getStaticText(3)?></span>
                                <i class="icon-angle-right text-[12px] leading-none text-white "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container max-w-[1650px]">
        <div class="flex flex-col gap-[40px]">
            <div class="flex items-center xsm:flex-col xsm:items-start justify-between gap-[30px] relative">
                <h4 class="reveal text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-light text-secondary-main" id="other-new-title">
                    Derse koş’dan <br>
                    <span class="font-bold">Haberler & Blog</span>
                </h4>
                <div class="reveal nav-buttons flex items-center justify-end gap-[30px] xsm:absolute xsm:w-full xsm:p-[10px] xsm:left-0 xsm:justify-center xsm:bg-white/20 xsm:backdrop-blur-[20px] xsm:z-5">
                    <div class="other-prev group cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.other-disabled]:opacity-65 [&.other-disabled]:text-paragraph [&.other-disabled]:xsm:text-white relative [&.other-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-primary-main after:xsm:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                        <i class="icon-angle-left text-[12px] leading-none text-primary-main xsm:text-white transition-all duration-300 group-[&.other-disabled]:text-paragraph group-[&.other-disabled]:xsm:text-white"></i>
                        <span class="text-[16px] leading-[32px] text-primary-main xsm:text-white transition-all duration-300 group-[&.other-disabled]:text-paragraph group-[&.other-disabled]:xsm:text-white"><?=getStaticText(2)?></span>
                    </div>

                    <div class="separator w-[1px] h-[22px] bg-paragraph/20 xsm:bg-white/20"></div>

                    <div class="other-next group cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.other-disabled]:opacity-65 [&.other-disabled]:text-paragraph [&.other-disabled]:xsm:text-white relative [&.other-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-primary-main after:xsm:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                        <span class="text-[16px] leading-[32px] text-primary-main xsm:text-white transition-all duration-300 group-[&.other-disabled]:text-paragraph group-[&.other-disabled]:xsm:text-white"><?=getStaticText(3)?></span>
                        <i class="icon-angle-right text-[12px] leading-none text-primary-main xsm:text-white transition-all duration-300 group-[&.other-disabled]:text-paragraph group-[&.other-disabled]:xsm:text-white"></i>
                    </div>
                </div>
            </div>
            <div class="other-news-slider reveal overflow-hidden mb-[130px] xl:mb-[100px] lg:mb-[70px] md:mb-[50px]">
                <div class="swiper-wrapper">
                    <?php foreach ($blogs as $item): ?>

                        <div class="swiper-slide">
                            <div class="item w-full bg-[#F0EEE7] grid grid-cols-2 md:grid-cols-1 transition-all duration-500 group/item hover:min-md:bg-secondary-main">
                                <a href="<?= $item['seo_url'] ?>" class="block img w-full min-h-[405px] lg:min-h-[350px] xs:min-h-[300px]">
                                    <img src="<?= env('HTTP_DOMAIN').'/'.getFolder(['uploads_folder', 'blog_images_folder'], app()->getLocale()).'/'.$item['image'] ?>" alt="Blog Görsel" width="405" height="405" class="w-full h-full object-cover">
                                </a>
                                <div class="p-[45px] xl:p-[35px] lg:p-[15px] lg:py-[25px] w-full flex flex-col justify-between gap-[20px]">
                                    <div class="flex items-center gap-[6px] transition-all duration-450 opacity-50 group-hover/item:opacity-100 mb-[20px]">
                                        <i>
                                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="[&_path]:transition-all [&_path]:duration-450 group-hover/item:[&_path]:fill-white">
                                                <path d="M2.70393 1.99397H3.22613V1.46533C3.22613 1.16329 3.47086 0.918457 3.77276 0.918457C4.07467 0.918457 4.31939 1.16329 4.31939 1.46533V1.99397H9.68259V1.46533C9.68259 1.16329 9.92731 0.918457 10.2292 0.918457C10.5311 0.918457 10.7759 1.16329 10.7759 1.46533V1.99397H11.298C12.7884 1.99397 14.001 3.20705 14.001 4.6981V12.2143C14.001 13.7054 12.7884 14.9185 11.298 14.9185H2.70391C1.21352 14.9185 0.000976562 13.7054 0.000976562 12.2143V4.6981C0.000976562 3.20705 1.21352 1.99397 2.70393 1.99397ZM11.298 3.08772H10.7759V4.15412C10.7759 4.45616 10.5311 4.701 10.2292 4.701C9.92731 4.701 9.68259 4.45616 9.68259 4.15412V3.08772H4.31937V4.15412C4.31937 4.45616 4.07464 4.701 3.77273 4.701C3.47083 4.701 3.2261 4.45616 3.2261 4.15412V3.08772H2.70391C1.81634 3.08772 1.09424 3.81014 1.09424 4.6981V5.22053H12.9077V4.6981C12.9077 3.81014 12.1856 3.08772 11.298 3.08772ZM2.70393 13.8247H11.298C12.1856 13.8247 12.9077 13.1023 12.9077 12.2143V6.31428H1.09424V12.2143C1.09424 13.1023 1.81634 13.8247 2.70393 13.8247ZM9.14506 8.46533C9.14506 8.76737 9.38978 9.01221 9.69169 9.01221H10.7667C11.0686 9.01221 11.3134 8.76737 11.3134 8.46533C11.3134 8.16329 11.0686 7.91846 10.7667 7.91846H9.69169C9.38981 7.91846 9.14506 8.16329 9.14506 8.46533ZM2.68857 8.46533C2.68857 8.76737 2.9333 9.01221 3.2352 9.01221H4.31024C4.61214 9.01221 4.85687 8.76737 4.85687 8.46533C4.85687 8.16329 4.61214 7.91846 4.31024 7.91846H3.2352C2.93333 7.91846 2.68857 8.16329 2.68857 8.46533ZM5.91993 8.46533C5.91993 8.76737 6.16466 9.01221 6.46656 9.01221H7.5416C7.8435 9.01221 8.08823 8.76737 8.08823 8.46533C8.08823 8.16329 7.8435 7.91846 7.5416 7.91846H6.46656C6.16469 7.91846 5.91993 8.16329 5.91993 8.46533ZM9.14506 11.6919C9.14506 11.9939 9.38978 12.2388 9.69169 12.2388H10.7667C11.0686 12.2388 11.3134 11.9939 11.3134 11.6919C11.3134 11.3899 11.0686 11.145 10.7667 11.145H9.69169C9.38981 11.145 9.14506 11.3899 9.14506 11.6919ZM2.68857 11.6919C2.68857 11.9939 2.9333 12.2388 3.2352 12.2388H4.31024C4.61214 12.2388 4.85687 11.9939 4.85687 11.6919C4.85687 11.3899 4.61214 11.145 4.31024 11.145H3.2352C2.93333 11.145 2.68857 11.3899 2.68857 11.6919ZM5.91993 11.6919C5.91993 11.9939 6.16466 12.2388 6.46656 12.2388H7.5416C7.8435 12.2388 8.08823 11.9939 8.08823 11.6919C8.08823 11.3899 7.8435 11.145 7.5416 11.145H6.46656C6.16469 11.145 5.91993 11.3899 5.91993 11.6919Z" fill="#333333"/>
                                            </svg>
                                        </i>
                                        <time class="text-[16px] font-medium leading-none tracking-[-0.16px] text-dark/50 group-hover/item:text-white transition-all duration-450"><?= date('d'.'.'.'m'.'.'.'Y', strtotime($item['created_at'])) ?></time>
                                    </div>
                                    <div class="flex flex-col">
                                        <a href="<?= env('HTTP_DOMAIN').'/'.getUrl('blog_url').'/'. $item['seo_url'] ?>" class="block text-[24px] xl:text-[20px] xl:leading-[28px] leading-[35px] font-semibold text-secondary-main mb-[20px] line-clamp-2 transition-all duration-300 group-hover/item:min-md:text-white"><?= $item['title'] ?></a>
                                        <p class="text-[17px] lg:text-[16px] leading-[28px] font-light text-paragraph line-clamp-3 transition-all duration-300 group-hover/item:min-md:text-white"><?= mb_substr($item['description'], 0, 100) ?>...</p>
                                    </div>
                                    <a href="<?= $item['seo_url'] ?>" class="flex items-center justify-center relative w-max sm:w-full overflow-hidden main-button group w-full">
                                        <div class="w-full left px-[66px] lg:px-[35px] group-hover:px-[30px] py-[20px] flex items-center justify-center z-2 bg-transparent border border-solid border-paragraph/16 group-hover/item:min-md:border-white/16 group-hover:min-md:border-primary-main transition-all duration-300 group-hover:min-md:bg-primary-main sm:w-full">
                                            <span class="text-[16px] leading-none font-medium text-paragraph transition-all duration-300 tracking-[-0.16px] group-hover/item:min-md:text-white group-hover:min-md:text-white"><?=getStaticText(5)?></span>
                                        </div>
                                        <div class="right flex items-center justify-center z-2 bg-[#9D8D5D] py-[22px] border border-solid border-transparent transition-all duration-300 opacity-0 w-0 group-hover:min-md:w-[56px] group-hover:min-md:px-[24px] group-hover:min-md:border-[#9D8D5D] group-hover:min-md:opacity-100 h-[58px]">
                                            <i class="icon-angle-right text-[12px] leading-none text-white"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    let ratingStar = document.querySelectorAll('.rating-star');
    let dataSelectedRate
    ratingStar.forEach((item, index) => {
        item.addEventListener('click', () => {
            ratingStar.forEach((item, index) => {
                item.classList.remove('to-rate');
                item.classList.remove('rated');
                item.classList.add('no-to-rated');
            });
            for (let i = 0; i <= index; i++) {
                ratingStar[i].classList.remove('no-to-rated');
                ratingStar[i].classList.add('rated');
            }
            item.classList.add('to-rate');

            dataSelectedRate = item.dataset.id;
            item.parentElement.dataset.selectedRate = dataSelectedRate;
            // item.parentElement.querySelector('.rating-text span').innerText = dataSelectedRate;
        });

        item.addEventListener('mouseover', () => {
            ratingStar.forEach((item, index) => {
                item.classList.remove('to-hover');
            });
            for (let i = 0; i <= index; i++) {
                ratingStar[i].classList.add('to-hover');
            }

            dataSelectedRate = item.dataset.id;
            // item.parentElement.querySelector('.rating-text span').innerText = dataSelectedRate;
        });

        item.addEventListener('mouseout', () => {
            ratingStar.forEach((item, index) => {
                item.classList.remove('to-hover');
            });

            dataSelectedRate = item.dataset.id;
            // item.parentElement.querySelector('.rating-text span').innerText = dataSelectedRate;
        });
    });
</script>

@endsection