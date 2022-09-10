                <div class="modules">
                    <table>
                        @foreach($courseCollection as $course)
                                <tr> 
                                    <button type="button" class="collapsible" ><b>{{$course->course_title}}</b>
                                        <a  title="View Course" data-bs-toggle="modal" data-bs-target="#topicCreate" data-bs-whatever="@fat" style="display: flex; margin-left: 250px; right: 0;"><img src="{{ asset('images/add.png') }}" alt=""></a>                                           
                                    </button>      
                                </tr>
                                <tr>
                                    <div class="content">
                                        @foreach($course->coursecontent as $module)
                                            <div class="module">
                                                <label for="">
                                                    {{$module->content_title}}
                                                </label>
                                                <div class="icon" style="display: flex; margin-left: 200px; right: 0;">
                                                    <a  title="Add Topic Content" data-bs-toggle="modal" data-bs-target="#topicChoices" data-bs-whatever="@fat"><img src="{{ asset('images/add.png') }}" alt=""></a>                                                                                    
                                                    <a  title="Delete Topic Content" data-bs-toggle="modal" data-bs-target="#topicChoices" data-bs-whatever="@fat"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </tr>
                        @endforeach
                    </table>
                </div>