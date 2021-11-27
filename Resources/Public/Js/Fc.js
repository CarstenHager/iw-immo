var LawMinMax;
var iMulti;
var iKidsPromo;
var iBuildPromoMin;
var iBuildPromoMax;
var iZinsPerc;
var iTilgPerc;
var strBuildPromotionExec;
var repeaterMonth = [];
var repeaterYear = [];
var iAnzahlSonderTilgungen = 0;
var planAnsicht = 0;
var arrayUniqueTilgung = new Array();
var arrayTilgung = new Array();
var error = false;
var __do_alert = false;
var sollzinsManuallyChanged = false;
var _usrMsgNaN = String("Bitte geben Sie eine Zahl, ohne Kommas \",\" und Punkte \".\" ein.\nVerzichten Sie auf Cent-Betr\u00E4ge, da diese ignoriert werden.\nBeispiel: 500000\n");
var __curr_focus_value = String("");
var states = {
    "Bundesländer": [{
        "Bundesland"       : "Baden-Württemberg",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "5,0",
        "GeoID"            : "10808"
    }, {
        "Bundesland"       : "Bayern",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "3,5",
        "GeoID"            : "10809"
    }, {
        "Bundesland"       : "Berlin",
        "Marklerprovision" : "7,14",
        "Grunderwerbsteuer": "6,0",
        "GeoID"            : "10811"
    }, {
        "Bundesland"       : "Brandenburg",
        "Marklerprovision" : "7,14",
        "Grunderwerbsteuer": "6,5",
        "GeoID"            : "10812"
    }, {
        "Bundesland"       : "Bremen",
        "Marklerprovision" : "5,95",
        "Grunderwerbsteuer": "5,0",
        "GeoID"            : "10804"
    }, {
        "Bundesland"       : "Hamburg",
        "Marklerprovision" : "6,25",
        "Grunderwerbsteuer": "4,5",
        "GeoID"            : "10802"
    }, {
        "Bundesland"       : "Hessen",
        "Marklerprovision" : "5,95",
        "Grunderwerbsteuer": "6,0",
        "GeoID"            : "10806"
    }, {
        "Bundesland"       : "Mecklenburg-Vorpommern",
        "Marklerprovision" : "5,95",
        "Grunderwerbsteuer": "5,0",
        "GeoID"            : "10813"
    }, {
        "Bundesland"       : "Niedersachsen",
        "Marklerprovision" : "5,95",
        "Grunderwerbsteuer": "4,5",
        "GeoID"            : "10803"
    }, {
        "Bundesland"       : "Nordrhein-Westfalen",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "6,5",
        "GeoID"            : "10805"
    }, {
        "Bundesland"       : "Nordrhein-Westfalen: Münster",
        "Marklerprovision" : "4,76",
        "Grunderwerbsteuer": "6,5",
        "GeoID"            : "10805515"
    }, {
        "Bundesland"       : "Rheinland-Pfalz",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "5,0",
        "GeoID"            : "10807"
    }, {
        "Bundesland"       : "Rheinland-Pfalz: Kreis Mainz-Bingen",
        "Marklerprovision" : "5,95",
        "Grunderwerbsteuer": "5,0",
        "GeoID"            : "10807339"
    }, {
        "Bundesland"       : "Saarland",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "6,5",
        "GeoID"            : "10810"
    }, {
        "Bundesland"       : "Sachsen",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "3,5",
        "GeoID"            : "10814"
    }, {
        "Bundesland"       : "Sachsen-Anhalt",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "5,0",
        "GeoID"            : "10815"
    }, {
        "Bundesland"       : "Schleswig-Holstein",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "6,5",
        "GeoID"            : "10801"
    }, {
        "Bundesland"       : "Thüringen",
        "Marklerprovision" : "3,57",
        "Grunderwerbsteuer": "6,5",
        "GeoID": "10816"
    }]
};

function checkParty(elem){
    var myDate = new Date();
    var id;
    var m = "ddlMonth";
    var y = "ddlYear";

    if (elem.id == "ddlYear")
        m = "ddlMonth2";
    else {
        id = parseFloat(elem.id.replace("ddlYear", "")) + 1;
        m = m + id;
        y = y + (id - 1);
    }

    if ($("#" + y + "").val() != myDate.getFullYear() + 1) {

        $("#" + m + " > option").remove();
        for (var i = 1; i <= 12; i++) {
            $("#" + m + "").append($("<option></option>").val(i).html(('0' + i).slice(-2)));
        }
    }
    else {

        $("#" + m + " > option").remove();
        for (var j = (myDate.getMonth() + 1); j <= 12; j++) {
            $("#" + m + "").append($("<option></option>").val(j).html(('0' + j).slice(-2)));
        }
    }
}

//// ### Boxes ###
function loseFocusTxtBox(oEl, bA) {


    $("#hffullPrice").val(intMakeReal($("#fullPrice").val()));

    if (typeof (oEl) != "object" && !oEl.value) return;

    if (isNaN(oEl.value) && isNaN(intMakeReal(oEl.value, bA))) {
        this.__do_alert = false;
        oEl.blur();
        oEl.value = "0";
        oEl.focus();
        alert(_usrMsgNaN);
        return;
    }

    if (oEl.value.indexOf(",") != -1 || oEl.value.indexOf(".") != -1) {

        oEl.value = "0";
        this.__curr_focus_value = "0";
        this.__do_alert = false;
        alert(_usrMsgNaN);
    }


    if (__do_alert) {
        oEl.value = "0";
        this.__curr_focus_value = "0";
        this.__do_alert = false;
        alert(_usrMsgNaN);
    }

    if (oEl.value == "")
        oEl.value = __curr_focus_value;
    else if (oEl.value == " ")
        oEl.value = "0";

    this.__curr_focus_value = "";


    if (oEl.id == "kidsCount") {
        CheckNextButton2();
        Calculate2();
        return;
    }

    Calculate();
}

function intMakeReal(val, iCheckKommata) {
    var bCheckKomma = true;
    if (typeof (iCheckKommata) != "undefined")
        if (iCheckKommata == 1) bCheckKomma = false;

    if (isNaN(val)) {
        var RetVal = val;

        if (typeof (RetVal) == "undefined") return 0;

        if (RetVal.indexOf(",") != -1 && RetVal.indexOf(".") == -1) {
            // Kommas durch Punkte ersetzen
            RetVal = RetVal.replace(/,/g, ".");
            if (bCheckKomma) {
                RetVal = RetVal.split(".")[0]; // Nachkommastellen abschneiden
                this.__do_alert = true;
            }
        }
        else if (RetVal.indexOf(".") != -1 && RetVal.indexOf(",") == -1) {
            if (bCheckKomma) {
                // Punkte durch NICHTS ersetzen
                RetVal = RetVal.replace(/\./g, "");
                this.__do_alert = true;
            }
        }
        if (typeof (RetVal) == "string" && !isNaN(RetVal))
            RetVal = parseFloat(RetVal);
        //		RetVal = Math.round( RetVal );

        return RetVal;
    }
    else {
        var RetVal = String(val);
        if (RetVal == "") return 0;

        if (RetVal.indexOf(".") != -1) {
            //             ESCAPE ZEICHEN VOR DEM PUNKT NIEMALS VERGESSEN
            //            if (RetVal.substr(RetVal.length - 2).indexOf(".") != -1) {
            this.__do_alert = true;
            //            }
            //            RetVal = RetVal.replace(/\./g, "");
        }

        if (typeof (RetVal) == "string")
            return parseFloat(RetVal);
        else
            return RetVal;
    }
}

function strMakeReadAble(val) {
    var sVal = String(val);
    if (sVal.indexOf(",") != -1) {
        sVal = sVal.split(",")[0]; // nachkommastellen abschneiden
    }

    var iLen = sVal.length - 1;
    var x = -1;
    var RetVal = String("");
    for (var i = iLen; i >= 0; i--) {
        if (x == 2) {
            RetVal += "." + sVal.charAt(i);
            x = 0;
        }
        else {
            RetVal += sVal.charAt(i);
            x++;
        }
    }

    return StringRev(RetVal);
}

function StringRev(Str) {
    var tmp = new Array(Str.length);
    for (var i = 0; i < String(Str).length; i++) {
        tmp[tmp.length - i - 1] = String(Str).charAt(i);
    }

    return tmp.join("");
}

function Calculate() {

    var calcManagerVal = strMakeReadAble(Math.round(intMakeReal($("#fullPrice").val()) * intMakeReal($("#managerProc").val().replace(/\./g, ","), 1) / 100));
    var calcLawVal = strMakeReadAble(Math.round(intMakeReal($("#fullPrice").val()) * intMakeReal($("#lawProc").val(), 1) / 100));
    var calcTaxVal = strMakeReadAble(Math.round(intMakeReal($("#fullPrice").val()) * intMakeReal($("#taxProc").val(), 1) / 100));

    if (!isNaN(calcManagerVal))
        $("#calcManager").val(calcManagerVal);
    if (!isNaN(calcLawVal))
        $("#calcLaw").val(calcLawVal);
    if (!isNaN(calcTaxVal))
        $("#calcTax").val(calcTaxVal);

    $("#lbNebenkosten").val(strMakeReadAble(parseInt(calcManagerVal.replace(/\./g, "")) + parseInt(calcLawVal.replace(/\./g, "")) + parseInt(calcTaxVal.replace(/\./g, ""))));

    if ($("#jaehrlich").is(':checked')) {
        if ($("#TilgungYear1").val() != "")
            $("#lbAngaben").val(strMakeReadAble($("#TilgungYear1").val()));
        else
            $("#lbAngaben").val(0);
    }
    else {
        var x = 0;
        for (var i = 0; i < $(".year").length; i++) {
            if ($(".TilgungWert")[i].value != null && $(".TilgungWert")[i].value != "") {
                x += parseInt($(".TilgungWert")[i].value);
            }
        }
        $("#lbAngaben").val(strMakeReadAble(x));
    }

    var AllExpend = 0; // alle Ausgaben
    var AllIncome = 0; // alle Einnahmen

    AllExpend = intMakeReal($("#buildPrice").val().replace(/\./g, "")) + intMakeReal($("#fullPrice").val().replace(/\./g, "")) + intMakeReal($("#calcManager").val().replace(/\./g, "")) + intMakeReal($("#calcLaw").val().replace(/\./g, "")) + intMakeReal($("#calcTax").val().replace(/\./g, ""));
    $("#resultPrice").val(strMakeReadAble(AllExpend));

    AllIncome = intMakeReal($("#elsePlus").val().replace(/\./g, ""));

    var ToLend = AllExpend - AllIncome;
    if (ToLend > 0) {
        $("#toLend").val(strMakeReadAble(ToLend));
    }
    else {
        $("#toLend").val("0");
    }

}

function SetCommission(strVal) {
    if (!$("#managerProc")) return;

    $("#managerProc").val(strVal);

    Calculate();
}
function SetCommission1(strVal) {
    if (!$("#taxProc")) return;
    d$("#taxProc").val(strVal);
    Calculate();
}

function CheckLawCosts() {
    if (intMakeReal($("#fullPrice"))) return;

    if (LawCostsMax != undefined) {
        if (intMakeReal(intMakeReal($("#fullPrice").val()) < intMakeReal(LawMinMax)))
            $("#lawProc").val(String(LawCostsMax).replace(/\./g, ","));
        else
            $("#lawProc").val(String(LawCostsMin).replace(/\./g, ","));
    }
}


function loseFocusTxtBox2(oEl) {
    if (typeof (oEl) != "object" && !oEl.value) return;

    var sVal = String(oEl.value);
    sVal = sVal.replace(/,/g, ".");

    if (isNaN(sVal)) {
        // not numeric
        alert("Bitte geben Sie eine Gleitkommazahl an.\nNachkommastellen mit einem Punkt \".\" angegeben.\nBeispiel: 5.5");
    }

    if (oEl.value == "")
        oEl.value = __curr_focus_value;
    else if (oEl.value == " ")
        oEl.value = "0";

    this.__curr_focus_value = "";

    if (oEl.id == "managerProc") {
        Calculate();
    }
    else {
        Calculate();
    }
}

function FormatCurrency(value) {
    var iLength = -1;
    var RetVal = String("");
    var strValue = String(value);
    var strTmp = String("");
    var strTmp2 = String("");
    var x = -1;

    // Komma suchen und zwei Stellen danach abschneiden
    var searchResult = strValue.search(/\./);
    if (searchResult != -1) {
        // falls nach dem Komma nur ein Zeichen kommt, eine Null dranhaengen
        if ((strValue.length - strValue.lastIndexOf(".")) == 2)
            strValue += "0";
        RetVal = strValue.substring(0, searchResult + 3);
    }
    else
        RetVal = strValue += ".00";

    // den letzten Punkt durch ein Komma ersetzen
    RetVal = RetVal.replace(/\./, ",");

    // --- Punkte für die Tausenderstellen einfügen
    // Anzahl der Vorkommastellen bestimmen
    iLength = RetVal.length - 3;
    if (iLength > 3) {
        for (var i = iLength - 1; i >= 0; i--) {
            if (x == 2) {
                strTmp += "." + RetVal.charAt(i);
                x = 0;
            }
            else {
                strTmp += RetVal.charAt(i);
                x++;
            }
        }
        strTmp2 = StringRev(strTmp);
        RetVal = strTmp2 + RetVal.substr(RetVal.lastIndexOf(","), 3);
    }
    return RetVal;
}


$.fn.extend({
    scrollToMe: function () {
        var x = $(this).offset().top - 20;
        $('html,body').animate({scrollTop: x}, 500);
    }
});


function RepeaterMonth() {

    var zeileSeite = "";
    var zeilePopUp = "";
    var myDate = new Date();

    for (var i = 0; i < repeaterMonth.length; i++) {


        myDate.setUTCFullYear(repeaterMonth[i].year, repeaterMonth[i].month, 0);

        if (i % 2 == 0) {
            zeileSeite = zeileSeite + '<tr style="background-color:#cfcfcf;"><td class="middle" width="13%"> ' + '01.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterMonth[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterMonth[i].schuldenE) + '</td> ' + '</tr>';
            zeilePopUp = zeilePopUp + '<tr style="background-color:#cfcfcf;"><td class="middle" width="13%"> ' + '01.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterMonth[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterMonth[i].schuldenE) + '</td> ' + '</tr>';
        }
        else {
            zeileSeite = zeileSeite + '<tr><td class="middle" width="13%"> ' + '01.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterMonth[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterMonth[i].schuldenE) + '</td>' + '</tr>';
            zeilePopUp = zeilePopUp + '<tr><td class="middle" width="13%"> ' + '01.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + repeaterMonth[i].month + '.' + repeaterMonth[i].year + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterMonth[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterMonth[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterMonth[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterMonth[i].schuldenE) + '</td>' + '</tr>';
        }
    }

    var seite = $(zeileSeite);
    var popup = $(zeilePopUp);

    seite.appendTo($("#Tilgungstabelle"));
    popup.appendTo($("#TilgungstabellePopUp"));

}

function RepeaterYear() {

    var myDate = new Date();
    var zeileSeite = "";
    var zeilePopUp = "";


    for (var i = 0; i < repeaterYear.length; i++) {

        myDate.setUTCFullYear(repeaterYear[i].year + 1, repeaterYear[i].month - 1, 0);

        if (i % 2 == 0) {
            zeileSeite = zeileSeite + '<tr style="background-color:#cfcfcf;"><td class="middle" width="13%"> ' + '01.' + repeaterYear[i].month + '.' + repeaterYear[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + ('0' + (repeaterYear[i].month - 1)).slice(-2) + '.' + (repeaterYear[i].year + 1) + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterYear[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterYear[i].schuldenE) + '</td> ' + '</tr>';
            zeilePopUp = zeilePopUp + '<tr style="background-color:#cfcfcf;"><td class="middle" width="13%"> ' + '01.' + repeaterYear[i].month + '.' + repeaterYear[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + ('0' + (repeaterYear[i].month - 1)).slice(-2) + '.' + (repeaterYear[i].year + 1) + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterYear[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterYear[i].schuldenE) + '</td> ' + '</tr>';
        }
        else {
            zeileSeite = zeileSeite + '<tr><td class="middle" width="13%"> ' + '01.' + repeaterYear[i].month + '.' + repeaterYear[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + ('0' + (repeaterYear[i].month - 1)).slice(-2) + '.' + (repeaterYear[i].year + 1) + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterYear[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterYear[i].schuldenE) + '</td> ' + '</tr>';
            zeilePopUp = zeilePopUp + '<tr><td class="middle" width="13%"> ' + '01.' + repeaterYear[i].month + '.' + repeaterYear[i].year + ' - <br />' + myDate.toString().substr(8, 2) + '.' + ('0' + (repeaterYear[i].month - 1)).slice(-2) + '.' + (repeaterYear[i].year + 1) + '</td> ' + '<td class="middle text_right" width="16%"> ' + FormatCurrency(repeaterYear[i].schuldenA) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].rate) + '</td> ' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].zinssatz) + '</td>' + '<td class="middle text_right" width="12%"> ' + FormatCurrency(repeaterYear[i].tilgung) + '</td> ' + '<td class="middle text_right" width="15%"> ' + FormatCurrency(repeaterYear[i].sondertilgung) + '</td>' + '<td class="middle text_right" width="17%"> ' + FormatCurrency(repeaterYear[i].schuldenE) + '</td> ' + '</tr>';
        }
    }

    var seite = $(zeileSeite);
    var popup = $(zeilePopUp);

    seite.appendTo($("#Tilgungstabelle"));
    popup.appendTo($("#TilgungstabellePopUp"));
}

function Check() {

    error = false;
    var myDate = new Date();
    var nowMonth = myDate.getMonth() + 1;
    var nowYear = myDate.getFullYear();
    var darlehen = 0;
    darlehen = $("#toLend").val().replace(/\./g, "");
    var monatsrate = (parseInt(darlehen) + parseInt(darlehen * $("#zinssatz").val().replace(/,/g, "."))) / 100 / 12;

    if ($("#ddlstate").val() == 0) {
        $("#lbError").show();
        $("#ddlstate").css('background-color', '#efb2b2');
        $("#ddlstate").scrollToMe();
        error = true;
    }
    else {
        $("#lbError").hide();
        $("#ddlstate").css('background-color', '');
    }

    if ($("#fullPrice").val() == "") {
        $("#lbErrorPrice").show();
        $("#fullPrice").css('background-color', '#efb2b2');
        if (!error) {
            $("#fullPrice").scrollToMe();
            error = true;
        }
    }
    else {
        $("#lbErrorPrice").hide();
        $("#fullPrice").css('background-color', '');
    }

    if ($("#zinssatz").val() == "") {
        $("#lbErrorZins").show();
        $("#zinssatz").css('background-color', '#efb2b2');
        if (!error) {
            $("#zinssatz").scrollToMe();
            error = true;
        }
    }
    else {
        $("#lbErrorZins").hide();
        $("#zinssatz").css('background-color', '');
    }

    if (error == true) {
        return false;
    }

    if ($("#Tilgungssatz").is(':checked')) {

        if ($("#tilgung").val().replace(/,/g, ".") >= 1) {
            return true;
        }
        else {
            alert("Der angegebene Tilgungssatz ist zu klein. Bitte geben Sie einen Tilgungssatz von min. 1% ein.");
            return false;
        }

    }
    else {
        if ($("#tilgung").val().replace(/,/g, ".") >= extround(monatsrate, 100)) {
            return true;
        }
        else {
            alert("Die angegebene Monatsrate ist zu klein. Bitte geben Sie mindestens eine Rate in Höhe von " + FormatCurrency(extround(monatsrate, 100)) + " EUR an");
            return false;
        }
    }
}

function extround(zahl, n_stelle) {
    zahl = (Math.round(zahl * n_stelle) / n_stelle);
    return zahl;
}

function Result() {

    if (repeaterMonth.length != 0)
        repeaterMonth = [];

    if (repeaterYear.length != 0)
        repeaterYear = [];

    $("#Tilgungstabelle").empty();
    $("#TilgungstabellePopUp").empty();

    if (arrayUniqueTilgung.length != 0)
        arrayUniqueTilgung = [];

    if (arrayTilgung.length != 0)
        arrayTilgung = [];

    var myDate = new Date();

    if ($("#TilgungYear1").val() != null && $("#TilgungYear1").val() != "" && $("#jaehrlich").is(':checked')) {
        arrayTilgung.push($("#ddlMonth").val());
        arrayTilgung.push($("#TilgungYear1").val());
    }

    for (var i = 0; i < $(".year").length; i++) {
        if ($(".TilgungWert")[i].value != null && $(".TilgungWert")[i].value != "" && $("#einmalig").is(':checked')) {
            arrayUniqueTilgung.push($(".month")[i].value);
            arrayUniqueTilgung.push($(".year")[i].value);
            arrayUniqueTilgung.push($(".TilgungWert")[i].value);
        }
    }

    var zinsen = 0;
    var tilgungsrate = 0;
    var tempTilgung = 0;
    var tempZinsen = 0;
    var year = 0;
    var month = 0;
    var textYear;
    var textMonth;
    var tempDarlehnsrate = 0;
    var sonderUniqueTilgung = 0;
    var sonderTilgung = 0;
    var enthaltendeTilgung = 0;
    var u = 0;
    var Rmonth = 0;
    var Ryear = 0;
    var RschuldenA = 0;
    var Rrate = 0;
    var Rzinssatz = 0;
    var Rtilgung = 0;
    var RschuldenE = 0;
    var Rsondertilgung = 0;
    var Ymonth = 0;
    var Yyear = 0;
    var YschuldenA = 0;
    var Yzinssatz = 0;
    var Ytilgung = 0;
    var YschuldenE = 0;
    var Ysondertilgung = 0;

    var nowMonth = myDate.getMonth() + 1;
    var nowYear = myDate.getFullYear();


    var darlehen = $("#toLend").val().replace(/\./g, "");
    var zinssatz = $("#zinssatz").val().replace(/,/g, ".");
    var tilgung = $("#tilgung").val().replace(/,/g, ".");
    var zinsbindung = $("#ddlZinsbindung").val();
    var tempDarlehen = darlehen;

    if ($("#Tilgungssatz").is(':checked')) {
        $("#darlehensrate").val(FormatCurrency(extround((darlehen * zinssatz + darlehen * tilgung) / 100 / 12, 100)));
        tempDarlehnsrate = $("#darlehensrate").val().replace(/\./g, "").replace(/,/g, ".");
    }
    else {
        $("#darlehensrate").val(FormatCurrency(tilgung));
        tempDarlehnsrate = tilgung;
    }

    if (tempDarlehnsrate <= 0) {
        alert("Die Darlehensrate beträgt 0,00 €. Bitte ändern Sie Ihre Eingaben!");
        return false;
    }

    YschuldenA = extround(tempDarlehen, 100);

    for (var i = 0; i < zinsbindung; i++) {

        for (var x = 0; x < 12; x++) {

            if ((nowYear == myDate.getFullYear() + parseFloat(zinsbindung)) && (nowMonth == myDate.getMonth() + 1)) {
                zinsbindung = zinsbindung + 1;
                break;
            }

            month++;
            if (month == 12) {
                year++;
                month = 0;
            }

            if (!(myDate.getDate() != 1 && nowMonth == myDate.getMonth() + 1 && nowYear == myDate.getFullYear())) {

                for (var z = 0; z < (arrayUniqueTilgung.length / 3); z++) {
                    if (arrayUniqueTilgung[u] == nowMonth && arrayUniqueTilgung[u + 1] == nowYear) {
                        sonderUniqueTilgung = parseFloat(sonderUniqueTilgung) + parseFloat(arrayUniqueTilgung[u + 2]);
                    }
                    u = u + 3;
                }

                u = 0;

                if (arrayTilgung.length != 0 && arrayTilgung[0] == nowMonth && nowYear != myDate.getFullYear()) {
                    sonderTilgung = arrayTilgung[1];
                }
            }

            Rsondertilgung = extround(sonderTilgung, 100) + extround(sonderUniqueTilgung, 100);
            Ysondertilgung += Rsondertilgung;
            RschuldenA = extround(tempDarlehen, 100) - extround(Rsondertilgung, 100);
            tempDarlehen = parseFloat(tempDarlehen) - parseFloat(sonderTilgung) - parseFloat(sonderUniqueTilgung);

            if (tempDarlehen <= 0) {
                tempDarlehen = parseFloat(tempDarlehen) + parseFloat(sonderTilgung) + parseFloat(sonderUniqueTilgung);
                Rsondertilgung = extround(tempDarlehen, 100);
                enthaltendeTilgung = enthaltendeTilgung + parseFloat(tempDarlehen);
                tempZinsen = parseFloat(tempZinsen) + parseFloat(tempDarlehen);
                tempTilgung = darlehen;
                tempDarlehen = 0;
                RschuldenA = RschuldenE;
                RschuldenE = extround(tempDarlehen, 100);
                i = zinsbindung + 1;
                Rmonth = nowMonth;
                Ryear = nowYear;
                repeaterMonth.push({
                    "month"        : ('0' + Rmonth).slice(-2),
                    "year"         : Ryear,
                    "schuldenA"    : RschuldenA,
                    "rate"         : 0,
                    "zinssatz"     : 0,
                    "tilgung"      : 0,
                    "schuldenE"    : RschuldenE,
                    "sondertilgung": Rsondertilgung
                });

                if (Ymonth == 12)
                    Ymonth = 0;

                repeaterYear.push({
                    "month"        : ('0' + (parseInt(Ymonth) + 1)).slice(-2),
                    "year"         : (Ryear - 1),
                    "schuldenA"    : YschuldenA,
                    "rate"         : extround(Rrate * 12, 100),
                    "zinssatz"     : Yzinssatz,
                    "tilgung"      : Ytilgung,
                    "schuldenE"    : RschuldenE,
                    "sondertilgung": Rsondertilgung
                });

                break;
            }

            enthaltendeTilgung = parseFloat(enthaltendeTilgung) + parseFloat(sonderTilgung) + parseFloat(sonderUniqueTilgung);
            zinsen = ((tempDarlehen * zinssatz / 100) / 12);
            Rzinssatz = extround(zinsen, 100);
            Yzinssatz += Rzinssatz;
            tempZinsen = tempZinsen + zinsen;
            tilgungsrate = tempDarlehnsrate - zinsen;
            Rrate = extround(tempDarlehnsrate, 100);
            Rtilgung = extround(tilgungsrate, 100);
            Ytilgung += Rtilgung;
            tempTilgung = parseFloat(tempTilgung) + parseFloat(tilgungsrate) + parseFloat(sonderTilgung) + parseFloat(sonderUniqueTilgung);
            tempDarlehen = parseFloat(tempDarlehen) - parseFloat(tilgungsrate);
            RschuldenE = extround(tempDarlehen, 100)

            if (tempDarlehen <= 0) {
                tempTilgung = darlehen;
                tempDarlehen = 0;
                Ytilgung -= Rtilgung;
                RschuldenE = extround(tempDarlehen, 100);
                Rtilgung = RschuldenA;
                Ytilgung += Rtilgung;
                i = zinsbindung + 1;
                Rmonth = nowMonth;
                Ryear = nowYear;
                repeaterMonth.push({
                    "month"        : ('0' + Rmonth).slice(-2),
                    "year"         : Ryear,
                    "schuldenA"    : RschuldenA,
                    "rate"         : Rrate,
                    "zinssatz"     : Rzinssatz,
                    "tilgung"      : Rtilgung,
                    "schuldenE"    : RschuldenE,
                    "sondertilgung": Rsondertilgung
                });

                if (Ymonth == 12)
                    Ymonth = 0;

                repeaterYear.push({
                    "month"        : ('0' + (parseInt(Ymonth) + 1)).slice(-2),
                    "year"         : (Ryear - 1),
                    "schuldenA"    : YschuldenA,
                    "rate"         : extround(Rrate * 12, 100),
                    "zinssatz"     : Yzinssatz,
                    "tilgung"      : Ytilgung,
                    "schuldenE"    : RschuldenE,
                    "sondertilgung": Ysondertilgung
                });

                break;
            }

            Rmonth = nowMonth;
            Ymonth = Rmonth;
            Ryear = nowYear;

            nowMonth++;
            sonderTilgung = 0;
            sonderUniqueTilgung = 0;

            if (nowMonth == 13) {
                nowMonth = 1;
                nowYear++;
            }

            repeaterMonth.push({
                "month"        : ('0' + Rmonth).slice(-2),
                "year"         : Ryear,
                "schuldenA"    : RschuldenA,
                "rate"         : Rrate,
                "zinssatz"     : Rzinssatz,
                "tilgung"      : Rtilgung,
                "schuldenE"    : RschuldenE,
                "sondertilgung": Rsondertilgung
            });
        }

        if (i > zinsbindung)
            break;

        if (Ymonth == 12)
            Ymonth = 0;

        repeaterYear.push({
            "month"        : ('0' + (parseInt(Ymonth) + 1)).slice(-2),
            "year"         : (Ryear - 1),
            "schuldenA"    : YschuldenA,
            "rate"         : extround(Rrate * 12, 100),
            "zinssatz"     : Yzinssatz,
            "tilgung"      : Ytilgung,
            "schuldenE"    : RschuldenE,
            "sondertilgung": Ysondertilgung
        });
        YschuldenA = RschuldenE;
        Yzinssatz = 0;
        Ytilgung = 0;
        Ysondertilgung = 0;
    }

    sonderTilgung = 0;
    sonderUniqueTilgung = 0;

    if (tempDarlehen > 0) {

        for (var i = tempDarlehen; i > 0;) {

            u = 0;

            month++;
            if (month == 12) {
                year++;
                month = 0;
            }

            for (var z = 0; z < (arrayUniqueTilgung.length / 3); z++) {

                if (arrayUniqueTilgung[u] == nowMonth && arrayUniqueTilgung[u + 1] == nowYear) {
                    sonderUniqueTilgung = parseInt(sonderUniqueTilgung) + parseInt(arrayUniqueTilgung[u + 2]);
                }
                u = u + 3;
            }

            if (arrayTilgung.length != 0 && arrayTilgung[0] == nowMonth) {
                sonderTilgung = arrayTilgung[1];
            }

            i = i - (tempDarlehnsrate - (i * zinssatz / 100) / 12) - sonderTilgung - sonderUniqueTilgung;

            nowMonth++;
            sonderTilgung = 0;
            sonderUniqueTilgung = 0;

            if (nowMonth == 13) {
                nowMonth = 1;
                nowYear++;
            }
        }
    }

    if (year == 1) {
        textYear = " Jahr und ";
    }
    else
        textYear = " Jahre und ";

    if (month == 1) {
        textMonth = " Monat";
    }
    else
        textMonth = " Monate";

    $("#gesamtlaufzeit").val(year + textYear + month + textMonth);
    $("#zinszahlung").val(FormatCurrency(tempZinsen));
    $("#getilgterBetrag").val(FormatCurrency(tempTilgung));
    $("#restschuld").val(FormatCurrency(darlehen - tempTilgung));
    $("#enthalteneTilgung").val(FormatCurrency(enthaltendeTilgung));

    printSite();

    return true;
}

//Druckansicht
function printSite() {

    var myDate = new Date();
    var nowMonth = myDate.getMonth() + 1;
    var nowYear = myDate.getFullYear();
    var day = myDate.getDate();


    $("#pnlSondertilgung").hide();
    $("#pnlSondertilgung2").hide();
    $("#pnlSondertilgung3").hide();
    $("#pnlSondertilgung4").hide();
    $("#pnlSondertilgung5").hide();
    $("#pnlSondertilgung6").hide();

    if ($("#buildPrice").val() == "")
        $("#buildPrice").val(0);

    if ($("#managerProc").val() == "")
        $("#managerProc").val(0);

    if ($("#lawProc").val() == "")
        $("#lawProc").val(0);

    if ($("#elsePlus").val() == "")
        $("#elsePlus").val(0);

    $("#lbKaufpreis").text(FormatCurrency($("#fullPrice").val().replace(/\./g, "")) + ' €');
    $("#lbBauRenovierung").text(FormatCurrency($("#buildPrice").val().replace(/\./g, "")) + ' €');
    $("#lbMarklerProvisionProzent").text(' (' + $("#managerProc").val() + ' %)');
    $("#lbMarklerProvision").text(FormatCurrency($("#calcManager").val().replace(/\./g, "")) + ' €');
    $("#lbNotarGerichtProzent").text(' (' + $("#lawProc").val() + ' %)');
    $("#lbNotarGericht").text(FormatCurrency($("#calcLaw").val().replace(/\./g, "")) + ' €');
    $("#lbGrunderwerbssteuerProzent").text(' (' + $("#taxProc").val() + ' %)');
    $("#lbGrunderwerbssteuer").text(FormatCurrency($("#calcTax").val().replace(/\./g, "")) + ' €');
    $("#lbEigenkapital").text(FormatCurrency($("#elsePlus").val().replace(/\./g, "")) + ' €');
    $("#lbDarlehensbetrag").text(FormatCurrency($("#toLend").val().replace(/\./g, "")) + ' €');
    $("#lbSollzinssatz").text($("#zinssatz").val() + ' %');
    $("#lbZinsbindung").text($("#ddlZinsbindung").val() + ' Jahre');

    if ($("#Tilgungssatz").is(':checked'))
        $("#lbDruckansichtTilgung").text("Tilgungssatz");
    else
        $("#lbDruckansichtTilgung").text("Monatsrate");

    $("#lbTilgungssatz").text($("#tilgung").val() + $("#tilgungsSymbol").text());

    if (typeof arrayTilgung[1] != 'undefined' && arrayTilgung[1] != '0') {
        if (nowMonth < arrayTilgung[0] || (nowMonth == arrayTilgung[0] && day == 1))
            $("#lbSondertilgungDate").text('01.' + ('0' + arrayTilgung[0]).slice(-2) + '.' + nowYear);
        else
            $("#lbSondertilgungDate").text('01.' + ('0' + arrayTilgung[0]).slice(-2) + '.' + parseInt(nowYear + 1));

        $("#lbSondertilgungJahr").text(FormatCurrency($("#TilgungYear1").val().replace(/\./g, "")) + ' €');
        $("#pnlSondertilgung").show();
    }

    if (typeof arrayUniqueTilgung[2] != "undefined" && arrayUniqueTilgung[2] != '0') {
        if (!(day != 1 && nowMonth >= arrayUniqueTilgung[0] && nowYear == arrayUniqueTilgung[1])) {
            $("#lbSondertilgungDate2").text('01.' + ('0' + arrayUniqueTilgung[0]).slice(-2) + '.' + arrayUniqueTilgung[1]);
            $("#lbSondertilgungEinmalig").text(FormatCurrency(arrayUniqueTilgung[2].replace(/\./g, "")) + ' €');
            $("#pnlSondertilgung2").show();
        }
    }
    if (typeof arrayUniqueTilgung[5] != 'undefined' && arrayUniqueTilgung[5] != '0') {
        if (!(day != 1 && nowMonth >= arrayUniqueTilgung[3] && nowYear == arrayUniqueTilgung[4])) {
            $("#lbSondertilgungDate3").text('01.' + ('0' + arrayUniqueTilgung[3]).slice(-2) + '.' + arrayUniqueTilgung[4]);
            $("#lbSondertilgungEinmalig2").text(FormatCurrency(arrayUniqueTilgung[5].replace(/\./g, "")) + ' €');
            $("#pnlSondertilgung3").show();
        }
    }
    if (typeof arrayUniqueTilgung[8] != "undefined" && arrayUniqueTilgung[8] != '0') {
        if (!(day != 1 && nowMonth >= arrayUniqueTilgung[6] && nowYear == arrayUniqueTilgung[7])) {
            $("#lbSondertilgungDate4").text('01.' + ('0' + arrayUniqueTilgung[6]).slice(-2) + '.' + arrayUniqueTilgung[7]);
            $("#lbSondertilgungEinmalig3").text(FormatCurrency(arrayUniqueTilgung[8].replace(/\./g, "")) + ' €');
            $("#pnlSondertilgung4").show();
        }
    }
    if (typeof arrayUniqueTilgung[11] != "undefined" && arrayUniqueTilgung[11] != '0') {
        if (!(day != 1 && nowMonth >= arrayUniqueTilgung[9] && nowYear == arrayUniqueTilgung[10])) {
            $("#lbSondertilgungDate5").text('01.' + ('0' + arrayUniqueTilgung[9]).slice(-2) + '.' + arrayUniqueTilgung[10]);
            $("#lbSondertilgungEinmalig4").text(FormatCurrency(arrayUniqueTilgung[11].replace(/\./g, "")) + ' €');
            $("#pnlSondertilgung5").show();
        }
    }
    if (typeof arrayUniqueTilgung[14] != "undefined" && arrayUniqueTilgung[14] != '0') {
        if (!(day != 1 && nowMonth >= arrayUniqueTilgung[12] && nowYear == arrayUniqueTilgung[13])) {
            $("#lbSondertilgungDate6").text('01.' + ('0' + arrayUniqueTilgung[12]).slice(-2) + '.' + arrayUniqueTilgung[13]);
            $("#lbSondertilgungEinmalig5").text(FormatCurrency(arrayUniqueTilgung[14].replace(/\./g, "")) + ' €');
            $("#pnlSondertilgung6").show();
        }
    }

    /*---------------------------------------------------------------------------------------------------------------------------*/

    $("#lbMonatlicheRate").text($("#darlehensrate").val() + ' €');
    $("#lbRestschuld").text($("#restschuld").val() + ' €');
    $("#lbZinszahlung").text($("#zinszahlung").val() + ' €');
    $("#lbGetilgterBetrag").text($("#getilgterBetrag").val() + ' €');
    $("#lbSummeSondertilgung").text($("#enthalteneTilgung").val() + ' €');
    $("#lbLaufzeit").text($("#gesamtlaufzeit").val());
}


$(function () {

    $("#pnlDruckansicht").hide();
    $("#lbError").hide();
    $("#lbErrorPrice").hide();
    $("#lbErrorZins").hide();
    $("#pnlAdditionalCosts").hide();
    $("#pnlResult").hide();
    $("#pnlRepayment").hide();
    $("#pnlTilgungsplan").hide();
    $("#pnlTilgungUnique").hide();

    var array = $("#hfZinssatz").val().split('|');
    $("#zinssatz").val(array[1]);

    //Befüllung der DropDownListe für Anzahl der Jahre
    var myDate = new Date();
    for (var i = 1; i <= $("#ddlZinsbindung").val(); i++) {
        $(".year").append($("<option></option>").val(myDate.getFullYear() + i).html(myDate.getFullYear() + i));
    }

    //Monate für das aktuelle Jahr
    for (var i = (myDate.getMonth() + 1); i <= 12; i++) {
        $(".month").append($("<option></option>").val(i).html(('0' + i).slice(-2)));
    }

    //Befüllung der DropDownListe für Bundesländer
    var obj = states;

    //Bundesland einstellen, wenn ExposeID übergeben, funktion beibehalten
    var geoid = $("#hfGeoID").val();
    if (geoid != "undefined" && geoid != "") {
        if (obj.Bundesländer[10].GeoID == geoid.substr(0, 8)) {
            $(".state option:eq(" + '11' + ")").prop("selected", true);
            $("#managerProc").val(obj.Bundesländer[10].Marklerprovision);
            $("#taxProc").val(obj.Bundesländer[10].Grunderwerbsteuer);
        }

        else if (obj.Bundesländer[12].GeoID == geoid.substr(0, 8)) {
            $(".state option:eq(" + '13' + ")").prop("selected", true);
            $("#managerProc").val(obj.Bundesländer[12].Marklerprovision);
            $("#taxProc").val(obj.Bundesländer[12].Grunderwerbsteuer);
        }
        else {
            for (var i = 1; i <= obj.Bundesländer.length; i++) {
                if (obj.Bundesländer[i - 1].GeoID == geoid.substr(0, 5)) {
                    $(".state option:eq(" + i + ")").prop("selected", true);
                    $("#managerProc").val(obj.Bundesländer[i - 1].Marklerprovision);
                    $("#taxProc").val(obj.Bundesländer[i - 1].Grunderwerbsteuer);
                    break;
                }
            }
        }

    }

    //Wechsel des aktuellen Jahres
    $(".year").on('change', function () {
        checkParty(this);
    });



    //Veränderung des Bundeslandes
    $("#ddlstate").change(function () {

        if ($("#ddlstate").val() != 0) {

            $("#managerProc").val(obj.Bundesländer[$("#ddlstate").val() - 1].Marklerprovision);
            $("#taxProc").val(obj.Bundesländer[$("#ddlstate").val() - 1].Grunderwerbsteuer);
        }
        else {

            $("#managerProc").val("0");
            $("#taxProc").val("0");
        }
        Calculate();
    });

    //Sprung auf das Baufi-Formular
    $("#baufiForm").submit(function () {
        if ($(this).children('#price').html() == null) {
            var input = $("<input>").attr("type", "hidden").attr("name", "price").attr("id", "price").val($("#fullPrice").val());
            $(this).append($(input));
        } else {
            $(this).children('#price').val($("#fullPrice").val());
        }
    });


    $('#zinssatz').keypress(function () {
        sollzinsManuallyChanged = true;
    });

    //Event zum Ändern der Zinsbindung
    $("#ddlZinsbindung").change(function () {

        if (!sollzinsManuallyChanged) {
            $(".year > option").remove();
            var myDate = new Date();
            for (var i = 1; i <= $("#ddlZinsbindung").val(); i++) {
                $(".year").append($("<option></option>").val(myDate.getFullYear() + i).html(myDate.getFullYear() + i));
            }

            if ($("#ddlZinsbindung").val() == 5)
                $("#zinssatz").val(array[0]);
            if ($("#ddlZinsbindung").val() == 10)
                $("#zinssatz").val(array[1]);
            if ($("#ddlZinsbindung").val() == 15)
                $("#zinssatz").val(array[2]);
            if ($("#ddlZinsbindung").val() == 20)
                $("#zinssatz").val(array[3]);
        }
    });

    //Event beim Click auf den "zurück"-Button
    $(".hpBack").click(function () {
        $("#pnlDruckansicht").hide();
        $("#pnlTilgungsplan").hide();
        $("#pnlResult").hide();
        $("#pnlInput").show();
        $(".hpBack").hide();
    });

    //Event zum Erzeugen neuer Datenfelder zum Tilgen
    $("#btAdd").click(function () {

        iAnzahlSonderTilgungen++;

        var zeile1 = $('<div class="h_005"></div>');
        var zeile2 = $('<div class="right label_fc">&nbsp;&euro;</div>');

        var zeile3 = $('<span class="right"><input maxlength="6" name="zinssatz" type="text" size="20" class="text_right right TilgungWert" onblur="loseFocusTxtBox(this)" onkeyup="loseFocusTxtBox(this)" /></span>');

        var zeile4 = $('<span>Einmalig am: </span>');
        var zeile5 = $('<span class="fc_middle_margin"><span>1.</span>');
        var zeile6 = $('<select class="month" style="margin-left:4px;" id="' + "ddlMonth" + (iAnzahlSonderTilgungen + 2) + '" />');
        var zeile7 = $('<span>&nbsp;</span>');
        var zeile8 = $('<select class="year" id="' + "ddlYear" + (iAnzahlSonderTilgungen + 1) + '" onchange="checkParty(this);" /> </span>');

        var myDate = new Date();

        for (var y = (myDate.getMonth() + 1); y <= 12; y++) {
            $('<option />').val(parseInt(y)).html(('0' + parseInt(y)).slice(-2)).appendTo(zeile6);
        }

        for (var i = 1; i <= $("#ddlZinsbindung").val(); i++) {
            $('<option />').val(myDate.getFullYear() + i).html(myDate.getFullYear() + i).appendTo(zeile8);
        }

        zeile1.appendTo($("#moreFields"));
        zeile2.appendTo($("#moreFields"));
        zeile3.appendTo($("#moreFields"));
        zeile4.appendTo($("#moreFields"));
        zeile5.appendTo($("#moreFields"));
        zeile6.appendTo($(zeile5));
        zeile7.appendTo($(zeile5));
        zeile8.appendTo($(zeile5));

        if (iAnzahlSonderTilgungen == 4)
            $("#btAdd").hide();


        return false;

    });

    //Event zum Ändern der Tilgungsart
    $("[name='tilgungArt']").change(function () {

        if ($("#Tilgungssatz").is(':checked')) {
            $("#tilgung").val('1,0');
            $("#tilgungsSymbol").html('&nbsp;%');
        }
        else {
            $("#tilgung").val('500');
            $("#tilgungsSymbol").html('&nbsp;€');
        }
    });

    //Event zum Ändern der Sondertinglung
    $("[name='SondertilgungArt1']").change(function () {
        if ($("#jaehrlich").is(':checked')) {
            $("#pnlTilgungUnique").hide();
            $("#pnlTilgungYear").show();
            Calculate()
        }
        else {
            $("#pnlTilgungYear").hide();
            $("#pnlTilgungUnique").show();
            Calculate()
        }
    });


    $("#lbAdditionalCosts").removeClass('icon_collapse open').addClass('icon_collapse closed').attr('title', 'aufklappen').show();
    $("#pnlNebenkosten").hide();
    $("#pnlAdditionalCosts").hide();
    var toggleAdditionalCosts = 0;
    //Event zum Auf-/Zuklappen des Nebenkosten-Panels
   $("#lbAdditionalCosts").click(function () {
       if(toggleAdditionalCosts == 0){
           $(this).removeClass('icon_collapse closed').addClass('icon_collapse open').attr('title', 'einklappen');
           $("#pnlNebenkosten").show();
           $("#pnlAdditionalCosts").show();
           toggleAdditionalCosts = 1;
       }
       else if(toggleAdditionalCosts == 1){
           $(this).removeClass('icon_collapse open').addClass('icon_collapse closed').attr('title', 'aufklappen');
           $("#pnlNebenkosten").hide();
           $("#pnlAdditionalCosts").hide();
           toggleAdditionalCosts = 0;
       }
       return false;
    });

    //Event zum Umschalten zwischen Monats- und Jahresansicht
    $("#rblAnsicht").change(function () {
        if ($("#rblAnsicht input:checked").val() == "0") {
            $("#Tilgungstabelle").empty();
            $("#TilgungstabellePopUp").empty();
            RepeaterYear();
        }
        else {

            $("#Tilgungstabelle").empty();
            $("#TilgungstabellePopUp").empty();
            RepeaterMonth();
        }
    });

    $("#lbRepayment").removeClass('icon_collapse open').addClass('icon_collapse closed').attr('title', 'aufklappen');
    $("#pnlRepayment").hide();
    $("#pnlAngaben").show();
    var toggleRepayment = 0;

    //Event zum Auf-/Zuklappen des Sondertilgungs-Panels
    $("#lbRepayment").click(function () {
        if(toggleRepayment == 0){
            $(this).removeClass('icon_collapse closed');
            $(this).addClass('icon_collapse open');
            $(this).attr('title', 'einklappen');
            $("#pnlRepayment").show();
            $("#pnlAngaben").hide();
            toggleRepayment = 1
        }
        else if(toggleRepayment == 1) {

            $(this).removeClass('icon_collapse open');
            $(this).addClass('icon_collapse closed');
            $(this).attr('title', 'aufklappen');
            $("#pnlRepayment").hide();
            $("#pnlAngaben").show();
            toggleRepayment = 0;
        }
        return false;
    });

    //Event zum Auslösen des 'Berechnen'-Button
    $("#lbCalc").click(function () {
        if (Check()) {
            if (Result()) {
                RepeaterYear();
                $("#tbResultPrice").text(FormatCurrency($("#toLend").val().replace(/\./g, "")) + " €");
                $("#rblAnsicht input:radio")[0].checked = true;
                $("#pnlInput").hide();
                $("#pnlResult").show();
                $("#pnlTilgungsplan").show();
                $(".hpBack").show();
            }
        }
        return false;
    });

    //Druckansicht
    $("#hpPrint").click(function () {
        $("#pnlResult").hide();
        $("#pnlTilgungsplan").hide();
        $("#pnlHeader").hide();
        $("#pnlDruckansicht").show();
        $(".hpBack:first").hide();

    });

    //Drucken
    $("#hldrucken").click(function () {
        print();
    });

    //Zurück zum Tilgungsplan
    $("#hpBackTilgung").click(function () {
        $("#pnlDruckansicht").hide();
        $("#pnlResult").show();
        $("#pnlTilgungsplan").show();
        $("#pnlHeader").show();
        $(".hpBack:first").show();
    });

    Calculate();
});