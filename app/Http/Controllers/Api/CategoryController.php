<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'q' => ['sometimes', 'string', 'max:255'],
                'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            ]);

            $perPage = $validated['per_page'] ?? 10;

            $query = Category::query();

            if (!empty($validated['q'])) {
                $keyword = $validated['q'];

                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%');
                });
            }

            $categories = $query->latest('id')->paginate($perPage)->appends($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Get a successful category list.',
                'count' => $categories->count(),
                'pagination' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'per_page' => $categories->perPage(),
                    'total' => $categories->total(),
                ],
                'data' => $categories->items(),
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while fetching category list: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('categories', 'slug')],
            ]);

            $category = Category::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully.',
                'data' => $category,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while creating category: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show(Category $category)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Get category successfully.',
            'data' => $category,
        ], 200);
    }

    public function update(Request $request, Category $category)
    {
        try {
            $validated = $request->validate([
                'name' => ['sometimes', 'required', 'string', 'max:255'],
                'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($category->id)],
            ]);

            $category->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully.',
                'data' => $category->fresh(),
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while updating category: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully.',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while deleting category: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
