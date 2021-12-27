<?php

namespace App\Console\Commands;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\StatisticIpAddress;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetIPData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:get-ip-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command to grab geolocation information for IP addresses that do not currently have any associated.';

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
        // grab rows in which the geolocation information is not provided
        $ips = StatisticIpAddress::whereNull('city')
            ->whereNull('region')
            ->whereNull('country')
            ->whereNull('country_code')
            ->whereNull('latitude')
            ->whereNull('longitude')
            ->where('ip_address', '<>', '127.0.0.1')
            ->get();

        // determine if there are any ips to process
        if ($ips->count() == 0) {
            $this->info("No ips to process"); return Command::INVALID;
        }

        // loop through the ips
        foreach($ips as $ip)
        {
            // grab rows in which the geolocation information was provided within
            // the last x hours based on jobs configuration file.
            $previous = StatisticIpAddress::whereNotNull('city')
                ->whereNotNull('region')
                ->whereNotNull('country')
                ->whereNotNull('country_code')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->where('ip_address', $ip->ip_address)
                ->where('created_at', '>=', Carbon::now()->addHours(-config('jobs.get-ip-data.lookback')))
                ->orderBy('created_at', 'desc')
                ->first();

            // use previously stored information when possible
            if ($previous != null)
            {
                $ip->city = $previous->city;
                $ip->region = $previous->region;
                $ip->country = $previous->country;
                $ip->country_code = $previous->country_code;
                $ip->latitude = $previous->latitude;
                $ip->longitude = $previous->longitude;
                $ip->save();

                // skip to the next iteration of the loop.
                continue;
            }

            // save the new ip information if there is no valid previous info
            $this->info("IP: ". $ip->ip_address. " (Getting geolocation data)");
            $details = GeoLocation::lookup($ip->ip_address);

            $ip->city = $details->getCity();
            $ip->region = $details->getRegion();
            $ip->country = $details->getCountry();
            $ip->country_code = $details->getCountryCode();
            $ip->latitude = $details->getLatitude();
            $ip->longitude = $details->getLongitude();
            $ip->save();
        }

        return Command::SUCCESS;
    }
}
