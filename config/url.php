<?php

return [
    "scheme" => "http://",
    "url" => "192.168.0.102",
    "port" => "8081",

    "Auth" => "/authservices/authservice.svc/Authenticate",
    //Batteries
    "BatteriesAll" => "/batteryservices/batteryservice.svc/GetSelectedBatteries",
    "BatteryAdd" => "/batteryservices/batteryservice.svc/AddBattery",
    "BatteryEdit" => "",
    //Jobs
    "JobsAll" => "/jobservices/jobservice.svc/GetCustomJobData",
    //Tools
    "ToolsAll" => "/toolservices/toolservice.svc/GetCustomItems",
    "ToolCustom" => "/toolservices/toolservice.svc/GetCustomItem/",
    "ToolAdd" => "/toolservices/toolservice.svc/AddNewItem",
    "ToolEdit" => "/toolservices/toolservice.svc/EditItem/",
    "ToolItems" => "/toolservices/toolservice.svc/GetItemsComponents",

    "request" => "?what=&where=",

];
