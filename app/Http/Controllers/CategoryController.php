<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:view categories')->only(['index']);
        $this->middleware('permission:create categories')->only(['create','store']);
        $this->middleware('permission:edit categories')->only(['edit','update']);
    }

    public function index(CategoriesDataTable $dataTable)
    {

        return $dataTable->render('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',
            ['category' => $category]);
    }

    public function store()
    {

        Category::create($this->validateCategory());

        return redirect('/admin/categories')->with('success', 'Category has been created.');
    }

    public function update(Category $category)
    {

        $attributes = $this->validateCategory($category);

        $category->update($attributes);

        return redirect('/admin/categories')->with('success', 'Category has been updated.');

    }

    protected function validateCategory(?Category $category = null): array
    {
        $category ??= new Category();

        return request()->validate([
            'name' => ['required', 'max:255', Rule::unique('categories', 'name')->ignore($category)],
            'slug' => ['required', 'max:255', Rule::unique('categories', 'slug')->ignore($category)],
        ]);
    }
}
