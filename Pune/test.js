/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("document").ready(function () {

    $("#contact-form").submit(function (e) {
        $("#submitbutton").val("Please wait.....");
        $("#submitbutton").attr("disabled", true);
        if (callValidation2()) {
            e.preventDefault();
            var formdata = new FormData($("#contact-form")[0]);//get all form data include file
            $.ajax({
                type: 'POST',
                url: 'careermail.php',
                data: formdata,
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (obj) {
                    console.log(obj);
                    $("#submitbutton").val("Send message");
                    $("#submitbutton").attr("disabled", false);
                    location.href = "thanks.html";
                },
                error: function (request, status, error) {
                    console.log(error);
                    
                }
            });
        } else {
            $("#submitbutton").val("Send message");
            $("#submitbutton").attr("disabled", false);
        }
        return false;
    });
    function callValidation2() {

        // console.log('i m here');

        var str = 'Please Enter ';


        var name = $('#name').val();

        var email = $('#email').val();

        var qauli = $('#qauli').val();

        var exp = $('#exp').val();

        var inputPost = $('#inputPost').val();

        var inputResume = $('#inputResume').val();


        if (name == '' && email == '' && qauli == '' && exp == '' && inputPost == '' && inputResume == '') {

            alert('Please fill all the Fields');

            return false;

        } else if (name == '' || email == '' || qauli == '' || exp == '' || inputPost == '' || inputResume == '') {

            if (name == '') {

                str = str + 'Name';

                if (email == '' || qauli == '' || exp == '' || inputPost == '' || inputResume == '') {

                    str = str + ', ';

                } else {

                    str = str + '.';

                }

            }
            if (email == '') {
                str = str + 'Email ID';
                if (name == '' || qauli == '' || exp == '' || inputPost == '' || inputResume == '') {
                    str = str + ', ';
                } else {
                    str = str + '.';
                }
            }
            if (qauli == '') {
                str = str + 'Qualifications.';
                if (name == '' || email == '' || exp == '' || inputPost == '' || inputResume == '') {
                    str = str + ', ';
                } else {
                    str = str + '.';
                }
            }
            if (exp == '') {
                str = str + 'Years of Experience';
                if (name == '' || email == '' || qauli == '' || inputPost == '' || inputResume == '') {
                    str = str + ', ';
                } else {
                    str = str + '.';
                }
            }
            if (inputPost == '') {
                str = str + 'Position to apply';
                if (name == '' || email == '' || qauli == '' || exp == '' || inputResume == '') {
                    str = str + ', ';
                } else {
                    str = str + '.';
                }
            }
            if (inputResume == '') {
                str = str + 'Resume in PDF Format';
                if (name == '' || email == '' || qauli == '' || exp == '' || inputPost == '') {
                    str = str + ', ';
                } else {
                    str = str + '.';
                }
            }
            alert(str);
            return false;
        }
        if (document.getElementById('name').value == '') {
            // console.log('i m if name');
            alert('Please enter Name');
            return false;
        } else {
            // console.log('i m else name');
            var x = document.getElementById('name').value;
            var reg = /^[A-z ]+$/;
            if (!reg.test(x)) {
                // console.log('i m else if name');
                alert('Name must contain only characters');
                return false;
            }
        }
        if (document.getElementById('email').value == '') {
            alert('Please enter Email');
            return false;
        } else {
            var email = document.getElementById('email').value;
            var emailReg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
            if (!emailReg) {
                // console.log('i m in if');
                alert("You have entered an invalid email address!")
                return false;
            }
        }
        if (document.getElementById('exp').value == '') {
            alert('Please enter Years of Experience');
            return false;
        } else {
            var x = document.getElementById('exp').value;
            var reg = /^[0-9]*$/;
            if (!reg.test(x)) {
                alert('Years of Experience must contain only numbers!');
                return false;
            }
        }
        return true;
    }
});