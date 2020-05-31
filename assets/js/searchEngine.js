function showCookie(name) {
    if (document.cookie !== "") {
        const cookies = document.cookie.split(/; */);

        for (let i=0; i<cookies.length; i++) {
            const cookieName = cookies[i].split("=")[0];
            const cookieVal = cookies[i].split("=")[1];
            if (cookieName === decodeURIComponent(name)) {
                return decodeURIComponent(cookieVal);
            }
        }
    }
}

function research(value) {
    var orders = document.getElementsByClassName("order");
    if(value!=''||value!=' '){
        for (var i=0; i<orders.length; i++) {
            content = orders[i].innerHTML.toLowerCase();
            if(content.indexOf(value.toLowerCase()) != -1) {
                orders[i].className='order';
            } else {
                orders[i].className='order hidden';
            }
        }

    } else {
        for (var i=0; i<orders.length; i++) {
            orders[i].className='order';
        }
    }
}

function checkSearch() {
    var status7 = showCookie('stat7');
    var status8 = showCookie('stat8');
    if(status7=="true") {
        var el = document.getElementById('stat7')
        el.setAttribute('checked', '');
        stat7(el);
    }
    if(status8=="true") {
        var el = document.getElementById('stat8')
        el.setAttribute('checked', '');
        stat8(el);
    }
}

function stat7(el) {
    var orders = document.getElementsByClassName("order");
    if(el.checked) {
        var name = "7";
        document.cookie = "stat7=true";
    } else {
        var name = "hide7";
        document.cookie = "stat7=false";
    }
    for(var i=0; i<orders.length; i++) {
        if(orders[i].getAttribute('name')=="hide7"||orders[i].getAttribute('name')=="7") {
            orders[i].setAttribute('name', name);
        }
    }
}

function stat8(el) {
    var orders = document.getElementsByClassName("order");
    if(el.checked) {
        var name = "8";
        document.cookie = "stat8=true";
    } else {
        var name = "hide8";
        document.cookie = "stat8=false";
    }
    for(var i=0; i<orders.length; i++) {
        if(orders[i].getAttribute('name')=="hide8"||orders[i].getAttribute('name')=="8") {
            orders[i].setAttribute('name', name);
        }
    }
}