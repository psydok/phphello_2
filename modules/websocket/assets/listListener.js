console.log("I'm fine");

var ws = new WebSocket("ws://192.168.99.102:1337/websocket/list/index/broadcast");
var list = document.getElementById("messages");
var input = document.querySelector('input[name=message]');

ws.addEventListener("message", function (e) {

    console.log(e.data);

    var listItem = document.createElement('li');
    listItem.className = 'delayed';
    listItem.textContent = e.data;

    list.append(listItem);

    var postData = listItem.textContent.substring(listItem.textContent.indexOf(':') + 1, listItem.textContent.length);

    var settings = {
        "url": "http://192.168.99.102:8500/api/metrics",
        "method": "POST",
        "timeout": 5,
        "headers": {
            "Content-Type": "application/json"
        },
        "data": JSON.stringify(JSON.parse(postData)),
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
    });

    while (list.children.length > 10) {
        list.removeChild(list.firstChild);
    }
});

input.addEventListener('keyup', function (e) {

    if (e.keyCode === 13) {
        e.preventDefault();

        ws.send(e.target.value);
        e.target.value = "";
        e.target.focus();
    }
});