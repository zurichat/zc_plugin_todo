<?php

namespace App\Console\Commands;

use App\collectionTasksMonthSort;
use Illuminate\Console\Command;

class CollectionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collection:monthSort';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sort task by calender month';

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
        dd((new collectionTasksMonthSort())->taskmonth());
    }
}
