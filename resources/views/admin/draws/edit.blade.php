<x-layouts.app>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Draws</h1>
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
                    Edit Draw
                </div>


                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('draws.update', $draw->id) }}">
                        @method('put')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Denomination') }}</label>


                            <div class="col-md-12">
                                <select class="form-select" name="denomination_id" required>
                                    @foreach($denominations as $denomination)
                                        <option value="{{ $denomination->id }}" {{ ($denomination->id == $draw->denomination_id) ? 'selected' : '' }}>{{ $denomination->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Date') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="date" type="date" required :value="$draw->date"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Location') }}</label>

                            <div class="col-md-12">
                                    <x-forms.input name="location" required :value="$draw->location"/>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('File') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="file" type="file"/>
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
