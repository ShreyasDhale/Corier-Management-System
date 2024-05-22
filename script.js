
function phoneno() {
    var a = document.getElementById("cont").value;
    if (a.startsWith("0") == false) {
        if (a > 0) {
            if (a.length == 10) {
                document.getElementById("phone").innerHTML = "";
                document.getElementById("btn").disabled = false;
            } else {
                document.getElementById("phone").innerHTML = "Phone Number must be of 10 digit";
                document.getElementById("btn").disabled = true;
            }
        } else {
            document.getElementById("phone").innerHTML = "Phone Number cannot be Negative";
            document.getElementById("btn").disabled = true;
        } 
    } else {
        document.getElementById("phone").innerHTML = "Phone Number cannot start with 0";
        document.getElementById("btn").disabled = true;
    }
}
    function username() {
        var pattern1 = /^[A-Za-z]/ig;
        var pattern2 = /[@_$]/ig;
        var pattern3 = /[0-9]/ig;
        var usr = document.getElementById("user").value;
        if (pattern1.test(usr)) {
            if (pattern2.test(usr)) {
                if (pattern3.test(usr)) {
                    if (usr.length != 0) {
                        if (usr.length >= 6) {
                            document.getElementById("btn").disabled = false;
                            document.getElementById("usr").innerHTML = "";
                        } else {
                            document.getElementById("usr").innerHTML = "Username should be Minimum 6 characters";
                            document.getElementById("btn").disabled = true;
                        }
                    } else {
                        document.getElementById("usr").innerHTML = "Username cannot be Empty";
                        document.getElementById("btn").disabled = true;
                    }
                } else {
                    document.getElementById("usr").innerHTML = "Username should Contain Numbers";
                    document.getElementById("btn").disabled = true;
                }
            } else {
                document.getElementById("usr").innerHTML = "Username Should Contain @,_,$";
                document.getElementById("btn").disabled = true;
            }
        } else {
            document.getElementById("usr").innerHTML = "Username should start with letter";
            document.getElementById("btn").disabled = true;
        }
    }
    function password() {
        var pattern1 = /^[A-Za-z]/ig;
        var pattern2 = /[@_$]/ig;
        var pattern3 = /[0-9]/ig;
        var usr = document.getElementById("pass").value;
        if (pattern1.test(usr)) {
            if (pattern2.test(usr)) {
                if (pattern3.test(usr)) {
                    if (usr.length != 0) {
                        if (usr.length >= 8) {
                            document.getElementById("btn").disabled = false;
                            document.getElementById("pas").innerHTML = "";
                        } else {
                            document.getElementById("pas").innerHTML = "Password should be Minimum 6 characters";
                            document.getElementById("btn").disabled = true;
                        }
                    } else {
                        document.getElementById("pas").innerHTML = "Password cannot be Empty";
                        document.getElementById("btn").disabled = true;
                    }
                } else {
                    document.getElementById("pas").innerHTML = "Password should Contain Numbers";
                    document.getElementById("btn").disabled = true;
                }
            } else {
                document.getElementById("pas").innerHTML = "Password Should Contain @,_,$";
                document.getElementById("btn").disabled = true;
            }
        } else {
            document.getElementById("pas").innerHTML = "Password should start with letter";
            document.getElementById("btn").disabled = true;
        }
    }
    function password1() {
        var pattern1 = /^[A-Za-z]/ig;
        var pattern2 = /[@_$]/ig;
        var pattern3 = /[0-9]/ig;
        var usr = document.getElementById("pass1").value;
        if (pattern1.test(usr)) {
            if (pattern2.test(usr)) {
                if (pattern3.test(usr)) {
                    if (usr.length != 0) {
                        if (usr.length >= 8) {
                            document.getElementById("btn").disabled = false;
                            document.getElementById("pas1").innerHTML = "";
                        } else {
                            document.getElementById("pas1").innerHTML = "Password should be Minimum 6 characters";
                            document.getElementById("btn").disabled = true;
                        }
                    } else {
                        document.getElementById("pas1").innerHTML = "Password cannot be Empty";
                        document.getElementById("btn").disabled = true;
                    }
                } else {
                    document.getElementById("pas1").innerHTML = "Password should Contain Numbers";
                    document.getElementById("btn").disabled = true;
                }
            } else {
                document.getElementById("pas1").innerHTML = "Password Should Contain @,_,$";
                document.getElementById("btn").disabled = true;
            }
        } else {
            document.getElementById("pas1").innerHTML = "Password should start with letter";
            document.getElementById("btn").disabled = true;
        }
    }