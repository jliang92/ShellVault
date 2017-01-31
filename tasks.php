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
        <script src="libs/js/angular/controllers/taskController.js"></script>



      
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


            <div class="container" ng-controller="taskController">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#create_modal"><i class="glyphicon glyphicon-plus"></i> Create a Task</button>
                <br><br>
                <input type="text" ng-model="search.$" class="form-control" placeholder="Search for Task..." />
                <br><br>

                <!-- Modal -->
                <div class="modal fade" id="create_modal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add a Task</h4>
                            </div>
                            <div class="modal-body">
                                <form name="create_task_form">
                                    <div class="form-group">
                                        <label>Title:</label><label id="new_task_title_error" class="hide error-text">{{title_error}}</label>
                                        <input type="text" id="task_title" class="form-control" ng-model="new_title" required/>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label>Suggested Deadline (Optional):</label>
                                        <label id="new_task_due_date" class="hide error-text">{{due_date_error}}</label>
                                        <br>
                                        <input type="text" id="new_due_date"  ng-model="new_due_date" class="form">
                                    </div>
                                    <div class="form-group">
                                        <label>Summary:</label>

                                        <label id="new_task_description_error" class="hide error-text">{{description_error}}</label>
                                        <textarea class="form-control" id="task_summary" ng-model="new_description" rows="4" cols="20" maxlength="500" required></textarea>
                                    </div>
                                </form>


                            </div>
                            <div class="modal-footer">

                                <button type="button" id="add_task" class="btn btn-default" ng-click="create_task()">Create </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="edit_modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <div class="form-group">
                                    <h4 class="modal-title col-sm-4">Task ID {{task_id}}</h4> 
                                    <input class="form-control col-sm-8" type="text" ng-model="task_title"></div>
                            </div>
                            <div class="modal-body">

                                <div class="form-group"><label class="control-label">Due : </label>
                                    <input type="text" id="edit_due_date" maxlength="10" class="form" ng-model="edit_due_date"></div>

                                <div class="form-group"><label class="control-label">Created : </label>
                                    <label class="control-label">{{date_created}}</label></div>

                                <div class="form-group"><label class="control-label">Status : </label>
                                    <select ng-model="edit_status" ng-options="x for x in task_statuses"></select></div>

                                <div class="form-group"><label class="control-label">Description : </label>
                                    <textarea class="form-control" ng-model="task_description"></textarea></div>

                                <div class="form-group"><label class="control-label">Resolution : </label>
                                    <textarea class="form-control" ng-model="task_resolution"></textarea></div>

                                <div class="form-group"><label class="control-label">Notes : </label>
                                    <textarea class="form-control" ng-model="task_notes"></textarea></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" ng-click="update_task()">Save Changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-sm-2">

                        <div class="panel panel-default panel-body">
                            <h4> Quick Search</h4>
                            <input type="text" ng-model="search.id" class="form-control" placeholder="Task Id" /><br>
                            <input type="text" ng-model="search.due_date" class="form-control" placeholder="Due Date" /><br>
                            <input type="text" ng-model="search.title" class="form-control" placeholder="Title" /><br>
                        </div>
                    </div>

                    <div class="col-sm-9" id="main_content">
                        <div class="panel panel-body panel-default">
                            <div id='page-content'>
                                <ul class="nav nav-tabs">
                                    <li class="active" id="all_tasks" ><a ng-click="read_all('0')">All</a></li>
                                    <li class="" id="incomplete_tasks" ><a  ng-click="read_all('1')">Incomplete</a></li>
                                    <li class="" id="complete_tasks"><a  ng-click="read_all('3')">Completed</a></li>
                                </ul>
                                <br>
                                <div class=""> 
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">ID</th>
                                                <th class="col-sm-2">Due Date</th>
                                                <th class="col-sm-2">Status</th>
                                                <th class="col-sm-2">Title</th>

                                                <th class="col-sm-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody ng-init="read_all('1')">
                                            <tr ng-repeat="t in ids| filter:search">
                                                <td class="col-sm-1">{{t.id}}</td>
                                                <td class="col-sm-2">{{t.due_date}}</td>
                                                <td class="col-sm-2">{{t.status}}</td>
                                                <td class="col-sm-3">{{t.title}}</td>


                                                <td class="col-sm-4">

                                                    <button class="btn btn-primary" ng-click="read_one(t.id)"><span class="glyphicon glyphicon-edit"></span>Edit </button>
                                                    <button class="btn btn-default" ng-click="delete_task(t.id)"><span class="glyphicon glyphicon-remove"></span>Delete</button>

                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <script>
                            /*Angular ended above,Start of Jquery below*/
                            $(document).ready(function () {

                                $("#new_due_date").datepicker({dateFormat: 'yy-mm-dd'});
                                $("#edit_due_date").datepicker({dateFormat: 'yy-mm-dd'});

                            });
                </script>
            </div>


        </div> 

    </body>

</html>







