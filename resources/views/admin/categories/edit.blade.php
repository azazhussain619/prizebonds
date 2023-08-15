<x-layouts.app>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Categories</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    Edit category
                </div>


                <div class="card-body">

                    <form method="POST" action="{{ route('categories.update', $category->id) }}">
                        @method('put')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>


                            <div class="col-md-12">
                                <x-forms.input name="name" required :value="$category->name"/>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Slug') }}</label>

                            <div class="col-md-12">
                                    <x-forms.input name="slug" required :value="$category->slug"/>
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-12 text-md-end">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</x-layouts.app>
