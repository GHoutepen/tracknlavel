@extends('layouts.pdf')

@section('title')
    - {{ $title }}
@endsection

@section('content')
    <style>
        @page {
            size: a4 portrait;
            margin: 0;
            padding: 0;
        }

        .body {
            font-family: Arial, sans-serif;
            width: 100%;
            border-radius: 20px;
            margin: 10px 30px 30px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 20px;
        }

        .blocked {
            display: inline-block;
            text-align: left;
            width: 23%;
        }

        .left {
            display: inline-block;
            text-align: left;
            width: 49%;
        }

        .right {
            display: inline-block;
            text-align: right;
            width: 49%;
        }

        .row {
            width: 100%;
        }

        .greenBlock {
            background-color: #009a41;
            width: 100%;
            height: 20px;
        }

        .bottom {
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .info {
            position: absolute;
            bottom: 30px;
            width: 100%;
            color: #009a41;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .tableBody tr td {
            border-bottom: 1px solid #009a41;
        }

        .tableHead tr th {
            border-bottom: 2px solid #000;
        }

        .line-top {
            border-top: 2px solid #000;
        }

        body footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
        }

        .footerblock {
            display: inline-block;
            text-align: left;
            width: 30%;
        }
    </style>
    @php
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML(); // http://track-n-label.test/track/shipmentView/b7eb6acc-9b42-44f7-8104-f2b31f4bea36/9e606e6b-44a4-4a4e-a309-cc70ddd3a103
// words longest bar code..
    @endphp
<div style="margin: 40px">
    <div class="subject-header">
        <div class="row">
            <div class="left">
                {{$shipment['receiver_contact']['name']}}<br/>
                {{$shipment['receiver_contact']['street']}} {{$shipment['receiver_contact']['housenumber']}}<br/>
                {{$shipment['receiver_contact']['postalcode']}} {{$shipment['receiver_contact']['locality']}}<br/>
            </div>
            <div class="right">
                {!! $generator->getBarcode($shipment['barcode'], $generator::TYPE_CODE_128) !!}
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 40px;">
        <div class="row">
            <h2>Pakbon : {{$shipment['reference']}} - {{$shipment['brand']['name']}}</h2>   <br/>
        </div>

            <div class="blocked">
                <b>Pakbonnummer:<br/>
                Klantnummer:<br/>
                BTW-nummer:<br/>
                Pakbondatum:</b><br/>
            </div>
            <div class="blocked">
                {{$shipment['reference']}}<br/>
                004<br/>
                NL0123456234B10<br/>
                {{Carbon\Carbon::parse($shipment['created'])->format('d-m-Y')}}<br/>
            </div>
            <div class="blocked">
                {!! QrCode::size(200)->generate('http://track-n-label.test/track/shipmentView/b7eb6acc-9b42-44f7-8104-f2b31f4bea36/9e606e6b-44a4-4a4e-a309-cc70ddd3a103') !!}
            </div>
        </div>

    <p style="margin-top: 40px;">Hierbij ontvangt u de pakbon voor factuur nummer xxx en onderstaande bestelling.</p>

    <table width="100%">
        <thead class="tableHead">
            <tr>
                <th style="text-align: left">Naam / Beschrijving</th>
                <th style="text-align: center"></th>
                <th style="text-align: right">Aantal</th>
            </tr>
        </thead>
        <tbody >
            <tr>
                <td style="text-align: left"> $invoice->description }} </td>
                <td style="text-align: center"></td>
                <td style="text-align: right"> 1</td>
            </tr>
            <tr>
                <td style="text-align: left"> $invoice->description }} </td>
                <td style="text-align: center"></td>
                <td style="text-align: right"> 1</td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="line-top"></div>
    </div>

    <p style="margin-top: 20px;">Mocht u nog vragen hebben, kunt u ons bereiken.</p>

</div>

    <footer style="margin-left: 40px; margin-right: 40px" class="line-top">
        <div style="margin-top: 20px">
        <div class="footerblock">
            Track N Label B.V.<br/>
            Realstreet 12<br/>
            1234PG Realdam<br/>
        </div>
        <div class="footerblock">
            Telefoon : 061222222<br/>
            Email: test@test.test<br/>
            Website: track-n-label.test<br/>
        </div>
        <div class="footerblock">
            KvK : 12345<br/>
            BTW: NL0123456234B10<br/>
            Rekening:NL0123456234B10<br/>
        </div>
        </div>
    </footer>
@endsection
