<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html ng-app="shellVault"  >
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>

        <!--Jquery ui-->
        <script src="libs/js/jQuery/jquery-2.2.4.js"></script>
        <link rel="stylesheet" href="libs/js/jQuery/jquery-ui-1.12.0/jquery-ui.min.css">
        <script src="libs/js/jQuery/jquery-ui-1.12.0/jquery-ui.min.js"></script>  


        <!--Basic Angular Imports-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script src="libs/js/angular/angular-route.min.js"></script>
        <script src="libs/js/angular/module/app.js"></script>

        <!--Angular Controllers-->
        <script src="libs/js/angular/controllers/aboutappController.js"></script>


        <!--BootStrap-->
        <script src="libs/css/bootstrap/js/bootstrap.js"></script>
        <script src="libs/css/bootstrap/docs-assets/js/holder.js"></script>
        <link href="libs/css/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="libs/css/bootstrap/css/bootstrap_custom.css" rel="stylesheet">

        <!--Personal Custom Css-->
        <link href="libs/css/Personal.css" rel="stylesheet">







    </head>
    <body class="">
        <?php
        include 'html_components/navbar.html';
        ?>

        <div  class="container">

            <div ng-controller="aboutAppController">
                <div  class="panel  panel-default">
                    <div class="panel-heading">Vault</div>
                    <div class="panel-body"><div class="row">
                            <div class="col-sm-6">
                                <label>Purpose:</label> Just something small to for taking down credentials.Not intended for high risk info such as online banking credentials etc.
                            </div>

                            <div class="col-sm-6">
                                <label>Features Coming Soon:</label>
                                <ul>
                                    <li>Detect change and prompt the user before they leave page</li>
                                    <li>Pagination</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>
                    <div class="panel-body"><div class="row">
                            <div class="col-sm-6">
                                <label>Purpose:</label>

                                Create a task for those tedious errands. Deadlines are optional. 
                                Its also good for logging activities/errand of the day so you can recall the date of the activity/errand.
                            </div>

                            <div class="col-sm-6">
                                <label> Features Coming Soon:</label>
                                <ul>
                                    <li>Detect overdue tasks and indicate in red</li>
                                    <li>Find tasks with closest non-overdue deadlines and push to top of task</li>
                                    <li>Pagination</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="panel  panel-default">
                    <div class="panel-heading">Time Log</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Purpose:</label>
                                Simply clock in and clock out to log a timeslot and fill out the notes section so you can record your activities( this whole app is basically to record and find things for different reasons). 
                                The app will calculate the duration of the session. This can be used as a timesheet to log work hours however until archiving functions are available, it is strongly advised to mark the notes
                                section so that you can tell which entries are for work and which are for other categories.  
                            </div>

                            <div class="col-sm-6">
                                <label>Features Coming Soon:</label>  
                                <ul>
                                    <li>Clock In and Clock Out timestamps will be converted to 12hrs instead of 24 hrs</li>
                                    <li>Archiving Function</li>
                                    <li>Mass Archive and Delete Functions</li>
                                    <li>Download logs as .csv and .txt</li>
                                    <li>Tab for archived entries</li>
                                    <li>Pagination</li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="panel  panel-default">
                    <div class="panel-heading">Spending Log</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <label> Purpose:</label>
                                Spending log is self explanatory. Record a transaction whenever you pay for anything. The calender is pre-set to the current day.
                                Simply, select transaction type, provide the amount you paid and what it is you paid for.
                                The app shows some stats such as total spent each day and each month. Click on the rows of the table to reveal more.
                            </div>

                            <div class="col-sm-6">
                                <label>Features Coming Soon:</label>  
                                <ul>
                                    <li>Edit the logs</li>
                                    <li>Delete logs by day instead of by entry.</li>
                                    <li>Delete logs by month</li>
                                    <li>Download logs by the month.</li>
                                    <li>Display data using a Graph</li>
                                    <li>Click header to sort the table results</li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div> 

    </body>

</html>
