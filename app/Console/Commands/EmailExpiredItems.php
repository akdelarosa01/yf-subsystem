<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use Mail;
use DB;
use Excel;
use Carbon\Carbon;
use File;

class EmailExpiredItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will notify all the recipient for the WBS expiration of items.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->email('mysqlwbsyf','sqlsrvyf','Items_to_Expire_YF');
    }

    private function email($connection,$mssql,$filename)
    {
        $data = [];
        $dtnxtmonth = Carbon::now()->addMonth(); // get date nxt month

        $now = Carbon::now(); //get date now

        $getdate = DB::connection($connection)
                    ->select("SELECT item,
                                item_desc,
                                qty,
                                lot_no,
                                location,
                                received_date,
                                exp_date
                            FROM tbl_wbs_inventory
                            WHERE qty > 0
                            AND exp_date between date_sub(DATE_ADD(current_date(), INTERVAL 1 month), interval 5 day) and DATE_ADD(current_date(), INTERVAL 1 month)
                            and exp_date not in ('N/A','n/a','NA','na')
                            order by exp_date desc");
        foreach ($getdate as $key => $inv) {
                    $data[$key]['item'] = $inv->item;
                    $data[$key]['item_desc'] = $inv->item_desc;
                    $data[$key]['qty'] = $inv->qty;
                    $data[$key]['lot_no'] = $inv->lot_no;
                    $data[$key]['location'] = $inv->location;
                    $data[$key]['received_date'] = $inv->received_date;
                    $data[$key]['exp_date'] = $inv->exp_date;
        }

        $countset = DB::connection($connection)
                    ->table('tbl_wbs_emailsettings')
                    ->count();

        if ($countset > 0) {
            $recipients = [];
            $emails = DB::connection($connection)
                    ->table('tbl_wbs_emailsettings')
                    ->get();

            foreach ($emails as $key => $email) {
                array_push($recipients, $email->sendto);
            }

            if (empty($data)) {
                Mail::send('email.mail', ['data'=>$data], function ($mail) use ($recipients) {
                    $mail->to($recipients)
                        ->from('pmi.subsystem@gmail.com','WBS Subsystem')
                        ->subject('WBS: Items will expire in a month (YF)');
                });
                \Log::info('send at '.date('Y-m-d g:i:s a'));
            } else {
                $dt = Carbon::now();
                $pathToFile = storage_path().'/email_attachements/'.$dt->format('Y-m-d').'/'.$filename.$dt->format('Y-m-d').'.txt';
                
                $this->generateTxtFile($filename,$data,$dt->format('Y-m-d'));

                Mail::send('email.mail', ['data'=>$data], function ($mail) use ($recipients,$pathToFile) {
                    $mail->to($recipients)
                        ->from('pmi.subsystem@gmail.com')
                        ->subject('WBS: Items will expire in a month (YF)');
                    $mail->attach($pathToFile);
                });
                \Log::info('send at '.date('Y-m-d g:i:s a'));
            }
            
        } else {
            \Log::info('sending failed at '.date('Y-m-d g:i:s a'));
        }
    }

    private function generateTxtFile($filename,$data,$date)
    {
        $path = storage_path().'/email_attachements/'.$date;
                        File::makeDirectory($path, 0777, true, true);
                        if (!File::exists($path)) {
                            File::makeDirectory($path, 0777, true, true);
                        }
        $content = "item\titem_desc\tqty\tlot_no\tlocation\treceived_date\texp_date\r\n";

        foreach ($data as $key => $x) {
            $content .= $x['item']."\t".$data[$key]['item_desc']."\t".$data[$key]['qty']."\t".$data[$key]['lot_no']."\t".$data[$key]['location']."\t".$data[$key]['received_date']."\t".$data[$key]['exp_date']."\r\n";
        }

        $myfile = fopen($path."/".$filename.$date.".txt", "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

    private function checkIfExistObject($object)
    {
       return count( (array)$object);
    }
}
