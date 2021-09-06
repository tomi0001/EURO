function menu(name) {
    var color = select(name);

    $("#" + name).removeClass(color).addClass("is-red");
}

function menu2(name) {
    var color = select(name);
    $("#" + name).removeClass("is-red").addClass(color);
}

function select(name) {
    switch (name) {
        case 'country': color = "is-green";
            break;
        case 'match': color = "is-blue";
            break;
        case 'groups': color = 'is-darkGreen';
            break;
        case 'showMatch': color = 'is-purple';
            break;
        case 'addGroups': color = 'is-yellow';
            break;
        case 'settingGroups': color = 'is-gray';
            break;
        default: color  = "";
            break;
    }
    return color;
    
}


/*
$("#addCountry").load(url + "?" + $( "form#addCountry" ).serialize()).ajaxStart(function() {
        $("#loading").removeClass("is-success");
    });
  
 * 
 * 
 */  


function addMatch(url) {
   $("#ajax").ajaxStart(function() {
        $("#loading").addClass("is-loading");
    }).load(url + "?" + $( "form#addMatch" ).serialize()).ajaxStop(function () {
    $("#loading").removeClass("is-loading");
  });
    
}


function addCountry(url) {
    
    $("#ajax").ajaxStart(function() {
        $("#loading").addClass("is-loading");
    }).load(url + "?" + $( "form#addCountry" ).serialize()).ajaxStop(function () {
    $("#loading").removeClass("is-loading");
  });
}


function addGroups(url) {
    $("#ajax").ajaxStart(function() {
        $("#loading").addClass("is-loading");
    }).load(url + "?" + $( "form#addGroups" ).serialize()).ajaxStop(function () {
    $("#loading").removeClass("is-loading");
  });
}



function addCountryEnter(e,url) {
    if (e.keyCode == 13) {
        addCountry(url);
        return false;
    }
}


function addGroupsEnter(e,url) {
    if (e.keyCode == 13) {
        addGroups(url);
        return false;
    }
}

function updateMatch(id,url) {
    if ($("#value1_" + id).val() == "" || $("#value2_" + id).val() == "") {
        alert("Uzupełnij obie wartości");
    }
    else {
        $("#div").load(url + "?id=" + id + "&value1=" + $("#value1_" + id).val() + "&value2=" + $("#value2_" + id).val() );
            setTimeout(function(){
   window.location.reload(1);
}, 2000);
    }

}



function editMatch(id,url) {
    $("#Match_" + id).html("<div><div style='width: 45%; float: left;'><input type='number' id='value1_" + id + "' class='input is-small' name='country1' min=0 max=40></div> <div style='width: 10%; float: left;'>&nbsp;</div><div style='width: 45%; float: left;'><input type='number'  class='input is-small' name='country2'  id='value2_" + id + "' min=0 max=40></div></div>");
    $("#Edit_" + id).html("<a onclick='updateMatch(" + id + ",\"" + url + "\")' class='link'>Uaktualnij</a>");
}


var country = [];
//var countryId = [];
function selectCountry(id,i) {
    
    //alert($("#" + id).css("background-color"));
    //$("#" + id).toggleClass("countrybackground");
    
    if ($("#"  +  i +  "_" + id).text() == "") {
        return;
    }
    if ($("#" + i + "_" +  id).hasClass("countrybackground")  ) {
        $("#"+  i + "_" +  id).removeClass("countrybackground");
        var index = country.indexOf($("#"  +  i +  "_" + id).text() + "_" +  id + "_DEL");
        country.splice(index, 1);
    }
    else {
        $("#update").prop("disabled",false);
        country.push($("#"  +  i +  "_" + id).text() + "_" +  id + "_DEL");
        $("#" + i  + "_" +  id).addClass("countrybackground");
    } 
     
}



function checkCountry(groups) {
    
    for (i=0;i< 7;i++) {
        if (($("select[name=" + 'country_' + groups + "]").val()   ==  $("#" + i +  "_" + groups).text())) {
            return -1;
        }
        
    }
    return 0;
    
    
    
    
}
function loadGroups(url) {
    location.href = url + "/" + $("select[name=groups]").val();
}

function addCountryToGroup(groups,j) {
    if ($("select[name=" + 'country_' + groups + "]").val() == "") {
        return;
    }
    var bool = checkCountry(groups);
    if (bool == -1) {
        alert("Już jest takie państwo w tej grupie");
        return;
    }
    
    for (i=j;i< 7;i++) {
        

        
         if ( $("#"  + i   + "_" +  groups).text() != ""   ) {
            //alert("Już jest takie państwo w tej grupie");
            continue;
        }


        /*
        if ( $("#" + i +  "_" + groups).text() !=   $("select[name=" + 'country_' + groups + "]").val() ) {
       
        }
         * 
         */
        else {
                 $("#"   + i   + "_" +  groups).text($("select[name=" + 'country_' + groups + "]").val());
                 $("#update").prop("disabled",false);
                 var str = $("select[name=" + 'country_' + groups + "]").val();
                 var str2 = str.replaceAll(" ","*");
                 country.push(str2 + "_" +  groups);
                 //countryId.push(id);
            break;
        }
    }
    
    
}


function updateGroups(url) {
    //alert(( country.length ));
    //alert(JSON.stringify( country ));
    $("#div").load(url + "?array=" + JSON.stringify( country ));
    $("#update").prop("disabled",true);
    
}