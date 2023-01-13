@extends('layouts.main')
@push('header')
    <title>Evalution | Twizzle</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        @font-face {
            font-family: 'Gotham';
            src: url(fonts/Gotham-Bold.otf);
        }

        @font-face {
            font-family: 'AvantGarde Bk BT';
            src: url(fonts/AVGARDN_2.TTF);
        }

        .pdf3 {
            background: rgba(11, 5, 25, 0.1);
        }

        .pdf3 .container {
            width: 90%;
            margin: 0px auto;
        }

        .pdf3_inner {
            max-width: 1152px;
            margin: 0px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 0px;
        }

        .pdf3 .left {
            width: 100%;
            text-align: center;
            padding: 0px 50px;
        }

        .pdf3 .left p {
            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0.02em;
            color: #202020;
            max-width: 595px;
            margin: 0px auto;
        }

        .pdf3 .left a {
            display: inline-block;
            text-decoration: none;
            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 0.02em;
            color: #202020;
            padding: 10px 15px;
            border-radius: 8px;
            border: 2px solid #202020;
            margin: 50px 0px 0px 0px;
        }

        .pdf3 .right {
            min-width: 595px;
            max-width: 595px;
        }

        .pdf3 .right .image {
            width: 100%;
            height: 100%;
        }

        .pdf3 .right .image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-bottom: 2px solid #202020;
        }

        @media (max-width: 1280px) {
            .pdf3 .right {
                min-width: 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 1024px) {
            .pdf3 .left {
                padding: 0px 25px;
            }

            .pdf3 .left p {
                font-size: 14px;
                line-height: 20px;
            }

            .pdf3 .left a {
                margin: 25px 0px 0px 0px;
                font-size: 16px;
            }
        }

        @media (max-width: 767px) {
            .pdf3_inner {
                flex-direction: column;
                padding: 25px 0px 50px 0px;
            }

            .pdf3 .left {
                padding: 0px;
                min-width: 100%;
                max-width: 100%;
                margin-top: 35px;
                order: 2;
            }

            .pdf3 .right {
                padding: 0px;
                min-width: 100%;
                max-width: 100%;
                order: 1;
            }
        }

        @media (max-width: 480px) {
            .pdf3 .left p {
                font-size: 12px;
                line-height: 18px;
            }

            .pdf3 .left a {
                font-size: 14px;
            }
        }
    </style>
@endpush
@section('section')
<div class="pdf3">
    <div class="container">
        <div class="pdf3_inner">
            <div class="left">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, dolores consequatur harum
                    maiores quas similique voluptates in itaque deleniti ex iste neque libero repellendus aut
                    aliquam placeat at necessitatibus sapiente nemo eum aspernatur eos illum tenetur? Possimus dicta
                    et nobis architecto ea mollitia beatae commodi, cupiditate, eveniet aperiam quos ducimus.
                </p>
                <a href="{{ route('user.essay-grading') }}">Submit essay</a>
            </div>
            <div class="right">
                <div class="image"><img src="{{ asset('front/images/PDF Page 1.png') }}" alt=""></div>
            </div>
        </div>
    </div>
</div>
@endsection
