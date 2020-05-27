function getClients() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("response").innerHTML = this.responseText;
        }
    };
    console.log("getting users");
    xmlhttp.open("GET", "getClients.php",true);
    xmlhttp.send();
}
function drawNav () {
    var add = document.getElementById("new_order");
    add.addEventListener("click", addOrder);
    var href = location.href;
    href = href.split("/");
    href = href[5].split(".");
    if(href[0]==''||href[0]==null||href[0]=='index'){
        var el = document.getElementById("dashboard");
        el.classList.add("nav-active");
        el.parentNode.setAttribute('href', '#');
    } else if(href[0]=="support_contact"||href[0]=="faq"||href[0]=="backup"||href[0]=="all_orders") {
        var el = document.getElementById(href[0]);
        el.setAttribute("default", "default");
        el.setAttribute("selected", "");
        el.parentNode.style.backgroundColor="#29abe2";
        el.parentNode.parentNode.classList.add("nav-active");
    } else {
        var el = document.getElementById(href[0]);
        el.classList.add("nav-active");
        el.parentNode.setAttribute('href', '#');
    }
}
function hrefTo(id) {
    window.location.replace(id+".php");
}
function destroyView() {
    document.getElementById("addView").remove();
}
function addOrder() {
    var asd = document.createElement("div");
    asd.setAttribute("style", "z-index:99;background:rgba(0,0,0,0.8);height:100vh;width:100vw;position:absolute;display:grid;cursor:pointer;");
    asd.id="addView";
    var form = document.createElement("form");
    form.classList.add("orderForm");
    form.setAttribute("method", "post");
    form.setAttribute("action", "new.php");
    form.innerHTML = '<br><p class="formPart">Klient:<br><label>ID:<input placeholder="Wybierz Klienta" list="customer-name" id="customer-choice" name="customer-choice" oninput="choose(this);"></label><br><br><label>Imię i Nazwisko:<input placeholder="Imię i nazwisko" onchange="clearId();" type="text" id="name" name="name" required></label><br><br><label>Telefon:<input placeholder="123-123-123" minlength=11 maxlength=11 pattern="\\d{3}[\\-]\\d{3}[\\-]\\d{3}" onkeyup="autoDash(this);" onchange="clearId();" type="text" id="phone" name="phone" oninvalid="this.setCustomValidity("000-000-000")" oninput="this.setCustomValidity("")" required></label><br><br></p><p class="formPart">Sprzęt:<br><label>Typ:<input placeholder="Laptop/Drukarka?" list="type-list" id="type-choice" name="type-choice" required></label><br><br><label>Producent:<input placeholder="Asus/Dell/Hp/Ricoh" type="text" id="brand" name="brand" required></label><br><br><label>Model:<input placeholder="R554J/deskjet 3835" type="text" id="model" name="model" required></label><br><br><label>Dodatkowe wyposażenie:<input placeholder="Zasilacz, kabel USB?" type="text" id="additional" name="additional" required></label><br><br><label for="warranty"><input type="checkbox" id="warranty" name="warranty" onchange="warrantyCheck(this);">Naprawa gwarancyjna</label><br><br><label>Numer rachunku/faktury:<input placeholder="Numer rachunku" type="text" id="bill" name="bill" required disabled></label><br><br><label>Opis problemu: <textarea required placeholder="Zachowanie sprzętu/ okoliczności występowania problemu" id="problem" name="problem" style="width:95%;height:15%;"></textarea></label></p><input type="submit" value="Dodaj naprawę"><input type="reset" value="Zamknij" onclick="destroyView();"><p id="response">'+getClients()+'</p>';
    asd.appendChild(form);
    document.body.prepend(asd);
}
function clearId() {
    document.getElementById("customer-choice").value="";
}
function choose(el) {
    if(el.value>0){
        var list = document.getElementById("customer-name").childNodes;
        var phoneNumber = list[el.value-1].innerHTML;
        phoneNumber = phoneNumber.replace(/(\r\n|\n|\r| )/gm, "");
        document.getElementById("phone").value = phoneNumber;
        document.getElementById("name").value = list[el.value-1].label;
    }
}
function warrantyCheck(check) {
    if(check.checked) {
        document.getElementById("bill").removeAttribute("disabled", "");
    } else {
        document.getElementById("bill").setAttribute("disabled", "");
    }
}
function autoDash(el) {
    if(el.value.length==3||el.value.length==7) {
        el.value += "-";
    }
}