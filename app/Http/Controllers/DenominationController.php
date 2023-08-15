<?php

namespace App\Http\Controllers;

use App\DataTables\DenominationsDataTable;
use App\Models\Denomination;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DenominationController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create denominations')->only(['create','store']);
        $this->middleware('permission:edit denominations')->only(['edit','update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DenominationsDataTable $dataTable)
    {
        return $dataTable->render('admin.denominations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.denominations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Denomination::create($this->validateDenomination());

        return redirect('/admin/denominations')->with('success', 'Denomination has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Denomination $denomination)
    {
        //
        return view('admin.denominations.edit',
            ['denomination' => $denomination]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Denomination $denomination)
    {
        //
        $attributes = $this->validateDenomination($denomination);

        $denomination->update($attributes);

        return redirect('/admin/denominations')->with('success', 'Denomination Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function validateDenomination(?Denomination $denomination = null): array
    {
        $denomination ??= new Denomination();

        return request()->validate([
            'name' => ['required', 'max:255', Rule::unique('denominations', 'name')->ignore($denomination)],
            'price' => ['required'],
            'type' => [],
        ]);
    }
}
