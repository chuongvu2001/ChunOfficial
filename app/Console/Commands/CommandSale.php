<?php

namespace App\Console\Commands;

use http\Env\Request;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Mail;

class CommandSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sale';

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
     * @return int
     */
    public function handle()
    {
        $voucher = Voucher::where("name","like","%sale20%")->first();
        $data = ['status'=>0];
        $voucher->fill($data);
        $voucher->save();
        return "Success";
    }
}
