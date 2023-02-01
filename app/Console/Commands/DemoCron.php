<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\estadoevento;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
        $enviorecordatorio=estadoevento::where('recordatorio', 1)->get();
        foreach($enviorecordatorio as $record) {
            $idparticipante="$record->id_participante";
            $emailparticipante=User::where('id',$idparticipante)->get();
            foreach($emailparticipante as $email)
            {
            $emailpart="$email->email";
            Mail::to('$emailpart')->notify(new recordatorio());
            }
    }
    }
}
