<?php

namespace \App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;


    function downloadPdf(Request $request)
{
    if (auth()->check()) {
        $userId = auth()->id();

        if (!$userId) {
            return 'Error: User ID is null';
        }
//Cambiar por datos del cadaver :D
        $personal_details = PersonalDetail::where('user_id', $userId)->latest()->first();
        $languages = Language::where('user_id', $userId)->get();
        $personal_skills = PersonalSkill::where('user_id', $userId)->get();
        $about_you = AboutYou::where('user_id', $userId)->latest()->first();
        $work_experiences = WorkExperience::where('user_id', $userId)->get();
        $tech_skills = TechSkill::where('user_id', $userId)->get();
        $interests = Interest::where('user_id', $userId)->get();
        $educational_qualifications = EducationalQualification::where('user_id', $userId)->get();


        if (!$personal_details || !$languages || !$personal_skills || !$about_you || !$work_experiences || !$tech_skills || !$interests || !$educational_qualifications) {
            return redirect()->back()->with('error', 'Datos del cadaver no encontrados.');
        }

        $download = $request->input('download');


      //Como tal esto es para que se vean imagenes estilo perfiles
      // $cvImgPath = public_path('/uploads/cv_img/' . $personal_details->cv_img);

      //  if (!file_exists($cvImgPath)) {
      //      return redirect()->back()->with('error', 'CV image not found.');
      //  }

        $data = [
            'personal_details' => $personal_details,
            'languages' => $languages,
            'personal_skills' => $personal_skills,
            'about_you' => $about_you,
            'work_experiences' => $work_experiences,
            'tech_skills' => $tech_skills,
            'interests' => $interests,
            'educational_qualifications' => $educational_qualifications,
         // imagenes   'cvImgPath' => $cvImgPath
        ];

        $options = new Options();
        $options->set('chrootValid',true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        if ($download === 'pdf.pdf1') {
            $html = view('pdf.pdf1', $data)->render();
            $dompdf->loadHtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $dompdf->stream('pdf1.pdf');

        } elseif ($download === 'pdf.pdf2') {
            $html = view('pdf.pdf2', $data)->render();
            $dompdf->loadHtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $dompdf->stream('pdf2.pdf');
        } else {
            return redirect()->back()->with('error', 'Invalid preview selection.');
        }
    }
}
