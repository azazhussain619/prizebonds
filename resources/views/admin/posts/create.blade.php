<x-layouts.app>
    <!-- Content Header (Page header) -->

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('vendor/summernote-0.8.18/summernote-lite.min.css') }}"/>

    </x-slot>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Posts</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    Create Post
                </div>


                <div class="card-body">

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Title') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="title" required/>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col md-6 pl-0">
                                <label for="type"
                                       class="col-md-12 col-form-label text-md-start">{{ __('Slug') }}</label>

                                <div class="col-md-12">
                                    <x-forms.input name="slug" required/>
                                </div>
                            </div>


                            <div class="col md-6 pr-0">
                                <label for="name"
                                       class="col-md-12 col-form-label text-md-start">{{ __('Category') }}</label>


                                <div class="col-md-12">
                                    <select class="form-select" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Content') }}</label>

                            <div class="col-md-12">
                                    <textarea id="summernote" name="content"
                                              class="form-control @error( 'content' ) is-invalid @enderror" required></textarea>
                                <x-forms.error-message name="content" />

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="excerpt"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Excerpt') }}</label>

                            <div class="col-md-12">
                                <x-forms.textarea name="excerpt" required></x-forms.textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="featured_image"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Featured Image') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="featured_image" id="featured_image" type="file"/>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12 text-md-end">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div><!-- /.container-fluid -->
        </div>
    </section>
    <!-- /.content -->

    <x-slot name="scripts">

        <script type="module" src="{{ asset('vendor/summernote-0.8.18/summernote-lite.min.js') }}"></script>
        <script type="module">
            $(document).ready(function () {
                $('#summernote').summernote({
                    placeholder: 'The content goes here',
                    tabsize: 2,
                    height: 200
                });
            });
        </script>
    </x-slot>

</x-layouts.app>
