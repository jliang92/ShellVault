/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*Start of Angular below*/

app.controller('taskController', function ($scope, $http, $location) {
    //when logining in, can trigger the login.php script and start session and then fetch if is authorzed or initialiazed or what ever and then return true or false, if false, redirect
    //$location.path('/home');
    hasPermission();
    //alert("Page loaded, you can check credentials and redirect at begining of the view controller code");
    $scope.title_error = "";
    $scope.description_error = "";
    $scope.due_date_error = "";
    $scope.task_statuses = ["INCOMPLETE", "COMPLETED"];
    $scope.current_list_view = 0;
    $scope.create_task = function () {//fine

        var due_date = $scope.new_due_date;
        // alert(due_date);
        var good = false;
        if (due_date == null) {
            //   alert("no date,valid");
            good = true;
            $scope.title_error = "";

            $("#new_task_due_date").addClass("hide");

        } else if (due_date.length > 0) {
            if (check_yyyy_mm_dd(due_date) == true) {
                //alert("has date, valid format");
                good = true;
                $scope.due_date_error = "";

                $("#new_task_due_date").addClass("hide");


            } else {
                $("#new_task_due_date").removeClass("hide");
                $scope.due_date_error = "Invalid format, yyyy-mm-dd";

                good = false;
            }
        } else if (due_date.length == 0) {
            good = true;
            $scope.due_date_error = "";

            $("#new_task_due_date").addClass("hide");


        }
        // alert(due_date);

        /*checking if new_title or new_description is empty,consider possible ng-change function*/
        if (!$scope.new_title) {
            // alert("you need to enter a title");
            $("#new_task_title_error").removeClass("hide");
            $scope.title_error = "Title Required";

            good = false;
        } else {
            $("#new_task_title_error").addClass("hide");
            $scope.title_error = "";

        }

        if (!$scope.new_description) {
            //alert("you need to enter a description");
            $("#new_task_description_error").removeClass("hide");
            $scope.description_error = "Description Required";

            good = false;
        } else {
            $("#new_task_description_error").addClass("hide");
            $scope.description_error = "";
        }

        if (good == true) {

            // alert("Commencing Creation");
            $http.post("php_scripts/tasks/task_create.php", {
                'title': $scope.new_title,
                'description': $scope.new_description,
                'due_date': $scope.new_due_date
            }
            ).success(function (data, status, headers, config) {
                $scope.new_title = "";
                $scope.new_description = "";
                $('#create_modal').modal('hide');
                $scope.read_all('0');
                // alert(data);
            });
        }

    };

    $scope.read_all = function (task_status) {//fine
        //alert("called");
        $("#all_tasks").removeClass("active");
        $("#incomplete_tasks").removeClass("active");
        $("#complete_tasks").removeClass("active");

        if (task_status === '0') {
            $("#all_tasks").addClass("active");
        }
        if (task_status === '1') {
            $("#incomplete_tasks").addClass("active");
        }
        if (task_status === '3') {
            $("#complete_tasks").addClass("active");
        }
        $scope.current_list_view = task_status;
        $http.post("php_scripts/tasks/task_read_all.php", {'task_status': task_status}).success(
                function (data) {
                    $scope.ids = data;

                });
    };

    $scope.read_one = function (id) {//fine
        $http.post("php_scripts/tasks/task_read_one.php", {'id': id})
                .success(function (data, status, headers, config) {
                    $scope.task_id = data[0]["id"];
                    $scope.task_title = data[0]["title"];
                    $scope.edit_due_date = data[0]["due_date"];
                    $scope.date_created = data[0]["date_created"];
                    $scope.task_status = data[0]["status"];
                    $scope.task_description = data[0]["description"];
                    $scope.task_resolution = data[0]["resolution"];
                    $scope.task_notes = data[0]["notes"];
                    $scope.edit_status = $scope.task_status;
//alert($scope.edit_status);
                    $('#edit_modal').modal('show');
                });
    };
    $scope.update_task = function () {//fine but needs date validation
        alert($scope.edit_status);
        var due_date = $scope.edit_due_date;
        var good = true;



        if (good === true) {
            alert("Commencing updat");
            $http.post("php_scripts/tasks/task_update.php", {
                'id': $scope.task_id,
                'title': $scope.task_title,
                'description': $scope.task_description,
                'resolution': $scope.task_resolution,
                'notes': $scope.task_notes,
                'due_date': $scope.edit_due_date,
                'status': $scope.edit_status

            }
            ).success(function (data, status, headers, config) {
                $('#edit_modal').modal('hide');
                $scope.read_all($scope.current_list_view);
                alert(data);
                /*Consider returning true/false for data to initiate a alert of success or fail*/
            });
        } else {
            alert("Something went wrong");
        }


    };

    $scope.delete_task = function (id) {//fine
        if (confirm("Are you sure?")) {
            $http.post("php_scripts/tasks/task_delete.php", {'id': id})
                    .success(function (data, status, headers, config) {
                        $scope.read_all($scope.current_list_view);
                    });
        }
    };

});

