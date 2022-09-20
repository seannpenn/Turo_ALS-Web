@extends('main')
@extends('admin/announcement_modal')

@section('css-style')
.addButton{
    margin: 50;

}
#announcementBox{
    border-radius: 20px;
    margin-left: 50px;
    margin-bottom: 30px;
}
h1{
    margin: 50px;
}
#ATitle{
    font-size: 25px;
}
@stop


@section('main-content')

<div class="addButton">
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#announcementCreate" data-bs-whatever="@fat" style="width: 300px; height: 50px; font-size: 15px">Add Announcement</button>  
</div>
<h1>Announcements</h1>

@foreach($announcementCollection as $data)
<div class="row g-4">
    <div class="col-3">
        <div class="p-3 border bg-light" id="announcementBox" style="">
            <p id="ATitle">{{ $data->announcement_title }}</p>
            {{ $data->date }}
            <br><br><br>
            {{ $data->announcement_description }}
        </div>
    </div>
</div>

@endforeach
@stop


