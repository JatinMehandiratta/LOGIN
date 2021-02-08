function edit_row(id) {
    var fname = document.getElementById("fname_val" + id).innerHTML;
    var lname = document.getElementById("lname_val" + id).innerHTML;
    var age = document.getElementById("age_val" + id).innerHTML;
    var email = document.getElementById("email_val" + id).innerHTML;
    var gender = document.getElementById("gender_val" + id).innerHTML;
    var occupation = document.getElementById("occu_val" + id).innerHTML;

    document.getElementById("fname_val" + id).innerHTML = "<input type='text' id='fname_text" + id + "' value='" + fname + "'>";
    document.getElementById("lname_val" + id).innerHTML = "<input type='text' id='lname_text" + id + "' value='" + lname + "'>";
    document.getElementById("age_val" + id).innerHTML = "<input type='number' id='age_text" + id + "' value='" + age + "'>";
    document.getElementById("email_val" + id).innerHTML = "<input type='email' id='email_text" + id + "' value='" + email + "'>";
    document.getElementById("gender_val" + id).innerHTML = "<input type='text' id='gender_text" + id + "' value='" + gender + "'>";
    document.getElementById("occu_val" + id).innerHTML = "<input type='text' id='occu_text" + id + "' value='" + occupation + "'>";


    document.getElementById("edit_button" + id).style.display = "none";
    document.getElementById("save_button" + id).style.display = "block";
}

function save_row(id) {
    var fname = document.getElementById("fname_text" + id).value;
    var lname = document.getElementById("lname_text" + id).value;
    var age = document.getElementById("age_text" + id).value;
    var email = document.getElementById("email_text" + id).value;
    var gender = document.getElementById("gender_text" + id).value;
    var occupation = document.getElementById("occu_text" + id).value;

    function validateemail() {
        var x = email;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
            alert("Please enter a valid e-mail address");
            return false;
        } return true;
    }


    function validate() {
        if (fname == null || fname == "") {
            alert("Firstname is mandatory");
            return false;
        } if (lname == null || lname == "") {
            alert("Lastname is mandatory");
            return false;
        } if (age == NaN || age == "") {
            alert("Age is mandatory");
            return false;
        } if (email == null || email == "") {
            alert("Email is mandatory");
            return false;
        }
        if (email == null || email == "") {
            alert("Email is mandatory");
            return false;
        } if (!validateemail()) {
            return false;
        }
        if (gender == null || gender == "") {
            alert("Gender is mandatory");
            return false;
        } if (occupation == null || occupation == "") {
            alert("Occupation is mandatory");
            return false;
        } return true;
    }
    if (validate() == true) {


        $.ajax
            ({
                type: 'post',
                url: 'modifyRecord.php',
                data: {
                    edit_row: 'edit_row',
                    row_id: id,
                    fname_val: fname,
                    lname_val: lname,
                    age_val: age,
                    email_val: email,
                    gender_val: gender,
                    occu_val: occupation
                },
                success: function (response) {
                    if (response == "success") {
                        document.getElementById("fname_val" + id).innerHTML = fname;
                        document.getElementById("lname_val" + id).innerHTML = lname;
                        document.getElementById("age_val" + id).innerHTML = age;
                        document.getElementById("email_val" + id).innerHTML = email;
                        document.getElementById("gender_val" + id).innerHTML = gender;
                        document.getElementById("occu_val" + id).innerHTML = occupation;

                        document.getElementById("edit_button" + id).style.display = "block";
                        document.getElementById("save_button" + id).style.display = "none";
                        window.location = "index.php";
                        alert("This row with id " + id + "edited successfully");
                    }
                }
            });
    }
}



function delete_row(id) {

    $.ajax
        ({
            type: 'post',
            url: 'modifyRecord.php',
            data: {
                delete_row: 'delete_row',
                row_id: id,
            },
            success: function (response) {
                console.log(response,"ajax");
                if (response == "success") {
                    var row = document.getElementById("row" + id);
                    row.parentNode.removeChild(row);
                    window.location = "index.php";
                    alert("Row with id  " + id + " deleted successfully");

                }
            }
        });
}
