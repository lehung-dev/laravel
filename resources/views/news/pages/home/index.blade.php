@extends('news.main')

@section('content')
    @include('news.block.slider')
    <!-- Content Container -->
    <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <!-- Featured -->
                        @include('news.block.featured', ['itemFeatured' => ''])
                        <!-- Category -->
                        @include('news.pages.home.child_index.category', ['itemCategory' => ''])
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- Latest Posts -->
                        @include('news.block.latest_post', ['itemlatestPost' => ''])
                        <!-- Advertisement -->
                        @include('news.block.advertisement', ['itemAdvertisement' => ''])
                        <!-- Most Viewed -->
                        @include('news.block.most_viewed', ['itemMostViewed' => ''])
                        <!-- Tags -->
                        @include('news.block.tags', ['itemTags' => ''])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection