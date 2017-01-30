<!--
This is the version with in-line form in the table
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
        <script src="libs/js/angular/controllers/homeController.js"></script>
        <script src="libs/js/angular/controllers/vaultController.js"></script>
        <script src="libs/js/angular/controllers/spendingLogController.js"></script>
        <script src="libs/js/angular/controllers/taskController.js"></script>
        <script src="libs/js/angular/controllers/timeLogController.js"></script>
        <script src="libs/js/angular/controllers/loginController.js"></script>



        <!--Canvas import to use for generating graphs-->
        <script src="libs/js/canvasJs/canvasjs.min.js"></script>

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


            <div ng-controller="vaultController">





                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="">
                            <label for="search_bar"> Search by source/website:</label>
                            <input ng-model="search.source" placeholder="" id="search_bar" class=" form-control" type="search">
                        </div>
                    </div>

                </div>


                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class=" col-sm-12">
                                        <table class="table table-hover table-responsive table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-1">Id</th>
                                                    <th>Purpose</th>
                                                    <th ng-click="orderByThis()">Source</th>
                                                    <th>Email</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody ng-init="read_all()">
                                                <tr>
                                                    <td></td>
                                                    <td><input  class="form-control validate"  placeholder="Purpose(Optional)" type="text" ng-model="purpose" ></td>
                                                    <td><input  class="form-control validate"  placeholder="Source/website"  type="text"  ng-model="source" ></td>
                                                    <td><input  class="form-control validate"  placeholder="Email" type="email" ng-model="email" ></td>
                                                    <td><input  class="form-control validate"  placeholder="Username"  type="text" ng-model="username" ></td>
                                                    <td><input  class="form-control validate"  placeholder="Password"  type="text" ng-model="password" ></td>
                                                    <td><button class="btn btn-primary" ng-click="create()">Save</button></td>
                                                    <td><button class="btn btn-default" ng-click="reset()">Clear</button></td>
                                                    <td></td>
                                                </tr>
                                                <tr ng-repeat="entry in entries| filter :search | orderBy: myOrderThis" id="table_row_{{entry.id}}"   ng-mouseenter="enable_inline_edit(entry.id)" ng-mouseleave="disable_inline_edit(entry.id)">
                                                    <!-- -->

                                                    <td id="table_row_id_{{entry.id}}">
                                                        <a href="{{entry.source}}" class="" target="_blank">{{entry.id}}</a>
                                                    </td>
                                                    <td>
                                                        <p id="display_purpose_{{entry.id}}"  value="{{entry.purpose}}" class="" ng-bind="entry.purpose"></p>
                                                        <input id="edit_purpose_{{entry.id}}" type="text"  class="hide form-control" value="{{entry.purpose}}">
                                                    </td>
                                                    <td>
                                                        <p id="display_source_{{entry.id}}"  class="" ng-bind="entry.source"></p>
                                                        <input id="edit_source_{{entry.id}}" type="text" class="hide  form-control" value="{{entry.source}}">
                                                    </td>
                                                    <td>
                                                        <p id="display_email_{{entry.id}}" class=""  ng-bind="entry.email"></p>
                                                        <input id="edit_email_{{entry.id}}" type="email" class="hide form-control" value="{{entry.email}}">
                                                    </td>
                                                    <td>
                                                        <p id="display_uname_{{entry.id}}" class="" ng-bind="entry.uname"></p>
                                                        <input id="edit_uname_{{entry.id}}" type="text" class="hide form-control" value="{{entry.uname}}">
                                                    </td>
                                                    <td>
                                                        <p id="display_pword_{{entry.id}}" class="" ng-bind="entry.pword"></p>
                                                        <input id="edit_pword_{{entry.id}}" type="text"  class="hide form-control" value="{{entry.pword}}">
                                                    </td>
                                                    <td>

                                                        <button id="save_button_{{entry.id}}" class="btn  btn-primary hide" ng-click="update(entry.id)">Save</button>
                                                    </td>
                                                    <td>

                                                        <button id="reset_button_{{entry.id}}"  class="btn btn-default hide" ng-click="reset_inplace_form(entry.id)">Reset</button></td>
                                                    <td><button id="delete_button_{{entry.id}}" class="btn btn-default" ng-click="remove(entry.id)">Delete</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div> 

    </body>

</html>














