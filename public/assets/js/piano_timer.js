onload = function () {

    //変数
    var timeup = 0;
    var count = 10;

    //要素
    var msg = document.getElementById('msg');

    var timerID = setInterval(function () {

        if (count == timeup) {
            clearInterval(timerID);
        } else {
            count--;
            msg.textContent = count;
        }

    }, 1000);

}