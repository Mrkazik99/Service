function research(value) {
    var orders = document.getElementsByClassName("order");
    if(value!=''||value!=' '){
        for (var i=0;i<orders.length;i++) {
            content = orders[i].innerHTML.toLowerCase();
            if(content.indexOf(value.toLowerCase()) !=-1) {
                orders[i].className='order';
            } else {
                orders[i].className='order hidden';
            }
        }

    } else {
        for (var i=0;i<orders.length;i++) {
            orders[i].className='order';
        }
    }
}