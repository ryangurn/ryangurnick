<?php

namespace App\Console\Commands;

use App\Models\StatisticDevice;
use App\Models\StatisticSession;
use Illuminate\Console\Command;
use Jenssegers\Agent\Agent;

class GetDeviceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:get-device-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will get device data from the session information saved.';

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
        // grab the statistics for the device.
        $computed_devices = StatisticDevice::all()->pluck('session_id')->toArray();

        // grab the statistics for the session.
        $sessions = StatisticSession::whereNotIn('session_id', $computed_devices)->get();

        // determine if there is any processing to do.
        if ($sessions->count() == 0) {
            $this->info('No sessions to process');

            return Command::INVALID;
        }

        // loop through the sessions
        foreach ($sessions as $session) {
            $this->info('Session: '.$session->session_id.' (Getting device data)');

            // get the agent information from the user agent.
            $agent = new Agent();
            $agent->setUserAgent($session->user_agent);

            // store the new device statistic information.
            $device = StatisticDevice::firstOrNew([
                'session_id' => $session->session_id,
            ]);
            $device->browser = $agent->browser();
            $device->browser_version = $agent->version($device->browser);
            $device->platform = $agent->platform();
            $device->platform_version = $agent->version($device->platform);
            $device->device = $agent->device();
            $device->desktop = $agent->isDesktop();
            $device->mobile = $agent->isMobile();
            $device->mobile_bot = $agent->isMobileBot();
            $device->tablet = $agent->isTablet();
            $device->bot = $agent->isBot();
            $device->robot = $agent->isRobot();
            $device->robot_name = $agent->robot();
            $device->languages = $agent->languages();
            $device->save();
        }

        return Command::SUCCESS;
    }
}
