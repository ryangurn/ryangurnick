<?php

namespace App\Console\Commands;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\StatisticIpAddress;
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
        $ips = StatisticIpAddress::whereNull('city')
            ->whereNull('region')
            ->whereNull('country')
            ->whereNull('country_code')
            ->whereNull('latitude')
            ->whereNull('longitude')
            ->where('ip_address', '<>', '127.0.0.1')
            ->get();

        if ($ips->count() == 0) {
            $this->info("No ips to process"); return Command::INVALID;
        }
        foreach($ips as $ip)
        {
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
