function contactform() {//careerform  //contactform

//alert("TEST");

    var name = $('#name').val();

    var email = $('#email').val();

    var phone = $('#cno').val();

    var subject = $('#subject').val();

    var message = $('#msg').val();

    var formData = {name: name, email: email, phone: phone, subject: subject, message: message};



    // alert(firstName);

    // alert('i m here');




    if (callValidation1()) // Calling validation function

    {

        var fdata = new FormData($('#contact-form"').val());

        $.ajax({

            type: 'POST',

            url: "contactmail.php",

            data: fdata,

            success: function (resultData) { //alert("Thank You, Your Form has been submitted Successfully");
                //alert(resultData);
                location.href = "thanks.html"
            }

        });

    }



}



function callValidation1() {

    // console.log('i m here');

    var str = 'Please Enter ';



    var name = $('#name').val();

    var email = $('#email').val();

    var phone = $('#cno').val();

    var subject = $('#subject').val();

    var message = $('#msg').val();


    if (name == '' && email == '' && phone == '' && subject == '' && message == '') {

        alert('Please fill all the Fields');

        return false;

    } else if (name == '' || email == '' || phone == '' || subject == '' || message == '') {

        if (name == '') {

            str = str + 'Name';

            if (email == '' || phone == '' || subject == '' || message == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (email == '') {

            str = str + 'Email ID';

            if (name == '' || phone == '' || subject == '' || message == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (phone == '') {

            str = str + 'Contact No.';

            if (name == '' || email == '' || subject == '' || message == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (subject == '') {

            str = str + 'Subject';

            if (name == '' || email == '' || phone == '' || message == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (message == '') {

            str = str + 'Message';

            if (name == '' || email == '' || phone == '' || subject == '') {

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

        // console.log('i m if email');

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

        //  console.log('i m outside if');

    }

    if (document.getElementById('cno').value == '') {

        // console.log('i m if phone');

        alert('Please enter Number');

        return false;

    } else {

        // console.log('i m else phone');

        var p;

        p = document.getElementById('cno').value;

        // If x is Not a Number or less than one or greater than 10

        if (isNaN(p) || p < 1999999999 || p > 10000000000) {

            // console.log('i m else if phone');

            alert("Enter a valid mobile number");

            return false;

        }

    }


    return true;

}



function careerform() {

    console.log("TEST");

    var name = $('#name').val();

    var email = $('#email').val();

    var qauli = $('#qauli').val();

    var exp = $('#exp').val();

    var inputPost = $('#inputPost').val();

    var inputResume = $('#inputResume').val();

    var formData = {name: name, email: email, qauli: qauli, exp: exp, inputPost: inputPost, inputResume: inputResume};


    console.lgo(formData);
    // alert(firstName);

    // alert('i m here');




    if (callValidation2()) // Calling validation function
    {

//var fdata= new FormData($('#contact-form"').val());
        var fdata = new FormData($("#contact-form")[0]);
        console.log(fdata);
        $.ajax({

            type: 'POST',

            url: "careermail.php",

            data: fdata,

            success: function (resultData) { //alert("Thank You, Your Form has been submitted Successfully");
                console.log(resultData);
                location.href = "thanks.html";
            }

        });

    }

}



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

        // console.log('i m if email');

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

        //  console.log('i m outside if');

    }

    if (document.getElementById('exp').value == '') {

        // console.log('i m if name');

        alert('Please enter Years of Experience');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('exp').value;

        var reg = /^[0-9]*$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Years of Experience must contain only numbers!');

            return false;

        }

    }

    return true;

}


function admissionform() {



    var name = $('#name').val();

    var datepicker = $('#datepicker').val();

    var grade = $('#grade').val();

    var fname = $('#fname').val();

    var fqauli = $('#fqauli').val();

    var foccup = $('#foccup').val();

    var mname = $('#mname').val();

    var mqauli = $('#mqauli').val();

    var moccup = $('#moccup').val();

    var sibinfo = $('#sibinfo').val();

    var con1 = $('#con1').val();

    var con2 = $('#con2').val();

    var pemail1 = $('#pemail1').val();

    var pemail2 = $('#pemail2').val();

    var cs = $('#cs').val();

    var gp = $('#gp').val();

    var cadd = $('#cadd').val();

    var city = $('#city').val();

    var state = $('#state').val();

    var country = $('#country').val();

    var formData = {name: name, datepicker: datepicker, grade: grade, fname: fname, fqauli: fqauli, foccup: foccup, mname: mname, mqauli: mqauli, moccup: moccup, sibinfo: sibinfo, con1: con1, con2: con2, pemail1: pemail1, pemail2: pemail2, cs: cs, gp: gp, cadd: cadd, city: city, state: state, country: country};



    // alert(firstName);

    // alert('i m here');




    if (callValidation3()) // Calling validation function

    {

        $.ajax({

            type: 'POST',

            url: "admissionmail.php",

            data: formData,

            success: function (resultData) { //alert("Thank You, Your Form has been submitted Successfully");

                location.href = "thanks.html"
            }

        });

    }



}



function callValidation3() {

    // console.log('i m here');

    var str = 'Please Enter ';


    var name = $('#name').val();

    var datepicker = $('#datepicker').val();

    var grade = $('#grade').val();

    var fname = $('#fname').val();

    var fqauli = $('#fqauli').val();

    var foccup = $('#foccup').val();

    var mname = $('#mname').val();

    var mqauli = $('#mqauli').val();

    var moccup = $('#moccup').val();

    var sibinfo = $('#sibinfo').val();

    var con1 = $('#con1').val();

    var con2 = $('#con2').val();

    var pemail1 = $('#pemail1').val();

    var pemail2 = $('#pemail2').val();

    var cs = $('#cs').val();

    var gp = $('#gp').val();

    var cadd = $('#cadd').val();

    var city = $('#city').val();

    var state = $('#state').val();

    var country = $('#country').val();



    if (name == '' && datepicker == '' && grade == '' && fname == '' && fqauli == '' && foccup == '' && mname == '' && mqauli == '' && moccup == '' && sibinfo == '' && con1 == '' && con2 == '' && pemail1 == '' && pemail2 == '' && cs == '' && gp == '' && cadd == '' && city == '' && state == '' && country == '') {

        alert('Please fill all the Fields');

        return false;

    } else if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

        if (name == '') {

            str = str + 'Name';

            if (datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (datepicker == '') {

            str = str + 'DOB';

            if (name == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (grade == '') {

            str = str + 'Grade.';

            if (name == '' || datepicker == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (fname == '') {

            str = str + 'Fathers Name';

            if (name == '' || datepicker == '' || grade == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }



        if (fqauli == '') {

            str = str + 'Fathers Qualification';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (foccup == '') {

            str = str + 'Fathers Occupation';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }


        if (mname == '') {

            str = str + 'Mothers Name';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (mqauli == '') {

            str = str + 'Mothers Qualification';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (moccup == '') {

            str = str + 'Mothers Occupation';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (sibinfo == '') {

            str = str + 'Sibling Information';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }


        if (con1 == '') {

            str = str + 'Contact no. 1';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (con2 == '') {

            str = str + 'Contact no. 2';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }


        if (pemail1 == '') {

            str = str + 'Parents Email id no. 1';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (pemail2 == '') {

            str = str + 'Parents Email id no. 2';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (cs == '') {

            str = str + 'Current School';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || gp == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (gp == '') {

            str = str + 'Present Grade';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || cadd == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (cadd == '') {

            str = str + 'Current Address';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || city == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (city == '') {

            str = str + 'City';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || state == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }


        if (state == '') {

            str = str + 'State';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || country == '') {

                str = str + ', ';

            } else {

                str = str + '.';

            }

        }

        if (country == '') {

            str = str + 'Country';

            if (name == '' || datepicker == '' || grade == '' || fname == '' || fqauli == '' || foccup == '' || mname == '' || mqauli == '' || moccup == '' || sibinfo == '' || con1 == '' || con2 == '' || pemail1 == '' || pemail2 == '' || cs == '' || gp == '' || cadd == '' || city == '' || state == '') {

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

        alert('Please enter Name of the Child');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('name').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Child Name must contain only characters');

            return false;

        }

    }



    if (document.getElementById('fname').value == '') {

        // console.log('i m if name');

        alert('Please enter Fathers Name');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('fname').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Fathers Name must contain only characters');

            return false;

        }

    }

    if (document.getElementById('fqauli').value == '') {

        // console.log('i m if name');

        alert('Please enter Fathers Qualification');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('fqauli').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Fathers Qualification must contain only characters');

            return false;

        }

    }


    if (document.getElementById('foccup').value == '') {

        // console.log('i m if name');

        alert('Please enter Fathers Occupation');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('foccup').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Fathers Occupation must contain only characters');

            return false;

        }

    }

    if (document.getElementById('mname').value == '') {

        // console.log('i m if name');

        alert('Please enter Mothers Name');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('mname').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Mothers Name must contain only characters');

            return false;

        }

    }


    if (document.getElementById('mqauli').value == '') {

        // console.log('i m if name');

        alert('Please enter Mothers Qualification');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('mqauli').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Mothers Qualification must contain only characters');

            return false;

        }

    }


    if (document.getElementById('moccup').value == '') {

        // console.log('i m if name');

        alert('Please enter Mothers Occupation');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('moccup').value;

        var reg = /^[A-z ]+$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('Mothers Occupation must contain only characters');

            return false;

        }

    }


    if (document.getElementById('sibinfo').value == '') {

        // console.log('i m if name');

        alert('Please enter No. of Sibling');

        return false;

    } else {

        // console.log('i m else name');

        var x = document.getElementById('sibinfo').value;

        var reg = /^[0-9]*$/;

        if (!reg.test(x)) {

            // console.log('i m else if name');

            alert('No. of Sibling must contain only numbers');

            return false;

        }

    }



    if (document.getElementById('con1').value == '') {

        // console.log('i m if phone');

        alert('Please enter Contact Number 1');

        return false;

    } else {

        // console.log('i m else phone');

        var p;

        p = document.getElementById('con1').value;

        // If x is Not a Number or less than one or greater than 10

        if (isNaN(p) || p < 1999999999 || p > 10000000000) {

            // console.log('i m else if phone');

            alert("Enter a valid mobile number 1");

            return false;

        }

    }


    if (document.getElementById('con2').value == '') {

        // console.log('i m if phone');

        alert('Please enter Contact Number 2');

        return false;

    } else {

        // console.log('i m else phone');

        var p;

        p = document.getElementById('con2').value;

        // If x is Not a Number or less than one or greater than 10

        if (isNaN(p) || p < 1999999999 || p > 10000000000) {

            // console.log('i m else if phone');

            alert("Enter a valid mobile number 2");

            return false;

        }

    }


    if (document.getElementById('pemail1').value == '') {

        // console.log('i m if email');

        alert('Please enter Parents Email ID 1');

        return false;

    } else {

        var email = document.getElementById('pemail1').value;

        var emailReg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);

        if (!emailReg) {

            // console.log('i m in if');

            alert("You have entered an invalid email address 1!")

            return false;

        }

        //  console.log('i m outside if');

    }


    if (document.getElementById('pemail2').value == '') {

        // console.log('i m if email');

        alert('Please enter Parents Email ID 2');

        return false;

    } else {

        var email = document.getElementById('pemail2').value;

        var emailReg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);

        if (!emailReg) {

            // console.log('i m in if');

            alert("You have entered an invalid email address 2!")

            return false;

        }

        //  console.log('i m outside if');

    }
    return true;

}


