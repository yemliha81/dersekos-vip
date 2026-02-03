@extends('layouts.main')

@section('content')

<?php 
    $pageTitle = getStaticText(36); 
    $pageLink = "page-contact.php"; 
?>

<main class="main-field contact-page">
    <section class="content">
        <div class="map-area w-full aspect-[16/6] sm:aspect-[5/4] relative">
            <div class="absolute pointer-events-none left-0 top-0 w-full h-full z-3 [background:radial-gradient(73.45%_54.34%_at_50%_54.34%,_rgba(251,250,246,0.00)_0%,_#FCFBF7_100%)] md:opacity-50"></div>
            <div class="absolute pointer-events-none left-0 top-0 w-full h-full z-4 bg-white mix-blend-darken"></div>
            <div id="map" class="reveal w-full h-full [&_.gm-style_iframe_+_div]:!border-0 [&_gmp-advanced-marker]:z-100"></div>
            <div class="absolute left-0 top-0 w-full h-full z-5 pointer-events-none" id="contact-breadcrumb">
                <div class="container h-full max-w-[1650px] flex justify-center pt-[100px] xl:pt-[60px] sm:pt-[10px] xs:pb-[20px]">
                    <div class="flex flex-col xs:justify-end text-center gap-[10px] [&_a]:text-[18px] [&_a]:leading-[32px] [&_a]:font-light [&_a]:text-secondary-main [&_a]:lg:text-[16px] [&_a]:pointer-events-auto [&_li]:flex [&_li]:items-center before:[&_li_+_li]:block before:[&_li_+_li]:content-['/'] before:[&_li_+_li]:px-[5px] before:[&_li_+_li]:text-secondary-main before:[&_li_+_li]:font-light before:[&_li_+_li]:text-[18px] before:[&_li_+_li]:lg:text-[16px] before:[&_li_+_li]:leading-[32px]">
                        <h1 class="reveal text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-bold text-secondary-main"><?= $pageTitle ?></h1>
                        <ul class="flex items-center justify-center">
                            <li class="reveal">
                                <a href="<?=env('HTTP_DOMAIN')?>"><?=getStaticText(10)?></a>
                            </li>
                            <li class="reveal">
                                <a href="javascript:;"><?= $pageTitle ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content locations-tab-area mt-[-160px] md:mt-0 relative z-3 overflow-hidden">
                <div class="ml-0 min-h-[290px] md:min-h-max bg-secondary-main pr-[170px] 2xl:pr-[140px] xl:pr-[100px] lg:pr-[75px] md:px-[15px] secondary-bg md:hidden"></div>

                <div class="location-info-container flex justify-end mt-[-152px] md:mt-0">
                    <div class="location-contents w-full mr-0 min-h-[180px] md:min-h-max bg-primary-main py-[80px] md:py-[40px] primary-bg md:hidden"></div>
                </div>

                <div class="absolute left-0 top-0 z-4 w-full h-full md:static overflow-hidden">
                    <div class="location-tabs container max-w-[1650px] flex flex-col gap-[130px] md:gap-0 md:relative min-md:before:hidden before:md:w-[calc(100%+60px)] before:md:absolute before:md:left-[-30px] before:md:top-0 before:md:h-full before:bg-secondary-main">
                        <div class="tabs flex items-center min-md:justify-center md:whitespace-nowrap md:overflow-x-scroll md:[scroll-snap-type:x_mandatory] md:pb-[40px] md:pt-[60px] mt-[40px] md:my-0 md:px-[15px] sm:px-0">
                            <?php $locations = $offices;
                            foreach ($locations as $key => $item): ?>
                                <div class="tab reveal md:snap-start cursor-pointer relative flex flex-col items-center justify-center group px-[50px] xl:px-[25px] last:pr-0 first:pl-0 last:!border-0 border-0 !border-r border-solid border-white/10 <?= $key == 0 ? 'active' : ''; ?>" data-tab-id="<?= $key ?>" data-id="<?= $key ?>">
                                    <p class="text-[26px] lg:text-[22px] md:text-[20px] leading-none font-medium tracking-[-0.26px] group-[&.active]:tracking-[-0.13px] text-white/50 transition-all duration-300 [-webkit-text-stroke:1px_rgba(182,163,107,0)] group-[&.active]:[-webkit-text-stroke:1px_rgba(182,163,107,1)] group-[&.active]:text-primary-main text-center"><?= $item->title ?></p>
                                    <i class="icon-triangle-down leading-none text-primary-main transition-all duration-300 opacity-0 group-[&.active]:opacity-100 absolute bottom-[-35px]"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="wrapper group/hand absolute right-[30px] top-[15px] z-20 ">
                            <div class="slider-hand group-hover/hand:opacity-0 duration-450 w-[25px] h-[25px] animate-run hidden md:block">
                              <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                  <g fill="rgb(255,255,255)">
                                    <g>
                                      <path d="m161.875 434.037c27.773 48.089 79.523 77.963 135.056 77.963 85.996 0 155.96-69.963 155.96-155.959v-122.11c0-21.904-17.82-39.724-39.724-39.724-8.722 0-16.796 2.825-23.355 7.609-4.461-17.056-20.003-29.678-38.438-29.678-9.223 0-17.723 3.16-24.472 8.454-5.57-15.218-20.197-26.109-37.321-26.109-8.159 0-15.753 2.474-22.069 6.709v-77.33c0-21.904-17.82-39.724-39.724-39.724s-39.724 17.82-39.724 39.724v210.602c0 2.708-1.586 5.195-4.042 6.337-3.309 1.539-7.176.316-9.001-2.842l-26.488-45.878c-7.663-13.272-20.035-22.767-34.839-26.734-14.806-3.967-30.267-1.931-43.539 5.732-5.105 2.947-8.758 7.707-10.284 13.402-1.525 5.695-.741 11.643 2.207 16.748zm-84.95-184.987c.176-.659.678-1.885 2.056-2.68 6.121-3.534 12.913-5.339 19.797-5.339 3.449 0 6.923.454 10.345 1.371 10.249 2.746 18.814 9.319 24.12 18.508l26.488 45.878c6.43 11.138 20.076 15.445 31.737 10.024 8.657-4.027 14.251-12.798 14.251-22.346v-210.604c0-12.169 9.9-22.069 22.069-22.069s22.069 9.9 22.069 22.069v163.31c0 4.875 3.952 8.828 8.828 8.828s8.828-3.952 8.828-8.828v-52.965c0-12.169 9.9-22.069 22.069-22.069s22.069 9.9 22.069 22.069v52.965c0 4.875 3.952 8.828 8.828 8.828 4.875 0 8.828-3.952 8.828-8.828v-35.31c0-12.169 9.9-22.069 22.069-22.069s22.069 9.9 22.069 22.069v39.724c0 4.875 3.952 8.828 8.828 8.828 4.875 0 8.828-3.952 8.828-8.828v-17.655c0-12.169 9.9-22.069 22.069-22.069s22.069 9.9 22.069 22.069v122.11c0 76.261-62.043 138.304-138.305 138.304-49.246 0-95.138-26.492-119.766-69.138l-99.803-172.808c-.795-1.377-.617-2.69-.44-3.349z"></path>
                                      <path d="m167.556 129.479c4.202-2.473 5.602-7.884 3.129-12.086-5.957-10.118-9.105-21.713-9.105-33.531 0-36.507 29.7-66.207 66.207-66.207s66.207 29.7 66.207 66.207c0 11.862-3.171 23.497-9.172 33.645-2.482 4.197-1.091 9.611 3.105 12.092 1.41.834 2.958 1.23 4.485 1.23 3.019 0 5.96-1.549 7.607-4.336 7.608-12.867 11.63-27.609 11.63-42.631 0-46.242-37.621-83.862-83.862-83.862s-83.862 37.62-83.862 83.862c0 14.965 3.992 29.657 11.546 42.488 2.472 4.2 7.881 5.604 12.085 3.129z"></path>
                                    </g>
                                    <path d="m338.132 92.69h66.965l-26.862 26.862c-3.447 3.447-3.447 9.036 0 12.484 1.724 1.724 3.983 2.586 6.242 2.586s4.518-.862 6.242-2.586l41.931-41.931c3.447-3.447 3.447-9.036 0-12.484l-41.931-41.931c-3.448-3.447-9.036-3.447-12.485 0-3.447 3.447-3.447 9.036 0 12.484l26.862 26.862h-66.965c-4.875 0-8.828 3.952-8.828 8.828.001 4.873 3.953 8.826 8.829 8.826z"></path>
                                  </g>
                                </svg>
                              </span>
                            </div>
                        </div>

                        <div class="flex items-center relative md:relative before:md:w-[calc(100%+60px)] before:md:absolute before:md:left-[-30px] before:md:top-0 before:md:h-full before:bg-primary-main reveal">
                            <?php $locationsInfo = $offices;
                            foreach ($locationsInfo as $key => $item): ?>

                                <div class="content w-full overflow-hidden absolute left-0 top-0 group flex md:grid md:grid-cols-2 xs:flex xs:flex-col items-center justify-center gap-[80px] 2xl:gap-[60px] xl:gap-[45px] md:gap-[30px] md:py-[40px] transition-all duration-700 opacity-0 [&.active]:relative [&.active]:opacity-100 [&.active]:translate-y-0 [&.active]:visible <?= $key == 0 ? 'active' : ''; ?>" id="<?= $key ?>">
                                    <div class="item flex items-center justify-center md:justify-end xsm:justify-start gap-[30px] xl:gap-[20px] whitespace-nowrap transition-all duration-700 opacity-0 group-[&.active]:opacity-100">
                                        <i class="icon-phone text-[29px] lg:text-[24px] md:text-[20px] leading-none text-white transition-all duration-300"></i>
                                        <a href="tel:<?= $item['phone'] ?>" class="text-[21px] lg:text-[18px] md:text-[16px] leading-normal font-light tracking-[-0.21px] text-white/85 transition-all duration-300 hover:text-white"><?= $item['phone'] ?></a>
                                    </div>
                                    <div class="item flex items-center justify-start md:justify-start gap-[30px] xl:gap-[20px] whitespace-nowrap transition-all duration-700 opacity-0 group-[&.active]:opacity-100">
                                        <i class="icon-at text-[29px] lg:text-[24px] md:text-[20px] leading-none text-white transition-all duration-300"></i>
                                        <a href="mailto:<?= $item['email'] ?>" class="text-[21px] lg:text-[18px] md:text-[16px] leading-normal font-light tracking-[-0.21px] text-white/85 transition-all duration-300 hover:text-white"><?= $item['email'] ?></a>
                                    </div>
                                    <div class="item flex items-center md:justify-center xsm:justify-start gap-[30px] xl:gap-[20px] min-md:max-w-[510px] md:col-span-2 md:text-center transition-all duration-700 opacity-0 group-[&.active]:opacity-100">
                                        <i class="icon-direct text-[29px] lg:text-[24px] md:text-[20px] leading-none text-white transition-all duration-300"></i>
                                        <a href="<?= $item['maps'] ?>" class="text-[21px] lg:text-[18px] md:text-[16px] leading-normal font-light tracking-[-0.21px] text-white/85 transition-all duration-300 hover:text-white line-clamp-3"><?= $item['address'] ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="contact my-[130px] xl:my-[100px] mb:my-[70px] sm:my-[50px]">
            <div class="container max-w-[1650px]">
    <div class="w-full grid grid-cols-[3fr_2fr] md:grid-cols-1 gap-[95px] 2xl:gap-[75px] xl:gap-[50px] md:gap-[30px]">
        <div class="left">
            <div class="image-wrapper reveal w-full h-full md:h-[320px]">
                <img src="../assets/image/general/slide-image.jpeg" alt="İletişim" width="1045" height="539" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="right">
            <div class="form w-full py-[30px] md:pt-0">
                <h4 class="reveal text-[46px] xl:text-[32px] lg:text-[24px] leading-[60px] xl:leading-[50px] lg:leading-[40px] md:leading-[36px] tracking-[-0.46px] font-bold text-secondary-main mb-[50px] lg:mb-0">
                    İletişim Formu
                </h4>
                <form action="#" method="post" id="contact-form" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-[30px] sm:gap-[25px] xs:gap-[12px]">
                        <div class="form-group reveal col-span-2">
                            <div class="w-full relative flex flex-col group/item"> <!-- error için bu div'e class="error" eklenecek -->
                                <input type="text" name="name" id="name" required minlength="2" class="order-2 w-full border-[0] !border-b border-solid border-b-paragraph/16  group-[&.error]/item:border-b-red-500 group-hover/item:border-b-secondary-main placeholder-paragraph/35 text-[18px] font-light text-primary-main pb-[16px] transition-all duration-300 peer [&_~_div]:focus:w-full [&_~_div]:focus:right-auto [&_~_div]:focus:left-0 [&_~_label]:focus:text-primary-main">
                                <label for="name" class="order-1 mb-[5px] block text-[16px] font-semibold text-paragraph/85 transition-all duration-300 translate-y-[40px] peer-focus:!translate-y-0 pointer-events-none">Adınız</label>
                                <div class="order-3 after absolute z-2 right-0 bottom-0 w-0 h-[1px] bg-primary-main transition-all duration-500"></div>
                                <div class="tooltip tooltip-error hidden group-[&.error]/item:block order-5 mt-[15px]">
                                    <span class="text-[15px] leading-none font-medium text-red-500">Hata Mesajı</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group reveal col-span-2">
                            <div class="w-full relative flex flex-col group/item"> <!-- error için bu div'e class="error" eklenecek -->
                                <input type="text" name="surname" id="surname" required minlength="2" class="order-2 w-full border-[0] !border-b border-solid border-b-paragraph/16 group-[&.error]/item:border-b-red-500 group-hover/item:border-b-secondary-main placeholder-paragraph/35 text-[18px] font-light text-primary-main pb-[16px] transition-all duration-300 peer [&_~_div]:focus:w-full [&_~_div]:focus:right-auto [&_~_div]:focus:left-0 [&_~_label]:focus:text-primary-main">
                                <label for="surname" class="order-1 mb-[5px] block text-[16px] font-semibold text-paragraph/85 transition-all duration-300 translate-y-[40px] peer-focus:!translate-y-0 pointer-events-none">Soyadınız</label>
                                <div class="order-3 after absolute z-2 right-0 bottom-0 w-0 h-[1px] bg-primary-main transition-all duration-500"></div>
                                <div class="tooltip tooltip-error hidden group-[&.error]/item:block order-5 mt-[15px]">
                                    <span class="text-[15px] leading-none font-medium text-red-500">Hata Mesajı</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group reveal col-span-2">
                            <div class="w-full relative flex flex-col group/item"> <!-- error için bu div'e class="error" eklenecek -->
                                <input type="email" name="email" id="email" required minlength="5" class="order-2 w-full border-[0] !border-b border-solid border-b-paragraph/16 group-[&.error]/item:border-b-red-500 group-hover/item:border-b-secondary-main placeholder-paragraph/35 text-[18px] font-light text-primary-main pb-[16px] transition-all duration-300 peer [&_~_div]:focus:w-full [&_~_div]:focus:right-auto [&_~_div]:focus:left-0 [&_~_label]:focus:text-primary-main">
                                <label for="email" class="order-1 mb-[5px] block text-[16px] font-semibold text-paragraph/85 transition-all duration-300 translate-y-[40px] peer-focus:!translate-y-0 pointer-events-none">E-Posta</label>
                                <div class="order-3 after absolute z-2 right-0 bottom-0 w-0 h-[1px] bg-primary-main transition-all duration-500"></div>
                                <div class="tooltip tooltip-error hidden group-[&.error]/item:block order-5 mt-[15px]">
                                    <span class="text-[15px] leading-none font-medium text-red-500">Hata Mesajı</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group reveal col-span-2">
                            <div class="w-full relative flex flex-col group/item"> <!-- error için bu div'e class="error" eklenecek -->
                                <input type="text" name="phone" id="phone" required minlength="5" class="order-2 w-full border-[0] !border-b border-solid border-b-paragraph/16 group-[&.error]/item:border-b-red-500 group-hover/item:border-b-secondary-main placeholder-paragraph/35 text-[18px] font-light text-primary-main pb-[16px] transition-all duration-300 peer [&_~_div]:focus:w-full [&_~_div]:focus:right-auto [&_~_div]:focus:left-0 [&_~_label]:focus:text-primary-main">
                                <label for="phone" class="order-1 mb-[5px] block text-[16px] font-semibold text-paragraph/85 transition-all duration-300 translate-y-[40px] peer-focus:!translate-y-0 pointer-events-none">Telefon</label>
                                <div class="order-3 after absolute z-2 right-0 bottom-0 w-0 h-[1px] bg-primary-main transition-all duration-500"></div>
                                <div class="tooltip tooltip-error hidden group-[&.error]/item:block order-5 mt-[15px]">
                                    <span class="text-[15px] leading-none font-medium text-red-500">Hata Mesajı</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group reveal col-span-2">
                            <div class="w-full relative flex flex-col group/item"> <!-- error için bu div'e class="error" eklenecek -->
                                <textarea name="message" id="message" required minlength="5" class="order-2 w-full border-[0] !border-b border-solid border-b-paragraph/16 group-[&.error]/item:border-b-red-500 group-hover/item:border-b-secondary-main placeholder-paragraph/35 text-[18px] font-light text-primary-main pb-[71px] transition-all duration-300 peer [&_~_div]:focus:w-full [&_~_div]:focus:right-auto [&_~_div]:focus:left-0 [&_~_label]:focus:text-primary-main"></textarea>
                                <label for="message" class="order-1 mb-[5px] block text-[16px] font-semibold text-paragraph/85 transition-all duration-300 translate-y-[40px] peer-focus:!translate-y-0 pointer-events-none">Mesaj</label>
                                <div class="order-3 after absolute z-2 right-0 bottom-0 w-0 h-[1px] bg-primary-main transition-all duration-500"></div>
                                <div class="tooltip tooltip-error hidden group-[&.error]/item:block order-5 mt-[15px]">
                                    <span class="text-[15px] leading-none font-medium text-red-500">Hata Mesajı</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-el reveal group/form relative flex items-center gap-[20px] xsm:col-span-2 sm:py-[15px]"> <!-- error için bu div'e class="error" eklenecek -->
                            <input type="checkbox" id="app-form-checkbox" class="peer cursor-pointer absolute left-0 top-0 w-full h-full opacity-0 z-10">
                            <div class="box relative shrink-0 w-[21px] aspect-square duration-300 before:absolute before:duration-450 peer-checked:before:!opacity-100 peer-checked:before:!scale-100 before:scale-0 before:opacity-0 before:left-[50%] before:top-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:w-[40%] before:h-[40%] before:bg-primary-main border border-solid border-paragraph/25 peer-hover:bg-primary-400/10 peer-hover:border-primary-400/50 peer-checked:!border-primary-main group-[&.error]/form:border-red-500"></div>
                            <label for="app-form-checkbox" class=" leading-normal duration-300 text-[15px] text-paragraph/85 font-light tracking-[-0.15px]">
                                <a href="#popup-gdpr" class="inline-block relative z-20 text-paragraph/85 font-bold duration-300 decoration underline" data-fancybox="">Aydınlatma Metni</a>'ni okudum ve kabul ediyorum.
                            </label>
                            <div class="tooltip tooltip-error hidden group-[&.error]/form:block absolute bottom-[-30px] left-0">
                                <span class="text-[15px] leading-none font-medium text-red-500">Hata Mesajı</span>
                            </div>
                        </div>

                        <div class="form-group flex justify-end sm:justify-start xsm:col-span-2">
                            <button type="submit" class="flex items-center justify-center relative w-max overflow-hidden main-button group sm:w-full">
                                <div class="left px-[30px] py-[20px] flex items-center justify-center z-2 bg-transparent border border-solid border-primary-main transition-all duration-300 sm:w-full relative before:absolute before:left-0 before:top-0 before:w-0 before:h-full before:translate-x-[-100px] group-hover:before:min-md:w-full group-hover:before:min-md:translate-x-0 before:bg-primary-main before:transition-all before:duration-500">
                                    <span class="text-[16px] leading-none font-medium text-primary-main transition-all duration-300 group-hover:min-md:duration-600 group-hover:min-md:text-white translate-x-[-100px] opacity-0 group-hover:min-md:translate-x-0 group-hover:min-md:opacity-100 w-0 whitespace-nowrap relative z-2">Gönder</span>
                                    <span class="text-[16px] leading-none font-medium text-primary-main transition-all duration-600 group-hover:min-md:duration-300 group-hover:min-md:text-white group-hover:min-md:translate-x-[100px] group-hover:min-md:opacity-0 relative z-2">Gönder</span>
                                </div>
                                <div class="right flex items-center justify-center z-2 bg-[#9D8D5D] py-[22px] px-[24px] border border-solid border-[#9D8D5D] w-[56px] h-[58px] overflow-hidden">
                                    <i class="icon-angle-right text-[12px] leading-none text-white transition-all duration-300 group-hover:min-md:duration-600 translate-x-[-100px] opacity-0 group-hover:min-md:translate-x-0 group-hover:min-md:opacity-100 w-0 whitespace-nowrap"></i>
                                    <i class="icon-angle-right text-[12px] leading-none text-white transition-all duration-600 group-hover:min-md:duration-300 group-hover:min-md:translate-x-[100px] group-hover:min-md:opacity-0"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        </section>
    </section>

</main>

<script>
    // Location List
    window.locations = [
        /* Buraya tab miktarı kadar lokasyon girebilirsiniz ve konum, zoom, url ve marker özelliklerini değiştirebilirsiniz. */
        <?php foreach ($offices as $key => $item): ?>
        {
            latLng: { lat: <?= $item['lat'] ?>, lng: <?= $item['long'] ?> },
            zoom: 15,
            marker: `<a href="<?= $item['map_url'] ?>" target="_blank" class="relative group flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="h-[45px] w-auto animate-bounce"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" fill="#B6A36B"/></svg>
                    </a>`
        },
        <?php endforeach; ?>
        
    ];

    // Generate Map Function
    function generateMap(i) {
        window.latLng = locations[i].latLng
        window.mapZoom = locations[i].zoom;

        window.mapMarker = document.createElement('div');
        mapMarker.className = 'map-marker block !pointer-events-auto relative z-30';
        mapMarker.innerHTML = locations[i].marker;
    }
    generateMap(0)

    // Map Change
    let mapButtons = document.querySelectorAll('.contact-page .location-tabs .tab');
    mapButtons.forEach(button => {
        button.addEventListener('click', () => {
            let i = button.getAttribute('data-id');
            if (i == null) return;
            generateMap(i)
            initMap()
        })
    })

    if (document.getElementsByTagName("main")[0].classList.contains("contact-page")) {
        document.querySelector("header").classList.add("contact");
        document.querySelector("body").classList.add("contact");
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgSzMvUYR_Yw8eLUT3YTbQ5yQnARsCq8I&callback=initMap&libraries=marker&v=beta" defer=""></script>
@endsection