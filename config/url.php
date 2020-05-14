<?php

return [
    "scheme" => "http://",
    "url" => "192.168.0.102",
    "port" => "8081",

    "Auth" => "/authservices/authservice.svc/Authenticate",
    //Batteries
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
    "ToolCustom" => "/toolservices/toolservice.svc/GetCustomItem/",
    "ToolsCustom" => "/toolservices/toolservice.svc/GetCustomItems/",   // Search
    //
    "ToolAdd" => "/toolservices/toolservice.svc/AddNewItem",
    "ToolEdit" => "/toolservices/toolservice.svc/EditItem/",
    "ToolItems" => "/toolservices/toolservice.svc/GetItemsComponents",
    "ToolInvolvedInJobs" => "/toolservices/toolservice.svc/GetJobsInvolvedIn?item=",
    "ToolGetLRL" => "/toolservices/toolservice.svc/GetSelectedItemLRL?item=",

    "request" => "?what=&where=",

];
