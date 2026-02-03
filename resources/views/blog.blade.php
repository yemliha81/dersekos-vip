@extends('layouts.main')


@section('content')
<?php 
        $pageTitle = $seo->seo_title ?? 'Derse koş';
        $breadcrumbImage = "corporate-breadcrumb.jpg";
        $breadcrumbVideo = "breadcrumb-video.mp4";
        $pageLink = "page-corporate.php";
        $imageOrVideo = "image";
    ?> 

<main class="main-field header-space overflow-x-hidden">
   @include('partials.breadcrumb') 

    <div class="w-full mb-[135px] xl:mb-[100px] lg:mb-[75px] md:mb-[50px] sm:mb-[35px] sm:hidden">
        <div class="container max-w-[1650px] relative mt-[-310px] xl:mt-[-250px] md:mt-[60px] z-10">
            <div class="bg-primary-main absolute -z-[1] bottom-[10px] -right-[30px] w-[426px] aspect-square sm:hidden"></div>
            <div class="news-slider w-full overflow-hidden">
                <div class="swiper-wrapper">
                    <?php 
                    foreach ($blogs as $key => $item) { ?>
                        <div class="swiper-slide">
                            <div class="item w-full flex flex-wrap items-end">
                                <div class="w-1/4 md:w-1/3 sm:w-full">
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-[6px] transition-all duration-450 opacity-50 mb-[20px]">
                                            <i>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.70393 1.99397H3.22613V1.46533C3.22613 1.16329 3.47086 0.918457 3.77276 0.918457C4.07467 0.918457 4.31939 1.16329 4.31939 1.46533V1.99397H9.68259V1.46533C9.68259 1.16329 9.92731 0.918457 10.2292 0.918457C10.5311 0.918457 10.7759 1.16329 10.7759 1.46533V1.99397H11.298C12.7884 1.99397 14.001 3.20705 14.001 4.6981V12.2143C14.001 13.7054 12.7884 14.9185 11.298 14.9185H2.70391C1.21352 14.9185 0.000976562 13.7054 0.000976562 12.2143V4.6981C0.000976562 3.20705 1.21352 1.99397 2.70393 1.99397ZM11.298 3.08772H10.7759V4.15412C10.7759 4.45616 10.5311 4.701 10.2292 4.701C9.92731 4.701 9.68259 4.45616 9.68259 4.15412V3.08772H4.31937V4.15412C4.31937 4.45616 4.07464 4.701 3.77273 4.701C3.47083 4.701 3.2261 4.45616 3.2261 4.15412V3.08772H2.70391C1.81634 3.08772 1.09424 3.81014 1.09424 4.6981V5.22053H12.9077V4.6981C12.9077 3.81014 12.1856 3.08772 11.298 3.08772ZM2.70393 13.8247H11.298C12.1856 13.8247 12.9077 13.1023 12.9077 12.2143V6.31428H1.09424V12.2143C1.09424 13.1023 1.81634 13.8247 2.70393 13.8247ZM9.14506 8.46533C9.14506 8.76737 9.38978 9.01221 9.69169 9.01221H10.7667C11.0686 9.01221 11.3134 8.76737 11.3134 8.46533C11.3134 8.16329 11.0686 7.91846 10.7667 7.91846H9.69169C9.38981 7.91846 9.14506 8.16329 9.14506 8.46533ZM2.68857 8.46533C2.68857 8.76737 2.9333 9.01221 3.2352 9.01221H4.31024C4.61214 9.01221 4.85687 8.76737 4.85687 8.46533C4.85687 8.16329 4.61214 7.91846 4.31024 7.91846H3.2352C2.93333 7.91846 2.68857 8.16329 2.68857 8.46533ZM5.91993 8.46533C5.91993 8.76737 6.16466 9.01221 6.46656 9.01221H7.5416C7.8435 9.01221 8.08823 8.76737 8.08823 8.46533C8.08823 8.16329 7.8435 7.91846 7.5416 7.91846H6.46656C6.16469 7.91846 5.91993 8.16329 5.91993 8.46533ZM9.14506 11.6919C9.14506 11.9939 9.38978 12.2388 9.69169 12.2388H10.7667C11.0686 12.2388 11.3134 11.9939 11.3134 11.6919C11.3134 11.3899 11.0686 11.145 10.7667 11.145H9.69169C9.38981 11.145 9.14506 11.3899 9.14506 11.6919ZM2.68857 11.6919C2.68857 11.9939 2.9333 12.2388 3.2352 12.2388H4.31024C4.61214 12.2388 4.85687 11.9939 4.85687 11.6919C4.85687 11.3899 4.61214 11.145 4.31024 11.145H3.2352C2.93333 11.145 2.68857 11.3899 2.68857 11.6919ZM5.91993 11.6919C5.91993 11.9939 6.16466 12.2388 6.46656 12.2388H7.5416C7.8435 12.2388 8.08823 11.9939 8.08823 11.6919C8.08823 11.3899 7.8435 11.145 7.5416 11.145H6.46656C6.16469 11.145 5.91993 11.3899 5.91993 11.6919Z" fill="#333333"/>
                                                </svg>
                                            </i>
                                            <time class="text-[16px] font-medium leading-none tracking-[-0.16px] text-dark/50"><?= date('d'.'.'.'m'.'.'.'Y', strtotime($item['created_at'])) ?></time>
                                        </div>
                                        <h2><a href="<?= env('HTTP_DOMAIN').'/'. getUrl('blog_url'). '/'.$item['seo_url'] ?>" class="<?= $key == 0 ? 'reveal' : ''; ?> block text-[30px] xl:text-[22px] xl:leading-[28px] leading-[35px] font-medium text-secondary-main mb-[25px] line-clamp-2"><?= $item['title'] ?></a></h2>
                                        <p class="<?= $key == 0 ? 'reveal' : ''; ?> text-[18px] lg:text-[16px] leading-[28px] font-light text-paragraph mb-[50px] xl:mb-[30px] line-clamp-2"><?= mb_substr(strip_tags($item['description']), 0, 100) ?>...</p>
                                        <a href="<?= env('HTTP_DOMAIN').'/'. getUrl('blog_url'). '/'.$item['seo_url'] ?>" class="<?= $key == 0 ? 'reveal' : ''; ?> flex items-center justify-center relative w-max overflow-hidden main-button group sm:w-full">
                                            <div class="left px-[30px] py-[20px] flex items-center justify-center z-2 bg-transparent border border-solid border-primary-main transition-all duration-300 sm:w-full relative before:absolute before:left-0 before:top-0 before:w-0 before:h-full before:translate-x-[-100px] group-hover:before:min-md:w-full group-hover:before:min-md:translate-x-0 before:bg-primary-main before:transition-all before:duration-500">
                                                <span class="text-[16px] leading-none font-medium text-primary-main transition-all duration-300 group-hover:min-md:duration-600 group-hover:min-md:text-white translate-x-[-100px] opacity-0 group-hover:min-md:translate-x-0 group-hover:min-md:opacity-100 w-0 whitespace-nowrap relative z-2"><?=getStaticText(5)?></span>
                                                <span class="text-[16px] leading-none font-medium text-primary-main transition-all duration-600 group-hover:min-md:duration-300 group-hover:min-md:text-white group-hover:min-md:translate-x-[100px] group-hover:min-md:opacity-0 relative z-2"><?=getStaticText(5)?></span>
                                            </div>
                                            <div class="right flex items-center justify-center z-2 bg-[#9D8D5D] py-[22px] px-[24px] border border-solid border-[#9D8D5D] w-[56px] h-[58px] overflow-hidden">
                                                <i class="icon-angle-right text-[12px] leading-none text-white transition-all duration-300 group-hover:min-md:duration-600 translate-x-[-100px] opacity-0 group-hover:min-md:translate-x-0 group-hover:min-md:opacity-100 w-0 whitespace-nowrap"></i>
                                                <i class="icon-angle-right text-[12px] leading-none text-white transition-all duration-600 group-hover:min-md:duration-300 group-hover:min-md:translate-x-[100px] group-hover:min-md:opacity-0"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="w-3/4 md:w-2/3 sm:w-full pl-[95px] 2xl:pl-[60px] xl:pl-[30px] sm:pl-0 sm:mt-[30px]">
                                    <div class="image-wrapper <?= $key == 0 ? 'reveal' : ''; ?> w-full h-[650px] xl:h-[580px] lg:h-[530px] sm:h-[320px]">
                                        <img src="<?= env('HTTP_DOMAIN').'/'. getFolder(['uploads_folder','blog_images_folder', ], $item['lang']). '/'.$item['image'] ?>" alt="Blog" width="657" height="406" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="pagination-navigation sm:bg-primary-main flex justify-end sm:justify-center sm:px-[20px] py-[20px] sm:py-[10px] relative z-5">
                    <div class="reveal nav-buttons pb-[5px] flex items-center gap-[30px] ">
                        <div class="news-prev cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.news-disabled]:opacity-65 relative [&.news-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                            <i class="icon-angle-left text-[12px] leading-none text-white"></i>
                            <span class="text-[16px] leading-[32px] text-white"><?=getStaticText(2)?></span>
                        </div>

                        <div class="separator w-[1px] h-[22px] bg-white/20"></div>

                        <div class="news-next cursor-pointer flex items-center gap-[9px] transition-all duration-300 [&.news-disabled]:opacity-65 relative [&.news-disabled]:after:hidden after:absolute after:bottom-0 after:right-0 after:w-0 after:h-[1px] after:bg-white after:transition-all after:duration-300 hover:after:right-auto hover:after:left-0 hover:after:w-full">
                            <span class="text-[16px] leading-[32px] text-white"><?=getStaticText(3)?></span>
                            <i class="icon-angle-right text-[12px] leading-none text-white "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content sm:mt-[35px]">
        <div class="container max-w-[1650px]">
            <div class="filters flex items-center mb-[50px] md:mb-[30px] md:grid md:grid-cols-2 justify-between">
                <div class="flex items-center sm:col-span-2 gap-[20px_30px] whitespace-nowrap sm:whitespace-normal">
                    <div class="item flex items-center gap-[10px] sm:w-full sm:justify-between xsm:flex-col xsm:items-start">
                        <span class="reveal block text-[18px] lg:text-[16px] leading-[25px] font-light text-paragraph tracking-[-0.18px]">Yıla göre filtrele</span>
                        <div class="reveal custom-dropdown xsm:w-full">
                            <div class="dropdown relative group/dropdown">
                                <div class="placeholder flex items-center justify-between px-[32px] lg:px-[20px] py-[18px] border border-solid border-black/10 cursor-pointer">
                                    <span class="text-[16px] lg:text-[15px] leading-[25px] font-medium text-black tracking-[-0.16px] transition-all duration-300 block mr-[8px]">2024</span>
                                    <i class="icon-angle-down text-[12px] text-black leading-none transition-all duration-300 group-[&.active]/dropdown:rotate-180"></i>
                                </div>
                                <div class="dropdown-list w-full bg-white border border-solid border-black/10 overflow-hidden absolute left-0 z-10 transition-all duration-300 opacity-0 pointer-events-none group-[&.active]/dropdown:opacity-100 group-[&.active]/dropdown:pointer-events-auto">
                                    <ul class="flex flex-col gap-[10px] overflow-hidden [&_li]:px-[5px] [&_li]:py-[15px] [&_li]:block hover:[&_li]:bg-black/5 [&_li]:text-[15px] [&_li]:leading-none [&_li]:font-medium [&_li]:text-paragraph [&_li]:transition-all [&_li]:duration-300 hover:[&_li]:text-primary-main [&_li]:w-full [&_li]:text-center [&_li]:cursor-pointer">
                                        <?php for ($i = 2023; $i >= 2019; $i--): ?>
                                            <li><?= $i ?></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item flex items-center gap-[10px] sm:w-full sm:justify-between xsm:flex-col xsm:items-start">
                        <span class="reveal block text-[18px] lg:text-[16px] leading-[25px] font-light text-paragraph tracking-[-0.18px]">Listeleme Tipi</span>
                        <div class="reveal custom-dropdown xsm:w-full">
                            <div class="dropdown relative group/dropdown">
                                <div class="placeholder flex items-center justify-between px-[32px] lg:px-[20px] py-[18px] border border-solid border-black/10 cursor-pointer">
                                    <span class="text-[16px] lg:text-[15px] leading-[25px] font-medium text-black tracking-[-0.16px] transition-all duration-300 block mr-[8px]">Haber</span>
                                    <i class="icon-angle-down text-[12px] text-black leading-none transition-all duration-300 group-[&.active]/dropdown:rotate-180"></i>
                                </div>
                                <div class="dropdown-list w-full bg-white border border-solid border-black/10 overflow-hidden absolute left-0 z-10 transition-all duration-300 opacity-0 pointer-events-none group-[&.active]/dropdown:opacity-100 group-[&.active]/dropdown:pointer-events-auto">
                                    <ul class="flex flex-col gap-[10px] overflow-hidden [&_li]:px-[5px] [&_li]:py-[15px] [&_li]:block hover:[&_li]:bg-black/5 [&_li]:text-[15px] [&_li]:leading-none [&_li]:font-medium [&_li]:text-paragraph [&_li]:transition-all [&_li]:duration-300 hover:[&_li]:text-primary-main [&_li]:w-full [&_li]:text-center [&_li]:cursor-pointer">
                                        <li>Blog</li>
                                        <li>Haber</li>
                                        <li>Blog</li>
                                        <li>Haber</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="reveal separator px-[50px] xl:px-[25px] w-full md:col-span-2 md:px-0 md:py-[15px] xsm:hidden">
                    <div class="w-full h-[1px] bg-black/8"></div>
                </div>

                <div class="reveal search md:col-span-2 sm:fixed sm:left-0 sm:bottom-0 sm:w-full sm:z-10 sm:bg-[#FCFBF7] transition-all duration-450 [&.search-invisible]:opacity-0 [&.search-invisible]:pointer-events-none" id="news-search-area">
                    <form action="#" method="post">
                        <div class="form-group relative min-w-[412px] lg:min-w-[300px]">
                            <label for="search" class="hidden opacity-0 pointer-events-none invisible"></label>
                            <input type="search" name="search" id="search" placeholder="Kategoride arama yapın" class="peer w-full px-[35px] lg:px-[20px] py-[22px] xs:py-[10px] text-[17px] leading-normal tracking-[-0.17px] text-black placeholder:text-paragraph border border-solid border-black/8 transition-all duration-300 focus:border-black ">
                            <button type="submit" class="icon absolute right-[35px] lg:right-[20px] top-[25px] xs:top-[17px] peer-focus:[&_path]:[fill-opacity:1] !translate-y-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none" class="scale-y-105">
                                    <path d="M10.7596 1.77051C5.88384 1.77051 1.91211 5.47322 1.91211 10.0187C1.91211 14.5642 5.88384 18.2741 10.7596 18.2741C12.8422 18.2741 14.7575 17.5937 16.2712 16.464L19.9566 19.8979C20.1425 20.0641 20.3909 20.1558 20.6486 20.1534C20.9062 20.1509 21.1525 20.0545 21.3348 19.8848C21.5171 19.7151 21.6208 19.4856 21.6238 19.2455C21.6268 19.0053 21.5288 18.7736 21.3508 18.6L17.6655 15.1643C18.8783 13.7509 19.609 11.9625 19.609 10.0187C19.609 5.47322 15.6353 1.77051 10.7596 1.77051ZM10.7596 3.60387C14.5725 3.60387 17.6405 6.46405 17.6405 10.0187C17.6405 13.5734 14.5725 16.4408 10.7596 16.4408C6.94663 16.4408 3.87864 13.5734 3.87864 10.0187C3.87864 6.46405 6.94663 3.60387 10.7596 3.60387Z" fill="black" fill-opacity="0.55" class="transition-all duration-300"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="blog-items grid grid-cols-2 sm:flex sm:flex-col gap-[30px] mb-[130px] xl:mb-[100px] lg:mb-[70px] md:mb-[50px]">
                <?php foreach ($blogs as $item): ?>

                <div class="reveal blog-item item w-full bg-[#F0EEE7] grid grid-cols-2 md:grid-cols-1 transition-all duration-500 group/item hover:min-md:bg-secondary-main">
                    <a href="<?= env('HTTP_DOMAIN').'/'. getUrl('blog_url'). '/'. $item['seo_url'] ?>" class="block img w-full h-full min-h-[405px] lg:min-h-[350px] xs:min-h-[300px]">
                        <img src="<?= env('HTTP_DOMAIN').'/'. getFolder(['uploads_folder','blog_images_folder', ], $item['lang']). '/'.$item['image'] ?>" alt="Blog Görsel" width="405" height="405" class="w-full h-full object-cover">
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
                            <h3><a href="<?= env('HTTP_DOMAIN').'/'. getUrl('blog_url'). '/'. $item['seo_url'] ?>" class="block text-[24px] xl:text-[20px] xl:leading-[28px] leading-[35px] font-semibold text-secondary-main mb-[20px] line-clamp-2 transition-all duration-300 group-hover/item:min-md:text-white"><?= $item['title'] ?></a></h3>
                            <p class="text-[17px] lg:text-[16px] leading-[28px] font-light text-paragraph line-clamp-3 transition-all duration-300 group-hover/item:min-md:text-white"><?= mb_substr(strip_tags($item['description']), 0, 100) ?>...</p>
                        </div>
                        <a href="<?= env('HTTP_DOMAIN').'/'. getUrl('blog_url'). '/'. $item['seo_url'] ?>" class="flex items-center justify-center relative w-max sm:w-full overflow-hidden main-button group w-full">
                            <div class="w-full left px-[66px] lg:px-[35px] group-hover:min-md:px-[30px] py-[20px] flex items-center justify-center z-2 bg-transparent border border-solid border-paragraph/16 group-hover/item:min-md:border-white/16 group-hover:min-md:border-primary-main transition-all duration-300 group-hover:min-md:bg-primary-main sm:w-full">
                                <span class="text-[16px] leading-none font-medium text-paragraph transition-all duration-300 tracking-[-0.16px] group-hover/item:min-md:text-white group-hover:min-md:text-white"><?=getStaticText(5)?></span>
                            </div>
                            <div class="right flex items-center justify-center z-2 bg-[#9D8D5D] py-[22px] border border-solid border-transparent transition-all duration-300 opacity-0 w-0 group-hover:min-md:w-[56px] group-hover:min-md:px-[24px] group-hover:min-md:border-[#9D8D5D] group-hover:min-md:opacity-100 h-[58px]">
                                <i class="icon-angle-right text-[12px] leading-none text-white"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <?php endforeach; ?>
                <div class="see-all grid place-items-center col-span-2">
                    <a href="#" class="text-[16px] leading-[32px] md:text-[15px] text-[#888888] hover:text-secondary-main/90 font-light inline-flex items-center gap-[14px] transition-all duration-300">Devamını Gör <i class="icon-angle-down text-[12px]"></i></a>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection 