/**
 * Created by #Property_Of_Ss on 12/10/2018.
 */
var btn;
var btnCerti;
var popup;
var popupCerti;
var span;
var socketId;
var userKycID;
var filled = [];
var certificates = [];
var nicSearchURL = 'http://3.14.72.68:8088/api/client/nic/';
var getCertiURL = 'http://3.14.72.68:8088/api/certificate/client/';
var issueCertiURL = "http://3.14.72.68:8087/api/certificate";
var certiShowInfo;
var verifyCertificate;
var certificateFullInfo;
var certificateOrgInfo;
var certificatePubKeyInfo;
var certifiedInfo = [];

// document onload function
$( document ).ready(function() {

    var socket = io();

    btnCerti = document.getElementById("showCerti");
    popupCerti = document.getElementById('popupCerti');
    span = document.getElementsByClassName("close2")[0];

    btnCerti.onclick = function() {
        popupCerti.style.display = "block";
    }

    span.onclick = function() {
        popupCerti.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == popupCerti) {
            popupCerti.style.display = "none";
        }
    }

    socket.on('success', function(msg){
        var kycId = document.getElementById("kycidfind").value;
        document.getElementById("verify").disabled = false;

        if(kycId!=""){
            popup.style.display = "none";
            document.getElementById("verify").disabled = false;
        }
        popup.style.display = "none";
        // alert(msg);
    });

    socket.on('error', function(msg){
        var kycId = document.getElementById("kycidfind").value;

        if(kycId!=""){
            popup.style.display = "none";
            document.getElementById("verify").disabled = false;
        }
        popup.style.display = "none";
        alert(msg);
    });

    socket.on('SocketId', function (socketid) {
        socketId = socketid;
        console.log('SocketID :', socketid);

        var qrJson
        btn = document.getElementById("scanQr");
        popup = document.getElementById('popup');
        span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            popup.style.display = "block";
        }

        span.onclick = function() {
            popup.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = "none";
            }
        }

        var orgName = "ideamart";
        var orgId = "org678"
        var agentId = getCookie("agentName");

        qrJson = {orgId : orgId, orgName : orgName, agentId:agentId, orgUrl: 'http://3.14.72.68:4000/token',session : socketId};
        qrJson = {
            orgId: orgId,
            orgName: orgName,
            agentId: agentId,
            orgUrl: 'http://3.14.72.68:4000/token',
            session: socketId
        };
        var jsonData = JSON.stringify(qrJson);
        var qrcode = new QRCode(document.getElementById("qrcode"), jsonData);

        document.getElementById("verify").disabled = true;
    });

    socket.on('data', function(kycid, name, dob, address, nic, mobile, phone){
        document.getElementById("kycid").value = kycid;
        document.getElementById("name").value = name;
        document.getElementById("dob").value = dob;
        document.getElementById("nic").value = nic;
        document.getElementById("address").value = address;
        document.getElementById("mobile").value = mobile;
        document.getElementById("phone").value = phone;
    });
});


function getCookie(name) { //function for getting a cookie
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function findFilledFields() {//find filled fields of the customer details form
    var kycId = document.getElementById("kycid").value;
    userKycID = kycId;

    var fullname =  document.getElementById("name").value;
    var dob = document.getElementById("dob").value;
    var nic =  document.getElementById("nic").value;
    var address = document.getElementById("address").value;
    var mobile = document.getElementById("mobile").value;
    var phone = document.getElementById("phone").value;

    if (fullname != ""){
        filled.push("FULLNAME");
        certifiedInfo.push(fullname);
    }
    if (dob != ""){
        filled.push("DOB");
        certifiedInfo.push(dob);
    }
    if (nic != ""){
        // filled.push("LICENCE");
        // certifiedInfo.push(nic);
    }
    if (address != ""){
        filled.push("ADDRESS");
        certifiedInfo.push(address);
    }
    if (mobile != "" ){
        filled.push("MOBILE");
        certifiedInfo.push(mobile);
    }
    if (phone != "" ){
        filled.push("TELEPHONE");
        certifiedInfo.push(phone);
    }
    console.log(filled)
}

function stringNormalize(certiInfoArray) {
    var str = "";
    var value1 = certiInfoArray[0];
    if (certiInfoArray[0] !== "") {

        value1 = value1.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
        str += value1;
    }
    for (var i = 1; i < certiInfoArray.length; i++) {
        var value = certiInfoArray[i];
        value = value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
        if (value !== "") {
            str += ":" + value;
        }
    }
    return str;
}

$(function () {
    $("#verify").click(function () { //certificate issuing function

        var kycId = document.getElementById("kycid").value;
        if (kycId == "") {
            document.getElementById("verify").disabled = true;
        } else {
            document.getElementById("verify").disabled = false;

            findFilledFields();
            var agentId = getCookie("agentName");

            let certifiedInformation = stringNormalize(certifiedInfo);
            var xhttp = new XMLHttpRequest();
            var url1 = "http://3.14.72.68:4000/createJWS/"+certifiedInformation+"/"+agentId+"/"+userKycID;

            xhttp.onreadystatechange = function () {

                if (xhttp.readyState === 4 && this.status == 200) {
                    var that = this;
                    var signature = xhttp.response;

                    var xhr = new XMLHttpRequest();
                    var url = issueCertiURL;
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var json = JSON.parse(xhr.responseText);
                            console.log(json);
                        }
                    };

                    var data = JSON.stringify({
                        "certifiedInfo":
                        filled
                        ,
                        "expiredDate": "2028-12-05",
                        "id": "string",
                        "issuedBy": 2,
                        "owner": kycId,
                        "digitalSignature": signature
                    });

                    xhr.open("POST", url, true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('KycAuthorization', 'kyc-user 2');
                    console.log(data);
                    xhr.send(data);

                    alert("Successfully Verified & Certificate Issued.");
                    $("#details").trigger('reset');
                    $("#kycidfind").val("");
                }
            };
            xhttp.open("GET", url1, true);
            xhttp.send();
        }
    });

    $("#showCerti").click(function () { // function for showing the clent's current certifictes
        var kycId = document.getElementById("kycid").value;

        if(kycId==""){
            alert("Input Customer Details First.")
            popupCerti.style.display = "none";
        }else {
            var url = getCertiURL + kycId;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    console.log(data);
                    var obj = data;
                    for (var i = 0; i < obj.length; i++) {

                        var dataItem = JSON.stringify(obj[i]);

                        certificates.push(
                            "<button class='btn btn-light' onclick='certiShowInfo("+dataItem+")' style='margin: 5px' >" +
                            "<img src='" + obj[i].org.logoUrl + "' width='100px' height='40px'>"
                            + obj[i].org.orgName + "<br>" +
                            " Score : " + obj[i].certificateScore
                            + "<br> Expiry Date : " + obj[i].expiredDate + "<br>" +
                            "</button>"
                        );

                    }
                    document.getElementById("certiShow").innerHTML = certificates;
                    document.getElementById("certiShow").style.backgroundColor = "white";
                    certificates.length = 0;

                }

            };
            xhr.open("GET", url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('KycAuthorization', 'kyc-user 2');
            xhr.send();

        }
    });


$("#find").click(function() { // find customer kyc details by national id card number
    // findFilledFields();
    var kycId = document.getElementById("kycidfind").value;

    if (kycId == "") {
        alert("Please Input Customer NIC No to Proceed...");
        document.getElementById("verify").disabled = true;
    } else {
        document.getElementById("verify").disabled = false;

        var requrl = nicSearchURL + kycId;

        var xhr = new XMLHttpRequest();
        var url = requrl;
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var json = JSON.parse(xhr.responseText);
                console.log(json);
                var xhr1 = new XMLHttpRequest();
                var url2 = json.contentURL;

                xhr1.onreadystatechange = function() {
                    if (xhr1.readyState === 4 && xhr1.status === 200) {
                        var json2 = JSON.parse(xhr1.responseText);
                        console.log(json2);
                        if (json.nic == "") {
                            alert("No Nic ")
                        } else {
                            document.getElementById("kycid").value = json2.kycId;
                            document.getElementById("name").value = json2.fullName;
                            document.getElementById("dob").value = json2.dob;
                            document.getElementById("nic").value = json2.nic;
                            document.getElementById("address").value = json2.address;
                            document.getElementById("mobile").value = json2.mobileNo;
                            document.getElementById("phone").value = json2.telNo;
                        }
                    }
                };

                xhr1.open("GET", url2, true);
                xhr1.setRequestHeader('Content-Type', 'application/json');
                xhr1.setRequestHeader('KycAuthorization', 'kyc-user 2');
                xhr1.send();
            }
        };
        xhr.open("GET", url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('KycAuthorization', 'kyc-user 2');
        xhr.send();
    }
    // document.getElementById("verify").disabled = true;
});


    certiShowInfo = function (obj) {//show certificate information
      var dataItem = JSON.stringify(obj);
        certificateFullInfo = "<h3>Certificate Details</h3>" +
            "<div style=' font-size: 14px; width:450px; word-wrap:break-word;'>"  +
            "Certificate ID : " + obj.id+
            "<br> Score : " + obj.certificateScore +
            "<br> Certified Info : " + obj.certifiedInfo +
            "<br> Digital Signature : " + obj.digitalSignature +
            "<br> Issued Date : " + obj.issuedDate +
            "<br> Expired Date : " + obj.expiredDate +
            "<br> Issued By : " + obj.issuedBy +
            "<br>" +
            "</div>"

        certificateOrgInfo = "<div style=' font-size: 13px'; width:200px; word-wrap:break-word;>" +
            "<br> <b>Organization Details</b>" +
            "<br> Name : " + obj.org.orgName +
            "<br> ID : " + obj.org.id +
            "<br> Address : " + obj.org.address +
            "<br> Category : " + obj.org.category +
            "<br> Description : " + obj.org.description +
            "<br> Minimum Score Required : " + obj.org.minimumScoreRequired +
            "<br> Status : " + obj.org.organizationStatus +
            "<br> Primary Phone Number : " + obj.org.primaryPhoneNumber +
            "<br> Profile : " + obj.org.profile +
            "</div>"

        certificatePubKeyInfo = "<div style=' font-size: 13px; width:200px; word-wrap:break-word;'>" +
            "<br> <b>Public Key</b>" +
            "<br> ID : " + obj.org.publicKey.id +
            "<br> owner : " + obj.org.publicKey.owner +
            "<br> publicKey : " + obj.org.publicKey.publicKey +
            "<br> Type : " + obj.org.publicKey.type +
            "</div>"

        verifyButton = "<button class='btn btn-danger' onclick='verifyCertificate("+dataItem+")' style='margin: 5px'> Certificate Verify</button>"


        document.getElementById("certiInfoShow1").innerHTML = certificateFullInfo.fontsize(7);
        document.getElementById("certiInfoShow2").innerHTML = certificateOrgInfo
        document.getElementById("certiInfoShow3").innerHTML = certificatePubKeyInfo
        document.getElementById("verifydiv").innerHTML = verifyButton
    },

    verifyCertificate = function (obj){
      console.log("========verify start=========");
      // console.log(obj);

      let certifiedInfo = [
          'Thisura Thebuwana',
          'Boralasgamuwa',
          '0771199903'
      ];

      let payload = {
          "iss": 'A',
          "sub": 'A',
          "certifiedInfo": certifiedInfo
      };

      var signature = "eyJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJBIiwic3ViIjoiQSIsImNlcnRpZmllZEluZm8iOiI2MzhlNDk2YjI4ZTY3NGNjNzVkNzUzNGQ2ZjFjZjc3NDdkZDU5ZjYwY2E2NjljZGYzZDY0MGRkY2ZkNTMxNjIxIn0.Uh7jOKIROc0VLNko91AHD2FvP6bQMWsF2Vu4ziZs-uSwxqlAONCKmxW6aeduWHS76w4PKWT5m4LglT7G1HyUTw";

      //correct public key
      var publicKey = "-----BEGIN PUBLIC KEY-----\n" +
          "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAIAsfyTtfpO8B4laL84PZFOLAY30NnIr\n" +
          "2R3S9mBFQHEE/1gFbvXQIabABZOAKlKkkSmCoJRMpr61IAte8paBtfUCAwEAAQ==\n" +
          "-----END PUBLIC KEY-----";

      var data = JSON.stringify({
          "signature": signature,
          "payload": payload,
          "pubKey": publicKey
      });
      //
      // var obj = { name: "John", age: 30, city: "New York" };
      // var myJSON = JSON.stringify(obj);

      var url = "http://3.14.72.68:4000/verifyCertificate";
      var xhr = new XMLHttpRequest();
      xhr.open("POST", url, true);
      xhr.setRequestHeader('Content-type','application/json; charset=utf-8');
      xhr.send(data);

      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          label = "<label class='label label-danger'>Digital Signature Verified <img src='../images/done-verify.png' width='65px' height='50px'></label>"
          document.getElementById("sigdiv").innerHTML = label
        }
      }
    }

});
