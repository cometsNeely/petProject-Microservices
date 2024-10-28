<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Facades\IviFacade;

class IviParseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private $path;

    /**
     * Create a new job instance.
     */
    public function __construct($path='')
    {

        $this->path = $path;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        IviFacade::callIviParse($this->path);

    }

}
