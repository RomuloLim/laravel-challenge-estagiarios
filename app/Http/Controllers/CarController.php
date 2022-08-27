<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentCarRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $car = Auth::user()->cars()->create($data);

        return redirect()->route('car.index')->with('success', 'Carro criado com sucesso!');

//        return response()->json($car);
    }

    public function rent(RentCarRequest $request)
    {
        $data = $request->validated();


        DB::transaction(function () use ($data){
            $car = Car::find($data['car_id']);

            $car->update([
                'status' => 2,
            ]);

            $car->rents()->attach(Auth::user()->id);
        });



        return redirect()->route('car.index')->with('success', 'Carro alugado com sucesso!');
    }
}
