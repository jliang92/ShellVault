<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
?>
<html ng-app="shellVault"  >
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        <!--Jquery ui-->
        <script src="libs/js/jQuery/jquery-2.2.4.js"></script>
        <link rel="stylesheet" href="libs/js/jQuery/jquery-ui-1.12.0/jquery-ui.min.css">
        <script src="libs/js/jQuery/jquery-ui-1.12.0/jquery-ui.min.js"></script>  


        <!--Basic Angular Imports-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script src="libs/js/angular/angular-route.min.js"></script>
        <script src="libs/js/angular/module/app.js"></script>

        <!--Angular Controllers-->
        <script src="libs/js/angular/controllers/loginController.js"></script>




        <!--BootStrap-->
        <script src="libs/css/bootstrap/js/bootstrap.js"></script>
        <script src="libs/css/bootstrap/docs-assets/js/holder.js"></script>
        <link href="libs/css/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="libs/css/bootstrap/css/bootstrap_custom.css" rel="stylesheet">

        <!--Personal Custom Css-->
        <link href="libs/css/Personal.css" rel="stylesheet">


    </head>
    <body >


        <div  class="container">


            <div  ng-controller="loginController">
                <div>
                    <form class="form-horizontal" id="credentials_form" action="home.php"  role="form">

                        <div class=" panel panel-default">
                            <div class="panel-heading center-block center-text center">
                                <h3>Credentials</h3>
                            </div>
                            <div class="panel-body">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Username:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="uname" ng-model="uname" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pwd">Password:</label>
                                        <div class="col-sm-4"> 
                                            <input type="password" class="form-control" id="pwd" ng-model="pwd" required/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer center-block center-text center">
                                Demo Login Credentials<br>
                                username: admin <br>
                                password: master<br>
                                <button id="login_button" ng-click="login()"  class="btn btn-default">Log In</button>

                            </div>
                        </div>
                    </form>





                </div>
            </div>
        </div><!--End of Modal-->



    </body>

</html>
