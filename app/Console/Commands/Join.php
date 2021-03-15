<?php

namespace App\Console\Commands;

use App\Events\JoinEvent;
use App\Events\Message;
use Illuminate\Console\Command;

class Join extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'join';

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
        broadcast(new Message(\App\Models\Message::find(1)));
    }
}
