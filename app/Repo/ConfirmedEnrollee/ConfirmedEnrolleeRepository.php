<?php 

namespace App\Repo\ConfirmedEnrollee;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\ConfirmEnrolled;
use App\Model\Sibling;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use Carbon\Carbon;
use App\Model\Enrollee;

class ConfirmedEnrolleeRepository extends BaseRepository implements ConfirmedEnrolleeInterface{

	public function __construct(){

		$this->modelName = new ConfirmEnrolled();
	}

    public function index(){
        return response()->json([
            'enrollees' => $this->modelName->pagination()
            ]);
    }

    public function newEnrollee(){

        $request  = app()->make('request');
        $this->update($request, $request['confirmedEnrolled']['id']);
        
        $confirmedEnrolled = $this->modelName->create([
                'end_time' => $request['confirmedEnrolled']['end_time'],
                'start_time' => $request['confirmedEnrolled']['start_time'],
                'schedule_id' => $request['confirmedEnrolled']['schedule_id'],
                'enrollee_id' => $request['confirmedEnrolled']['enrollee_id'],
                'school_year_id' => $request['confirmedEnrolled']['school_year_id'],
                'semester_id' => $request['confirmedEnrolled']['semester_id'],
                'year_level_id' => $request['confirmedEnrolled']['year_level_id']

            ]);
        return response()->json([ $request['confirmedEnrolled']['end_time']]);
    }

    public function destroy($id){
        $this->modelName->find($id)->delete();
        return $this->index();
    }
    public function search(){

        $request = app()->make('request');
        $confirmedEnroll = $this->modelName->whereHas('enrollee', function($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->orWhere('firstname', 'LIKE', '%'. $request->search . '%');
                $query->orWhere('lastname', 'LIKE', '%'. $request->search . '%');

            });

        })->pagination();

        return response()->json([
            'enrollees' => $confirmedEnroll
            ]);

    }

    public function jhs(){

        return response()->json([
            'enrollees' => $this->modelName->where('course_id', 2)->relTable()->pagination()
            ]);
    }

    public function searchJhs(){
        $request = app()->make('request');

         return response()->json([
            'enrollees' => $this->modelName
                ->where('course_id', '=', 2)
                ->whereHas('enrollee', function($query) use ($request){
                    $query->where(function($query) use ($request) {
                        $query->orWhere('firstname', 'LIKE', '%'. $request->search . '%');
                        $query->orWhere('lastname', 'LIKE', '%'. $request->search . '%');

                    });

            })->pagination()
            ]);

    }

    public function shs(){
        return response()->json([
            'enrollees' => $this->modelName->where('course_id', 1)->relTable()->pagination()
            ]);
    }

    public function searchShs(){

        $request = app()->make('request');

        return response()->json([
            'enrollees' => $this->modelName
                ->where('course_id', '=', 1)
                ->whereHas('enrollee', function($query) use ($request){
                    $query->where(function($query) use ($request) {
                        $query->orWhere('firstname', 'LIKE', '%'. $request->search . '%');
                        $query->orWhere('lastname', 'LIKE', '%'. $request->search . '%');

                    });

            })->pagination()
            ]);

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
        $confirmedEnroll->course_id = $request->confirmedEnrolled['course_id'];
        $confirmedEnroll->student_type_id = $request->confirmedEnrolled['student_type_id'];
        $confirmedEnroll->update();

        $confirmedEnroll->enrollee->remarks = $request->confirmedEnrolled['enrollee']['remarks'];
        
        $confirmedEnroll->enrollee->lrn = $request->confirmedEnrolled['enrollee']['lrn'];
        $confirmedEnroll->enrollee->idno = $request->confirmedEnrolled['enrollee']['idno'];
       
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
        $confirmedEnroll->enrollee->civil_id = $request->confirmedEnrolled['enrollee']['civil_id'];
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
        $confirmedEnroll = $this->modelName->where('id', $id)->relTable()->first();
        $studentType = $confirmedEnroll->studentType->name;
        $idno = $confirmedEnroll->enrollee->idno;
        $lrn = $confirmedEnroll->enrollee->lrn;
        $date = $confirmedEnroll->enrollee->created_at;
        $now = Carbon::now()->toDayDateTimeString();
        $yearLevel = $confirmedEnroll->yearLevel->name;
        $semester = $confirmedEnroll->semester->name;
        $course = $confirmedEnroll->course->name;
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

        $schoolName = $confirmedEnroll->enrollee->name_of_school;
        $schoolCity = $confirmedEnroll->enrollee->schoolCity->name;
        $schoolProvince = $confirmedEnroll->enrollee->schoolProvince->name;
        $schoolAddress = $confirmedEnroll->enrollee->school_address;
        $schoolZipcode = $confirmedEnroll->enrollee->school_zipcode;

        $siblings = '';
        foreach ($confirmedEnroll->enrollee->siblings as $sibling) {

            $siblings .= '<tr>
            <td><strong>NAME: </strong><u>' . $sibling->name . '</u></td>
            <td><strong>AGE: </strong><u>' . $sibling->age . '</u></td> 
            <td><strong>OCCUPATION: </strong> ' . $sibling->occupation . '</u></td>
            <td><strong>SCHOOL NAME: </strong><u>' . $sibling->school_name . '</u></td> 
        </tr>';
    }

    $requirements = '';

    foreach ($confirmedEnroll->enrollee->requirementsDoc as $req){

        $requirements .= '<span margin-left: 10px; ">' . $req->name . ', </span>';
    }

    if(is_null($lrn)){
        $lrn = 0;
    }

    $qrCode = new QrCode();
    $qrCode
    ->setText($lrn)
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
    $pdf->setPaper('legal', 'portrait');
    $pdf->loadHTML("
        <style>
            body{
                font-size: 11px;
                font-family: Arial, Helvetica, sans-serif;
            }

            table {
                border: 1px solid black;
                padding: 5px;
                width: 100%
            }
                        #first tr, #first td, #second tr, #second td, #third tr, #third td, #fourth tr, #fourth td, span{
            padding: 4px; 
            font-size: 11px;
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
        <h4 align='center' style='padding:0; margin:0; font-size: 14px;'>Intellisense Institute of Technology</h4>
        <p align='center' style='padding:0; margin:0; font-size:10px;'>
            2F Aspac Building, Guizo
        </p>
        <p align='center' style='padding:0; margin:0; font-size:10px;'>
            Mandaue City, Cebu
            (032) 4172412
        </p>
        <br />
        <br />
        <table id='first'>
            <tr>
                <td><strong>ADMISSION TYPE:</strong> $studentType</td>
                <td><strong>STUDENT ID NO:</strong> $idno </td>
                <td><strong>DATE: </strong> $date</td>
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
                <td><strong>NAME: </strong> <u>$name</u></td>
                <td><strong>NICKNAME: </strong> <u>$nickname</u></td>
                <td><strong>SEX: </strong> <u>$sex</u> </td>
                <td><strong>AGE </strong>: <u>$age </u></td>


            </tr>
            <tr>
             <td><strong>BIRTHDAY: </strong> <u>$birthday</u> </td>
             <td><strong>BIRTHPLACE</strong>: $birthPlace </td>
             <td><strong>CIVIL STATUS </strong>: $civil</td>
         </tr>
         <tr>
            <td><strong>PRESENT ADDRESS</strong>: <u>$presentAddress</u></td>
            <td><strong>CITY</strong>: <u>$presentCity</u></td>
            <td><strong>PROVINCE</strong>: <u>$presentProvince</u></td>
            <td><strong>ZIPCODE</strong>: <u>$presentZipcode</u></td>

        </tr>
        <tr>
            <td><strong>PERMANENT/PROVINCIAL ADDRESS</strong>: <u>$permanentAddress</u></td>
            <td><strong>CITY</strong>: <u>$permanentCity </u></td>
            <td><strong>PROVINCE</strong>: <u>$permanentProvince </u></td>
            <td><strong>ZIPCODE</strong>: <u>$permanentZipcode </u></td>

        </tr>
        <tr>
            <td><strong>LANDLINE</strong>: <u> $landline </u></td>
            <td><strong>MOBILE</strong>: <u>$mobile </u></td>
            <td><strong>EMAIL ADDRESS</strong>: <u>$email </u> </td>
        </tr>
    </table> 

    <p><strong>FAMILY INFORMATIONS</strong></p>
    <table id='second'>
        <tr>
            <td><strong>FATHER'S NAME</strong>: <u> $fatherName </u></td>
            <td><strong>OCCUPATION</strong>: <u>$fatherOcc </u></td>
            <td><strong>CONTACT NUMBER</strong>: <u>$fatherContact</u></td>

        </tr>
        <tr>
            <td><strong>PRESENT ADDRESS</strong>: <u>$fatherAddress</u></td>
            <td><strong>CITY </strong>: <u>$fatherCity</u></td>
            <td><strong>PROVINCE</strong>: <u>$fatherProvince</u></td>
            <td><strong>ZIPCODE</strong>: <u>$fatherZipcode</u></td>

        </tr>
        <tr>
            <td><strong>MOTHER'S NAME</strong>: <u>$motherName</u></td>
            <td><strong>OCCUPATION</strong>: <u> $motherOcc </u></td>
            <td><strong>CONTACT NUMBER:</strong><u> $motherContact </u></td>

        </tr>
        <tr>
            <td><strong>PRESENT ADDRESS</strong>: <u>$motherAddress </u></td>
            <td><strong>CITY </strong>: <u>$motherCity </u></td>
            <td><strong>PROVINCE</strong>: <u> $motherProvince </u></td>
            <td><strong>ZIPCODE</strong>: <u>$motherZipcode </u></td>

        </tr>
    </table>   
    <p><strong>SIBLINGS (Brothers and Sisters)</strong></p>
    <table id='third'>
        $siblings
    </table>
    <p><strong>SCHOOL BACKGROUND</strong></p>
    <table id='fourth'>

        <tr>
            <td><strong>SCHOOL LAST ATTENDED</strong>: <u>$schoolName</u></td>

            <td><strong>PRESENT ADDRESS</strong>: <u>$schoolAddress </u></td>
            <td><strong>CITY </strong>: <u>$schoolCity </u></td>
            <td><strong>PROVINCE</strong>: <u> $schoolProvince </u></td>
            <td><strong>ZIPCODE</strong>: <u>$schoolZipcode </u></td>

        </tr>

    </table>
    <p><strong>REQUIREMENTS SUBMITTED: </strong> </p>
    <div  style='width: 709px; border: 1px solid black; word-wrap:break-word; padding: 7px;'>
        $requirements
    </div>
    <p><span><strong> FOR LACKING REQUIREMENTS: </strong> </span> <p>

        <div style='display: inline-block;' ><input type='checkbox' style='display: inline' checked> <span> I understand that I'm temporarily enrolled at Intellisense Institute of Technology and I am aware that I will only be offically 
            enrolled once the following school requirements have been completed and submitted.<span></div>
            <br /> 
            <div style='display: inline-block;' ><input type='checkbox' style='display: inline' checked><span>  I understand that all fees are NON-REFUNDABLE UPON ENROLLMENT. I have read/understand this policy and I certify all entries are true and correct.</span></div>
            <br /> <br /> 

            <br /> <br />
            <div style='width: 200px; display: inline-block;'>
               <u>&nbsp;  &nbsp; $name &nbsp; &nbsp; &nbsp; &nbsp;  </u><br />
               &nbsp; &nbsp; &nbsp;STUDENT <br />
               (Printed Name over signatute)
               <br />
               <br />

               __________________________<br />
               PARENTS/GUARDIANS <br /> (Printed Name over signatute)
           </div>

           <div style='width: 200px;  display: inline-block; '>

            <u>$now</u>  <br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DATE
            <br />
            <br />
            <br />
            <u>__________________________</u>  <br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DATE  
        </div>

        <div style='width: 310px;  display: inline-block; '>
            <strong>VERIFY BY: </strong> <br /> <br />
            ____________________________   &nbsp;  &nbsp; ___________________
            <br />
            REGRISTRAR'S SIGNATURE &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DATE 
        </div>

        ");
return $pdf->stream();
}

    public function shsPrint($id){


        $confirmedEnroll = $this->modelName->where('id', $id)->relTable()->first();

        $lrn = $confirmedEnroll->enrollee->lrn;
        $primary = $confirmedEnroll->enrollee->primary;
        $elementary = $confirmedEnroll->enrollee->elementary;
        $schoolName = $confirmedEnroll->enrollee->name_of_school;
        $schoolCity = $confirmedEnroll->enrollee->schoolCity->name;
        $schoolProvince = $confirmedEnroll->enrollee->schoolProvince->name;
        $schoolAddress = $confirmedEnroll->enrollee->school_address;
        $schoolZipcode = $confirmedEnroll->enrollee->school_zipcode;

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

        $motherName = $confirmedEnroll->enrollee->mother_lastname . ', ' . $confirmedEnroll->enrollee->mother_firstname . ' ' . $confirmedEnroll->enrollee->mother_middlename;
        $motherContact = $confirmedEnroll->enrollee->mother_contact_number;
        $motherOcc = $confirmedEnroll->enrollee->mother_occupation;
        $motherAddress = $confirmedEnroll->enrollee->mother_address;
        $motherCity = $confirmedEnroll->enrollee->motherCity->name;
        $motherProvince = $confirmedEnroll->enrollee->motherProvince->name;
        $motherZipcode = $confirmedEnroll->enrollee->mother_zipcode;

        if (is_null($lrn)) {
            $lrn = 0;
        }
         $qrCode = new QrCode();
            $qrCode
            ->setText($lrn)
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
        $pdf->setPaper('legal', 'portrait');
        $pdf->loadHTML("<style>
            body{
                font-size: 11px;
                font-family: Arial, Helvetica, sans-serif;
            }

            table {
                border: 1px solid black;
                padding: 5px;
                width: 100%
            }
                        #first tr, #first td, #second tr, #second td, #third tr, #third td, #fourth tr, #fourth td, span{
            padding: 4px; 
            font-size: 11px;
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
            <h4 align='center' style='padding:0; margin:0; font-size: 14px;'>Intellisense Institute of Technology</h4>
            <p align='center' style='padding:0; margin:0; font-size:10px;'>
                2F Aspac Building, Guizo
            </p>
            <p align='center' style='padding:0; margin:0; font-size:10px;'>
                Mandaue City, Cebu
                (032) 4172412
            </p>
            <br />
            <br />

                 <p><strong> PERSONAL INFORMATIONS</strong> </p>
                <table id='second'>
                    <tr>
                        <td><strong>NAME: </strong> <u>$name</u></td>
                        <td><strong>NICKNAME: </strong> <u>$nickname</u></td>
                        <td><strong>SEX: </strong> <u>$sex</u> </td>
                        <td><strong>AGE </strong>: <u>$age </u></td>


                    </tr>
                    <tr>
                     <td><strong>BIRTHDAY: </strong> <u>$birthday</u> </td>
                     <td><strong>BIRTHPLACE</strong>: $birthPlace </td>
                     <td><strong>CIVIL STATUS </strong>: $civil</td>
                 </tr>
                 <tr>
                    <td><strong>PRESENT ADDRESS</strong>: <u>$presentAddress</u></td>
                    <td><strong>CITY</strong>: <u>$presentCity</u></td>
                    <td><strong>PROVINCE</strong>: <u>$presentProvince</u></td>
                    <td><strong>ZIPCODE</strong>: <u>$presentZipcode</u></td>

                </tr>
                <tr>
                    <td><strong>PERMANENT/PROVINCIAL ADDRESS</strong>: <u>$permanentAddress</u></td>
                    <td><strong>CITY</strong>: <u>$permanentCity </u></td>
                    <td><strong>PROVINCE</strong>: <u>$permanentProvince </u></td>
                    <td><strong>ZIPCODE</strong>: <u>$permanentZipcode </u></td>

                </tr>
                <tr>
                    <td><strong>LANDLINE</strong>: <u> $landline </u></td>
                    <td><strong>MOBILE</strong>: <u>$mobile </u></td>
                    <td><strong>EMAIL ADDRESS</strong>: <u>$email </u> </td>
                </tr>

                 <tr>
                    <td><strong>MOTHER'S NAME</strong>: <u>$motherName</u></td>
                    <td><strong>OCCUPATION</strong>: <u> $motherOcc </u></td>
                    <td><strong>CONTACT NUMBER:</strong><u> $motherContact </u></td>

                </tr>
                <tr>
                    <td><strong>PRESENT ADDRESS</strong>: <u>$motherAddress </u></td>
                    <td><strong>CITY </strong>: <u>$motherCity </u></td>
                    <td><strong>PROVINCE</strong>: <u> $motherProvince </u></td>
                    <td><strong>ZIPCODE</strong>: <u>$motherZipcode </u></td>

                </tr>
            </table> 

             <p><strong> SCHOOL BACKGROUND</strong> </p>
            <table id='fourth'>
                <tr>
                    <td><strong>PRIMARY</strong>: <u>$primary</u></td>
                    <td><strong>ELEMENTARY</strong>: <u>$elementary</u></td>
                    <td><strong>JUNIOR HIGHSCHOOL</strong>: <u>$schoolName</u></td>
                </tr>
                <tr>
                    <td><strong>PRESENT ADDRESS</strong>: <u>$schoolAddress </u></td>
                    <td><strong>CITY </strong>: <u>$schoolCity </u></td>
                    <td><strong>PROVINCE</strong>: <u> $schoolProvince </u></td>
                    <td><strong>ZIPCODE</strong>: <u>$schoolZipcode </u></td>

                </tr>

            </table>

            "
        );
        return $pdf->stream();

    }
}