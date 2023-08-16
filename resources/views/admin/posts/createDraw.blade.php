<x-layouts.app>
    <!-- Content Header (Page header) -->


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
                    Create Draw Post
                </div>


                <div class="card-body">

                    <form method="POST" action="{{ route('posts.draw.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Denomination') }}</label>


                            <div class="col-md-12">
                                <select class="form-select @error('denomination_id') is-invalid @enderror" id="denomination_id" name="denomination_id" required>
                                    <option value="">Select denomination</option>
                                    @foreach(\App\Models\Denomination::all() as $denomination)
                                        <option value="{{ $denomination->id }}">{{ $denomination->name }}</option>
                                    @endforeach
                                </select>

                                @error('denomination_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Draw') }}</label>

                            <div class="col-md-12">
                                <select class="form-select @error('draw_id') is-invalid @enderror" id="draw_id" name="draw_id" required>
                                    <option value="">Select denomination first</option>
                                </select>

                                @error('draw_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
        <script type="module">
            // Optionally the request above could also be done as

            $("#denomination_id").bind("change", function () {
                console.log(this.value);
                let select = document.getElementById("draw_id");


                axios.get('/admin/draws-by-denomination', {
                    params: {
                        denomination_id: this.value
                    }
                })
                    .then(function (response) {
                        let draws = response.data.draws;
                        console.log(draws);
                        select.innerHTML = "";

                        if (draws.length == 0) {

                            let el = document.createElement("option");

                            el.textContent = "Select denomination first";
                            el.value = "";

                            select.appendChild(el);
                        } else {

                            let el = document.createElement("option");

                            el.textContent = 'All Draws';
                            el.value = 'all';

                            select.appendChild(el);

                            draws.forEach(function (currentElement) {
                                let el = document.createElement("option");

                                el.textContent = currentElement.date;
                                el.value = currentElement.id;

                                select.appendChild(el);
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .finally(function () {
                        // always executed
                    });

            });

        </script>

    </x-slot>

</x-layouts.app>
