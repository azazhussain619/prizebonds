<x-layouts.blog>
    <x-slot name="title">{{ $post->title }}</x-slot>
    <x-slot name="meta">
        <meta name="title" content="{{ $post->title }}">
        <meta name="description" content="{{ $post->excerpt }}">
{{--        <meta name="keywords" content="{{ $post->title }}">--}}
        <meta name="author" content="Syed Azaz Hussain Shah">
    </x-slot>
    <x-slot name="header">
        <div class="post-heading">
            <h1>{{ $post->title }}</h1>
            <h2 class="subheading"></h2>
            <span class="meta">
                                Posted by
                                <a href="#!">{{ $post->user->name }}</a>
                                on {{ $post->created_at }}
                            </span>
        </div>
    </x-slot>

    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12">

            <div id="content" class="small">
                <?php echo $post->content ?>
            </div>

            <div class="row small mb-4 text-center">
                <span class="">Didn't found your serial? Search in previous draws! <a href="{{ url('draw-search') }}">Prize Bonds Draw Search</a></span>
            </div>


        </div>
    </div>

</x-layouts.blog>
