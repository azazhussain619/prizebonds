<x-layouts.app>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Prizes</h1>
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
                    Create Prize
                </div>


                <div class="card-body">

                    <form method="POST" action="{{ route('prizes.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Denomination') }}</label>


                            <div class="col-md-12">
                                <select class="form-select @error('denomination_id') is-invalid @enderror" name="denomination_id" required>
                                    @foreach($denominations as $denomination)
                                        <option value="{{ $denomination->id }}">{{ $denomination->name }}</option>
                                    @endforeach
                                </select>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Category') }}</label>

                            <div class="col-md-12">

                                <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                                    @foreach($prizeCategories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>


                        </div>

                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Prize') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="prize" required/>
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
