// 印刷ウィンドウの参照を保持する変数
var printWindow = null;

// 検索結果の医療機関名を取得する関数
function printTab(tabId, tabName) {
    var hosName = document.myform.hos_name.value;
    printTabWithHosName(tabId, tabName, hosName);
}

// 指定されたタブの内容を印刷する関数
function printTabWithHosName(tabId, tabName, hosName) {
    if (printWindow && !printWindow.closed) {
        printWindow.close();
    }

    var tabContent = document.getElementById(tabId);
    var ukMarginElements = tabContent.querySelectorAll('.tab-print');

    var divContents = Array.from(ukMarginElements)
        .map(element => element.innerHTML)
        .join('');

    console.clear();
    console.log(divContents);

    printWindow = window.open('', '', 'height=900,width=1500');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>' + hosName + ' - ' + tabName + '</title>');
    printWindow.document.write('<link rel="stylesheet" href="../css/style.css"/>');
    printWindow.document.write('<link rel="stylesheet" href="../css/form_parts.css" />');
    printWindow.document.write('<link rel="stylesheet" href="../css/marker.css"/>');
    printWindow.document.write('<link rel="stylesheet" href="../css/all.min.css" />');
    printWindow.document.write('<link rel="stylesheet" href="../css/cards.css"/>');
    printWindow.document.write('<link rel="stylesheet" href="../css/tab.css"/>');

    printWindow.document.write(`
        <style>
        @page {
            size: A4;
            margin: 5mm;
        }

        @media print {
            * {
                margin: 0 !important;
                padding: 0 !important;
            }

            .uk-input {
                border: none !important;
                font-size: 10px !important;
                padding: 10px !important;
                height: auto !important;
            }
            
            .uk-select, .uk-radio {
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                appearance: none !important;
                background: none !important;
                border: none !important;
                font-size: 10px !important;
                padding: 10px !important;
                height: auto !important;
            }

            .uk-form-controls input.uk-radio:not(:checked),
            .uk-form-controls label:has(input.uk-radio:not(:checked)) {
                display: none !important;
            }

            .uk-text-danger {
                display: none !important;
            }

            .uk-grid input.uk-radio:not(:checked),
            .uk-grid label:has(input.uk-radio:not(:checked)) {
                display: none !important;
            }

            .uk-form-controls label:has(input.uk-radio:checked),
            .uk-grid label:has(input.uk-radio:checked) {
                font-size: 10px !important;
            }

            .uk-input::placeholder {
                color: transparent !important;
            }

            /* 共通テーブルスタイル */
            table {
                width: 100% !important;
                table-layout: fixed !important;
                border-collapse: collapse !important;
                border-spacing: 0 !important;
            }

            th, td {
                word-wrap: break-word !important;
                overflow: hidden !important;
                white-space: normal !important;
                padding: 5px !important;
                page-break-inside: avoid !important;
                border: solid 0.5px #fff !important;
                color: #000000 !important;
                font-weight: bolder !important;
                text-align: center !important;
            }

            th {
                background-color: #419116 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                border: solid 1px #fff !important;
            }

            tr {
                border: 1px solid #fff !important;
                break-inside: avoid !important;
            }

            tbody tr:nth-child(odd) td {
                background-color: #e2efda !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            tbody tr:nth-child(even) td {
                background-color: #ffffff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
        </style>
    `);

    // タブごとの追加スタイル
    if(tabId === 'tab-content02') {
        printWindow.document.write(`
            <style>
                @media print {
                    .uk-grid {
                        display: flex;
                        flex-wrap: wrap;
                        margin: 0;
                        padding: 0;
                        list-style: none;
                        gap: 10px;
                    }
                    .uk-grid > li {
                        margin: 5px;
                    }
                    .tbl-border {
                        border-collapse: collapse;
                        border-spacing: 10px;
                        width: 90%;
                    }
                    .tbl-border th, .tbl-border td {
                        background: #ffffff;
                        border: solid 1px #000000;
                        text-align: center;
                    }
                    .uk-subnav.uk-subnav-pill {
                        display: none !important;
                    }
                }
            </style>
        `);
    } else if (tabId === 'tab-content03') {
        printWindow.document.write(`
            <style>
                @media print {
                    .table-bordered {
                        border: 1.5px #acacac solid !important;
                    }
                    .table-bordered th {
                        padding: 5px !important;
                        background: #e2efda !important;
                        border: solid 0.5px #acacac !important;
                        color: #000000 !important;
                    }
                    .table-bordered td {
                        padding: 1px !important;
                        border: solid 0.5px #e2efda !important;
                    }
                    .rowInsert-btn {
                        display: none !important;
                    }
                    input[type="text"] {
                        width: 100% !important;
                    }
                    .uk-input {
                        border: none !important;
                        font-size: 20px !important;
                    }
                }
            </style>
        `);
    } else if (tabId === 'tab-content04' || tabId === 'tab-content05') {
        printWindow.document.write(`
            <style>
                @media print {
                    .intro_tbl_wrap {
                        border: 0.5px solid #70ad47 !important;
                        page-break-inside: avoid !important;
                    }
                    .rowInsert-btn {
                        display: none !important;
                    }
                }
            </style>
        `);
    } else if (tabId === 'tab-content06') {
        printWindow.document.write(`
            <style>
                @media print {
                    table {
                        border: 1.5px solid #e2efda !important;
                        background-color: #ffffff !important;
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
                @page {
                    size: A4 landscape;
                    margin: 5mm;
                }
                @media print {
                    table {
                        border: 1.5px solid #e2efda !important;
                    }
                }
            </style>
        `);
    }

    printWindow.document.write('</head><body>');
    printWindow.document.write('<div id="print-content">' + divContents + '</div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    function checkReadyState() {
        if (printWindow.document.readyState === 'complete') {
            printWindow.print();
        } else {
            requestAnimationFrame(checkReadyState);
        }
    }
    
    printWindow.onafterprint = function() {
        printWindow.close();
    };
    
    requestAnimationFrame(checkReadyState);
}
