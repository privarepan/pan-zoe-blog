<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;

class MessageClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msg:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除聊天记录与缓存';

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
        Message::all()->each(function (Message $message){
            cache()->forget('chat:channel:'.$message->channel);
            $message->delete();
        });
        return 1;
    }
}
