<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class MinuteUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'billing generation';

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

        
            DB::table('servicebillings')
            ->where('customer_no', 1)
            ->update(['discount' => str_random(10)]);
            $this->info('User Name Change Successfully!');

    }
}
