<!DOCTYPE html>
<html>

<head>
    <link href="asset/css/style2.css" rel="stylesheet">
    <style>        
        body {
            position: relative;
            width: auto;
            height: auto;
            background: #FFFFFF;
        }

        .image-div {
            position: absolute;
            width: 68px;
            height: 117px;
            left: 43px;
            top: 0px;
            background: #0B0519;
        }

        .img {
            position: absolute;
            width: 56px;
            height: 49px;
            left: 6px;
            top: 33px;
        }

        .header {
            position: absolute;
            width: 595px;
            height: 66px;
            left: 0px;
            top: 27px;

            background: rgba(11, 5, 25, 0.1);
        }

        .name {
            position: absolute;
            width: auto;
            height: 18px;
            left: 138px;
            top: 9px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            line-height: 18px;
            /* identical to box height */

            letter-spacing: 0.02em;

            color: #36454F;
        }

        .checker {
            position: absolute;
            width: auto;
            height: 12px;
            left: 138px;
            top: 30px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 10px;
            line-height: 12px;
            /* identical to box height */

            letter-spacing: 0.02em;

            color: #36454F;
        }

        .date {
            position: absolute;
            width: 54px;
            height: 12px;
            left: 138px;
            top: 45px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 10px;
            line-height: 12px;
            /* identical to box height */

            letter-spacing: 0.02em;

            color: #36454F;
        }

        .grammar {
            position: absolute;
            width: 507px;
            height: 34px;
            left: 44px;
            top: 161px;

            background: blue;
            opacity: 0.24;
        }

        .text {
            position: absolute;
            width: auto;
            height: 21px;
            left: 12.29px;
            top: 7px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 700;
            font-size: 18px;
            line-height: 21px;
            letter-spacing: 0.02em;

            color: black;
        }

        .grade {
            position: absolute;
            width: auto;
            height: 17px;
            right: 55.33px;
            top: 7px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 17px;
            /* identical to box height */

            letter-spacing: 0.02em;

            color: black;
        }

        .grammar-note {
            position: absolute;
            width: 508px;
            height: auto;
            left: 44px;
            top: 206px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 10px;
            line-height: 12px;
            letter-spacing: 0.02em;

            color: #202020;
        }

        .line-1 {
            position: relative;
            width: 507px;
            height: 0px;
            left: 0px;
            margin-top: 30px;

            border: 1px solid #E3E3E3;
        }

        .content {
            position: inherit;
            width: 507px;
            height: 34px;
            left: 44px;
            top: 327px;

            background: #ECF7D5;
        }

        .content-note {
            position: absolute;
            width: 508px;
            height: auto;
            left: 44px;
            top: 372px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 10px;
            line-height: 12px;
            letter-spacing: 0.02em;

            color: #202020;
        }

        .structure {
            position: absolute;
            width: 507px;
            height: 34px;
            left: 44px;
            top: 494px;

            background: #FF0000;
            opacity: 0.24;
        }

        .structure-note {
            position: absolute;
            width: auto;
            height: auto;
            left: 44px;
            top: 539.16px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 10px;
            line-height: 12px;
            letter-spacing: 0.02em;

            color: #202020;
        }

        .thought {
            position: absolute;
            width: 507px;
            height: 34px;
            left: 44px;
            top: 670px;
            background: black;
        }

        .thought-note {
            position: absolute;
            width: 507px;
            height: auto;
            left: 44px;
            top: 718px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 400;
            font-size: 10px;
            line-height: 12px;
            letter-spacing: 0.02em;

            color: #202020;
        }

        .bottom {
            position: absolute;
            width: 595px;
            height: 34px;
            left: 0px;
            top: 808px;

            background: rgba(11, 5, 25, 0.1);
        }

        .mail {
            position: absolute;
            width: auto;
            height: 12px;
            left: 61px;
            top: 11px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 700;
            font-size: 10px;
            line-height: 12px;
            /* identical to box height */

            letter-spacing: 0.02em;

            color: #36454F;
        }

        .mail-icon {
            position: absolute;
            left: 43px;
            top: 12.43px;
        }

        .web {
            position: absolute;
            width: auto;
            height: 12px;
            right: 42px;
            top: 11px;

            font-family: 'AvantGarde Bk BT';
            font-style: normal;
            font-weight: 700;
            font-size: 10px;
            line-height: 12px;
            /* identical to box height */

            letter-spacing: 0.02em;

            color: #36454F;
        }

        .web-icon {
            position: absolute;
            right: 128px;
            top: 11px;
        }
    </style>
</head>

<body>
    <div class="image-div">
        <img class="img" src="{{ asset('uploads/website/logo.png') }}" />
    </div>
    <div class="header">
        <div>
            <div class="name">
                {{ \App\Models\UserProfileModel::where('user_id', '=', $grading->users_id)->first()->f_name }}
                {{ \App\Models\UserProfileModel::where('user_id', '=', $grading->users_id)->first()->l_name }}
            </div>
            <div class="checker">
                <b>Checker:</b>{{ $grading->admins->first_name }} {{ $grading->admins->last_name }}
                ({{ $grading->admins->username }})
            </div>
            <div class="date">
                {{ formatted_date($grading->created_at, 'd-m-Y') }}
            </div>
        </div>
        <div style="text-align: right;margin: 20px">
            Total
            Score:{{ (($grading->grammar_grade + $grading->content_grade + $grading->structure_grade + $grading->final_thought_grade) / 40) * 100 }}%
        </div>
    </div>
    <div class="grammar">
        <div class="text">
            Grammar
        </div>
        <div class="grade">
            Grade: <b> {{ $grading->grammar_grade }}/10</b>
        </div>
    </div>
    <div class="grammar-note">
        {{ $grading->grammar_note }}
        <div class="line-1"></div>
    </div>
    <div class="content">
        <div class="text">
            Content
        </div>
        <div class="grade">
            Grade: <b> {{ $grading->content_grade }}/10</b>
        </div>
    </div>
    <div class="content-note">
        {{ $grading->content_note }}
        <div class="line-1"></div>
    </div>
    <div class="structure">
        <div class="text">
            Structure
        </div>
        <div class="grade">
            Grade: <b> {{ $grading->structure_grade }}/10</b>
        </div>
    </div>
    <div class="structure-note">
        {{ $grading->structure_note }}
        <div class="line-1"></div>
    </div>
    <div class="thought">
        <div class="text" style="color: white">
            Final Thought
        </div>
        <div class="grade" style="color: white">
            Grade: <b> {{ $grading->final_thought_grade }}/10</b>
        </div>
    </div>
    <div class="thought-note">
        {{ $grading->final_thought_note }}
    </div>
    <div class="bottom">
        <img class="mail-icon" src="{{ asset('uploads/website/mail.png') }}" />
        <b class="mail">info@twizzle.com</b>
        <img class="web-icon" src="{{ asset('uploads/website/web.png') }}" />
        <b class="web">www.twizzle.com</b>
    </div>
</body>

</html>
