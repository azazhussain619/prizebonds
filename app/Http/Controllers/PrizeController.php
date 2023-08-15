<?php

namespace App\Http\Controllers;

use App\DataTables\PrizesDataTable;
use App\Models\Denomination;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrizeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:create prizes')->only(['create','store']);
        $this->middleware('permission:edit prizes')->only(['edit','update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PrizesDataTable $dataTable)
    {
        return $dataTable->render('admin.prizes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $denominations = Denomination::all();
        $prizeCategories = Prize::getPrizeCategories();

        return view('admin.prizes.create',
            ['denominations' => $denominations,
                'prizeCategories' => $prizeCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Prize::create($this->validatePrize());

        return redirect('/admin/prizes')->with('success', 'Prize has been created.');
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
    public function edit(Prize $prize)
    {
        //
        $denominations = Denomination::all();
        $prizeCategories = Prize::getPrizeCategories();

        return view('admin.prizes.edit',
            ['prize' => $prize,
                'denominations' => $denominations,
                'prizeCategories' => $prizeCategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Prize $prize)
    {
        //
        $attributes = $this->validatePrize($prize);

        $prize->update($attributes);

        return redirect('/admin/prizes')->with('success', 'Prize Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function validatePrize(?Prize $prize = null): array
    {
        $prize ??= new Prize();

        return request()->validate([
            'denomination_id' => ['required'],
            'category' => ['required'],
            'prize' => ['required'],
        ]);
    }
}
