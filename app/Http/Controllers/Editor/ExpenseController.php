<?php

namespace App\Http\Controllers\Editor;

use App\Expense;
use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Parcel;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller {

    public function index() {
        $date_time = request()->date_time ?? date("Y-m-d");

        $day   = Carbon::parse($date_time)->format('d');
        $month = Carbon::parse($date_time)->format('m');
        $year  = Carbon::parse($date_time)->format('Y');

        $day   = Expense::whereDay('created_at', $day)->whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('amount');
        $month = Expense::whereMonth('created_at', '=', $month)->whereYear('created_at', $year)->sum('amount');
        $year  = Expense::whereYear('created_at', $year)->sum('amount');

        $show_data = Expense::whereMonth('created_at', now())->orderBy('id', 'desc')->get();

        return view('backEnd.expense.expense-list', compact('show_data', 'date_time', 'day', 'month', 'year'));
    }

    public function create() {
        $categories = ExpenseCategory::all();

        return view('backEnd.expense.expense-create', compact('categories'));
    }

    public function store(Request $request) {
        Expense::create($request->all());
        Toastr::success('message', 'Expense Added successfully!');

        return back();
    }

    public function edit($id) {
        $categories = ExpenseCategory::all();
        $edit_data  = Expense::find($id);

        return view('backEnd.expense.expense-edit', compact('categories', 'edit_data'));
    }

    public function update(Request $request, $id) {
        $expense = Expense::find($id);
        $expense->update($request->all());
        Toastr::success('message', 'Expense updated successfully!');

        return back();
    }

    public function delete($id) {
        $expense = Expense::find($id);
        $expense->delete();
        Toastr::success('message', 'Expense deleted successfully!');

        return back();
    }

    public function income() {
        $date_time = request()->date_time ?? date("Y-m-d");

        $day   = Carbon::parse($date_time)->format('d');
        $month = Carbon::parse($date_time)->format('m');
        $year  = Carbon::parse($date_time)->format('Y');

        $day   = Parcel::where('status', 4)->whereDay('created_at', $day)->whereMonth('created_at', $month)->whereYear('created_at', $year)->select('deliveryCharge')->sum('deliveryCharge');
        $month = Parcel::where('status', 4)->whereMonth('created_at', '=', $month)->whereYear('created_at', $year)->select('deliveryCharge')->sum('deliveryCharge');
        $year  = Parcel::where('status', 4)->whereYear('created_at', $year)->select('deliveryCharge')->sum('deliveryCharge');

        $show_data = Parcel::where('status', 4)->whereDay('created_at', today())->select(['id','trackingCode','deliveryCharge','created_at'])->orderBy('id', 'desc')->paginate(50);

        return view('backEnd.expense.income-list', compact('show_data', 'date_time', 'day', 'month', 'year'));
    }

    public function revenue() {
        $data              = [];
        $data['date_time'] = $date_time = request()->date_time ?? date("Y-m-d");

        $day   = Carbon::parse($date_time)->format('d');
        $month = Carbon::parse($date_time)->format('m');
        $year  = Carbon::parse($date_time)->format('Y');

        //income
        $data['day_income']   = Parcel::whereDay('created_at', $day)->whereMonth('created_at', $month)->whereYear('created_at', $year)->select(['deliveryCharge'])->sum('deliveryCharge');
        $data['month_income'] = Parcel::whereMonth('created_at', '=', $month)->whereYear('created_at', $year)->select(['deliveryCharge'])->sum('deliveryCharge');
        $data['year_income']  = Parcel::whereYear('created_at', $year)->select(['deliveryCharge'])->sum('deliveryCharge');

        //expense
        $data['day_expense']   = Expense::whereDay('created_at', $day)->whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('amount');
        $data['month_expense'] = Expense::whereMonth('created_at', '=', $month)->whereYear('created_at', $year)->sum('amount');
        $data['year_expense']  = Expense::whereYear('created_at', $year)->sum('amount');

        $data['day_revenue']   = $data['day_income'] - $data['day_expense'];
        $data['month_revenue'] = $data['month_income'] - $data['month_expense'];
        $data['year_revenue']  = $data['year_income'] - $data['year_expense'];

        return view('backEnd.expense.revenue-list', $data);
    }

}
