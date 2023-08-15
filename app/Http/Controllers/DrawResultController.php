<?php

namespace App\Http\Controllers;

use App\DataTables\DrawResultsDataTable;
use App\Models\Denomination;
use App\Models\Draw;
use App\Models\DrawResult;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DrawResultController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:create draw-results')->only(['create','store']);
        $this->middleware('permission:edit draw-results')->only(['edit','update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DrawResultsDataTable $dataTable)
    {
        return $dataTable->render('admin.draw-results.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $denominations = Denomination::all();

        return view('admin.draw-results.create',
            ['denominations' => $denominations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        set_time_limit(0);

        $attributes = $this->validateDrawResult();

        $draws = ($attributes['draw_id'] == 'all') ?
            Draw::where('denomination_id', '=', $attributes['denomination_id'])->whereNotIn('id', DrawResult::select('draw_id')->where('denomination_id', '=', $attributes['denomination_id'])->groupBy('draw_id')->get()->pluck('draw_id'))->get() :
            Draw::where('id', '=', $attributes['draw_id'])->get();

        foreach ($draws as $draw) {


            $numbers = $this->extractSerialsFromTxt($draw->file);

            // Fetch the prize IDs for all categories before the loop
            $prizeIds = [
                'First Prize' => Prize::where('denomination_id', '=', $attributes['denomination_id'])->where('category', '=', '1st Prize')->first()->id,
                'Second Prize' => Prize::where('denomination_id', '=', $attributes['denomination_id'])->where('category', '=', '2nd Prize')->first()->id,
                'Third Prize' => Prize::where('denomination_id', '=', $attributes['denomination_id'])->where('category', '=', '3rd Prize')->first()->id,
            ];

            foreach ($numbers as $key => $value) {
                $prizeCategory = ($key < $attributes['no_of_first_prizes']) ? 'First Prize' : (($key < ($attributes['no_of_second_prizes']+$attributes['no_of_first_prizes'])) ? 'Second Prize' : 'Third Prize');

                DrawResult::create([
                    'denomination_id' => $attributes['denomination_id'],
                    'draw_id' => $attributes['draw_id'] == 'all' ? $draw->id : $attributes['draw_id'],
                    'prize_id' => $prizeIds[$prizeCategory],
                    'serial' => $value,
                ]);
            }

        }


        return redirect('/admin/draw-results')->with('success', 'DrawResult has been created.');
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
    public function edit(DrawResult $drawResult)
    {
        //
        $denominations = Denomination::all();

        return view('admin.draw-results.edit',
            ['drawResult' => $drawResult,
                'denominations' => $denominations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DrawResult $drawResult)
    {
        //
        $attributes = $this->validateDrawResult($drawResult);

        $drawResult->update($attributes);

        return redirect('/admin/draw-results')->with('success', 'DrawResult Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function validateDrawResult(?DrawResult $drawResult = null): array
    {
        $drawResult ??= new DrawResult();

        return request()->validate([
            'denomination_id' => ['required'],
            'draw_id' => request('draw_id') == 'all' ? [] : ['required', Rule::unique('draw_results')],
            'no_of_first_prizes' => ['required'],
            'no_of_second_prizes' => ['required'],
        ]);
    }

    public function extractSerialsFromTxt(string $path): array
    {

        // Read the contents of the text file
        $fileContents = file_get_contents('storage/draws/' . $path);

        // Extract all 6-digit numbers
        $pattern = '/\b\d{6}\b/';
        preg_match_all($pattern, $fileContents, $matches);

        return $matches[0];
    }
}
