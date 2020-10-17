<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tables' => Table::paginate(20),
        ];

        return view('backend.tables.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
		unset($data['_token']);
		unset($data['id']);

		 if($request->input("id")) { 
            Table::where("id", $request->input("id"))->update($data);
			return redirect('tables')
            ->with('message-success', 'Table updated!');
        } else { 
            Table::insert($data);
			return redirect('tables')
            ->with('message-success', 'Table created!');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Table::findOrFail($id);

        return view('backend.tables.show', compact('expense'));
    }

     public function get(Request $request) 
    { 
        $id = $request->input("id");
        $expnese = Table::where("id", $id)->first();
        echo json_encode($expnese);
    }


    public function delete(Request $request)
    {
        $id = $request->input("id");
        $expnese = Table::where("id", $id)->delete();
        echo json_encode($expnese);
    }
     
     
	 

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Table::findOrFail($id);
        $expense->delete();

        return redirect('expenses')
            ->with('message-success', 'Table deleted!');
    }
}
