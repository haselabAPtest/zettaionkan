const totalTime = 36000;
const readTime = Date.now();

const cacheTime = localStorage.getItem("end");
if (cacheTime) {
    endTime = localStorage.getItem('end');
    finishTime = Math.ceil((endTime - readTime) / 1000);
} else {
    endTime = readTime + totalTime;
    localStorage.setItem('end', endTime)
}

var cnt = finishTime;
var timeid = setInterval(() => {
    cnt--;
    let text = `<h1>残り${cnt / 60 | 0}分${cnt % 60}秒</h1>`;
    if (cnt <= 0) {
        clearInterval(timeid);

        text = "<button type=\"submit\" class=\"btn btn-outline-default\" onclick=\"location.href='ques02'\">後半へすすむ</button>";
    }
    document.querySelector('#log').innerHTML = text;
}, 1000)
