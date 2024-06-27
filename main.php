<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <title>Document</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ja',
                height: 'auto',
                firstDay: 1,
                headerToolbar: {
                left: "today prev,next",
                center: "title",
                right: "dayGridMonth,listMonth"
                },
                buttonText: {
                    dayGridMonth: '月',
                    listMonth: '今月のevent',
                    today: '今月',
                },
                // 日付をクリック、または範囲を選択したイベント
                selectable: true,
                select: function (info) {
                    //alert("selected " + info.startStr + " to " + info.endStr);

                    // 入力ダイアログ
                    const eventName = prompt("予定を入力してください");

                    if (eventName) {
                        // イベントの追加
                        calendar.addEvent({
                            title: eventName,
                            start: info.start,
                            end: info.end,
                            allDay: true,
                        });
                    }
                    
                },

            });
            
            calendar.render();
        });

    </script>

    <title>record</title>
    <style>
          #output li {
      background: skyblue;
    }
    </style>
</head>
    <div class='container'>
        <div class='title'>
            <p>夫婦<br>To be continued>>></p>
        </div>
        <!-- Calendar -->
        <div id='calendar'></div>
    </div>
<!-- 入力場所を作成しよう -->
<form>



    <fieldset>
        <legend>日々の記録</legend>
        <div>
            記録者: <input type="text" id="name" />
        </div>
        <div>
            出来事: <input type="text" id="event" />
        </div>
        <div>
            発生日: <input type="text" id="date" />
        </div>
        <div>
            <button type="button" id="send">send</button>
        </div>
    </fieldset>
</form>

<body>

    <!-- データ出力場所 -->
    <ul id="output"></ul>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        // 日時をいい感じの形式にする関数
        function convertTimestampToDatetime(timestamp) {
            const _d = timestamp ? new Date(timestamp * 1000) : new Date();
            const Y = _d.getFullYear();
            const m = (_d.getMonth() + 1).toString().padStart(2, '0');
            const d = _d.getDate().toString().padStart(2, '0');
            const H = _d.getHours().toString().padStart(2, '0');
            const i = _d.getMinutes().toString().padStart(2, '0');
            const s = _d.getSeconds().toString().padStart(2, '0');
            return `${Y}/${m}/${d} ${H}:${i}:${s}`;
        }
    </script>
    <script>
        calendar.addEvent({
            extendedProps: {
            userId: document.querySelector('[data-user-id]').getAttribute('data-user-id'),
            }
        });

    </script>
 
 
 <!-- 以下にfirebaseのコードを貼り付けよう -->
 <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "",
    authDomain: "couple-22.firebaseapp.com",
    projectId: "couple-22",
    storageBucket: "couple-22.appspot.com",
    messagingSenderId: "1040194825513",
    appId: "1:1040194825513:web:67362502c06c0f828b9b38"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);

    //DBにつなげる
    const db = getFirestore(app);
        $("#send").on("click", function () {
            // 送信時に必要な処理
            const postData = {
                記録者: $("#name").val(),
                出来事: $("#event").val(),
                発生日: $("#date").val(),
                time: serverTimestamp(),
            }
            addDoc(collection(db, "couple"), postData);
            $("#name").val(),
            $("#event").val(),
            $("#date").val();
        });

        // データ取得処理
        const q = query(collection(db, "couple"), orderBy("time", "desc"));
        onSnapshot(q, (querySnapshot) => {
            console.log(querySnapshot.docs);
            //毎回同じでできる
            const documents = [];
            querySnapshot.docs.forEach(function (doc) {
                const document = {
                    id: doc.id,
                    data: doc.data(),
                };
                documents.push(document);
            });
            console.log(documents);

        //取得したデータのタグをつくる
            const htmlElements = [];
            documents.forEach(function (document) {
                htmlElements.push(`
          <li id="${document.id}">
            <p>${document.data.記録者} at ${convertTimestampToDatetime(document.data.time.seconds)}</p>
            <p>${document.data.出来事}</p>
            <p>${document.data.発生日}</p>
          </li>
        `);
        console.log(htmlElements);
        });

            $("#output").html(htmlElements);
        });

</script>
    
</body>
</html>