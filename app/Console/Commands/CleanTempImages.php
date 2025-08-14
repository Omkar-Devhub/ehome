<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanTempImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-temp-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused temporary images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tempDir = public_path('temp');
        $files = File::files($tempDir);

        if(count($files) > 0) {
            foreach ($files as $file) {
                if (Carbon::parse($file->getMTime())->diffInMinutes(now()) > 1) { // Delete files older than 1 hour
                    File::delete($file->getPathname());
                }
            }

            $this->info('Temporary images cleaned successfully.');
        }

    }
}
