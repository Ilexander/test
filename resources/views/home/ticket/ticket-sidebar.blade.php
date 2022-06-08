
<div class="sidebar-content email-app-sidebar">
  <div class="email-app-menu">
    <div class="form-group-compose text-center compose-btn">
      <button
        type="button"
        class="compose-email btn btn-primary w-100"
        data-bs-backdrop="false"
        data-bs-toggle="modal"
        data-bs-target="#compose-mail"
      >
        Create New
      </button>
    </div>
    <div class="sidebar-menu-list">
      <div style="position:absolute;bottom:0; display: none;" class="col-12" id="newTicketMessage">

          <textarea rows="10" class="form-control square plugin_editor" id="newTicketMessageText" name="message" ></textarea>
          <button type="button" class="btn btn-primary" onclick="addNewMessage()">Send</button>

      </div>
    </div>
  </div>
</div>

<script>
  function addNewMessage()
  {
      $.ajax({
          type: "POST",
          url: "{{route('ticket.message.create', ['language' => Config::get('language.current')])}}",
          data: {
              message : $('#newTicketMessageText').val(),
              ticket_id : $('#deleteTicketButton').attr("data-value"),
              _token : "{{csrf_token()}}"
          }
      }).done(function(data) {
          if (data.status) {
              window.location.href = "{{route('ticket.list', ['language' => Config::get('language.current')])}}"
          }
      });
  }
</script>
