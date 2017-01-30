/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*Consider something like when mouseleave,
 *  have function check if any input was changed by taking input value and compare to innerHtml of the p tags,
 *   if yes, change the tr to some other color like yellow ,else remove the color/make sure its colorless.*/

/**
 * Maybe hover over the tr to show the edit/remove button, click edit to enable editing and make the tr yellow. 
 * **/
app.controller('vaultController', function ($scope, $http) {
    hasPermission();
    document.title = "Vault";
    $scope.purpose = "";
    $scope.source = "";
    $scope.username = "";
    $scope.password = "";
    $scope.email = "";
    $scope.search = "";
    var source_head_clicked = 0;



    $scope.create = function () {
        //alert("clicked");
        /*Must check for valid url*/
        var patt = new RegExp("@");
        var res = patt.test($scope.email);
        if (res) {
            $http.post('php_scripts/vault/create.php', {
                'purpose': $scope.purpose,
                'source': $scope.source,
                'username': $scope.username,
                'password': $scope.password,
                'email': $scope.email
            }
            ).success(function (data) {
                if (data === "SUCCESS") {
                    $scope.reset();
                    $scope.read_all();


                } else {
                    alert("It seems some sort of error has occured.");
                }
            });
        } else {
            alert("That does not seem to be a properly formatted email.");
        }
    };
    $scope.reset = function () {
        $scope.purpose = "";
        $scope.source = "";
        $scope.username = "";
        $scope.password = "";
        $scope.email = "";
    };
    $scope.read_all = function () {
        $http.post("php_scripts/vault/read_all.php").success(function (data) {
            $scope.entries = data;


        });
    };

    $scope.update = function (id) {
        alert("update is not implemented yet.");
        var source = $("#edit_source_" + id).val();
        var purpose = $("#edit_purpose_" + id).val();
        var email = $("#edit_email_" + id).val();
        var uname = $("#edit_uname_" + id).val();
        var pwd = $("#edit_pword_" + id).val();
        //alert(source+"\n"+purpose+"\n"+email+"\n"+uname+"\n"+pwd);

        $http.post("php_scripts/vault/update.php", {
            'id': id
            , 'source': source
            , 'purpose': purpose
            , 'email': email
            , 'uname': uname
            , 'pwd': pwd
        }).success(function (data, status) {
            if (status === 200) {
                if (data["status_code"] === 1) {
                    $scope.read_all();
                }
            } else {
                alert(data);
            }


        });

    };

    $scope.remove = function (id) {

        if (confirm(" The deleted entry will not be retrievable.\nAre you sure you want to delete this entry?")) {
            $http.post("php_scripts/vault/delete.php", {'entry_id': id}).success(function (data, status) {
                if (status === 200) {
                    if (data["status_code"] === 1) {
                        $scope.read_all();
                    }else{
                        alert(data);
                    }
                }

            });
        }
    };


    $scope.orderByThis = function () {
        var sign = "-";
        source_head_clicked++;
        if (source_head_clicked % 2 === 1) {
            sign = "+";
        }
        ;
        $scope.myOrderThis = sign + "source";
    };
    $scope.show_modal = function (index) {
        alert(index);
    };

    $scope.recognize = function (id) {

        alert("Row of Entry ID clicked: " + id);
        for (i = 0; i < $scope.entries.length; i++) {
            if ($scope.entries[i]["id"] === id) {
                var entry = $scope.entries[i];
                //alert(entry["id"] + "\n" + entry["source"] + "\n" + entry["email"] + "\n" + entry["uname"] + "\n" + entry["pword"]);
                break;
            }
        }

        var kids = $("#table_row_" + id);

        kids.each(function () {

            $.each(this.cells, function () {
                //alert(this.id);
            });

        });
        $scope.hide_all_rows_edit_controls();
    };

    $scope.enable_inline_edit = function (id) {
        $("#edit_purpose_" + id).removeClass("hide");
        ;
        $("#edit_source_" + id).removeClass("hide");
        ;
        $("#edit_email_" + id).removeClass("hide");
        ;
        $("#edit_uname_" + id).removeClass("hide");
        ;
        $("#edit_pword_" + id).removeClass("hide");
        ;
        $("#save_button_" + id).removeClass("hide");
        ;
        $("#reset_button_" + id).removeClass("hide");
        ;

        $("#display_purpose_" + id).addClass("hide");
        $("#display_source_" + id).addClass("hide");
        $("#display_email_" + id).addClass("hide");
        $("#display_uname_" + id).addClass("hide");
        $("#display_pword_" + id).addClass("hide");
        $("#edit_button_" + id).addClass("hide");
        //$("#delete_button_" + id).addClass("hide");
    };
    $scope.disable_inline_edit = function (id) {
        $("#edit_purpose_" + id).addClass("hide");
        $("#edit_source_" + id).addClass("hide");
        $("#edit_email_" + id).addClass("hide");
        $("#edit_uname_" + id).addClass("hide");
        $("#edit_pword_" + id).addClass("hide");
        $("#save_button_" + id).addClass("hide");
        $("#reset_button_" + id).addClass("hide");

        $("#display_purpose_" + id).removeClass("hide");
        ;
        $("#display_source_" + id).removeClass("hide");
        ;
        $("#display_email_" + id).removeClass("hide");
        ;
        $("#display_uname_" + id).removeClass("hide");
        ;
        $("#display_pword_" + id).removeClass("hide");
        ;
        $("#edit_button_" + id).removeClass("hide");
        ;
        //$("#delete_button_" + id).removeClass("hide");
        ;
    };

    $scope.hide_all_rows_edit_controls = function () {
        for (i = 0; i < $scope.entries.length; i++) {
            var entry = $scope.entries[i];
            var id = entry["id"];
            $scope.disable_inline_edit(id);
            //$scope.enable_inline_edit(id);

        }
    };


    $scope.reset_inplace_form = function (id) {
        for (i = 0; i < $scope.entries.length; i++) {
            var entry = $scope.entries[i];

            if (entry["id"] === id) {
                $("#edit_purpose_" + id).val(entry["purpose"]);
                $("#edit_source_" + id).val(entry["source"]);
                $("#edit_email_" + id).val(entry["email"]);
                $("#edit_uname_" + id).val(entry["uname"]);
                $("#edit_pword_" + id).val(entry["pword"]);

                break;
            }
        }
    };
});