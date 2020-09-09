<?php

return [
    
    //  DO NOT FORGET TO RUN "PHP ARTISAN CONFIG:CACHE" //
    // LOCAL SCHEME
    "scheme" => "http://",
    "url" => "192.168.1.105",
    "port" => "8081",

    // AZURE SCHEME
    "scheme_azure" => "http://",
    "url_azure" => "demotestapi.cloudapp.net",

    "Auth" => "/authservices/authservice.svc/Authenticate",
    //Batteries
    "BatteryBySerial" => "/batteryservices/batteryservice.svc/GetSelectedBattery/",
    "BatteriesAll" => "/batteryservices/batteryservice.svc/GetSelectedBatteries",
    "BatteryCustom" => "/batteryservices/batteryservice.svc/GetSelectedBatteryData/",
    "BatteryAdd" => "/batteryservices/batteryservice.svc/AddBattery",
    "BatteryEdit" => "/batteryservices/batteryservice.svc/EditBattery/",

    //Jobs
    "JobsAll" => "/jobservices/jobservice.svc/GetCustomJobData",
    "JobCustom" => "/jobservices/jobservice.svc/GetSelectedJobData/",
    "JobAdd" => "/jobservices/jobservice.svc/AddNewJob",
    "JobEdit" => "/jobservices/jobservice.svc/EditJob/",
    "DataForJob" => "/jobservices/jobservice.svc/GetAllDataForJobCreate",

    //Tools
    "ToolsAll" => "/toolservices/toolservice.svc/GetCustomItems",

    // TODO - remove when checked
//    "ToolCustom" => "/toolservices/toolservice.svc/GetCustomItem/",
//    "ToolsCustom" => "/toolservices/toolservice.svc/GetCustomItems/",   // Search
    //
    "ToolAdd" => "/toolservices/toolservice.svc/AddNewItem",
    "ToolEdit" => "/toolservices/toolservice.svc/EditItem/",
    "ToolItems" => "/toolservices/toolservice.svc/GetItemsComponents",
    "ToolInvolvedInJobs" => "/toolservices/toolservice.svc/GetJobsInvolvedIn?item=",
    "ToolGetLRL" => "/toolservices/toolservice.svc/GetSelectedItemLRL?item=",
    "ToolGetItemAsset" => "/toolservices/toolservice.svc/GetSelectedItem",

    "request" => "?what=&where=",

];
