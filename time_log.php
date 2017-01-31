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
        <title>Shell Vault</title>

        <!--Jquery ui-->
        <script src="libs/js/jQuery/jquery-2.2.4.js"></script>
        <link rel="stylesheet" href="libs/js/jQuery/jquery-ui-1.12.0/jquery-ui.min.css">
        <script src="libs/js/jQuery/jquery-ui-1.12.0/jquery-ui.min.js"></script>  


        <!--Basic Angular Imports-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script src="libs/js/angular/angular-route.min.js"></script>
        <script src="libs/js/angular/module/app.js"></script>

        <!--Angular Controllers-->
       <script src="libs/js/angular/controllers/timeLogController.js"></script>
      


       
        <!--BootStrap-->
        <script src="libs/css/bootstrap/js/bootstrap.js"></script>
        <script src="libs/css/bootstrap/docs-assets/js/holder.js"></script>
        <link href="libs/css/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="libs/css/bootstrap/css/bootstrap_custom.css" rel="stylesheet">

        <!--Personal Custom Css-->
        <link href="libs/css/Personal.css" rel="stylesheet">






        <!--This is to insert a icon on the browser's tab-->
        <link rel="icon" href="assets/bat.png">

        
    </head>
    <body class="">
        <?php
        include 'html_components/navbar.html';
        ?>

        <div  class="container">



            <div class="container" ng-controller="timelogController"><!--Container start-->


                <div class="modal fade" id="edit_time_log_modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="form-group">
                                    <h4 class="modal-title">Time Log Entry ID {{time_log_id}}</h4> 
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="panel panel-body panel-default">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Clocked In</th>
                                                        <th>Clocked Out</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Date:</td>
                                                        <td><p ng-bind="time_log_start_date"></p></td>
                                                        <td><p ng-bind="time_log_end_date"></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time:</td>
                                                        <td><p ng-bind="time_log_time_in"></p>  </td>
                                                        <td><p ng-bind="time_log_time_out"></p></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>




                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="panel panel-body panel-default">
                                            Log Status:<p ng-bind="time_log_status_name"></p>
                                            Session Duration:<br>
                                            <span ng-bind="time_log_hours"></span> Hours <br>
                                            <span ng-bind="time_log_minutes"></span> Minutes<br>
                                            <span ng-bind="time_log_seconds"></span>Seconds


                                        </div>


                                    </div>
                                </div>
                                <br>

                                <label>Notes:</label>
                                <textarea class="form-control" placeholder="Typically this is a summary/record of what you did during this timeslot or other things to take note of." id="timelog_notes" ng-model="time_log_notes" rows="4" cols="20" maxlength="500" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" ng-click="time_log_update()">Save Changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div  id="operations" class="row">
                    <div id="log_session_operations" class="col-sm-4 panel panel-body panel-default">
                        <h3>Session Operations</h3>
                        <button class="btn btn-primary" ng-click="time_log_clock_in()" type="button" id="start" >
                            <span class='glyphicon glyphicon-play-circle'></span> Start
                        </button>
                        <button class="btn btn-primary" ng-click="time_log_clock_out()" type="button" id="stop" >
                            <span class='glyphicon glyphicon-stop'></span> Stop
                        </button>
                        <button class="btn btn-primary" ng-click="get_ids()" type="button" id="get_ids" >
                            <span class='glyphicon glyphicon-stop'></span> Get Ids
                        </button>




                    </div>

                    <div id="log_downloads" class="col-sm-4 panel panel-body panel-default">
                        <h3>Select a format to download</h3>
                        <div id='download_csv' class=''>
                            <a class="button_link">
                                <!--  href="php_ajax/timelog/timelog_download_csv.php" -->
                                <span class="glyphicon glyphicon-download-alt"></span> CSV
                            </a>
                        </div>
                        <div id='download_txt' class=''>
                            <a class="button_link" >
                                <!-- href="php_ajax/timelog/timelog_download_txt.php" -->

                                <span class="glyphicon glyphicon-download-alt"></span> Text
                            </a>
                        </div>
                    </div>     
                    <div id="log_entry_operations" class="col-sm-4 panel panel-body panel-default">
                        <h3>Bulk actions:</h3>
                        <button class="btn btn-primary"  ng-click="time_log_archive()" disabled type="button" id="archive" >
                            <span class='glyphicon glyphicon-ok-circle'></span> Archive
                        </button>
                        <button class="btn btn-primary" ng-click="time_log_delete_mass()"disabled type="button" id="delete" >
                            <span class='glyphicon glyphicon-remove-circle'></span> Delete
                        </button>
                    </div>  
                </div>


                <div class="row">
                    <div id="notifications" class="panel panel-body panel-default">

                        {{update_message}}
                    </div>
                </div>
                <!--PAGE CONTENT-->
                <div class="row">
                    <div id="log" class="panel panel-body panel-default">

                        <div class="scrollable">
                            <table  class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>

                                            <input type="checkbox" ng-click="fill_or_clear()" id="mass_check_uncheck">
                                        </th>
                                        <th>Start Date</th>
                                        <th>Clocked in</th>
                                        <th>End Date</th>
                                        <th>Clocked Out</th>
                                        <th>Log Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody  ng-init="time_log_read_all()">
                                    <tr ng-repeat="e in entries">
                                        <td>

                                            <input type="checkbox" ng-click="get_check_boxes()" name="log_entry" value="{{e.time_log_id}}" id="{{e.time_log_id}}">
                                        </td>
                                        <td>{{e.start_date}}</td>
                                        <td>{{e.time_in}}</td>
                                        <td>{{e.end_date}}</td>
                                        <td>{{e.time_out}}</td>

                                        <td>{{e.name}}</td>
                                        <td>
                                            <button class="btn btn-primary" ng-click="time_log_read_one(e.time_log_id)">
                                                <span class="glyphicon glyphicon-edit"></span>Edit 
                                            </button>


                                            <button class="btn btn-default" ng-click="time_log_delete(e.time_log_id)">
                                                <span class="glyphicon glyphicon-remove"></span>Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>

            </div><!--Container end-->

        </div> 

    </body>

</html>







