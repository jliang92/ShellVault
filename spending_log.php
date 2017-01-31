
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
        <script src="libs/js/angular/controllers/spendingLogController.js"></script>
        


     
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

        <div  class="container" >


            <div ng-controller="spendingLogController" class="content">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2">
                                    <label>Date:</label>
                                    <input id="date_stamp" class="form-control" type="text" ng-model="date_stamp">
                                </div>

                                <div class="col-sm-2">
                                    <label>Transaction Type:</label>
                                    <select  class="form-control"  ng-model="option_type" ng-init="read_types()" ng-change="read()"  ng-options="x.name for x in type_options">
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>Cost (USD):</label>
                                    <input  class="form-control"  type="number" min=".01" ng-model="cost">
                                </div>
                                <div class="col-sm-3">
                                    <label>Description:</label>
                                    <input class="form-control"  type="text" ng-model="description">
                                </div>
                                <div class="col-sm-3">
                                    <label></label>
                                    <button class="btn btn-primary" ng-click="insert()">Create</button>
                                    <button class="btn btn-default" ng-click="reset()">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div id="left" class="col-sm-3">
                            <div class="panel panel-default hide">
                                <div class="panel-body">
                                    <input ng-model="search"  placeholder="Search" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    Select a month to load:
                                    <ul ng-init="display_year_month()">
                                        <li ng-repeat="y_m in year_month_list" >
                                            <a href="" ng-bind="y_m.year_month" ng-click="display_month_data(y_m.year_month)"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div id="right" class="col-sm-9">
                            <div class="panel panel-default">
                                <div class="panel-body">


                                    <ul class="nav nav-tabs">
                                        <li class="hide"><a>Table</a></li>
                                        <li class="hide"><a>Graph</a></li>
                                    </ul>
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th><label class="control-label">Year:</label></th>
                                                <th><label class="control-label">Month:</label></th>
                                                <th><label class="control-label">Total Spent:</label></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><p ng-bind="year"></p></td>
                                                <td><p ng-bind="month"></p></td>
                                                <td><p ng-bind="amount | currency"></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>

                                    </div>
                                    <table class="table table-hover table-responsive table-striped"> 
                                        <thead>
                                            <tr data-toggle="tooltip" title="Click each row to reveal details">
                                                <th>Date</th>
                                                <th>Total Spent</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <tr ng-repeat="day in month_days_list" ng-click="display_day_data(day.date_stamp)">
                                                <td> <p ng-bind="day.date_stamp"></p></td>
                                                <td> <p ng-bind="day.amount_spent | currency"></p></td>

                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{error}}

                <div id="detail_modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" ng-bind="day_cursor"></h4>

                            </div>
                            <div class="modal-body">
                                <label> Total Spent: </label> <p ng-bind="day_total | currency"></p>

                                <table  class="table table-hover table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Type</th>
                                            <th>Cost</th>
                                            <th>Description</th>
                                            <th></th><th></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="transaction in days_transactions">
                                            <td ng-bind="transaction.log_id"></td>
                                            <td ng-bind="transaction.name"></td>
                                            <td ng-bind="transaction.cost | currency"></td>
                                            <td ng-bind="transaction.description"></td>
                                            <td><a href="" ng-click="remove(transaction.log_id)"><span class="glyphicon glyphicon-remove"></span></a></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <!--    Footer
                                    <button type="button" class="btn btn-default" ng-click="close_modal()">Fn Close</button>
                                -->
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>


            </div><!--Ending div tag for section under the controller-->




        </div> 

    </body>

</html>






