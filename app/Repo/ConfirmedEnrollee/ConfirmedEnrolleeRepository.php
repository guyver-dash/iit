<?php 

namespace App\Repo\ConfirmedEnrollee;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\ConfirmEnrolled;
use App\Model\Sibling;
use CodeItNow\BarcodeBundle\Utils\QrCode;

class ConfirmedEnrolleeRepository extends BaseRepository implements ConfirmedEnrolleeInterface{

	public function __construct(){

		$this->modelName = new ConfirmEnrolled();
	}

	  public function update($request, $id){

        $confirmedEnroll = $this->modelName->find($id);
        $confirmedEnroll->schedule_id = $request->confirmedEnrolled['schedule_id'];
        $confirmedEnroll->school_year_id = $request->confirmedEnrolled['school_year_id'];
        $confirmedEnroll->semester_id = $request->confirmedEnrolled['semester_id'];
        $confirmedEnroll->year_level_id = $request->confirmedEnrolled['year_level_id'];
        $confirmedEnroll->start_time = $request->confirmedEnrolled['start_time'];
        $confirmedEnroll->end_time = $request->confirmedEnrolled['end_time'];
        $confirmedEnroll->status = $request->confirmedEnrolled['status'];
        $confirmedEnroll->update();

        $confirmedEnroll->enrollee->lrn = $request->confirmedEnrolled['enrollee']['lrn'];
        $confirmedEnroll->enrollee->firstname = $request->confirmedEnrolled['enrollee']['firstname'];
        $confirmedEnroll->enrollee->lastname = $request->confirmedEnrolled['enrollee']['lastname'];
        $confirmedEnroll->enrollee->middlename = $request->confirmedEnrolled['enrollee']['middlename'];
        $confirmedEnroll->enrollee->suffix = $request->confirmedEnrolled['enrollee']['suffix'];
        $confirmedEnroll->enrollee->nickname = $request->confirmedEnrolled['enrollee']['nickname'];
        $confirmedEnroll->enrollee->age = $request->confirmedEnrolled['enrollee']['age'];
        $confirmedEnroll->enrollee->birthday = $request->confirmedEnrolled['enrollee']['birthday'];
        $confirmedEnroll->enrollee->birth_place = $request->confirmedEnrolled['enrollee']['birth_place'];
        $confirmedEnroll->enrollee->educ_at_id = $request->confirmedEnrolled['enrollee']['educ_at_id'];
        $confirmedEnroll->enrollee->sex = $request->confirmedEnrolled['enrollee']['sex'];
        $confirmedEnroll->enrollee->landline = $request->confirmedEnrolled['enrollee']['landline'];
        $confirmedEnroll->enrollee->mobile = $request->confirmedEnrolled['enrollee']['mobile'];
        $confirmedEnroll->enrollee->email = $request->confirmedEnrolled['enrollee']['email'];
        $confirmedEnroll->enrollee->religion = $request->confirmedEnrolled['enrollee']['religion'];
        $confirmedEnroll->enrollee->citizenship = $request->confirmedEnrolled['enrollee']['citizenship'];
        $confirmedEnroll->enrollee->present_province_id = $request->confirmedEnrolled['enrollee']['present_province_id'];
        $confirmedEnroll->enrollee->present_city_id = $request->confirmedEnrolled['enrollee']['present_city_id'];
        $confirmedEnroll->enrollee->present_zipcode = $request->confirmedEnrolled['enrollee']['present_zipcode'];
        $confirmedEnroll->enrollee->present_address = $request->confirmedEnrolled['enrollee']['present_address'];
        $confirmedEnroll->enrollee->permanent_province_id = $request->confirmedEnrolled['enrollee']['permanent_province_id'];
        $confirmedEnroll->enrollee->permanent_city_id = $request->confirmedEnrolled['enrollee']['permanent_city_id'];
        $confirmedEnroll->enrollee->permanent_zipcode = $request->confirmedEnrolled['enrollee']['permanent_zipcode'];
        $confirmedEnroll->enrollee->permanent_address = $request->confirmedEnrolled['enrollee']['permanent_address'];
        $confirmedEnroll->enrollee->father_lastname = $request->confirmedEnrolled['enrollee']['father_lastname'];
        $confirmedEnroll->enrollee->father_firstname = $request->confirmedEnrolled['enrollee']['father_firstname'];
        $confirmedEnroll->enrollee->father_middlename = $request->confirmedEnrolled['enrollee']['father_middlename'];
        $confirmedEnroll->enrollee->father_occupation = $request->confirmedEnrolled['enrollee']['father_occupation'];
        $confirmedEnroll->enrollee->father_contact_number = $request->confirmedEnrolled['enrollee']['father_contact_number'];
        $confirmedEnroll->enrollee->father_province_id = $request->confirmedEnrolled['enrollee']['father_province_id'];
        $confirmedEnroll->enrollee->father_city_id = $request->confirmedEnrolled['enrollee']['father_city_id'];
        $confirmedEnroll->enrollee->father_zipcode = $request->confirmedEnrolled['enrollee']['father_zipcode'];
        $confirmedEnroll->enrollee->father_address = $request->confirmedEnrolled['enrollee']['father_address'];
        $confirmedEnroll->enrollee->mother_firstname = $request->confirmedEnrolled['enrollee']['mother_firstname'];
        $confirmedEnroll->enrollee->mother_lastname = $request->confirmedEnrolled['enrollee']['mother_lastname'];
        $confirmedEnroll->enrollee->mother_middlename = $request->confirmedEnrolled['enrollee']['mother_middlename'];
        $confirmedEnroll->enrollee->mother_occupation = $request->confirmedEnrolled['enrollee']['mother_occupation'];
        $confirmedEnroll->enrollee->mother_contact_number = $request->confirmedEnrolled['enrollee']['mother_contact_number'];
        $confirmedEnroll->enrollee->mother_province_id = $request->confirmedEnrolled['enrollee']['mother_province_id'];
        $confirmedEnroll->enrollee->mother_city_id = $request->confirmedEnrolled['enrollee']['mother_city_id'];
        $confirmedEnroll->enrollee->mother_zipcode = $request->confirmedEnrolled['enrollee']['mother_zipcode'];
        $confirmedEnroll->enrollee->mother_address = $request->confirmedEnrolled['enrollee']['mother_address'];
        $confirmedEnroll->enrollee->name_of_school = $request->confirmedEnrolled['enrollee']['name_of_school'];
        $confirmedEnroll->enrollee->school_province_id = $request->confirmedEnrolled['enrollee']['school_province_id'];
        $confirmedEnroll->enrollee->school_city_id = $request->confirmedEnrolled['enrollee']['school_city_id'];
        $confirmedEnroll->enrollee->school_zipcode = $request->confirmedEnrolled['enrollee']['school_zipcode'];
        $confirmedEnroll->enrollee->school_address = $request->confirmedEnrolled['enrollee']['school_address'];
        $confirmedEnroll->enrollee->update();
        $confirmedEnroll->enrollee->siblings()->detach();

        foreach ($confirmedEnroll->enrollee->siblings as $key => $value) {
            $value->delete();
        }
        
        if(count($request->confirmedEnrolled['enrollee']['siblings']) > 0){
            foreach ($request->confirmedEnrolled['enrollee']['siblings'] as $key => $value) {
                $sibling = Sibling::create([
                        'name' => $value['name'],
                        'age' => $value['age'],
                        'school_name' => $value['school_name'],
                        'occupation' => $value['occupation']
                    ]);

                Sibling::find($sibling->id)->enrollee()->attach($sibling->id, [
                        'sibling_id' => $sibling->id,
                        'enrollee_id' => $confirmedEnroll->enrollee->id
                    ]);
            }
        }


        $confirmedEnroll->enrollee->answers()->detach();

        foreach ($request->confirmedEnrolled['enrollee']['answers'] as $key => $value) {
            $confirmedEnroll->enrollee->answers()->attach(
                    $confirmedEnroll->enrollee->id,
                    ['answer_id' => $value['id'],
                    'enrollee_id' => $confirmedEnroll->enrollee->id
                ]);
        }
        
        $confirmedEnroll->enrollee->requirementsDoc()->detach();

        foreach ($request->requirementsDocs as $key => $value) {

            $confirmedEnroll->enrollee->requirementsDoc()->attach(
                    $confirmedEnroll->enrollee->id,
                    ['requirement_doc_id' => $value,
                    'enrollee_id' => $confirmedEnroll->enrollee->id
                ]);
        }


        return response()->json($request->confirmedEnrolled['enrollee']['requirements_doc'] );
    }

    public function print($id){
        $confirmedEnroll = $this->modelName->find($id)->with(['enrollee.civil', 'enrollee.course', 'yearLevel', 'semester', 'schedule'])->first();
        $lrn = $confirmedEnroll->enrollee->lrn;
        $yearLevel = $confirmedEnroll->yearLevel->name;
        $semester = $confirmedEnroll->semester->name;
        $course = $confirmedEnroll->enrollee->course->name;
        $schedule = $confirmedEnroll->schedule->name;

        $name = $confirmedEnroll->enrollee->lastname . ', ' . $confirmedEnroll->enrollee->firstname . ' ' . $confirmedEnroll->enrollee->middlename . ' ' . $confirmedEnroll->enrollee->suffix; 
        $nickname = $confirmedEnroll->enrollee->nickname;
        $sex = $confirmedEnroll->enrollee->sex == 1 ? 'Female' : 'Male';
        $birthday = $confirmedEnroll->enrollee->birthday;
        $age = $confirmedEnroll->enrollee->age;
        $birthPlace = $confirmedEnroll->enrollee->birth_place;
        $civil = $confirmedEnroll->enrollee->toArray()['civil']['name'];
        $presentAddress = $confirmedEnroll->enrollee->present_address;
        $presentCity = $confirmedEnroll->enrollee->city->name;
        $presentProvince = $confirmedEnroll->enrollee->province->name;
        $presentZipcode = $confirmedEnroll->enrollee->present_zipcode;

        $permanentAddress = $confirmedEnroll->enrollee->permanent_address;
        $permanentCity = $confirmedEnroll->enrollee->permanentCity->name;
        $permanentProvince = $confirmedEnroll->enrollee->permanentProvince->name;
        $permanentZipcode = $confirmedEnroll->enrollee->present_zipcode;

        $landline = $confirmedEnroll->enrollee->landline;
        $mobile = $confirmedEnroll->enrollee->mobile;
        $email = $confirmedEnroll->enrollee->email;
        $fatherName = $confirmedEnroll->enrollee->father_lastname . ', ' . $confirmedEnroll->enrollee->father_firstname . ' ' . $confirmedEnroll->enrollee->father_middlename;
        $fatherContact = $confirmedEnroll->enrollee->father_contact_number;
        $fatherOcc = $confirmedEnroll->enrollee->father_occupation;
        $fatherAddress = $confirmedEnroll->enrollee->father_address;
        $fatherCity = $confirmedEnroll->enrollee->fatherCity->name;
        $fatherProvince = $confirmedEnroll->enrollee->fatherProvince->name;
        $fatherZipcode = $confirmedEnroll->enrollee->father_zipcode;

        $motherName = $confirmedEnroll->enrollee->mother_lastname . ', ' . $confirmedEnroll->enrollee->mother_firstname . ' ' . $confirmedEnroll->enrollee->mother_middlename;
        $motherContact = $confirmedEnroll->enrollee->mother_contact_number;
        $motherOcc = $confirmedEnroll->enrollee->mother_occupation;
        $motherAddress = $confirmedEnroll->enrollee->mother_address;
        $motherCity = $confirmedEnroll->enrollee->motherCity->name;
        $motherProvince = $confirmedEnroll->enrollee->motherProvince->name;
        $motherZipcode = $confirmedEnroll->enrollee->mother_zipcode;

        $siblings = '';
        foreach ($confirmedEnroll->enrollee->siblings as $sibling) {
            
            $siblings .= '<tr>
                            <td>Name: ' . $sibling->name . '</td>
                            <td>Age: ' . $sibling->age . '</td> 
                            <td>Occupation: ' . $sibling->occupation . '</td>
                            <td>School Name: ' . $sibling->school_name . '</td> 
                            </tr>';
        }

        $qrCode = new QrCode();
        $qrCode
            ->setText('QR code by codeitnow.in')
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabel('LRN: ' . $lrn)
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG)
        ;
        $qrCode = '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" / width="170" >';


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML("
                        <style>
                        #first tr, #first td{
                            padding: 5px; font-size: 12px;
                            border-collapse: collapse;
                        }
                        #second tr, #second td{
                            padding: 5px; font-size: 12px;
                            border-collapse: collapse;
                        }
                        </style>
                        <div style='position: absolute;'>
                            $qrCode
                        </div>
                        <div style='position: absolute; float: right; border: 1px solid black; width: 114px; height: 100px;'>
                            <br />
                            <br />
                            <br />
                            <p align='center'>2x2 Picture</p>
                        </div>
                        <p align='center' style='padding-left:90px;margin: 0px;'><img src='images/logos/logo.png' width='120' /> <p>
                        <h4 align='center' style='padding:0; margin:0;'>Intellisense Institute of Technology</h4>
                        <p align='center' style='padding:0; margin:0; font-size:12px;'>
                            2F Aspac Building, Guizo
                         </p>
                         <p align='center' style='padding:0; margin:0; font-size:12px;'>
                                Mandaue City, Cebu
                                (032) 4172412
                         </p>
                         <br />
                    <table id='first'>
                        <tr>
                            <td><strong>ADMISSION TYPE:</strong> </td>
                            <td><strong>STUDENT ID NO: </td>
                            <td><strong>DATE: </strong></td>
                            <td><strong>YEAR LEVEL:  </strong> <u>$yearLevel</u></td>
                        </tr>
                        
                        <tr>
                            <td><strong>SEMESTER: </strong> <u>$semester</u></td>
                            <td><strong>COURSE: </strong> <u> $course </u></td>
                            <td><strong>SCHEDULE: </strong> <u>$schedule </u></td>
                        </tr>

                    </table> 
                    <p><strong> PERSONAL INFORMATIONS</strong> </p>
                   <table id='second'>
                        <tr>
                            <td><strong>Name: </strong> <u>$name</u></td>
                            <td><strong>Nickname: </strong> <u>$nickname</u></td>

                        </tr>
                        <tr>
                            <td>Sex: $sex </td>
                            <td>Age: $age</td>
                            <td>Birthday: $birthday </td>
                        </tr>
                        <tr>
                            <td>Birth place: $birthPlace </td>
                            <td>Civil Status: $civil</td>
                            <td>Birthday: $birthday </td>
                        </tr>
                        <tr>
                            <td>Present address: $presentAddress</td>
                            <td>City: $presentCity</td>
                            <td>Province: $presentProvince</td>
                            <td>Zipcode: $presentZipcode</td>

                        </tr>
                        <tr>
                            <td>Permanent/Provincial address: $permanentAddress</td>
                            <td>City: $permanentCity</td>
                            <td>Province: $permanentProvince</td>
                            <td>Zipcode: $permanentZipcode</td>

                        </tr>
                        <tr>
                            <td>Landline: $landline </td>
                            <td>Mobile: $mobile </td>
                            <td>Email address: $email </td>
                        </tr>
                   </table> 

                   <p>Family Informations</p>
                   <table border='1' id='second'>
                        <tr>
                            <td>Father's name: $fatherName</td>
                            <td>Occupation: $fatherOcc</td>
                            <td>Contact Number: $fatherContact</td>

                        </tr>
                        <tr>
                            <td>Present Address: $fatherAddress</td>
                            <td>City: $fatherCity</td>
                            <td>Province: $fatherProvince</td>
                            <td>Zipcode: $fatherZipcode</td>

                        </tr>
                        <tr>
                            <td>Father's name: $motherName</td>
                            <td>Occupation: $motherOcc</td>
                            <td>Contact Number: $motherContact</td>

                        </tr>
                        <tr>
                            <td>Present Address: $motherAddress</td>
                            <td>City: $motherCity</td>
                            <td>Province: $motherProvince</td>
                            <td>Zipcode: $motherZipcode</td>

                        </tr>
                   </table>   
                   <p>Siblings (brothers and sisters)</p>
                   <table border='1' id='third'>
                        $siblings
                   </table>
            ");
        return $pdf->stream();
    }
	
	
}