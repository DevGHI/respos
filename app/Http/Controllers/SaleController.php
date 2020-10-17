<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use App\Category;
use App\Product;
use Auth;
use Validator;
use DB;
use App\User;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q', '');
        $data["q"] = $keyword;
        $ids = array();
        if ($keyword) {
            $users = User::where("role_id", "!=", 4)->where("name", "like", "%$keyword%")->get();
            foreach ($users as $user) {
                $ids[] = $user->id;
            }

        }




        if (Auth::user()->role_id == 1) {

            if (!empty($ids)) {
                $sales = Sale::select("*", "sales.id as id")->leftJoin("sale_items as s", "s.sale_id", '=', "sales.id")->whereIn("cashier_id", $ids)->groupBy("sales.id")->orderBy("sales.id", "DESC")->paginate(25);
            } else {
                $sales = Sale::select("*", "sales.id as id")->leftJoin("sale_items as s", "s.sale_id", '=', "sales.id")->groupBy("sales.id")->orderBy("sales.id", "DESC")->paginate(25);
            }

            $sales = !empty($keyword) ? $sales->appends(['q' => $keyword]) : $sales;
            $data['sales'] = $sales;

        } else {
            $data['sales'] = Sale::where("cashier_id", Auth::user()->id)->leftJoin("sale_items as s", "s.sale_id", '=', "sales.id")->orderBy("sales.id", "DESC")->paginate(25);
        }

        return view('backend.sales.index', $data);
        
        // if(Auth::user()->role_id == 1) { 
        //     $data['sales'] = Sale::select("*" , "sales.id as id")->where("type", "pos")->leftJoin("sale_items as s" , "s.sale_id" , '=', "sales.id" )->orderBy("sales.id", "DESC")->paginate(25);
        // } else { 
        //     $data['sales'] = Sale::where("cashier_id", Auth::user()->id)->leftJoin("sale_items as s" , "s.sale_id" , '=', "sales.id" )->orderBy("sales.id", "DESC")->paginate(25);
        // }
        
        // return view('backend.sales.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::get();
        $data['products'] = Product::get();
        $data['tables'] = DB::table("tables")->get();
        return view('backend.sales.create', $data);
    }

    public function receipt($id)
    {
        $data = [
            'sale' => Sale::findOrFail($id),
        ];

        return view('backend.sales.receipt', $data);
    }
    
    public function completeSale(Request $request)
    {
        $form = $request->all();
		$items = $request->input('items');
		$amount = 0;
		foreach($items as $item) { 
			$amount += $item['price'] * $item['quantity'];
		}	
		$amount += $request->input('vat') + $request->input('delivery_cost') - $request->input('discount');
		$form['amount'] = $amount;
		
		 $rules = Sale::$rules;
        $rules['items'] = 'required';

        $validator = Validator::make($form, $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                'errors' => $validator->errors()->all(),
                ], 400
            );
        }
        $sale = Sale::createAll($form);

        return url("sales/receipt/".$sale->id);
    }
    
    public function cancel($id)
    {
        Sale::where("id", $id)->update(array("status" => 0));
        return redirect("sales");
    }


    public function holdOrder(Request $request)
    {
        $id = $request->input("id");
        $comment = $request->input("comment");
        $table_id = $request->input("table_id");
        $cart = json_encode($request->input("cart"));
        if ($id) {
            DB::table("hold_order")->where("id", $id)->update(array("table_id" => $table_id,  "cart" => $cart, "comment" => $comment, "user_id" => Auth::user()->id));
            exit;
        }
        $table = DB::table("hold_order")->where("table_id", $table_id)->where("status" , 0)->count();
        if ($table > 0) {
            echo "Table already on Hold";
            exit;
        }
        DB::table("hold_order")->insert(array("table_id" => $table_id, "cart" => $cart, "comment" => $comment, "user_id" => Auth::user()->id));

    }

    public function viewHoldOrder(Request $request)
    {
        $id = $request->input("id");
        $order = DB::table("hold_order")->where("id", $id)->first();
        
        echo $order->cart;
    }

    public function holdOrders(Request $request)
    {
        $orders = DB::table("hold_order")->where("status", 0)->get();
        foreach ($orders as $order) {
            $user = User::find($order->user_id);
            $table = DB::table("tables")->where("id", $order->table_id)->first();
            $order->username = "";
            if (!empty($user)) {
                $order->username = $user->name;
                $order->table = "No Table Found";
                if(!empty($table))
                $order->table = $table->table_name;
            }
        }
        echo json_encode($orders);
    }

    public function removeHoldOrder(Request $request)
    {
        $id = $request->input("id");
        DB::table("hold_order")->where("id", $id)->update(array("status" => 1));
    }
	
    
}
