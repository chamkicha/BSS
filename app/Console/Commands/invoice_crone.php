<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Serviceinvoice\ServiceInvoiceController;
use Illuminate\Console\Command;

class invoice_crone extends Command
{


  


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:invoice_crone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'invoice automatic generation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $ServiceInvoiceController;
    public function __construct(serviceInvoiceController $ServiceInvoiceController)
    {
        parent::__construct();
        $this->ServiceInvoiceController = $ServiceInvoiceController;
    }

    
    // protected $ServiceInvoiceController;
    // public function __construct(serviceInvoiceController $ServiceInvoiceController)
    // {
    //    $this->ServiceInvoiceController = $ServiceInvoiceController;
    // }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->ServiceInvoiceController->auto_invoice_generator();
        $this->info('User Name Change Successfully!');
    }
}
