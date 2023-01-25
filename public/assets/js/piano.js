let clickedKeyNum = null;                                   // クリック中の鍵盤番号
const isKeyPressing = new Array(36);                        // 鍵盤の押下状況
isKeyPressing.fill(null);                                   // 鍵盤初期化
const pianoWrap = document.getElementById("piano-wrap");    // 鍵盤全体
const whiteKeys = document.querySelectorAll(".white-key");   // 白鍵
const blackKeys = document.querySelectorAll(".black-key");   // 黒鍵

pianoWrap.addEventListener("mousedown", function () { handleMouseEvents(event) });
//pianoWrap.addEventListener("mousemove", function () { handleMouseEvents(event) });
setTimeout(() => {
    post('ques01', { val: clickedKeyNum });
}, 10000);


//座標に応じた鍵盤番号を取得
function getKeyNum(x, y) {
    for (let j = 0; j < blackKeys.length; j++) {
        const KeyRect = blackKeys[j].getBoundingClientRect();          //黒鍵の座標取得
        if (x >= window.pageXOffset + KeyRect.left &&
            x <= window.pageXOffset + KeyRect.right &&
            y >= window.pageYOffset + KeyRect.top &&
            y <= window.pageYOffset + KeyRect.bottom) {
            return Number(blackKeys[j].dataset.keyNum);                 //タッチした鍵盤番号をセット
        }
    }

    for (let j = 0; j < whiteKeys.length; j++) {
        const KeyRect = whiteKeys[j].getBoundingClientRect();       //白鍵の座標取得
        if (x >= window.pageXOffset + KeyRect.left &&
            x <= window.pageXOffset + KeyRect.right &&
            y >= window.pageYOffset + KeyRect.top &&
            y <= window.pageYOffset + KeyRect.bottom) {
            return Number(whiteKeys[j].dataset.keyNum);                //タッチした鍵盤番号をセット
        }
    }
    return null;                                                    //範囲外タッチ
}

//マウスイベント発生時の処理
function handleMouseEvents(event) {
    if (event.which !== 1) { return }           //左クリック以外
    const x = event.pageX;                      //マウスカーソル座標
    const y = event.pageY;
    let keyNum;
    switch (event.type) {
        //左クリック押下時
        case "mousedown":
            keyNum = getKeyNum(x, y);
            if (keyNum !== null) {
                releasePianoKey(clickedKeyNum);
                clickedKeyNum = null;
                pressPianoKey(keyNum);
            }
            if (typeof timeid != 'undefined') {
                clearTimeout(timeid);
            }
            clickedKeyNum = keyNum;
            timeid = setTimeout(() => {
                post('ques01', { val: clickedKeyNum });
            }, 2000);
            break;

        /*
        //カーソル移動した時
        case "mousemove":
            keyNum = getKeyNum(x, y);
            if (keyNum !== null) {
                if (keyNum !== clickedKeyNum) {
                    releasePianoKey(clickedKeyNum);
                    pressPianoKey(keyNum);
                    clickedKeyNum = keyNum;
                }
            } else {
                releasePianoKey(clickedKeyNum);
                clickedKeyNum = null;
            }
            break;
        */
    }
}

//鍵盤押下処理
function pressPianoKey(keyNum) {
    //鍵盤が押されていない状態であったら対象のhtml classにpressingクラスを追加する
    if (!isKeyPressing[keyNum]) {
        isKeyPressing[keyNum] = true;
        document.querySelector(`[data-key-num="${keyNum}"]`).classList.add("pressing");
    }
}

//鍵盤を離した時の処理
function releasePianoKey(keyNum) {
    //鍵盤が押されている状態であったら対象のhtml classからpressingクラスを削除
    if (isKeyPressing[keyNum]) {
        isKeyPressing[keyNum] = false;
        document.querySelector(`[data-key-num="${keyNum}"]`).classList.remove("pressing");
    }
}



//JavaScriptから値をpostしてページ遷移を行う関数
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
