
<div class="container-fluid">
    <style type="text/css">
        .school-table-style tr td {
            border-bottom: 1px solid rgba(130, 139, 178, 0.3);
            border-top: 0 !important;
            padding: 10px 10px 0px 0px;
        }
    </style>

<table  id="headerTableModal" class="display school-table-style shadow-none pt-0" cellspacing="0" width="100%">
    <tbody>

    <tr>
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.class')</span><strong>:</strong></th>
        <td>{{$lessonPlanDetail->class->class_name}}({{$lessonPlanDetail->sectionName->section_name}})</td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.subject')</span><strong>:</strong></th>
        <td>{{$lessonPlanDetail->subject->subject_name}} ({{$lessonPlanDetail->subject->subject_code}}) -{{$lessonPlanDetail->subject->subject_type == 'T'? 'Theory':'Practical'}}</td>
    </tr>	
    <tr>
       
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.date')</span><strong>:</strong></th>
        <td>{{date('d-M-y',strtotime($lesson_date))}} </td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.lesson')</span><strong>:</strong></th>
    <td> {{$lessonPlanDetail->lessonName->lesson_title}}</td>
    </tr>
    <tr>
     
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.topic')</span><strong>:</strong></th>

        <td> {{$lessonPlanDetail->topicName->topic_title}}

        </td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.sub') @lang('lang.topic')</span><strong>:</strong></th>

        <td> {{$lessonPlanDetail->sub_topic}}

        </td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.lecture') @lang('lang.youtube')  @lang('lang.link')</span><strong>:</strong></th>

    <td> 
         @if($lessonPlanDetail->lecture_youube_link !='')
        @php $link = explode(',', $lessonPlanDetail->lecture_youube_link);
            $i=1;
        @endphp
        @foreach($link as $item)
        <a target="_blank" href="{{$item}}">{{$i++}}) {{$item}}</a> <br>
        @endforeach
        @endif
         </td>
    </tr>
    <tr>
       
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.document')</span><strong>:</strong></th>

        <td> 
            @if($lessonPlanDetail->attachment !='')
         
            <a href="{{ asset($lessonPlanDetail->attachment) }}" download="" >
                <i class="fa fa-download mr-1">
                    </i> @lang('lang.download')
                </a>

            @endif
        </td>
      

    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.general') @lang('lang.objectives')</span><strong>:</strong></th>

        <td colspan="2"> {{$lessonPlanDetail->general_objectives}}</td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.teaching') @lang('lang.method')<</span><strong>:</strong></th>

        <td colspan="2"> {{$lessonPlanDetail->teaching_method}}</td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.previous') @lang('lang.knowledge')</span><strong>:</strong></th>

        <td colspan="2"> {{$lessonPlanDetail->previous_knowlege}}</td>
    </tr>
    <tr>
        
        <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.comprehensive') @lang('lang.questions')</span><strong>:</strong></th>

        <td colspan="2"> {{$lessonPlanDetail->comp_question}}</td>
    </tr>
    <tr>
        
         <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.note')</span><strong>:</strong></th>
        <td colspan="2"> {{$lessonPlanDetail->note}}</td>
    </tr>
	<tr>
     
     <th class="d-flex justify-content-between align-items-center"><span>@lang('lang.status')</span><strong>:</strong></th>
     <td colspan="2">
        <label class="switch">
                                    
                                    @if(Auth::user()->role_id==4 || Auth::user()->role_id==1 || Auth::user()->role_id==5)
                                <input type="checkbox" data-complete_date="{{Carbon::now()->format('Y-m-d')}}"  data-id="{{$lessonPlanDetail->id}}" {{@$lessonPlanDetail->completed_status == 'completed'? 'checked':''}}
                                        class="weekend_switch_btn">
                                    <span class="slider round"></span>
                                   @else
                                   <input type="checkbox" disabled="" {{@$lessonPlanDetail->completed_status == 'completed'? 'checked':''}}
                                        class="weekend_switch_btn">
                                    <span class="slider round"></span>
                                   @endif
                                </label> 
                               
     </td>   
    </tr>
    
</tbody>
</table>
 <script>
    $(document).ready(function() {
            $(".weekend_switch_btn").on("change", function() {
                var lessonplan_id = $(this).data("id");
               
               
                if ($(this).is(":checked")) {
                    var status = "completed";
                    var complete_date=$(this).data("complete_date");
                  
                } else {
                    var status = null;
                    var complete_date=null;
                     
                }
                
                // alert(complete_date);
                var url = $("#url").val();
                

                $.ajax({
                    type: "POST",
                    data: {'status': status, 'lessonplan_id': lessonplan_id,'complete_date':complete_date},
                    dataType: "json",
                    url: url + "/" + "lesson/lessonPlan-status-ajax",
                    success: function(data) {
                          // location.reload();
                        setTimeout(function() {
                            toastr.success(
                                "Operation Success!",
                                "Success ", {
                                    iconClass: "customer-info",
                                }, {
                                    timeOut: 2000,
                                }
                            );
                        }, 500);
                       
                    },
                    error: function(data) {
                       
                        setTimeout(function() {
                            toastr.error("Operation Not Done!", "Error Alert", {
                                timeOut: 5000,
                            });
                        }, 500);
                    },
                });
            });
        });
</script>


