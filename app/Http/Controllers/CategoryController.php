<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Response;

/**
 * Category Controller
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response([
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): Response
    {
        $data     = $request->validated();
        $category = Category::create([
            'name' => $data['name'],
        ]);

        return response([
            'product' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): Response
    {
        return response([
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): Response
    {
        $data = $request->validated();
        $category->update($data);

        return response([
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): Response
    {
        $category->delete();

        return response([
            'success' => true
        ]);
    }
}
