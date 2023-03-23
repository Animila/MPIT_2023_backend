<?php

namespace App\Http\Resources;


use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all();

        return response()->json($ratings);
    }

    public function store(Request $request)
    {
        $rating = Rating::create($request->all());

        return response()->json($rating, 201);
    }

    public function show($id)
    {
        $rating = Rating::find($id);
        if (!$rating) {
            return response()->json(['error' => 'Ошибка. Не найден элемент'], 404);
        }
        return response()->json($rating);
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['error' => 'Ошибка. Не найден элемент'], 404);
        }

        $rating->update($request->all());

        return response()->json($rating);
    }

    public function destroy($id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['error' => 'Ошибка. Не найден элемент'], 404);
        }

        $rating->delete();

        return response()->json(null, 204);
    }
}
