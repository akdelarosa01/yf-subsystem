<?php
namespace App\Http\Controllers\QCDB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use DB;
use Config;
use App\OQCInspection;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth; #Auth facade
use Illuminate\Http\Request;
use App\Http\Requests;
use PDF;
use Carbon\Carbon;
use Excel;

class OQCInspectionController extends Controller
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
            $this->mysql = $this->com->userDBcon(Auth::user()->productline,'mysql');
            $this->mssql = $this->com->userDBcon(Auth::user()->productline,'mssql');
            $this->common = $this->com->userDBcon(Auth::user()->productline,'common');
        } else {
            return redirect('/');
        }
    }

    public function index()
    {
        if(!$this->com->getAccessRights(Config::get('constants.MODULE_CODE_OQCDB')
                                    , $userProgramAccess))
        {
            return redirect('/home');
        }
        else
        {
            return view('qcdb.oqcinspection',['userProgramAccess' => $userProgramAccess]);
        }
    }

    public function initData()
    {
        $displaymod = DB::connection($this->mysql)->table('oqc_inspections_mod')->get();
        $countrecords = DB::connection($this->mysql)->table('oqc_inspections')->count();
        $family = $this->com->getDropdownByName('Family');
        //$family = $this->com->getDropdownByName('Family');
        $tofinspection = $this->com->getDropdownByName('Type of Inspection');
        $sofinspection = $this->com->getDropdownByName('Severity of Inspection');
        $inspectionlvl = $this->com->getDropdownByName('Inspection Level');
        $assemblyline = $this->com->getDropdownByName('Assembly Line');
        $aql = $this->com->getDropdownByName('AQL');
        $shift = $this->com->getDropdownByName('Shift');
        $submission = $this->com->getDropdownByName('Submission');
        $shift = $this->com->getDropdownByName('Shift');
        $mod = $this->com->getDropdownByName('Mode of Defect - OQC Inscpection Molding');

        return $data = [
            'oqcmod'=>$displaymod,
            'families' =>$family,
            'tofinspections' => $tofinspection,
            'sofinspections' => $sofinspection,
            'inspectionlvls' =>$inspectionlvl,
            'aqls' =>$aql,
            'shifts' =>$shift,
            'submissions'=>$submission,
            'mods'=>$mod,
            'assemblyline'=>$assemblyline,
            'count'=>$countrecords
        ];
    }

    public function getmodoqc(Request $request){
        $pono = $request->pono;
        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')->select('mod')->where('pono',$pono)->get();
        return $table;
    }

    public function OQCDataTable(Request $req)
    {
        $output = '';
        $po = '';
        $date = '';
        $select = [
                    'id',
                    'fy',
                    'ww',
                    'date_inspected',
                    'device_name',
                    'time_ins_from',
                    'time_ins_to',
                    'submission',
                    'lot_qty',
                    'sample_size',
                    'num_of_defects',
                    'lot_no',
                    'po_qty',
                    'judgement',
                    'inspector',
                    'remarks',
                    'type',
                    'shift',
                    'assembly_line',
                    'app_date',
                    'app_time',
                    'prod_category',
                    'po_no',
                    'customer',
                    'family',
                    'type_of_inspection',
                    'severity_of_inspection',
                    'inspection_lvl',
                    'aql',
                    'accept',
                    'reject',
                    'coc_req',
                    'lot_inspected',
                    'lot_accepted'
                ];

        if ($req->type == 'search') {
            if (!empty($req->search_po) || $req->pono !== '') {
                $po = " AND po_no = '".$req->search_po."'";
            }

            if ($req->search_from !== '' || !empty($req->search_from)) {
                $date = " AND date_inspected BETWEEN '".$this->com->convertDate($req->search_from,'Y-m-d').
                        "' AND '".$this->com->convertDate($req->search_to,'Y-m-d')."'";
            }

            $query = DB::connection($this->mysql)->table('oqc_inspections')
                        ->whereRaw("1=1".$po.$date)
                        ->orderBy('id','desc')
                        ->select($select);
        } else {
            $query = DB::connection($this->mysql)->table('oqc_inspections')
                    ->orderBy('id','desc')
                    ->select($select);
        }

        return Datatables::of($query)
                        ->editColumn('id', function($data) {
                            return $data->id;
                        })
                        ->addColumn('action', function($data) {
                            return '<button type="button" class="btn btn-sm btn-primary btn_edit_inspection" data-id="'.$data->id.'" data-assembly_line="'.$data->assembly_line.'" data-app_date="'.$data->app_date.'" data-app_time="'.$data->app_time.'" data-lot_no="'.$data->lot_no.'" data-prod_category="'.$data->prod_category.'" data-po_no="'.$data->po_no.'" data-device_name="'.$data->device_name.'" data-customer="'.$data->customer.'" data-po_qty="'.$data->po_qty.'" data-family="'.$data->family.'" data-type_of_inspection="'.$data->type_of_inspection.'" data-severity_of_inspection="'.$data->severity_of_inspection.'" data-inspection_lvl="'.$data->inspection_lvl.'" data-aql="'.$data->aql.'" data-accept="'.$data->accept.'" data-reject="'.$data->reject.'" data-date_inspected="'.$data->date_inspected.'" data-ww="'.$data->ww.'" data-fy="'.$data->fy.'" data-shift="'.$data->shift.'" data-time_ins_from="'.$data->time_ins_from.'" data-time_ins_to="'.$data->time_ins_to.'" data-inspector="'.$data->inspector.'" data-submission="'.$data->submission.'" data-coc_req="'.$data->coc_req.'" data-judgement="'.$data->judgement.'" data-lot_qty="'.$data->lot_qty.'" data-sample_size="'.$data->sample_size.'" data-lot_inspected="'.$data->lot_inspected.'" data-lot_accepted="'.$data->lot_accepted.'" data-num_of_defects="'.$data->num_of_defects.'" data-remarks="'.$data->remarks.'" data-type="'.$data->type.'">'.
                                '   <i class="fa fa-edit"></i> '.
                            '</button>';
                        })
                        ->addColumn('fyww', function($data) {
                            return $data->fy.' - '.$data->ww;
                        })
                        ->addColumn('mod', function($data) use($req,$output) {
                            if ($data->judgement == 'Accept') {
                                return 'NDF';
                            } else {
                                if($req->report_status == "GROUPBY"){
                                    $table = DB::connection($this->mysql)->table('oqc_inspections_mod')
                                        ->select('pono',DB::raw("(GROUP_CONCAT(mod1 SEPARATOR ' , ')) AS mod1"),DB::raw("(GROUP_CONCAT(lotno SEPARATOR ' , ')) AS lot_no"),'submission','qty')
                                        ->groupBy('pono','submission','device')
                                        ->get();
                                       
                                } else {
                                    $table = DB::connection($this->mysql)->table('oqc_inspections as a')
                                        ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                                        ->select('a.po_no',
                                                'b.mod1',
                                                'a.lot_no',
                                                'a.submission')
                                        ->where('b.pono',$data->po_no)
                                        ->where('a.lot_no',$data->lot_no)
                                        ->where('a.submission',$data->submission)
                                        ->get();
                                }

                                foreach ($table as $key => $data) {
                                    $output[$key] = 'ok';//$data->mod1;
                                    // $output['lotno'][$key] = $data->lot_no;
                                }

                                return $output;
                            }
                        })
                        ->make(true);
    }

    public function getPOdetails(Request $req)
    {
        if (!empty($req->po)) {
            if ($req->is_probe > 0) {
                $msrecords = DB::connection($this->mssql)
                            ->select("SELECT R.SORDER as po,
                                            HK.CODE as device_code,
                                            H.NAME as device_name,
                                            R.CUST as customer_code,
                                            C.CNAME as customer_name,
                                            HK.KVOL as po_qty,
                                            I.BUNR
                                    FROM XRECE as R
                                    LEFT JOIN XSLIP as S on R.SORDER = S.SEIBAN
                                    LEFT JOIN XHIKI as HK on S.PORDER  = HK.PORDER
                                    LEFT JOIN XHEAD as H ON HK.CODE = H.CODE
                                    LEFT JOIN XITEM as I ON HK.CODE = I.CODE
                                    LEFT JOIN XCUST as C ON R.CUST = C.CUST
                                    WHERE R.SORDER like '".$req->po."%'
                                    AND I.BUNR = 'PROBE'");
            } else {
                $msrecords = DB::connection($this->mssql)
                                ->table('XRECE as R')
                                ->leftJoin('XHEAD as H','R.CODE','=','H.CODE')
                                ->leftJoin('XCUST as C','R.CUST','=','C.CUST')
                                ->where('R.SORDER','like',$req->po."%")
                                ->select(DB::raw('R.SORDER as po'),
                                        DB::raw('R.CODE as device_code'),
                                        DB::raw('H.NAME as device_name'),
                                        DB::raw('R.CUST as customer_code'),
                                        DB::raw('C.CNAME as customer_name'),
                                        DB::raw('SUM(R.KVOL) as po_qty'))
                                ->groupBy('R.SORDER',
                                        'R.CODE',
                                        'H.NAME',
                                        'R.CUST',
                                        'C.CNAME')
                                ->get();
            }
        }
        
        return $msrecords;
    }

    public function getProbeProduct(Request $req)
    {
        $msrecords = DB::connection($this->mssql)->table('XHEAD AS H')
                        ->leftJoin('XPRTS as R','H.CODE','=','R.CODE')
                        ->where('R.KCODE',$req->code)
                        ->select('R.CODE as devicecode',
                                'H.NAME as DEVNAME',
                                'R.KCODE as partcode')
                        ->get();
        return $msrecords;
    }

    public function ModDataTable(Request $req)
    {
        $select = [
                    'id',
                    'pono',
                    'device',
                    'lotno',
                    'submission',
                    'mod1',
                    'qty'
                ];

        $query = DB::connection($this->mysql)->table('oqc_inspections_mod')
                    ->where('pono',$req->pono)
                    // ->where('device',$req->device)
                    // ->where('lotno',$req->lotno)
                    ->where('submission',$req->submission)
                    ->orderBy('id','desc')
                    ->select($select);
        return Datatables::of($query)
                        ->editColumn('id', function($data) {
                            return $data->id;
                        })
                        ->addColumn('action', function($data) {
                            return '<button type="button" class="btn btn-sm btn-primary btn_edit_mod" data-id="'.$data->id.'"'.
                                    ' data-pono="'.$data->pono.'" data-device="'.$data->device.'" data-lotno="'.$data->lotno.'"'.
                                    ' data-submission="'.$data->submission.'" data-mod1="'.$data->mod1.'" data-qty="'.$data->qty.'">'.
                                        '<i class="fa fa-edit"></i>'.
                                    '</button>';
                        })
                        ->make(true);
    }

    private function validateInspection($req)
    {
        $rules = [
            'assembly_line' => 'required',
            'lot_no' => 'required',
            'app_date' => 'required',
            'app_time' => 'required',
            'prod_category' => 'required',
            'po_no' => 'required',
            'series_name' => 'required',
            'customer' => 'required',
            'po_qty' => 'required|numeric',
            'family' => 'required',
            'type_of_inspection' => 'required',
            'severity_of_inspection' => 'required',
            'inspection_lvl' => 'required',
            'aql' => 'required',
            'date_inspected' => 'required',
            'shift' => 'required',
            'time_ins_from' => 'required',
            'time_ins_to' => 'required',
            'submission' => 'required',
            'coc_req' => 'required',
            'judgement' => 'required',
            'lot_qty' => 'required|numeric',
            'sample_size' => 'required|numeric',
            'lot_inspected' => 'required',
            'lot_accepted' => 'required',
        ];

        $msg = [
            'assembly_line.required' => 'Assembly Line is required.',
            'lot_no.required' => 'Lot number is required.',
            'app_date.required' => 'Application Date is required.',
            'app_time.required' => 'Application Time is required.',
            'prod_category.required' => 'Production Category is required.',
            'po_no.required' => 'P.O. number is required.',
            'series_name.required' => 'Series name is required.',
            'customer.required' => 'Customer is required.',
            'po_qty.required' => 'P.O. Quantity is required.',
            'po_qty.numeric' => 'P.O. Quantity must be numeric',
            'family.required' => 'Family is required.',
            'type_of_inspection.required' => 'Type of Inspection is required.',
            'severity_of_inspection.required' => 'Severity of Inspection is required.',
            'inspection_lvl.required' => 'Inspection Level is required.',
            'aql.required' => 'AQL is required.',
            'date_inspected.required' => 'Date Inspected is required.',
            'shift.required' => 'Shift is required.',
            'time_ins_from.required' => 'Time inspection from is required.',
            'time_ins_to.required' => 'Time inspection to is required.',
            'submission.required' => 'Submission is required.',
            'coc_req.required' => 'COC Requirements is required.',
            'judgement.required' => 'Judgement is required.',
            'lot_qty.required' => 'Lot Quantity is required.',
            'lot_qty.numeric' => 'Lot Quantity must be numeric',
            'sample_size.required' => 'Sample Size is required.',
            'sample_size.numeric' => 'Sample Size must be numeric',
            'lot_inspected.required' => 'Lot Inspected is required.',
            'lot_accepted.required' => 'Lot Accepted is required.',
        ];

        return $this->validate($req, $rules, $msg);
    }

    public function saveInspection(Request $req)
    {
        $this->validateInspection($req);

        $data = [
            'msg' => 'Saving failed.',
            'status' => 'failed'

        ];

        $values = [
                    'assembly_line' => $req->assembly_line,
                    'lot_no' => $req->lot_no,
                    'app_date' => $this->com->convertDate($req->app_date,'Y-m-d'),
                    'app_time' => $req->app_time,
                    'prod_category' => $req->prod_category,
                    'po_no' => $req->po_no,
                    'device_name' => $req->series_name,
                    'customer' => $req->customer,
                    'po_qty' => $req->po_qty,
                    'family' => $req->family,
                    'type_of_inspection' => $req->type_of_inspection,
                    'severity_of_inspection' => $req->severity_of_inspection,
                    'inspection_lvl' => $req->inspection_lvl,
                    'aql' => $req->aql,
                    'accept' => $req->accept,
                    'reject' => $req->reject,
                    'date_inspected' => $this->com->convertDate($req->date_inspected,'Y-m-d'),
                    'ww' => $req->ww,
                    'fy' => $req->fy,
                    'time_ins_from' => $req->time_ins_from,
                    'time_ins_to' => $req->time_ins_to,
                    'shift' => $req->shift,
                    'inspector' => $req->inspector,
                    'submission' => $req->submission,
                    'coc_req' => $req->coc_req,
                    'judgement' => $req->judgement,
                    'lot_qty' => $req->lot_qty,
                    'sample_size' => $req->sample_size,
                    'lot_inspected' => $req->lot_inspected,
                    'lot_accepted' => $req->lot_accepted,
                    'lot_rejected' => ($req->lot_accepted == 1)? 0 : 1,
                    'num_of_defects' => ($req->lot_accepted == 1)? 0 : $req->no_of_defects,
                    'remarks' => $req->remarks,
                    'type'=> ($req->is_probe == 1)? 'PROBE PIN':'IC SOCKET',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

        if ($req->inspection_save_status == 'ADD') {
            $query = DB::connection($this->mysql)->table("oqc_inspections")
                        ->insert($values);
        } else {
            $query = DB::connection($this->mysql)->table("oqc_inspections")
                        ->where('id',$req->inspection_id)
                        ->update($values);
        }

        if ($query) {
            $data = [
                'msg' => 'Inspection Successfully saved.',
                'status' => 'success'

            ];
        }

        return $data;
    }

    public function deleteInspection(Request $req)
    {
        $data = [
            'msg' => 'Deleting failed.',
            'status' => 'failed'
        ];

        $delete = DB::connection($this->mysql)->table('oqc_inspections')
                    ->whereIn('id',$req->ids)
                    ->delete();
        if ($delete) {
            $data = [
                'msg' => 'Successfully deleted.',
                'status' => 'success'
            ];
        }

        return $data;
    }

    public function getWorkWeek()
    {
        $yr = 52;
        $apr = date('Y').'-04-01';
        $aprweek = date("W", strtotime($apr));

        $diff = $yr - $aprweek;
        $date = Carbon::now();
        $weeknow = $date->format("W");

        $workweek = $diff + $weeknow;
        return $workweek;
    }

    private function validateModeOfDefects($req)
    {
        $rules = [
            'mode_of_defects_name' => 'required',
            'mod_qty' => 'required|numeric',
        ];

        $msg = [
            'mode_of_defects_name.required' => 'Mode of defect is required.',
            'mod_qty.required' => 'Mode quantity is required.',
            'mod_qty.numeric' => 'Mode quantity must be numeric.'
        ];

        return $this->validate($req, $rules, $msg);
    }

    public function saveModeOfDefects(Request $req)
    {
        $this->validateModeOfDefects($req);

        $data = [
            'msg' => 'Saving failed.',
            'status' => 'failed'
        ];

        if ($req->mode_save_status == 'ADD') {
            $query = DB::connection($this->mysql)->table('oqc_inspections_mod')
                        ->insert([
                            'pono' => $req->mod_po,
                            'device' => $req->mod_device,
                            'lotno' => $req->mod_lotno,
                            'submission' => $req->mod_submission,
                            'mod1' => $req->mode_of_defects_name,
                            'qty' => $req->mod_qty,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
        } else {
            $query = DB::connection($this->mysql)->table('oqc_inspections_mod')
                        ->where('id', $req->mod_id)
                        ->update([
                            'pono' => $req->mod_po,
                            'device' => $req->mod_device,
                            'lotno' => $req->mod_lotno,
                            'submission' => $req->mod_submission,
                            'mod1' => $req->mode_of_defects_name,
                            'qty' => $req->mod_qty,
                            'updated_at' => Carbon::now(),
                        ]);
        }

        if ($query) {
            $data = [
                'msg' => 'Mode of defects successfully saved.',
                'status' => 'success',
            ];
        }
    }

    public function deleteModeOfDefects(Request $req)
    {
        $data = [
            'msg' => 'Deleting failed.',
            'status' => 'failed'
        ];

        $delete = DB::connection($this->mysql)->table('oqc_inspections_mod')
                    ->whereIn('id',$req->ids)
                    ->delete();
        if ($delete) {
            $data = [
                'msg' => 'Successfully deleted.',
                'status' => 'success'
            ];
        }

        return $data;
    }

    public function PDFReport(Request $req)
    {
        $date = '';
        $po = '';
        $sums = [];

        if ($req->from !== '' || !empty($req->from)) {
            $date = " AND a.date_inspected BETWEEN '".$this->com->convertDate($req->from,'Y-m-d').
                    "' AND '".$this->com->convertDate($req->to,'Y-m-d')."'";
        }

        if ($req->po !== '' || !empty($req->po)) {
            $po = " AND a.po_no = '".$req->po."'";
            $sums = DB::connection($this->mysql)->table('oqc_inspections as a')
                        ->select(DB::raw("SUM(a.lot_qty) as lot_qty"),DB::raw('a.po_qty as po_qty'))
                        ->whereRaw('1=1'.$po)
                        ->where('a.submission',$req->submission)
                        ->first();
        }

        $details = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b', function ($join) {
                    $join->on('a.po_no','=','b.pono');
                    $join->on('a.submission','=','b.submission');
                })
                ->whereRaw("1=1".$po.$date)
                ->groupBy('a.po_no','a.lot_no','a.submission')
                ->orderBy('id','desc')
                ->select('a.id'
                    ,DB::raw('a.fy as fy')
                    ,DB::raw('a.ww as ww')
                    ,DB::raw('a.date_inspected as date_inspected')
                    ,DB::raw('a.shift as shift')
                    ,DB::raw('a.time_ins_from as time_ins_from')
                    ,DB::raw('a.time_ins_to as time_ins_to')
                    ,DB::raw('a.submission as submission')
                    ,DB::raw('a.lot_qty as lot_qty')
                    ,DB::raw('a.sample_size as sample_size')
                    ,DB::raw('a.num_of_defects as num_of_defects')
                    ,DB::raw('a.lot_no as lot_no')
                    ,DB::raw('b.mod1 as mod1')
                    ,DB::raw("IFNULL(SUM(b.qty),0) as qty")
                    ,DB::raw('a.judgement as judgement')
                    ,DB::raw('a.inspector as inspector')
                    ,DB::raw('a.remarks as remarks')
                    ,DB::raw('a.assembly_line as assembly_line')
                    ,DB::raw('a.app_date as app_date')
                    ,DB::raw('a.app_time as app_time')
                    ,DB::raw('a.prod_category as prod_category')
                    ,DB::raw('a.po_no as po_no')
                    ,DB::raw('a.device_name as device_name')
                    ,DB::raw('a.customer as customer')
                    ,DB::raw('a.po_qty as po_qty')
                    ,DB::raw('a.family as family')
                    ,DB::raw('a.type_of_inspection as type_of_inspection')
                    ,DB::raw('a.severity_of_inspection as severity_of_inspection')
                    ,DB::raw('a.inspection_lvl as inspection_lvl')
                    ,DB::raw('a.aql as aql')
                    ,DB::raw('a.accept as accept')
                    ,DB::raw('a.reject as reject')
                    ,DB::raw('a.coc_req as coc_req')
                    ,DB::raw('a.lot_inspected as lot_inspected')
                    ,DB::raw('a.lot_accepted as lot_accepted')
                    ,DB::raw('a.dbcon as dbcon')
                    ,DB::raw("IF(judgement = 'Accept','NDF',a.modid) as modid")
                    ,DB::raw('a.type as type'))
                ->get();
        

        $dt = Carbon::now();
        $company_info = $this->com->getCompanyInfo();
        $date = substr($dt->format('  M j, Y  h:i A '), 2);

        $data = [
            'company_info' => $company_info,
            'details' => $details,
            'sums' => $sums,
            'date' => $date,
            'po' => $req->po
        ];

        $pdf = PDF::loadView('pdf.oqc', $data)
                    ->setPaper('A4')
                    ->setOption('margin-top', 10)->setOption('margin-bottom', 5)
                    ->setOrientation('landscape');

        return $pdf->inline('OQC_Inspection_'.Carbon::now());
    }

    public function ExcelReport(Request $req)
    {
        $dt = Carbon::now();
        $dates = substr($dt->format('Ymd'), 2);
        
        Excel::create('OQC_Inspection_Report'.$dates, function($excel) use($req)
        {
            $excel->sheet('Sheet1', function($sheet) use($req)
            {
                $date = '';
                $po = '';
                $sums = [];

                if ($req->from !== '' || !empty($req->from)) {
                    $date = " AND a.date_inspected BETWEEN '".$this->com->convertDate($req->from,'Y-m-d').
                    "' AND '".$this->com->convertDate($req->to,'Y-m-d')."'";
                }

                if ($req->po !== '' || !empty($req->po)) {
                    $po = " AND a.po_no = '".$req->po."'";
                    $sums = DB::connection($this->mysql)->table('oqc_inspections as a')
                                ->select(DB::raw("SUM(a.lot_qty) AS lot_qty"),DB::raw('a.po_qty as po_qty'))
                                ->whereRaw('1=1'.$po)
                                ->where('a.submission',$req->submission)
                                ->first();
                }

                $details = DB::connection($this->mysql)->table('oqc_inspections as a')
                        ->leftJoin('oqc_inspections_mod as b', function ($join) {
                            $join->on('a.po_no','=','b.pono');
                            $join->on('a.submission','=','b.submission');
                        })
                        ->whereRaw("1=1".$po.$date)
                        ->groupBy('a.po_no','a.lot_no','a.submission')
                        ->orderBy('id','desc')
                        ->select('a.id'
                            ,DB::raw('a.fy as fy')
                            ,DB::raw('a.ww as ww')
                            ,DB::raw('a.date_inspected as date_inspected')
                            ,DB::raw('a.shift as shift')
                            ,DB::raw('a.time_ins_from as time_ins_from')
                            ,DB::raw('a.time_ins_to as time_ins_to')
                            ,DB::raw('a.submission as submission')
                            ,DB::raw('a.lot_qty as lot_qty')
                            ,DB::raw('a.sample_size as sample_size')
                            ,DB::raw('a.num_of_defects as num_of_defects')
                            ,DB::raw('a.lot_no as lot_no')
                            ,DB::raw('b.mod1 as mod1')
                            ,DB::raw("IFNULL(SUM(b.qty),0) as qty")
                            ,DB::raw('a.judgement as judgement')
                            ,DB::raw('a.inspector as inspector')
                            ,DB::raw('a.remarks as remarks')
                            ,DB::raw('a.assembly_line as assembly_line')
                            ,DB::raw('a.app_date as app_date')
                            ,DB::raw('a.app_time as app_time')
                            ,DB::raw('a.prod_category as prod_category')
                            ,DB::raw('a.po_no as po_no')
                            ,DB::raw('a.device_name as device_name')
                            ,DB::raw('a.customer as customer')
                            ,DB::raw('a.po_qty as po_qty')
                            ,DB::raw('a.family as family')
                            ,DB::raw('a.type_of_inspection as type_of_inspection')
                            ,DB::raw('a.severity_of_inspection as severity_of_inspection')
                            ,DB::raw('a.inspection_lvl as inspection_lvl')
                            ,DB::raw('a.aql as aql')
                            ,DB::raw('a.accept as accept')
                            ,DB::raw('a.reject as reject')
                            ,DB::raw('a.coc_req as coc_req')
                            ,DB::raw('a.lot_inspected as lot_inspected')
                            ,DB::raw('a.lot_accepted as lot_accepted')
                            ,DB::raw('a.dbcon as dbcon')
                            ,DB::raw("IF(judgement = 'Accept','NDF',a.modid) as modid")
                            ,DB::raw('a.type as type'))
                        ->get();
                

                if ($req->from !== '' || !empty($req->from)) {
                    $sheet->cell('C6', $details[0]->device_name);
                    $sheet->cell('C7', $details[0]->prod_category);
                    $sheet->cell('C8', $details[0]->po_no);
                    $sheet->cell('C9', $details[0]->po_qty);
                    $sheet->cell('F6', $details[0]->customer);
                    $sheet->cell('F7', $details[0]->coc_req);
                    $sheet->cell('F8', $details[0]->severity_of_inspection);
                    $sheet->cell('F9', $details[0]->inspection_lvl);
                    $sheet->cell('I6', $details[0]->aql);
                    $sheet->cell('I7', $details[0]->accept);
                    $sheet->cell('I8', $details[0]->reject);
                }

                $dt = Carbon::now();
                $com_info = $this->com->getCompanyInfo();

                $date = substr($dt->format('  M j, Y  h:i A '), 2);
       
                $sheet->setHeight(1, 15);
                $sheet->mergeCells('A1:P1');
                $sheet->cells('A1:P1', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cell('A1',$com_info['name']);

                $sheet->setHeight(2, 15);
                $sheet->mergeCells('A2:P2');
                $sheet->cells('A2:P2', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cell('A2',$com_info['address']);

                $sheet->setHeight(4, 20);
                $sheet->mergeCells('A4:P4');
                $sheet->cells('A4:P4', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFont([
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true,
                        'underline'  =>  true
                    ]);
                });
                $sheet->cell('A4',"MATERIAL KITTING LIST SUMMARY");

                $sheet->setHeight(6, 20);
                $sheet->setHeight(7, 20);
                $sheet->setHeight(8, 20);
                $sheet->setHeight(9, 20);

                $sheet->cell('B6',"Service Name");
                $sheet->cell('B7',"Category");
                $sheet->cell('B8',"P.O Number");
                $sheet->cell('B9',"P.O Quantity");

                $sheet->cell('E6',"Customer Name");
                $sheet->cell('E7',"COC Requirements");
                $sheet->cell('E8',"Severity of Inspection");
                $sheet->cell('E9',"Inspection Level");

                $sheet->cell('H6',"AQL");
                $sheet->cell('H7',"Ac");
                $sheet->cell('H8',"Re");

                $sheet->setHeight(11, 15);
                $sheet->cells('A11:p11', function($cells) {
                    $cells->setFont([
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true,
                    ]);
                    // Set all borders (top, right, bottom, left)
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });



                $sheet->cell('B11',"FY-WW");
                $sheet->cell('C11',"Date Inspected");
                $sheet->cell('D11',"Device Name");
                $sheet->cell('E11',"From");
                $sheet->cell('F11',"To");
                $sheet->cell('G11',"# of Sub");
                $sheet->cell('H11',"Lot Size");
                $sheet->cell('I11',"Sample Size");
                $sheet->cell('J11',"No of Defective");
                $sheet->cell('K11',"Lot No");
                $sheet->cell('L11',"Mode of Defects");
                $sheet->cell('M11',"Qty");
                $sheet->cell('N11',"Judgement");
                $sheet->cell('O11',"Inspector");
                $sheet->cell('P11',"Remarks");

                $row = 12;

                foreach ($details as $key => $qc) {
                    $sheet->cell('B'.$row, $qc->fy.' - '.$qc->ww);
                    $sheet->cell('C'.$row, $qc->date_inspected);
                    $sheet->cell('D'.$row, $qc->device_name);
                    $sheet->cell('E'.$row, $qc->time_ins_from);
                    $sheet->cell('F'.$row, $qc->time_ins_to);
                    $sheet->cell('G'.$row, $qc->submission);
                    $sheet->cell('H'.$row, $qc->lot_qty);
                    $sheet->cell('I'.$row, $qc->sample_size);
                    $sheet->cell('J'.$row, $qc->num_of_defects);
                    $sheet->cell('K'.$row, $qc->lot_no);
                    $sheet->cell('L'.$row, $qc->modid);
                    $sheet->cell('M'.$row, $qc->po_qty);
                    $sheet->cell('N'.$row, $qc->judgement);
                    $sheet->cell('O'.$row, $qc->inspector);
                    $sheet->cell('P'.$row, $qc->remarks);

                    $sheet->row($row, function ($row) {
                        $row->setFontFamily('Calibri');
                        $row->setFontSize(11);
                    });
                    $sheet->setHeight($row,20);
                    $row++;
                }

                $row++;

                $sheet->row($row, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setAlignment('center');
                });
                $sheet->setHeight($row,20);

                $lot_qty = 0;
                $balance = 0;
                if(count($sums) > 0) {
                    $lot_qty = $sums->lot_qty;
                    $balance = $sums->po_qty - $sums->lot_qty;
                }

                $sheet->cell('B'.$row, "Total Qty:");
                $sheet->cell('C'.$row, $lot_qty);
                $sheet->cell('H'.$row, "Balance:");
                $sheet->cell('I'.$row, $balance);
                $sheet->cell('O'.$row, "Date:");
                $sheet->cell('P'.$row, $date);
            });

        })->download('xls');  
    }

    public function GroupByValues(Request $req){
        $data = DB::connection($this->mysql)->table('oqc_inspections')
                ->select($req->field.' as field')
                ->distinct()
                ->get();

        return $data;
    }

    public function CalculateDPPM(Request $req)
    {
        return $this->DPPMTables($req,false);
    }

    private function DPPMTables($req,$join)
    {
        $g1 = ''; $g2 = ''; $g3 = '';
        $g1c = ''; $g2c = ''; $g3c = '';
        $date_inspected = '';
        $groupBy = [];

        // wheres
        if (!empty($req->gfrom) && !empty($req->gto)) {
            $date_inspected = " AND date_inspected BETWEEN '".$this->com->convertDate($req->gfrom,'Y-m-d').
                            "' AND '".$this->com->convertDate($req->gto,'Y-m-d')."'";
        }

        if (!empty($req->field1) && !empty($req->content1)) {
            $g1c = " AND ".$req->field1."='".$req->content1."'";
        }

        if (!empty($req->field2) && !empty($req->content2)) {
            $g2c = " AND ".$req->field2."='".$req->content2."'";
        }

        if (!empty($req->field3) && !empty($req->content3)) {
            $g3c = " AND ".$req->field3."='".$req->content3."'";
        }

        if (!empty($req->field1)) {
            $g1 = $req->field1;
            array_push($groupBy, $g1);
        }

        if (!empty($req->field2)) {
            $g2 = $req->field2;
            array_push($groupBy, $g2);
        }

        if (!empty($req->field3)) {
            $g3 = $req->field3;
            array_push($groupBy, $g3);
        }

        $grp = implode(',',$groupBy);
        // $grby = substr($grp,0,-1);
        
        $grby = "";

        if (count($groupBy) > 0) {
            $grby = " GROUP BY ".$grp;
        }
        
        if ($join == false) {
            $db = DB::connection($this->mysql)
                    ->select("SELECT SUM(lot_qty) AS lot_qty,
                                    SUM(sample_size) AS sample_size,
                                    SUM(num_of_defects) AS num_of_defects,
                                    SUM(lot_accepted) AS lot_accepted,
                                    SUM(lot_rejected) AS lot_rejected,
                                    SUM(lot_inspected) AS lot_inspected,
                                    fy,ww,date_inspected,shift,
                                    time_ins_from,time_ins_to,submission,
                                    lot_no,judgement,inspector,remarks,
                                    assembly_line,customer,po_no,aql,
                                    prod_category,family,device_name
                                FROM oqc_inspections
                                WHERE 1=1".$date_inspected.$g1c.$g2c.$g3c.$grby);
        } else {

            $db = DB::connection($this->mysql)
                ->select("SELECT SUM(i.lot_qty) AS lot_qty,
                                SUM(i.sample_size) AS sample_size,
                                SUM(i.num_of_defects) AS num_of_defects,
                                SUM(i.lot_accepted) AS lot_accepted,
                                SUM(i.lot_rejected) AS lot_rejected,
                                SUM(i.lot_inspected) AS lot_inspected,
                                fy,ww,date_inspected,shift,
                                time_ins_from,time_ins_to,submission,
                                lot_no,judgement,inspector,remarks,
                                assembly_line,customer,po_no,aql,
                                prod_category,family,device_name
                            FROM oqc_inspections as i
                        LEFT JOIN oqc_inspections_mod as m ON i.po_no = m.pono
                        WHERE 1=1".$date_inspected.$g1c.$g2c.$g3c.$grby);
        }
        
        if ($this->com->checkIfExistObject($db) > 0) {
            return $db;
        }
    }












    public function getFamily(Request $request)
    {
        $msrecords = DB::connection($this->mssql)
                ->table('XITEM')
                ->select('BUNR AS family')
                ->distinct()
                ->get();
        return $msrecords;
    }

    public function getInvoiceDetails(Request $request)
    {
        $field = $request->invoiceno;
        // $invoiceno = $field['invoiceno'];
        $iqctable = DB::connection($this->mysql)->table('tbl_wbs_material_receiving as a')
                            ->join('tbl_wbs_material_receiving_batch as b','b.wbs_mr_id', '=','a.receive_no')
                            ->join('tbl_wbs_material_receiving_summary as c','c.wbs_mr_id','=','a.receive_no')
                            ->where('a.invoice_no','=',$field)
                            ->select('b.item')
                            ->distinct()
                            ->get();
        return $iqctable;
    }

    public function getpartcode(Request $request)
    {
        $partcode = $request->partcode;
        $invoiceno =  $request->invoiceno;
        $iqctable = DB::connection($this->mysql)->table('tbl_wbs_material_receiving as a')
                            ->join('tbl_wbs_material_receiving_batch as b','b.wbs_mr_id', '=','a.receive_no')
                            ->join('tbl_wbs_material_receiving_summary as c','c.wbs_mr_id','=','a.receive_no')
                            ->where('a.invoice_no','=',$invoiceno)
                            ->where('c.item','=',$partcode)
                            ->select('c.item_desc','b.supplier','b.box','b.lot_no','b.qty')
                            ->distinct()
                            ->get();
        return $iqctable;
    }

    public function getOQCInspectionData()
    {
        $data = OQCInspection::all();
        return Datatables::of($data)->make(true);
    }

    public function oqcdbdelete(Request $request)
    {  
        $tray = $request->tray;
        $traycount = $request->traycount;  
        if($traycount > 0){
            $ok = DB::connection($this->mysql)->table('oqc_inspections')->wherein('modid',$tray)->delete();
            $ok = DB::connection($this->mysql)->table('oqc_inspections_mod')->wherein('modid',$tray)->delete();
        } 
    }

    public function oqcsave(Request $request)
    {
        $status = $request->status;
        $modid = $request->modid;
        $judgement = $request->judgement;

        if($status == "ADD"){
            $lot_rejected = '';
            $nod = '';
           
            if($request->lotaccepted == 0){
                $lot_rejected = 1;
                $nod = $request->nofdefects;
            }else{
                $lot_rejected = 0;
                $nod = 0;
            }
            $ok = DB::connection($this->mysql)->table("oqc_inspections")
            ->insert([
                'assembly_line'=>$request->assemblyline,
                'lot_no'=>$request->lotno,
                'app_date'=>$this->com->convertDate($request->appdate,'Y-m-d'),
                'app_time'=>$request->apptime,
                'prod_category'=>$request->prodcategory,
                'po_no'=>$request->pono,
                'device_name'=>$request->seriesname,
                'customer'=>$request->customer,
                'po_qty'=>$request->poqty,
                'family'=>$request->family,
                'type_of_inspection'=>$request->typeofinspection,
                'severity_of_inspection'=> $request->severityofinspection,
                'inspection_lvl'=> $request->inspectionlvl,
                'aql'=>$request->aql,
                'accept'=>$request->accept,
                'reject'=>$request->reject,
                'date_inspected'=> $this->com->convertDate($request->dateinspected,'Y-m-d'),
                'ww'=>$request->ww,
                'fy'=>$request->fy,
                'shift'=>$request->shift,
                'time_ins_from'=>$request->timeinsfrom,
                'time_ins_to'=>$request->timeinsto,
                'inspector'=>$request->inspector,
                'submission'=>$request->submission,
                'coc_req'=>$request->cocreq,
                'judgement'=>$request->judgement,
                'lot_qty'=> $request->lotqty,
                'sample_size'=>$request->samplesize,
                'lot_inspected'=>$request->lotinspected,
                'lot_accepted'=>$request->lotaccepted,
                'lot_rejected'=>$lot_rejected,
                'num_of_defects'=>$nod,
                'remarks'=>$request->remarks,
                'dbcon'=>$request->dbcon,
                'modid'=>$modid,
                'type'=> $request->type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);  
            if($ok){
                $data['status'] = 'saved';
                return $data;
            }else{
                $data['status'] = 'error';
                return $data;
            }
        }
        if($status == "EDIT"){
            $countlot = $request->count_lot;
            $pono = $request->pono;
            $lotno = $request->lotno;
            $sub = $request->submission;
            $judgement = $request->judgement;
            $lotchanged = $request->lotchanged;
            if($lotchanged == "CHANGED"){
                if($judgement == "Accept"){
                    $lot_rejected = '';
                    if($request->lotaccepted == 0){
                        $lot_rejected = 1;
                    }else{
                        $lot_rejected = 0;
                    }
                    DB::connection($this->mysql)->table("oqc_inspections_mod")->where('pono',$pono)->where('lotno',$lotno)->delete();
                    DB::connection($this->mysql)->table("oqc_inspections")->where('po_no',$pono)->where('lot_no',$lotno)->where('submission','!=',"1st")->delete();
                    $updated = DB::connection($this->mysql)->table("oqc_inspections")
                        ->where('po_no',$pono)
                        ->where('lot_no',$lotno)
                        ->where('submission',$sub)
                        ->update(array(
                            'assembly_line'=>$request->assemblyline,
                            'lot_no'=>$request->lotno,
                            'app_date'=>$this->com->convertDate($request->appdate,'Y-m-d'),
                            'app_time'=>$request->apptime,
                            'prod_category'=>$request->prodcategory,
                            'po_no'=>$request->pono,
                            'device_name'=>$request->seriesname,
                            'customer'=>$request->customer,
                            'po_qty'=>$request->poqty,
                            'family'=>$request->family,
                            'type_of_inspection'=>$request->typeofinspection,
                            'severity_of_inspection'=> $request->severityofinspection,
                            'inspection_lvl'=> $request->inspectionlvl,
                            'aql'=>$request->aql,
                            'accept'=>$request->accept,
                            'reject'=>$request->reject,
                            'date_inspected'=> $this->com->convertDate($request->dateinspected,'Y-m-d'),
                            'ww'=>$request->ww,
                            'fy'=>$request->fy,
                            'shift'=>$request->shift,
                            'time_ins_from'=>$request->timeinsfrom,
                            'time_ins_to'=>$request->timeinsto,
                            'inspector'=>$request->inspector,
                            'submission'=>$request->submission,
                            'coc_req'=>$request->cocreq,
                            'judgement'=>$request->judgement,
                            'lot_qty'=> $request->lotqty,
                            'sample_size'=>$request->samplesize,
                            'lot_inspected'=>$request->lotinspected,
                            'lot_accepted'=>$request->lotaccepted,
                            'lot_rejected'=>$lot_rejected,
                            'num_of_defects'=>0,
                            'remarks'=>$request->remarks,
                            'dbcon'=>$request->dbcon,
                            'modid'=>$modid,
                            'type'=> $request->type,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ));  
                    if($updated){
                        $data['status'] = 'updated';
                        return $data;
                    }else{
                        $data['status'] = 'error';
                        return $data;
                    }
                } else {
                    $lot_rejected = '';
                    if($request->lotaccepted == 0){
                        $lot_rejected = 1;
                    }else{
                        $lot_rejected = 0;
                    }
                    $updated = DB::connection($this->mysql)->table("oqc_inspections")
                        ->where('po_no',$pono)
                        ->where('lot_no',$lotno)
                        ->where('submission',$sub)
                        ->update(array(
                            'assembly_line'=>$request->assemblyline,
                            'lot_no'=>$request->lotno,
                            'app_date'=>$this->com->convertDate($request->appdate,'Y-m-d'),
                            'app_time'=>$request->apptime,
                            'prod_category'=>$request->prodcategory,
                            'po_no'=>$request->pono,
                            'device_name'=>$request->seriesname,
                            'customer'=>$request->customer,
                            'po_qty'=>$request->poqty,
                            'family'=>$request->family,
                            'type_of_inspection'=>$request->typeofinspection,
                            'severity_of_inspection'=> $request->severityofinspection,
                            'inspection_lvl'=> $request->inspectionlvl,
                            'aql'=>$request->aql,
                            'accept'=>$request->accept,
                            'reject'=>$request->reject,
                            'date_inspected'=> $this->com->convertDate($request->dateinspected,'Y-m-d'),
                            'ww'=>$request->ww,
                            'fy'=>$request->fy,
                            'shift'=>$request->shift,
                            'time_ins_from'=>$request->timeinsfrom,
                            'time_ins_to'=>$request->timeinsto,
                            'inspector'=>$request->inspector,
                            'submission'=>$request->submission,
                            'coc_req'=>$request->cocreq,
                            'judgement'=>$request->judgement,
                            'lot_qty'=> $request->lotqty,
                            'sample_size'=>$request->samplesize,
                            'lot_inspected'=>$request->lotinspected,
                            'lot_accepted'=>$request->lotaccepted,
                            'lot_rejected'=>$lot_rejected,
                            'num_of_defects'=>$request->nofdefects,
                            'remarks'=>$request->remarks,
                            'dbcon'=>$request->dbcon,
                            'modid'=>$modid,
                            'type'=> $request->type,
                            'updated_at' => date('Y-m-d H:i:s'),
                    ));   

                    if($updated){
                        $data['status'] = 'updated';
                        return $data;
                    }else{
                        $data['status'] = 'error';
                        return $data;
                    }
                }            
            } else {
                $lot_rejected = '';
                if($request->lotaccepted == 0){
                    $lot_rejected = 1;
                }else{
                    $lot_rejected = 0;
                }

                $updated = DB::connection($this->mysql)->table("oqc_inspections")
                ->where('id',$request->id)
                ->update(array(
                    'assembly_line'=>$request->assemblyline,
                    'lot_no'=>$request->lotno,
                    'app_date'=>$this->com->convertDate($request->appdate,'Y-m-d'),
                    'app_time'=>$request->apptime,
                    'prod_category'=>$request->prodcategory,
                    'po_no'=>$request->pono,
                    'device_name'=>$request->seriesname,
                    'customer'=>$request->customer,
                    'po_qty'=>$request->poqty,
                    'family'=>$request->family,
                    'type_of_inspection'=>$request->typeofinspection,
                    'severity_of_inspection'=> $request->severityofinspection,
                    'inspection_lvl'=> $request->inspectionlvl,
                    'aql'=>$request->aql,
                    'accept'=>$request->accept,
                    'reject'=>$request->reject,
                    'date_inspected'=> $this->com->convertDate($request->dateinspected,'Y-m-d'),
                    'ww'=>$request->ww,
                    'fy'=>$request->fy,
                    'shift'=>$request->shift,
                    'time_ins_from'=>$request->timeinsfrom,
                    'time_ins_to'=>$request->timeinsto,
                    'inspector'=>$request->inspector,
                    'submission'=>$request->submission,
                    'coc_req'=>$request->cocreq,
                    'judgement'=>$request->judgement,
                    'lot_qty'=> $request->lotqty,
                    'sample_size'=>$request->samplesize,
                    'lot_inspected'=>$request->lotinspected,
                    'lot_accepted'=>$request->lotaccepted,
                    'lot_rejected'=>$lot_rejected,
                    'num_of_defects'=>$request->nofdefects,
                    'remarks'=>$request->remarks,
                    'dbcon'=>$request->dbcon,
                    'modid'=>$modid,
                    'type'=> $request->type,
                    'updated_at' => date('Y-m-d H:i:s'),
                ));   

                if($updated){
                    $data['status'] = 'updated';
                    return $data;
                }else{
                    $data['status'] = 'error';
                    return $data;
                }
            }  
        }    
    }

    public function oqcmodinspectionsave(Request $request)
    {
        $mod = $request->mod;
        $qty = $request->qty;
        $pono = $request->pono;
        $device = $request->device;
        $lotno = $request->lotno;
        $submission = $request->submission;
        $status = $request->status;
        $modid = $request->modid;
        $newmod = '';
        $newqty = '';
        if($request->lotaccepted == 0){
            $newmod = $mod;
            $newqty = $qty;
        }else{
            $newmod = "";
            $newqty = "";
        }
        if($status == "ADD"){
            DB::connection($this->mysql)->table('oqc_inspections_mod')
                ->insert([
                    'pono'=>$pono,
                    'device'=>$device,
                    'lotno'=>$lotno,
                    'submission'=>$submission,
                    'mod1'=>$newmod,
                    'qty'=>$newqty,
                    'modid'=>$modid,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        if($status == "EDIT"){
            $id = $request->id;
            DB::connection($this->mysql)->table('oqc_inspections_mod')
                ->where('id','=',$id)
                ->update(array(
                    'pono'=>$pono,
                    'device'=>$device,
                    'lotno'=>$lotno,
                    'submission'=>$submission,
                    'mod1'=>$newmod,
                    'qty'=>$newqty,
                    'modid'=>$modid,
                    'updated_at' => date('Y-m-d H:i:s'),
            ));
        }
        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')
                        ->where('pono',$pono)
                        ->where('lotno',$lotno)
                        ->where('submission',$submission)
                        ->select('qty','mod1','id')
                        ->get();
        return $table;
    }

    public function oqcmodinspectionedit(Request $request)
    {
        $id = $request->id;
        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')->where('id','=',$id)->get();   
        return $table;
    }

    public function oqcmodinspectiondelete(Request $request)
    {  
        $tray = $request->tray;
        $traycount = $request->traycount;  
       /* return $tray;  */
        if($traycount > 0){
            $ok = DB::connection($this->mysql)->table('oqc_inspections_mod')->wherein('id',$tray)->delete();
        }
        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')->where('pono','=',$request->pono)->where('lotno','=',$request->lotno)->get();   
       return $table;
    }

    public function get_no_of_defectives(Request $request){
        $pono = $request->pono;
        $lotno = $request->lotno;
        $sub = $request->submission;

        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')
                        ->where('pono',$pono)
                        ->where('lotno',$lotno)
                        ->where('submission',$sub)
                        ->select('mod1',DB::raw("SUM(qty) as qty"))
                        ->get();
        return $table;
    }

    public function displayoqcmod(Request $request){
        $pono = $request->pono;
        $lotno = $request->lotno;
        $sub = $request->submission;

        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')
                        ->where('pono',$pono)
                        ->where('lotno',$lotno)
                        ->where('submission',$sub)
                        ->select('qty','mod1','id')
                        ->get();
        return $table;
    }
    
    public function searchby(Request $request){
        $datefrom = $request->datefrom;
        $dateto = $request->dateto;
        $pono = $request->pono;

        if($pono == ""){
            $table = DB::connection($this->mysql)->table('oqc_inspections as a')
                    ->leftJoin('oqc_inspections_mod as b','a.po_no','=','b.pono')
                    ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission',DB::raw("SUM(a.lot_qty) as lot_qty"),'a.sample_size','a.num_of_defects','a.lot_no',DB::raw('b.mod1'),DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks' ,'a.assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon','a.modid')
                    ->whereBetween('date_inspected', [$datefrom,$dateto])
                    ->groupBy('a.po_no','a.lot_no','a.submission')
                    ->orderBy('a.lot_qty')
                    ->get();   
        }else{
            $table = DB::connection($this->mysql)->table('oqc_inspections as a')
                    ->leftJoin('oqc_inspections_mod as b','a.po_no','=','b.pono')
                    ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission',DB::raw("SUM(a.lot_qty) as lot_qty"),'a.sample_size','a.num_of_defects','a.lot_no',DB::raw('b.mod1'),DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks' ,'a.assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon','a.modid')                    
                    ->where('po_no',$pono)
                    ->whereBetween('date_inspected', [$datefrom,$dateto])
                    ->groupBy('a.po_no','a.lot_no','a.submission')
                    ->orderBy('a.lot_qty')
                    ->get();   
        }
        if($datefrom == "" && $dateto == ""){
            $table = DB::connection($this->mysql)->table('oqc_inspections as a')
                    ->leftJoin('oqc_inspections_mod as b','a.po_no','=','b.pono')
                    ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission',DB::raw("SUM(a.lot_qty) as lot_qty"),'a.sample_size','a.num_of_defects','a.lot_no',DB::raw('b.mod1'),DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks' ,'a.assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon','a.modid')
                    ->where('po_no',$pono)
                    ->groupBy('a.po_no','a.lot_no','a.submission')
                    ->orderBy('a.lot_qty')
                    ->get();     
        }
        
        return $table;
    }

    public function oqcdbgroupby(Request $request){        
        $datefrom = $request->data['datefrom'];
        $dateto = $request->data['dateto'];
        $g1 = $request->data['g1'];
        $g2 = $request->data['g2'];
        $g3 = $request->data['g3'];
        $g1content = $request->data['g1content'];
        $g2content = $request->data['g2content'];
        $g3content = $request->data['g3content'];
        $field='';
        if($g1){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->groupBy('a.'.$g1)
                ->orderBy('a.lot_qty')
                ->get();    
        }
        if($g1 && $g1content){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->where('a.'.$g1,'=',$g1content)
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->orderBy('a.lot_qty')
                ->get();        
        }
        if($g1 && $g2){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->groupBy('a.'.$g1,'a.'.$g2)
                ->orderBy('a.lot_qty')
                ->get();        
        }
        if($g1 && $g1content && $g2){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->where('a.'.$g1,'=',$g1content)
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->groupBy('a.'.$g1,'a.'.$g2)
                ->orderBy('a.lot_qty')
                ->get();        
        }
        if($g1 && $g1content && $g2 && $g2content){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->where('a.'.$g1,'=',$g1content)
                ->where('a.'.$g2,'=',$g2content)
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->groupBy('a.'.$g1,'a.'.$g2)
                ->orderBy('a.lot_qty')
                ->get();        
        }
        if($g1 && $g2 && $g3){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->groupBy('a.'.$g1,'a.'.$g2,'a.'.$g3)
                ->orderBy('a.lot_qty')
                ->get();        
        }
        if($g1 && $g1content && $g2 && $g2content && $g3 && $g3content){
            $field = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->where('a.'.$g1,'=',$g1content)
                ->where('a.'.$g2,'=',$g2content)
                ->where('a.'.$g3,'=',$g3content)
                ->select('a.id','a.fy','a.ww','a.date_inspected','a.shift','a.time_ins_from','a.time_ins_to','a.submission','a.lot_qty','a.sample_size','a.num_of_defects','a.lot_no','b.mod1',DB::raw("SUM(b.qty) as qty"),'a.judgement','a.inspector','a.remarks','assembly_line','a.app_date','a.app_time','a.prod_category','a.po_no','a.device_name','a.customer','a.po_qty','a.family','a.type_of_inspection','a.severity_of_inspection','a.inspection_lvl','a.aql','a.accept','a.reject','a.coc_req','a.lot_inspected','a.lot_accepted','a.dbcon')
                ->whereBetween('a.date_inspected',[$datefrom, $dateto])
                ->groupBy('a.'.$g1,'a.'.$g2,'a.'.$g3)
                ->orderBy('a.lot_qty')
                ->get();        
        }
        return $field;
    }

    public function oqcdbselectgroupby1(Request $request){        
        $g1 = $request->data;
        $table = DB::connection($this->mysql)->table('oqc_inspections')
                ->select($g1)
                ->distinct()
                ->get();

        return $table;
    }

    public function getlarlrrdppm(Request $request){
        $datefrom = $request->datefrom;
        $dateto = $request->dateto;
        $g1 = $request->g1;
        $g1content = $request->g1content;
        $g2 = $request->g2;
        $g2content = $request->g2content;
        $g3 = $request->g3;
        $g3content = $request->g3content;
        $status = $request->status;

        if($g1){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1)
                ->get();    
        }
        if($g1 && $g1content){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->where($g1,$g1content)
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1)
                ->get();    
        }

        if($g1 && $g2){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1,$g2)
                ->get();    
        }
        if($g1 && $g1content && $g2){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->where($g1,$g1content)
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1,$g2)
                ->get();    
        }
        if($g1 && $g1content && $g2 && $g2content){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->where($g1,$g1content)
                ->where($g2,$g2content)
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1,$g2)
                ->get();    
        }
        if($g1 && $g1content && $g2 && $g2content && $g3){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->where($g1,$g1content)
                ->where($g2,$g2content)
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1,$g2,$g3)
                ->get();    
        }
        if($g1 && $g1content && $g2 && $g2content && $g3 && $g3content){
            $field = DB::connection($this->mysql)->table('oqc_inspections')
                ->whereBetween('date_inspected',[$datefrom, $dateto])
                ->where($g1,$g1content)
                ->where($g2,$g2content)
                ->where($g3,$g3content)
                ->select(DB::raw("SUM(sample_size) AS sample_size")
                ,DB::raw("SUM(lot_qty) AS lot_qty")
                ,DB::raw("SUM(num_of_defects) AS num_of_defects")
                ,DB::raw("SUM(lot_accepted) AS lot_accepted")
                ,DB::raw("SUM(lot_rejected) AS lot_rejected")
                ,DB::raw("SUM(lot_inspected) AS lot_inspected")
                ,'fy','ww','date_inspected','shift','time_ins_from','time_ins_to','submission','lot_no','judgement','inspector','remarks','assembly_line','customer','po_no','aql','prod_category','family','device_name')
                ->groupBy($g1,$g2,$g3)
                ->get();    
        }

        return $field;
    }

    public function totallarlrrdppm(Request $request){
        $datefrom = $request->datefrom;
        $dateto = $request->dateto;
        $g1 = $request->g1;
        $g1content = $request->g1content;
        $g2 = $request->g2;
        $g2content = $request->g2content;
        $g3 = $request->g3;
        $g3content = $request->g3content;
        $status = $request->status;
        
        $field = DB::connection($this->mysql)->table('oqc_inspections')
        ->whereBetween('date_inspected',[$datefrom, $dateto])
        ->select(DB::raw("SUM(sample_size) AS sample_size")
            ,DB::raw("SUM(lot_qty) AS lot_qty")
            ,DB::raw("SUM(num_of_defects) AS num_of_defects")
            ,DB::raw("SUM(lot_accepted) AS lot_accepted")
            ,DB::raw("SUM(lot_rejected) AS lot_rejected")
            ,DB::raw("SUM(lot_inspected) AS lot_inspected")
            ,'submission')
        ->groupBy('submission')->get();    
     
        return $field;
    } 

    public function countdefects(Request $request){
        $pono = $request->pono;
        $table = DB::connection($this->mysql)->table('oqc_inspections_mod')->where('pono',$pono)->count();
        return $table;
    }

    public function getmodcount(Request $request){
        $output = [];
        $pono = $request->newpono;     
        $lot = $request->lot;                                                                                                                                                       
        $sub = $request->sub;          
        $table = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.modid','=','b.modid')
                ->select('a.po_no','b.mod1','a.lot_no','a.submission')
                ->where('b.pono',$pono)
                ->where('a.lot_no',$lot)
                ->where('a.submission',$sub)
                ->get();
        foreach ($table as $key => $data) {
            $output['pono'][$key] = $pono;
            $output['mod'][$key] = $data->mod1;
            $output['lot_no'][$key] = $data->lot_no;
            $output['submission'][$key] = $data->submission;
        }

        return $output;
    }

    public function getmodcounts(Request $request){
        $hdstatus = $request->report_status;
        $datefrom = $request->datefrom;
        $dateto = $request->dateto;
        $output = []; 
        $table = '';                          
        if($hdstatus == "GROUPBY"){
            $table = DB::connection($this->mysql)->table('oqc_inspections_mod')
                ->select('pono',DB::raw("(GROUP_CONCAT(mod1 SEPARATOR ' , ')) AS mod1"),DB::raw("(GROUP_CONCAT(lotno SEPARATOR ' , ')) AS lot_no"),'submission','qty')
                ->groupBy('pono','submission','device')
                ->get();    
               
        } else {
            $table = DB::connection($this->mysql)->table('oqc_inspections as a')
                ->leftJoin('oqc_inspections_mod as b','a.lot_no','=','b.lotno')
                ->select('a.po_no','b.mod1','a.lot_no','a.submission')
                ->where('b.pono',$request->pono)
                ->where('a.lot_no',$request->lotno)
                ->where('a.submission',$request->subs)
                ->get();    
        }
            
        foreach ($table as $key => $data) {
            $output['mod'][$key] = $data->mod1;
            $output['lotno'][$key] = $data->lot_no;
        }
        return $output;
    }

    public function time(Request $r)
    {   
        $timefrom = $this->convertStringToTime($r->timefrom);
        $timeto = $this->convertStringToTime($r->timeto);

        if($timefrom >= $this->convertStringToTime("7:30 AM") && $timeto <= $this->convertStringToTime("7:29 PM")) {
            return "Shift A";
        } else {
            return "Shift B";
        } 
    }

    private function convertStringToTime($time)
    {
        $dtime = Carbon::createFromFormat("G:i A", $time);
        $timestamp = $dtime->getTimestamp();

        return $timestamp;
    }

    public function countlotno(Request $request){
        $pono = $request->pono;
        $lotno = $request->lotno;

        $count = DB::connection($this->mysql)->table('oqc_inspections')->where('po_no',$pono)->where('lot_no',$lotno)->count();
        return $count;
    }

    
}