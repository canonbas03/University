$(document).ready(function () {
  function loadTasks() {
    $.get("get_tasks.php", function (data) {
      $("#tasksTable tbody").html(data);
    });
  }
  loadTasks();

  $("#taskForm").on("submit", function (e) {
    e.preventDefault();
    $.post(
      "add_task.php",
      {
        title: $("#title").val(),
        priority: $("#priority").val(),
        deadline: $("#deadline").val(),
      },
      function (data) {
        $("#message").html(data);
        $("#taskForm")[0].reset();
        loadTasks();
      }
    );
  });

  $(document).on("click", "button.delete", function () {
    if (confirm("Do you want to delete the task?")) {
      $.post("delete_task.php", { id: $(this).data("id") }, function () {
        loadTasks();
      });
    }
  });

  $(document).on("click", "button.done", function () {
    const button = $(this);
    const taskId = button.data("id");
    $.post("mark_done.php", { id: taskId }, function () {
      button.hide();
      loadTasks();
    });
  });

  $(document).on("click", "button.update", function () {
    const task = $(this).data();
    $("#update-id").val(task.id);
    $("#update-title").val(task.title);
    $("#update-priority").val(task.priority);
    $("#update-deadline").val(task.deadline);

    $("#updateModal").show();
  });

  $(".close-modal").on("click", function () {
    $("#updateModal").hide();
  });

  $("#updateForm").on("submit", function (e) {
    e.preventDefault();
    $.post(
      "update_task.php",
      {
        id: $("#update-id").val(),
        title: $("#update-title").val(),
        priority: $("#update-priority").val(),
        deadline: $("#update-deadline").val(),
      },
      function (data) {
        $("#message").html(data);
        $("#updateModal").hide();
        loadTasks();
      }
    );
  });
});
