<?php

namespace App\Http\Controllers;

use App\DataTables\DrawsDataTable;
use App\Models\Denomination;
use App\Models\Draw;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DrawController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('permission:create draws')->only(['create','store']);
        $this->middleware('permission:edit draws')->only(['edit','update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DrawsDataTable $dataTable)
    {
        return $dataTable->render('admin.draws.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $denominations = DB::table('denominations')->orderBy('id', 'desc')->get();

        return view('admin.draws.create',
            ['denominations' => $denominations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $attributes = $this->validateDraw();

        if ($attributes['file'] ?? false) {
            request()->file('file')->store('public/draws');
            $attributes['file'] = request()->file('file')->hashName();
        }

        Draw::create($attributes);

//        return redirect('/admin/draws')->with('success', 'Draw has been created.');
        return back()->with('success', 'Draw has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function getDrawsByDenomination()
    {
        //

        return response()->json([
            'draws' => \App\Models\Draw::where('denomination_id', '=', request('denomination_id'))->get()
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draw $draw)
    {
        //
        $denominations = Denomination::all();

        return view('admin.draws.edit',
            ['draw' => $draw,
                'denominations' => $denominations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Draw $draw)
    {
        //


        $attributes = $this->validateDraw($draw);

        if ($attributes['file'] ?? false) {
            request()->file('file')->store('public/draws');
            $attributes['file'] = request()->file('file')->hashName();
        }

        $draw->update($attributes);

        return redirect('/admin/draws')->with('success', 'Draw Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function validateDraw(?Draw $draw = null): array
    {
        $draw ??= new Draw();

        return request()->validate([
            'denomination_id' => ['required'],
            'date' => ['required'],
            'location' => ['required'],
            'file' => $draw->exists ? [] : ['required'],
        ]);
    }
}
