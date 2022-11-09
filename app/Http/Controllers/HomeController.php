<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chart;

use App\Models\Order;

use App\Models\Product;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.home');
        }

        else
        {

            $data = product::paginate(3);

            $user=auth()->user();

            $count=chart::where('phone',$user->phone)->count();

            return view('user.home',compact('data','count'));
        }
    }

    public function index()
    {

        if(Auth::id())
        {
            return redirect('redirect');
        }
        else
        {

            $data = product::paginate(3);

            return view('user.home',compact('data'));
        }


    }

    public function search(Request $request)
    {

        $search=$request->search;

        if($search=='')
        {

            $data = product::paginate(3);

            return view('user.home',compact('data'));

        }

        $data=product::where('title','Like','%'.$search.'%')->get();

        return view('user.home',compact('data'));

    }

    public function addchart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user=auth()->user();

            $product=product::find($id);

            $chart=new chart;

            $chart->name=$user->name;

            $chart->phone=$user->phone;

            $chart->address=$user->address;

            $chart->product_title=$product->title;

            $chart->price=$product->price;

            $chart->quantity=$request->quantity;

            $chart->save();

            return redirect()->back()->with('message','Product Added Successfully');
        }

        else
        {
            return redirect('login');
        }

    }

    public function showchart()
    {

        $user=auth()->user();

        $chart=chart::where('phone',$user->phone)->get();

        $count=chart::where('phone',$user->phone)->count();

        return view('user.showchart',compact('count','chart'));
    }

    public function deletechart($id)
    {

        $data=chart::find($id);

        $data->delete();

        return redirect()->back()->with('message','Product Removed Successfully');

    }

    public function confirmorder(Request $request)
    {

        $user=auth()->user();

        $name=$user->name;

        $phone=$user->phone;

        $address=$user->address;

       foreach($request->productname as $key=>$productname)
        {
            $order=new order;

            $order->product_name=$request->productname[$key];

            $order->price=$request->price[$key];

            $order->quantity=$request->quantity[$key];

            $order->name=$name;

            $order->phone=$phone;

            $order->address=$address;

            $order->status='not delivered';

            $order->save();

        }

        DB::table('charts')->where('phone',$phone)->delete();

        return redirect()->back()->with('message','Product Ordered Successfully');

    }
}
