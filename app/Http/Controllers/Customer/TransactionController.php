<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;


class TransactionController extends Controller
{
    public function addTransaction(Request $request): RedirectResponse
    {
        $request->validate([
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        $toDate = Carbon::parse($request->start_date);
        $fromDate = Carbon::parse($request->end_date);

        $diffentDate = $toDate->diffInDays($fromDate);

        $total_price = $request->price_per_day * $diffentDate;

        Transaction::create([
            'users_id' => Auth::user()->id,
            'cars_id' => $request->cars_id,
            'start_date' => $toDate,
            'end_date' => $fromDate,
            'total_price' => $total_price,
        ]);

        FacadesAlert::success('Hore!', 'Rent Car Successfully');
        return redirect()->route('dashboard');
    }

    public function showTransaction(): View
    {
        $data = DB::table('transaction')
            ->join('users', 'users.id', '=', 'transaction.users_id')
            ->join('cars', 'cars.cars_id', '=', 'transaction.cars_id')
            ->select(
                'cars.brand',
                'cars.model',
                'cars.number_plate',
                'transaction.total_price',
                'transaction.payment_status',
                'transaction.tracking_status',
                'transaction.transaction_id',
                'transaction.start_date',
                'transaction.end_date',
                'transaction.admin_check'
            )
            ->where('transaction.users_id', Auth::user()->id)
            ->orderBy('transaction.created_at', 'desc')
            ->get();



        return view('dashboard', compact('data'));
    }

    public function custPaid($id): RedirectResponse
    {
        $data = Transaction::find($id);

        $data->admin_check = true;
        $data->save();

        FacadesAlert::success('Hore!', 'Paid Successfully');
        return redirect()->route('dashboard');
    }

    public function custGetCar($id): RedirectResponse
    {
        $data = Transaction::find($id);

        $data->tracking_status = "ongoing";
        $data->save();

        FacadesAlert::success('Hore!', 'Successfully Get Your Car');
        return redirect()->route('dashboard');
    }

    public function custReturnCar($id): RedirectResponse
    {
        $data = Transaction::find($id);

        $data->admin_check = true;
        $data->save();

        FacadesAlert::success('Hore!', 'Successfully Get Your Car');
        return redirect()->route('dashboard');
    }

    // public function searchTransactionHistory(Request $request): View
    // {
    //     $keyword = $request->keyword;
    //     $category = $request->category;

    //     if ($category == "start_date") {
    //         $data = DB::table('transaction')
    //             ->select('*')
    //             ->orderBy('transaction.created_at', 'desc')
    //             ->where('start_date', 'like', "%" . $keyword . "%")
    //             ->get();
    //     } elseif ($category == "model") {
    //         $data = DB::table('cars')
    //             ->select('*')
    //             ->orderBy('brand', 'ASC')
    //             ->where('model', 'like', "%" . $keyword . "%")
    //             ->get();
    //     } elseif ($category == "available") {
    //         $data = DB::table('cars')
    //             ->select('*')
    //             ->orderBy('brand', 'ASC')
    //             ->where('available', true)
    //             ->get();
    //     } elseif ($category == "not_available") {
    //         $data = DB::table('cars')
    //             ->select('*')
    //             ->orderBy('brand', 'ASC')
    //             ->where('available', false)
    //             ->get();
    //     }

    //     return view('dashboard', compact('data'));
    // }
}
