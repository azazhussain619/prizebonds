<x-layouts.blog>
    <x-slot name="title">Prize Bond Draw Results, Search</x-slot>
    <x-slot name="meta">
        <meta charset="UTF-8">
        <meta name="description" content="Your ultimate Prize Bond destination! Check draw results, plan with draw schedule, and search past draws effortlessly. Your winning journey starts here">
        <meta name="keywords" content="Prize Bond Draw Results, Search">
        <meta name="author" content="Syed Azaz Hussain Shah">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </x-slot>
    <x-slot name="header">
        <div class="site-heading">
            <h1>Prize Bonds</h1>
            <span class="subheading">Latest Draw Results, News & Updates</span>
        </div>
    </x-slot>

    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12">
            @foreach($posts as $post)
                <!-- Post preview-->

                <div class="post-preview">
                    <a href="{{ url($post->slug) }}">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <h3 class="post-subtitle"></h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!">{{ $post->user->name }}</a>
                        on {{ $post->created_at }}
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4"/>
            @endforeach





            {{--            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!"></a></div>--}}

            <div class="text-center small float-end">
                {{ $posts->links() }}
            </div>

        </div>


    </div>

</x-layouts.blog>
