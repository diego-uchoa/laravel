<!DOCTYPE html>
<html>
    <head>
        <style>
            * {
                font-family: Arial, sans-serif;
            }

            footer {
                position: absolute;
                bottom: 0;
                font-size: 11px;
                color: #555;
            }

            p {
                color: #333;
                font-size: 12px;
            }

            .content {
                width: 100%;
                margin: 10px 0 !important;
            }

            .row{
                margin: 15px 0;
            }

            .title {
                font-size: 23px;
                color: #2679b5;
                font-family: Arial, sans-serif;
                padding-top: 30px;
                padding-bottom: 15px;
                font-weight: bold;
            }

            .periodo {
                font-size: 14px;
                color: #4d99d1;
                font-family: Arial, sans-serif;
                padding-bottom: 25px; 
            }

            ol { 
                counter-reset: item; 
                padding-left:0;
            }

            ol li { 
                display: block; 
                font-size: 13px;
                color: #111;
                font-family: Arial, sans-serif;
                padding-top: 20px;
                padding-bottom: 5px;
                font-weight: bold; 
            }

            ol li:before {
                content: counter(item) ". ";
                counter-increment: item;
                font-size: 13px;
                color: #111;
                font-family: Arial, sans-serif;
                padding-top: 20px;
                padding-bottom: 5px;
                font-weight: bold;
            }

            table {
                border-collapse:collapse;
                border-spacing:0;
                border-color:#333;
                margin:0px auto;
                overflow-x:hidden;
            }

            table td {
                font-family:Arial, sans-serif;
                font-size:11px;
                padding:5px 10px;
                border-style:solid;
                border-width:1px;
                overflow:hidden;
                word-break:normal;
                border-color:#333;
                color:#444;
                background-color:#fff;
            }

            table th {
                padding:5px 5px;
                border-style:solid;
                border-width:1px;
                overflow:hidden;
                word-break:normal;
                border-color:#333;
                font-weight:bold;
                font-size:12px;
                font-family:Arial, Helvetica, sans-serif !important;
                background-color:#ddd;
                color:#444;
                text-align:center;
            }
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <img src="{{ public_path('modules/parla/img/banner_pdf.jpg') }}" width="100%"/>
        

        <div class="content">
            @yield('content')
        </div>


        <footer>
            Relatório gerado em {{ date('d/m/Y H:i:s') }} com base nas informações cadastradas no Parla.
        </footer>
    </body>
</html>