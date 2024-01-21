<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Cars;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class CarsController extends Controller
{
    public function addCar(): View
    {
        return view('admin.cars.add');
    }

    public function storeCar(Request $request): RedirectResponse
    {
        $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'number_plate' => ['required', 'string', 'max:255'],
            'car_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price_per_day' => ['required', 'integer'],
            'description' => ['required'],
        ]);

        $carPhoto = date('YmdHis') . '.' . $request->car_photo->extension();
        $request->car_photo->move(public_path('image/'), $carPhoto);

        Cars::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'number_plate' => $request->number_plate,
            'car_photo' => $carPhoto,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
        ]);

        FacadesAlert::success('Hore!', 'Created New Cars Data Successfully');
        return redirect()->route('admin.cars');
    }

    public function editCar($id): View
    {
        $data = Cars::find($id);

        return view('admin.cars.edit', compact('data'));
    }

    public function updateCar(Request $request, $id): RedirectResponse
    {
        $data = Cars::find($id);

        $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'number_plate' => ['required', 'string', 'max:255'],
            'car_photo_new' => 'image|mimes:jpeg,png,jpg|max:2048',
            'price_per_day' => ['required', 'integer'],
            'description' => ['required'],
        ]);

        $data->brand = $request->brand;
        $data->model = $request->model;
        $data->number_plate = $request->number_plate;
        $data->price_per_day = $request->price_per_day;
        $data->description = $request->description;

        if ($request->car_photo_new == NULL) {
            $data->car_photo = $request->car_photo;
        } else {
            $newPhoto = date('YmdHis') . '.' . $request->car_photo_new->extension();
            $request->car_photo_new->move(public_path('image/'), $newPhoto);
            $data->car_photo = $newPhoto;
        }
        $data->save();

        FacadesAlert::success('Hore!', 'Updated Cars Data Successfully');
        return redirect()->route('admin.cars');
    }

    public function deleteCars($id): RedirectResponse
    {
        DB::table('cars')->where('cars_id', $id)->delete();

        FacadesAlert::success('Hore!', 'Updated Cars Data Successfully');
        return redirect()->route('admin.cars');
    }

    public function searchCars(Request $request) :View
    {
        $keyword = $request->keyword;
        $category = $request->category;

        if ($category == "brand") {
            $data = DB::table('cars')
                ->select('*')
                ->orderBy('brand', 'ASC')
                ->where('brand', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "model") {
            $data = DB::table('cars')
                ->select('*')
                ->orderBy('brand', 'ASC')
                ->where('model', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "available") {
            $data = DB::table('cars')
                ->select('*')
                ->orderBy('brand', 'ASC')
                ->where('available', true)
                ->get();
        } elseif ($category == "not_available") {
            $data = DB::table('cars')
                ->select('*')
                ->orderBy('brand', 'ASC')
                ->where('available', false)
                ->get();
        }

        return view('admin.cars.index', compact('data'));
    }
}
