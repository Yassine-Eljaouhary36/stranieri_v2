@extends('voyager::master')
@section('css')
    <style>
        .custom-dashboard {
            /* display: flex; */
            /* flex-wrap: wrap; */
            /* justify-content: space-around; */
            padding: 30px;
        }

        .custom-section {
            color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin: 10px;
            flex: 1;
            min-width: 300px;
        }
        .custom-section.profits {
            background: linear-gradient(45deg, #4CAF50, #7ED56F);
        }

        .custom-section.income {
            background: linear-gradient(45deg, #3498DB, #5BC0DE);
        }
        .custom-section.orders {
            background: linear-gradient(45deg, #FFA500, #FFD700);
        }
        .custom-section h2 {
            font-size: 36px;
            margin: 0;
        }

        .custom-section p {
            font-size: 18px;
            margin: 10px 0;
        }

        .custom-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 40px
        }

        .custom-row .custom-section {
            flex: 1;
            min-width: 300px;
        }
        .section-title {
            font-size: 24px;
            text-align: start;
            margin-bottom: 20px;
            padding-left: 10px;
        }
        @media (max-width: 768px) {
            .custom-section {
                flex-basis: 100%;
            }
        }
    </style>
@stop
@section('content')
    <div class="page-content">
        <div class="custom-dashboard">
            @include('vendor.voyager.components.statistics.orders-cards',['allData' => $allData])
            @include('vendor.voyager.components.statistics.profits-cards',['allData' => $allData])
            @include('vendor.voyager.components.statistics.income-cards',['allData' => $allData])
            @include('vendor.voyager.components.statistics.bar-chart',['labels' => $labels ,'data'=>$data])
        </div>
    </div>
@stop

