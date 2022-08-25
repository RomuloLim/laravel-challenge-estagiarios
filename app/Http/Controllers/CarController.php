<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::paginate(5);

        return view('admin.index', compact('cars'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'year' => 'required|integer|min:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'required',
        ]);

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $fileName);

        $data['image'] = $fileName;

        $car = Car::create($data);

        return redirect()->route('car.index')->with('success', 'Carro criado com sucesso!');
//        return response()->json($car);
    }
}
