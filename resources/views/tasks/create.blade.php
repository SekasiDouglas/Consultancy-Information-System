@extends('layouts.app')

@push("head")
<script>
  window.APP_USERS={!! $users->toJson() !!}
</script>
@endpush
@section('content')
	 	<div class="card">
         <div class="card-body">
            <div class="card-title row">
                <div class="text col-md-4">
                    Create a Task
                </div>
              
              <div class=" col-md-8">
                  <a href="{{ route('documents.create') }}" style="float:right" class="btn btn-outline-danger btn-sm pull-right"><i class="fa fa-fw fa-reply-all"></i>View All Tasks</a>
                </div>
               </div>
            <form action="{{route('tasks.store')}}" method="post">
            	@csrf
                    <div class="form-row ">
                      <div class="form-group col-md-6">
                        <label for="inputTask">Task Name</label>
                        <input type="text" name="task_name" class="form-control {{ $errors->has('task_name') ? ' is-invalid' : '' }} form-control-sm" placeholder="Enter task name">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputState">Status</label>
                        <select  class="form-control {{ $errors->has('task_status') ? 'is-invalid' : '' }} form-control-sm" name="task_status">
                          <option value="">Choose...</option>
                          @foreach(['Not started', 'In Progress', 'Completed', 'Pending input', 'Deffered'] as $item => $value)
                          <option value="{{$value}}">{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-row ">
                            <div class="form-group col-md-6">
                                    <label for="inputState">Priority</label>
                                    <select id="inputState" name="priority" class="form-control {{ $errors->has('priority') ? ' is-invalid' : '' }}">
                                      <option value="">Choose...</option>
                                      <option value="High">High</option>
                                      <option value="Medium">Medium</option>
                                      <option value="Low">Low</option>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-6">
                                        <label for="inputState">Service Line</label>
                                <select id="inputState" name="service_line" class="form-control {{ $errors->has('service_line') ? ' is-invalid' : '' }} form-control-sm">
                                   <option value="">Choose...</option>
		                          @foreach(App\Task::serviceLines() as $item => $value)
                                  <option value="{{ $value }}}">{{$value}}</option>
		                          @endforeach
		                      </select>
                             </div>
                         </div>   
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="inputCity">Start Date</label>
                        <input type="date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }} form-control-sm" name="start_date" id="inputCity">
                        
                      </div>
                      <div class="form-group col-md-3">
                            <label for="inputZip">End Date</label>
                            <input type="date" name="end_date" class="form-control {{ $errors->has('end_time') ? ' is-invalid' : '' }} form-control-sm" id="inputZip">
                      </div>
                      <div class="form-group col-md-6">
                            <label for="inputTeam">Team </label>
                            <select id="inputTeam" class="form-control {{ $errors->has('team') ? ' is-invalid' : '' }} form-control-sm" name="team">
                                <option value="">Choose...</option>
                                @foreach(App\Team::names() as  $team)
                                <option value="{{$team}}">{{$team}}</option>
                                @endforeach
                              </select>     
                      </div>
                    </div>

                    <div class="form-row">
                            <div class="form-group col-md-3">
                              <label for="inputCity">Start Time</label>
                              <input type="time" name="start_time" class="form-control {{ $errors->has('start_time') ? ' is-invalid' : '' }} form-control-sm" id="inputCity">  
                            </div>
                            <div class="form-group col-md-3">
                                  <label for="inputZip">End Time</label>
                                  <input type="time" name="end_time" class="form-control {{ $errors->has('end_time') ? ' is-invalid' : '' }} form-control-sm" id="inputZip">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputState">Related To:</label>
                                    <select id="inputState" name="related_to" class="form-control {{ $errors->has('related_to') ? ' is-invalid' : '' }} form-control-sm">
                                      <option value="">Choose...</option>
                                      @foreach(['Bug', 'Case', 'Client', 'Contact', 'Lead', 'Opportunity','Project', 'project task', 'Target', 'Task'] as $value => $item)
                                      <option value="{{$item}}">{{$item}}</option>
                                      @endforeach
                                    </select>
                                  </div>  
                          </div>

                    <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control form-control-sm" name="description" rows="2" id="description" placeholder="Enter description of the project"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="assignees">Assigned To: </label>
                        <select  name="assigned_to" class="form-control {{ $errors->has('assigned_to') ? ' is-invalid' : '' }} form-control-sm" id="assignees"></select>
                    </div>
                    <div class="pull-left">
                    <button type="submit" class="btn btn-outline-danger btn-lg">Save a task</button>
                    </div>
                  </form>
              </div>
        
      </div>
      	
@endSection

@push("scripts")
<script>
var team = document.getElementById("inputTeam");
var assignees = document.getElementById("assignees");
var options = document.createDocumentFragment();
//add an empty option
options.appendChild(createOption("--select--", ""));

team.addEventListener("change", updateAssignees);

function updateAssignees(event) {
  //bail out for empty selections
  if (!team.value) return;
  console.log(team.value)
  window.APP_USERS.forEach(function(user) {
    if (user.team === team.value) {
      //add an option to the assigns
      options.appendChild(createOption(user.name, user.name));
    }
  });
  assignees.appendChild(options);
}
function createOption(text, value) {
  var option = document.createElement("option");
  option.text = text;
  option.value = value;
  return option;
}
</script>

@endpush
