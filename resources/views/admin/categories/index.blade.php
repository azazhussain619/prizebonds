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
            <div class="card">
                <div class="card-header">
                    Manage Categories
                    @can('create categories')
                        <a href="{{ url('admin/categories/create') }}" class="btn btn-sm btn-success float-right">Add
                            New</a>
                    @endcan
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <x-slot name="scripts">
        {{ $dataTable->scripts() }}
    </x-slot>


</x-layouts.app>
