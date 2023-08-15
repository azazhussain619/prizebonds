<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Denomination;
use App\Models\DrawResult;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DrawController extends Controller
{
    //
    public function index()
    {
//        $posts = Post::where('status', 'Published')->orderBy('created_at', 'desc')->simplePaginate(10);

        $denominations = Denomination::all();

        return view('blog.draw-search',
            ['denominations' => $denominations]);
    }

    public function search()
    {

        $attributes = \request()->validate([
            'denomination_id' => 'required',
            'draw_id' => 'required',
        ]);


        if (request('from') && request('to')) {
            $attributes['serials'] = '';

            for ($i = request('from'); $i <= request('to'); $i++) {
                $attributes['serials'] .= $i . ($i < \request('to') ? ' ' : '');
            }
        }

        if (request('serials')) {
            $attributes['serials'] = \request('serials');
        }


        if (!array_key_exists('serials', $attributes))
            throw ValidationException::withMessages(['serials' => 'The serials field is required.']);

        $serialsToBeSearched = explode(' ', $attributes['serials']);
        $searchResults = [];

        foreach($serialsToBeSearched as $serial){
            $result = DrawResult::where('denomination_id', $attributes['denomination_id'])->where('serial', $serial)->with('denomination', 'draw', 'prize')->first();
            if($result)
                array_push($searchResults, $result);
        }

//        foreach($searchResults as $key => $result){
//            echo ++$key.' '.$result->denomination->name.' '.$result->serial.' '.$result->draw->date.' '.$result->draw->location.' '.$result->prize->category.' '.$result->prize->prize.'<br />';
//        }


        return redirect()->back()->with([
            'searchResults' => $searchResults
        ]);

//        return back();

    }
}
