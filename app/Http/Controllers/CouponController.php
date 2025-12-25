<?php

namespace App\Http\Controllers;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Cart;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::orderBy('id','DESC')->paginate(10);
        return view('backend.coupon.index')->with('coupons',$coupon);
    }

    public function create()
    {
        return view('backend.coupon.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'code'=>'string|required',
            'type'=>'required|in:fixed,percent',
            'value'=>'required|numeric',
            'status'=>'required|in:active,inactive'
        ]);

        $data = $request->all();
        $status = Coupon::create($data);

        if($status){
            request()->session()->flash('success','Coupon Successfully added');
        } else {
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('coupon.index');
    }

    public function edit($id)
    {
        $coupon=Coupon::find($id);
        if($coupon){
            return view('backend.coupon.edit')->with('coupon',$coupon);
        }
        request()->session()->flash('error','Coupon not found');
        return redirect()->route('coupon.index');
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        $this->validate($request,[
            'code'=>'string|required',
            'type'=>'required|in:fixed,percent',
            'value'=>'required|numeric',
            'status'=>'required|in:active,inactive'
        ]);

        $data = $request->all();
        $status = $coupon->fill($data)->save();

        if($status){
            request()->session()->flash('success','Coupon Successfully updated');
        } else {
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('coupon.index');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if($coupon){
            $coupon->delete();
            request()->session()->flash('success','Coupon successfully deleted');
        } else {
            request()->session()->flash('error','Coupon not found');
        }
        return redirect()->route('coupon.index');
    }

    // ---------------------------
    // APPLY COUPON
    // ---------------------------
    public function couponStore(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)
                        ->where('status', 'active')
                        ->first();

        if(!$coupon){
            request()->session()->flash('error','Invalid or inactive coupon');
            return back();
        }

        $total_price = Cart::where('user_id', auth()->user()->id)
                            ->where('order_id', null)
                            ->sum('amount');

        session()->put('coupon', [
            'id'   => $coupon->id,
            'code' => $coupon->code,
            'value'=> $coupon->discount($total_price)
        ]);

        request()->session()->flash('success','Coupon applied successfully');
        return redirect()->back();
    }

    // ---------------------------
    // REMOVE COUPON
    // ---------------------------
    public function couponRemove()
    {
        session()->forget('coupon');
        request()->session()->flash('success', 'Coupon removed successfully');
        return redirect()->back();
    }
}
