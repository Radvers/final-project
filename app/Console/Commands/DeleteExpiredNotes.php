<?php

namespace App\Console\Commands;

use App\Services\CommandService;
use Illuminate\Console\Command;

class DeleteExpiredNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteExpiredNotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Expired Notes ';

    /**
     * @var CommandService
     */
    private $service;

    /**
     * DeleteExpiredNotes constructor.
     * @param CommandService $service
     */
    public function __construct(CommandService $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service->deleteExpired();
    }
}
