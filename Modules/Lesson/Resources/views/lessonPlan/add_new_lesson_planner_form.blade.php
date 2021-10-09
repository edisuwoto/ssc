
<script>
    if ($(".niceSelectModal").length) {
        $(".niceSelectModal").niceSelect();
    }
</script>
<style type="text/css">
    .paddingTop86{
        padding-top: 88px;
    }
 
    /* .primary-input:focus~label, .primary-input.read-only-input~label, .has-content.primary-input~label {
    top: -14px;
    font-size: 11px;
    color: rgba(130, 139, 178, 0.8);
    text-transform: capitalize;
    -webkit-transition: all 0.4s ease 0s;
    -moz-transition: all 0.4s ease 0s;
    -o-transition: all 0.4s ease 0s;
    transition: all 0.4s ease 0s; */
}
</style>
<div class="container-fluid">
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-new-lesson-plan',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateLssonPlan()"]) }}
        <div class="row">
            <div class="col-lg-12">  
                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                <input type="hidden" name="day" id="day" value="{{@$day}}">
                <input type="hidden" name="class_time_id" id="class_time_id" value="{{@$class_time_id}}">
                <input type="hidden" name="class_id"   id="class_id" value="{{@$class_id}}">
                <input type="hidden" name="section_id" id="section_id" value="{{@$section_id}}">
                <input type="hidden" name="subject_id" id="subject_id" value="{{@$subject_id}}">
                <input type="hidden" name="lesson_date"  id="lesson_date" value="{{$lesson_date}}">
                <input type="hidden" name="teacher_id" id="update_teacher_id" value="{{isset($teacher_id)? $teacher_id:''}}">
                @if(isset($assigned_id))
                    <input type="hidden" name="assigned_id" id="assigned_id" value="{{@$assigned_id}}">
                @endif               

                <div class="row mt-25">

                    <div class="col-lg-4" >
                       <select class="w-100 bb niceSelect niceSelectModal form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_lesson" id="select_lesson" onchange="changeLesson()" name="lesson">
                        <option data-display="@lang('lang.select') @lang('lang.lesson')*" value="">@lang('lang.select') @lang('lang.lesson') *</option>
                        @foreach($lessons as $lesson)                        
                        <option value="{{ @$lesson->id}}" >{{ @$lesson->lesson_title}}</option>                      
                        @endforeach      
                    </select>
                         <span class="text-danger" role="alert" id="lesson_error"></span>

                    </div>
                    <div class="col-lg-4" id="select_topic_div">

                        <select class="w-100 bb niceSelect niceSelectModal form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_topic" id="select_topic" name="topic">
                            <option data-display="@lang('lang.select') @lang('lang.topic') *" value="">@lang('lang.select') @lang('lang.topic') *</option>
                        </select>
                        <div class="pull-right loader" id="select_topic_loader" style="margin-top: -30px;padding-right: 21px;">
                            <img src="{{asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')}}" alt="" style="width: 28px;height:28px;">
                        </div> 
                               <span class="text-danger" role="alert" id="topic_error"></span>
    
                        </div>
                        <div class="col-lg-4 mt-30-md">
                            <div class="input-effect">
                                <input  class="primary-input read-only-input  form-control {{ $errors->has('sub_topic') ? ' is-invalid' : '' }}" type="text" name="sub_topic">
                                  <label>@lang('lang.sub') @lang('lang.topic')</label>
                                <span class="focus-border"></span>
                                @if ($errors->has('sub_topic'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sub_topic') }}</strong>
                                    </span>
                            @endif
                         </div>                        
                        </div>
                </div>

                <div class="row mt-25">
                    <div class="col-lg-6 mt-30-md">                       
                       
                          <textarea name="youtube_link" id="" cols="50" rows="6" class="primary-input form-control"></textarea>
                        
                         <label id="teacher_label" class="top20">@lang('lang.lecture') @lang('lang.youtube') @lang('lang.url')  ( @lang('lang.multiple')  @lang('lang.url') @lang('lang.separate') @lang('lang.by') @lang('lang.coma')(,))</label>
                      
                                             
                    </div>

                     <div class="col-lg-6">
                        <div class="row no-gutters input-right-icon paddingTop86">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input" id="placeholderInput" type="text"
                                           placeholder="File Name"
                                           readonly>
                                    <span class="focus-border"></span>
    
                                    @if ($errors->has('file'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ @$errors->first('file') }}</strong>
                                        </span>
                                @endif
                                
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="primary-btn-small-input" type="button">
                                    <label class="primary-btn small fix-gr-bg"
                                           for="browseFile">@lang('lang.browse')</label>
                                    <input type="file" class="d-none" id="browseFile" name="photo">
                                </button>
                            </div>
                         </div>
                    </div>                     
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-6 mt-30-md">
                        <div class="input-effect">
                        <label id="teacher_label">@lang('lang.teaching') @lang('lang.method')</label>
                         <textarea name="teaching_method" class="primary-input form-control" id="" cols="50"  rows="2"></textarea>
                     </div>                        
                    </div>
                    <div class="col-lg-6 mt-30-md">
                        <div class="input-effect">
                        <label id="teacher_label">@lang('lang.general') @lang('lang.objectives')</label>
                        <textarea name="general_Objectives" id="" cols="50" rows="2" class="primary-input form-control"></textarea>
                     </div>                        
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-6 mt-30-md">
                        <div class="input-effect">
                        <label id="teacher_label">@lang('lang.previous') @lang('lang.knowledge')</label>
                         <textarea name="previous_knowledge" id="" cols="50" rows="2" class="primary-input form-control"></textarea>
                     </div>                        
                    </div>
                    <div class="col-lg-6 mt-30-md">
                        <div class="input-effect">
                        <label id="teacher_label">@lang('lang.comprehensive') @lang('lang.questions')</label>
                        <textarea name="comprehensive_Questions" id="" cols="50" rows="2" class="primary-input form-control"></textarea>
                     </div>                        
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <div class="input-effect">
                        <label id="teacher_label">@lang('lang.note')</label>
                         <textarea name="note" id="" cols="50" rows="2" class="primary-input form-control"></textarea>
                     </div>                        
                    </div>
                    
                </div>

             


            </div>
            
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.save') @lang('lang.information')</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>



<script type="text/javascript">
    var fileInput = document.getElementById("browseFile");
    if (fileInput) {
        fileInput.addEventListener("change", showFileName);
        function showFileName(event) {
            var fileInput = event.srcElement;
            var fileName = fileInput.files[0].name;
            document.getElementById("placeholderInput").placeholder = fileName;
        }
    }
    var fileInp = document.getElementById("browseFil");
    if (fileInp) {
        fileInp.addEventListener("change", showFileName);
        function showFileName(event) {
            var fileInp = event.srcElement;
            var fileName = fileInp.files[0].name;
            document.getElementById("placeholderIn").placeholder = fileName;
        }
    }
</script>
