<div class="modal fade" id="topicChoices" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">What would you like to create?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button class="btn btn-primary"><a href="@yield('html_create')" style="color:white;">HTML Document</a></button>
        <button class="btn btn-primary"><a href="@yield('file_create')" style="color:white;">File</a></button>
        <button class="btn btn-primary"><a href="@yield('link_create')" style="color:white;">Quiz</a></button>
      </div>
    </div>
  </div>
</div>
