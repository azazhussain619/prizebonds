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
            <div class="card card-success">
                <div class="card-header">
                    Create Draw
                </div>


                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('draws.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Denomination') }}</label>


                            <div class="col-md-12">
                                <select class="form-select" name="denomination_id" required>
                                    @foreach($denominations as $denomination)
                                        <option value="{{ $denomination->id }}">{{ $denomination->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Date') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="date" id="date" type="date" required/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type"
                                   class="col-md-12 col-form-label text-md-start">{{ __('Location') }}</label>

                            <div class="col-md-12">
                                <x-forms.input id="location" name="location" required/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file"
                                   class="col-md-12 col-form-label text-md-start">{{ __('File') }}</label>

                            <div class="col-md-12">
                                <x-forms.input name="file" id="file" type="file" required/>
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

            function formatDate(inputDate) {
                // Split the input date string into day, month, and year parts
                const parts = inputDate.split('/');

                // Assuming the date format is dd/MM/yy
                const day = parts[0];
                const month = parts[1];
                const year = parts[2];

                // Convert the year to 4-digit format
                const fourDigitYear = (parseInt(year, 10) < 100 ? "20" : "") + year;

                // Format the date as yyyy-MM-dd
                const formattedDate = `${fourDigitYear}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;

                return formattedDate;
            }

            $("#file").bind("change", function () {
                let fr = new FileReader();

                let fileContent = '';

                fr.onload=function(){
                    fileContent = fr.result;
                    // console.log(fileContent);

                    // Define regular expressions to match the required patterns
                    // const locationRegex = /HELD AT (.+)/i;
                    const locationRegex = /HELD AT[\/]?[\-]?\s*(.+)/i;
                    const dateRegex = /Date\s*:\s*([0-9/]+)/;

                    // Find the match for "KARACHI" using the locationRegex
                    const locationMatch = fileContent.match(locationRegex);

                    // Find the match for the date "15/02/13" using the dateRegex
                    const dateMatch = fileContent.match(dateRegex);

                    // Check if matches were found and extract the values
                    if (locationMatch && locationMatch[1]) {
                        const location = locationMatch[1];
                        console.log('Location:', location);
                        $('#location').val(location);
                    } else {
                        console.log('Location not found.');
                    }

                    if (dateMatch && dateMatch[1]) {
                        const date = dateMatch[1];
                        console.log('Date:', date);
                        $('#date').val(formatDate(date));
                    } else {
                        console.log('Date not found.');
                    }

                }

                fr.readAsText(this.files[0]);





            });

        </script>
    </x-slot>

</x-layouts.app>
