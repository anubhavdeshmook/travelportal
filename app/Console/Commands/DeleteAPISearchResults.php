<?php

namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use DB;

class DeleteAPISearchResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteapisearchresults:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the hotel beds search results daily.';

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
        \DB::table('api_search_results')->delete();
      return $this->info('Search api results deleted.');
    }
}
