<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template One CV</title>

    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #444;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #003366;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header .name {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }

        .header .position {
            font-size: 1.2rem;
            text-transform: uppercase;
            margin-top: 10px;
            letter-spacing: 2px;
        }

        .profile-pic {
            text-align: center;
            margin: 20px 0;
        }

        .profile-pic img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .content {
            padding: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #003366;
            margin-bottom: 10px;
            border-bottom: 2px solid #003366;
            padding-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-content {
            margin-bottom: 20px;
        }

        .section-content p {
            margin: 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        .horizontal-sections {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #f0f0f0;
        }

        .section-block {
            flex: 1;
            min-width: 150px;
            margin: 10px;
        }

        .section-block-title {
            font-size: 1.2rem;
            color: #003366;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #003366;
            padding-bottom: 5px;
        }

        .section-block-content ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }

        .section-block-content ul li {
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            font-size: 0.8rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="name">{{ $personal_details->name }}</div>
            <div class="position">{{ $personal_details->designation }}</div>
        </div>

        <div class="profile-pic">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($cvImgPath)) }}" alt="Profile Picture">
        </div>

        <div class="horizontal-sections">
            <div class="section-block">
                <div class="section-block-title">Personal Details</div>
                <div class="section-block-content">
                    <ul>
                        <li>{{ $personal_details->address }}</li>
                        <li>{{ $personal_details->marital_status }}</li>
                        <li>{{ $personal_details->gender }}</li>
                        <li>{{ $personal_details->email }}</li>
                        <li>{{ $personal_details->mobile_no }}</li>
                        <li>{{ $personal_details->birthday }}</li>
                    </ul>
                </div>
            </div>

            <div class="section-block">
                <div class="section-block-title">Languages</div>
                <div class="section-block-content">
                    <ul>
                        @foreach ($languages as $language)
                        <li>{{ $language->language }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="section-block">
                <div class="section-block-title">Personal Skills</div>
                <div class="section-block-content">
                    <ul>
                        @foreach ($personal_skills as $personal_skill)
                        <li>{{ $personal_skill->personal_skill }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="section-block">
                <div class="section-block-title">Tech Skills</div>
                <div class="section-block-content">
                    <ul>
                        @foreach ($tech_skills as $tech_skill)
                        <li>{{ $tech_skill->tech_skill }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="section-block">
                <div class="section-block-title">Interests</div>
                <div class="section-block-content">
                    <ul>
                        @foreach ($interests as $interest)
                        <li>{{ $interest->interest }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">About Me</div>
                <div class="section-content">
                    <p>{{ $about_you->about_you }}</p>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Work Experience</div>
                <div class="section-content">
                    @foreach ($work_experiences as $work_experience)
                    <p><strong>{{ $work_experience->designation }}</strong><br>
                        {{ $work_experience->company_name }}<br>
                        <small>{{ $work_experience->started_date }} - {{ $work_experience->end_date }}</small>
                    </p>
                    <p>{{ $work_experience->description }}</p>
                    @endforeach
                </div>
            </div>

            <div class="section">
                <div class="section-title">Educational Qualifications</div>
                <div class="section-content">
                    @foreach ($educational_qualifications as $educational_qualification)
                    <p><strong>{{ $educational_qualification->qualification }}</strong><br>
                        {{ $educational_qualification->institute_name }}<br>
                        <small>{{ $educational_qualification->started_date }} - {{ $educational_qualification->end_date }}</small>
                    </p>
                    <p>{{ $educational_qualification->description }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ $personal_details->name }}. All rights reserved.
        </div>
    </div>
</body>

</html>
