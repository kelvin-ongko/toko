<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function home()
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        return redirect('dashboard');
    }

    public function dashboard()
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        $today = date('Y-m-d');
        $last7daystr = strtotime("-7 days");
        $last7day = date('Y-m-d',$last7daystr);
        $month = date('Y-m');
        $todaytransaction = Transaction::where('date','like','%'.$today.'%')->count();
        $last7daytransaction = Transaction::where('date','>=',$last7day)->count();
        $monthtransaction = Transaction::where('date','like','%'.$month.'%')->count();
        return view('home',compact('todaytransaction','last7daytransaction','monthtransaction'));
    }

    //
    public function login()
    {
        if(Session::get('login')) {
            return redirect('dashboard');
        }
        return view('login');
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }

    public function validatelogin(Request $request)
    {
        $username=$request->get('username');
        $password=$request->get('password');
        //Check if we have a valid email ortherwise take username as the variable
        $field = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $data = Admin::where($field, $request->get('username'))->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                if($data->access == 1){
                Session::put('id',$data->id);
                Session::put('name',$data->name);
                Session::put('username',$data->username);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                // Session::put('admin',FALSE);
                Session::put('access',$data->access);
                return redirect()->intended('');
                }
                else{
                    return redirect('login')->withErrors("Admin is Inactive");
                }
            }
            else{
                return redirect('login')->withErrors("username or password is incorrect!");
            }
        }
        else{
            return redirect('login')->withErrors("username or password is incorrect!");
        }

    }

    public function register()
    {
        if(Session::get('login')) {
            return redirect('dashboard');
        }
        return view('Register');
    }

    public function storeadmin(Request $request)
    {
        //
        $this->validate($request, [
            'name'       => 'required|string|alpha_spaces|min:3|max:255',
            'email'      => 'required|string|email|unique:admins|max:255',
            'username'   => 'required|string|alpha_num|max:30|unique:admins',
            'password'   => 'required|string|confirmed|alpha_num|min:6|max:255',
            'access'     => 'required|string'
        ]);
        $admin = new Admin([
            'name'       => $request->get('name'),
            'email'      => $request->get('email'),
            'username'   => $request->get('username'),
            'password'   => bcrypt($request->get('password')),
            'access'     => $request->get('access')
        ]);
        $admin->save();
        
        return redirect('register')->with('success','Register Complete');;
    }

    public function addcustomer()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('addcustomer');
    }

    public function storecustomer(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $this->validate($request, [
            'name'        => 'required|string',
            'phonenumber' => 'required|string',
            'address'     => 'required|string',
            'description' => 'required|string',
            'city'        => 'required|string'

        ]);

        $customer = new Customer([
			'name'        => $request->get('name'),
            'phonenumber' => $request->get('phonenumber'),
            'address'     => $request->get('address'),
            'description' => $request->get('description'),
            'city'        => $request->get('city')
        ]);
        $customer->save();

        return redirect('addcustomer')->with('success','Customer has been Added');
    }

    public function editcustomer(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $id = $request->id;
        $customer = Customer::where('id', $id)->first();
        if ($customer) {
            return view('editcustomer', compact('customer'));
        }
        return redirect('customerlist');
    }

    public function validatededitcustomer(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        $this->validate($request, [
            'name'        => 'required|string',
            'phonenumber' => 'required|string',
            'address'     => 'required|string',
            'description' => 'required|string',
            'city'        => 'required|string'

        ]);

        $id = $request->id;
        $name = $request->name;
        $phonenumber = $request->phonenumber;
        $city = $request->city;
        $address = $request->address;
        $description = $request->description;
        
        $customer = Customer::where('id', $id)->first();
        if ($customer) {
            $customer->name = $name;
            $customer->phonenumber = $phonenumber;
            $customer->city = $city;
            $customer->address = $address ;
            $customer->description = $description;
            $customer->save();

            return redirect('customerlist')->with('success','Customer has been Changed');
        }
        return redirect('editcustomer')->with('error', 'Customer Not Found');
    }


    public function customerlist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('customerlist');
    }

    public function getcustomerlist(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select('id', 'name', 'phonenumber', 'address','city')->orderBy('name', 'ASC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="editcustomer/'.$row->id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function getcustomers(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->q;
            $data = Customer::select('id','name', 'city')->where('name','LIKE',"%$search%")->orderBy('name', 'ASC')->get();
            return response()->json($data);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function getcustomersname(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->q;
            $data = Customer::select('id','name', 'city')->where('id','=',"$search")->orderBy('id', 'ASC')->first();
            return response()->json($data);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function addbrand()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('addbrand');
    }

    public function storebrand(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $this->validate($request, [
            'brand'        => 'required|string'

        ]);

        $brand = new Brand([
			'brand'     => $request->get('brand')
        ]);
        $brand->save();

        return redirect('addbrand')->with('success','Brand has been Added');
    }

    public function editbrand(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $id = $request->id;
        $brand = Brand::where('id', $id)->first();
        if ($brand) {
            return view('editbrand', compact('brand'));
        }
        return redirect('brandlist');
    }

    public function validatededitbrand(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }

        
        $this->validate($request, [
            'brand'        => 'required|string'

        ]);

        $id = $request->id;
        $brand = $request->brand;
        $brands = Brand::where('id', $id)->first();
        if ($brands) {
            $brands->brand = $brand;
            $brands->save();

            return redirect('brandlist')->with('success','Brand has been Changed');
        }
        return redirect('brandlist')->with('errors','Brand not found');
    }

    public function brandlist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('brandlist');
    }

    public function getbrandlist(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::select('id','brand')->orderBy('brand', 'ASC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="editbrand/'.$row->id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function getbrands(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->q;
            $data = Brand::select('id','brand')->where('brand','LIKE',"%$search%")->orderBy('brand', 'ASC')->get();
            return response()->json($data);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function addcategory()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('addcategory');
    }

    public function storecategory(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $this->validate($request, [
            'category'        => 'required|string'

        ]);

        $category = new ItemCategory([
			'category'     => $request->get('category')
        ]);
        $category->save();

        return redirect('addcategory')->with('success','Category has been Added');
    }

    public function editcategory(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }


        $id = $request->id;
        $category = ItemCategory::where('id', $id)->first();
        if ($category) {
            return view('editcategory', compact('category'));
        }
        return redirect('categorylist');
    }

    public function validatededitcategory(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }

        
        $this->validate($request, [
            'category'        => 'required|string'
        ]);

        $id = $request->id;
        $category = $request->category;
        $categories = ItemCategory::where('id', $id)->first();
        if ($categories) {
            $categories->category = $category;
            $categories->save();

            return redirect('categorylist')->with('success','Item Category has been Changed');
        }
        return redirect('categorylist')->with('errors', 'Item Category not found');
    }

    public function categorylist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('categorylist');
    }

    public function getcategorylist(Request $request)
    {
        if ($request->ajax()) {
            $data = ItemCategory::select('id','category')->orderBy('category', 'ASC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="editcategory/'.$row->id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function getcategories(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->q;
            $data = ItemCategory::select('id','category')->where('category','LIKE',"%$search%")->orderBy('category', 'ASC')->get();
            return response()->json($data);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function additem()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('additem');
    }

    public function storeitem(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $this->validate($request, [
            'name'         => 'required|string',
            'brand'        => 'required|string',
            'category'     => 'required|string',
            'capitalprice' => 'required|integer',
            'price'        => 'required|integer',
            'qty'          => 'required|integer'

        ]);

        $item = new Item([
        	'name'         => $request->get('name'),
			'brand_id'     => $request->get('brand'),
			'category_id'  => $request->get('category'),
			'capitalprice' => $request->get('capitalprice'),
			'price'        => $request->get('price'),
            'qty'          => $request->get('qty'),
			'status'       => 1
        ]);
        $item->save();

        return redirect('additem')->with('success','Item has been Added');
    }

    public function itemlist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('itemlist');
    }

    public function getitemlist(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('items')
            ->leftJoin('brands', 'items.brand_id', '=', 'brands.id')
            ->select('items.id', 'brands.brand','items.name', 'items.qty', 'items.price')
            ->where('items.status','=', '1')->orderBy('name', 'ASC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="edititem/'.$row->id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function getitems(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->q;
            $search = str_replace(' ', '%', $search);
            $table = DB::table('items')->leftJoin('brands', 'items.brand_id', '=', 'brands.id')
                    ->select(DB::raw("items.id, items.name, CONCAT(brands.brand, ' - ',items.name) AS brandname, CONCAT(items.name, ' - ',brands.brand) AS namebrand"))
                    ->where('items.status','=', '1');

            $data = DB::table($table)
                    ->select('*')
                    ->where('namebrand','LIKE',"%$search%")
                    ->orWhere('brandname','LIKE',"%$search%")
                    ->orderBy('name', 'ASC')->get();
                return response()->json($data);
        }
        else{
            return redirect('dashboard');
        }
    }
    
    public function getitemprices(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->q;
            $data = Item::select('id','price', 'capitalprice', 'qty as stok')->where('id','=',"$search")->first();
                return response()->json($data);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function edititem(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        $id = $request->id;
        $item = Item::where('id', $id)->first();
        if ($item) {
            $brand = Brand::where('id', $item->brand_id)->first();
            $category = ItemCategory::where('id', $item->category_id)->first();
            
            return view('edititem', compact('item', 'brand', 'category'));
        }
        return redirect('itemlist');

    }

    public function validateedititem(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect()->guest('login');
        }
        $this->validate($request, [
            'name'         => 'required|string',
            'brand'        => 'required|string',
            'category'     => 'required|string',
            'capitalprice' => 'required|integer',
            'price'        => 'required|integer',
            'qty'          => 'required|integer'
        ]);

        $id = $request->id;
        $item = Item::where('id', $id)->first();
        
        if ($item) {
            $item->name         = $request->name;
            $item->brand_id     = $request->brand;
            $item->category_id  = $request->category;
            $item->capitalprice = $request->capitalprice;
            $item->price        = $request->price;
            $item->qty          = $request->qty;
            $item->save();
            return redirect('itemlist')->with('success','Item has been Changed');
        }
        return redirect('itemlist')->with('error','Item not found');

    }

// Transaction

    public function addtransaction()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('addtransaction');
    }

    public function storetransaction(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $this->validate($request, [
            'customer'     => 'required|string',
            'date'         => 'required|string',
            'admin'        => 'required|string'
        ]);
        
        $timestamp = strtotime($request->date);
        $month = date("m", $timestamp);
        $year = date("Y", $timestamp);
        $counttransaction = Transaction::selectRaw('COUNT(*) as ct')->whereYear('date', '=', $year)->whereMonth('date', '=', $month)->first();
        $transaction = sprintf("%05d", $counttransaction->ct+1);
        $transaction_id = "SEN-".$year."-".$month."-".$transaction;
        
        $item = $request->item;
        $capitalprice = $request->capitalprice;
        $price = $request->price;
        $total = $request->total;
        $qty = $request->qty;
        $disc = $request->discount;
        $totalcapitalprice = 0;

        $transaction = new Transaction([
        	'transaction_id'  => $transaction_id,
        	'customer_id'  => $request->get('customer'),
        	'customer'     => $request->get('customername'),
			'admin_id'     => $request->get('admin'),
			'total'        => $request->get('totals'),
			'grandtotal'   => $request->get('grandtotal'),
			'discount'     => $request->get('totaldiscount'),
			'totalcapitalprice'=> $totalcapitalprice,
			'items'        => count($item),
            'status'       => '0',
			'date'         => $request->get('date')
        ]);
        $transaction->save();



        for ($i=0; $i < count($item); $i++){
            if($qty[$i]!=0){
                $transactiondetail = new TransactionDetail([
                    'transaction_id'  => $transaction_id,
                    'item_id'      => $item[$i],
                    'qty'          => $qty[$i],
                    'capitalprice' => $capitalprice[$i],
                    'price'        => $price[$i],
                    'total'        => $total[$i],
                    'discount'     => $disc[$i],
                    'status'       => '0',
                ]);
                $transactiondetail->save();
                $totalcapitalprice += $capitalprice[$i] * $qty[$i];
                $items = Item::where('id', '=', $item[$i])->first();
                $items->qty = $items->qty - $qty[$i];
                $items->save();
            }
        }
        $transaction->totalcapitalprice = $totalcapitalprice;
        $transaction->save();

        return redirect('transactionlist');
    }

    public function transactionlist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('transactionlist');
    }

    public function gettransactionlist(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')
            ->leftjoin('customers', 'transactions.customer_id', '=', 'customers.id')
            ->select('transactions.id', 'transactions.transaction_id', 'transactions.customer', 'customers.city', 'transactions.items','transactions.grandtotal', 'transactions.status')
            ->where('transactions.status', '!=', 4)
            ->orderBy('id', 'DESC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('customer', function($row){
                        return $row->customer.' - '.$row->city;
                    })
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="detailtransaction/'.$row->transaction_id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->addColumn('edit', function($row){
     
                        $btn2 = '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="btn btn-warning btn-sm w-100 p-2" href="edittransaction/'.$row->transaction_id.'" ">Edit</a>
    <a class="btn btn-danger btn-sm w-100 p-2" href="deletetransaction/'.$row->transaction_id.'" ">Delete</a>
  </div>
</div>';
    
                         return $btn2;
                    })
                    ->rawColumns(['action','edit'])
                    ->make(true);
        }
        
        return redirect('dashboard');
    }

    public function gettransactioncompletelist(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')
            ->leftjoin('customers', 'transactions.customer_id', '=', 'customers.id')
            ->select('transactions.id', 'transactions.transaction_id', 'customers.name', 'customers.city', 'transactions.items','transactions.grandtotal', 'transactions.status')
            ->where('status','=', '2')->orderBy('id', 'DESC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('customer', function($row){
                        return $row->name.' - '.$row->city;
                    })
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="detailtransaction/'.$row->transaction_id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return redirect('dashboard');
    }

    public function getTransactionDetail(Request $request)
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        
        $transactionid = $request->id;
        $transaction = Transaction::where('transaction_id', $transactionid)->first();
        if ($transaction) {
            $transactiondetail = DB::table('transaction_details')
            ->leftjoin('items', 'transaction_details.item_id', '=', 'items.id')
            ->select('transaction_details.*', 'items.name')
            ->where('transaction_id', $transactionid)
            ->where('transaction_details.status', 0)->get();
            return view('detailtransaction', compact('transaction', 'transactiondetail'));
        }
        return redirect('transactionlist');
    }

    public function editTransactionDetail(Request $request)
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        
        $transactionid = $request->id;
        $transaction = Transaction::where('transaction_id', $transactionid)->first();
        if ($transaction) {
            $transactiondetail = DB::table('transaction_details')
            ->leftjoin('items', 'transaction_details.item_id', '=', 'items.id')
            ->select('transaction_details.*', 'items.name')
            ->where('transaction_id', $transactionid)
            ->where('transaction_details.status', 0)->get();
            return view('edittransaction', compact('transaction', 'transactiondetail'));
        }
        return redirect('transactionlist');
    }

    public function edittransaction(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        $transactionid = $request->transactionid;
        $transaction = TransactionDetail::where('transaction_id', $transactionid)->first();



        for ($i=0; $i < count($item); $i++){
            if($qty[$i]!=0){
                $transactiondetail = new TransactionDetail([
                    'transaction_id'  => $transaction_id,
                    'item_id'      => $item[$i],
                    'qty'          => $qty[$i],
                    'capitalprice' => $capitalprice[$i],
                    'price'        => $price[$i],
                    'total'        => $total[$i],
                    'discount'     => $disc[$i],
                    'status'       => '0',
                ]);
                $transactiondetail->save();
                $totalcapitalprice += $capitalprice[$i] * $qty[$i];
                $items = Item::where('id', '=', $item[$i])->first();
                $items->qty = $items->qty - $qty[$i];
                $items->save();
            }
        }
        $transaction->totalcapitalprice = $totalcapitalprice;
        $transaction->save();

        return redirect('transactionlist');
    }

    public function deletetransactiondetail(Request $request)
    {
        if(!Session::get('login')) {
            return redirect('login');
        }

        $transactiondetailid = $request->transactiondetail;
        $transactiondetail = TransactionDetail::where('id', $transactiondetailid)->first();
        
        if ($transactiondetail) {
            $transactionid=$transactiondetail->transaction_id;
            $transactiondetail->status = 4;
            $item = Item::where('id', $transactiondetail->item_id)->first();
            $item->qty = $item->qty + $transactiondetail->qty;
            $transactiondetail->save();
            $item->save();
            $minuscapitalprice= $transactiondetail->capitalprice * $transactiondetail->qty;
            $minustotal = $transactiondetail->total;
            $transaction = Transaction::where('transaction_id',$transactionid)->first();
            $transaction->totalcapitalprice = $transaction->totalcapitalprice - $minuscapitalprice;
            $transaction->total = $transaction->total - $minustotal;
            $transaction->grandtotal = $transaction->total * (100-$transaction->discount)/100;
            $transaction->save();
            return redirect('edittransaction/'.$transactionid);
        }
        return redirect('transactionlist');
    }

    public function getInvoice(Request $request)
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        
        $transactionid = $request->id;
        $transaction = Transaction::where('transaction_id', $transactionid)->first();
        if ($transaction) {
            $transactiondetail = DB::table('transaction_details')
            ->leftjoin('items', 'transaction_details.item_id', '=', 'items.id')
            ->leftjoin('brands', 'items.brand_id', '=', 'brands.id')
            ->select('transaction_details.*', 'items.name', 'brands.brand')
            ->where('transaction_id', $transactionid)
            ->where('transaction_details.status', '!=', 4)->get();
            return view('invoice', compact('transaction', 'transactiondetail'));
        }
        return redirect('dashboard');
    }


// purchase

    public function addpurchase()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('addpurchase');
    }

    public function storepurchase(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        $this->validate($request, [
            'date'         => 'required|string',
            'admin'        => 'required|string'
        ]);
        
        $timestamp = strtotime($request->date);
        $month = date("m", $timestamp);
        $year = date("Y", $timestamp);
        $countpurchase = Purchase::selectRaw('COUNT(*) as ct')->whereYear('date', '=', $year)->whereMonth('date', '=', $month)->first();
        $purchase = sprintf("%05d", $countpurchase->ct+1);
        $purchase_id = "PURCHASE-".$year."-".$month."-".$purchase;
        
        $item = $request->item;
        $price = $request->price;
        $total = $request->total;
        $qty = $request->qty;
        $disc = $request->discount;

        $purchase = new Purchase([
        	'purchase_id'  => $purchase_id,
			'admin_id'     => $request->get('admin'),
			'total'        => $request->get('totals'),
			'grandtotal'   => $request->get('grandtotal'),
			'discount'     => $request->get('totaldiscount'),
			'items'        => count($item),
            'status'       => '0',
			'date'         => $request->get('date')
        ]);
        $purchase->save();



        for ($i=0; $i < count($item); $i++){
            if($qty[$i]!=0){
                $purchasedetail = new PurchaseDetail([
                    'purchase_id'  => $purchase_id,
                    'item_id'      => $item[$i],
                    'qty'          => $qty[$i],
                    'price'        => $price[$i],
                    'total'        => $total[$i],
                    'discount'     => $disc[$i],
                    'status'       => '0',
                    'date'         => $request->get('date')
                ]);
                $purchasedetail->save();
            }
        }

        return redirect('purchaselist');
    }

    public function purchaselist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('purchaselist');
    }

    public function getpurchaselist(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('purchases')
            ->select('purchases.id', 'purchases.purchase_id', 'purchases.items','purchases.grandtotal', 'purchases.status')
            ->where('status', 0)
            ->orderBy('id', 'DESC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="detailpurchase/'.$row->purchase_id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return redirect('dashboard');
    }

    public function getPurchaseDetail(Request $request)
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        
        $purchaseid = $request->id;
        $purchase = Purchase::where('purchase_id', $purchaseid)->first();
        if ($purchase) {
            $purchasedetail = DB::table('purchase_details')
            ->leftjoin('items', 'purchase_details.item_id', '=', 'items.id')
            ->select('purchase_details.*', 'items.name')
            ->where('purchase_id', $purchaseid)->get();
            return view('detailpurchase', compact('purchase', 'purchasedetail'));
        }
        return redirect('dashboard');
    }

    public function statusupdatepurchasedetail(Request $request)
    {
        if(!Session::get('login')) {
            return redirect('login');
        }
        
        $purchaseid = $request->id;
        $item_id = $request->item_id;
        $purchasedetail = PurchaseDetail::where('purchase_id', $purchaseid)->where('item_id', $item_id)->where('status', 0)->first();
        if ($purchasedetail) {
            $purchasedetail->status = 1;
            $qty = $purchasedetail->qty;
            $items = Item::where('id', '=', $item_id)->first();
            $items->qty = $items->qty + $qty;
            $items->save();
            $purchasedetail->save();
            
            $purchasetotal = PurchaseDetail::where('purchase_id', $purchaseid)->where('status', 1)->count();
            $purchaseitem = Purchase::where('purchase_id', $purchaseid)->first();
            if($purchasetotal == $purchaseitem->items){
                $purchaseitem->status=1;
                $purchaseitem->save();
                return redirect('purchaselist');
            }
            // return $purchaseitem;
            return redirect('detailpurchase/'.$purchaseid);
        }
        return redirect('dashboard');
    }

    public function purchasecompletelist()
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        
        return view('purchasecompletelist');
    }

    public function getpurchasecompletelist(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('purchases')
            ->select('purchases.id', 'purchases.purchase_id', 'purchases.items','purchases.grandtotal', 'purchases.status')
            ->where('status', 1)
            ->orderBy('id', 'DESC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="detailpurchase/'.$row->purchase_id.'" class="edit btn btn-primary btn-sm">Detail</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return redirect('dashboard');
    }

    public function yearlyreport(Request $request)
    {
    	if(!Session::get('login')) {
            return redirect('login');
        }
        $years = Transaction::select(DB::raw('year(date) as year'))->groupby('year')->orderbydesc('year')->get();
        if ($request->year != NULL){
        $year = $request->year;
        $monthly = DB::table('transactions')
                    ->select(DB::raw('MONTHNAME(date) as month'),DB::raw('SUM(grandtotal) as grandtotal'),DB::raw('(SUM(grandtotal) - SUM(totalcapitalprice)) as profit'))
                    ->where(DB::raw('YEAR(date)'), $year)
                    ->where('status', '0')
                    ->groupBy('month')
                    ->orderBy('date')->get();
            return view('yearlyreport', compact('years','monthly','year'));
        }
        return view('yearlyreport', compact('years'));
    }

}

