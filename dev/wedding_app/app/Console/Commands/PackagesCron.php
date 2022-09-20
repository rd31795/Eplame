<?php

namespace App\Console\Commands;
use App\Package;
use App\PurchasePackageProduct;
use Illuminate\Console\Command;

class PackagesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $plan=PurchasePackageProduct::where('status',1)->where('package_type',1)->get();
        foreach($plan as $key=>$value){
          if($value->expiry_date < \Carbon\Carbon::now()){
                   if($value->expiry_date){
                      PurchasePackageProduct::where('id',$value->id)->update([
                          "status"=>0
                      ]);
                     $check_next_plan=PurchasePackageProduct::where('user_id',$value->user_id)->where('status',2)->where('package_type',1)->orderBy('id','ASC')->first();
                     if($check_next_plan){
                            PurchasePackageProduct::where('id',$check_next_plan->id)->update([
                                 'status'=>1
                            ]);                         
                     }
                   }
          }
        }

          $plan=PurchasePackageProduct::where('status',1)->where('package_type',2)->get();
        foreach($plan as $key=>$value){
          if($value->expiry_date < \Carbon\Carbon::now()){
                   if($value->expiry_date){
                      PurchasePackageProduct::where('id',$value->id)->update([
                          "status"=>0
                      ]);
                     $check_next_plan=PurchasePackageProduct::where('user_id',$value->user_id)->where('status',2)->where('package_type',2)->orderBy('id','ASC')->first();
                     if($check_next_plan){
                            PurchasePackageProduct::where('id',$check_next_plan->id)->update([
                                 'status'=>1
                            ]);                         
                     }
                   }
          }
        }
    }
}
