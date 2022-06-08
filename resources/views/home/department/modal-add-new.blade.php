<!-- add new card modal  -->
<div class="modal fade" id="addNewDepartment" tabindex="-1" aria-labelledby="addNewDepartmentTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-sm-5 mx-50 pb-5">
        <h1 class="text-center mb-1" id="addNewDepartmentTitle">Add New Department</h1>
        <!-- form -->
        <form id="addNewDepartmentValidation" method="POST" action="{{route('department.add', ['language' => Config::get('language.current')])}}" class="row gy-1 gx-2 mt-75">
          @csrf
          <div class="col-12">
            <label class="form-label" for="modalAddDepartmentName">Department Name</label>
            <div class="input-group input-group-merge">
              <input
                id="modalAddDepartmentName"
                name="name"
                class="form-control add-credit-card-mask"
                type="text"
                placeholder="Some name"
                aria-describedby="modalAddDepartment2"
                data-msg="Please enter new department name"
              />
{{--              <span class="input-group-text cursor-pointer p-25" id="modalAddCard2">--}}
{{--                <span class="add-card-type"></span>--}}
{{--              </span>--}}
            </div>
          </div>

          <div id="newDepartmentMembers">
            Members
          </div>
          <div class="col-12 text-left">
            <button type="button" class="btn btn-primary" onclick="addNewMember()">
              +
            </button>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function addNewMember() {
      $.ajax({
          url: "{{route('user.list', ['language' => Config::get('language.current')])}}",
      }).done(function(data) {
          var user = '<div class="mb-1 bootstrap-select">'+
          '<select class="select2 form-select" id="select-timezone" name="members[]">'
          ;
          data.forEach((element) => {
              user+= '<option value="'+element.id+'">'+element.first_name+' '+element.last_name+'</option>';
          })

          user+= '</select></div>';

         $('#newDepartmentMembers').append(user);
      });
  }
</script>
<!--/ add new card modal  -->
