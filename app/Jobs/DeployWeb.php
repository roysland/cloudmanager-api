<?php

namespace App\Jobs;

use App\Service;
use App\Jobs\Job;
use Illuminate\Bus\Queueable;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;


class DeployWeb extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    use InteractsWithQueue, Queueable, SerializesModels;
    public $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $repo = $this->service->repo['clone_url'];
        $repoName = $this->service->repo['name'];
        // $cmd = "ssh -i git clone ". $repo ." && cd ". $repoName ." && npm install";
        $cmd = "touch ". $repoName .".txt";
        shell_exec($cmd);
    }
}
