@extends('layouts.master')

@section('style')
<style type="text/css">
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for <2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>

@endsection

@section('content')
<br />
 <section  id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Enroll Now</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                {{ Form::open([
                    'url' => route('admission.store'),
                    'method' => 'post', 
                    'name' => 'sentMessage',
                    'id' => 'contactForm'

                ]) }}
                <div class="col-lg-6">
                         <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" placeholder="Lastname" id="lastname" required data-validation-required-message="Please enter your lastname address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" placeholder="Firstname" name="firstname" required data-validation-required-message="Please enter your firstname address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="middlename">Middlename</label>
                                <input type="text" class="form-control" placeholder="Middlename" name="middlename" required data-validation-required-message="Please enter your middlename address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="admission_id">Admission Type</label>
                                <select class="form-control input-lg" >
                                    <option value="">Select Admission Type</option>
                                    <option v-for="admission in admissions"> @{{ admission.name }} </option>
                                </select>
                            </div>
                        </div>

                       
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="admission_id">School Year</label>
                                <select class="form-control input-lg" name="admission_id">
                                    <option value="">Select School Year</option>
                                    <option v-for="sy in schoolyears" :value="sy.id">@{{ sy.name }}</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="name">Course</label>
                                <select class="form-control input-lg" name="course_id">
                                	<option value="">Select Course</option>
                                     <option v-for="course in courses" :value="course.id">@{{ course.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="semester">Semester</label>
                                <select class="form-control input-lg" name="semester">
                                    <option value="">Select Semester</option>
                                     <option v-for="semester in semesters" :value="semester.id">@{{ semester.name }}</option>
                                </select>
                            </div>
                        </div>

                         <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="name">Schedule</label>
                                <select class="form-control input-lg" name="course_id">
                                    <option value="">Select Schedule</option>
                                    <option v-for="schedule in schedules">@{{ schedule.days + ' ' +schedule.start_time + '-' + schedule.end_time}}</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        
                </div><!-- col-lg-6 -->
               <div class="col-lg-6">
                    <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" placeholder="Birthday" name="birthday" required data-validation-required-message="Please enter your birthday.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                             <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="birthdayplace">Birth Place</label>
                                <input type="text" class="form-control" placeholder="Birth Place" name="birthplace" required data-validation-required-message="Please enter your birthplace.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="name">Gender</label>
                                <select class="form-control input-lg" name="course_id" required>
                                    <option value="">Select Gender</option>
                                    <option v-for="gender in genders" :value="gender.id">@{{ gender.name}}</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="name">Civil Status</label>
                                <select class="form-control input-lg" name="course_id" required v-model="csid" :change="checkSingle()">
                                    <option value="">Select Civil Status</option>
                                    <option v-for="cs in civilstatus" :value="cs.id">@{{cs.name}}</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                         
                        <transition name="slide-fade">
                            <div v-if="show">
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" class="form-control" placeholder="Spouse/Husband Lastname" id="lastname" required data-validation-required-message="Please enter your lastname address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" class="form-control" placeholder="Spouse/Husband Firstname" name="firstname" required data-validation-required-message="Please enter your firstname address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label for="middlename">Middlename</label>
                                        <input type="text" class="form-control" placeholder="Spouse/Husband Middlename" name="middlename" required data-validation-required-message="Please enter your middlename address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                        </transition>

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="emergency">In case of emergency notify </label>
                                <input type="text" class="form-control" placeholder="In case of emergency notify (Enter Name) " name="middlename" required data-validation-required-message="Please enter emergency Name & Contact Number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="emergency">In case of emergency notify </label>
                                <input type="text" class="form-control" placeholder="In case of emergency notify (Enter Name) " name="middlename" required data-validation-required-message="Please enter emergency Name & Contact Number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <input type="submit" class="btn btn-success btn-lg" value="Send">
                            </div>
                        </div>
                </div><!-- col-lg-6 -->

                    </form>

            </div><!-- end row -->
        </div>
    </section>



@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('frameworks/js/vue.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frameworks/js/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frameworks/js/lodash.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vue-script.js')}}"></script>
@endsection