<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Denomination;
use App\Models\Draw;
use App\Models\DrawResult;
use App\Models\Post;
use App\Models\Prize;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:view posts')->only(['index']);
        $this->middleware('permission:create posts')->only(['create','store']);
        $this->middleware('permission:edit posts')->only(['edit','update']);
    }

    public function createDrawPosts()
    {

        set_time_limit(0);

        foreach (Denomination::all() as $denomination) {

            $draws = Draw::where('denomination_id', '=', $denomination->id)->get();


//            if ($denomination->id)
//                continue;

            foreach ($draws as $draw) {

                list($firstPrize, $secondPrize, $firstPrizeSerials, $secondPrizeSerials, $postContent) = $this->generatePostContent($draw, $denomination);

                $post = new Post();
                $post->title = 'Rs.' . $denomination->price . '/-'.($denomination->type ? ' '.$denomination->type : '').' Prize Bond List Draw Results dated ' . $draw->date . ' ' . $draw->location;
                $post->slug = '' . $denomination->price . ($denomination->type ? '-'.strtolower($denomination->type) : '').'-prize-bond-list-draw-results-dated-' . strtolower($draw->date);
                $post->content = nl2br($postContent);

                $post->category_id = $denomination->id;
                $post->user_id = request()->user()->id;
                $post->status = 'Published';
                $post->type = 'Draw';
                $post->excerpt = $post->title.'. 1st prize of Rs.'.$firstPrize.'/-: '.implode(' ',$firstPrizeSerials->pluck('serial')->toArray()).', 2nd ('.count($secondPrizeSerials).') prizes of Rs.'.$secondPrize.'/-: '.implode(' ',$secondPrizeSerials->pluck('serial')->toArray());
                $post->created_at = $draw->date;

                $post->save();

                echo 'Creating post: ' . $post->title . '<br>';

            }
        }


    }

    public function createDrawPost(){

        return view('admin.posts.createDraw');
    }

    public function storeDrawPost(){

        $attributes = request()->validate([
            'denomination_id' => 'required',
            'draw_id' => 'required'
        ]);

        $denomination = Denomination::where('id', $attributes['denomination_id'])->first();
        $draw = Draw::where('id', $attributes['draw_id'])->first();

        list($firstPrize, $secondPrize, $firstPrizeSerials, $secondPrizeSerials, $postContent) = $this->generatePostContent($draw, $denomination);

        $post = new Post();
        $post->title = 'Rs.' . $denomination->price . '/-'.($denomination->type ? ' '.$denomination->type : '').' Prize Bond List Draw Results dated ' . $draw->date . ' ' . $draw->location;
        $post->slug = '' . $denomination->price . ($denomination->type ? '-'.strtolower($denomination->type) : '').'-prize-bond-list-draw-results-dated-' . strtolower($draw->date);
        $post->content = nl2br($postContent);

        $post->category_id = $denomination->id;
        $post->user_id = request()->user()->id;
        $post->status = 'Published';
        $post->type = 'Draw';
        $post->excerpt = $post->title.'. 1st prize of Rs.'.$firstPrize.'/-: '.implode(' ',$firstPrizeSerials->pluck('serial')->toArray()).', 2nd ('.count($secondPrizeSerials).') prizes of Rs.'.$secondPrize.'/-: '.implode(' ',$secondPrizeSerials->pluck('serial')->toArray());
        $post->created_at = $draw->date;


        if(Post::where('slug', $post->slug)->first() != null){
            throw ValidationException::withMessages(['draw_id' => 'Draw post already exists.']);
        }

        $post->save();

        return redirect()->back()->with('success', 'Draw post has been created.');
    }

    public function index(PostsDataTable $dataTable)
    {

        return $dataTable->render('admin.posts.index');
    }

    public function create()
    {
        return view('admin.posts.create',
            ['categories' => Category::all()]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit',
            ['categories' => Category::all(),
                'post' => $post]);
    }

    public function store()
    {

//        dd(request()->all());

        $attributes = array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'type' => 'post',
            'status' => 'published',
        ]);

        if ($attributes['featured_image'] ?? false) {
            request()->file('featured_image')->store('public/featured-images');
            $attributes['featured_image'] = request()->file('featured_image')->hashName();
        }

        Post::create($attributes);

        return redirect('/admin/posts')->with('success', 'Post has been created.');
    }

    public function update(Post $post)
    {

        $attributes = $this->validatePost($post);

        if ($attributes['featured_image'] ?? false) {
            request()->file('featured_image')->store('public/featured-images');
            $attributes['featured_image'] = request()->file('featured_image')->hashName();
        }

        $post->update($attributes);

        return redirect('/admin/posts')->with('success', 'Post has been updated.');

    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([

            'category_id' => 'required|max:255',
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required|max:255',
            'content' => 'required',
            'featured_image' => ''

        ]);
    }

    /**
     * @param mixed $draw
     * @param mixed $denomination
     * @return array
     */
    public function generatePostContent(mixed $draw, mixed $denomination): array
    {
        $drawResult = DrawResult::where('draw_id', $draw->id)->get();

        $firstPrize = Prize::where('category', '1st Prize')->where('denomination_id', $denomination->id)->first()->prize;
        $secondPrize = Prize::where('category', '2nd Prize')->where('denomination_id', $denomination->id)->first()->prize;
        $thirdPrize = Prize::where('category', '3rd Prize')->where('denomination_id', $denomination->id)->first()->prize;

        $firstPrizeSerials = $drawResult->where('prize_id', Prize::where('denomination_id', $denomination->id)->where('category', '1st Prize')->first()->id);
        $secondPrizeSerials = $drawResult->where('prize_id', Prize::where('denomination_id', $denomination->id)->where('category', '2nd Prize')->first()->id);
        $thirdPrizeSerials = $drawResult->where('prize_id', Prize::where('denomination_id', $denomination->id)->where('category', '3rd Prize')->first()->id)->pluck('serial')->sort();


        $postContent =
            '<table class="table table-responsive text-center border-1 text-wrap"><thead><th>Draw of </th><th>Held at</th><th>Date</th></thead>
                    <tbody><tr><td>Rs.' . $denomination->name . '/- Prize Bond</td><td>' . $draw->location . '</td><td>' . $draw->date . '</td></tr></tbody></table>';

        $postContent .= '<table  class="table table-responsive text-center border-1"><thead><th colspan="' . count($firstPrizeSerials) . '">1st Prize of Rs.' . $firstPrize . '/- (' . count($firstPrizeSerials) . ')</th></thead><tbody><tr>';

        foreach ($firstPrizeSerials as $result) {
            $postContent .= '<td>' . $result->serial . '</td>';
        }

        $postContent .= '</tr></tbody></table>';

        $postContent .= '<table class="table table-responsive text-center border-1"><thead><th colspan="' . count($secondPrizeSerials) . '">2nd Prizes of Rs.' . $secondPrize . '/- Each (' . count($secondPrizeSerials) . ')</th></thead><tbody><tr>';

        foreach ($secondPrizeSerials as $result) {
            $postContent .= '<td>' . $result->serial . '</td>';
        }

        $postContent .= '</tr></tbody></table>';

        $postContent .= '<table class="table table-responsive text-center border-1"><thead><th colspan="6">3rd Prizes of Rs.' . $thirdPrize . '/- Each (' . count($thirdPrizeSerials) . ')</th></thead><tbody><tr>';

        $loopIndex = 0;

        foreach ($thirdPrizeSerials as $result) {
            if ($loopIndex % 5 == 0)
                $postContent .= '</tr><tr>';
            $postContent .= '<td>' . $result . '</td>';

            $loopIndex++;
        }

        $postContent .= '</tr></tbody></table>';
        return array($firstPrize, $secondPrize, $firstPrizeSerials, $secondPrizeSerials, $postContent);
    }
}
