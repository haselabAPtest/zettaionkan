/*
    ピアノ鍵盤処理用関数のまとめ
    ページ遷移を伴う個別の処理はbladeファイルの方に記述してある
*/
let selectedKey = null;
const isKeyPressing = new Array(36);
isKeyPressing.fill(null);
const pianoWrap = document.getElementById("piano-wrap");
const whiteKeys = document.querySelectorAll(".white-key");
const blackKeys = document.querySelectorAll(".black-key");

function getKey(x, y) {
    for (let j = 0; j < blackKeys.length; j++) {
        const KeyRect = blackKeys[j].getBoundingClientRect();
        if (x >= window.pageXOffset + KeyRect.left &&
            x <= window.pageXOffset + KeyRect.right &&
            y >= window.pageYOffset + KeyRect.top &&
            y <= window.pageYOffset + KeyRect.bottom) {
            return Number(blackKeys[j].dataset.keyNum);
        }
    }

    for (let j = 0; j < whiteKeys.length; j++) {
        const KeyRect = whiteKeys[j].getBoundingClientRect();
        if (x >= window.pageXOffset + KeyRect.left &&
            x <= window.pageXOffset + KeyRect.right &&
            y >= window.pageYOffset + KeyRect.top &&
            y <= window.pageYOffset + KeyRect.bottom) {
            return Number(whiteKeys[j].dataset.keyNum);
        }
    }
    return null;
}

function mouseEvents(event) {
    if (event.which !== 1) { return }
    const x = event.pageX;
    const y = event.pageY;
    let keyNum;
    switch (event.type) {
        case "mousedown":
            keyNum = getKey(x, y);
            if (keyNum !== null) {
                releaseKey(selectedKey);
                selectedKey = null;
                pressKey(keyNum);
            }
            if (typeof timeid != 'undefined') {
                clearTimeout(timeid);
            }
            selectedKey = keyNum;
            timeid = setTimeout(() => {
                post(pagepath, { val: selectedKey });
            }, 2000);
            break;
    }
}


function pressKey(keyNum) {
    if (!isKeyPressing[keyNum]) {
        isKeyPressing[keyNum] = true;
        document.querySelector(`[data-key-num="${keyNum}"]`).classList.add("pressing");
    }
}

function releaseKey(keyNum) {
    if (isKeyPressing[keyNum]) {
        isKeyPressing[keyNum] = false;
        document.querySelector(`[data-key-num="${keyNum}"]`).classList.remove("pressing");
    }
}

//任意の値をpostしてページ遷移を行う関数
//@param path 遷移するページのパス
//@param params postする値
function post(path, params, method = 'post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = params[key];

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
