<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use Yajra\Datatables\Datatables;
use App\Models\Exchange_rate;

// LIBRARIES
use App\Libraries\Helper;


class ExchangeRateController extends Controller
{

    // SET THIS MODULE
    private $module = 'ExchangeRate';
    // SET THIS OBJECT/ITEM NAME
    private $item = 'exchangeRate';

    public function index()
    {
    // AUTHORIZING...
    $authorize = Helper::authorizing($this->module, 'View List');
    if ($authorize['status'] != 'true') {
        return back()->with('error', $authorize['message']);
    }
        $links = exchange_rate::all();
        // dd($applink);
        return view('admin.exchange_rate.index', compact('links'));
    }

    public function create()
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        return view('admin.exchange_rate.create');
    }

    public function store(Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Add New');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }

        $exchange_rate = new exchange_rate;
        $exchange_rate->currency = $request->input('currency');
        $exchange_rate->tt_buy = $request->input('tt_buy');
        $exchange_rate->tt_sell = $request->input('tt_sell');

        // dd($applink);


 // SAVE THE DATA

        try {
            if( $exchange_rate->save() ){
            // SUCCESS
            return redirect()->route('admin.exchange_rates.list')->with('success','Exchange_rates has been created successfully.');
            }
       } catch (QueryException $e) {
            // FAILED
           return back()
           ->withInput()
           ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));

       }



    }

    public function show($id)
    {

    }
    public function edit($id)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'View Details');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $exchange_rate = exchange_rate::findOrFail($id);
        return view('admin.exchange_rate.edit', compact('exchange_rate'));
    }

    public function update($id, Request $request)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Edit');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $exchange_rate = exchange_rate::findOrFail($id);
        $exchange_rate->currency = $request->input('currency');
        $exchange_rate->tt_buy = $request->input('tt_buy');
        $exchange_rate->tt_sell = $request->input('tt_sell');

        // dd($applink)

        try {
            if( $exchange_rate->update() ){
            // SUCCESS
            return redirect()->route('admin.exchange_rates.list')->with('success','Exchange_rates has been created successfully.');
            }
       } catch (QueryException $e) {
            // FAILED
           return back()
           ->withInput()
           ->with('error', lang('Oops, failed to add a new #item. Please try again.', $this->translation, ['#item' => $this->item]));

       }

    }


    public function destroy($id)
    {
        // AUTHORIZING...
        $authorize = Helper::authorizing($this->module, 'Delete');
        if ($authorize['status'] != 'true') {
            return back()->with('error', $authorize['message']);
        }
        $exchange_rate = exchange_rate::findOrFail($id);

        $exchange_rate->delete();
        return redirect()->route('admin.exchange_rates.list')->with('success','exchange_rates has been deleted successfully.');
    }

}
