<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SongController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'q' => ['sometimes', 'string', 'max:255'],
                'artist_id' => ['sometimes', 'integer', 'exists:artists,id'],
                'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
                'is_active' => ['sometimes', 'boolean'],
                'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            ]);

            $perPage = $validated['per_page'] ?? 10;

            $query = Song::with(['category', 'artist']);

            if (array_key_exists('is_active', $validated)) {
                $query->where('is_active', $validated['is_active']);
            } else {
                $query->where('is_active', true);
            }

            if (!empty($validated['artist_id'])) {
                $query->where('artist_id', $validated['artist_id']);
            }

            if (!empty($validated['category_id'])) {
                $query->where('category_id', $validated['category_id']);
            }

            if (!empty($validated['q'])) {
                $keyword = $validated['q'];

                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%');
                });
            }

            $songs = $query->latest('id')->paginate($perPage)->appends($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Get song list successfully.',
                'count' => $songs->count(),
                'pagination' => [
                    'current_page' => $songs->currentPage(),
                    'last_page' => $songs->lastPage(),
                    'per_page' => $songs->perPage(),
                    'total' => $songs->total(),
                ],
                'data' => $songs->items(),
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
                'message' => 'Error while fetching song list: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('songs', 'slug')],
                'artist_id' => ['required', 'integer', 'exists:artists,id'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                'file_url' => ['required', 'string', 'max:255'],
                'cover_image' => ['required', 'string', 'max:255'],
                'duration_seconds' => ['required', 'integer', 'min:1'],
                'is_active' => ['sometimes', 'boolean'],
                'view_count' => ['sometimes', 'integer', 'min:0'],
            ]);

            $song = Song::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Song created successfully.',
                'data' => $song->load(['category', 'artist']),
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
                'message' => 'Error while creating song: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show(Song $song)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Get song successfully.',
            'data' => $song->load(['category', 'artist']),
        ], 200);
    }

    public function update(Request $request, Song $song)
    {
        try {
            $validated = $request->validate([
                'title' => ['sometimes', 'required', 'string', 'max:255'],
                'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('songs', 'slug')->ignore($song->id)],
                'artist_id' => ['sometimes', 'required', 'integer', 'exists:artists,id'],
                'category_id' => ['sometimes', 'required', 'integer', 'exists:categories,id'],
                'file_url' => ['sometimes', 'required', 'string', 'max:255'],
                'cover_image' => ['sometimes', 'required', 'string', 'max:255'],
                'duration_seconds' => ['sometimes', 'required', 'integer', 'min:1'],
                'is_active' => ['sometimes', 'boolean'],
                'view_count' => ['sometimes', 'integer', 'min:0'],
            ]);

            $song->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Song updated successfully.',
                'data' => $song->fresh()->load(['category', 'artist']),
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
                'message' => 'Error while updating song: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy(Song $song)
    {
        try {
            $song->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Song deleted successfully.',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while deleting song: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
