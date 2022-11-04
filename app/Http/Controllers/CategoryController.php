<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function overview()
    {
        return view(
            'category.list',
            [
                'categories' => Auth::user()->categories,
            ]
        );
    }

    public function create()
    {
        return view('category.form');
    }

    public function view(int $category_id)
    {
        $category = Auth::user()
            ->categories
            ->where('id', $category_id)
            ->firstOrFail();

        return view(
            'category.form',
            compact('category')
        );
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create(
            array_merge(
                ['user_id' => Auth::id()],
                $validated
            )
        );

        return redirect(route('category.list'))->with('status', 'Category Saved');
    }

    public function update(int $category_id, CategoryRequest $request)
    {
        $validated = $request->validated();

        Category::updateOrCreate(
            [
                'id' => $category_id,
                'user_id' => Auth::id(),
            ],
            $validated
        );

        return redirect(route('category.list'))->with('status', 'Category Saved');
    }
}
