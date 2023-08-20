<x-layouts.blog>
    <x-slot name="title">Draw Search</x-slot>
    <x-slot name="meta">
        <meta name="description" content="Prize Bond Draw Search! Instantly find results and check if you've won any prize. Try now!">
        <meta name="keywords" content="Prize Bond Draw Search">
        <meta name="author" content="Syed Azaz Hussain Shah">
    </x-slot>
    <x-slot name="header">
        <div class="post-heading">
            <h1>Draw Search</h1>
            {{--            <span class="subheading">Latest Draw Results, News & Updates</span>--}}
        </div>
    </x-slot>

    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12">

            @if(session()->has('searchResults') && count(session('searchResults')) != 0)

                <div class="alert alert-success">
                    <strong>Congrats!</strong> You have won ({{ count(session('searchResults')) }}) prizes.
                </div>


                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th>S. No</th>
                        <th>Prize Bond</th>
                        <th>Serial</th>
                        <th>Draw Date</th>
                        <th>Draw Location</th>
                        <th>Prize</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach(session('searchResults') as $result)
                        <tr>
                            <td>{{ ++ $loop->index }}</td>
                            <td>{{ $result->denomination->name }}</td>
                            <td>{{ $result->serial }}</td>
                            <td>{{ $result->draw->date }}</td>
                            <td>{{ $result->draw->location }}</td>
                            <td>{{ $result->prize->category }}</td>
                            <td>{{ $result->prize->prize }}</td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>

            @elseif(session()->has('searchResults') && count(session('searchResults')) == 0)

                <div class="alert alert-danger">
                    <strong>Oops!</strong> You have not won any prizes. Better luck next time.
                </div>

            @endif

            <div class="card bg-light text-dark mb-5">

                <div class="card-header"><h2>Draw Search</h2></div>
                <div class="card-body">

                    <form method="POST" action="{{ route('draws.search') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name"
                                       class="col-md-12 col-form-label text-md-start">{{ __('Denomination') }}</label>


                                <div class="col-md-12">
                                    <select class="form-select @error('denomination_id') is-invalid @enderror"
                                            id="denomination_id" name="denomination_id">
                                        <option value="">Select denomination</option>
                                        @foreach($denominations as $denomination)
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

                            <div class="col-md-6 mb-3">
                                <label for="price"
                                       class="col-md-12 col-form-label text-md-start">{{ __('Draw') }}</label>

                                <div class="col-md-12">
                                    <select class="form-select @error('draw_id') is-invalid @enderror" id="draw_id"
                                            name="draw_id">
                                        <option value="">Select denomination first</option>
                                    </select>

                                    @error('draw_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row"><h4>Range Search</h4>
                            <span class="small text-secondary">Search for all numbers in range <br/>EXAMPLE: From: 122000 To: 122099</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from"
                                       class="col-md-12 col-form-label text-md-start">{{ __('From') }}</label>


                                <div class="col-md-12">
                                    <x-forms.input name="from" type="number"/>

                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="to"
                                       class="col-md-12 col-form-label text-md-start">{{ __('To') }}</label>


                                <div class="col-md-12">
                                    <x-forms.input name="to" type="number"/>

                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row"><h4>Miscel. Numbers</h4>
                            <span class="small text-secondary">Search for list of numbers<br/>
                                EXAMPLE: 123455 556879 445632 122354</span>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="serials"
                                       class="col-md-12 col-form-label text-md-start">{{ __('Serials') }}</label>


                                <div class="col-md-12">
                                    <x-forms.input name="serials" type="text"/>

                                </div>
                            </div>

                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12 text-md-end">
                                <button type="submit" class="btn btn-success btn-sm">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>


    <x-slot name="scripts">
        <script type="module">
            // Optionally the request above could also be done as

            $(document).ready(function(){
               $('#from').blur();
            });

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

</x-layouts.blog>
