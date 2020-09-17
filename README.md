# gyrodata-sakhalin

This is the web-based application of the Inventory Gyrodata Sakhalin System, created for careful and precise tracking Gyrodata Tools (arriving for the Job), Lithium Batteries and Job Logs.
The application is powered by Azure Cloud Service on:
http://demolaravel.azurewebsites.net

This web application communicates with API, link below:
https://github.com/GadkiyAbram/GyrodataAPICloudService

USAGE:
1. You need to have an access to manage the Data. If you do not have one, you need to follow the link above and press "SEND REQUEST".
Then you'll be asked to provide First / Last names and Email. The Admin will check your data and authorize your access to Service.

You can be logged in by: USER or ADMIN
If you log in by USER, you will only be able to manage Tools / Batteries / Job data. 
By Admin you will be able to approve incoming requests, create / update / delete users.

When you log in, application will check your credentials using API (link above) and access Token will be generated (valid 24 hours). Only with Token you will be able to manage DB data.

On the Welocme screen there are Navigation links: Main / Updated / Tools / Batteries / Jobs / Addmin Panel (will only be visible if you Logged In as "Admin")
Updates - currently unavailable. The purpose is to fill this view with latest news, e.g. Tool / Battery / Job added, etc.
Tools - This view displays the table of Items, currently stored in DB. You can check each one by link (in Asset) for precise details:
    - Asset
    - Arrived in Location
    - Invoice (the Item was sent from the country of origin)
    - CCD - custom clearance declaration (for import to Russian Federation)
    - Description in Russian. This comes from CCD
    - CCD Position. This is the position of Item in CCD
    - Circulation. This is the important parameter of some categories of the Items (applicable for GDP Sections / GWD Modem / GWD Bullplug). It depends on the Jobs             the Item was involved in. Will be explained further.
    - Comment if neccesary
    - Item Image if neccesary
    - Table of Jobs with links the Item was involved in.
