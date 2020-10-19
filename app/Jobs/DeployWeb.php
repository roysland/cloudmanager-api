<?php

namespace App\Jobs;

class DeployWeb extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $service;
    public function __construct(Service $service)
    {
        $this->service = $service
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
