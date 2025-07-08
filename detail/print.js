// 印刷ウィンドウの参照を保持する変数
var printWindow = null;

// 検索結果の医療機関名を取得する関数
function printTab(tabId, tabName) {
    var hosName = document.myform.hos_name.value; // 医療機関名を取得
    printTabWithHosName(tabId, tabName, hosName);
}


// 指定されたタブの内容を印刷する関数
function printTabWithHosName(tabId, tabName, hosName) {
    // 既に印刷ウィンドウが開いている場合は閉じる
    if (printWindow && !printWindow.closed) {
        printWindow.close();
    }

    // 指定されたタブ内のすべての<div class="uk-margin">の内容を取得
    var tabContent = document.getElementById(tabId);
    var ukMarginElements = tabContent.querySelectorAll('.tab-print');
    console.log('Number of .tab-print elements:', ukMarginElements.length);

    var divContents = Array.from(ukMarginElements)
        .map(element => element.innerHTML)  // <div class="uk-margin">の中身を取得
        .join('');  // 取得した内容を連結

    // コンソールの中身が重複しないようにするために、内容をクリアしてから追加
    console.clear();
    console.log(divContents); // 取得した内容をコンソールに表示

    // 新しい印刷ウィンドウを開く
    printWindow = window.open('', '', 'height=900,width=1500');

    // 印刷ウィンドウにHTMLコンテンツを書き込む
    printWindow.document.open(); // ドキュメントを開く
    printWindow.document.write('<html><head><title>' + hosName + ' - ' + tabName + '</title>');
    // 必要なCSSファイルをリンク
    printWindow.document.write('<link rel="stylesheet" href="../css/style.css"/>');
    printWindow.document.write('<link rel="stylesheet" href="../css/form_parts.css" />');
    printWindow.document.write('<link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->');
    printWindow.document.write('<link rel="stylesheet" href="../css/all.min.css" />');
    printWindow.document.write('<link rel="stylesheet" href="../css/cards.css"/>');
    printWindow.document.write('<link rel="stylesheet" href="../css/tab.css"/><!--：タブ-->');
    printWindow.document.write('<link rel="stylesheet" href="../css/print-tab.css"/>');

    printWindow.document.write(`
        <style>
        @media print {
            /* ※ここを消すと全体の縮小がおかしくなるので消さないでください。 */
            body, main {
                zoom: 0.5 !important;  /* 印刷時に縮小 */
            }

            .uk-input {
                border: none !important;
                font-size: 30px !important; /* フォントサイズを30pxに設定 */
                padding: 10px !important; /* パディングを10pxに設定 */
                height: auto !important; /* 高さを自動に設定 */
            }
            
            /* select要素のアイコンを削除 */
            .uk-select, .uk-radio{
                -webkit-appearance: none !important; /* Safari, Chrome */
                -moz-appearance: none !important; /* Firefox */
                appearance: none !important; /* その他のブラウザ */
                background: none !important; /* 背景を削除 */
                border: none !important; /* 枠線を削除 */

                font-size: 30px !important; /* フォントサイズを30pxに設定 */
                padding: 10px !important; /* パディングを10pxに設定 */
                height: auto !important; /* 高さを自動に設定 */
            }

            /* uk-form-controls内のuk-radioでcheckedがついていない項目のみ非表示にする */
            .uk-form-controls input.uk-radio:not(:checked),
            .uk-form-controls label:has(input.uk-radio:not(:checked)) {
                display: none !important;
            }

            .uk-text-danger{
                display: none; /* エラーメッセージを非表示にする */
            }

            /* uk-grid内のuk-radioでcheckedがついていない項目とそのラベルを非表示にする */
            .uk-grid input.uk-radio:not(:checked),
            .uk-grid label:has(input.uk-radio:not(:checked)){
                display: none !important;
            }

            /* uk-grid内のuk-radioでcheckedがついている項目のラベルの文字サイズの変更 */
            .uk-form-controls label:has(input.uk-radio:checked),
            .uk-grid label:has(input.uk-radio:checked){
                font-size: 30px !important;
            }

            /* uk-inputのプレースホルダーを非表示にする */
            .uk-input::placeholder {
                color: transparent !important; /* プレースホルダーの色を透明にする */
            }



            </style>
        `);

    // タブごとのスタイルを追加
    if(tabId === 'tab-content02') {
        printWindow.document.write(`
            <style>
                @media print {
                    /* tab-content02用のスタイル */
                    .uk-grid {
                        display: flex; /* フレックスボックスを使用 */
                        flex-wrap: wrap; /* 折り返しを許可 */
                        margin: 0;  /* マージンを0にする */
                        padding: 0; /* パディングを0にする */
                        list-style: none;   /* リストスタイルをなしにする */
                        gap: 10px; /* リスト同士の間に余白を作成 */
                    }
                    /* もしくは、以下のようにリストアイテムに余白を追加 */
                    .uk-grid > li {
                        margin: 5px; /* リストアイテムに余白を追加 */
                    }   
                    /* 診察日テーブルの設定 */
                    .tbl-border {
                        border-collapse: collapse; /* 境界線を重ねて表示 */
                        border-spacing: 10px; /* セル間の隙間を10pxに設定 */
                        width: 90%; /* テーブルの幅を90%に設定 */
                    }

                    .tbl-border th,
                    .tbl-border td {
                        background: #ffffff; /* セルの背景色を白に設定 */
                        border: solid 1px #000000; /* セルの境界線を1pxの黒い線に設定 */
                        text-align: center; /* セルのテキストを中央揃えに設定 */
                    }

                    .uk-subnav.uk-subnav-pill {
                        display: none !important; /* <ul class="uk-subnav uk-subnav-pill">を非表示にする */
                    }
                }
            </style>
        `);
    } else if (tabId === 'tab-content03') {
        printWindow.document.write(`
            <style>
                @media print {
                    /* tab-content03用のスタイル */
                    /* 色付きテーブルの設定 */
                    .table-bordered {
                        border-collapse: collapse !important; /* 境界線を重ねて表示 */
                        border-spacing: 0; /* セル間の隙間をなくす */
                        border: 1.5px #acacac solid !important; /* テーブルの境界線を1.5pxの緑の線に設定 */
                    }

                    .table-bordered th {
                        padding: 5px !important; /* 見出しの内側に5pxのパディングを追加 */
                        background: #e2efda !important; /* 見出しの背景色を緑に設定 */
                        border: solid 0.5px #acacac !important; /* 見出しの境界線を0.5pxの緑の線に設定 */
                        color: #000000 !important; /* 見出しの文字色を白に設定 */
                        text-align: center !important; /* 見出しのテキストを中央揃えに設定 */
                    }

                    .table-bordered td {
                        padding: 1px !important; /* セルの内側に1pxのパディングを追加 */
                        border: solid 0.5px #e2efda !important; /* セルの境界線を0.5pxの緑の線に設定 */

                    }

                    .rowInsert-btn{
                        display: none !important; /* 行を追加ボタンを非表示にする */
                    }

                    input[type="text"] {   
                        width: 100% !important; /* 幅を100%に設定 */
                    }

                    .uk-input {
                        border: none !important;
                        font-size: 20px !important; /* フォントサイズを20pxに設定 */
                    }


                }
            </style>
        `);
    } else if (tabId === 'tab-content04') {
        printWindow.document.write(`
            <style>
                @media print {
                    table {
                        width: 100%; /* テーブルの幅を100%にする */
                        table-layout: fixed; /* 固定レイアウトにする */
                        border-collapse: collapse !important; /* 枠線を重ねて表示 */
                        border-spacing: 0; /* セル間の隙間をなくす */
                        break-inside: avoid !important; /* 見出し行が途中で改ページされないようにする */

                    }
                    th, td {
                        word-wrap: break-word; /* 単語の途中で改行する */
                        overflow: hidden; /* オーバーフローを隠す */
                        white-space: normal; /* ホワイトスペースを通常にする */
                        padding: 5px; /* 余白を追加 */
                        page-break-inside: avoid; /* ページ内で途中で改行しないようにする */
                        border: solid 0.5px #fff !important; /* セルの境界線を0.5pxの線に設定 */
                        color: #000000 !important; /* テキストの色を黒に設定 */
                        font-weight: bolder; /* フォントの太さを太字に設定 */
                        text-align: center;  /* テキストを中央揃えに設定 */
                    }
                    th {
                        background-color: #419116 !important; /* 見出し行の背景色を設定 */
                        color: #fff !important; /* 見出し行の文字色を設定 */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                        border: solid 1px #fff !important; /* 見出し行の境界線を設定 */
                    }
                    tr {
                        border: 1px solid #fff !important; /* 行ごとに枠線を設定 */
                        break-inside: avoid !important; /* 見出し行が途中で改ページされないようにする */
                    }
                    /* 奇数行 */
                    table tr:nth-child(odd) td {
                        background-color: #e2efda !important;  /* （薄灰色） */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                    }
                    /* 偶数行 */
                    table tr:nth-child(even) td {
                        background-color: #ffffff !important; /* （白） */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                    }
                    .intro_tbl_wrap {
                    border: 0.5px solid #70ad47;
                    page-break-inside: avoid !important; /* ページ内で途中で改行しないようにする */
                    }
                    .rowInsert-btn {
                        display: none !important; /* 行を追加ボタンを非表示にする */
                    }

                }
            </style>
        `);
    
    } else if (tabId === 'tab-content05') {
        printWindow.document.write(`
            <style>
                @media print {
                    table {
                        width: 100%; /* テーブルの幅を100%にする */
                        table-layout: fixed; /* 固定レイアウトにする */
                        border-collapse: collapse !important; /* 枠線を重ねて表示 */
                        border-spacing: 0; /* セル間の隙間をなくす */
                        break-inside: avoid !important; /* 見出し行が途中で改ページされないようにする */

                    }
                    th, td {
                        word-wrap: break-word; /* 単語の途中で改行する */
                        overflow: hidden; /* オーバーフローを隠す */
                        white-space: normal; /* ホワイトスペースを通常にする */
                        padding: 5px; /* 余白を追加 */
                        page-break-inside: avoid; /* ページ内で途中で改行しないようにする */
                        border: solid 0.5px #fff !important; /* セルの境界線を0.5pxの線に設定 */
                        color: #000000 !important; /* テキストの色を黒に設定 */
                        font-weight: bolder; /* フォントの太さを太字に設定 */
                        text-align: center;  /* テキストを中央揃えに設定 */
                    }
                    th {
                        background-color: #419116 !important; /* 見出し行の背景色を設定 */
                        color: #fff !important; /* 見出し行の文字色を設定 */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                        border: solid 1px #fff !important; /* 見出し行の境界線を設定 */
                    }
                    tr {
                        border: 1px solid #fff !important; /* 行ごとに枠線を設定 */
                        break-inside: avoid !important; /* 見出し行が途中で改ページされないようにする */
                    }
                    /* 奇数行 */
                    table tr:nth-child(odd) td {
                        background-color: #e2efda !important;  /* （薄灰色） */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                    }
                    /* 偶数行 */
                    table tr:nth-child(even) td {
                        background-color: #ffffff !important; /* （白） */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                    }
                    .intro_tbl_wrap {
                    border: 0.5px solid #70ad47;
                    page-break-inside: avoid !important; /* ページ内で途中で改行しないようにする */
                    }

                }
            </style>
        `);
    }else if (tabId === 'tab-content06') {
        printWindow.document.write(`
            <style>
                @media print {
                    table {
                        width: 100%; /* テーブルの幅を100%にする */
                        table-layout: fixed; /* 固定レイアウトにする */
                        border-collapse: collapse !important; /* 枠線を重ねて表示 */
                        border-spacing: 0; /* セル間の隙間をなくす */
                        border: 1.5px solid #e2efda !important; /* 枠線を設定 */
                        background-color: #ffffff !important; /* 背景色を白に設定 */
                    }
                    th, td {
                        word-wrap: break-word; /* 単語の途中で改行する */
                        overflow: hidden; /* オーバーフローを隠す */
                        white-space: normal; /* ホワイトスペースを通常にする */
                        padding: 5px; /* 余白を追加 */
                        page-break-inside: avoid; /* ページ内で途中で改行しないようにする */
                        border: solid 0.5px #fff !important; /* セルの境界線を0.5pxの線に設定 */
                        color: #000000 !important; /* テキストの色を黒に設定 */
                        font-weight: bolder; /* フォントの太さを太字に設定 */
                        text-align: center !important;  /* テキストを中央揃えに設定 */
                    }
                    th {
                        background-color: #419116 !important; /* 見出し行の背景色を設定 */
                        color: #fff !important; /* 見出し行の文字色を設定 */
                        -webkit-print-color-adjust: exact !important; /* 背景色を印刷する */
                        print-color-adjust: exact !important; /* 背景色を印刷する */
                        border: solid 1px #fff !important; /* 見出し行の境界線を設定 */
                        text-align: center !important;  /* テキストを中央揃えに設定 */
                    }
                    tr {
                        border: 1px solid #fff !important; /* 行ごとに枠線を設定 */
                    }
                    /* 奇数行 */
                    table tr:nth-child(odd) td {
                        background-color: #e2efda;  /* （緑） */
                        -webkit-print-color-adjust: exact !important; /* 背景色を印刷する */
                        print-color-adjust: exact !important; /* 背景色を印刷する */
                    }
                    /* 偶数行 */
                    table tr:nth-child(even) td {
                        background-color: #ffffff !important; /* （白） */
                        -webkit-print-color-adjust: exact !important; /* 背景色を印刷する */
                        print-color-adjust: exact !important; /* 背景色を印刷する */
                    }
                    .intro_tbl_wrap {
                        border: 1px solid #e2efda !important;
                    }
                }
            </style>
        `);
    } else if (tabId === 'tab-content08') {
        printWindow.document.write(`
            <style>
                @media print {
                    table {
                        width: 100%; /* テーブルの幅を100%にする */
                        table-layout: fixed; /* 固定レイアウトにする */
                        border-collapse: collapse !important; /* 枠線を重ねて表示 */
                        border-spacing: 0; /* セル間の隙間をなくす */
                        border: 1.5px solid #e2efda !important; /* 枠線を設定 */
                    }
                    th, td {
                        word-wrap: break-word; /* 単語の途中で改行する */
                        overflow: hidden; /* オーバーフローを隠す */
                        white-space: normal; /* ホワイトスペースを通常にする */
                        padding: 5px; /* 余白を追加 */
                        page-break-inside: avoid; /* ページ内で途中で改行しないようにする */
                        border: solid 0.5px #fff !important; /* セルの境界線を0.5pxの線に設定 */
                        color: #000000 !important; /* テキストの色を黒に設定 */
                        font-weight: bolder; /* フォントの太さを太字に設定 */
                        text-align: center !important;  /* テキストを中央揃えに設定 */
                    }
                    th {
                        background-color: #419116 !important; /* 見出し行の背景色を設定 */
                        color: #fff !important; /* 見出し行の文字色を設定 */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                        border: solid 1px #fff !important; /* 見出し行の境界線を設定 */
                    }
                    tr {
                        border: 1px solid #fff !important; /* 行ごとに枠線を設定 */
                    }
                    /* 奇数行 */
                    tbody tr:nth-child(odd) td {
                        background-color: #e2efda;  /* （緑） */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                    }
                    /* 偶数行 */
                    tbody tr:nth-child(even) td {
                        background-color: #ffffff !important; /* （白） */
                        -webkit-print-color-adjust: exact; /* 背景色を印刷する */
                        print-color-adjust: exact; /* 背景色を印刷する */
                    }

                }
            </style>
        `);
    }

    // 印刷ウィンドウにHTMLコンテンツを書き込む
    printWindow.document.write('</head><body>');
    printWindow.document.write('<div id="print-content">' + divContents + '</div>');
    printWindow.document.write('</body></html>');
    // ドキュメントの書き込みを終了
    printWindow.document.close();

    // requestAnimationFrameを使用して印刷ダイアログを表示
    function checkReadyState() {
        // ドキュメントの読み込みが完了したら印刷ダイアログを表示
        if (printWindow.document.readyState === 'complete') {
            printWindow.print();
        } else {
            requestAnimationFrame(checkReadyState);
        }
    }
    
    // 印刷が終了した後にウィンドウを閉じる
    printWindow.onafterprint = function() {
        printWindow.close();
    };
    
    // ドキュメントの読み込みが完了したかどうかをチェック
    requestAnimationFrame(checkReadyState);
}