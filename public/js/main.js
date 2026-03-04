var $stopChanging = false;

function radioCheck() {
    var check;
    //$('input[name=option]').on('change', function() {
    if ($('input[name=option]').is(':checked')) {
        check = 'Yes';
    } else {
        check = 'No';
    }
    //});
    return check;
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

function validate(date) {
    var eighteenYearsAgo = moment().subtract(18, "years");
    var birthday = moment(date);
    if (!birthday.isValid()) {
        return "invalid date";
    } else if (eighteenYearsAgo.isAfter(birthday)) {
        return "okay, you're good";
    } else {
        return "sorry, no";
    }
}

function numero(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode < 4 || charCode > 4) {
        return false;
    }
    return true;
}

function getAge(birth) {
    var today = new Date();
    var curr_date = today.getDate();
    var curr_month = today.getMonth() + 1;
    var curr_year = today.getFullYear();
    var pieces = birth.split('/');
    var birth_date = pieces[0];
    var birth_month = pieces[1];
    var birth_year = pieces[2];
    if (curr_month == birth_month && curr_date >= birth_date) return parseInt(curr_year - birth_year);
    if (curr_month == birth_month && curr_date < birth_date) return parseInt(curr_year - birth_year - 1);
    if (curr_month > birth_month) return parseInt(curr_year - birth_year);
    if (curr_month < birth_month) return parseInt(curr_year - birth_year - 1);
}

function checkPoBox(id_field) {
    var address_st = document.getElementById(id_field),
        resultDiv = document.getElementById("poboxwarn"),
        poboxReg = /^ *((#\d+)|((box|bin)[-. \/\\]?\d+)|(.*p[ \.]? ?(o|0)[-. \/\\]? *-?((box|bin)|b|(#|n|num|number)?\d+))|(p(ost|ostal)? *(o(ff(ice)?)?)? *((box|bin)|b)? *(#|n|num|number)*\d+)|(p *-?\/?(o)? *-?box)|post office box|((box|bin)|b) *(#|n|num|number)? *\d+|(#|n|num|number) *\d+)/i;
    var match = poboxReg.exec(address_st.value);
    if (match != null) {
        resultDiv.innerHTML = '<p><label class="error">Po Box address is not validate</label></p';
        resultDiv.style.color = "red";
        address_st.classList.remove("valid");
        address_st.value = "";
        $('#demgraphic').attr('onsubmit', 'return false;');
    } else {
        $("#poboxwarn").empty();
        resultDiv.style.color = "green";
        address_st.classList.add("valid");
        $('#demgraphic').attr('onsubmit', 'return true;');
    }
}
function bqp_checkboox(check_ele, section_ele) {
    // Get the checkbox
    var checkBox = document.getElementById(check_ele);
    // Get the output text
    var section = document.getElementById(section_ele);
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
        section.style.display = "block";
    } else {
        section.style.display = "none";
    }
}
function ischecked(idelement) {
    var check;
    if ($('#' + idelement).is(':checked')) {
        check = 'Yes';
    } else {
        check = 'No';
    }
    return check;
}
//CONVERT TO BASE64
function getBase64(file, hidden_input) {
    var imgresult;
    var reader = new FileReader();
    if (file) {
        reader.readAsDataURL(file);
    } else {
        //document.getElementById(hidden_input).value = "0";
    }
    reader.onload = function () {
        imgresult = reader.result;
        document.getElementById(hidden_input).value = imgresult;
        //console.log(reader.result);
    };
    reader.onerror = function (error) {
        console.log('Error: ', error);
    };
}

