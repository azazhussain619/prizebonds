<x-layouts.app>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Denominations</h1>
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
                    Edit Denomination
                </div>


                <div class="card-body">

                    <form method="POST" action="{{ route('denominations.update', $denomination->id) }}">
                        @method('put')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>


                            <div class="col-md-12">
                                <x-forms.input name="name" required :value="$denomination->name"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Price') }}</label>

                            <div class="col-md-12">
                                    <x-forms.input name="price" required :value="$denomination->price"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Type') }}</label>

                            <div class="col-md-12">
                                    <x-forms.input name="type" :value="$denomination->type"/>
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
