<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Cars;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class AdminController extends Controller
{
    public function index(): View
    {
        $data = Cars::orderBy('brand', 'ASC')->get();

        $title = 'Delete Cars!';
        $text = "Are you sure want to delete it?";
        confirmDelete($title, $text);

        return view('admin.cars.index', compact('data'));
    }

    public function showCustomerData(): View
    {
        $data = User::where('role', 'customer')->orderBy('name', 'ASC')->get();

        $title = 'Delete Customer Data!';
        $text = "Are you sure want to delete it?";
        confirmDelete($title, $text);

        return view('admin.customer.index', compact('data'));
    }

    public function deleteCustomerData($id): RedirectResponse
    {
        DB::table('users')->where('id', $id)->delete();

        FacadesAlert::success('Hore!', 'Updated Cars Data Successfully');
        return redirect()->route('admin.customer');
    }

    public function searchCustomerData(Request $request): View
    {
        $keyword = $request->keyword;
        $category = $request->category;

        if ($category == "name") {
            $data = DB::table('users')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->where('role', 'customer')
                ->where('name', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "email") {
            $data = DB::table('users')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->where('role', 'customer')
                ->where('email', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "address") {
            $data = DB::table('users')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->where('role', 'customer')
                ->where('address', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "phone") {
            $data = DB::table('users')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->where('role', 'customer')
                ->where('phone', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "driver_license_num") {
            $data = DB::table('users')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->where('role', 'customer')
                ->where('driver_lincense_num', 'like', "%" . $keyword . "%")
                ->get();
        } elseif ($category == "status") {
            $data = DB::table('users')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->where('role', 'customer')
                ->where('status', 'like', "%" . $keyword . "%")
                ->get();
        }

        return view('admin.customer.index', compact('data'));
    }

    public function showTransactionData(): View
    {
        $data = DB::table('transaction')
            ->join('users', 'users.id', '=', 'transaction.users_id')
            ->join('cars', 'cars.cars_id', '=', 'transaction.cars_id')
            ->select(
                'users.name',
                'users.id',
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
            ->orderBy('transaction.created_at', 'desc')
            ->get();

        return view('admin.transaction.index', compact('data'));
    }

    public function validateTransactionData($id): RedirectResponse
    {
        $data = Transaction::find($id);

        $data->payment_status = "paid";
        $data->admin_check = false;
        $data->save();

        FacadesAlert::success('Hore!', 'Validate Successfully');
        return redirect()->route('admin.transcation');
    }

    public function returnValidateTransactionData($id): RedirectResponse
    {
        $data = Transaction::find($id);

        $data->tracking_status = "returned";
        $data->admin_check = false;
        $data->save();

        FacadesAlert::success('Hore!', 'Return Car Validaate Successfully');
        return redirect()->route('admin.transcation');
    }
}
