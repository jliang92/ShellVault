/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*global angular*/
app.controller('timelogController', function ($scope, $http) {
    //alert("Page loaded, you can check credentials and redirect at begining of the view controller code");
 hasPermission();
    $scope.get_ids = function () {
        var entries = "";
        $.each($("input[name='log_entry']:checked"), function () {
            entries = $(this).val() + " " + entries;
        });
        alert($("input[name='log_entry']:checked").length + " checked boxes :\n" + entries);
    };
    $scope.update_message = "";
    /*LEARNING POINT: notice that in this angular function, i can use jquery commands like .prop,
     * However if i create a jquery function and try to use it in the angular function, it doesnt work*/
    $scope.time_log_regulate_controls = function () {
        $http.get("php_scripts/timelog/time_log_status.php").success(
                function (data) {
                    var log_status = data["log_status"];
                    switch (log_status) {
                        case '0':
                        { //alert("There are no records available.");
                            $("#start").prop('disabled', false);
                            $("#stop").prop('disabled', true);
                            break;
                        }
                        case '1':
                        {//alert("Incomplete: log session in progress");
                            $("#start").prop('disabled', true);
                            $("#stop").prop('disabled', false);
                            break;
                        }
                        case '2':
                        {//alert("Complete: log session finished");
                            $("#start").prop('disabled', false);
                            $("#stop").prop('disabled', true);
                            break;
                        }
                        case '3':
                        {
                            alert("Error: Deleted entry is in result set");
                            $("#start").prop('disabled', true);
                            $("#stop").prop('disabled', true);
                            break;
                        }
                        default:
                        {
                            alert("Something went wrong " + log_status);
                            alert(data["error_message"]);
                            $("#start").prop('disabled', true);
                            $("#stop").prop('disabled', true);
                            break;
                        }
                    }
                });
    };

    $scope.time_log_read_all = function () {
        //alert("reading all");
        $http.get("php_scripts/timelog/time_log_read_all.php").success(
                function (data, status) {
                    if (status === 200) {
                        $scope.entries = data;
                        $scope.time_log_regulate_controls();
                    }

                });
    };

    $scope.time_log_clock_in = function () {
        // alert("Clocking In");
        $http.get("php_scripts/timelog/time_log_clock_in.php").success(
                function (data) {
                    var resp_code = data["status_code"];
                    var resp_status = data["response_message"];
                   // alert(data["query"]);alert(data);
                    if (resp_code === 1) {
                        $scope.time_log_read_all();
                    } else {
                        alert(resp_code + " " + resp_status);
                    }
                });
    };

    $scope.time_log_clock_out = function () {
        //alert("Clocking Out");
        $http.get("php_scripts/timelog/time_log_clock_out.php").success(
                function (data, status) {
                    if (status === 200) {
                        var resp_code = data["status_code"];
                        var resp_status = data["response_message"];
                        if (resp_code ===1) {
                            $scope.time_log_read_all();
                        } else {
                            alert(resp_code + " " + resp_status);
                        }
                    }
                });
    };
    $scope.show_modal = function () {
        $("#edit_time_log_modal").modal({backdrop: "static"});//this one will prevent a person from clicking out of modal

    };

    $scope.close_modal = function () {
        //Can also add a data-dismiss attribute in a button on the modal as well as add a class="close" for styling a X
        $("#edit_time_log_modal").modal('hide');
    };
    $scope.time_log_read_one = function (id) {

        if (id.length > 0) {
            $http.post("php_scripts/timelog/time_log_read_one.php", {'log_id': id})
                    .success(function (data, status) {
                        if (status === 200) {

                            $scope.time_log_id = data["id"];
                            $scope.time_log_start_date = data["start_date"];
                            $scope.time_log_time_in = data["time_in"];
                            $scope.time_log_end_date = data["end_date"];
                            $scope.time_log_time_out = data["time_out"];
                            $scope.time_log_hours = data["hours"];
                            $scope.time_log_minutes = data["minutes"];
                            $scope.time_log_seconds = data["seconds"];
                            $scope.time_log_log_status = data["log_status"];
                            $scope.time_log_notes = data["notes"];
                            $scope.time_log_status_name = data["status_name"];
                            $scope.time_log_query = data["query"];
                            $scope.show_modal();
                        } else {
                            alert("Status:" + status);
                        }

                    });
        } else {
            alert("Function triggered but no id was supplied.");
        }

    };

    $scope.time_log_archive = function () {
        alert("Not Implemented yet");
        /* var entries = "";
         $.each($("input[name='log_entry']:checked"), function () {
         entries = $(this).val() + "," + entries;
         });
         $http.post("php_scripts/timelog/json_scripts/time_log_archive_mass.php", {'log_ids': entries})
         .success(function (data, status) {
         if (status === 200) {
         
         $scope.time_log_read_all();
         alert(data);
         }
         });*/
    };

    $scope.time_log_delete = function (id) {
        if (confirm("Are you sure?")) {
            $http.post("php_scripts/timelog/time_log_delete.php", {'log_id': id})
                    .success(function (data, status) {
                        if (status === 200) {
                            switch (data["status"]) {
                                case 'SUCCESS':
                                {
                                    $scope.time_log_read_all();
                                    break;
                                }
                                case 'FAIL':
                                {

                                }
                                case 'ERROR':
                                {

                                }
                                default:
                                {
                                    alert(data["status"] + " while attempting to delete time log record." + data);
                                    //alert(data);
                                    // alert(id);
                                    break;
                                }
                            }

                        }
                    });
        }
    };

    $scope.time_log_delete_mass = function () {

        alert("Not implemented yet.");
        /*  if (confirm("Are you sure?")) {
         var entries = "";
         $.each($("input[name='log_entry']:checked"), function () {
         entries = $(this).val() + "," + entries;
         });
         $http.post("php_scripts/timelog/json_scripts/time_log_delete_mass.php", {'log_ids': entries})
         .success(function (data, status) {
         
         if (status === 200) {
         $scope.time_log_read_all();
         alert(data);
         }
         
         });}*/

    };

    $scope.time_log_update = function () {
       // alert("attemtping update");




        $http.post("php_scripts/timelog/time_log_update.php",
                {
                    'log_id': $scope.time_log_id,
                    'notes': $("#timelog_notes").val()
                })
                .success(function (data, status) {
                    $scope.update_message = "";
                    alert(data["status"]);
                    if (status === 200) {

                        switch (data["status"]) {
                            case 'SUCCESS':
                            {
                                $scope.update_message = data["status"];
                                $('#edit_time_log_modal').modal('hide');
                                break;
                            }
                            case 'FAIL':
                            {
                            }
                            case 'ERROR':
                            {
                                $scope.update_message = data["status"];
                            }
                            default :
                            {
                                alert(data["status"] + "while attempting to save changes." + data);
                                break;
                            }
                        }
                    }
                });
    };

    $scope.enable_bulk = function () {
        $("#archive").prop("disabled", false);
        $("#delete").prop("disabled", false);
    };

    $scope.disable_bulk = function () {
        $("#archive").prop("disabled", true);
        $("#delete").prop("disabled", true);
    };
    $scope.get_check_boxes = function () {
        var checked_count = $("input[name='log_entry']:checked").length;
        if (checked_count > 0) {
            $scope.enable_bulk();
        } else {
            $scope.disable_bulk();
        }
    };

    $scope.fill_or_clear = function () {
        var is_checked = $("#mass_check_uncheck").is(":checked");
        if (is_checked === true) {
            //  alert("true");
            $scope.enable_bulk();
        } else if (is_checked === false) {
            //   alert("false");
            $scope.disable_bulk();
        }
        $.each($("input[name='log_entry']"), function () {
            $(this).prop("checked", is_checked);
        });
    };

});






