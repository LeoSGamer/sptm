<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modern CV</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;

        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 30px auto;
            background-color: #ffffff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .header {
            background-color: #2d3e50;
            color: #ffffff;
            padding: 40px;
            text-align: center;
        }

        .header .name {
            font-size: 2.8rem;
            font-weight: bold;
            margin: 0;
        }

        .header .position {
            font-size: 1.2rem;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #b0bec5;
        }

        .profile-pic {
            text-align: center;
            margin: -60px 0 20px 0;
        }

        .profile-pic img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
        }

        .content {
            padding: 40px;
        }

        .section-title {
            font-size: 1.6rem;
            color: #2d3e50;
            margin-bottom: 20px;
            border-left: 5px solid #ff6f61;
            padding-left: 15px;
            text-transform: uppercase;
        }

        .section-content {
            margin-bottom: 30px;
        }

        .section-content p {
            margin: 0;
            font-size: 1rem;
            line-height: 1.6;
            color: #444;
        }

        .horizontal-sections {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .section-block {
            flex: 1;
            min-width: 200px;
            margin: 10px;
            padding: 15px;
            background-color: #f0f4f8;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
        }

        .section-block-title {
            font-size: 1.2rem;
            color: #ff6f61;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-block-content ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }

        .section-block-content ul li {
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.5;
            color: #333;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #2d3e50;
            font-size: 0.9rem;
            color: #b0bec5;
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
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ $personal_details->name }}. All rights reserved.
        </div>
    </div>
</body>

</html>
