<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use App\Models\CultureBase;
use Illuminate\Http\Request;

class CultureBaseController extends Controller
{
    // Отобразить список культурных баз
    public function index()
    {
        $cultureBases = CultureBase::all();

        return response()->json($cultureBases);
    }

    // Создать новую культурную базу
    public function store(Request $request)
    {
        $cultureBase = new CultureBase;
        $cultureBase->title = $request->title;
        $cultureBase->description = $request->description;
        $cultureBase->longitude = $request->longitude;
        $cultureBase->latitude = $request->latitude;
        $cultureBase->url = $request->url;
        $cultureBase->countPeople = $request->countPeople;
        $cultureBase->price = $request->price;
        $cultureBase->save();

        return response()->json($cultureBase, 201);
    }

    // Отобразить культурную базу по ID
    public function show($id)
    {
        $cultureBase = CultureBase::find($id);

        if (!$cultureBase) {
            return response()->json(['error' => 'Ошибка. Не найден элемент'], 404);
        }

        return response()->json($cultureBase);
    }

    // Обновить культурную базу по ID
    public function update(Request $request, $id)
    {
        $cultureBase = CultureBase::find($id);

        if (!$cultureBase) {
            return response()->json(['error' => 'Ошибка. Не найден элемент'], 404);
        }

        $cultureBase->title = $request->title;
        $cultureBase->description = $request->description;
        $cultureBase->longitude = $request->longitude;
        $cultureBase->latitude = $request->latitude;
        $cultureBase->url = $request->url;
        $cultureBase->countPeople = $request->countPeople;
        $cultureBase->price = $request->price;
        $cultureBase->save();

        return response()->json($cultureBase);
    }

    // Удалить культурную базу по ID
    public function destroy($id)
    {
        $cultureBase = CultureBase::find($id);

        if (!$cultureBase) {
            return response()->json(['error' => 'Ошибка. Не найден элемент'], 404);
        }

        $cultureBase->delete();

        return response()->json(['message' => 'Удалено успешно']);
    }
}
