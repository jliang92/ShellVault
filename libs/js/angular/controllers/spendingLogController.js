/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


app.controller('spendingLogController', function ($scope, $http) {
     hasPermission();
    var today = new Date();
    var day_of_month = today.getDate();
    var year = today.getFullYear();
    var month = today.getMonth();

    if (month < 12) {
        month++;
    }
    var today_date = month + "-" + day_of_month + "-" + year;
    //alert(today_date);
    $("#date_stamp").val(today_date);
    $("#date_stamp").datepicker({dateFormat: 'mm-dd-yy'});

    document.title = "Spending Log";
    $scope.cost = 0.01;
    $scope.description = "";
    $scope.date_stamp = today_date;

    $scope.option_type = "";

    $scope.first_load = true;
    $scope.insert = function () {
        //alert("clicked");
        var good = true;
        if (($scope.description).length === 0) {
            good = confirm("The description is blank, do you want to continue?");
        }

        if (check_mm_dd_yyyy($scope.date_stamp) === false) {
            good = false;
        } else {
            //alert("date is properly formatted.");
        }

        if (good === true) {
            var res = ($("#date_stamp").val()).split("-");
            var target_date = res[2] + "-" + res[0] + "-" + res[1];
            //alert(target_date);
            $http.post("php_scripts/spending_log/create.php", {
                'date_stamp': target_date,
                'transaction_type': $scope.option_type.id,
                'cost': $scope.cost,
                'description': $scope.description
            }).success(function (data, status) {

                if (status === 200) {
                    if (data["status_code"] === 1) {
                        //alert("success");
                        $scope.display_month_data($scope.selected_year_month);
                        $scope.cost = 0.01;
                        $scope.description = "";
                        //$scope.date_stamp = today_date;
                        $("#date_stamp").focus();
                    } else {
                        alert(data);
                        $scope.error = data["query"];
                    }
                }

            });
        }
    };

    /*Consider something like json data that contains 2 sets of sub-json data,
     *  first set will be the json data compressed by date,
     *  second will be the more detailed one with repeating dates,
     *  must consider formatting,
     *  This way, when the modal is brought up, i wont have to make db call again unless i refresh the json data like via read_all or update*/



    $scope.remove = function (id) {
        if (confirm("Are you sure you want to delete this entry?\nYou cannot retrieve it afterwards.")) {
            $http.post("php_scripts/spending_log/remove.php", {'id': id}).success(function (data, status) {


                if (status === 200) {
                    if (data["status_code"] === 1) {
                        $scope.display_month_data($scope.selected_year_month);
                        $scope.close_modal();
                    } else {
                        alert(data);
                    }
                }
            });
        }
    };
    $scope.reset = function () {
        //alert("Reset clicked");
        $("#date_stamp").val(today_date);
        $scope.date_stamp = today_date;
        $scope.cost = 0.01;
        $scope.description = "";

    };



    $scope.show_modal = function () {
        /*load data with that date_stamp into the modal*/
        //alert("clicked");
        //$("#detail_modal").modal('show');//lets user click out of modal
        $("#detail_modal").modal({backdrop: "static"});//this one will prevent a person from clicking out of modal

    };

    $scope.close_modal = function () {
        //Can also add a data-dismiss attribute in a button on the modal as well as add a class="close" for styling a X
        $("#detail_modal").modal('hide');
    };

    $scope.read_types = function () {
        $http.get("php_scripts/spending_log/read_types.php").success(function (data) {
            $scope.type_options = data;
            //alert(data);


        });
    };
    $scope.read_types();

    $scope.display_year_month = function () {
        $http.post("php_scripts/spending_log/read_year_month.php")
                .success(function (data, status) {
                    if (status === 200) {
                        $scope.year_month_list = data;
                    }
                    if ($scope.first_load === true) {
                        //alert("This is first load");
                        //alert("First Load"+data[0]["year_month"]);
                        $scope.display_month_data(data[0]["year_month"]);
                        $scope.first_load = false;
                    }

                });
    };
    $scope.display_month_data = function (year_month) {
        $scope.selected_year_month = year_month;
        var contents = year_month.split("-");
        $scope.year = contents[0];
        $scope.month = get_month(parseInt(contents[1]));
        $http.post("php_scripts/spending_log/read_month.php", {'year_month': year_month})
                .success(function (data, status) {
                    if (status === 200) {
                        $scope.month_days_list = data;
                        $scope.amount = 0;
                        for (var i = 0; i < data.length; i++) {
                            $scope.amount += parseFloat(data[i]["amount_spent"]);
                        }

                    }
                });
    };
    $scope.display_day_data = function (date_stamp) {

        $http.post("php_scripts/spending_log/read_day.php", {'date': date_stamp})
                .success(function (data, status) {
                    if (status === 200) {
                        //alert(data);
                        $scope.day_cursor = date_stamp;
                        $scope.days_transactions = data;
                        $scope.day_total = 0;
                        for (var i = 0; i < data.length; i++) {
                            $scope.day_total += parseFloat(data[i]["cost"]);
                        }
                        $scope.show_modal();

                    }
                });
    };
    function get_month(i) {
        switch (i) {
            case 1:
            {
                return "January";
               
            }
            case 2:
            {
                return "Febuary";
            }
            case 3:
            {
                return "March";
            }
            case 4:
            {
                return "April";
            }
            case 5:
            {
                return "May";
            }
            case 6:
            {
                return "June";
            }
            case 7:
            {
               return "July";
            }
            case 8:
            {
               return "August";
            }
            case 9:
            {
                return "September";
            }
            case 10:
            {
                return "October";
            }
            case 11:
            {
                return "November";
            }
            case 12:
            {
                return "December"
            }
            default:
            {
                return "Error, unsupported integer";
                break;
            }
        }
    }
    /*var total_header_clicked = 0;
     var date_header_clicked = 0;
     
     
     $scope.orderByThis = function (x) {
     //alert(Array.isArray($scope.focused_set));
     var sign = "-";
     if (x === 'total') {
     total_header_clicked++;
     if (total_header_clicked % 2 === 1) {
     sign = "+";
     }
     }
     if (x === 'date') {
     date_header_clicked++;
     if (date_header_clicked % 2 === 1) {
     sign = "+";
     }
     }
     
     $scope.myOrderThis = sign + x;
     };*/

});

