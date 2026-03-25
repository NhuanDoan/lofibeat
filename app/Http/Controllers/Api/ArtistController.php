<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'q' => ['sometimes', 'string', 'max:255'],
                'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            ]);

            $perPage = $validated['per_page'] ?? 10;

            $query = Artist::query();

            if (!empty($validated['q'])) {
                $keyword = $validated['q'];
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('bio', 'like', '%' . $keyword . '%');
                });
            }

            $artists = $query->latest('id')->paginate($perPage)->appends($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Get artist list successfully.',
                'count' => $artists->count(),
                'pagination' => [
                    'current_page' => $artists->currentPage(),
                    'last_page' => $artists->lastPage(),
                    'per_page' => $artists->perPage(),
                    'total' => $artists->total(),
                ],
                'data' => $artists->items(),
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
                'message' => 'Error while fetching artist list: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('artists', 'slug')],
                'bio' => ['required', 'string'],
                'image_url' => ['required', 'string', 'max:255'],
            ]);

            $artist = Artist::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Artist created successfully.',
                'data' => $artist,
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
                'message' => 'Error while creating artist: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show(Artist $artist)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Get artist successfully.',
            'data' => $artist,
        ], 200);
    }

    public function update(Request $request, Artist $artist)
    {
        try {
            $validated = $request->validate([
                'name' => ['sometimes', 'required', 'string', 'max:255'],
                'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('artists', 'slug')->ignore($artist->id)],
                'bio' => ['sometimes', 'required', 'string'],
                'image_url' => ['sometimes', 'required', 'string', 'max:255'],
            ]);

            $artist->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Artist updated successfully.',
                'data' => $artist->fresh(),
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
                'message' => 'Error while updating artist: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy(Artist $artist)
    {
        try {
            $artist->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Artist deleted successfully.',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while deleting artist: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
