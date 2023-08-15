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
            <div class="card card-success">
                <div class="card-header">
                    Create Category
                </div>


                <div class="card-body">

                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="name" required/>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Slug') }}</label>

                            <div class="col-md-12">
                                    <x-forms.input name="slug" required />
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
    </section>
    <!-- /.content -->

</x-layouts.app>
