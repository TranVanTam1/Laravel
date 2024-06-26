<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    //
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.list-coupon', compact('coupons'));
    }
    public function create()
    {
        return view('admin.coupon.create-coupon');
    }


    public function store(Request $request)
{
    $request->validate([
        'code' => 'required|unique:coupons,code',
        'discount_percent' => 'required|numeric|min:0|max:100',
        'valid_from' => 'required|date',
        'valid_to' => 'required|date|after_or_equal:valid_from',
    ]);

    // Additional validation logic for other fields if necessary

    Coupon::create([
        'code' => $request->code,
        'discount_percent' => $request->discount_percent,
        'valid_from' => $request->valid_from,
        'valid_to' => $request->valid_to,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully.');
}


    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons')->with('success', 'Coupon deleted successfully.');
    }
}
