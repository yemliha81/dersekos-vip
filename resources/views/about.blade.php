@extends('layouts.main')

@section('content')

<main class="main-field header-space corporate-page">
    <div class="container">
        <div class="section-title mb-[50px]">
            <h1>Hakkımızda</h1>
        </div>
        <div class="about-us">
            
        </div>
    </div>
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
