@extends('layouts.main')

@section('content')
   <?php $pageTitle = $page->title; 
        $breadcrumbImage = "corporate-breadcrumb.jpg";
        $breadcrumbVideo = "breadcrumb-video.mp4";
        $pageLink = "page-corporate.php";
        $imageOrVideo = "image";
    ?> 

<main class="main-field header-space">
    <section class="content pt-[50px]">
        <div class="container max-w-[1650px] mb-[50px]">
            <div class="career-content bg-white px-[150px] 2xl:px-[120px] xl:px-[75px] lg:px-[45px] md:px-[30px] py-[80px] 2xl:py-[60px] xl:py-[45px] md:py-[30px]">
                <div class="text-editor">
                    <h1><?=$page->title?></h1>
                    <p><?=$page->description?></p>
                </div>
            </div>
        </div>
        
    </section>
</main>


@endsection