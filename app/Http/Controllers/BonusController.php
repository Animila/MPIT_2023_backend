<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{

    public function index(Request $request)
    {
        $query = Bonus::query();

        if ($request->has('id_base')) {
            $query->where('id_base', $request->input('id_base'));
        }

        $bonuses = $query->get();

        return response()->json($bonuses);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_base' => 'required|exists:culture_bases,id',
            'count' => 'required|integer',
            'type' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 400);
        }

        $bonus = new Bonus();
        $bonus->id_base = $request->input('id_base');
        $bonus->id_user = Auth::id();
        $bonus->count = $request->input('count');
        $bonus->type = $request->input('type');
        $bonus->save();

        return response()->json($bonus);
    }

    public function show($id)
    {
        $bonus = Bonus::find($id);

        if (!$bonus) {
            return response()->json([
                'error' => 'Бонус не найден',
            ], 404);
        }

        return response()->json($bonus);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_base' => 'required|integer',
            'id_user' => 'required|integer',
            'count' => 'required|integer',
            'type' => 'required|integer',
        ]);

        $bonus = Bonus::find($id);

        if (!$bonus) {
            return response()->json([
                'error' => 'Бонус не найден',
            ], 404);
        }

        $bonus->id_base = $validatedData['id_base'];
        $bonus->id_user = $validatedData['id_user'];
        $bonus->count = $validatedData['count'];
        $bonus->type = $validatedData['type'];
        $bonus->save();

        return response()->json($bonus);
    }

    public function destroy($id)
    {
        $bonus = Bonus::find($id);

        if (!$bonus) {
            return response()->json([
                'error' => 'Бонус не найден',
            ], 404);
        }

        $bonus->delete();

        return response()->json(null, 204);
    }
}
