<?php

namespace App\Http\Controllers\WBS;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Datatables;
use Config;
use DB;
use Excel;

class WBSInventoryController extends Controller
{
    protected $mysql;
    protected $mssql;
    protected $common;
    protected $com;

    public function __construct()
    {
        $this->middleware('auth');
        $this->com = new CommonController;

        if (Auth::user() != null) {
            $this->mysql = $this->com->userDBcon(Auth::user()->productline,'wbs');
            $this->mssql = $this->com->userDBcon(Auth::user()->productline,'mssql');
            $this->common = $this->com->userDBcon(Auth::user()->productline,'common');
        } else {
            return redirect('/');
        }
    }

    public function index()
    {
        if(!$this->com->getAccessRights(Config::get('constants.MODULE_WBS_INV'), $userProgramAccess))
        {
            return redirect('/home');
        }
        else
        {
            # Render WBS Page.
            return view('wbs.wbsinventory',['userProgramAccess' => $userProgramAccess]);
        }
    }

    public function inventory_list()
    {
        $inv = DB::connection($this->mysql)->table('tbl_wbs_inventory')
                    ->orderBy('id','desc')
                    ->where('deleted',1)
                    ->select([
                        'id',
                        'wbs_mr_id',
                        'invoice_no',
                        'item',
                        'item_desc',
                        'qty',
                        'lot_no',
                        'location',
                        'supplier',
                        'not_for_iqc',
                        'iqc_status',
                        'judgement',
                        'create_user',
                        'received_date',
                        'exp_date',
                        'update_user',
                        'updated_at',
                        'mat_batch_id',
                        'loc_batch_id'
                    ]);
        return Datatables::of($inv)
                        ->editColumn('id', function($data) {
                            return $data->id;
                        })
                        ->editColumn('iqc_status', function($data) {
                            if ($data->iqc_status == 1) {
                                return 'Accept';
                            }

                            if ($data->iqc_status == 2) {
                                return 'Reject';
                            }

                            if ($data->iqc_status == 3) {
                                return 'On-going';
                            }

                            if ($data->iqc_status == 0) {
                                return 'Pending';
                            }
                        })
                        ->addColumn('action', function($data) {
                            return '<button class="btn btn-sm btn-primary btn_edit" data-id="'.$data->id.'"
                                    data-wbs_mr_id="'.$data->wbs_mr_id.'"
                                    data-invoice_no="'.$data->invoice_no.'"
                                    data-item="'.$data->item.'"
                                    data-item_desc="'.$data->item_desc.'"
                                    data-qty="'.$data->qty.'"
                                    data-lot_no="'.$data->lot_no.'"
                                    data-location="'.$data->location.'"
                                    data-supplier="'.$data->supplier.'"
                                    data-not_for_iqc="'.$data->not_for_iqc.'"
                                    data-iqc_status="'.$data->iqc_status.'"
                                    data-judgement="'.$data->judgement.'"
                                    data-mat_batch_id="'.$data->mat_batch_id.'"
                                    data-loc_batch_id="'.$data->loc_batch_id.'">
                                        <i class="fa fa-edit"></i>
                                    </button>';
                        })->make(true);
    }

    public function deleteselected(Request $req)
    {
        $data = [
            'msg' => "Deleting failed.",
            'status' => 'failed'
        ];
        foreach ($req->id as $key => $id) {
            $deleted = DB::connection($this->mysql)->table('tbl_wbs_inventory')
                        ->where('id',$id)
                        ->update(['deleted' => 1]);

            if ($deleted) {
                $data = [
                    'msg' => "Data were successfully deleted.",
                    'status' => 'success'
                ];
            }
        }

        return $data;
    }

    public function savedata(Request $req)
    {
        $result = "";
        $NFI = 0;
        if (isset($req->id)) {
            // $this->validate($req, [
            //     'item' => 'required',
            //     'item_desc' => 'required',
            // ]);
            $NFI = (isset($req->nr))?1:0;
            $UP = DB::connection($this->mysql)
                    ->table('tbl_wbs_inventory')
                    ->where('id',$req->id)
                    ->update([
                        'item' => $req->item,
                        'item_desc' => $req->item_desc,
                        'lot_no' => $req->lot_no,
                        'qty' => $req->qty,
                        'not_for_iqc'=> $NFI,
                        'location' => $req->location,
                        'supplier' => $req->supplier,
                        'iqc_status' => $req->status,
                        'update_user' => Auth::user()->user_id,
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]);


        $forID = DB::connection($this->mysql)->table('tbl_wbs_inventory')
                ->select('mat_batch_id', 'loc_batch_id')
                ->where('id',$req->id)
                ->first();
        if(isset($forID->mat_batch_id)){
            $mat = DB::connection($this->mysql)
                    ->table('tbl_wbs_material_receiving_batch')
                    ->where('id',$forID->mat_batch_id)
                    ->update([
                        'item' => $req->item,
                        'item_desc' => $req->item_desc,
                        'lot_no' => $req->lot_no,
                        'qty' => $req->qty,
                        'not_for_iqc'=> $NFI,
                        'location' => $req->location,
                        'supplier' => $req->supplier,
                        'iqc_status' => $req->iqc_status,
                        'update_user' => Auth::user()->user_id,
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]);
        }
        else{
            $local = DB::connection($this->mysql)
                    ->table('tbl_wbs_local_receiving_batch')
                    ->where('id',$forID->loc_batch_id)
                    ->update([
                        'item' => $req->item,
                        'item_desc' => $req->item_desc,
                        'lot_no' => $req->lot_no,
                        'qty' => $req->qty,
                        'not_for_iqc'=> $NFI,
                        'location' => $req->location,
                        'supplier' => $req->supplier,
                        'iqc_status' => $req->iqc_status,
                        'update_user' => Auth::user()->user_id,
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]);
        }
        $result ="Updated";
        }
        return response()->json($result);
    }

    public function cleanData()
    {
        $mats = DB::connection($this->mysql)->table('tbl_wbs_material_receiving')
                    ->select('receive_no','receive_date')->get();

        foreach ($mats as $key => $mat) {
            DB::connection($this->mysql)->table('tbl_wbs_inventory')
                ->where('wbs_mr_id',$mat->receive_no)
                ->update(['received_date' => $mat->receive_date]);
        }

        foreach ($mats as $key => $mat) {
            DB::connection($this->mysql)->table('tbl_wbs_material_receiving_batch')
                ->where('wbs_mr_id',$mat->receive_no)
                ->update(['received_date' => $mat->receive_date]);
        }

        $locs = DB::connection($this->mysql)->table('tbl_wbs_local_receiving')
                    ->select('receive_no','receive_date')->get();

        foreach ($locs as $key => $loc) {
            DB::connection($this->mysql)->table('tbl_wbs_inventory')
                ->where('wbs_mr_id',$loc->receive_no)
                ->update(['received_date' => $loc->receive_date]);
        }

        foreach ($locs as $key => $loc) {
            DB::connection($this->mysql)->table('tbl_wbs_local_receiving_batch')
                ->where('wbs_loc_id',$loc->receive_no)
                ->update(['received_date' => $loc->receive_date]);
        }

        $check = DB::connection($this->mysql)->table('tbl_wbs_inventory')
                    ->where('received_date','0000-00-00')
                    ->select('item','lot_no','received_date','exp_date')
                    ->count();

        if ($check < 1) {
            $inv = DB::connection($this->mysql)->table('tbl_wbs_inventory')
                        ->select('item','lot_no','received_date','exp_date')
                        ->groupBy('item','lot_no','received_date','exp_date')
                        ->get();

            foreach ($inv as $key => $in) {
                DB::connection($this->mysql)
                    ->select(
                        DB::raw(
                            "CALL RecalculateInventory(
                            '".$in->item."',
                            '".$in->lot_no."')"
                        )
                    );
            }
        }


        // return $inv;

        
    }
}