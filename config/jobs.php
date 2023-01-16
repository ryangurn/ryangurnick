<?php

return [
    /*
    * Configuration information for the site:get-ip-data
    * job.
    */
    'get-ip-data' => [
        /*
         * Lookback frequency is the time at which we will
         * not send an api request to IpInfo but use our
         * current data to determine the ip information.
         *
         * This is the amount of time in hours
         */
        'lookback' => '48',
    ],
];
