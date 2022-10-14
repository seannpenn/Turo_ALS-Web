@extends('main')
@extends('admin/announcement_modal')
@extends('admin/update_announcement_modal')
@extends('modalslug')

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

img{
    width: 30px;
    height: 30px;
}
.action{
    position: absolute;
    bottom: 0px;
    right: 20px;
}
.action-delete{
    position: absolute;
    bottom: 0px;
    right: 50px;
}
button{
    width: 50px;
    height: 50px;
}
@stop


@section('main-content')
<div class="addButton">
    <button type="button" id="announcementCreateId" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#announcementCreate" data-bs-whatever="@fat" style="width: 300px; height: 50px; font-size: 15px">Add Announcement</button>  
</div>

<h1>Announcements</h1>

@foreach($announcementCollection as $data)
<div class="row g-4">
    <div class="col-3">
        <div class="p-3 border bg-light" id="announcementBox" >
            <p id="ATitle">{{ $data->announcement_title }}</p>
            {{ $data->date }}
            <br><br><br>
            {{ $data->announcement_description }}

            <div>
                <td class="icons">
                    <button type="button" value="{{ $data->announcement_id }}, {{ $data->announcement_title }}, {{$data->announcement_description }}" title="Update Announcement" id="updateAnnouncement" style="border: none; background-color: transparent;" 
                        onclick="getData({announcement_id: '{{ $data->announcement_id }}', announcement_title: '{{ $data->announcement_title }}', announcement_description: '{{ $data->announcement_description }}' })">
                        <img id="action" src="{{ asset('images/edit.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#announcementUpdateModal">
                    </button>
                    <a href="{{ route('announcement.delete', $data->announcement_id) }}" title="Delete Announcement">
                        <img src="{{ asset('images/delete.png') }}" onclick="return confirm('Are you sure you want to delete this announcement?');">
                    </a>
                </td>
            </div>
        </div>
    </div>
</div>
@endforeach
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    var action = document.getElementById("updateAnnouncement");

    function getData (data){
        var announcementId = $('#updateAnnouncement').val();

        $( "#announcement_id" ).val(data.announcement_id);
        $( "#announcement_title" ).val(data.announcement_title);
        $( "#announcement_description" ).val(data.announcement_description);
    }
</script>