<?php
return array(
    // set your paypal credential
    'client_id' => 'AcLxWqoUA6-CIPmzAQ9yQir_lfViMX0umDh1tJB7pwj6IFUCSlge3pmKVRvjNoAgD_URhLlt_X2nUdoJ',
    'secret' => 'EFN74_W9DlaYmKXU_2FgQ60YjByOIV7bQme0GJw8iFKsbssGjarWPwCJIv1f7rJafL16a2zwzhszYaK7',
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);